<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = [
        'no_registrasi', 'nis', 'nisn', 'nama_lengkap',
        'agama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'nama_ayah', 'nama_ibu', 'alamat', 'domisili', 'asal_tk_ra',
        'nomor_telepon', 'ijazah_url', 'akta_url', 'kk_url',
        'ktp_ayah', 'ktp_ibu', 'kategori_id',
        'tahun_ajaran_id', 'bukti_pembayaran_id',
        'status', 'accepted_at'
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = true;

    private const FILE_SIZE_LIMIT = 5 * 1024 * 1024;
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'pdf'];

    public function generateNoRegistrasi(): string
    {
        $year = date('Y');
        $month = date('m');
        $prefix = 'REG' . $year . $month;
        
        $lastStudent = $this->where('no_registrasi LIKE', $prefix . '%')
            ->orderBy('no_registrasi', 'DESC')
            ->first();
        
        $newNumber = $lastStudent 
            ? str_pad((int)substr($lastStudent['no_registrasi'], -4) + 1, 4, '0', STR_PAD_LEFT)
            : '0001';
        
        return $prefix . $newNumber;
    }

    public function createStudent(array $formData, string $tahunAjaranId, ?string $userId = null): string
    {
        $studentId = $this->generateUUID();
        $noRegistrasi = $this->generateNoRegistrasi();
        
        log_message('info', "Starting registration - Student ID: {$studentId}, No Registrasi: {$noRegistrasi}");
        
        $uploadPath = $this->createUploadDirectory($studentId);
        $fileUrls = $this->processFileUploads($formData['files'] ?? [], $uploadPath, $studentId);
        
        $studentData = $this->prepareStudentData($formData['post'], $studentId, $noRegistrasi, $tahunAjaranId, $fileUrls);
        
        if ($this->insert($studentData)) {
            log_message('info', 'Student data inserted successfully');
            return $studentId;
        }
        
        $this->cleanupUploadDirectory($uploadPath);
        $this->throwDatabaseError();
    }

    public function updateStudentProfile(string $studentId, array $formData): bool
    {
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
        
        if (!$this->update($studentId, $updateData)) {
            throw new \Exception('Gagal memperbarui data profil.');
        }
        
        return true;
    }

    public function deleteStudentData(string $studentId): bool
    {
        $student = $this->find($studentId);
        if (!$student) {
            throw new \Exception('Data siswa tidak ditemukan.');
        }
        
        if (!$this->delete($studentId)) {
            throw new \Exception('Gagal menghapus data siswa.');
        }
        
        $this->cleanupStudentFiles($studentId);
        return true;
    }

    public function getStudentsWithRelations(array $filters = [])
    {
        $builder = $this->db->table($this->table)
            ->select('students.*, tahun_ajaran.nama as tahun_ajaran_nama')
            ->join('tahun_ajaran', 'students.tahun_ajaran_id = tahun_ajaran.id', 'left')
            ->join('kategori', 'students.kategori_id = kategori.id', 'left')
            ->where('students.deleted_at IS NULL');

        return $this->applyFilters($builder, $filters);
    }

    public function getSummaryStats(array $filters = []): array
    {
        $builder = $this->getStudentsWithRelations($filters);
        $total = $builder->countAllResults(false);
        
        $stats = $this->initializeStats($total);
        
        if ($total > 0) {
            $this->calculateStatusCounts($builder, $stats);
            $this->calculateGenderCounts($builder, $stats);
        }
        
        return $stats;
    }

    public function getMonthlyChartData(?string $tahunAjaran = null): array
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

        return $this->formatChartData($results);
    }

    public function getByRegistrationNumber(string $noRegistrasi): ?array
    {
        return $this->where('no_registrasi', $noRegistrasi)->first();
    }

    public function isNisnExists(string $nisn, ?string $excludeId = null): bool
    {
        $builder = $this->where('nisn', $nisn);
        
        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }
        
        return $builder->first() !== null;
    }

    public function updateStatus(string $studentId, string $status, ?string $acceptedAt = null): bool
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

    public function countByStatus(string $status): int
    {
        return $this->where('status', $status)
                   ->where('deleted_at', null)
                   ->countAllResults();
    }

    public function getRecentStudents(int $limit = 5): array
    {
        return $this->select('id, no_registrasi, nama_lengkap, jenis_kelamin, created_at, status')
                   ->where('deleted_at', null)
                   ->orderBy('created_at', 'DESC')
                   ->limit($limit)
                   ->findAll();
    }

    private function generateUUID(): string
    {
        if (function_exists('generate_uuid')) {
            return generate_uuid();
        }
        
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    private function createUploadDirectory(string $studentId): string
    {
        $uploadPath = WRITEPATH . 'uploads/pendaftaran/' . $studentId;
        log_message('info', "Creating upload directory: {$uploadPath}");
        
        if (!is_dir($uploadPath) && !mkdir($uploadPath, 0755, true)) {
            log_message('error', "Failed to create upload directory: {$uploadPath}");
            throw new \Exception('Gagal membuat direktori upload. Silakan hubungi administrator.');
        }
        
        return $uploadPath;
    }

    private function processFileUploads(array $files, string $uploadPath, string $studentId): array
    {
        $requiredFiles = ['akta', 'kk', 'ktp_ayah', 'ktp_ibu'];
        $optionalFiles = ['ijazah'];
        $fileUrls = [];
        
        foreach ($requiredFiles as $fileType) {
            $fileUrls[$fileType] = $this->uploadFile($files[$fileType] ?? null, $uploadPath, $fileType, $studentId, true);
        }
        
        foreach ($optionalFiles as $fileType) {
            $fileUrls[$fileType] = $this->uploadFile($files[$fileType] ?? null, $uploadPath, $fileType, $studentId, false);
        }
        
        return $fileUrls;
    }

    private function uploadFile($file, string $uploadPath, string $fileType, string $studentId, bool $required = true): ?string
    {
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            if ($required) {
                throw new \Exception("File {$fileType} tidak valid atau tidak dapat diupload.");
            }
            return null;
        }
        
        $this->validateFile($file, $fileType);
        
        $fileName = "{$fileType}_{$studentId}." . $file->getExtension();
        
        if (!$file->move($uploadPath, $fileName)) {
            throw new \Exception("Gagal mengupload {$fileType}.");
        }
        
        $url = "writable/uploads/pendaftaran/{$studentId}/{$fileName}";
        log_message('info', "{$fileType} uploaded successfully: {$url}");
        
        return $url;
    }

    private function validateFile($file, string $fileType): void
    {
        if ($file->getSize() > self::FILE_SIZE_LIMIT) {
            throw new \Exception("Ukuran file {$fileType} maksimal 5MB.");
        }
        
        $extension = strtolower($file->getExtension());
        if (!in_array($extension, self::ALLOWED_EXTENSIONS)) {
            throw new \Exception("Format file {$fileType} tidak didukung. Gunakan: " . implode(', ', self::ALLOWED_EXTENSIONS));
        }
    }

    private function prepareStudentData(array $postData, string $studentId, string $noRegistrasi, string $tahunAjaranId, array $fileUrls): array
    {
        return [
            'id' => $studentId,
            'no_registrasi' => $noRegistrasi,
            'nama_lengkap' => $postData['nama_lengkap'],
            'agama' => $postData['agama'],
            'tempat_lahir' => $postData['tempat_lahir'],
            'tanggal_lahir' => $postData['tanggal_lahir'],
            'jenis_kelamin' => $postData['jenis_kelamin'],
            'nama_ayah' => $postData['nama_ayah'],
            'nama_ibu' => $postData['nama_ibu'],
            'alamat' => $postData['alamat'],
            'domisili' => $postData['domisili'],
            'nomor_telepon' => $postData['nomor_telepon'],
            'asal_tk_ra' => $postData['asal_tk_ra'] ?: null,
            'akta_url' => $fileUrls['akta'],
            'kk_url' => $fileUrls['kk'],
            'ijazah_url' => $fileUrls['ijazah'],
            'ktp_ayah' => $fileUrls['ktp_ayah'],
            'ktp_ibu' => $fileUrls['ktp_ibu'],
            'tahun_ajaran_id' => $tahunAjaranId,
            'status' => 'calon',
            'created_at' => date('Y-m-d H:i:s')
        ];
    }

    private function cleanupUploadDirectory(string $uploadPath): void
    {
        if (is_dir($uploadPath)) {
            $this->deleteDirectory($uploadPath);
        }
    }

    private function cleanupStudentFiles(string $studentId): void
    {
        $uploadPath = WRITEPATH . 'uploads/pendaftaran/' . $studentId;
        if (is_dir($uploadPath)) {
            $this->deleteDirectory($uploadPath);
        }
    }

    private function deleteDirectory(string $dir): bool
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

    private function throwDatabaseError(): void
    {
        $dbError = $this->errors();
        log_message('error', 'Failed to insert student data. DB Errors: ' . json_encode($dbError));
        $errorMessage = !empty($dbError) ? implode(', ', $dbError) : 'Gagal menyimpan data pendaftaran.';
        throw new \Exception($errorMessage);
    }

    private function applyFilters($builder, array $filters)
    {
        $filterMethods = [
            'status' => fn($value) => $builder->where('students.status', $value),
            'tahun_ajaran' => fn($value) => $builder->where('tahun_ajaran.nama', $value),
            'tahun_ajaran_id' => fn($value) => $builder->where('students.tahun_ajaran_id', $value),
            'tanggal_dari' => fn($value) => $builder->where('DATE(students.created_at) >=', $value),
            'tanggal_sampai' => fn($value) => $builder->where('DATE(students.created_at) <=', $value),
            'search' => function($value) use ($builder) {
                $builder->groupStart()
                    ->like('students.nama_lengkap', $value)
                    ->orLike('students.no_registrasi', $value)
                    ->orLike('students.nama_ayah', $value)
                    ->orLike('students.nama_ibu', $value)
                    ->groupEnd();
            }
        ];

        foreach ($filters as $key => $value) {
            if (!empty($value) && isset($filterMethods[$key])) {
                $filterMethods[$key]($value);
            }
        }

        return $builder;
    }

    private function initializeStats(int $total): array
    {
        return [
            'total_pendaftar' => $total,
            'diterima' => 0,
            'pending' => 0,
            'ditolak' => 0,
            'siswa' => 0,
            'laki_laki' => 0,
            'perempuan' => 0
        ];
    }

    private function calculateStatusCounts($builder, array &$stats): void
    {
        $statusCounts = $builder->select('students.status, COUNT(*) as count')
            ->groupBy('students.status')
            ->get()
            ->getResultArray();

        foreach ($statusCounts as $statusCount) {
            if (isset($stats[$statusCount['status']])) {
                $stats[$statusCount['status']] = $statusCount['count'];
            }
        }
    }

    private function calculateGenderCounts($builder, array &$stats): void
    {
        $genderCounts = $builder->select('students.jenis_kelamin, COUNT(*) as count')
            ->groupBy('students.jenis_kelamin')
            ->get()
            ->getResultArray();

        foreach ($genderCounts as $genderCount) {
            if ($genderCount['jenis_kelamin'] === 'L') {
                $stats['laki_laki'] = $genderCount['count'];
            } elseif ($genderCount['jenis_kelamin'] === 'P') {
                $stats['perempuan'] = $genderCount['count'];
            }
        }
    }

    private function formatChartData(array $results): array
    {
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
}