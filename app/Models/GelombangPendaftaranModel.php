<?php

namespace App\Models;

use CodeIgniter\Model;

class GelombangPendaftaranModel extends Model
{
    protected $table = 'gelombang_pendaftaran';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false; // Karena pakai UUID
    protected $returnType = 'array';
    protected $useSoftDeletes = true; // Untuk soft delete
    protected $protectFields = true;
    protected $allowedFields = [
        'nama',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nama' => 'required|min_length[3]|max_length[100]',
        'tanggal_mulai' => 'required|valid_date',
        'tanggal_selesai' => 'required|valid_date'
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama gelombang harus diisi',
            'min_length' => 'Nama gelombang minimal 3 karakter',
            'max_length' => 'Nama gelombang maksimal 100 karakter'
        ],
        'tanggal_mulai' => [
            'required' => 'Tanggal mulai harus diisi',
            'valid_date' => 'Format tanggal mulai tidak valid'
        ],
        'tanggal_selesai' => [
            'required' => 'Tanggal selesai harus diisi',
            'valid_date' => 'Format tanggal selesai tidak valid'
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
     * Get all gelombang for select options
     */
    public function getForSelect()
    {
        $result = $this->select('id, nama')->findAll();
        $options = [];
        foreach ($result as $row) {
            $options[$row['id']] = $row['nama'];
        }
        return $options;
    }

    /**
     * Get current active gelombang based on current date
     */
    public function getCurrentGelombang()
    {
        $currentDate = date('Y-m-d');
        return $this->where('tanggal_mulai <=', $currentDate)
            ->where('tanggal_selesai >=', $currentDate)
            ->where('deleted_at IS NULL')
            ->first();
    }
}
