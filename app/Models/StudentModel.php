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

    // Validation
    protected $validationRules = [
        'nama_lengkap' => 'required|min_length[3]|max_length[100]',
        'jenis_kelamin' => 'required|in_list[L,P]',
        'tempat_lahir' => 'required|max_length[50]',
        'tanggal_lahir' => 'required|valid_date',
        'agama' => 'required|max_length[20]',
        'alamat' => 'required|min_length[10]',
        'nama_ayah' => 'required|max_length[100]',
        'nama_ibu' => 'required|max_length[100]',
        'status' => 'in_list[calon,siswa]'
    ];

    protected $validationMessages = [
        'nama_lengkap' => [
            'required' => 'Nama lengkap harus diisi',
            'min_length' => 'Nama lengkap minimal 3 karakter',
            'max_length' => 'Nama lengkap maksimal 100 karakter'
        ],
        'jenis_kelamin' => [
            'required' => 'Jenis kelamin harus dipilih',
            'in_list' => 'Jenis kelamin tidak valid (L/P)'
        ],
        'tempat_lahir' => [
            'required' => 'Tempat lahir harus diisi',
            'max_length' => 'Tempat lahir maksimal 50 karakter'
        ],
        'tanggal_lahir' => [
            'required' => 'Tanggal lahir harus diisi',
            'valid_date' => 'Format tanggal lahir tidak valid'
        ]
    ];

    protected function beforeInsert(array $data)
    {
        if (!isset($data['data']['id'])) {
            $data['data']['id'] = service('uuid')->uuid4()->toString();
        }
        
        // Auto generate no_registrasi if not provided
        if (!isset($data['data']['no_registrasi']) || empty($data['data']['no_registrasi'])) {
            $data['data']['no_registrasi'] = $this->generateNoRegistrasi();
        }
        
        return $data;
    }

    private function generateNoRegistrasi()
    {
        $year = date('Y');
        $lastNumber = $this->selectMax('no_registrasi')
            ->where('YEAR(created_at)', $year)
            ->get()
            ->getRow();
        
        $nextNumber = 1;
        if ($lastNumber && $lastNumber->no_registrasi) {
            // Extract number from last registration number
            $lastNumPart = substr($lastNumber->no_registrasi, -4);
            $nextNumber = intval($lastNumPart) + 1;
        }
        
        return 'PPDB-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
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
}
