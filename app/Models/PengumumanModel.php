<?php

namespace App\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false; // Karena pakai UUID
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'nama', 'deskripsi', 'image_url', 'is_active'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'nama' => 'required|min_length[3]|max_length[100]',
        'deskripsi' => 'required|min_length[10]',
        'image_url' => 'permit_empty|valid_url|max_length[255]',
        'is_active' => 'permit_empty|in_list[0,1]'
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama pengumuman harus diisi',
            'min_length' => 'Nama pengumuman minimal 3 karakter',
            'max_length' => 'Nama pengumuman maksimal 100 karakter'
        ],
        'deskripsi' => [
            'required' => 'Deskripsi pengumuman harus diisi',
            'min_length' => 'Deskripsi pengumuman minimal 10 karakter'
        ],
        'image_url' => [
            'valid_url' => 'URL gambar tidak valid',
            'max_length' => 'URL gambar maksimal 255 karakter'
        ],
        'is_active' => [
            'in_list' => 'Status aktif harus berupa 0 atau 1'
        ]
    ];

    protected $skipValidation = false;

    /**
     * Generate UUID untuk primary key sebelum insert
     */
    protected function beforeInsert(array $data)
    {
        if (!isset($data['data']['id'])) {
            $data['data']['id'] = service('uuid')->uuid4()->toString();
        }
        return $data;
    }

    /**
     * Get pengumuman yang aktif saja
     */
    public function getActivePengumuman()
    {
        return $this->where('is_active', 1)
                   ->orderBy('created_at', 'DESC')
                   ->findAll();
    }

    /**
     * Get pengumuman terbaru (limit)
     */
    public function getLatestPengumuman($limit = 5)
    {
        return $this->where('is_active', 1)
                   ->orderBy('created_at', 'DESC')
                   ->limit($limit)
                   ->findAll();
    }

    /**
     * Get total pengumuman aktif
     */
    public function getTotalActivePengumuman()
    {
        return $this->where('is_active', 1)->countAllResults();
    }

    /**
     * Toggle status aktif pengumuman
     */
    public function toggleActive($id)
    {
        $pengumuman = $this->find($id);
        if (!$pengumuman) {
            return false;
        }

        $newStatus = $pengumuman['is_active'] ? 0 : 1;
        return $this->update($id, ['is_active' => $newStatus]);
    }
}
