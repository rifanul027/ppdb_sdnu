<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    public function run()
    {
        $uuidService = service('uuid');
        
        // Hapus data lama
        $this->db->table('tahun_ajaran')->where('id !=', '')->delete();
        
        $data = [
            [
                'id' => $uuidService->generate(),
                'nama' => 'Tahun Ajaran 2024/2025',
                'tahun_mulai' => 2024,
                'tahun_selesai' => 2025,
                'is_active' => false,
                'tanggal_mulai_pendaftaran' => '2024-01-01',
                'tanggal_selesai_pendaftaran' => '2024-06-30',
                'kuota_maksimal' => 120,
                'deskripsi' => 'Tahun ajaran 2024/2025 dengan kuota maksimal 120 siswa',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => $uuidService->generate(),
                'nama' => 'Tahun Ajaran 2025/2026',
                'tahun_mulai' => 2025,
                'tahun_selesai' => 2026,
                'is_active' => true,
                'tanggal_mulai_pendaftaran' => '2025-01-01',
                'tanggal_selesai_pendaftaran' => '2025-06-30',
                'kuota_maksimal' => 150,
                'deskripsi' => 'Tahun ajaran 2025/2026 dengan kuota maksimal 150 siswa (AKTIF)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => $uuidService->generate(),
                'nama' => 'Tahun Ajaran 2026/2027',
                'tahun_mulai' => 2026,
                'tahun_selesai' => 2027,
                'is_active' => false,
                'tanggal_mulai_pendaftaran' => '2026-01-01',
                'tanggal_selesai_pendaftaran' => '2026-06-30',
                'kuota_maksimal' => 160,
                'deskripsi' => 'Tahun ajaran 2026/2027 dengan kuota maksimal 160 siswa',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('tahun_ajaran')->insertBatch($data);
    }
}
