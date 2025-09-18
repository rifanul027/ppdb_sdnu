<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\TahunAjaranModel;
use App\Models\PembayaranModel;
use App\Models\KategoriModel;
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
        $this->kategoriModel = new KategoriModel();
        helper(['uuid', 'toast', 'form']);
    }

    public function index() {
        $tahunAjaran = $this->tahunAjaranModel
            ->where('deleted_at IS NULL')
            ->orderBy('tahun_mulai', 'DESC')
            ->findAll();

        $currentYear = date('Y');
        $defaultTahunAjaran = $this->tahunAjaranModel->getCurrentTahunAjaran();
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'pageTitle' => 'Rekap Siswa',
            'tahunAjaran' => $tahunAjaran,
            'defaultTahunAjaran' => $defaultTahunAjaran,
            'kategori' => $kategori
        ];

        return view('admin/rekap-siswa/rekap-siswa', $data);
    }

    public function getStudentsData() {
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

            $filters = [
                'tahun_ajaran_id' => $request->getGet('tahun_ajaran_id'),
                'search' => $request->getGet('search'),
            ];

            $builder = $this->getRekapStudentsQuery($filters);
            
            $totalData = $builder->countAllResults(false);

            $students = $builder->limit($perPage, $offset)
                ->orderBy('pembayaran.accepted_at', 'ASC') // Terlama ke terbaru
                ->get()
                ->getResultArray();

            foreach ($students as &$student) {
                $student['tanggal_lahir_formatted'] = date('d/m/Y', strtotime($student['tanggal_lahir']));
                $student['accepted_at_formatted'] = $student['accepted_at'] ? date('d/m/Y H:i', strtotime($student['accepted_at'])) : '-';
                $student['pembayaran_accepted_formatted'] = $student['pembayaran_accepted_at'] ? date('d/m/Y H:i', strtotime($student['pembayaran_accepted_at'])) : '-';
            }

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

    private function getRekapStudentsQuery($filters = []) {
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
                kategori.nama_kategori as kategori_nama
            ')
            ->join('tahun_ajaran', 'students.tahun_ajaran_id = tahun_ajaran.id', 'left')
            ->join('pembayaran', 'students.bukti_pembayaran_id = pembayaran.id', 'inner')
            ->join('kategori', 'students.kategori_id = kategori.id', 'left')
            ->where('students.bukti_pembayaran_id IS NOT NULL') // Bukti pembayaran tidak null
            ->where('pembayaran.accepted_at IS NOT NULL') // Pembayaran sudah diterima
            ->where('students.status', 'siswa') // Status siswa
            ->where('students.accepted_at IS NOT NULL') // Sudah diterima
            ->where('students.deleted_at IS NULL'); // Tidak dihapus

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

    public function exportExcel() {
        try {
            $request = $this->request;
            
            $filters = [
                'tahun_ajaran_id' => $request->getGet('tahun_ajaran_id'),
                'search' => $request->getGet('search'),
            ];

            $students = $this->getRekapStudentsQuery($filters)
                ->orderBy('pembayaran.accepted_at', 'ASC')
                ->get()
                ->getResultArray();

            $filename = 'rekap-siswa-' . date('Y-m-d') . '.csv';
            
            $this->response->setHeader('Content-Type', 'text/csv');
            $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

            $csv = "No,No Registrasi,NISN,Nama Lengkap,Jenis Kelamin,Tempat Lahir,Tanggal Lahir,Agama,Nama Ayah,Nama Ibu,Alamat,Domisili,No Telepon,Asal TK/RA,Tahun Ajaran,Kategori,Pembayaran,Metode Pembayaran,Tanggal Diterima,Tanggal Pembayaran Diterima\n";

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
                $csv .= '"' . ($student['kategori_nama'] ?? 'Belum Ditentukan') . '",';
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

    public function exportPdf() {
        try {
            $request = $this->request;
            
            $filters = [
                'tahun_ajaran_id' => $request->getGet('tahun_ajaran_id'),
                'search' => $request->getGet('search'),
            ];

            $students = $this->getRekapStudentsQuery($filters)
                ->orderBy('pembayaran.accepted_at', 'ASC')
                ->get()
                ->getResultArray();

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

            $html = view('admin/rekap-siswa/pdf-export', $data);

            $filename = 'rekap-siswa-' . date('Y-m-d') . '.html';
            $this->response->setHeader('Content-Type', 'text/html');
            $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

            return $this->response->setBody($html);

        } catch (\Exception $e) {
            log_message('error', 'Error in exportPdf: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal export PDF: ' . $e->getMessage());
        }
    }

    public function getSummaryStats() {
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
            
            $totalSiswa = $builder->countAllResults(false);

            $lakiLaki = $builder->where('students.jenis_kelamin', 'L')->countAllResults(false);
            $perempuan = $totalSiswa - $lakiLaki;

            return $this->response->setJSON([
                'success' => true,
                'data' => [
                    'total_siswa' => $totalSiswa,
                    'laki_laki' => $lakiLaki,
                    'perempuan' => $perempuan
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

    public function addKategoriToStudent() {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        try {
            $studentId  = $this->request->getPost('student_id');
            $kategoriId = $this->request->getPost('kategori_id');

            if (!$studentId || !$kategoriId) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Data tidak lengkap'
                ]);
            }

            $student = $this->studentModel->find($studentId);
            if (!$student) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Data siswa tidak ditemukan'
                ]);
            }

            $this->studentModel->update($studentId, [
                'kategori_id' => $kategoriId
            ]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Kategori berhasil ditambahkan ke siswa'
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error in addKategoriToStudent: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Gagal menambahkan kategori: ' . $e->getMessage()
            ]);
        }
    }

    public function updateKategori($studentId) {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        try {
            $json = $this->request->getJSON(true);
            $kategoriId = $json['kategori_id'] ?? null;

            if (!$studentId || !$kategoriId) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Data tidak lengkap'
                ]);
            }

            $student = $this->studentModel->find($studentId);
            if (!$student) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Data siswa tidak ditemukan'
                ]);
            }

            $this->studentModel->update($studentId, [
                'kategori_id' => $kategoriId
            ]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Kategori berhasil diupdate'
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error in updateKategori: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Gagal update kategori: ' . $e->getMessage()
            ]);
        }
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

        return view('admin/rekap-siswa/student', $data);
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
            return redirect()->to('/admin/rekap-siswa')->with('success', 'Data pendaftar berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Gagal mengupdate data pendaftar');
        }
    }
}
