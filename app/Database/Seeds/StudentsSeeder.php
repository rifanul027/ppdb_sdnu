<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StudentsSeeder extends Seeder
{
    public function run()
    {
        // Ambil tahun ajaran yang aktif
        $tahunAjaranAktif = $this->db->table('tahun_ajaran')
                                    ->where('is_active', true)
                                    ->get()
                                    ->getRowArray();
        
        if (!$tahunAjaranAktif) {
            // Jika tidak ada yang aktif, ambil yang pertama
            $tahunAjaranAktif = $this->db->table('tahun_ajaran')
                                        ->limit(1)
                                        ->get()
                                        ->getRowArray();
        }
        
        $tahunAjaranId = $tahunAjaranAktif['id'];
        
        $data = [
            [
                'id' => '770e8400-e29b-41d4-a716-446655440001',
                'no_registrasi' => 'REG2024001',
                'nis' => null,
                'nisn' => '0123456789',
                'nama_lengkap' => 'Ahmad Rizky Pratama',
                'agama' => 'Islam',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2018-05-15',
                'jenis_kelamin' => 'L',
                'nama_ayah' => 'Budi Pratama',
                'nama_ibu' => 'Siti Rahayu',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta Selatan',
                'domisili' => 'Jl. Merdeka No. 123, Jakarta Selatan',
                'asal_tk_ra' => 'TK Negeri 1 Jakarta',
                'nomor_telepon' => '081234567890',
                'ijazah_url' => 'uploads/ijazah_001.pdf',
                'akta_url' => 'uploads/akta_001.pdf',
                'kk_url' => 'uploads/kk_001.pdf',
                'tahun_ajaran_id' => $tahunAjaranId,
                'bukti_pembayaran_id' => '660e8400-e29b-41d4-a716-446655440001',
                'beasiswa_id' => 'aaa8400-e29b-41d4-a716-446655440001',
                'status' => 'siswa',
                'created_at' => date('Y-m-d H:i:s'),
                'accepted_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '770e8400-e29b-41d4-a716-446655440002',
                'no_registrasi' => 'REG2024002',
                'nis' => null,
                'nisn' => '9876543210',
                'nama_lengkap' => 'Sari Dewi Lestari',
                'agama' => 'Islam',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2018-08-22',
                'jenis_kelamin' => 'P',
                'nama_ayah' => 'Andi Lestari',
                'nama_ibu' => 'Dewi Sartika',
                'alamat' => 'Jl. Sudirman No. 456, Bandung',
                'domisili' => 'Jl. Sudirman No. 456, Bandung',
                'asal_tk_ra' => 'RA Al-Hidayah',
                'nomor_telepon' => '081987654321',
                'ijazah_url' => 'uploads/ijazah_002.pdf',
                'akta_url' => 'uploads/akta_002.pdf',
                'kk_url' => 'uploads/kk_002.pdf',
                'tahun_ajaran_id' => $tahunAjaranId,
                'bukti_pembayaran_id' => '660e8400-e29b-41d4-a716-446655440002',
                'beasiswa_id' => 'aaa8400-e29b-41d4-a716-446655440002',
                'status' => 'calon',
                'created_at' => date('Y-m-d H:i:s'),
                'accepted_at' => null,
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '770e8400-e29b-41d4-a716-446655440003',
                'no_registrasi' => 'REG2024003',
                'nis' => null,
                'nisn' => '1122334455',
                'nama_lengkap' => 'Muhammad Fajar Sidiq',
                'agama' => 'Islam',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2018-03-10',
                'jenis_kelamin' => 'L',
                'nama_ayah' => 'Sidiq Mahmud',
                'nama_ibu' => 'Fatimah Az-Zahra',
                'alamat' => 'Jl. Diponegoro No. 789, Surabaya',
                'domisili' => 'Jl. Diponegoro No. 789, Surabaya',
                'asal_tk_ra' => null,
                'nomor_telepon' => '081555666777',
                'ijazah_url' => null,
                'akta_url' => 'uploads/akta_003.pdf',
                'kk_url' => 'uploads/kk_003.pdf',
                'tahun_ajaran_id' => $tahunAjaranId,
                'bukti_pembayaran_id' => null,
                'beasiswa_id' => null,
                'status' => 'calon',
                'created_at' => date('Y-m-d H:i:s'),
                'accepted_at' => null,
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('students')->insertBatch($data);
    }
}
