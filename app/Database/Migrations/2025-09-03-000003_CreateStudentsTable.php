<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'no_registrasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'unique'     => true,
            ],
            'nis' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'unique'     => true,
            ],
            'nisn' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'unique'     => true,
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
            ],
            'tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['L', 'P'],
                'null'       => false,
            ],
            'nama_ayah' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'nama_ibu' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'domisili' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'asal_tk_ra' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'nomor_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
            ],
            'ijazah_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'akta_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'kk_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'tahun_ajaran_id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'bukti_pembayaran_id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['calon', 'siswa'],
                'default'    => 'calon',
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
            ],
            'accepted_at' => [
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
        $this->forge->addForeignKey('tahun_ajaran_id', 'tahun_ajaran', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('bukti_pembayaran_id', 'pembayaran', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('students');
    }

    public function down()
    {
        $this->forge->dropTable('students');
    }
}
