<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TahunAjaranModel;
use App\Models\KategoriModel;
use App\Models\GelombangPendaftaranModel;

class AdminSettings extends BaseController
{
    protected $tahunAjaranModel;
    protected $kategoriModel;
    protected $gelombangModel;

    public function __construct()
    {
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->kategoriModel = new KategoriModel();
        $this->gelombangModel = new GelombangPendaftaranModel();
        helper(['uuid', 'form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Pengaturan PPDB',
            'pageTitle' => 'Pengaturan PPDB'
        ];

        return view('admin/settings/index', $data);
    }

    // =========================================
    // API Methods for Tahun Ajaran
    // =========================================

    public function getTahunAjaran()
    {
        try {
            $data = $this->tahunAjaranModel->orderBy('tahun_mulai', 'DESC')->findAll();
            
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
        // Mendapatkan data dari JSON input
        $rawInput = $this->request->getJSON(true);
        
        // Handle both JSON and form data
        if (!$rawInput) {
            $rawInput = $this->request->getPost();
        }

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]|max_length[100]',
            'tahun_mulai' => 'required|integer|min_length[4]|max_length[4]',
            'tahun_selesai' => 'required|integer|min_length[4]|max_length[4]',
            'deskripsi' => 'permit_empty|max_length[500]'
        ]);

