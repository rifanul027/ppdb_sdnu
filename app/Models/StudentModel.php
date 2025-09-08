<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false; // Karena pakai UUID
    protected $returnType = 'array';
    protected $useSoftDeletes = true; // Untuk soft delete
    protected $protectFields = true;
    protected $allowedFields = [
        'no_registrasi', 'nis', 'nisn', 'nama_lengkap',
        'agama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'nama_ayah', 'nama_ibu', 'alamat', 'domisili', 'asal_tk_ra',
        'nomor_telepon', 'ijazah_url', 'akta_url', 'kk_url',
        'tahun_ajaran_id', 'bukti_pembayaran_id', 'beasiswa_id',
        'status', 'accepted_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation - disabled since we use frontend validation only
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = true;

    protected function beforeInsert(array $data)
    {
        return $data;
    }

    public function generateNoRegistrasi()
    {
        $year = date('Y');
        $month = date('m');
        
        // Get last registration number for current year-month
        $lastStudent = $this->where('no_registrasi LIKE', 'REG' . $year . $month . '%')
            ->orderBy('no_registrasi', 'DESC')
            ->first();
        
        if ($lastStudent) {
            $lastNumber = (int) substr($lastStudent['no_registrasi'], -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        
        return 'REG' . $year . $month . $newNumber;
    }

    public function createStudent($formData, $tahunAjaranId)
    {
        // Generate student ID and registration number
        $studentId = generate_uuid();
        $noRegistrasi = $this->generateNoRegistrasi();
        
        log_message('info', 'Starting registration process - Student ID: ' . $studentId . ', No Registrasi: ' . $noRegistrasi);
        
        // Create upload directory
        $uploadPath = WRITEPATH . 'uploads/' . $studentId;
        log_message('info', 'Creating upload directory: ' . $uploadPath);
        
        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0755, true)) {
                log_message('error', 'Failed to create upload directory: ' . $uploadPath);
                throw new \Exception('Gagal membuat direktori upload. Silakan hubungi administrator.');
            }
        }
        
        log_message('info', 'Upload directory ready: ' . $uploadPath);
        
        // Handle file uploads
        $aktaFile = $formData['files']['akta'];
        $kkFile = $formData['files']['kk'];
        $ijazahFile = $formData['files']['ijazah'];
        
        $aktaUrl = null;
        $kkUrl = null;
        $ijazahUrl = null;
        
        // Validate and upload akta kelahiran
        if ($aktaFile->isValid() && !$aktaFile->hasMoved()) {
            if ($aktaFile->getSize() > 5 * 1024 * 1024) { // 5MB limit
                throw new \Exception('Ukuran file akta kelahiran maksimal 5MB.');
            }
            
            $aktaName = 'akta_' . $studentId . '.' . $aktaFile->getExtension();
            if (!$aktaFile->move($uploadPath, $aktaName)) {
                throw new \Exception('Gagal mengupload akta kelahiran.');
            }
            $aktaUrl = 'writable/uploads/' . $studentId . '/' . $aktaName;
        } else {
            throw new \Exception('File akta kelahiran tidak valid atau tidak dapat diupload.');
        }
        
        // Validate and upload kartu keluarga
        if ($kkFile->isValid() && !$kkFile->hasMoved()) {
            if ($kkFile->getSize() > 5 * 1024 * 1024) { // 5MB limit
                throw new \Exception('Ukuran file kartu keluarga maksimal 5MB.');
            }
            
            $kkName = 'kk_' . $studentId . '.' . $kkFile->getExtension();
            if (!$kkFile->move($uploadPath, $kkName)) {
                throw new \Exception('Gagal mengupload kartu keluarga.');
            }
            $kkUrl = 'writable/uploads/' . $studentId . '/' . $kkName;
        } else {
            throw new \Exception('File kartu keluarga tidak valid atau tidak dapat diupload.');
        }
        
        // Upload ijazah (optional)
        if ($ijazahFile && $ijazahFile->isValid() && !$ijazahFile->hasMoved()) {
            if ($ijazahFile->getSize() > 5 * 1024 * 1024) { // 5MB limit
                throw new \Exception('Ukuran file ijazah maksimal 5MB.');
            }
            
            $ijazahName = 'ijazah_' . $studentId . '.' . $ijazahFile->getExtension();
            if ($ijazahFile->move($uploadPath, $ijazahName)) {
                $ijazahUrl = 'writable/uploads/' . $studentId . '/' . $ijazahName;
            }
        }
        
        // Prepare data for insertion
        $studentData = [
            'id' => $studentId,
            'no_registrasi' => $noRegistrasi,
            'nama_lengkap' => $formData['post']['nama_lengkap'],
            'agama' => $formData['post']['agama'],
            'tempat_lahir' => $formData['post']['tempat_lahir'],
            'tanggal_lahir' => $formData['post']['tanggal_lahir'],
            'jenis_kelamin' => $formData['post']['jenis_kelamin'],
            'nama_ayah' => $formData['post']['nama_ayah'],
            'nama_ibu' => $formData['post']['nama_ibu'],
            'alamat' => $formData['post']['alamat'],
            'domisili' => $formData['post']['domisili'],
            'nomor_telepon' => $formData['post']['nomor_telepon'],
            'asal_tk_ra' => $formData['post']['asal_tk_ra'] ?: null,
            'akta_url' => $aktaUrl,
            'kk_url' => $kkUrl,
            'ijazah_url' => $ijazahUrl,
            'tahun_ajaran_id' => $tahunAjaranId,
            'status' => 'calon',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        log_message('info', 'Student data prepared: ' . json_encode($studentData));
        
        // Insert student data
        log_message('info', 'Attempting to insert student data');
        
        if ($this->insert($studentData)) {
            log_message('info', 'Student data inserted successfully');
            return $studentId;
        } else {
            // Clean up uploaded files if database insertion fails
            if (isset($uploadPath) && is_dir($uploadPath)) {
                $this->deleteDirectory($uploadPath);
            }
            
            // Get database errors if any
            $dbError = $this->errors();
            log_message('error', 'Failed to insert student data. DB Errors: ' . json_encode($dbError));
            $errorMessage = !empty($dbError) ? implode(', ', $dbError) : 'Gagal menyimpan data pendaftaran.';
            throw new \Exception($errorMessage);
        }
    }

    public function updateStudentProfile($studentId, $formData)
    {
        // Prepare update data
        $updateData = [
            'nisn' => $formData['nisn'] ?: null,
            'nama_lengkap' => $formData['nama_lengkap'],
            'agama' => $formData['agama'],
            'tempat_lahir' => $formData['tempat_lahir'],
            'tanggal_lahir' => $formData['tanggal_lahir'],
            'jenis_kelamin' => $formData['jenis_kelamin'],
            'nama_ayah' => $formData['nama_ayah'],
            'nama_ibu' => $formData['nama_ibu'],
            'alamat' => $formData['alamat'],
            'domisili' => $formData['domisili'],
            'nomor_telepon' => $formData['nomor_telepon'],
            'asal_tk_ra' => $formData['asal_tk_ra'] ?: null,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // Update student data
        if ($this->update($studentId, $updateData)) {
            return true;
        } else {
            throw new \Exception('Gagal memperbarui data profil.');
        }
    }

    public function deleteStudentData($studentId)
    {
        // Get student data first to clean up files
        $student = $this->find($studentId);
        if (!$student) {
            throw new \Exception('Data siswa tidak ditemukan.');
        }
        
        // Delete student record (soft delete)
        if ($this->delete($studentId)) {
            // Clean up uploaded files
            $uploadPath = WRITEPATH . 'uploads/' . $studentId;
            if (is_dir($uploadPath)) {
                $this->deleteDirectory($uploadPath);
            }
            
            return true;
        } else {
            throw new \Exception('Gagal menghapus data siswa.');
        }
    }

    private function deleteDirectory($dir)
    {
        if (!is_dir($dir)) {
            return false;
        }
        
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $filePath = $dir . DIRECTORY_SEPARATOR . $file;
            is_dir($filePath) ? $this->deleteDirectory($filePath) : unlink($filePath);
        }
        
        return rmdir($dir);
    }

    // Get students with relationships
    public function getStudentsWithRelations($filters = [])
    {
        $builder = $this->db->table($this->table)
            ->select('students.*, tahun_ajaran.nama as tahun_ajaran_nama, beasiswa.nama as beasiswa_nama')
            ->join('tahun_ajaran', 'students.tahun_ajaran_id = tahun_ajaran.id', 'left')
            ->join('beasiswa', 'students.beasiswa_id = beasiswa.id', 'left')
            ->where('students.deleted_at IS NULL');

        // Apply filters
        if (!empty($filters['status'])) {
            $builder->where('students.status', $filters['status']);
        }

        if (!empty($filters['tahun_ajaran'])) {
            $builder->where('tahun_ajaran.nama', $filters['tahun_ajaran']);
        }

        if (!empty($filters['tanggal_dari'])) {
            $builder->where('DATE(students.created_at) >=', $filters['tanggal_dari']);
        }

        if (!empty($filters['tanggal_sampai'])) {
            $builder->where('DATE(students.created_at) <=', $filters['tanggal_sampai']);
        }

        if (!empty($filters['search'])) {
            $builder->groupStart()
                ->like('students.nama_lengkap', $filters['search'])
                ->orLike('students.no_registrasi', $filters['search'])
                ->orLike('students.nama_ayah', $filters['search'])
                ->orLike('students.nama_ibu', $filters['search'])
                ->groupEnd();
        }

        return $builder;
    }

    // Get summary statistics
    public function getSummaryStats($filters = [])
    {
        $builder = $this->getStudentsWithRelations($filters);
        
        $total = $builder->countAllResults(false);
        
        $stats = [
            'total_pendaftar' => $total,
            'diterima' => 0,
            'pending' => 0,
            'ditolak' => 0,
            'siswa' => 0,
            'laki_laki' => 0,
            'perempuan' => 0
        ];

        if ($total > 0) {
            // Get status counts
            $statusCounts = $builder->select('students.status, COUNT(*) as count')
                ->groupBy('students.status')
                ->get()
                ->getResultArray();

            foreach ($statusCounts as $statusCount) {
                $stats[$statusCount['status']] = $statusCount['count'];
            }

            // Get gender counts
            $genderCounts = $builder->select('students.jenis_kelamin, COUNT(*) as count')
                ->groupBy('students.jenis_kelamin')
                ->get()
                ->getResultArray();

            foreach ($genderCounts as $genderCount) {
                if ($genderCount['jenis_kelamin'] === 'L') {
                    $stats['laki_laki'] = $genderCount['count'];
                } else if ($genderCount['jenis_kelamin'] === 'P') {
                    $stats['perempuan'] = $genderCount['count'];
                }
            }
        }

        return $stats;
    }

    // Get monthly registration chart data
    public function getMonthlyChartData($tahunAjaran = null)
    {
        $builder = $this->db->table($this->table)
            ->select('MONTH(students.created_at) as month, COUNT(*) as count')
            ->where('students.deleted_at IS NULL')
            ->where('YEAR(students.created_at)', date('Y'));

        if ($tahunAjaran) {
            $builder->join('tahun_ajaran', 'students.tahun_ajaran_id = tahun_ajaran.id')
                ->where('tahun_ajaran.nama', $tahunAjaran);
        }

        $results = $builder->groupBy('MONTH(students.created_at)')
            ->orderBy('MONTH(students.created_at)')
            ->get()
            ->getResultArray();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $data = array_fill(0, 12, 0);

        foreach ($results as $result) {
            $data[$result['month'] - 1] = $result['count'];
        }

        return [
            'labels' => $months,
            'data' => $data
        ];
    }

    /**
     * Get student by registration number
     */
    public function getByRegistrationNumber($noRegistrasi)
    {
        return $this->where('no_registrasi', $noRegistrasi)->first();
    }

    /**
     * Check if NISN is already used by another student
     */
    public function isNisnExists($nisn, $excludeId = null)
    {
        $builder = $this->where('nisn', $nisn);
        
        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }
        
        return $builder->first() !== null;
    }

    /**
     * Update student status
     */
    public function updateStatus($studentId, $status, $acceptedAt = null)
    {
        $updateData = [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($status === 'diterima' && $acceptedAt) {
            $updateData['accepted_at'] = $acceptedAt;
        }
        
        return $this->update($studentId, $updateData);
    }

    /**
     * Count students by status
     */
    public function countByStatus($status)
    {
        return $this->where('status', $status)
                   ->where('deleted_at', null)
                   ->countAllResults();
    }

    /**
     * Get recent students by created_at
     */
    public function getRecentStudents($limit = 5)
    {
        return $this->select('id, no_registrasi, nama_lengkap, jenis_kelamin, created_at, status')
                   ->where('deleted_at', null)
                   ->orderBy('created_at', 'DESC')
                   ->limit($limit)
                   ->findAll();
    }
}
