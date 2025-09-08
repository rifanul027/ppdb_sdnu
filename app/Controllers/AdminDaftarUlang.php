<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\PembayaranModel;

class AdminDaftarUlang extends BaseController
{
    protected $studentModel;
    protected $pembayaranModel;
    
    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->pembayaranModel = new PembayaranModel();
        helper('uuid');
    }
    
    public function index()
    {
        // Get students who are accepted (accepted_at not null) with status 'calon' and no payment yet
        $siswa = $this->studentModel
            ->where('accepted_at IS NOT NULL')
            ->where('status', 'calon')
            ->where('deleted_at', null)
            ->where('bukti_pembayaran_id', null)
            ->findAll();
        
        $data = [
            'pageTitle' => 'Daftar Ulang Siswa',
            'siswa' => $siswa
        ];
        
        return view('admin/daftar-ulang/index', $data);
    }
    
    public function detail($id)
    {
        $siswa = $this->studentModel->find($id);
        
        if (!$siswa) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data siswa tidak ditemukan'
            ])->setStatusCode(404);
        }
        
        return $this->response->setJSON([
            'status' => 'success',
            'data' => $siswa
        ]);
    }
    
    public function konfirmasiPembayaran()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }
        
        $validation = \Config\Services::validation();
        
        $rules = [
            'student_id' => 'required',
            'nama_pembayar' => 'required|min_length[3]',
            'metode' => 'required|in_list[Transfer Bank,Tunai,QRIS]',
            'bukti_pembayaran' => 'uploaded[bukti_pembayaran]|is_image[bukti_pembayaran]|max_size[bukti_pembayaran,2048]'
        ];
        
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ])->setStatusCode(400);
        }
        
        $studentId = $this->request->getPost('student_id');
        $buktiFile = $this->request->getFile('bukti_pembayaran');
        
        // Check if student exists and eligible for payment
        $siswa = $this->studentModel
            ->where('id', $studentId)
            ->where('accepted_at IS NOT NULL')
            ->where('status', 'calon')
            ->where('bukti_pembayaran_id', null)
            ->first();
        
        if (!$siswa) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data siswa tidak valid atau sudah memiliki pembayaran'
            ])->setStatusCode(400);
        }
        
        try {
            // Create payment record
            $paymentId = $this->pembayaranModel->createPayment($studentId, [
                'nama_pembayar' => $this->request->getPost('nama_pembayar'),
                'metode' => $this->request->getPost('metode')
            ], $buktiFile);
            
            // Update student with payment ID
            $this->studentModel->update($studentId, [
                'bukti_pembayaran_id' => $paymentId
            ]);
            
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Pembayaran berhasil dikonfirmasi'
            ]);
            
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal memproses pembayaran: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
