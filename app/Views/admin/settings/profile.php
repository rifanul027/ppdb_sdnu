<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="margin-bottom: 2rem;">
    <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">Profile Admin</h2>
    <p style="color: #64748b;">Kelola informasi akun admin Anda</p>
</div>

<!-- Alert Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div style="background-color: #d1fae5; border: 1px solid #a7f3d0; color: #065f46; padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
        <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div style="background-color: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
        <i class="fas fa-exclamation-circle" style="margin-right: 0.5rem;"></i>
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div style="background-color: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
        <ul style="margin: 0; padding-left: 1rem;">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
    <!-- Profile Photo & Info -->
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="margin-bottom: 2rem;">
                <div style="width: 120px; height: 120px; margin: 0 auto; position: relative;">
                    <?php if (!empty($user['avatar'])): ?>
                        <img src="/uploads/avatars/<?= $user['avatar'] ?>" alt="Profile Photo" 
                             style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 4px solid #e5e7eb;">
                    <?php else: ?>
                        <div style="width: 100%; height: 100%; border-radius: 50%; background-color: #1B5E20; display: flex; align-items: center; justify-content: center; border: 4px solid #e5e7eb;">
                            <i class="fas fa-user" style="font-size: 3rem; color: white;"></i>
                        </div>
                    <?php endif; ?>
                    
                    <label for="fotoInput" style="position: absolute; bottom: 0; right: 0; background-color: #1B5E20; color: white; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <i class="fas fa-camera" style="font-size: 0.875rem;"></i>
                    </label>
                    <input type="file" id="fotoInput" accept="image/*" style="display: none;">
                </div>
            </div>
            
            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">
                <?= $user['username'] ?? 'Admin' ?>
            </h3>
            <p style="color: #64748b; margin-bottom: 1rem;">
                <?= $user['email'] ?? '' ?>
            </p>
            <p style="color: #64748b; font-size: 0.875rem;">
                Role: <span style="background-color: #1B5E20; color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem;">
                    <?= ucfirst($user['role'] ?? 'admin') ?>
                </span>
            </p>
            
            <div style="margin-top: 2rem;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; text-align: center;">
                    <div style="padding: 1rem; background-color: #f8fafc; border-radius: 0.5rem;">
                        <div style="font-size: 1.5rem; font-weight: 600; color: #1B5E20;">
                            <?= date('d') ?>
                        </div>
                        <div style="font-size: 0.75rem; color: #64748b;">Login Hari Ini</div>
                    </div>
                    <div style="padding: 1rem; background-color: #f8fafc; border-radius: 0.5rem;">
                        <div style="font-size: 1.5rem; font-weight: 600; color: #1B5E20;">
                            <?= date('M') ?>
                        </div>
                        <div style="font-size: 0.75rem; color: #64748b;">Bulan Aktif</div>
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e2e8f0;">
                <p style="font-size: 0.875rem; color: #64748b; margin-bottom: 0.5rem;">Member sejak</p>
                <p style="font-weight: 600; color: #374151;">
                    <?= isset($user['created_at']) ? date('d F Y', strtotime($user['created_at'])) : 'Tidak diketahui' ?>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Profile Form -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Informasi Personal</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="/profile/update" id="profileForm">
                <?= csrf_field() ?>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #374151;">Username</label>
                        <input type="text" name="username" value="<?= $user['username'] ?? '' ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                               required>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #374151;">Email</label>
                        <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                               required>
                    </div>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #374151;">Role</label>
                    <input type="text" value="<?= ucfirst($user['role'] ?? 'admin') ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; background-color: #f9fafb;" 
                           readonly>
                </div>
                
                <div style="display: flex; justify-content: end; gap: 0.75rem;">
                    <button type="button" onclick="document.getElementById('profileForm').reset()" 
                            style="padding: 0.75rem 1.5rem; border: 1px solid #d1d5db; background-color: white; color: #374151; border-radius: 0.5rem; font-weight: 500; cursor: pointer;">
                        Reset
                    </button>
                    <button type="submit" 
                            style="padding: 0.75rem 1.5rem; background-color: #1B5E20; color: white; border: none; border-radius: 0.5rem; font-weight: 500; cursor: pointer;">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password -->
<div class="content-card" style="margin-top: 2rem;">
    <div class="card-header">
        <h3 class="card-title">Ganti Password</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="/profile/change-password" id="passwordForm">
            <?= csrf_field() ?>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem;">
                <div style="position: relative;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #374151;">Password Lama</label>
                    <input type="password" name="current_password" id="currentPassword" 
                           style="width: 100%; padding: 0.75rem; padding-right: 2.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                           required>
                    <button type="button" onclick="togglePassword('currentPassword')" 
                            style="position: absolute; right: 0.75rem; top: 2.25rem; background: none; border: none; color: #6b7280; cursor: pointer;">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                
                <div style="position: relative;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #374151;">Password Baru</label>
                    <input type="password" name="new_password" id="newPassword" 
                           style="width: 100%; padding: 0.75rem; padding-right: 2.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                           required>
                    <button type="button" onclick="togglePassword('newPassword')" 
                            style="position: absolute; right: 0.75rem; top: 2.25rem; background: none; border: none; color: #6b7280; cursor: pointer;">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                
                <div style="position: relative;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #374151;">Konfirmasi Password</label>
                    <input type="password" name="confirm_password" id="confirmPassword" 
                           style="width: 100%; padding: 0.75rem; padding-right: 2.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                           required>
                    <button type="button" onclick="togglePassword('confirmPassword')" 
                            style="position: absolute; right: 0.75rem; top: 2.25rem; background: none; border: none; color: #6b7280; cursor: pointer;">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <div style="margin-top: 2rem;">
                <button type="submit" 
                        style="padding: 0.75rem 1.5rem; background-color: #dc2626; color: white; border: none; border-radius: 0.5rem; font-weight: 500; cursor: pointer;">
                    Ganti Password
                </button>
            </div>
        </form>
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
