<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GelombangPendaftaranSeeder extends Seeder
{
    public function run()
    {
        helper('uuid');

        $data = [
            [
                'id' => generateUUID(),
                'nama' => 'Gelombang 1',
                'tanggal_mulai' => '2025-01-01',
                'tanggal_selesai' => '2025-01-28',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => generateUUID(),
                'nama' => 'Gelombang 2',
                'tanggal_mulai' => '2025-02-01',
                'tanggal_selesai' => '2025-02-25',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => generateUUID(),
                'nama' => 'Gelombang 3',
                'tanggal_mulai' => '2025-03-01',
                'tanggal_selesai' => '2025-03-23',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('gelombang_pendaftaran')->insertBatch($data);
    }
}
