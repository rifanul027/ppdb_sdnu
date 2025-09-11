<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\TahunAjaranModel;
use App\Models\PembayaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminRekapSiswa extends BaseController
{
    protected $studentModel;
    protected $tahunAjaranModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->pembayaranModel = new PembayaranModel();
    }

    /**
     * Halaman utama rekap siswa
     */
    public function index()
    {
        // Get data tahun ajaran untuk filter
        $tahunAjaran = $this->tahunAjaranModel
            ->where('deleted_at IS NULL')
            ->orderBy('tahun_mulai', 'DESC')
            ->findAll();

        // Get tahun default (tahun ini)
        $currentYear = date('Y');
        $defaultTahunAjaran = $this->tahunAjaranModel->getCurrentTahunAjaran();

        $data = [
            'pageTitle' => 'Rekap Siswa',
            'tahunAjaran' => $tahunAjaran,
            'defaultTahunAjaran' => $defaultTahunAjaran
        ];

        return view('admin/rekap-siswa/rekap-siswa', $data);
    }

    /**
     * Get data siswa via AJAX untuk tabel
     */
    public function getStudentsData()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        try {
            $request = $this->request;
            $page = (int) $request->getGet('page') ?: 1;
            $perPage = (int) $request->getGet('per_page') ?: 10;
            $offset = ($page - 1) * $perPage;

            // Filter parameters
            $filters = [
                'tahun_ajaran_id' => $request->getGet('tahun_ajaran_id'),
                'search' => $request->getGet('search'),
            ];

            // Build query dengan kondisi spesifik
            $builder = $this->getRekapStudentsQuery($filters);
            
            // Get total count
            $totalData = $builder->countAllResults(false);

            // Get paginated data
            $students = $builder->limit($perPage, $offset)
                ->orderBy('pembayaran.accepted_at', 'ASC') // Terlama ke terbaru
                ->get()
                ->getResultArray();

            // Format data untuk display
            foreach ($students as &$student) {
                $student['tanggal_lahir_formatted'] = date('d/m/Y', strtotime($student['tanggal_lahir']));
                $student['accepted_at_formatted'] = $student['accepted_at'] ? date('d/m/Y H:i', strtotime($student['accepted_at'])) : '-';
                $student['pembayaran_accepted_formatted'] = $student['pembayaran_accepted_at'] ? date('d/m/Y H:i', strtotime($student['pembayaran_accepted_at'])) : '-';
            }

            // Calculate pagination info
            $totalPages = ceil($totalData / $perPage);

            return $this->response->setJSON([
                'success' => true,
                'data' => $students,
                'pagination' => [
                    'page' => $page,
                    'per_page' => $perPage,
                    'total' => $totalData,
                    'total_pages' => $totalPages
                ]
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error in getStudentsData: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memuat data: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Build query untuk rekap siswa dengan kondisi khusus
     */
    private function getRekapStudentsQuery($filters = [])
    {
        $builder = $this->studentModel->db->table('students')
            ->select('
                students.*,
                tahun_ajaran.nama as tahun_ajaran_nama,
                tahun_ajaran.tahun_mulai,
                tahun_ajaran.tahun_selesai,
                pembayaran.id as pembayaran_id,
                pembayaran.nama as pembayaran_nama,
                pembayaran.metode as pembayaran_metode,
                pembayaran.accepted_at as pembayaran_accepted_at,
                beasiswa.nama as beasiswa_nama
            ')
            ->join('tahun_ajaran', 'students.tahun_ajaran_id = tahun_ajaran.id', 'left')
            ->join('pembayaran', 'students.bukti_pembayaran_id = pembayaran.id', 'inner')
            ->join('beasiswa', 'students.beasiswa_id = beasiswa.id', 'left')
            ->where('students.bukti_pembayaran_id IS NOT NULL') // Bukti pembayaran tidak null
            ->where('pembayaran.accepted_at IS NOT NULL') // Pembayaran sudah diterima
            ->where('students.status', 'siswa') // Status siswa
            ->where('students.accepted_at IS NOT NULL') // Sudah diterima
            ->where('students.deleted_at IS NULL'); // Tidak dihapus

        // Apply filters
        if (!empty($filters['tahun_ajaran_id'])) {
            $builder->where('students.tahun_ajaran_id', $filters['tahun_ajaran_id']);
        }

        if (!empty($filters['search'])) {
            $builder->groupStart()
                ->like('students.nama_lengkap', $filters['search'])
                ->orLike('students.no_registrasi', $filters['search'])
                ->orLike('students.nisn', $filters['search'])
                ->orLike('students.nama_ayah', $filters['search'])
                ->orLike('students.nama_ibu', $filters['search'])
                ->groupEnd();
        }

        return $builder;
    }

    /**
     * Export Excel
     */
    public function exportExcel()
    {
        try {
            $request = $this->request;
            
            // Filter parameters
            $filters = [
                'tahun_ajaran_id' => $request->getGet('tahun_ajaran_id'),
                'search' => $request->getGet('search'),
            ];

            // Get all data
            $students = $this->getRekapStudentsQuery($filters)
                ->orderBy('pembayaran.accepted_at', 'ASC')
                ->get()
                ->getResultArray();

            // Generate CSV content
            $filename = 'rekap-siswa-' . date('Y-m-d') . '.csv';
            
            // Set headers for download
            $this->response->setHeader('Content-Type', 'text/csv');
            $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

            // CSV Header
            $csv = "No,No Registrasi,NISN,Nama Lengkap,Jenis Kelamin,Tempat Lahir,Tanggal Lahir,Agama,Nama Ayah,Nama Ibu,Alamat,Domisili,No Telepon,Asal TK/RA,Tahun Ajaran,Beasiswa,Pembayaran,Metode Pembayaran,Tanggal Diterima,Tanggal Pembayaran Diterima\n";

            // CSV Data
            foreach ($students as $index => $student) {
                $csv .= '"' . ($index + 1) . '",';
                $csv .= '"' . ($student['no_registrasi'] ?? '') . '",';
                $csv .= '"' . ($student['nisn'] ?? '') . '",';
                $csv .= '"' . ($student['nama_lengkap'] ?? '') . '",';
                $csv .= '"' . ($student['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan') . '",';
                $csv .= '"' . ($student['tempat_lahir'] ?? '') . '",';
                $csv .= '"' . ($student['tanggal_lahir'] ? date('d/m/Y', strtotime($student['tanggal_lahir'])) : '') . '",';
                $csv .= '"' . ($student['agama'] ?? '') . '",';
                $csv .= '"' . ($student['nama_ayah'] ?? '') . '",';
                $csv .= '"' . ($student['nama_ibu'] ?? '') . '",';
                $csv .= '"' . ($student['alamat'] ?? '') . '",';
                $csv .= '"' . ($student['domisili'] ?? '') . '",';
                $csv .= '"' . ($student['nomor_telepon'] ?? '') . '",';
                $csv .= '"' . ($student['asal_tk_ra'] ?? '') . '",';
                $csv .= '"' . ($student['tahun_ajaran_nama'] ?? '') . '",';
                $csv .= '"' . ($student['beasiswa_nama'] ?? '') . '",';
                $csv .= '"' . ($student['pembayaran_nama'] ?? '') . '",';
                $csv .= '"' . ($student['pembayaran_metode'] ?? '') . '",';
                $csv .= '"' . ($student['accepted_at'] ? date('d/m/Y H:i', strtotime($student['accepted_at'])) : '') . '",';
                $csv .= '"' . ($student['pembayaran_accepted_at'] ? date('d/m/Y H:i', strtotime($student['pembayaran_accepted_at'])) : '') . '"';
                $csv .= "\n";
            }

            return $this->response->setBody($csv);

        } catch (\Exception $e) {
            log_message('error', 'Error in exportExcel: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal export data: ' . $e->getMessage());
        }
    }

    /**
     * Export PDF
     */
    public function exportPdf()
    {
        try {
            $request = $this->request;
            
            // Filter parameters
            $filters = [
                'tahun_ajaran_id' => $request->getGet('tahun_ajaran_id'),
                'search' => $request->getGet('search'),
            ];

            // Get all data
            $students = $this->getRekapStudentsQuery($filters)
                ->orderBy('pembayaran.accepted_at', 'ASC')
                ->get()
                ->getResultArray();

            // Get tahun ajaran for title
            $tahunAjaran = null;
            if (!empty($filters['tahun_ajaran_id'])) {
                $tahunAjaran = $this->tahunAjaranModel->find($filters['tahun_ajaran_id']);
            }

            $data = [
                'students' => $students,
                'tahunAjaran' => $tahunAjaran,
                'filters' => $filters,
                'exportDate' => date('d/m/Y H:i')
            ];

            // Generate PDF content using view
            $html = view('admin/rekap-siswa/pdf-export', $data);

            // For now, we'll return HTML (you can integrate with a PDF library later)
            $filename = 'rekap-siswa-' . date('Y-m-d') . '.html';
            $this->response->setHeader('Content-Type', 'text/html');
            $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

            return $this->response->setBody($html);

        } catch (\Exception $e) {
            log_message('error', 'Error in exportPdf: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal export PDF: ' . $e->getMessage());
        }
    }

    /**
     * Get summary statistics
     */
    public function getSummaryStats()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        try {
            $request = $this->request;
            
            $filters = [
                'tahun_ajaran_id' => $request->getGet('tahun_ajaran_id'),
                'search' => $request->getGet('search'),
            ];

            $builder = $this->getRekapStudentsQuery($filters);
            
            // Total siswa
            $totalSiswa = $builder->countAllResults(false);

            // Statistics by gender
            $lakiLaki = $builder->where('students.jenis_kelamin', 'L')->countAllResults(false);
            $perempuan = $builder->where('students.jenis_kelamin', 'P')->countAllResults(false);

            // Statistics by beasiswa
            $denganBeasiswa = $builder->where('students.beasiswa_id IS NOT NULL')->countAllResults(false);

            return $this->response->setJSON([
                'success' => true,
                'data' => [
                    'total_siswa' => $totalSiswa,
                    'laki_laki' => $lakiLaki,
                    'perempuan' => $perempuan,
                    'dengan_beasiswa' => $denganBeasiswa,
                    'tanpa_beasiswa' => $totalSiswa - $denganBeasiswa
                ]
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error in getSummaryStats: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
