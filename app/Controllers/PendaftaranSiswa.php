<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\TahunAjaranModel;
use App\Models\UserModel;

class PendaftaranSiswa extends BaseController
{
    protected $studentModel;
    protected $tahunAjaranModel;
    protected $userModel;
    
    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->userModel = new UserModel();
        helper(['uuid', 'toast', 'form']);
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            log_message('info', 'User not logged in, redirecting to login');
            return redirect()->to('/login');
        }
        
        if (session()->get('student_id')) {
            log_message('info', 'User already has student_id, redirecting to profile');
            return redirect()->to('/student-profile');
        }
        
        log_message('info', 'Showing registration form to user: ' . session()->get('user_id'));
        
        $tahunAjaranList = $this->tahunAjaranModel->where('is_active', 1)->findAll();
        
        log_message('info', 'Found ' . count($tahunAjaranList) . ' active tahun ajaran');
        
        $data = [
            'title' => 'Pendaftaran Online - PPDB SDNU Pemanahan',
            'tahunAjaranList' => $tahunAjaranList
        ];
        
        return view('ppdb/daftar', $data);
    }
    
    public function store($userId)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Verify that the userId matches the current logged in user
        if (session()->get('user_id') != $userId) {
            setErrorToast('Akses Ditolak', 'Anda tidak memiliki akses untuk melakukan pendaftaran dengan ID ini.');
            return redirect()->to('/daftar');
        }
        
        if (session()->get('student_id')) {
            return redirect()->to('/student-profile');
        }
        
        try {
            if (!$this->request->is('post')) {
                throw new \Exception('Invalid request method');
            }

            $validation = \Config\Services::validation();
            $validation->setRules([
                'nama_lengkap' => 'required|min_length[3]|max_length[100]',
                'tahun_ajaran_id' => 'required',
                'agama' => 'required',
                'tempat_lahir' => 'required|min_length[3]|max_length[50]',
                'tanggal_lahir' => 'required|valid_date',
                'jenis_kelamin' => 'required|in_list[L,P]',
                'nama_ayah' => 'required|min_length[3]|max_length[100]',
                'nama_ibu' => 'required|min_length[3]|max_length[100]',
                'alamat' => 'required|min_length[10]|max_length[255]',
                'domisili' => 'required|min_length[10]|max_length[255]',
                'nomor_telepon' => 'required|min_length[10]|max_length[15]',
                'akta' => 'uploaded[akta]|max_size[akta,5120]|ext_in[akta,pdf,jpg,jpeg,png]',
                'kk' => 'uploaded[kk]|max_size[kk,5120]|ext_in[kk,pdf,jpg,jpeg,png]',
                'ktp_ayah' => 'uploaded[ktp_ayah]|max_size[ktp_ayah,5120]|ext_in[ktp_ayah,pdf,jpg,jpeg,png]',
                'ktp_ibu' => 'uploaded[ktp_ibu]|max_size[ktp_ibu,5120]|ext_in[ktp_ibu,pdf,jpg,jpeg,png]',
                'ijazah' => 'permit_empty|max_size[ijazah,5120]|ext_in[ijazah,pdf,jpg,jpeg,png]'
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                $errors = $validation->getErrors();
                $errorMessage = 'Data yang diisi tidak valid:';
                foreach ($errors as $field => $error) {
                    $errorMessage .= '<br>• ' . $error;
                }
                setErrorToast('Error Validasi', $errorMessage);
                return redirect()->back()->withInput()->with('validation', $validation);
            }

            $tahunAjaranId = $this->request->getPost('tahun_ajaran_id');
            
            $tahunAjaran = $this->tahunAjaranModel->find($tahunAjaranId);
            if (!$tahunAjaran) {
                setErrorToast('Error Sistem', 'Tahun ajaran yang dipilih tidak valid.');
                return redirect()->back()->withInput();
            }
            
            log_message('info', 'Form submission attempt from user: ' . $userId);
            log_message('info', 'Form data received: ' . json_encode($this->request->getPost()));
            
            $formData = [
                'post' => [
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'agama' => $this->request->getPost('agama'),
                    'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                    'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'nama_ayah' => $this->request->getPost('nama_ayah'),
                    'nama_ibu' => $this->request->getPost('nama_ibu'),
                    'alamat' => $this->request->getPost('alamat'),
                    'domisili' => $this->request->getPost('domisili'),
                    'nomor_telepon' => $this->request->getPost('nomor_telepon'),
                    'asal_tk_ra' => $this->request->getPost('asal_tk_ra')
                ],
                'files' => [
                    'akta' => $this->request->getFile('akta'),
                    'kk' => $this->request->getFile('kk'),
                    'ijazah' => $this->request->getFile('ijazah'),
                    'ktp_ayah' => $this->request->getFile('ktp_ayah'),
                    'ktp_ibu' => $this->request->getFile('ktp_ibu')
                ]
            ];
            
            log_message('info', 'Attempting to create student with tahun ajaran: ' . $tahunAjaran['id'] . ' for user: ' . $userId);
            $studentId = $this->studentModel->createStudent($formData, $tahunAjaran['id'], $userId);
            log_message('info', 'Student created successfully with ID: ' . $studentId);
            
            session()->set('student_id', $studentId);
            
            if ($userId) {
                $this->userModel->update($userId, ['student_id' => $studentId]);
                log_message('info', 'User updated with student_id: ' . $studentId);
            }
            
            $student = $this->studentModel->find($studentId);
            
            log_message('info', 'Registration completed successfully for student: ' . $student['no_registrasi']);
            
            setSuccessToast(
                'Pendaftaran Berhasil!', 
                'Selamat! Pendaftaran Anda berhasil dengan nomor registrasi: ' . $student['no_registrasi']
            );
            
            return redirect()->to('/student-profile');
            
        } catch (\Exception $e) {
            log_message('error', 'Registration error: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            if (strpos($e->getMessage(), 'File') !== false || strpos($e->getMessage(), 'upload') !== false) {
                setErrorToast('Error File Upload', $e->getMessage() . ' Pastikan file yang diupload sesuai format dan ukuran yang diizinkan.');
            } else {
                setErrorToast('Terjadi Kesalahan', 'Error: ' . $e->getMessage());
            }
            
            return redirect()->back()->withInput();
        }
    }
}