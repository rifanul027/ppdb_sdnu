<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TahunAjaranModel;

class SettingsController extends BaseController
{
    protected $tahunAjaranModel;
    
    public function __construct()
    {
        $this->tahunAjaranModel = new TahunAjaranModel();
        helper(['uuid', 'form']);
    }
    
    public function index()
    {
        $tahunAjaran = $this->tahunAjaranModel
            ->orderBy('tahun_mulai', 'DESC')
            ->findAll();
        
        $data = [
            'title' => 'Pengaturan Tahun Ajaran',
            'pageTitle' => 'Pengaturan Tahun Ajaran',
            'tahunAjaran' => $tahunAjaran
        ];
        
        return view('admin/settings/index', $data);
    }
    
    public function create()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'nama' => 'required|min_length[3]|max_length[100]',
                'tahun_mulai' => 'required|integer|exact_length[4]',
                'tahun_selesai' => 'required|integer|exact_length[4]',
                'deskripsi' => 'permit_empty'
            ];
            
            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $this->validator->getErrors()
                ]);
            }
            
            $uuidService = new \App\Libraries\UuidService();
            $data = [
                'id' => $uuidService->generate(),
                'nama' => $this->request->getPost('nama'),
                'tahun_mulai' => (int)$this->request->getPost('tahun_mulai'),
                'tahun_selesai' => (int)$this->request->getPost('tahun_selesai'),
                'deskripsi' => $this->request->getPost('deskripsi') ?? '',
                'is_active' => 0 // Default tidak aktif
            ];
            
            try {
                if ($this->tahunAjaranModel->insert($data)) {
                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => 'Tahun ajaran berhasil ditambahkan'
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Gagal menambahkan tahun ajaran',
                        'errors' => $this->tahunAjaranModel->errors()
                    ]);
                }
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }
        
        return redirect()->to('/admin/pengaturan');
    }
    
    public function detail($id)
    {
        if ($this->request->isAJAX()) {
            $data = $this->tahunAjaranModel->find($id);
            
            if ($data) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'data' => $data
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        
        return redirect()->to('/admin/pengaturan');
    }
    
    public function update($id)
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'nama' => 'required|min_length[3]|max_length[100]',
                'tahun_mulai' => 'required|integer|exact_length[4]',
                'tahun_selesai' => 'required|integer|exact_length[4]',
                'deskripsi' => 'permit_empty'
            ];
            
            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $this->validator->getErrors()
                ]);
            }
            
            $data = [
                'nama' => $this->request->getPost('nama'),
                'tahun_mulai' => (int)$this->request->getPost('tahun_mulai'),
                'tahun_selesai' => (int)$this->request->getPost('tahun_selesai'),
                'deskripsi' => $this->request->getPost('deskripsi') ?? ''
            ];
            
            try {
                if ($this->tahunAjaranModel->update($id, $data)) {
                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => 'Tahun ajaran berhasil diperbarui'
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Gagal memperbarui tahun ajaran',
                        'errors' => $this->tahunAjaranModel->errors()
                    ]);
                }
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }
        
        return redirect()->to('/admin/pengaturan');
    }
    
    public function toggleActive($id)
    {
        if ($this->request->isAJAX()) {
            $tahunAjaran = $this->tahunAjaranModel->find($id);
            
            if (!$tahunAjaran) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan'
                ]);
            }
            
            $newStatus = $tahunAjaran['is_active'] == 1 ? 0 : 1;
            
            try {
                // Jika mengaktifkan, nonaktifkan yang lain terlebih dahulu
                if ($newStatus == 1) {
                    $this->tahunAjaranModel->set(['is_active' => 0])->where('is_active', 1)->update();
                }
                
                if ($this->tahunAjaranModel->update($id, ['is_active' => $newStatus])) {
                    $message = $newStatus == 1 ? 'Tahun ajaran berhasil diaktifkan' : 'Tahun ajaran berhasil dinonaktifkan';
                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => $message,
                        'is_active' => $newStatus
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Gagal mengubah status tahun ajaran'
                    ]);
                }
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }
        
        return redirect()->to('/admin/pengaturan');
    }
    
    public function delete($id)
    {
        if ($this->request->isAJAX()) {
            try {
                // Check if this tahun ajaran is being used by students
                $studentModel = new \App\Models\StudentModel();
                $studentCount = $studentModel->where('tahun_ajaran_id', $id)->countAllResults();
                
                if ($studentCount > 0) {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => "Tidak dapat menghapus tahun ajaran karena masih ada $studentCount siswa yang terdaftar"
                    ]);
                }

                if ($this->tahunAjaranModel->delete($id)) {
                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => 'Tahun ajaran berhasil dihapus'
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Gagal menghapus tahun ajaran'
                    ]);
                }
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }
        
        return redirect()->to('/admin/pengaturan');
    }
}
