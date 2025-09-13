<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\PembayaranModel;
use App\Models\TahunAjaranModel;

class AdminDaftarUlang extends BaseController
{
    protected $studentModel;
    protected $pembayaranModel;
    protected $tahunAjaranModel;
    
    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
        helper('uuid');
    }
    
    public function index()
    {
        $currentYear = date('Y');
        $selectedYear = $this->request->getGet('tahun_mulai') ?? $currentYear;
        $acceptedFilter = $this->request->getGet('accepted_filter') ?? 'all';
        
        // Get all tahun ajaran for filter dropdown
        $tahunAjaranList = $this->tahunAjaranModel->findAll();
        
        // Build query for students with joined data
        $builder = $this->studentModel->db->table('students s');
        $builder->select('s.*, ta.nama as tahun_ajaran_nama, ta.tahun_mulai, p.accepted_at as pembayaran_accepted_at, p.bukti_url, p.metode as pembayaran_metode, p.nama as nama_pembayar');
        $builder->join('tahun_ajaran ta', 's.tahun_ajaran_id = ta.id', 'left');
        $builder->join('pembayaran p', 's.bukti_pembayaran_id = p.id', 'left');
        $builder->where('s.accepted_at IS NOT NULL');
        $builder->where('s.status', 'calon');
        $builder->where('s.deleted_at', null);
        $builder->where('ta.tahun_mulai', $selectedYear);
        
        // Apply accepted filter
        if ($acceptedFilter === 'validated') {
            $builder->where('p.accepted_at IS NOT NULL');
        } elseif ($acceptedFilter === 'not_validated') {
            $builder->where('p.accepted_at IS NULL');
        }
        
        // Get data first, then sort in PHP to avoid SQL syntax issues
        $rawData = $builder->get()->getResultArray();
        
        // Sort in PHP: payments first (ordered by ID), then no payments
        usort($rawData, function($a, $b) {
            // If both have payments, sort by payment ID
            if ($a['bukti_pembayaran_id'] && $b['bukti_pembayaran_id']) {
                return strcmp($a['bukti_pembayaran_id'], $b['bukti_pembayaran_id']);
            }
            // If only one has payment, payment comes first
            if ($a['bukti_pembayaran_id'] && !$b['bukti_pembayaran_id']) {
                return -1;
            }
            if (!$a['bukti_pembayaran_id'] && $b['bukti_pembayaran_id']) {
                return 1;
            }
            // If neither has payment, sort by student name
            return strcmp($a['nama_lengkap'], $b['nama_lengkap']);
        });
        
        $siswa = $rawData;
        
        $data = [
            'pageTitle' => 'Daftar Ulang Siswa',
            'siswa' => $siswa,
            'tahunAjaranList' => $tahunAjaranList,
            'selectedYear' => $selectedYear,
            'acceptedFilter' => $acceptedFilter
        ];
        
        return view('admin/daftar-ulang/index', $data);
    }
    
    public function detail($id)
    {
        $builder = $this->studentModel->db->table('students s');
        $builder->select('s.*, ta.nama as tahun_ajaran_nama, ta.tahun_mulai, p.accepted_at as pembayaran_accepted_at, p.bukti_url, p.metode as pembayaran_metode, p.nama as nama_pembayar, p.created_at as pembayaran_created_at');
        $builder->join('tahun_ajaran ta', 's.tahun_ajaran_id = ta.id', 'left');
        $builder->join('pembayaran p', 's.bukti_pembayaran_id = p.id', 'left');
        $builder->where('s.id', $id);
        
        $siswa = $builder->get()->getRowArray();
        
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
    
    public function validasiPembayaran()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $studentId = $this->request->getPost('student_id');

        if (!$studentId) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Student ID tidak valid'
            ])->setStatusCode(400);
        }

        // Check if student exists and has payment
        $builder = $this->studentModel->db->table('students s');
        $builder->select('s.*, p.id as payment_id, p.accepted_at');
        $builder->join('pembayaran p', 's.bukti_pembayaran_id = p.id', 'inner');
        $builder->where('s.id', $studentId);

        $siswa = $builder->get()->getRowArray();

        if (!$siswa) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data siswa atau pembayaran tidak ditemukan'
            ])->setStatusCode(400);
        }

        if ($siswa['accepted_at']) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pembayaran sudah divalidasi sebelumnya'
            ])->setStatusCode(400);
        }

        try {
            // Update accepted_at di table pembayaran
            $this->pembayaranModel->update($siswa['payment_id'], [
                'accepted_at' => date('Y-m-d H:i:s')
            ]);
            // Update status di table students menjadi 'siswa'
            $this->studentModel->update($studentId, [
                'status' => 'siswa'
            ]);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Pembayaran berhasil divalidasi dan status siswa diperbarui'
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal memvalidasi pembayaran: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
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
            'metode' => 'required|in_list[transfer,cash]',
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
