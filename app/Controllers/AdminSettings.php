<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SettingsController extends BaseController
{
    public function __construct()
    {
        // Check if user is logged in as admin
        if (!session()->get('isAdmin')) {
            throw new \CodeIgniter\Router\Exceptions\RedirectException('/auth/login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Pengaturan Tahun Ajaran',
            'pageTitle' => 'Pengaturan Tahun Ajaran'
        ];

        return view('admin/settings/index', $data);
    }

    // =========================================
    // API Methods for Tahun Ajaran
    // =========================================

    public function getTahunAjaran()
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        try {
            $data = $tahunAjaranModel->orderBy('tahun_mulai', 'DESC')->findAll();
            
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Gagal mengambil data tahun ajaran: ' . $e->getMessage()
            ]);
        }
    }

    public function storeTahunAjaran()
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        // Mendapatkan data dari JSON input
        $rawInput = $this->request->getJSON(true);
        
        // Handle both JSON and form data
        if (!$rawInput) {
            $rawInput = $this->request->getPost();
        }
        
        $uuidService = new \App\Libraries\UuidService();
        $data = [
            'id' => $uuidService->generate(),
            'nama' => $rawInput['nama'] ?? '',
            'tahun_mulai' => (int)($rawInput['tahun_mulai'] ?? 0),
            'tahun_selesai' => (int)($rawInput['tahun_selesai'] ?? 0),
            'deskripsi' => $rawInput['deskripsi'] ?? '',
            'is_active' => 0 // Default inactive
        ];

        try {
            if ($tahunAjaranModel->insert($data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Tahun ajaran berhasil ditambahkan'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan tahun ajaran',
                    'errors' => $tahunAjaranModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function updateTahunAjaran($id)
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        // Mendapatkan data dari JSON input
        $rawInput = $this->request->getJSON(true);
        
        // Handle both PUT and POST methods
        if (!$rawInput) {
            $rawInput = $this->request->getPost();
        }
        
        $data = [
            'nama' => $rawInput['nama'] ?? '',
            'tahun_mulai' => (int)($rawInput['tahun_mulai'] ?? 0),
            'tahun_selesai' => (int)($rawInput['tahun_selesai'] ?? 0),
            'deskripsi' => $rawInput['deskripsi'] ?? ''
        ];

        try {
            if ($tahunAjaranModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Tahun ajaran berhasil diperbarui'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui tahun ajaran',
                    'errors' => $tahunAjaranModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteTahunAjaran($id)
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        try {
            // Check if this tahun ajaran is being used by students
            $studentModel = new \App\Models\StudentModel();
            $studentCount = $studentModel->where('tahun_ajaran_id', $id)->countAllResults();
            
            if ($studentCount > 0) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => "Tidak dapat menghapus tahun ajaran karena masih ada $studentCount siswa yang terdaftar"
                ]);
            }

            if ($tahunAjaranModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Tahun ajaran berhasil dihapus'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus tahun ajaran'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function activateTahunAjaran($id)
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        try {
            // Mendapatkan data dari JSON input
            $rawInput = $this->request->getJSON(true);
            
            // Handle both JSON and form data
            if (!$rawInput) {
                $rawInput = $this->request->getPost();
            }
            
            $is_active = $rawInput['is_active'] ?? 1;
            
            if ($is_active == 1) {
                // Jika mengaktifkan, nonaktifkan yang lain terlebih dahulu
                $tahunAjaranModel->where('is_active', 1)->set(['is_active' => 0])->update();
            }
            
            // Update status tahun ajaran yang dipilih
            if ($tahunAjaranModel->update($id, ['is_active' => $is_active])) {
                $message = $is_active == 1 ? 'Tahun ajaran berhasil diaktifkan' : 'Tahun ajaran berhasil dinonaktifkan';
                return $this->response->setJSON([
                    'success' => true,
                    'message' => $message
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengubah status tahun ajaran'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
