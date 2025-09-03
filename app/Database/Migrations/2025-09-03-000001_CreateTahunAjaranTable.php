<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTahunAjaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'tahun_mulai' => [
                'type'       => 'INT',
                'constraint' => 4,
                'null'       => false,
            ],
            'tahun_selesai' => [
                'type'       => 'INT',
                'constraint' => 4,
                'null'       => false,
            ],
            'is_active' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
                'null'       => false,
            ],
            'tanggal_mulai_pendaftaran' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'tanggal_selesai_pendaftaran' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'kuota_maksimal' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
            ],
            'deleted_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('is_active');
        $this->forge->addKey('tahun_mulai');
        $this->forge->addKey(['created_at', 'deleted_at']);
        
        $this->forge->createTable('tahun_ajaran');
    }

    public function down()
    {
        $this->forge->dropTable('tahun_ajaran');
    }
}
