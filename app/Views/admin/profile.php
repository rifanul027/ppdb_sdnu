<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="margin-bottom: 2rem;">
    <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">Profile Admin</h2>
    <p style="color: #64748b;">Kelola informasi akun admin Anda</p>
</div>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
    <!-- Profile Photo & Info -->
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="margin-bottom: 2rem;">
                <?php if (isset($admin['foto']) && !empty($admin['foto'])): ?>
                    <img src="<?= base_url($admin['foto']) ?>" alt="Profile Photo" 
                         style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #059669;">
                <?php else: ?>
                    <div style="width: 150px; height: 150px; border-radius: 50%; background: linear-gradient(135deg, #059669, #10b981); display: flex; align-items: center; justify-content: center; margin: 0 auto; color: white; font-size: 3rem;">
                        <i class="fas fa-user"></i>
                    </div>
                <?php endif; ?>
            </div>
            
            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">
                <?= esc($admin['nama'] ?? 'Administrator') ?>
            </h3>
            <p style="color: #64748b; margin-bottom: 1rem;">
                <?= esc($admin['jabatan'] ?? 'Admin PPDB') ?>
            </p>
            <p style="color: #64748b; font-size: 0.875rem;">
                <i class="fas fa-envelope"></i>
                <?= esc($admin['email'] ?? 'admin@sdnu.ac.id') ?>
            </p>
            
            <div style="margin-top: 2rem;">
                <input type="file" id="fotoInput" accept="image/*" style="display: none;">
                <label for="fotoInput" class="btn btn-primary" style="cursor: pointer;">
                    <i class="fas fa-camera"></i>
                    Ganti Foto
                </label>
            </div>
            
            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e2e8f0;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; text-align: left;">
                    <div>
                        <div style="font-size: 0.875rem; color: #64748b;">Login Terakhir</div>
                        <div style="font-weight: 600;">
                            <?= date('d M Y, H:i', strtotime($admin['last_login'] ?? 'now')) ?>
                        </div>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: #64748b;">Member Sejak</div>
                        <div style="font-weight: 600;">
                            <?= date('d M Y', strtotime($admin['created_at'] ?? 'now')) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Profile Form -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Informasi Personal</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="/admin/profile/update" id="profileForm">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Nama Lengkap</label>
                        <input type="text" name="nama" value="<?= esc($admin['nama'] ?? '') ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;" required>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email</label>
                        <input type="email" name="email" value="<?= esc($admin['email'] ?? '') ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;" required>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Nomor Telepon</label>
                        <input type="tel" name="telepon" value="<?= esc($admin['telepon'] ?? '') ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Jabatan</label>
                        <input type="text" name="jabatan" value="<?= esc($admin['jabatan'] ?? '') ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                </div>
                
                <div style="margin-bottom: 2rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Alamat</label>
                    <textarea name="alamat" rows="3" 
                              style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;"><?= esc($admin['alamat'] ?? '') ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
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
        <form method="POST" action="/admin/profile/change-password" id="passwordForm">
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem;">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Password Lama</label>
                    <div style="position: relative;">
                        <input type="password" name="current_password" id="currentPassword" 
                               style="width: 100%; padding: 0.75rem 3rem 0.75rem 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;" required>
                        <button type="button" onclick="togglePassword('currentPassword')" 
                                style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #64748b;">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Password Baru</label>
                    <div style="position: relative;">
                        <input type="password" name="new_password" id="newPassword" 
                               style="width: 100%; padding: 0.75rem 3rem 0.75rem 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;" required>
                        <button type="button" onclick="togglePassword('newPassword')" 
                                style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #64748b;">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div style="font-size: 0.875rem; color: #64748b; margin-top: 0.25rem;">
                        Minimal 8 karakter, kombinasi huruf dan angka
                    </div>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Konfirmasi Password</label>
                    <div style="position: relative;">
                        <input type="password" name="confirm_password" id="confirmPassword" 
                               style="width: 100%; padding: 0.75rem 3rem 0.75rem 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;" required>
                        <button type="button" onclick="togglePassword('confirmPassword')" 
                                style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #64748b;">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-key"></i>
                    Ganti Password
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Activity Log -->
<div class="content-card" style="margin-top: 2rem;">
    <div class="card-header">
        <h3 class="card-title">Aktivitas Terakhir</h3>
    </div>
    <div class="card-body">
        <div style="max-height: 300px; overflow-y: auto;">
            <?php if (isset($activities) && !empty($activities)): ?>
                <?php foreach ($activities as $activity): ?>
                    <div style="display: flex; align-items: center; padding: 1rem; border-bottom: 1px solid #e2e8f0;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #f0fdf4; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                            <i class="fas fa-<?= $activity['icon'] ?? 'history' ?>" style="color: #059669;"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 500; margin-bottom: 0.25rem;">
                                <?= esc($activity['action']) ?>
                            </div>
                            <div style="font-size: 0.875rem; color: #64748b;">
                                <?= esc($activity['description']) ?>
                            </div>
                        </div>
                        <div style="font-size: 0.875rem; color: #64748b;">
                            <?= date('d/m/Y H:i', strtotime($activity['created_at'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; padding: 2rem; color: #64748b;">
                    <i class="fas fa-history" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <div>Belum ada aktivitas</div>
                </div>
            <?php endif; ?>
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
        
        fetch('/admin/profile/upload-photo', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update photo preview
                const img = document.querySelector('img[alt="Profile Photo"]');
                if (img) {
                    img.src = data.photo_url;
                } else {
                    // Replace icon with image
                    const iconDiv = document.querySelector('div[style*="border-radius: 50%"]');
                    iconDiv.innerHTML = `<img src="${data.photo_url}" alt="Profile Photo" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">`;
                }
                alert('Foto berhasil diupload');
            } else {
                alert('Gagal mengupload foto: ' + data.message);
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
    const nama = document.querySelector('input[name="nama"]').value;
    const email = document.querySelector('input[name="email"]').value;
    
    if (!nama.trim()) {
        alert('Nama lengkap harus diisi');
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

// Real-time password validation
document.getElementById('newPassword').addEventListener('input', function() {
    const password = this.value;
    let strength = 0;
    let feedback = [];
    
    if (password.length >= 8) strength++;
    else feedback.push('Minimal 8 karakter');
    
    if (/[a-z]/.test(password)) strength++;
    else feedback.push('Huruf kecil');
    
    if (/[A-Z]/.test(password)) strength++;
    else feedback.push('Huruf besar');
    
    if (/\d/.test(password)) strength++;
    else feedback.push('Angka');
    
    if (/[^a-zA-Z\d]/.test(password)) strength++;
    
    // Update visual feedback (you can add this if needed)
    let strengthText = '';
    let color = '';
    
    switch(strength) {
        case 0-1:
            strengthText = 'Sangat Lemah';
            color = '#ef4444';
            break;
        case 2:
            strengthText = 'Lemah';
            color = '#f59e0b';
            break;
        case 3:
            strengthText = 'Sedang';
            color = '#eab308';
            break;
        case 4:
            strengthText = 'Kuat';
            color = '#22c55e';
            break;
        case 5:
            strengthText = 'Sangat Kuat';
            color = '#059669';
            break;
    }
});

// Auto-save draft functionality
let saveTimeout;
document.querySelectorAll('input, textarea').forEach(input => {
    input.addEventListener('input', function() {
        clearTimeout(saveTimeout);
        saveTimeout = setTimeout(() => {
            // Save draft to localStorage
            const formData = new FormData(document.getElementById('profileForm'));
            const data = Object.fromEntries(formData);
            localStorage.setItem('profile_draft', JSON.stringify(data));
        }, 2000);
    });
});

// Load draft on page load
document.addEventListener('DOMContentLoaded', function() {
    const draft = localStorage.getItem('profile_draft');
    if (draft) {
        try {
            const data = JSON.parse(draft);
            Object.keys(data).forEach(key => {
                const input = document.querySelector(`[name="${key}"]`);
                if (input && input.value === '') {
                    input.value = data[key];
                }
            });
        } catch (e) {
            console.log('No valid draft found');
        }
    }
});
</script>

<?= $this->endSection() ?>
