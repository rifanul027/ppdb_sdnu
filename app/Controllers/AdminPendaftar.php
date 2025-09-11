<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\UserModel;
use App\Models\TahunAjaranModel;

class AdminPendaftar extends BaseController
{
    protected $studentModel;
    protected $userModel;
    protected $tahunAjaranModel;
    protected $db;

    public function __construct()
    {
        helper(['url', 'form', 'whatsapp']);
        $this->studentModel = new StudentModel();
        $this->userModel = new UserModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $request = $this->request;
        
        // Get filter parameters
        $search = $request->getGet('search');
        $page = $request->getGet('page') ?? 1;
        $perPage = 15;

        $data = [
            'title' => 'Data Pendaftar',
            'pageTitle' => 'Data Pendaftar',
            'pendaftar' => $this->getPendaftar($search, $page, $perPage),
            'totalData' => $this->getTotalPendaftar($search),
            'currentPage' => $page,
            'totalPages' => ceil($this->getTotalPendaftar($search) / $perPage),
            'search' => $search
        ];

        return view('admin/pendaftar/pendaftar_new', $data);
    }

    public function detail($id)
    {
        $student = $this->studentModel
            ->select('students.*, users.username, users.email, tahun_ajaran.nama as tahun_ajaran_nama')
            ->join('users', 'users.student_id = students.id', 'left')
            ->join('tahun_ajaran', 'tahun_ajaran.id = students.tahun_ajaran_id', 'left')
            ->where('students.id', $id)
            ->where('students.deleted_at', null)
            ->first();

        if (!$student) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pendaftar tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Pendaftar',
            'pageTitle' => 'Detail Pendaftar',
            'student' => $student
        ];

