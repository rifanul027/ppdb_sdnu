<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMissingColumnsToBeasiswa extends Migration
{
    public function up()
    {
        // First, rename keterangan to deskripsi if exists
        if ($this->db->fieldExists('keterangan', 'beasiswa')) {
            $this->forge->modifyColumn('beasiswa', [
                'keterangan' => [
                    'name' => 'deskripsi',
                    'type' => 'TEXT',
                    'null' => false,
                ]
            ]);
        }

        // Add missing columns to beasiswa table
        $fields = [
            'jenis' => [
                'type'       => 'ENUM',
                'constraint' => ['prestasi', 'ekonomi', 'yatim_piatu', 'anak_guru', 'khusus'],
                'null'       => false,
                'default'    => 'prestasi',
                'after'      => 'nama'
            ],
            'syarat' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'deskripsi'
            ],
            'besaran_rupiah' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
                'null'       => true,
                'after'      => 'syarat'
            ],
            'besaran_persen' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => true,
                'after'      => 'besaran_rupiah'
            ],
            'is_active' => [
                'type'       => 'BOOLEAN',
                'default'    => true,
                'null'       => false,
                'after'      => 'besaran_persen'
            ],
            'kuota' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'after'      => 'is_active'
            ],
            'tanggal_mulai' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'kuota'
            ],
            'tanggal_selesai' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'tanggal_mulai'
            ]
        ];

        // Check which columns don't exist and add them
        foreach ($fields as $fieldName => $fieldConfig) {
            if (!$this->db->fieldExists($fieldName, 'beasiswa')) {
                $this->forge->addColumn('beasiswa', [$fieldName => $fieldConfig]);
            }
        }
        
        // Add indexes
        $this->forge->addKey('jenis', false, false, 'beasiswa');
        $this->forge->addKey('is_active', false, false, 'beasiswa');
    }

    public function down()
    {
        // Drop added columns (except deskripsi which was renamed from keterangan)
        $this->forge->dropColumn('beasiswa', [
            'jenis',
            'syarat',
            'besaran_rupiah',
            'besaran_persen',
            'is_active',
            'kuota',
            'tanggal_mulai',
            'tanggal_selesai'
        ]);
        
        // Rename deskripsi back to keterangan
        $this->forge->modifyColumn('beasiswa', [
            'deskripsi' => [
                'name' => 'keterangan',
                'type' => 'TEXT',
                'null' => false,
            ]
        ]);
    }
}
