<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBeasiswaIdToStudentsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('students', [
            'beasiswa_id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => true,
                'after'      => 'bukti_pembayaran_id',
            ],
        ]);

        // Tambah foreign key constraint
        $this->forge->addForeignKey('beasiswa_id', 'beasiswa', 'id', 'CASCADE', 'SET NULL');
    }

    public function down()
    {
        // Hapus foreign key dulu
        $this->forge->dropForeignKey('students', 'students_beasiswa_id_foreign');
        
        // Kemudian hapus kolom
        $this->forge->dropColumn('students', 'beasiswa_id');
    }
}
