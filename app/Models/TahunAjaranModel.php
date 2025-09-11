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
        'is_active' => 'in_list[0,1]'
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
     * Get current tahun ajaran based on current year
     */
    public function getCurrentTahunAjaran()
    {
        $currentYear = date('Y');
        return $this->where('tahun_mulai', $currentYear)
            ->where('deleted_at IS NULL')
            ->first();
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
