<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKtpAndKategoriToStudentsTable extends Migration
{
    public function up()
    {
        $fields = [
            'ktp_ayah' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'nama_ayah',
            ],
            'ktp_ibu' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'nama_ibu',
            ],
            'kategori_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 36,
                'null'       => true,
                'after'      => 'tahun_ajaran_id',
            ],
        ];

        $this->forge->addColumn('students', $fields);
        
        // Add foreign key constraint for kategori_id
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id', 'CASCADE', 'SET NULL', '', 'students');
    }

    public function down()
    {
        // Drop foreign key first
        $this->forge->dropForeignKey('students', 'students_kategori_id_foreign');
        
        // Drop columns
        $this->forge->dropColumn('students', ['ktp_ayah', 'ktp_ibu', 'kategori_id']);
    }
}