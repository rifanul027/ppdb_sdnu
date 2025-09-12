<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\TahunAjaranModel;
use App\Models\PembayaranModel;
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
        $this->userModel = new UserModel();
        helper(['uuid', 'toast', 'form']);
    }

    public function daftar()
    {
        // VISIBLE DEBUG - Remove after debugging
        if (!headers_sent()) {
            echo "<!-- DEBUG: Daftar method called -->\n";
            echo "<!-- DEBUG: Request method: " . $this->request->getMethod() . " -->\n"; 
        }
        
        // DEBUG: Log all incoming requests
        log_message('debug', '=== DAFTAR METHOD START ===');
        log_message('debug', 'Request method: ' . $this->request->getMethod());
        log_message('debug', 'Session data: ' . json_encode(session()->get()));
        
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            log_message('debug', 'User not logged in - redirecting to login');
            return redirect()->to('/login');
        }
        
        // Check if user already has student_id
        if (session()->get('student_id')) {
            log_message('debug', 'User already has student_id - redirecting to profile');
            return redirect()->to('/profile-siswa');
        }
        
        log_message('debug', 'GET request - showing form');
        // GET request - show form
        $tahunAjaranList = $this->tahunAjaranModel->where('is_active', 1)->findAll();
        
        $data = [
            'title' => 'Pendaftaran Online - PPDB SDNU Pemanahan',
            'tahunAjaranList' => $tahunAjaranList
        ];
        
        return view('ppdb/daftar', $data);
    }
    
    public function prosesDaftar()
    {
        // VISIBLE DEBUG
        if (!headers_sent()) {
            echo "<!-- DEBUG: prosesDaftar called -->\n";
        }
        
        log_message('debug', '=== PROSES DAFTAR START ===');
        
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            log_message('debug', 'User not logged in - redirecting to login');
            return redirect()->to('/login');
        }
        
        // Check if user already has student_id
        if (session()->get('student_id')) {
            log_message('debug', 'User already has student_id - redirecting to profile');
            return redirect()->to('/profile-siswa');
        }
        
        try {
            // Debug incoming data
            log_message('debug', 'Processing registration form submission');
            log_message('debug', 'POST data: ' . json_encode($this->request->getPost()));
            
            // VISIBLE DEBUG - Show POST data
            if (!headers_sent()) {
                echo "<!-- DEBUG: POST data count: " . count($this->request->getPost()) . " -->\n";
            }
            
            // Validate CSRF token
            if (!$this->request->is('post')) {
                throw new \Exception('Invalid request method');
            }

            // Debug: Log all POST data
            log_message('debug', 'POST Data: ' . json_encode($this->request->getPost()));
            log_message('debug', 'FILES Data: ' . json_encode($_FILES));

            // Get selected tahun ajaran from form
            $tahunAjaranId = $this->request->getPost('tahun_ajaran_id');
            
            if (empty($tahunAjaranId)) {
                setErrorToast('Error Validasi', 'Tahun ajaran harus dipilih.');
                return redirect()->back()->withInput();
            }

            $tahunAjaran = $this->tahunAjaranModel->find($tahunAjaranId);
            if (!$tahunAjaran) {
                log_message('error', 'Selected tahun ajaran not found: ' . $tahunAjaranId);
                setErrorToast('Error Sistem', 'Tahun ajaran yang dipilih tidak valid.');
                return redirect()->back()->withInput();
            }
            
            log_message('info', 'Selected tahun ajaran found: ' . $tahunAjaran['id']);
            
            // Prepare form data for model
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
                    'ijazah' => $this->request->getFile('ijazah')
                ]
            ];
            
            // Debug: log formData to file for inspection
            log_message('debug', 'Processed Form Data: ' . json_encode($formData['post']));
            
            // Create student using model
            $studentId = $this->studentModel->createStudent($formData, $tahunAjaran['id']);
            
            // Update user session with student_id
            session()->set('student_id', $studentId);
            
            // Update user table with student_id if needed
            $userId = session()->get('user_id');
            if ($userId) {
                $this->userModel->update($userId, ['student_id' => $studentId]);
            }
            
            // Get registration number for success message
            $student = $this->studentModel->find($studentId);
            
            setSuccessToast(
                'Pendaftaran Berhasil!', 
                'Selamat! Pendaftaran Anda berhasil dengan nomor registrasi: ' . $student['no_registrasi']
            );
            
            return redirect()->to('/profile-siswa');
            
        } catch (\Exception $e) {
            log_message('error', 'Registration error: ' . $e->getMessage());
            log_message('error', 'Error trace: ' . $e->getTraceAsString());
            setErrorToast('Terjadi Kesalahan', 'Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    
    public function studentProfile()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Check if user has student_id
        if (!session()->get('student_id')) {
            setWarningToast('Akses Ditolak', 'Anda harus mendaftar terlebih dahulu untuk mengakses profil siswa.');
            return redirect()->to('/daftar');
        }
        
        // Get student data
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
        
        $data = [
            'title' => 'Profil Siswa - ' . $studentData['nama_lengkap'],
            'student' => $studentData,
            'payment' => $paymentData
        ];
        
        return view('ppdb/student_profile', $data);
    }
    
    public function editProfile()
    {
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
            return redirect()->to('/profile-siswa');
        }
        
        $data = [
            'title' => 'Edit Profil - ' . $studentData['nama_lengkap'],
            'student' => $studentData
        ];
        
        return view('ppdb/edit_profile', $data);
    }
    
    private function updateProfile()
    {
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
            return redirect()->to('/profile-siswa');
            
        } catch (\Exception $e) {
            log_message('error', 'Profile update error: ' . $e->getMessage());
            setErrorToast('Gagal Memperbarui', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    
    public function uploadPayment()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Check if user has student_id
        if (!session()->get('student_id')) {
            return redirect()->to('/daftar');
        }
        
        if ($this->request->getMethod() !== 'POST') {
            return redirect()->to('/profile-siswa');
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
            return redirect()->to('/profile-siswa');
            
        } catch (\Exception $e) {
            log_message('error', 'Payment upload error: ' . $e->getMessage());
            setErrorToast('Upload Gagal', $e->getMessage());
            return redirect()->back();
        }
    }
    
    public function pengumuman()
    {
        $pengumumanModel = new \App\Models\PengumumanModel();
        
        // Get active pengumuman
        $pengumumanList = $pengumumanModel->getActivePengumuman();
        
        // Process each pengumuman to handle images
        foreach ($pengumumanList as &$pengumuman) {
            if (!empty($pengumuman['image_url'])) {
                // Check if it's already a full URL or needs to be converted from file path
                if (!filter_var($pengumuman['image_url'], FILTER_VALIDATE_URL)) {
                    // If it's a file path, convert to URL
                    if (file_exists(ROOTPATH . 'public/' . $pengumuman['image_url'])) {
                        $pengumuman['image_url'] = base_url($pengumuman['image_url']);
                    } else {
                        // File doesn't exist, use mockup
                        $pengumuman['image_url'] = $this->generateMockupImage($pengumuman['nama']);
                    }
                }
            } else {
                // No image specified, use mockup
                $pengumuman['image_url'] = $this->generateMockupImage($pengumuman['nama']);
            }
            
            // Add a flag to indicate if this is a mockup
            $pengumuman['is_mockup'] = strpos($pengumuman['image_url'], 'via.placeholder.com') !== false;
        }
        
        // Get all tahun ajaran for filter
        $tahunAjaranList = $this->tahunAjaranModel->orderBy('tahun_mulai', 'DESC')->findAll();
        
        // Get default tahun ajaran (current year)
        $currentYear = date('Y');
        $defaultTahunAjaran = $this->tahunAjaranModel->where('tahun_mulai', $currentYear)->first();
        
        // Get selected tahun ajaran from query parameter or use default
        $selectedTahunAjaranId = $this->request->getGet('tahun_ajaran') ?? ($defaultTahunAjaran['id'] ?? null);
        
        // Build filter for students
        $filters = ['status' => 'siswa'];
        if ($selectedTahunAjaranId) {
            $filters['tahun_ajaran_id'] = $selectedTahunAjaranId;
        }
        
        // Get students with status 'siswa' filtered by tahun ajaran and ordered by payment ID
        $siswaData = $this->studentModel->getStudentsWithRelations($filters)
            ->orderBy('students.bukti_pembayaran_id', 'ASC')
            ->get()
            ->getResultArray();
        
        // Add row numbers for display
        foreach ($siswaData as $index => &$siswa) {
            $siswa['row_number'] = $index + 1;
        }
        
        $data = [
            'title' => 'Pengumuman PPDB - SDNU Pemanahan',
            'pengumuman' => $pengumumanList,
            'siswa_list' => $siswaData,
            'tahun_ajaran_list' => $tahunAjaranList,
            'selected_tahun_ajaran' => $selectedTahunAjaranId,
            'default_tahun_ajaran' => $defaultTahunAjaran,
        ];
        
        return view('ppdb/pengumuman', $data);
    }
    
    /**
     * Generate mockup image URL for pengumuman
     */
    private function generateMockupImage($title)
    {
        // Create a clean title for the mockup
        $cleanTitle = urlencode(substr($title, 0, 50));
        
        // Use placeholder.com service with SDNU colors
        $mockupUrl = "https://via.placeholder.com/400x250/48BB78/FFFFFF?text=" . $cleanTitle;
        
        return $mockupUrl;
    }

    /**
     * Delete student data (for admin use)
     * This method can be called from admin controller
     */
    public function deleteStudent($studentId = null)
    {
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

    /**
     * Update student status (for admin use)
     */
    public function updateStudentStatus($studentId = null, $status = null)
    {
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
    
    public function login()
    {
        $data = [
            'title' => 'login PPDB- SDNU Pemanahan'
        ];
        
        return view('ppdb/login', $data);
    }
    public function register()
    {
        $data = [
            'title' => 'register PPDB- SDNU Pemanahan'
        ];
        return view('ppdb/register');
    }
}
