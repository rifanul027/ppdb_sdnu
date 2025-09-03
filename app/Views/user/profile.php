<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Profile Saya</h1>
            <p class="text-gray-600">Kelola informasi akun dan pengaturan Anda</p>
        </div>

        <!-- Alert Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-check-circle mr-2"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Info Card -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-lg rounded-xl p-6">
                    <div class="text-center">
                        <div class="relative inline-block mb-4">
                            <?php if (!empty($user['avatar'])): ?>
                                <img src="/uploads/avatars/<?= $user['avatar'] ?>" alt="Profile Photo" 
                                     class="w-24 h-24 rounded-full object-cover mx-auto border-4 border-nu-green">
                            <?php else: ?>
                                <div class="w-24 h-24 rounded-full bg-nu-green flex items-center justify-center mx-auto border-4 border-gray-200">
                                    <i class="fas fa-user text-white text-2xl"></i>
                                </div>
                            <?php endif; ?>
                            
                            <label for="photoInput" class="absolute bottom-0 right-0 bg-nu-green text-white w-8 h-8 rounded-full flex items-center justify-center cursor-pointer hover:bg-nu-dark transition-colors">
                                <i class="fas fa-camera text-xs"></i>
                            </label>
                            <input type="file" id="photoInput" accept="image/*" class="hidden">
                        </div>
                        
                        <h3 class="text-xl font-semibold text-gray-900 mb-1">
                            <?= $user['username'] ?? 'User' ?>
                        </h3>
                        <p class="text-gray-600 mb-3">
                            <?= $user['email'] ?? '' ?>
                        </p>
                        <span class="inline-block bg-nu-green text-white px-3 py-1 rounded-full text-xs font-medium">
                            <?= ucfirst($user['role'] ?? 'siswa') ?>
                        </span>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div>
                                    <div class="text-2xl font-bold text-nu-green"><?= date('d') ?></div>
                                    <div class="text-xs text-gray-500">Login Hari Ini</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-nu-green"><?= date('M') ?></div>
                                    <div class="text-xs text-gray-500">Bulan Aktif</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-sm text-gray-500 mb-2">Member sejak</p>
                            <p class="font-semibold text-gray-900">
                                <?= isset($user['created_at']) ? date('d F Y', strtotime($user['created_at'])) : 'Tidak diketahui' ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Profile Form -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Personal Information -->
                <div class="bg-white shadow-lg rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Personal</h3>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="/profile/update" id="profileForm">
                            <?= csrf_field() ?>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                                    <input type="text" name="username" value="<?= $user['username'] ?? '' ?>" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nu-green focus:border-transparent" 
                                           required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nu-green focus:border-transparent" 
                                           required>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                                <input type="text" value="<?= ucfirst($user['role'] ?? 'siswa') ?>" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50" 
                                       readonly>
                            </div>
                            
                            <div class="flex justify-end space-x-3">
                                <button type="button" onclick="document.getElementById('profileForm').reset()" 
                                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                    Reset
                                </button>
                                <button type="submit" 
                                        class="px-6 py-3 bg-nu-green text-white rounded-lg hover:bg-nu-dark transition-colors">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Change Password -->
                <div class="bg-white shadow-lg rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Ganti Password</h3>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="/profile/change-password" id="passwordForm">
                            <?= csrf_field() ?>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                <div class="relative">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Lama</label>
                                    <input type="password" name="current_password" id="currentPassword" 
                                           class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nu-green focus:border-transparent" 
                                           required>
                                    <button type="button" onclick="togglePassword('currentPassword')" 
                                            class="absolute right-3 top-9 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                
                                <div class="relative">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                    <input type="password" name="new_password" id="newPassword" 
                                           class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nu-green focus:border-transparent" 
                                           required>
                                    <button type="button" onclick="togglePassword('newPassword')" 
                                            class="absolute right-3 top-9 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                
                                <div class="relative">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                    <input type="password" name="confirm_password" id="confirmPassword" 
                                           class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nu-green focus:border-transparent" 
                                           required>
                                    <button type="button" onclick="togglePassword('confirmPassword')" 
                                            class="absolute right-3 top-9 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div id="passwordStrength" class="mb-4 hidden">
                                <div class="text-sm text-gray-600 mb-2">Kekuatan Password:</div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div id="strengthBar" class="h-2 rounded-full transition-all duration-300" style="width: 0%;"></div>
                                </div>
                                <div id="strengthText" class="text-xs mt-1"></div>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" 
                                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                    <i class="fas fa-key mr-2"></i>
                                    Ganti Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Account Activity -->
                <div class="bg-white shadow-lg rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Aktivitas Akun</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4 max-h-64 overflow-y-auto">
                            <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                                <div class="w-10 h-10 bg-nu-green rounded-full flex items-center justify-center">
                                    <i class="fas fa-sign-in-alt text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-900">Login terakhir</div>
                                    <div class="text-xs text-gray-500"><?= date('d M Y, H:i') ?></div>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-edit text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-900">Profile diperbarui</div>
                                    <div class="text-xs text-gray-500">2 hari yang lalu</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-plus text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-900">Akun dibuat</div>
                                    <div class="text-xs text-gray-500">
                                        <?= isset($user['created_at']) ? date('d M Y', strtotime($user['created_at'])) : 'Tidak diketahui' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Handle photo upload
document.getElementById('photoInput').addEventListener('change', function(e) {
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

// Password strength indicator
document.getElementById('newPassword').addEventListener('input', function() {
    const password = this.value;
    const strengthContainer = document.getElementById('passwordStrength');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    
    if (password.length > 0) {
        strengthContainer.classList.remove('hidden');
        
        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/\d/.test(password)) strength++;
        if (/[^a-zA-Z\d]/.test(password)) strength++;
        
        const percentage = (strength / 5) * 100;
        strengthBar.style.width = percentage + '%';
        
        switch(strength) {
            case 0:
            case 1:
                strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-red-500';
                strengthText.textContent = 'Sangat Lemah';
                strengthText.className = 'text-xs mt-1 text-red-500';
                break;
            case 2:
                strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-orange-500';
                strengthText.textContent = 'Lemah';
                strengthText.className = 'text-xs mt-1 text-orange-500';
                break;
            case 3:
                strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-yellow-500';
                strengthText.textContent = 'Sedang';
                strengthText.className = 'text-xs mt-1 text-yellow-500';
                break;
            case 4:
                strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-green-500';
                strengthText.textContent = 'Kuat';
                strengthText.className = 'text-xs mt-1 text-green-500';
                break;
            case 5:
                strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-green-600';
                strengthText.textContent = 'Sangat Kuat';
                strengthText.className = 'text-xs mt-1 text-green-600';
                break;
        }
    } else {
        strengthContainer.classList.add('hidden');
    }
});

// Form validation
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
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Format email tidak valid');
        e.preventDefault();
        return;
    }
});

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
});
</script>

<?= $this->endSection() ?>
