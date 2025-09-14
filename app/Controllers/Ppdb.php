<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\TahunAjaranModel;
use App\Models\PembayaranModel;
use App\Models\KategoriModel;
use App\Models\UserModel;
use App\Libraries\UuidService;

class Ppdb extends BaseController
{
    protected $studentModel;
    protected $tahunAjaranModel;
    protected $pembayaranModel;
    protected $userModel;
    
    public function index()
    {
         return view('ppdb/info');
    }

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->kategoriModel = new KategoriModel();
        $this->userModel = new UserModel();
        helper(['uuid', 'toast', 'form']);
    }

    public function studentProfile() {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        if (!session()->get('student_id')) {
            setWarningToast('Akses Ditolak', 'Anda harus mendaftar terlebih dahulu untuk mengakses profil siswa.');
            return redirect()->to('/daftar');
        }
        
        $studentData = $this->studentModel->find(session()->get('student_id'));
        
        if (!$studentData) {
            setErrorToast('Data Tidak Ditemukan', 'Data siswa tidak ditemukan. Silakan daftar ulang.');
            return redirect()->to('/daftar');
        }
        
        // Get payment data if exists
        $paymentData = null;
        if (!empty($studentData['bukti_pembayaran_id'])) {
            $paymentData = $this->pembayaranModel->find($studentData['bukti_pembayaran_id']);
        }
        
        $kategoriData = null;
        if (!empty($studentData['kategori_id'])) {
            $kategoriData = $this->kategoriModel->find($studentData['kategori_id']);
        }
        
        $data = [
            'title' => 'Profil Siswa - ' . $studentData['nama_lengkap'],
            'student' => $studentData,
            'payment' => $paymentData,
            'kategori' => $kategoriData
        ];
        
        return view('ppdb/student_profile', $data);
    }
    
    public function editProfile() {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Check if user has student_id
        if (!session()->get('student_id')) {
            return redirect()->to('/daftar');
        }
        
        // Handle POST request (form submission)
        if ($this->request->getMethod() === 'POST') {
            return $this->updateProfile();
        }
        
        // Get student data for edit form
        $studentData = $this->studentModel->find(session()->get('student_id'));
        
        if (!$studentData) {
            setErrorToast('Data Tidak Ditemukan', 'Data siswa tidak ditemukan.');
            return redirect()->to('/student-profile');
        }
        
        $data = [
            'title' => 'Edit Profil - ' . $studentData['nama_lengkap'],
            'student' => $studentData
        ];
        
        return view('ppdb/edit_profile', $data);
    }
    
    private function updateProfile() {
        $studentId = session()->get('student_id');
        
        try {
            // Prepare form data for model
            $formData = [
                'nisn' => $this->request->getPost('nisn'),
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
            ];
            
            // Update student profile using model
            $this->studentModel->updateStudentProfile($studentId, $formData);
            
            setSuccessToast('Profil Diperbarui', 'Data profil Anda berhasil diperbarui.');
            return redirect()->to('/student-profile');
            
        } catch (\Exception $e) {
            log_message('error', 'Profile update error: ' . $e->getMessage());
            setErrorToast('Gagal Memperbarui', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    
    public function uploadPayment() {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Check if user has student_id
        if (!session()->get('student_id')) {
            return redirect()->to('/daftar');
        }
        
        if ($this->request->getMethod() !== 'POST') {
            return redirect()->to('/student-profile');
        }
        
        try {
            $studentId = session()->get('student_id');
            
            // Prepare form data for model
            $formData = [
                'nama_pembayar' => $this->request->getPost('nama_pembayar'),
                'metode' => $this->request->getPost('metode')
            ];
            
            // Get uploaded file
            $buktiFile = $this->request->getFile('bukti_pembayaran');
            
            // Create payment using model
            $paymentId = $this->pembayaranModel->createPayment($studentId, $formData, $buktiFile);
            
            // Update student record with payment ID
            $this->studentModel->update($studentId, [
                'bukti_pembayaran_id' => $paymentId,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
            setSuccessToast('Pembayaran Berhasil', 'Data pembayaran berhasil diupload. Silakan tunggu konfirmasi dari admin.');
            return redirect()->to('/student-profile');
            
        } catch (\Exception $e) {
            log_message('error', 'Payment upload error: ' . $e->getMessage());
            setErrorToast('Upload Gagal', $e->getMessage());
            return redirect()->back();
        }
    }
    
    public function pengumuman() {
        $data = [
            'title' => 'Pengumuman PPDB - SDNU Pemanahan'
        ];
        
        return view('ppdb/pengumuman', $data);
    }

    public function deleteStudent($studentId = null) {
        // Check if user is admin or has permission
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            setErrorToast('Akses Ditolak', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->to('/');
        }

        if (!$studentId) {
            setErrorToast('Parameter Tidak Valid', 'ID siswa tidak ditemukan.');
            return redirect()->back();
        }

        try {
            // Delete student using model
            $this->studentModel->deleteStudentData($studentId);
            
            setSuccessToast('Berhasil', 'Data siswa berhasil dihapus.');
            
        } catch (\Exception $e) {
            log_message('error', 'Delete student error: ' . $e->getMessage());
            setErrorToast('Gagal Menghapus', $e->getMessage());
        }

        return redirect()->back();
    }

    public function updateStudentStatus($studentId = null, $status = null) {
        // Check if user is admin or has permission
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            setErrorToast('Akses Ditolak', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->to('/');
        }

        if (!$studentId || !$status) {
            setErrorToast('Parameter Tidak Valid', 'ID siswa atau status tidak valid.');
            return redirect()->back();
        }

        // Validate status
        $allowedStatuses = ['calon', 'diterima', 'ditolak', 'siswa'];
        if (!in_array($status, $allowedStatuses)) {
            setErrorToast('Status Tidak Valid', 'Status yang dipilih tidak valid.');
            return redirect()->back();
        }

        try {
            $acceptedAt = ($status === 'diterima') ? date('Y-m-d H:i:s') : null;
            $this->studentModel->updateStatus($studentId, $status, $acceptedAt);
            
            setSuccessToast('Status Diperbarui', 'Status siswa berhasil diperbarui menjadi: ' . ucfirst($status));
            
        } catch (\Exception $e) {
            log_message('error', 'Update status error: ' . $e->getMessage());
            setErrorToast('Gagal', 'Gagal memperbarui status siswa.');
        }

        return redirect()->back();
    }
    
    public function login() {
        $data = [
            'title' => 'login PPDB- SDNU Pemanahan'
        ];
        
        return view('ppdb/login', $data);
    }
    public function register() {
        $data = [
            'title' => 'register PPDB- SDNU Pemanahan'
        ];
        return view('ppdb/register');
    }
}
