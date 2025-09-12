<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        helper('uuid');

        $data = [
            [
                'id' => generateUUID(),
                'nama_kategori' => 'Kakak Beradik',
                'catatan' => 'Khusus untuk siswa yang memiliki saudara kandung yang sudah bersekolah di SD NU',
                'spp' => 75000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => generateUUID(),
                'nama_kategori' => 'Warga Kerto',
                'catatan' => 'Khusus untuk siswa yang berdomisili di wilayah Kerto',
                'spp' => 75000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => generateUUID(),
                'nama_kategori' => 'Beasiswa Pendaftar Awal I',
                'catatan' => 'Beasiswa untuk pendaftar awal gelombang I - SPP 100k + gratis 6 bulan',
                'spp' => 100000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => generateUUID(),
                'nama_kategori' => 'Beasiswa Pendaftar Awal II',
                'catatan' => 'Beasiswa untuk pendaftar awal gelombang II - SPP 100k + gratis 3 bulan',
                'spp' => 100000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => generateUUID(),
                'nama_kategori' => 'Kakak Beradik dan Pendaftar Awal I',
                'catatan' => 'Kombinasi kategori kakak beradik dengan pendaftar awal gelombang I',
                'spp' => 75000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => generateUUID(),
                'nama_kategori' => 'Warga Kerto dan Pendaftar Awal I',
                'catatan' => 'Kombinasi kategori warga kerto dengan pendaftar awal gelombang I',
                'spp' => 75000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => generateUUID(),
                'nama_kategori' => 'Kakak Beradik dan Pendaftar Awal II',
                'catatan' => 'Kombinasi kategori kakak beradik dengan pendaftar awal gelombang II',
                'spp' => 75000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => generateUUID(),
                'nama_kategori' => 'Warga Kerto dan Pendaftar Awal II',
                'catatan' => 'Kombinasi kategori warga kerto dengan pendaftar awal gelombang II',
                'spp' => 75000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('kategori')->insertBatch($data);
    }
}
