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
        $request = $this->request;
        
        // Get filter parameters
        $tahunAjaran = $request->getGet('tahun_ajaran');
        $tanggalDari = $request->getGet('tanggal_dari');
        $tanggalSampai = $request->getGet('tanggal_sampai');
        $status = $request->getGet('status');

        $data = [
            'title' => 'Rekap Siswa',
            'pageTitle' => 'Rekap Siswa',
            'summary' => $this->getSummaryData($tahunAjaran, $tanggalDari, $tanggalSampai, $status),
            'siswa_detail' => $this->getSiswaDetail($tahunAjaran, $tanggalDari, $tanggalSampai, $status),
            'chart_bulan' => $this->getChartData($tahunAjaran),
            'tahun_ajaran' => $tahunAjaran,
            'tanggal_dari' => $tanggalDari,
            'tanggal_sampai' => $tanggalSampai,
            'status' => $status
        ];

        return view('admin/rekap-siswa', $data);
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
}
