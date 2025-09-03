<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Jalankan seeder dalam urutan yang benar karena ada foreign key dependencies
        $this->call('TahunAjaranSeeder');
        $this->call('PembayaranSeeder');
        $this->call('BeasiswaSeeder');
        $this->call('StudentsSeeder');
        $this->call('UsersSeeder');
        $this->call('PengumumanSeeder');
    }
}