        return view('admin/pendaftar/pendaftar_detail', $data);
    }

    public function edit($id)
    {
        $student = $this->studentModel
            ->where('id', $id)
            ->where('deleted_at', null)
            ->first();

        if (!$student) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pendaftar tidak ditemukan');
        }

        // Get tahun ajaran list
        $tahunAjaranList = $this->tahunAjaranModel
            ->where('deleted_at', null)
            ->findAll();

        $data = [
            'title' => 'Edit Pendaftar',
            'pageTitle' => 'Edit Pendaftar',
            'student' => $student,
            'tahunAjaranList' => $tahunAjaranList
        ];

        return view('admin/pendaftar/pendaftar_edit', $data);
    }

    public function update($id)
    {
        $student = $this->studentModel
            ->where('id', $id)
            ->where('deleted_at', null)
            ->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Data pendaftar tidak ditemukan');
        }

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'tahun_ajaran_id' => $this->request->getPost('tahun_ajaran_id'),
            'agama' => $this->request->getPost('agama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'nama_ayah' => $this->request->getPost('nama_ayah'),
            'nama_ibu' => $this->request->getPost('nama_ibu'),
            'alamat' => $this->request->getPost('alamat'),
            'domisili' => $this->request->getPost('domisili'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'asal_tk_ra' => $this->request->getPost('asal_tk_ra'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->studentModel->update($id, $data)) {
            return redirect()->to('/admin/pendaftar/pendaftar')->with('success', 'Data pendaftar berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Gagal mengupdate data pendaftar');
        }
    }

    public function delete($id)
    {
        $student = $this->studentModel
            ->where('id', $id)
            ->where('deleted_at', null)
            ->first();

        if (!$student) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data pendaftar tidak ditemukan']);
        }

        // Soft delete
        $data = [
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if ($this->studentModel->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Data pendaftar berhasil dihapus']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus data pendaftar']);
        }
    }

    public function validateStudent($id)
    {
        $student = $this->studentModel
            ->where('id', $id)
            ->where('deleted_at', null)
            ->where('status', 'calon')
            ->first();
        if (!$student) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data pendaftar tidak ditemukan']);
        }
        $data = [
            'accepted_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->studentModel->update($id, $data)) {
            setSuccessToast('Validasi Berhasil', 'Data pendaftar berhasil divalidasi');
            return $this->response->setJSON(['success' => true, 'message' => 'Data pendaftar berhasil divalidasi']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memvalidasi data pendaftar']);
        }
    }

    public function tambah()
    {
        // Get tahun ajaran list
        $tahunAjaranList = $this->tahunAjaranModel
            ->where('deleted_at', null)
            ->findAll();

        $data = [
            'title' => 'Tambah Pendaftar',
            'pageTitle' => 'Tambah Pendaftar',
            'tahunAjaranList' => $tahunAjaranList
        ];

        return view('admin/pendaftar/pendaftar_add', $data);
    }

    public function store()
    {
        // Validation rules
        $validationRules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'tahun_ajaran_id' => 'required',
            'agama' => 'required',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'tempat_lahir' => 'required|min_length[3]|max_length[50]',
            'tanggal_lahir' => 'required|valid_date',
            'nama_ayah' => 'required|min_length[3]|max_length[100]',
            'nama_ibu' => 'required|min_length[3]|max_length[100]',
            'alamat' => 'required|min_length[10]',
            'domisili' => 'required|min_length[10]',
            'nomor_telepon' => 'required|min_length[10]|max_length[20]',
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'akta' => 'uploaded[akta]|max_size[akta,5120]|ext_in[akta,pdf,jpg,jpeg,png]',
            'kk' => 'uploaded[kk]|max_size[kk,5120]|ext_in[kk,pdf,jpg,jpeg,png]',
            'ijazah' => 'permit_empty|max_size[ijazah,5120]|ext_in[ijazah,pdf,jpg,jpeg,png]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Start transaction
        $this->db->transStart();

        try {
            // Generate UUID for student
            helper('uuid');
            $studentId = generateUUID();

            // Generate no registrasi
            $year = date('Y');
            $lastNumber = $this->studentModel
                ->where('no_registrasi LIKE', $year . '%')
                ->orderBy('no_registrasi', 'DESC')
                ->first();

            if ($lastNumber) {
                $lastNum = (int) substr($lastNumber['no_registrasi'], -4);
                $newNumber = str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '0001';
            }

            $noRegistrasi = $year . $newNumber;

            // Handle file uploads
            $aktaFile = $this->request->getFile('akta');
            $kkFile = $this->request->getFile('kk');
            $ijazahFile = $this->request->getFile('ijazah');

            $aktaUrl = null;
            $kkUrl = null;
            $ijazahUrl = null;

            // Upload akta file
            if ($aktaFile && $aktaFile->isValid() && !$aktaFile->hasMoved()) {
                $aktaNewName = 'akta_' . $studentId . '.' . $aktaFile->getExtension();
                if ($aktaFile->move(WRITEPATH . 'uploads', $aktaNewName)) {
                    $aktaUrl = 'uploads/' . $aktaNewName;
                }
            }

            // Upload kk file
            if ($kkFile && $kkFile->isValid() && !$kkFile->hasMoved()) {
                $kkNewName = 'kk_' . $studentId . '.' . $kkFile->getExtension();
                if ($kkFile->move(WRITEPATH . 'uploads', $kkNewName)) {
                    $kkUrl = 'uploads/' . $kkNewName;
                }
            }

            // Upload ijazah file (optional)
            if ($ijazahFile && $ijazahFile->isValid() && !$ijazahFile->hasMoved()) {
                $ijazahNewName = 'ijazah_' . $studentId . '.' . $ijazahFile->getExtension();
                if ($ijazahFile->move(WRITEPATH . 'uploads', $ijazahNewName)) {
                    $ijazahUrl = 'uploads/' . $ijazahNewName;
                }
            }

            // Prepare student data
            $studentData = [
                'id' => $studentId,
                'no_registrasi' => $noRegistrasi,
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'tahun_ajaran_id' => $this->request->getPost('tahun_ajaran_id'),
                'agama' => $this->request->getPost('agama'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'nama_ayah' => $this->request->getPost('nama_ayah'),
                'nama_ibu' => $this->request->getPost('nama_ibu'),
                'alamat' => $this->request->getPost('alamat'),
                'domisili' => $this->request->getPost('domisili'),
                'nomor_telepon' => $this->request->getPost('nomor_telepon'),
                'asal_tk_ra' => $this->request->getPost('asal_tk_ra'),
                'akta_url' => $aktaUrl,
                'kk_url' => $kkUrl,
                'ijazah_url' => $ijazahUrl,
                'status' => 'calon',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Insert student
            if (!$this->studentModel->insert($studentData)) {
                throw new \Exception('Gagal menyimpan data siswa');
            }

            // Prepare user data
            $plainPassword = $this->request->getPost('password');
            $userData = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $plainPassword, // Will be hashed automatically by model
                'role' => 'siswa',
                'student_id' => $studentId
            ];

            // Insert user
            if (!$this->userModel->insert($userData)) {
                throw new \Exception('Gagal membuat akun user');
            }

            // Get tahun ajaran name
            $tahunAjaran = $this->tahunAjaranModel->find($this->request->getPost('tahun_ajaran_id'));

            // Prepare success data for modal
            $successData = [
                'no_registrasi' => $noRegistrasi,
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'tahun_ajaran' => $tahunAjaran['nama'] ?? 'N/A',
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $plainPassword
            ];

            // Complete transaction
            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Transaksi database gagal');
            }

            // Set success data in session for modal
            session()->setFlashdata('success_data', $successData);
            
            return redirect()->to('/admin/pendaftar/tambah');

        } catch (\Exception $e) {
            // Rollback transaction
            $this->db->transRollback();
            
            // Clean up uploaded files if any
            if ($aktaUrl && file_exists(WRITEPATH . $aktaUrl)) {
                unlink(WRITEPATH . $aktaUrl);
            }
            if ($kkUrl && file_exists(WRITEPATH . $kkUrl)) {
                unlink(WRITEPATH . $kkUrl);
            }
            if ($ijazahUrl && file_exists(WRITEPATH . $ijazahUrl)) {
                unlink(WRITEPATH . $ijazahUrl);
            }

            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    private function getPendaftar($search = null, $page = 1, $perPage = 15)
    {
        $offset = ($page - 1) * $perPage;
        
        $builder = $this->studentModel
            ->select('students.*, users.username, users.email, tahun_ajaran.nama as tahun_ajaran_nama')
            ->join('users', 'users.student_id = students.id', 'left')
            ->join('tahun_ajaran', 'tahun_ajaran.id = students.tahun_ajaran_id', 'left')
            ->where('students.accepted_at', null)
            ->where('students.deleted_at', null)
            ->where('students.status', 'calon');

        if ($search) {
            $builder->groupStart()
                ->like('students.nama_lengkap', $search)
                ->orLike('students.no_registrasi', $search)
                ->orLike('students.nama_ayah', $search)
                ->orLike('students.nama_ibu', $search)
                ->groupEnd();
        }

        return $builder
            ->orderBy('students.created_at', 'DESC')
            ->limit($perPage, $offset)
            ->findAll();
    }

    private function getTotalPendaftar($search = null)
    {
        $builder = $this->studentModel
            ->where('accepted_at', null)
            ->where('deleted_at', null)
            ->where('status', 'calon');

        if ($search) {
            $builder->groupStart()
                ->like('nama_lengkap', $search)
                ->orLike('no_registrasi', $search)
                ->orLike('nama_ayah', $search)
                ->orLike('nama_ibu', $search)
                ->groupEnd();
        }

        return $builder->countAllResults();
    }
}
