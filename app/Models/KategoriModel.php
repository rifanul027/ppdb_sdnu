<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false; // Karena pakai UUID
    protected $returnType = 'array';
    protected $useSoftDeletes = true; // Untuk soft delete
    protected $protectFields = true;
    protected $allowedFields = [
        'nama_kategori',
        'catatan',
        'spp'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nama_kategori' => 'required|min_length[3]|max_length[100]',
        'spp' => 'required|integer|greater_than_equal_to[0]',
        'catatan' => 'permit_empty|max_length[500]'
    ];

    protected $validationMessages = [
        'nama_kategori' => [
            'required' => 'Nama kategori harus diisi',
            'min_length' => 'Nama kategori minimal 3 karakter',
            'max_length' => 'Nama kategori maksimal 100 karakter'
        ],
        'spp' => [
            'required' => 'SPP harus diisi',
            'integer' => 'SPP harus berupa angka',
            'greater_than_equal_to' => 'SPP tidak boleh negatif'
        ],
        'catatan' => [
            'max_length' => 'Catatan maksimal 500 karakter'
        ]
    ];

    protected function beforeInsert(array $data)
    {
        if (!isset($data['data']['id'])) {
            helper('uuid');
            $data['data']['id'] = generateUUID();
        }
        return $data;
    }

    /**
     * Get all kategori for select options
     */
    public function getForSelect()
    {
        $result = $this->select('id, nama_kategori')->findAll();
        $options = [];
        foreach ($result as $row) {
            $options[$row['id']] = $row['nama_kategori'];
        }
        return $options;
    }
}
