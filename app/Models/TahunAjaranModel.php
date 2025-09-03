<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunAjaranModel extends Model
{
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false; // Karena pakai UUID
    protected $returnType = 'array';
    protected $useSoftDeletes = true; // Untuk soft delete
    protected $protectFields = true;
    protected $allowedFields = [
        'nama',
        'tahun_mulai',
        'tahun_selesai',
        'is_active',
        'tanggal_mulai_pendaftaran',
        'tanggal_selesai_pendaftaran',
        'kuota_maksimal',
        'deskripsi'
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
        'tahun_mulai' => 'required|integer|min_length[4]|max_length[4]',
        'tahun_selesai' => 'required|integer|min_length[4]|max_length[4]',
        'is_active' => 'in_list[0,1]',
        'tanggal_mulai_pendaftaran' => 'required|valid_date',
        'tanggal_selesai_pendaftaran' => 'required|valid_date',
        'kuota_maksimal' => 'required|integer|greater_than[0]'
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama tahun ajaran harus diisi',
            'min_length' => 'Nama tahun ajaran minimal 3 karakter',
            'max_length' => 'Nama tahun ajaran maksimal 100 karakter'
        ],
        'tahun_mulai' => [
            'required' => 'Tahun mulai harus diisi',
            'integer' => 'Tahun mulai harus berupa angka',
            'min_length' => 'Tahun mulai harus 4 digit',
            'max_length' => 'Tahun mulai harus 4 digit'
        ],
        'tahun_selesai' => [
            'required' => 'Tahun selesai harus diisi',
            'integer' => 'Tahun selesai harus berupa angka',
            'min_length' => 'Tahun selesai harus 4 digit',
            'max_length' => 'Tahun selesai harus 4 digit'
        ],
        'tanggal_mulai_pendaftaran' => [
            'required' => 'Tanggal mulai pendaftaran harus diisi',
            'valid_date' => 'Format tanggal mulai pendaftaran tidak valid'
        ],
        'tanggal_selesai_pendaftaran' => [
            'required' => 'Tanggal selesai pendaftaran harus diisi',
            'valid_date' => 'Format tanggal selesai pendaftaran tidak valid'
        ],
        'kuota_maksimal' => [
            'required' => 'Kuota maksimal harus diisi',
            'integer' => 'Kuota maksimal harus berupa angka',
            'greater_than' => 'Kuota maksimal harus lebih dari 0'
        ]
    ];

    protected function beforeInsert(array $data)
    {
        if (!isset($data['data']['id'])) {
            $data['data']['id'] = service('uuid')->generate();
        }
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        // Jika setting is_active = 1, set yang lain jadi 0
        if (isset($data['data']['is_active']) && $data['data']['is_active'] == 1) {
            $this->where('id !=', $data['id'])->set(['is_active' => 0])->update();
        }
        return $data;
    }

    /**
     * Get active tahun ajaran
     */
    public function getActive()
    {
        return $this->where('is_active', 1)->first();
    }

    /**
     * Get all tahun ajaran for select options
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
     * Activate tahun ajaran and deactivate others
     */
    public function activate($id)
    {
        $this->db->transStart();
        
        // Deactivate all
        $this->set('is_active', 0)->update();
        
        // Activate selected
        $this->update($id, ['is_active' => 1]);
        
        $this->db->transComplete();
        
        return $this->db->transStatus();
    }
}
