<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMissingColumnsToTahunAjaran extends Migration
{
    public function up()
    {
        // Add missing columns to tahun_ajaran table
        $fields = [
            'tahun_mulai' => [
                'type'       => 'INT',
                'constraint' => 4,
                'null'       => false,
                'after'      => 'nama'
            ],
            'tahun_selesai' => [
                'type'       => 'INT',
                'constraint' => 4,
                'null'       => false,
                'after'      => 'tahun_mulai'
            ],
            'tanggal_mulai_pendaftaran' => [
                'type' => 'DATE',
                'null' => false,
                'after' => 'is_active'
            ],
            'tanggal_selesai_pendaftaran' => [
                'type' => 'DATE',
                'null' => false,
                'after' => 'tanggal_mulai_pendaftaran'
            ],
            'kuota_maksimal' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
                'after' => 'tanggal_selesai_pendaftaran'
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'kuota_maksimal'
            ]
        ];

        $this->forge->addColumn('tahun_ajaran', $fields);
        
        // Add indexes
        $this->forge->addKey('tahun_mulai', false, false, 'tahun_ajaran');
    }

    public function down()
    {
        // Drop added columns
        $this->forge->dropColumn('tahun_ajaran', [
            'tahun_mulai',
            'tahun_selesai', 
            'tanggal_mulai_pendaftaran',
            'tanggal_selesai_pendaftaran',
            'kuota_maksimal',
            'deskripsi'
        ]);
    }
}
