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
    
    public function index()  {
    // Ambil pengumuman aktif
    $pengumuman = $this->pengumumanModel->getActivePengumuman();

    // Ambil semua tahun ajaran
    $tahunAjaranList = $this->tahunAjaranModel->findAll();

    // Ambil tahun ajaran berdasarkan tahun sekarang
    $currentYear = date('Y');
    $tahunAjaranNow = $this->tahunAjaranModel
        ->where('tahun_mulai', $currentYear)
        ->first();

    $selectedTahunAjaran = $tahunAjaranNow['id'] ?? null;

    // Ambil daftar siswa berdasarkan tahun ajaran sekarang
    $siswaQuery = $this->studentModel
        ->where('status', 'siswa')
        ->where('deleted_at IS NULL', null, false);

    if ($selectedTahunAjaran) {
        $siswaQuery->where('tahun_ajaran_id', $selectedTahunAjaran);
    }

    $siswaList = $siswaQuery->findAll();

    $data = [
        'title'                => 'Pengumuman PPDB - SDNU Pemanahan',
        'pengumuman'           => $pengumuman,
        'tahun_ajaran_list'    => $tahunAjaranList,
        'selected_tahun_ajaran'=> $selectedTahunAjaran,
        'siswa_list'           => $siswaList,
    ];

    return view('ppdb/pengumuman', $data);
    }
}
