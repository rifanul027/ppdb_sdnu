<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveKuotaTanggalFromTahunAjaranTable extends Migration
{
    public function up()
    {
        // Hapus kolom kuota_maksimal, tanggal_mulai_pendaftaran, dan tanggal_selesai_pendaftaran
        $this->forge->dropColumn('tahun_ajaran', [
            'kuota_maksimal',
            'tanggal_mulai_pendaftaran',
            'tanggal_selesai_pendaftaran'
        ]);
    }

    public function down()
    {
        // Tambah kembali kolom yang dihapus jika migration di-rollback
        $fields = [
            'tanggal_mulai_pendaftaran' => [
                'type' => 'DATE',
                'null' => true, // Changed to nullable for rollback safety
                'after' => 'is_active'
            ],
            'tanggal_selesai_pendaftaran' => [
                'type' => 'DATE',
                'null' => true, // Changed to nullable for rollback safety
                'after' => 'tanggal_mulai_pendaftaran'
            ],
            'kuota_maksimal' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true, // Changed to nullable for rollback safety
                'after' => 'tanggal_selesai_pendaftaran'
            ]
        ];

        $this->forge->addColumn('tahun_ajaran', $fields);
    }
}
