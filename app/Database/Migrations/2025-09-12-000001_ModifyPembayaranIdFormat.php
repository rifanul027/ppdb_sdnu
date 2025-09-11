<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyPembayaranIdFormat extends Migration
{
    public function up()
    {
        // Modify the id field to accommodate the new format PAY{YYYYMMDD}{NNNN}
        $this->forge->modifyColumn('pembayaran', [
            'id' => [
                'type'       => 'VARCHAR',
                'constraint' => 15, // PAY + 8 digits date + 4 digits sequence = 15 characters
                'null'       => false,
            ]
        ]);
    }

    public function down()
    {
        // Revert back to original CHAR(36) for UUID
        $this->forge->modifyColumn('pembayaran', [
            'id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ]
        ]);
    }
}
