<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\TahunAjaranModel;
use App\Models\PengumumanModel;
use App\Libraries\UuidService;

class PengumumanSiswa extends BaseController
{
    protected $studentModel;
    protected $tahunAjaranModel;
    protected $pembayaranModel;
    protected $userModel;
    
    public function __construct() {
        $this->studentModel = new StudentModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->pengumumanModel = new PengumumanModel();
    }
    
    public function index() {
        $pengumuman = $this->pengumumanModel->getActivePengumuman();

        $tahun_ajaran_list = $this->tahunAjaranModel->findAll();

        // Ambil tahun ajaran aktif sebagai default jika tidak ada filter
        $selected_tahun_ajaran = $this->request->getGet('tahun_ajaran');
        if (!$selected_tahun_ajaran) {
            $activeTahunAjaran = $this->tahunAjaranModel->getActive();
            $selected_tahun_ajaran = $activeTahunAjaran ? $activeTahunAjaran['id'] : null;
        }

        $siswaQuery = $this->studentModel->where('status', 'siswa')->where('deleted_at', null);
        if ($selected_tahun_ajaran) {
            $siswaQuery->where('tahun_ajaran_id', $selected_tahun_ajaran);
        }
        $siswa_list = $siswaQuery->findAll();

        $data = [
            'title' => 'Pengumuman PPDB - SDNU Pemanahan',
            'pengumuman' => $pengumuman,
            'tahun_ajaran_list' => $tahun_ajaran_list,
            'selected_tahun_ajaran' => $selected_tahun_ajaran,
            'siswa_list' => $siswa_list,
        ];

        return view('ppdb/pengumuman', $data);
    }
    
}
