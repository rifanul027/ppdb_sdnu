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

    public function __construct()
    {
        helper(['url', 'form']);
        $this->studentModel = new StudentModel();
        $this->userModel = new UserModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
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

        $data = [
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
            'status' => 'calon',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->studentModel->insert($data)) {
            return redirect()->to('/admin/pendaftar/pendaftar')->with('success', 'Data pendaftar berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data pendaftar');
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
