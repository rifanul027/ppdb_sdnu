<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UpdateStudentsBeasiswaSeeder extends Seeder
{
    public function run()
    {
        // Update existing students dengan beasiswa
        $this->db->table('students')
            ->where('id', '770e8400-e29b-41d4-a716-446655440001')
            ->update(['beasiswa_id' => 'aaa8400-e29b-41d4-a716-446655440001']);

        $this->db->table('students')
            ->where('id', '770e8400-e29b-41d4-a716-446655440002')
            ->update(['beasiswa_id' => 'aaa8400-e29b-41d4-a716-446655440002']);

        // Student ketiga tidak mendapat beasiswa (tetap null)
    }
}
