<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8">
    <h2 class="text-2xl font-semibold mb-2 text-gray-800">Profile Admin</h2>
    <p class="text-gray-600">Kelola informasi akun admin Anda</p>
</div>

<!-- Alert Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
        <i class="fas fa-check-circle mr-2"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-4">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-4">
        <ul class="ml-4 list-disc">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
    <!-- Profile Photo & Info -->
    <div class="lg:col-span-1">
        <div class="content-card">
            <div class="card-body text-center">
                <div class="mb-8">
                    <div class="w-32 h-32 mx-auto relative">
                        <?php if (!empty($user['avatar'])): ?>
                            <img src="/uploads/avatars/<?= $user['avatar'] ?>" alt="Profile Photo" 
                                 class="w-full h-full rounded-full object-cover border-4 border-gray-200">
                        <?php else: ?>
                            <div class="w-full h-full rounded-full bg-green-800 flex items-center justify-center border-4 border-gray-200">
                                <i class="fas fa-user text-5xl text-white"></i>
                            </div>
                        <?php endif; ?>
                        
                        <label for="fotoInput" class="absolute bottom-0 right-0 bg-green-800 text-white w-9 h-9 rounded-full flex items-center justify-center cursor-pointer shadow-md hover:bg-green-700 transition-colors">
                            <i class="fas fa-camera text-sm"></i>
                        </label>
                        <input type="file" id="fotoInput" accept="image/*" class="hidden">
                    </div>
                </div>
                
                <h3 class="text-xl font-semibold mb-2 text-gray-800">
                    <?= $user['username'] ?? 'Admin' ?>
                </h3>
                <p class="text-gray-600 mb-4">
                    <?= $user['email'] ?? '' ?>
                </p>
                <p class="text-gray-600 text-sm">
                    Role: <span class="bg-green-800 text-white px-2 py-1 rounded text-xs font-medium">
                        <?= ucfirst($user['role'] ?? 'admin') ?>
                    </span>
                </p>
                
                <div class="mt-8">
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="text-2xl font-semibold text-green-800">
                                <?= date('d') ?>
                            </div>
                            <div class="text-xs text-gray-600">Login Hari Ini</div>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="text-2xl font-semibold text-green-800">
                                <?= date('M') ?>
                            </div>
                            <div class="text-xs text-gray-600">Bulan Aktif</div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <p class="text-sm text-gray-600 mb-2">Member sejak</p>
                    <p class="font-semibold text-gray-700">
                        <?= isset($user['created_at']) ? date('d F Y', strtotime($user['created_at'])) : 'Tidak diketahui' ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Profile Form -->
    <div class="lg:col-span-2 space-y-6">
        <div class="content-card">
            <div class="card-header">
                <h3 class="card-title">Informasi Personal</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="/profile/update" id="profileForm">
                    <?= csrf_field() ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block font-medium mb-2 text-gray-700">Username</label>
                            <input type="text" name="username" value="<?= $user['username'] ?? '' ?>" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" 
                                   required>
                        </div>
                        <div>
                            <label class="block font-medium mb-2 text-gray-700">Email</label>
                            <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" 
                                   required>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block font-medium mb-2 text-gray-700">Role</label>
                        <input type="text" value="<?= ucfirst($user['role'] ?? 'admin') ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-gray-50" 
                               readonly>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row justify-end gap-3">
                        <button type="button" onclick="document.getElementById('profileForm').reset()" 
                                class="px-6 py-2 border border-gray-300 bg-white text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                            Reset
                        </button>
                        <button type="submit" 
                                class="px-6 py-2 bg-green-800 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password -->
        <div class="content-card">
            <div class="card-header">
                <h3 class="card-title">Ganti Password</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="/profile/change-password" id="passwordForm">
                    <?= csrf_field() ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="relative">
                            <label class="block font-medium mb-2 text-gray-700">Password Lama</label>
                            <input type="password" name="current_password" id="currentPassword" 
                                   class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" 
                                   required>
                            <button type="button" onclick="togglePassword('currentPassword')" 
                                    class="absolute right-3 top-9 text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        
                        <div class="relative">
                            <label class="block font-medium mb-2 text-gray-700">Password Baru</label>
                            <input type="password" name="new_password" id="newPassword" 
                                   class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" 
                                   required>
                            <button type="button" onclick="togglePassword('newPassword')" 
                                    class="absolute right-3 top-9 text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        
                        <div class="relative">
                            <label class="block font-medium mb-2 text-gray-700">Konfirmasi Password</label>
                            <input type="password" name="confirm_password" id="confirmPassword" 
                                   class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" 
                                   required>
                            <button type="button" onclick="togglePassword('confirmPassword')" 
                                    class="absolute right-3 top-9 text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <button type="submit" 
                                class="px-6 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                            <i class="fas fa-key mr-2"></i>
                            Ganti Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Handle photo upload
document.getElementById('fotoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('foto', file);
        
        fetch('/profile/upload-photo', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Foto berhasil diupload');
                location.reload();
            } else {
                alert(data.message || 'Gagal mengupload foto');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengupload foto');
        });
    }
});

// Toggle password visibility
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Profile form validation
document.getElementById('profileForm').addEventListener('submit', function(e) {
    const username = document.querySelector('input[name="username"]').value;
    const email = document.querySelector('input[name="email"]').value;
    
    if (!username.trim()) {
        alert('Username harus diisi');
        e.preventDefault();
        return;
    }
    
    if (!email.trim()) {
        alert('Email harus diisi');
        e.preventDefault();
        return;
    }
    
    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Format email tidak valid');
        e.preventDefault();
        return;
    }
});

// Password form validation
document.getElementById('passwordForm').addEventListener('submit', function(e) {
    const currentPassword = document.querySelector('input[name="current_password"]').value;
    const newPassword = document.querySelector('input[name="new_password"]').value;
    const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
    
    if (!currentPassword) {
        alert('Password lama harus diisi');
        e.preventDefault();
        return;
    }
    
    if (newPassword.length < 8) {
        alert('Password baru minimal 8 karakter');
        e.preventDefault();
        return;
    }
    
    if (newPassword !== confirmPassword) {
        alert('Konfirmasi password tidak cocok');
        e.preventDefault();
        return;
    }
    
    // Password strength check
    const hasNumber = /\d/.test(newPassword);
    const hasLetter = /[a-zA-Z]/.test(newPassword);
    
    if (!hasNumber || !hasLetter) {
        alert('Password harus mengandung kombinasi huruf dan angka');
        e.preventDefault();
        return;
    }
});
</script>

<?= $this->endSection() ?>
