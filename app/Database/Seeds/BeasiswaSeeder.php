<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BeasiswaSeeder extends Seeder
{
    public function run()
    {
        $uuidService = service('uuid');
        
        // Hapus data lama
        $this->db->table('beasiswa')->where('id !=', '')->delete();
        
        $data = [
            [
                'id' => $uuidService->generate(),
                'nama' => 'Beasiswa Prestasi Akademik',
                'jenis' => 'prestasi',
                'deskripsi' => 'Beasiswa untuk siswa berprestasi dalam bidang akademik dengan nilai rata-rata minimal 8.5.',
                'syarat' => 'Memiliki nilai rata-rata minimal 8.5, sertifikat prestasi akademik, rekomendasi dari sekolah asal',
                'besaran_persen' => 50.00,
                'besaran_rupiah' => null,
                'is_active' => true,
                'kuota' => 10,
                'tanggal_mulai' => '2025-01-01',
                'tanggal_selesai' => '2025-12-31',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => $uuidService->generate(),
                'nama' => 'Beasiswa Ekonomi Kurang Mampu',
                'jenis' => 'ekonomi',
                'deskripsi' => 'Beasiswa untuk siswa dari keluarga kurang mampu berdasarkan verifikasi kondisi ekonomi keluarga.',
                'syarat' => 'Surat keterangan tidak mampu dari kelurahan, slip gaji orang tua, foto rumah, rekening listrik 3 bulan terakhir',
                'besaran_persen' => 100.00,
                'besaran_rupiah' => null,
                'is_active' => true,
                'kuota' => 15,
                'tanggal_mulai' => '2025-01-01',
                'tanggal_selesai' => '2025-12-31',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => $uuidService->generate(),
                'nama' => 'Beasiswa Yatim Piatu',
                'jenis' => 'yatim_piatu',
                'deskripsi' => 'Beasiswa khusus untuk anak yatim, piatu, atau yatim piatu yang membutuhkan bantuan pendidikan.',
                'syarat' => 'Surat kematian orang tua, kartu keluarga, surat keterangan dari kelurahan, foto keluarga',
                'besaran_persen' => 75.00,
                'besaran_rupiah' => null,
                'is_active' => true,
                'kuota' => 8,
                'tanggal_mulai' => '2025-01-01',
                'tanggal_selesai' => '2025-12-31',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => $uuidService->generate(),
                'nama' => 'Beasiswa Anak Guru/Karyawan',
                'jenis' => 'anak_guru',
                'deskripsi' => 'Beasiswa untuk anak guru atau karyawan sekolah yang telah mengabdi minimal 2 tahun.',
                'syarat' => 'SK pengangkatan sebagai guru/karyawan, surat keterangan masa kerja minimal 2 tahun, kartu keluarga',
                'besaran_persen' => 30.00,
                'besaran_rupiah' => null,
                'is_active' => true,
                'kuota' => 5,
                'tanggal_mulai' => '2025-01-01',
                'tanggal_selesai' => '2025-12-31',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => $uuidService->generate(),
                'nama' => 'Beasiswa Prestasi Olahraga',
                'jenis' => 'prestasi',
                'deskripsi' => 'Beasiswa untuk siswa berprestasi dalam bidang olahraga tingkat kabupaten/kota atau lebih tinggi.',
                'syarat' => 'Sertifikat juara 1-3 tingkat kabupaten/kota, rekomendasi pelatih, surat keterangan sehat',
                'besaran_rupiah' => 2000000.00,
                'besaran_persen' => null,
                'is_active' => true,
                'kuota' => 3,
                'tanggal_mulai' => '2025-01-01',
                'tanggal_selesai' => '2025-12-31',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('beasiswa')->insertBatch($data);
    }
}
