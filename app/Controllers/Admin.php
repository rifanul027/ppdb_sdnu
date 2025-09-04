<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function __construct()
    {
        // Load necessary helpers
        helper(['url', 'form']);
        
        // Check if user is logged in as admin
        // You can implement session checking here
        /*
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login');
        }
        */
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'pageTitle' => 'Dashboard',
            'totalPendaftar' => $this->getTotalPendaftar(),
            'pendaftarDiterima' => $this->getPendaftarDiterima(),
            'menungguVerifikasi' => $this->getMenungguVerifikasi(),
            'kuotaTersisa' => $this->getKuotaTersisa(),
            'totalKuota' => $this->getTotalKuota(),
            'pendaftarTerbaru' => $this->getPendaftarTerbaru()
        ];

        return view('admin/dashboard', $data);
    }

    public function pendaftar()
    {
        $request = $this->request;
        
        // Get filter parameters
        $search = $request->getGet('search');
        $status = $request->getGet('status');
        $tanggal = $request->getGet('tanggal');
        $page = $request->getGet('page') ?? 1;
        $perPage = 20;

        $data = [
            'title' => 'Data Pendaftar',
            'pageTitle' => 'Data Pendaftar',
            'pendaftar' => $this->getPendaftar($search, $status, $tanggal, $page, $perPage),
            'totalData' => $this->getTotalPendaftar($search, $status, $tanggal),
            'currentPage' => $page,
            'totalPages' => ceil($this->getTotalPendaftar($search, $status, $tanggal) / $perPage),
            'search' => $search,
            'status' => $status,
            'tanggal' => $tanggal
        ];

        return view('admin/pendaftar', $data);
    }

    public function rekapSiswa()
    {
        $data = [
            'title' => 'Rekap Siswa',
            'pageTitle' => 'Rekap Siswa'
        ];

        return view('admin/rekap-siswa', $data);
    }

    // API untuk mengambil data siswa dengan filter dan pagination
    public function getStudentsData()
    {
        $request = $this->request;
        
        if (!$request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Invalid request']);
        }

        $studentModel = new \App\Models\StudentModel();
        
        // Get filter parameters
        $filters = [
            'status' => $request->getGet('status'),
            'tahun_ajaran' => $request->getGet('tahun_ajaran'),
            'tanggal_dari' => $request->getGet('tanggal_dari'),
            'tanggal_sampai' => $request->getGet('tanggal_sampai'),
            'search' => $request->getGet('search')
        ];

        // Pagination
        $page = intval($request->getGet('page')) ?: 1;
        $perPage = intval($request->getGet('per_page')) ?: 10;
        $offset = ($page - 1) * $perPage;

        try {
            // Get filtered data with pagination
            $builder = $studentModel->getStudentsWithRelations($filters);
            $total = $builder->countAllResults(false);
            
            $students = $builder->limit($perPage, $offset)
                ->orderBy('students.created_at', 'DESC')
                ->get()
                ->getResultArray();

            // If no data found, create sample data for testing
            if (empty($students) && $page == 1) {
                $this->createSampleData();
                
                // Try again after creating sample data
                $builder = $studentModel->getStudentsWithRelations($filters);
                $total = $builder->countAllResults(false);
                
                $students = $builder->limit($perPage, $offset)
                    ->orderBy('students.created_at', 'DESC')
                    ->get()
                    ->getResultArray();
            }

            // Format data for display
            foreach ($students as &$student) {
                $student['tanggal_lahir_formatted'] = date('d/m/Y', strtotime($student['tanggal_lahir']));
                $student['created_at_formatted'] = date('d/m/Y H:i', strtotime($student['created_at']));
            }

            return $this->response->setJSON([
                'success' => true,
                'data' => $students,
                'pagination' => [
                    'page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                    'total_pages' => ceil($total / $perPage)
                ]
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // API untuk update status siswa
    public function updateStudentStatus($id)
    {
        $request = $this->request;
        
        if (!$request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Invalid request']);
        }

        $studentModel = new \App\Models\StudentModel();
        $input = $request->getJSON(true);

        try {
            $data = [
                'status' => $input['status'] ?? ''
            ];

            if ($studentModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Status siswa berhasil diupdate'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengupdate status siswa'
                ]);
            }

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // API untuk delete siswa
    public function deleteStudent($id)
    {
        $request = $this->request;
        
        if (!$request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Invalid request']);
        }

        $studentModel = new \App\Models\StudentModel();

        try {
            if ($studentModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Data siswa berhasil dihapus'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus data siswa'
                ]);
            }

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // Export Excel
    public function exportExcel()
    {
        $request = $this->request;
        $studentModel = new \App\Models\StudentModel();
        
        // Get filter parameters
        $filters = [
            'status' => $request->getGet('status'),
            'tahun_ajaran' => $request->getGet('tahun_ajaran'),
            'tanggal_dari' => $request->getGet('tanggal_dari'),
            'tanggal_sampai' => $request->getGet('tanggal_sampai'),
            'search' => $request->getGet('search')
        ];

        try {
            // Get all data without pagination for export
            $students = $studentModel->getStudentsWithRelations($filters)
                ->orderBy('students.created_at', 'DESC')
                ->get()
                ->getResultArray();

            // Create CSV content
            $csv = "No,No. Registrasi,Nama Lengkap,Jenis Kelamin,Tempat Lahir,Tanggal Lahir,Alamat,Domisili,Nama Ayah,Nama Ibu,Status,Tahun Ajaran,Tanggal Daftar\n";
            
            $no = 1;
            foreach ($students as $student) {
                $csv .= '"' . $no++ . '",';
                $csv .= '"' . ($student['no_registrasi'] ?? '') . '",';
                $csv .= '"' . ($student['nama_lengkap'] ?? '') . '",';
                $csv .= '"' . ($student['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan') . '",';
                $csv .= '"' . ($student['tempat_lahir'] ?? '') . '",';
                $csv .= '"' . date('d/m/Y', strtotime($student['tanggal_lahir'])) . '",';
                $csv .= '"' . str_replace('"', '""', $student['alamat'] ?? '') . '",';
                $csv .= '"' . str_replace('"', '""', $student['domisili'] ?? '') . '",';
                $csv .= '"' . ($student['nama_ayah'] ?? '') . '",';
                $csv .= '"' . ($student['nama_ibu'] ?? '') . '",';
                $csv .= '"' . ($student['status'] === 'calon' ? 'Calon Siswa' : 'Siswa') . '",';
                $csv .= '"' . ($student['tahun_ajaran_nama'] ?? '') . '",';
                $csv .= '"' . date('d/m/Y', strtotime($student['created_at'])) . '"';
                $csv .= "\n";
            }

            $filename = 'rekap-siswa-' . date('Y-m-d') . '.csv';
            
            return $this->response
                ->setHeader('Content-Type', 'text/csv; charset=utf-8')
                ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->setHeader('Cache-Control', 'no-cache, must-revalidate')
                ->setBody($csv);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat export: ' . $e->getMessage());
        }
    }

    // Export PDF
    public function exportPdf()
    {
        $request = $this->request;
        $studentModel = new \App\Models\StudentModel();
        
        // Get filter parameters
        $filters = [
            'status' => $request->getGet('status'),
            'tahun_ajaran' => $request->getGet('tahun_ajaran'),
            'tanggal_dari' => $request->getGet('tanggal_dari'),
            'tanggal_sampai' => $request->getGet('tanggal_sampai'),
            'search' => $request->getGet('search')
        ];

        try {
            // Get all data without pagination for export
            $students = $studentModel->getStudentsWithRelations($filters)
                ->orderBy('students.created_at', 'DESC')
                ->get()
                ->getResultArray();

            $data = [
                'title' => 'Laporan Rekap Siswa',
                'students' => $students,
                'filters' => $filters,
                'generated_at' => date('d/m/Y H:i:s')
            ];

            // Generate HTML for PDF
            $html = view('admin/exports/pdf-rekap-siswa', $data);
            
            // For now, return HTML (you can integrate with TCPDF or MPDF later)
            return $this->response
                ->setHeader('Content-Type', 'text/html; charset=utf-8')
                ->setBody($html);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat export PDF: ' . $e->getMessage());
        }
    }

    // Helper method to create sample data for testing
    private function createSampleData()
    {
        try {
            $db = \Config\Database::connect();
            
            // Get active tahun ajaran
            $tahunAjaran = $db->table('tahun_ajaran')
                ->where('is_active', 1)
                ->get()
                ->getRow();
            
            if (!$tahunAjaran) {
                return; // No active tahun ajaran
            }
            
            $uuidService = service('uuid');
            
            // Create sample students
            $sampleStudents = [
                [
                    'id' => $uuidService->generate(),
                    'no_registrasi' => 'PPDB-2025-001',
                    'nama_lengkap' => 'Ahmad Fauzi Rahman',
                    'agama' => 'Islam',
                    'tempat_lahir' => 'Jakarta',
                    'tanggal_lahir' => '2018-05-15',
                    'jenis_kelamin' => 'L',
                    'nama_ayah' => 'Budi Rahman',
                    'nama_ibu' => 'Sari Dewi',
                    'alamat' => 'Jl. Merdeka No. 123, Jakarta Pusat',
                    'domisili' => 'Jl. Merdeka No. 123, Jakarta Pusat',
                    'nomor_telepon' => '081234567890',
                    'tahun_ajaran_id' => $tahunAjaran->id,
                    'status' => 'siswa',
                    'created_at' => date('Y-m-d H:i:s', strtotime('-1 month')),
                    'updated_at' => date('Y-m-d H:i:s', strtotime('-1 month')),
                ],
                [
                    'id' => $uuidService->generate(),
                    'no_registrasi' => 'PPDB-2025-002',
                    'nama_lengkap' => 'Siti Nurhaliza',
                    'agama' => 'Islam',
                    'tempat_lahir' => 'Bandung',
                    'tanggal_lahir' => '2018-03-20',
                    'jenis_kelamin' => 'P',
                    'nama_ayah' => 'Ahmad Rahman',
                    'nama_ibu' => 'Fatimah',
                    'alamat' => 'Jl. Sudirman No. 456, Bandung',
                    'domisili' => 'Jl. Sudirman No. 456, Bandung',
                    'nomor_telepon' => '081234567891',
                    'tahun_ajaran_id' => $tahunAjaran->id,
                    'status' => 'siswa',
                    'created_at' => date('Y-m-d H:i:s', strtotime('-3 weeks')),
                    'updated_at' => date('Y-m-d H:i:s', strtotime('-3 weeks')),
                ],
                [
                    'id' => $uuidService->generate(),
                    'no_registrasi' => 'PPDB-2025-003',
                    'nama_lengkap' => 'Muhammad Rizki Pratama',
                    'agama' => 'Islam',
                    'tempat_lahir' => 'Surabaya',
                    'tanggal_lahir' => '2018-07-10',
                    'jenis_kelamin' => 'L',
                    'nama_ayah' => 'Rizki Pratama Sr.',
                    'nama_ibu' => 'Indah Sari',
                    'alamat' => 'Jl. Pahlawan No. 789, Surabaya',
                    'domisili' => 'Jl. Pahlawan No. 789, Surabaya',
                    'nomor_telepon' => '081234567892',
                    'tahun_ajaran_id' => $tahunAjaran->id,
                    'status' => 'calon',
                    'created_at' => date('Y-m-d H:i:s', strtotime('-2 weeks')),
                    'updated_at' => date('Y-m-d H:i:s', strtotime('-2 weeks')),
                ],
                [
                    'id' => $uuidService->generate(),
                    'no_registrasi' => 'PPDB-2025-004',
                    'nama_lengkap' => 'Dewi Kirana Putri',
                    'agama' => 'Islam',
                    'tempat_lahir' => 'Yogyakarta',
                    'tanggal_lahir' => '2018-09-25',
                    'jenis_kelamin' => 'P',
                    'nama_ayah' => 'Bambang Sutrisno',
                    'nama_ibu' => 'Kirana Dewi',
                    'alamat' => 'Jl. Malioboro No. 321, Yogyakarta',
                    'domisili' => 'Jl. Malioboro No. 321, Yogyakarta',
                    'nomor_telepon' => '081234567893',
                    'tahun_ajaran_id' => $tahunAjaran->id,
                    'status' => 'calon',
                    'created_at' => date('Y-m-d H:i:s', strtotime('-1 week')),
                    'updated_at' => date('Y-m-d H:i:s', strtotime('-1 week')),
                ],
                [
                    'id' => $uuidService->generate(),
                    'no_registrasi' => 'PPDB-2025-005',
                    'nama_lengkap' => 'Arif Hidayat',
                    'agama' => 'Islam',
                    'tempat_lahir' => 'Medan',
                    'tanggal_lahir' => '2018-11-30',
                    'jenis_kelamin' => 'L',
                    'nama_ayah' => 'Hidayat Siregar',
                    'nama_ibu' => 'Rina Arif',
                    'alamat' => 'Jl. Medan Merdeka No. 555, Medan',
                    'domisili' => 'Jl. Medan Merdeka No. 555, Medan',
                    'nomor_telepon' => '081234567894',
                    'tahun_ajaran_id' => $tahunAjaran->id,
                    'status' => 'siswa',
                    'created_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
                    'updated_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
                ]
            ];
            
            $db->table('students')->insertBatch($sampleStudents);
        } catch (\Exception $e) {
            // Ignore errors when creating sample data
        }
    }

    public function settings()
    {
        $data = [
            'title' => 'Settings',
            'pageTitle' => 'Settings',
            'activeTab' => 'general',
            'settings' => $this->getSettings()
        ];

        return view('admin/settings', $data);
    }

    public function settingsBiaya()
    {
        $data = [
            'title' => 'Pengaturan Biaya',
            'pageTitle' => 'Pengaturan Biaya',
            'activeTab' => 'biaya',
            'biaya' => $this->getBiayaSettings(),
            'biaya_tambahan' => $this->getBiayaTambahan()
        ];

        return view('admin/settings-biaya', $data);
    }

    public function settingsPendaftaran()
    {
        $data = [
            'title' => 'Pengaturan Pendaftaran',
            'pageTitle' => 'Pengaturan Pendaftaran',
            'activeTab' => 'pendaftaran',
            'settings' => $this->getPendaftaranSettings()
        ];

        return view('admin/settings-pendaftaran', $data);
    }

    public function profile()
    {
        $data = [
            'title' => 'Profile Admin',
            'pageTitle' => 'Profile',
            'admin' => $this->getAdminProfile(),
            'activities' => $this->getAdminActivities()
        ];

        return view('admin/profile', $data);
    }

    // Helper methods - replace with actual database queries
    
    private function getTotalPendaftar($search = null, $status = null, $tanggal = null)
    {
        // Mock data - replace with actual database query
        return 125;
    }

    private function getPendaftarDiterima()
    {
        // Mock data - replace with actual database query
        return 98;
    }

    private function getMenungguVerifikasi()
    {
        // Mock data - replace with actual database query
        return 15;
    }

    private function getKuotaTersisa()
    {
        // Mock data - replace with actual database query
        return 25;
    }

    private function getTotalKuota()
    {
        // Mock data - replace with actual database query
        return 150;
    }

    private function getPendaftarTerbaru()
    {
        // Mock data - replace with actual database query
        return [
            [
                'id' => 1,
                'no_registrasi' => 'PPDB-2025-0001',
                'nama_lengkap' => 'Ahmad Fauzi',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))
            ],
            [
                'id' => 2,
                'no_registrasi' => 'PPDB-2025-0002',
                'nama_lengkap' => 'Siti Nurhaliza',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'diterima',
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 hours'))
            ],
            [
                'id' => 3,
                'no_registrasi' => 'PPDB-2025-0003',
                'nama_lengkap' => 'Muhammad Rizki',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 hours'))
            ]
        ];
    }

    private function getPendaftar($search, $status, $tanggal, $page, $perPage)
    {
        // Mock data - replace with actual database query
        return [
            [
                'id' => 1,
                'no_registrasi' => 'PPDB-2025-0001',
                'nama_lengkap' => 'Ahmad Fauzi',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2018-05-15',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta Pusat',
                'nama_ayah' => 'Budi Santoso',
                'nama_ibu' => 'Sari Dewi',
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'id' => 2,
                'no_registrasi' => 'PPDB-2025-0002',
                'nama_lengkap' => 'Siti Nurhaliza',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2018-03-20',
                'alamat' => 'Jl. Sudirman No. 456, Bandung',
                'nama_ayah' => 'Ahmad Rahman',
                'nama_ibu' => 'Fatimah',
                'status' => 'diterima',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))
            ]
        ];
    }

    private function getSummaryData($tahunAjaran, $tanggalDari, $tanggalSampai, $status)
    {
        // Mock data - replace with actual database query
        return [
            'total_pendaftar' => 125,
            'diterima' => 98,
            'pending' => 15,
            'ditolak' => 12,
            'laki_laki' => 65,
            'perempuan' => 60
        ];
    }

    private function getSiswaDetail($tahunAjaran, $tanggalDari, $tanggalSampai, $status)
    {
        // Mock data - replace with actual database query
        return $this->getPendaftar(null, $status, null, 1, 100);
    }

    private function getChartData($tahunAjaran)
    {
        // Mock data - replace with actual database query
        return [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            'data' => [10, 25, 30, 45, 60, 40]
        ];
    }

    private function getSettings()
    {
        // Mock data - replace with actual database query
        return [
            'nama_sekolah' => 'SD Nahdlatul Ulama',
            'alamat_sekolah' => 'Jl. Pendidikan No. 123, Jakarta',
            'telepon' => '021-1234567',
            'email' => 'info@sdnu.ac.id',
            'website' => 'https://sdnu.ac.id',
            'logo' => '',
            'deskripsi' => 'SD Nahdlatul Ulama adalah sekolah yang mengutamakan pendidikan karakter dan akhlak mulia.',
            'tahun_ajaran_aktif' => '2025/2026',
            'max_kuota' => 150,
            'auto_approve' => 0,
            'timezone' => 'Asia/Jakarta',
            'format_no_reg' => 'PPDB-{YYYY}-{NNNN}',
            'email_notification' => 1
        ];
    }

    private function getBiayaSettings()
    {
        // Mock data - replace with actual database query
        return [
            'biaya_formulir' => 50000,
            'uang_pangkal' => 2000000,
            'biaya_seragam' => 500000,
            'biaya_buku' => 300000,
            'spp_kelas_1' => 200000,
            'spp_kelas_2' => 220000,
            'spp_kelas_3' => 240000,
            'spp_kelas_4' => 260000,
            'spp_kelas_5' => 280000,
            'spp_kelas_6' => 300000
        ];
    }

    private function getBiayaTambahan()
    {
        // Mock data - replace with actual database query
        return [
            ['nama' => 'Ekstrakurikuler', 'jumlah' => 100000],
            ['nama' => 'Study Tour', 'jumlah' => 300000]
        ];
    }

    private function getPendaftaranSettings()
    {
        // Mock data - replace with actual database query
        return [
            'tanggal_buka' => '2025-01-01',
            'tanggal_tutup' => '2025-06-30',
            'jam_buka' => '08:00',
            'jam_tutup' => '16:00',
            'hari_libur' => ['minggu'],
            'min_umur' => 6,
            'max_umur' => 7,
            'persyaratan' => 'Fotokopi akte kelahiran, Fotokopi KK, Pas foto 3x4'
        ];
    }

    private function getAdminProfile()
    {
        // Mock data - replace with actual database query
        return [
            'nama' => 'Administrator',
            'email' => 'admin@sdnu.ac.id',
            'telepon' => '081234567890',
            'jabatan' => 'Admin PPDB',
            'alamat' => 'Jakarta',
            'foto' => '',
            'last_login' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s', strtotime('-6 months'))
        ];
    }

    private function getAdminActivities()
    {
        // Mock data - replace with actual database query
        return [
            [
                'action' => 'Login ke sistem',
                'description' => 'Berhasil login ke dashboard admin',
                'icon' => 'sign-in-alt',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 hour'))
            ],
            [
                'action' => 'Update pengaturan',
                'description' => 'Mengubah pengaturan biaya sekolah',
                'icon' => 'cogs',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))
            ],
            [
                'action' => 'Verifikasi pendaftar',
                'description' => 'Menerima 5 pendaftar baru',
                'icon' => 'check-circle',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 hours'))
            ]
        ];
    }

    private function getStatusPendaftaran()
    {
        $settings = $this->getPendaftaranSettings();
        $sekarang = date('Y-m-d');
        $tanggalBuka = $settings['tanggal_buka'] ?? '2025-01-01';
        $tanggalTutup = $settings['tanggal_tutup'] ?? '2025-06-30';
        
        if ($sekarang < $tanggalBuka) {
            return "Pendaftaran belum dibuka (akan dibuka pada " . date('d M Y', strtotime($tanggalBuka)) . ")";
        } elseif ($sekarang > $tanggalTutup) {
            return "Pendaftaran sudah ditutup (ditutup pada " . date('d M Y', strtotime($tanggalTutup)) . ")";
        } else {
            return "Pendaftaran sedang dibuka (sampai " . date('d M Y', strtotime($tanggalTutup)) . ")";
        }
    }

    // =========================================
    // API Methods for Tahun Ajaran
    // =========================================

    public function getTahunAjaran()
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        try {
            $data = $tahunAjaranModel->orderBy('tahun_mulai', 'DESC')->findAll();
            
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Gagal mengambil data tahun ajaran: ' . $e->getMessage()
            ]);
        }
    }

    public function storeTahunAjaran()
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        $data = [
            'nama' => $this->request->getPost('nama'),
            'tahun_mulai' => $this->request->getPost('tahun_mulai'),
            'tahun_selesai' => $this->request->getPost('tahun_selesai'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'tanggal_mulai_pendaftaran' => $this->request->getPost('tanggal_mulai_pendaftaran'),
            'tanggal_selesai_pendaftaran' => $this->request->getPost('tanggal_selesai_pendaftaran'),
            'kuota_maksimal' => $this->request->getPost('kuota_maksimal'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        try {
            if ($tahunAjaranModel->insert($data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Tahun ajaran berhasil ditambahkan'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan tahun ajaran',
                    'errors' => $tahunAjaranModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function updateTahunAjaran($id)
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        $data = [
            'nama' => $this->request->getRawInput()['nama'] ?? $this->request->getPost('nama'),
            'tahun_mulai' => $this->request->getRawInput()['tahun_mulai'] ?? $this->request->getPost('tahun_mulai'),
            'tahun_selesai' => $this->request->getRawInput()['tahun_selesai'] ?? $this->request->getPost('tahun_selesai'),
            'is_active' => ($this->request->getRawInput()['is_active'] ?? $this->request->getPost('is_active')) ? 1 : 0,
            'tanggal_mulai_pendaftaran' => $this->request->getRawInput()['tanggal_mulai_pendaftaran'] ?? $this->request->getPost('tanggal_mulai_pendaftaran'),
            'tanggal_selesai_pendaftaran' => $this->request->getRawInput()['tanggal_selesai_pendaftaran'] ?? $this->request->getPost('tanggal_selesai_pendaftaran'),
            'kuota_maksimal' => $this->request->getRawInput()['kuota_maksimal'] ?? $this->request->getPost('kuota_maksimal'),
            'deskripsi' => $this->request->getRawInput()['deskripsi'] ?? $this->request->getPost('deskripsi')
        ];

        try {
            if ($tahunAjaranModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Tahun ajaran berhasil diperbarui'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui tahun ajaran',
                    'errors' => $tahunAjaranModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteTahunAjaran($id)
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        try {
            // Check if there are students using this tahun ajaran
            $studentCount = $this->db->table('students')->where('tahun_ajaran_id', $id)->countAllResults();
            
            if ($studentCount > 0) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => "Tidak dapat menghapus tahun ajaran karena masih ada $studentCount siswa yang terdaftar"
                ]);
            }

            if ($tahunAjaranModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Tahun ajaran berhasil dihapus'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus tahun ajaran'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function activateTahunAjaran($id)
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        try {
            if ($tahunAjaranModel->activate($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Tahun ajaran berhasil diaktifkan'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengaktifkan tahun ajaran'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // =========================================
    // API Methods for Beasiswa
    // =========================================

    public function getBeasiswa()
    {
        $beasiswaModel = new \App\Models\BeasiswaModel();
        
        try {
            $data = $beasiswaModel->orderBy('nama', 'ASC')->findAll();
            
            // Add usage count for each beasiswa
            foreach ($data as &$item) {
                $item['usage_count'] = $beasiswaModel->getUsageCount($item['id']);
                $item['can_delete'] = $item['usage_count'] == 0;
            }
            
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Gagal mengambil data beasiswa: ' . $e->getMessage()
            ]);
        }
    }

    public function storeBeasiswa()
    {
        $beasiswaModel = new \App\Models\BeasiswaModel();
        
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jenis' => $this->request->getPost('jenis'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'syarat' => $this->request->getPost('syarat'),
            'besaran_rupiah' => $this->request->getPost('besaran_rupiah'),
            'besaran_persen' => $this->request->getPost('besaran_persen'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'kuota' => $this->request->getPost('kuota'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai')
        ];

        try {
            if ($beasiswaModel->insert($data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Beasiswa berhasil ditambahkan'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan beasiswa',
                    'errors' => $beasiswaModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function updateBeasiswa($id)
    {
        $beasiswaModel = new \App\Models\BeasiswaModel();
        
        $data = [
            'nama' => $this->request->getRawInput()['nama'] ?? $this->request->getPost('nama'),
            'jenis' => $this->request->getRawInput()['jenis'] ?? $this->request->getPost('jenis'),
            'deskripsi' => $this->request->getRawInput()['deskripsi'] ?? $this->request->getPost('deskripsi'),
            'syarat' => $this->request->getRawInput()['syarat'] ?? $this->request->getPost('syarat'),
            'besaran_rupiah' => $this->request->getRawInput()['besaran_rupiah'] ?? $this->request->getPost('besaran_rupiah'),
            'besaran_persen' => $this->request->getRawInput()['besaran_persen'] ?? $this->request->getPost('besaran_persen'),
            'is_active' => ($this->request->getRawInput()['is_active'] ?? $this->request->getPost('is_active')) ? 1 : 0,
            'kuota' => $this->request->getRawInput()['kuota'] ?? $this->request->getPost('kuota'),
            'tanggal_mulai' => $this->request->getRawInput()['tanggal_mulai'] ?? $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getRawInput()['tanggal_selesai'] ?? $this->request->getPost('tanggal_selesai')
        ];

        try {
            if ($beasiswaModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Beasiswa berhasil diperbarui'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui beasiswa',
                    'errors' => $beasiswaModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteBeasiswa($id)
    {
        $beasiswaModel = new \App\Models\BeasiswaModel();
        
        try {
            // Check if there are students using this beasiswa
            $studentCount = $beasiswaModel->getUsageCount($id);
            
            if ($studentCount > 0) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => "Tidak dapat menghapus beasiswa karena masih ada $studentCount siswa yang menggunakannya"
                ]);
            }

            if ($beasiswaModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Beasiswa berhasil dihapus'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus beasiswa'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function daftarUlang()
    {
        $data = [
            'title' => 'Daftar Ulang Siswa',
            'pageTitle' => 'Daftar Ulang Siswa',
            'siswa' => $this->getSiswaDaftarUlang()
        ];

        return view('admin/daftar-ulang', $data);
    }

    private function getSiswaDaftarUlang()
    {
        // Static data for demonstration
        return [
            [
                'id' => '1',
                'nama' => 'Ahmad Rizki',
                'nisn' => '1234567890',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2015-05-15',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta',
                'nama_ayah' => 'Budi Santoso',
                'nama_ibu' => 'Siti Nurhaliza',
                'status_pembayaran' => 'Belum Bayar',
                'jumlah_bayar' => 0,
                'total_bayar' => 2500000,
                'tanggal_bayar' => null,
                'status_wawancara' => 'Belum Wawancara',
                'catatan_wawancara' => '',
                'tanggal_wawancara' => null
            ],
            [
                'id' => '2',
                'nama' => 'Sari Dewi',
                'nisn' => '1234567891',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2015-03-20',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Pahlawan No. 456, Surabaya',
                'nama_ayah' => 'Joko Widodo',
                'nama_ibu' => 'Ani Susanti',
                'status_pembayaran' => 'Lunas',
                'jumlah_bayar' => 2500000,
                'total_bayar' => 2500000,
                'tanggal_bayar' => '2025-08-15',
                'status_wawancara' => 'Sudah Wawancara',
                'catatan_wawancara' => 'Anak cerdas, komunikatif, dan siap mengikuti pembelajaran di SD NU.',
                'tanggal_wawancara' => '2025-08-20'
            ],
            [
                'id' => '3',
                'nama' => 'Muhammad Fajar',
                'nisn' => '1234567892',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2015-07-10',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Asia Afrika No. 789, Bandung',
                'nama_ayah' => 'Agus Setiawan',
                'nama_ibu' => 'Rina Marlina',
                'status_pembayaran' => 'Cicilan',
                'jumlah_bayar' => 1500000,
                'total_bayar' => 2500000,
                'tanggal_bayar' => '2025-08-10',
                'status_wawancara' => 'Belum Wawancara',
                'catatan_wawancara' => '',
                'tanggal_wawancara' => null
            ]
        ];
    }
}
