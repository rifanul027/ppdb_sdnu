<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
        helper(['form', 'url', 'uuid']);
    }

    public function login()
    {
        // Jika sudah login, redirect sesuai role
        if ($this->session->get('logged_in')) {
            $role = $this->session->get('role');
            return redirect()->to($role === 'admin' ? '/admin/dashboard' : '/');
        }

        $data = [
            'title' => 'Login - PPDB SD NU Pemanahan'
        ];

        return view('ppdb/login', $data);
    }

    public function attemptLogin()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->findUserByEmail($email);

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Email tidak ditemukan');
        }

        if (!$this->userModel->verifyPassword($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Password salah');
        }

        // Set session data
        $sessionData = [
            'user_id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role'],
            'avatar' => $user['avatar'],
            'student_id' => $user['student_id'],
            'logged_in' => true
        ];

        $this->session->set($sessionData);

        // Redirect berdasarkan role
        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang di dashboard admin');
        } else {
            return redirect()->to('/')->with('success', 'Login berhasil');
        }
    }

    public function register()
    {
        // Jika sudah login, redirect
        if ($this->session->get('logged_in')) {
            $role = $this->session->get('role');
            return redirect()->to($role === 'admin' ? '/admin/dashboard' : '/');
        }

        $data = [
            'title' => 'Register - PPDB SD NU Pemanahan'
        ];

        return view('ppdb/register', $data);
    }

    public function attemptRegister()
    {
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[100]',
            'birth_place' => 'required|min_length[3]|max_length[50]',
            'dob' => 'required|valid_date',
            'email' => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'password' => 'required|min_length[8]'
        ];

        $messages = [
            'full_name' => [
                'required' => 'Nama lengkap harus diisi',
                'min_length' => 'Nama lengkap minimal 3 karakter',
                'max_length' => 'Nama lengkap maksimal 100 karakter'
            ],
            'birth_place' => [
                'required' => 'Tempat lahir harus diisi',
                'min_length' => 'Tempat lahir minimal 3 karakter',
                'max_length' => 'Tempat lahir maksimal 50 karakter'
            ],
            'dob' => [
                'required' => 'Tanggal lahir harus diisi',
                'valid_date' => 'Format tanggal tidak valid'
            ],
            'email' => [
                'required' => 'Email harus diisi',
                'valid_email' => 'Format email tidak valid',
                'is_unique' => 'Email sudah terdaftar'
            ],
            'username' => [
                'required' => 'Username harus diisi',
                'min_length' => 'Username minimal 3 karakter',
                'max_length' => 'Username maksimal 50 karakter',
                'is_unique' => 'Username sudah digunakan'
            ],
            'password' => [
                'required' => 'Password harus diisi',
                'min_length' => 'Password minimal 8 karakter'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data untuk user
        $userData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role' => 'siswa' // Default role untuk registrasi publik
        ];

        try {
            // Insert user
            if ($this->userModel->insert($userData)) {
                return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal melakukan registrasi');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout');
    }

    public function profile()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('user_id');
        $user = $this->userModel->getUserWithStudent($userId);

        $data = [
            'title' => 'Profile',
            'user' => $user
        ];

        $role = $this->session->get('role');
        if ($role === 'admin') {
            return view('admin/settings/profile', $data);
        } else {
            return view('user/profile', $data);
        }
    }

    public function updateProfile()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('user_id');
        
        $rules = [
            'username' => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$userId}]",
            'email' => "required|valid_email|is_unique[users.email,id,{$userId}]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email')
        ];

        if ($this->userModel->update($userId, $data)) {
            // Update session data
            $this->session->set([
                'username' => $data['username'],
                'email' => $data['email']
            ]);
            
            return redirect()->back()->with('success', 'Profile berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui profile');
        }
    }

    public function changePassword()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[new_password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $userId = $this->session->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$this->userModel->verifyPassword($this->request->getPost('current_password'), $user['password'])) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai');
        }

        if ($this->userModel->updatePassword($userId, $this->request->getPost('new_password'))) {
            return redirect()->back()->with('success', 'Password berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah password');
        }
    }

    public function uploadPhoto()
    {
        if (!$this->session->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $file = $this->request->getFile('foto');
        
        if (!$file->isValid()) {
            return $this->response->setJSON(['success' => false, 'message' => 'File tidak valid']);
        }

        $validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!in_array($file->getMimeType(), $validTypes)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Format file harus JPG, JPEG, atau PNG']);
        }

        if ($file->getSize() > 2048000) { // 2MB
            return $this->response->setJSON(['success' => false, 'message' => 'Ukuran file maksimal 2MB']);
        }

        $userId = $this->session->get('user_id');
        $fileName = $userId . '_' . time() . '.' . $file->getExtension();
        
        if ($file->move(FCPATH . 'uploads/avatars', $fileName)) {
            if ($this->userModel->update($userId, ['avatar' => $fileName])) {
                $this->session->set('avatar', $fileName);
                return $this->response->setJSON(['success' => true, 'message' => 'Foto berhasil diupload']);
            }
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengupload foto']);
    }
}