        if (!$validation->run($rawInput)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validation->getErrors()
            ]);
        }

        // Validasi logika tahun
        if ($rawInput['tahun_selesai'] <= $rawInput['tahun_mulai']) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Tahun selesai harus lebih besar dari tahun mulai'
            ]);
        }

        // Cek duplikasi periode tahun
        $existingPeriod = $this->tahunAjaranModel
            ->where('tahun_mulai', $rawInput['tahun_mulai'])
            ->where('tahun_selesai', $rawInput['tahun_selesai'])
            ->first();

        if ($existingPeriod) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Periode tahun ajaran sudah ada'
            ]);
        }
        
        $data = [
            'id' => generateUUID(),
            'nama' => $rawInput['nama'],
            'tahun_mulai' => (int)$rawInput['tahun_mulai'],
            'tahun_selesai' => (int)$rawInput['tahun_selesai'],
            'deskripsi' => $rawInput['deskripsi'] ?? '',
            'is_active' => 0 // Default inactive
        ];

        try {
            if ($this->tahunAjaranModel->insert($data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Tahun ajaran berhasil ditambahkan'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan tahun ajaran',
                    'errors' => $this->tahunAjaranModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error storing tahun ajaran: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ]);
        }
    }

    public function updateTahunAjaran($id)
    {
        // Mendapatkan data dari JSON input
        $rawInput = $this->request->getJSON(true);
        
        // Handle both PUT and POST methods
        if (!$rawInput) {
            $rawInput = $this->request->getPost();
        }

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]|max_length[100]',
            'tahun_mulai' => 'required|integer|min_length[4]|max_length[4]',
            'tahun_selesai' => 'required|integer|min_length[4]|max_length[4]',
            'deskripsi' => 'permit_empty|max_length[500]'
        ]);

        if (!$validation->run($rawInput)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validation->getErrors()
            ]);
        }

        // Validasi logika tahun
        if ($rawInput['tahun_selesai'] <= $rawInput['tahun_mulai']) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Tahun selesai harus lebih besar dari tahun mulai'
            ]);
        }

        // Cek duplikasi periode tahun (kecuali untuk record yang sedang diedit)
        $existingPeriod = $this->tahunAjaranModel
            ->where('tahun_mulai', $rawInput['tahun_mulai'])
            ->where('tahun_selesai', $rawInput['tahun_selesai'])
            ->where('id !=', $id)
            ->first();

        if ($existingPeriod) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Periode tahun ajaran sudah ada'
            ]);
        }

        // Cek apakah data exists
        $existingData = $this->tahunAjaranModel->find($id);
        if (!$existingData) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'message' => 'Data tahun ajaran tidak ditemukan'
            ]);
        }
        
        $data = [
            'nama' => $rawInput['nama'],
            'tahun_mulai' => (int)$rawInput['tahun_mulai'],
            'tahun_selesai' => (int)$rawInput['tahun_selesai'],
            'deskripsi' => $rawInput['deskripsi'] ?? ''
        ];

        try {
            if ($this->tahunAjaranModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Tahun ajaran berhasil diperbarui'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui tahun ajaran',
                    'errors' => $this->tahunAjaranModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error updating tahun ajaran: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ]);
        }
    }

    public function deleteTahunAjaran($id)
    {
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

            if ($this->tahunAjaranModel->delete($id)) {
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
                $this->tahunAjaranModel->where('is_active', 1)->set(['is_active' => 0])->update();
            }
            
            // Update status tahun ajaran yang dipilih
            if ($this->tahunAjaranModel->update($id, ['is_active' => $is_active])) {
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

    // =========================================
    // API Methods for Kategori
    // =========================================

    public function getKategori()
    {
        try {
            $data = $this->kategoriModel->orderBy('nama_kategori', 'ASC')->findAll();
            
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Gagal mengambil data kategori: ' . $e->getMessage()
            ]);
        }
    }

    public function storeKategori()
    {
        $rawInput = $this->request->getJSON(true);
        
        if (!$rawInput) {
            $rawInput = $this->request->getPost();
        }

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_kategori' => 'required|min_length[3]|max_length[100]|is_unique[kategori.nama_kategori]',
            'spp' => 'required|integer|greater_than_equal_to[0]',
            'catatan' => 'permit_empty|max_length[500]'
        ]);

        if (!$validation->run($rawInput)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validation->getErrors()
            ]);
        }
        
        $data = [
            'id' => generateUUID(),
            'nama_kategori' => $rawInput['nama_kategori'],
            'catatan' => $rawInput['catatan'] ?? '',
            'spp' => (int)$rawInput['spp']
        ];

        try {
            if ($this->kategoriModel->insert($data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Kategori berhasil ditambahkan'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan kategori',
                    'errors' => $this->kategoriModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error storing kategori: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ]);
        }
    }

    public function updateKategori($id)
    {
        $rawInput = $this->request->getJSON(true);
        
        if (!$rawInput) {
            $rawInput = $this->request->getPost();
        }

        // Cek apakah data exists
        $existingData = $this->kategoriModel->find($id);
        if (!$existingData) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'message' => 'Data kategori tidak ditemukan'
            ]);
        }

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_kategori' => "required|min_length[3]|max_length[100]|is_unique[kategori.nama_kategori,id,{$id}]",
            'spp' => 'required|integer|greater_than_equal_to[0]',
            'catatan' => 'permit_empty|max_length[500]'
        ]);

        if (!$validation->run($rawInput)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validation->getErrors()
            ]);
        }
        
        $data = [
            'nama_kategori' => $rawInput['nama_kategori'],
            'catatan' => $rawInput['catatan'] ?? '',
            'spp' => (int)$rawInput['spp']
        ];

        try {
            if ($this->kategoriModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Kategori berhasil diperbarui'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui kategori',
                    'errors' => $this->kategoriModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error updating kategori: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ]);
        }
    }

    public function deleteKategori($id)
    {
        try {
            if ($this->kategoriModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Kategori berhasil dihapus'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus kategori'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // =========================================
    // API Methods for Gelombang Pendaftaran
    // =========================================

    public function getGelombang()
    {
        try {
            $data = $this->gelombangModel->orderBy('tanggal_mulai', 'ASC')->findAll();
            
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Gagal mengambil data gelombang: ' . $e->getMessage()
            ]);
        }
    }

    public function storeGelombang()
    {
        $rawInput = $this->request->getJSON(true);
        
        if (!$rawInput) {
            $rawInput = $this->request->getPost();
        }

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]|max_length[100]',
            'tanggal_mulai' => 'required|valid_date',
            'tanggal_selesai' => 'required|valid_date'
        ]);

        if (!$validation->run($rawInput)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validation->getErrors()
            ]);
        }

        // Validasi logika tanggal
        if (strtotime($rawInput['tanggal_selesai']) <= strtotime($rawInput['tanggal_mulai'])) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Tanggal selesai harus lebih besar dari tanggal mulai'
            ]);
        }

        // Cek overlapping periode
        $overlapping = $this->gelombangModel
            ->where('(tanggal_mulai <= ? AND tanggal_selesai >= ?)', [$rawInput['tanggal_selesai'], $rawInput['tanggal_mulai']])
            ->orWhere('(tanggal_mulai <= ? AND tanggal_selesai >= ?)', [$rawInput['tanggal_mulai'], $rawInput['tanggal_selesai']])
            ->first();

        if ($overlapping) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Periode gelombang berbenturan dengan gelombang lain'
            ]);
        }
        
        $data = [
            'id' => generateUUID(),
            'nama' => $rawInput['nama'],
            'tanggal_mulai' => $rawInput['tanggal_mulai'],
            'tanggal_selesai' => $rawInput['tanggal_selesai']
        ];

        try {
            if ($this->gelombangModel->insert($data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Gelombang pendaftaran berhasil ditambahkan'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan gelombang pendaftaran',
                    'errors' => $this->gelombangModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error storing gelombang: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ]);
        }
    }

    public function updateGelombang($id)
    {
        $rawInput = $this->request->getJSON(true);
        
        if (!$rawInput) {
            $rawInput = $this->request->getPost();
        }
        
        $data = [
            'nama' => $rawInput['nama'] ?? '',
            'tanggal_mulai' => $rawInput['tanggal_mulai'] ?? '',
            'tanggal_selesai' => $rawInput['tanggal_selesai'] ?? ''
        ];

        try {
            if ($this->gelombangModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Gelombang pendaftaran berhasil diperbarui'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui gelombang pendaftaran',
                    'errors' => $this->gelombangModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteGelombang($id)
    {
        try {
            if ($this->gelombangModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Gelombang pendaftaran berhasil dihapus'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus gelombang pendaftaran'
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
