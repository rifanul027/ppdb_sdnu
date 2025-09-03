<?php

namespace App\Controllers;

class Ppdb extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Info PPDB 2025/2026 - SDNU Pemanahan'
        ];
        
        return view('ppdb/info', $data);
    }
    
    public function daftar()
    {
        $data = [
            'title' => 'Pendaftaran Online - PPDB SDNU Pemanahan'
        ];
        
        return view('ppdb/daftar', $data);
    }
    
    public function syarat()
    {
        $data = [
            'title' => 'Syarat Pendaftaran - PPDB SDNU Pemanahan'
        ];
        
        return view('ppdb/syarat', $data);
    }
    
    public function jadwal()
    {
        $data = [
            'title' => 'Jadwal Seleksi - PPDB SDNU Pemanahan'
        ];
        
        return view('ppdb/jadwal', $data);
    }
    
    public function biaya()
    {
        $data = [
            'title' => 'Biaya Pendidikan - PPDB SDNU Pemanahan'
        ];
        
        return view('ppdb/biaya', $data);
    }
    
    public function pengumuman()
    {
        $pengumumanModel = new \App\Models\PengumumanModel();
        
        $data = [
            'title' => 'Pengumuman PPDB - SDNU Pemanahan',
            'pengumuman' => $pengumumanModel->getActivePengumuman(),
            'totalPengumuman' => $pengumumanModel->getTotalActivePengumuman()
        ];
        
        return view('ppdb/pengumuman', $data);
    }
    public function login()
    {
        $data = [
            'title' => 'login PPDB- SDNU Pemanahan'
        ];
        
        return view('ppdb/login', $data);
    }
    public function register()
    {
        $data = [
            'title' => 'register PPDB- SDNU Pemanahan'
        ];
        return view('ppdb/register');
    }
}
