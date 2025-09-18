<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\TahunAjaranModel;
use App\Models\PengumumanModel;

class PengumumanSiswa extends BaseController
{
    protected $studentModel;
    protected $tahunAjaranModel;
    protected $pengumumanModel;
    
    public function __construct() {
        $this->studentModel     = new StudentModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->pengumumanModel  = new PengumumanModel();
    }
    
    public function index() {
        // Ambil pengumuman aktif
        $pengumuman = $this->pengumumanModel->getActivePengumuman();

        // Ambil tahun ajaran yang aktif
        $tahunAjaranNow = $this->tahunAjaranModel->getActive(); // pastikan method ini return row aktif

        $selectedTahunAjaran = $tahunAjaranNow['id'] ?? null;

        // Ambil semua tahun ajaran untuk dropdown/filter jika diperlukan
        $tahunAjaranList = $this->tahunAjaranModel->findAll();

        // Ambil daftar siswa berdasarkan tahun ajaran aktif
        $siswaQuery = $this->studentModel
            ->where('status', 'siswa')
            ->where('deleted_at IS NULL', null, false);

        if ($selectedTahunAjaran) {
            $siswaQuery->where('tahun_ajaran_id', $selectedTahunAjaran);
        }

        $siswaList = $siswaQuery->findAll();

        $data = [
            'title'                 => 'Pengumuman PPDB - SDNU Pemanahan',
            'pengumuman'            => $pengumuman,
            'tahun_ajaran_list'     => $tahunAjaranList,
            'selected_tahun_ajaran' => $selectedTahunAjaran,
            'siswa_list'            => $siswaList,
        ];

        return view('ppdb/pengumuman', $data);
    }
}
