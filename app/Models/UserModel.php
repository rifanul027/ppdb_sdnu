<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false; // Karena pakai UUID
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = [
        'username', 'email', 'password', 'role', 'avatar', 'student_id'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
        'role' => 'required|in_list[admin,siswa]'
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username harus diisi',
            'min_length' => 'Username minimal 3 karakter',
            'max_length' => 'Username maksimal 50 karakter',
            'is_unique' => 'Username sudah digunakan'
        ],
        'email' => [
            'required' => 'Email harus diisi',
            'valid_email' => 'Format email tidak valid',
            'is_unique' => 'Email sudah terdaftar'
        ],
        'password' => [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal 8 karakter'
        ],
        'role' => [
            'required' => 'Role harus dipilih',
            'in_list' => 'Role tidak valid'
        ]
    ];

    protected $skipValidation = false;

    // Callbacks
    protected $beforeInsert = ['generateUUID', 'hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function generateUUID(array $data)
    {
        if (!isset($data['data']['id'])) {
            helper('uuid');
            $data['data']['id'] = generateUUID();
        }
        return $data;
    }

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function findUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function findUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }

    public function updatePassword($userId, $newPassword)
    {
        return $this->update($userId, ['password' => $newPassword]);
    }

    public function getUserWithStudent($userId)
    {
        return $this->select('users.*, students.nama_lengkap, students.no_registrasi')
                    ->join('students', 'students.id = users.student_id', 'left')
                    ->where('users.id', $userId)
                    ->first();
    }
}
