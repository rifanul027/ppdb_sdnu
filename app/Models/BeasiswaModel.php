<?php

namespace App\Models;

use CodeIgniter\Model;

class BeasiswaModel extends Model
{
    protected $table = 'beasiswa';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false; // Karena pakai UUID
    protected $returnType = 'array';
    protected $useSoftDeletes = true; // Untuk soft delete
    protected $protectFields = true;
    protected $allowedFields = [
        'nama',
        'jenis',
        'deskripsi',
        'syarat',
        'besaran_rupiah',
        'besaran_persen',
        'is_active',
        'kuota',
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
        'jenis' => 'required|in_list[prestasi,ekonomi,yatim_piatu,anak_guru,khusus]',
        'deskripsi' => 'required',
        'is_active' => 'in_list[0,1]',
        'kuota' => 'permit_empty|integer|greater_than[0]',
        'tanggal_mulai' => 'permit_empty|valid_date',
        'tanggal_selesai' => 'permit_empty|valid_date'
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama beasiswa harus diisi',
            'min_length' => 'Nama beasiswa minimal 3 karakter',
            'max_length' => 'Nama beasiswa maksimal 100 karakter'
        ],
        'jenis' => [
            'required' => 'Jenis beasiswa harus dipilih',
            'in_list' => 'Jenis beasiswa tidak valid'
        ],
        'deskripsi' => [
            'required' => 'Deskripsi beasiswa harus diisi'
        ],
        'kuota' => [
            'integer' => 'Kuota harus berupa angka',
            'greater_than' => 'Kuota harus lebih dari 0'
        ],
        'tanggal_mulai' => [
            'valid_date' => 'Format tanggal mulai tidak valid'
        ],
        'tanggal_selesai' => [
            'valid_date' => 'Format tanggal selesai tidak valid'
        ]
    ];

    protected function beforeInsert(array $data)
    {
        if (!isset($data['data']['id'])) {
            $data['data']['id'] = service('uuid')->generate();
        }
        return $data;
    }

    /**
     * Get all active beasiswa
     */
    public function getActive()
    {
        return $this->where('is_active', 1)->findAll();
    }

    /**
     * Get all beasiswa for select options
     */
    public function getForSelect()
    {
        $result = $this->select('id, nama')->where('is_active', 1)->findAll();
        $options = [];
        foreach ($result as $row) {
            $options[$row['id']] = $row['nama'];
        }
        return $options;
    }

    /**
     * Get jenis beasiswa options
     */
    public function getJenisOptions()
    {
        return [
            'prestasi' => 'Beasiswa Prestasi',
            'ekonomi' => 'Beasiswa Ekonomi',
            'yatim_piatu' => 'Beasiswa Yatim Piatu',
            'anak_guru' => 'Beasiswa Anak Guru',
            'khusus' => 'Beasiswa Khusus'
        ];
    }

    /**
     * Get students count using this beasiswa
     */
    public function getUsageCount($beasiswaId)
    {
        return $this->db->table('students')
                       ->where('beasiswa_id', $beasiswaId)
                       ->where('deleted_at', null)
                       ->countAllResults();
    }
}
