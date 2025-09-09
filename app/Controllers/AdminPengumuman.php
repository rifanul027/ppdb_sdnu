<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengumumanModel;

class AdminPengumuman extends BaseController
{
    protected $pengumumanModel;
    
    public function __construct()
    {
        $this->pengumumanModel = new PengumumanModel();
        helper(['uuid', 'form']);
    }
    
    public function index()
    {
        $pengumuman = $this->pengumumanModel
            ->orderBy('created_at', 'DESC')
            ->findAll();
        
        $data = [
            'pageTitle' => 'Manajemen Pengumuman',
            'pengumuman' => $pengumuman
        ];
        
        return view('admin/pengumuman/index', $data);
    }
    
    public function create()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'nama' => 'required|min_length[3]|max_length[100]',
                'deskripsi' => 'required|min_length[10]',
                'gambar' => 'permit_empty|uploaded[gambar]|is_image[gambar]|max_size[gambar,2048]'
            ];
            
            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $this->validator->getErrors()
                ])->setStatusCode(400);
            }
            
            $data = [
                'nama' => $this->request->getPost('nama'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'is_active' => 1
            ];
            
            try {
                // Generate ID terlebih dahulu
                $id = service('uuid')->uuid4()->toString();
                $data['id'] = $id;
                
                // Handle file upload
                $gambar = $this->request->getFile('gambar');
                if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
                    $imageUrl = $this->handleImageUpload($gambar, $id);
                    if ($imageUrl) {
                        $data['image_url'] = $imageUrl;
                    }
                }
                
                $this->pengumumanModel->insert($data);
                
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Pengumuman berhasil dibuat'
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal membuat pengumuman: ' . $e->getMessage()
                ])->setStatusCode(500);
            }
        }
        
        return redirect()->to('/admin/pengumuman');
    }
    
    public function detail($id)
    {
        if ($this->request->isAJAX()) {
            $pengumuman = $this->pengumumanModel->find($id);
            
            if (!$pengumuman) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Pengumuman tidak ditemukan'
                ])->setStatusCode(404);
            }
            
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $pengumuman
            ]);
        }
        
        return redirect()->to('/admin/pengumuman');
    }
    
    public function update($id)
    {
        if ($this->request->isAJAX()) {
            $pengumuman = $this->pengumumanModel->find($id);
            
            if (!$pengumuman) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Pengumuman tidak ditemukan'
                ])->setStatusCode(404);
            }
            
            $rules = [
                'nama' => 'required|min_length[3]|max_length[100]',
                'deskripsi' => 'required|min_length[10]',
                'gambar' => 'permit_empty|uploaded[gambar]|is_image[gambar]|max_size[gambar,2048]'
            ];
            
            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $this->validator->getErrors()
                ])->setStatusCode(400);
            }
            
            $data = [
                'nama' => $this->request->getPost('nama'),
                'deskripsi' => $this->request->getPost('deskripsi')
            ];
            
            try {
                // Handle file upload
                $gambar = $this->request->getFile('gambar');
                if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
                    // Hapus gambar lama jika ada
                    if (!empty($pengumuman['image_url'])) {
                        $this->deleteOldImage($pengumuman['image_url']);
                    }
                    
                    $imageUrl = $this->handleImageUpload($gambar, $id);
                    if ($imageUrl) {
                        $data['image_url'] = $imageUrl;
                    }
                }
                
                $this->pengumumanModel->update($id, $data);
                
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Pengumuman berhasil diupdate'
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal mengupdate pengumuman: ' . $e->getMessage()
                ])->setStatusCode(500);
            }
        }
        
        return redirect()->to('/admin/pengumuman');
    }
    
    public function toggleActive($id)
    {
        if ($this->request->isAJAX()) {
            $pengumuman = $this->pengumumanModel->find($id);
            
            if (!$pengumuman) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Pengumuman tidak ditemukan'
                ])->setStatusCode(404);
            }
            
            try {
                $newStatus = $pengumuman['is_active'] ? 0 : 1;
                $this->pengumumanModel->update($id, ['is_active' => $newStatus]);
                
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Status pengumuman berhasil diubah',
                    'is_active' => $newStatus
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal mengubah status pengumuman: ' . $e->getMessage()
                ])->setStatusCode(500);
            }
        }
        
        return redirect()->to('/admin/pengumuman');
    }
    
    public function delete($id)
    {
        if ($this->request->isAJAX()) {
            $pengumuman = $this->pengumumanModel->find($id);
            
            if (!$pengumuman) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Pengumuman tidak ditemukan'
                ])->setStatusCode(404);
            }
            
            try {
                // Hapus gambar jika ada
                if (!empty($pengumuman['image_url'])) {
                    $this->deleteOldImage($pengumuman['image_url']);
                }
                
                // Hapus folder pengumuman jika kosong
                $folderPath = FCPATH . 'pengumuman/' . $id;
                if (is_dir($folderPath)) {
                    rmdir($folderPath);
                }
                
                $this->pengumumanModel->delete($id);
                
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Pengumuman berhasil dihapus'
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal menghapus pengumuman: ' . $e->getMessage()
                ])->setStatusCode(500);
            }
        }
        
        return redirect()->to('/admin/pengumuman');
    }
    
    /**
     * Handle image upload
     */
    private function handleImageUpload($file, $id)
    {
        if (!$file->isValid()) {
            return null;
        }
        
        // Buat direktori untuk pengumuman ini
        $uploadPath = FCPATH . 'pengumuman/' . $id;
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        
        // Generate nama file yang unik
        $extension = $file->getClientExtension();
        $fileName = 'image_' . time() . '.' . $extension;
        
        try {
            $file->move($uploadPath, $fileName);
            return base_url('pengumuman/' . $id . '/' . $fileName);
        } catch (\Exception $e) {
            log_message('error', 'Failed to upload image: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Delete old image file
     */
    private function deleteOldImage($imageUrl)
    {
        if (empty($imageUrl)) return;
        
        // Extract file path from URL
        $baseUrl = base_url();
        $relativePath = str_replace($baseUrl, '', $imageUrl);
        $fullPath = FCPATH . $relativePath;
        
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}
