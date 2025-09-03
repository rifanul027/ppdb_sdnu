<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBeasiswaTable extends Migration
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
            'jenis' => [
                'type'       => 'ENUM',
                'constraint' => ['prestasi', 'ekonomi', 'yatim_piatu', 'anak_guru', 'khusus'],
                'null'       => false,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'syarat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'besaran_rupiah' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
                'null'       => true,
            ],
            'besaran_persen' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => true,
            ],
            'is_active' => [
                'type'       => 'BOOLEAN',
                'default'    => true,
                'null'       => false,
            ],
            'kuota' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'tanggal_mulai' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tanggal_selesai' => [
                'type' => 'DATE',
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
        $this->forge->addKey('jenis');
        $this->forge->addKey('is_active');
        $this->forge->addKey(['created_at', 'deleted_at']);
        
        $this->forge->createTable('beasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('beasiswa');
    }
}
