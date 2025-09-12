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
                            <?= form_grid_start(2) ?>
                                <?= form_input_text('username', 'Username', [
                                    'value' => $user['username'] ?? '',
                                    'required' => true,
                                    'class' => 'focus:ring-nu-green focus:border-transparent'
                                ]) ?>
                                <?= form_input_text('email', 'Email', [
                                    'type' => 'email',
                                    'value' => $user['email'] ?? '',
                                    'required' => true,
                                    'class' => 'focus:ring-nu-green focus:border-transparent'
                                ]) ?>
                            <?= form_grid_end() ?>
                            
                            <?= form_input_text('role', 'Role', [
                                'value' => ucfirst($user['role'] ?? 'siswa'),
                                'class' => 'focus:ring-nu-green focus:border-transparent bg-gray-50',
                                'readonly' => true
                            ]) ?>
                            
                            <div class="flex justify-end space-x-3 mt-6">
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
                            <?= form_grid_start(3) ?>
                                <?= form_input_password('current_password', 'Password Lama', [
                                    'required' => true,
                                    'class' => 'focus:ring-nu-green focus:border-transparent',
                                    'toggle_id' => 'toggleCurrentPassword'
                                ]) ?>
                                
                                <?= form_input_password('new_password', 'Password Baru', [
                                    'required' => true,
                                    'class' => 'focus:ring-nu-green focus:border-transparent',
                                    'toggle_id' => 'toggleNewPassword'
                                ]) ?>
                                
                                <?= form_input_password('confirm_password', 'Konfirmasi', [
                                    'required' => true,
                                    'class' => 'focus:ring-nu-green focus:border-transparent',
                                    'toggle_id' => 'toggleConfirmPassword'
                                ]) ?>
                            <?= form_grid_end() ?>
                            
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

// Password strength indicator
document.getElementById('new_password').addEventListener('input', function() {
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

<?= password_toggle_script('current_password', 'toggleCurrentPassword', 'current_passwordEyeOpen', 'current_passwordEyeClosed') ?>
<?= password_toggle_script('new_password', 'toggleNewPassword', 'new_passwordEyeOpen', 'new_passwordEyeClosed') ?>
<?= password_toggle_script('confirm_password', 'toggleConfirmPassword', 'confirm_passwordEyeOpen', 'confirm_passwordEyeClosed') ?>

<?= $this->endSection() ?>
