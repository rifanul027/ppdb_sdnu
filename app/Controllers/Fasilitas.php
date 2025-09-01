<?php

namespace App\Controllers;

class Fasilitas extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Fasilitas Sekolah - SDNU Pemanahan'
        ];
        
        return view('fasilitas/index', $data);
    }
}
