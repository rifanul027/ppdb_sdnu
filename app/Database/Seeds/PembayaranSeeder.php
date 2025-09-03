<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => '660e8400-e29b-41d4-a716-446655440001',
                'nama' => 'Pembayaran Pendaftaran Student 1',
                'metode' => 'transfer',
                'bukti_url' => 'uploads/bukti_transfer_001.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '660e8400-e29b-41d4-a716-446655440002',
                'nama' => 'Pembayaran Pendaftaran Student 2',
                'metode' => 'cash',
                'bukti_url' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '660e8400-e29b-41d4-a716-446655440003',
                'nama' => 'Pembayaran Daftar Ulang',
                'metode' => 'transfer',
                'bukti_url' => 'uploads/bukti_transfer_003.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('pembayaran')->insertBatch($data);
    }
}
