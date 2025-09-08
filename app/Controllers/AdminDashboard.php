<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;

class AdminDashboard extends BaseController
{
    protected $studentModel;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->studentModel = new StudentModel();

    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'pageTitle' => 'Dashboard Admin',
            'totalSiswa' => $this->getTotalSiswa(),
            'totalPendaftar' => $this->getTotalPendaftar(),
            'pendaftarTerbaru' => $this->getPendaftarTerbaru()
        ];

        return view('admin/dashboard/index', $data);
    }

    private function getTotalSiswa()
    {
        return $this->studentModel
            ->where('status', 'siswa')
            ->where('deleted_at', null)
            ->countAllResults();
    }

    private function getTotalPendaftar()
    {
        return $this->studentModel
            ->where('status', 'calon')
            ->where('deleted_at', null)
            ->countAllResults();
    }

    private function getPendaftarTerbaru()
    {
        return $this->studentModel
            ->select('id, no_registrasi, nama_lengkap, jenis_kelamin, created_at, status')
            ->where('deleted_at', null)
            ->where('status', 'calon')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();
    }

    public function settings()
    {
        return redirect()->to('/admin/settings');
    }

    public function lihatPendaftar()
    {
        return redirect()->to('/admin/pendaftar');
    }

    public function lihatDaftarUlang()
    {
        return redirect()->to('/admin/daftar-ulang');
    }

    public function lihatSiswa()
    {
        return redirect()->to('/admin/siswa');
    }
}
