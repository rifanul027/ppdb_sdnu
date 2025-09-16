<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\GelombangPendaftaranModel;

class CekGelombang implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $gelombangPendaftaranModel = new GelombangPendaftaranModel();
        $today = date('Y-m-d');

        // cari gelombang aktif
        $gelombang = $gelombangPendaftaranModel
            ->where('tanggal_mulai <=', $today)
            ->where('tanggal_selesai >=', $today)
            ->first();

        if (!$gelombang) {
            return redirect()->to('/pendaftaran-belum-dibuka') // atau halaman custom
                             ->with('error', 'Belum ada gelombang pendaftaran aktif.');
        }

        // bisa juga simpan ke session supaya tidak query ulang
        session()->set('gelombang_aktif', $gelombang);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing
    }
}
