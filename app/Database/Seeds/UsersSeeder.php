<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => '880e8400-e29b-41d4-a716-446655440001',
                'username' => 'admin',
                'email' => 'admin@sdnu.sch.id',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'avatar' => null,
                'student_id' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
