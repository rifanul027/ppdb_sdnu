<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\TahunAjaranModel;
use App\Models\UserModel;

class PendaftaranSiswa extends BaseController
{
    private StudentModel $studentModel;
    private TahunAjaranModel $tahunAjaranModel;
    private UserModel $userModel;
    
    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->userModel = new UserModel();
        helper(['uuid', 'toast', 'form']);
    }

    public function index()
    {
        if (!$this->isUserLoggedIn()) {
            return $this->redirectToLogin();
        }
        
        if ($this->hasStudentProfile()) {
            return redirect()->to('/student-profile');
        }
        
        $data = [
            'title' => 'Pendaftaran Online - PPDB SDNU Pemanahan',
            'tahunAjaranList' => $this->getActiveTahunAjaran()
        ];
        
        return view('ppdb/daftar', $data);
    }
    
    public function store()
    {
        if (!$this->isUserLoggedIn()) {
            return $this->redirectToLogin();
        }
        $userId = session()->get('user_id') ?? 'unknown';
        if (!$this->isAuthorizedUser($userId)) {
            setErrorToast('Akses Ditolak', 'Anda tidak memiliki akses untuk melakukan pendaftaran dengan ID ini.');
            return redirect()->to('/daftar');
        }
        
        if ($this->hasStudentProfile()) {
            return redirect()->to('/student-profile');
        }
        
        if (!$this->request->is('post')) {
            setErrorToast('Error', 'Invalid request method');
            return redirect()->to('/daftar');
        }
        
        try {
            $this->validateRegistrationData();
            $tahunAjaran = $this->validateTahunAjaran();
            $formData = $this->prepareFormData();
            
            $studentId = $this->studentModel->createStudent($formData, $tahunAjaran['id'], $userId);
            
            $this->updateUserWithStudent($userId, $studentId);
            session()->set('student_id', $studentId);
            
            $this->showSuccessMessage($studentId);
            
            return redirect()->to('/student-profile');
            
        } catch (\Exception $e) {
            return $this->handleRegistrationError($e);
        }
    }

    private function isUserLoggedIn(): bool
    {
        return (bool) session()->get('logged_in');
    }

    private function redirectToLogin()
    {
        log_message('info', 'User not logged in, redirecting to login');
        return redirect()->to('/login');
    }

    private function hasStudentProfile(): bool
    {
        return (bool) session()->get('student_id');
    }

    private function getActiveTahunAjaran(): array
    {
        $tahunAjaranList = $this->tahunAjaranModel->where('is_active', 1)->findAll();
        log_message('info', 'Found ' . count($tahunAjaranList) . ' active tahun ajaran');
        return $tahunAjaranList;
    }

    private function isAuthorizedUser(string $userId): bool
    {
        return session()->get('user_id') == $userId;
    }

    private function validateRegistrationData(): void
    {
        $validation = \Config\Services::validation();
        $validation->setRules($this->getValidationRules());

        if (!$validation->withRequest($this->request)->run()) {
            $this->throwValidationError($validation->getErrors());
        }
    }

    private function getValidationRules(): array
    {
        return [
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
        ];
    }

    private function throwValidationError(array $errors): void
    {
        $errorMessage = 'Data yang diisi tidak valid:';
        foreach ($errors as $error) {
            $errorMessage .= '<br>• ' . $error;
        }
        
        setErrorToast('Error Validasi', $errorMessage);
        throw new \Exception('Validation failed');
    }

    private function validateTahunAjaran(): array
    {
        $tahunAjaranId = $this->request->getPost('tahun_ajaran_id');
        $tahunAjaran = $this->tahunAjaranModel->find($tahunAjaranId);
        
        if (!$tahunAjaran) {
            setErrorToast('Error Sistem', 'Tahun ajaran yang dipilih tidak valid.');
            throw new \Exception('Invalid tahun ajaran');
        }
        
        return $tahunAjaran;
    }

    private function prepareFormData(): array
    {
        return [
            'post' => $this->getPostData(),
            'files' => $this->getFileData()
        ];
    }

    private function getPostData(): array
    {
        $fields = [
            'nama_lengkap', 'agama', 'tempat_lahir', 'tanggal_lahir',
            'jenis_kelamin', 'nama_ayah', 'nama_ibu', 'alamat',
            'domisili', 'nomor_telepon', 'asal_tk_ra'
        ];
        
        $postData = [];
        foreach ($fields as $field) {
            $postData[$field] = $this->request->getPost($field);
        }
        
        return $postData;
    }

    private function getFileData(): array
    {
        $fileFields = ['akta', 'kk', 'ijazah', 'ktp_ayah', 'ktp_ibu'];
        
        $fileData = [];
        foreach ($fileFields as $field) {
            $fileData[$field] = $this->request->getFile($field);
        }
        
        return $fileData;
    }

    private function updateUserWithStudent(string $userId, string $studentId): void
    {
        if ($userId) {
            $this->userModel->update($userId, ['student_id' => $studentId]);
            log_message('info', "User {$userId} updated with student_id: {$studentId}");
        }
    }

    private function showSuccessMessage(string $studentId): void
    {
        $student = $this->studentModel->find($studentId);
        
        log_message('info', 'Registration completed successfully for student: ' . $student['no_registrasi']);
        
        setSuccessToast(
            'Pendaftaran Berhasil!',
            'Selamat! Pendaftaran Anda berhasil dengan nomor registrasi: ' . $student['no_registrasi']
        );
    }

    private function handleRegistrationError(\Exception $e)
    {
        log_message('error', 'Registration error: ' . $e->getMessage());
        
        if ($e->getMessage() === 'Validation failed') {
            return redirect()->back()->withInput();
        }
        
        if ($e->getMessage() === 'Invalid tahun ajaran') {
            return redirect()->back()->withInput();
        }
        
        $this->setErrorMessage($e);
        
        return redirect()->back()->withInput();
    }

    private function setErrorMessage(\Exception $e): void
    {
        $message = $e->getMessage();
        
        if ($this->isFileUploadError($message)) {
            setErrorToast(
                'Error File Upload',
                $message . ' Pastikan file yang diupload sesuai format dan ukuran yang diizinkan.'
            );
        } else {
            setErrorToast('Terjadi Kesalahan', 'Error: ' . $message);
        }
    }

    private function isFileUploadError(string $message): bool
    {
        return strpos($message, 'File') !== false || strpos($message, 'upload') !== false;
    }
}