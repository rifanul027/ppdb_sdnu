<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAcceptedAtToPembayaranTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pembayaran', [
            'accepted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pembayaran', 'accepted_at');
    }
}
