<?php

namespace App\Controllers;

class Setup extends BaseController
{
    public function createTables()
    {
        $db = \Config\Database::connect();
        
        $kategoriSQL = "
        CREATE TABLE IF NOT EXISTS kategori (
            id VARCHAR(36) NOT NULL PRIMARY KEY,
            nama_kategori VARCHAR(100) NOT NULL,
            catatan TEXT,
            spp INT(11) NOT NULL DEFAULT 0,
            created_at DATETIME,
            updated_at DATETIME,
            deleted_at DATETIME
        )";
        
        $gelombangSQL = "
        CREATE TABLE IF NOT EXISTS gelombang_pendaftaran (
            id VARCHAR(36) NOT NULL PRIMARY KEY,
            nama VARCHAR(100) NOT NULL,
            tanggal_mulai DATE NOT NULL,
            tanggal_selesai DATE NOT NULL,
            created_at DATETIME,
            updated_at DATETIME,
            deleted_at DATETIME
        )";
        
        try {
            $db->query($kategoriSQL);
            $db->query($gelombangSQL);
            
            // Insert sample data
            helper('uuid');
            
            $kategoriData = [
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
                ]
            ];
            
            $gelombangData = [
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
                ]
            ];
            
            $db->table('kategori')->insertBatch($kategoriData);
            $db->table('gelombang_pendaftaran')->insertBatch($gelombangData);
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Tables created and data inserted successfully!'
            ]);
            
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
}
