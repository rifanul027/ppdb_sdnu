<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="margin-bottom: 2rem;">
    <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">Settings</h2>
    <p style="color: #64748b;">Kelola pengaturan sistem PPDB</p>
</div>

<!-- Settings Navigation -->
<div class="content-card" style="margin-bottom: 2rem;">
    <div class="card-body" style="padding: 1rem;">
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="/admin/settings" class="settings-tab <?= ($activeTab ?? 'general') === 'general' ? 'active' : '' ?>">
                <i class="fas fa-cogs"></i>
                Pengaturan Umum
            </a>
            <a href="/admin/settings/biaya" class="settings-tab <?= ($activeTab ?? '') === 'biaya' ? 'active' : '' ?>">
                <i class="fas fa-money-bill-wave"></i>
                Biaya Sekolah
            </a>
            <a href="/admin/settings/pendaftaran" class="settings-tab <?= ($activeTab ?? '') === 'pendaftaran' ? 'active' : '' ?>">
                <i class="fas fa-calendar-alt"></i>
                Pendaftaran
            </a>
            <a href="/admin/settings/email" class="settings-tab <?= ($activeTab ?? '') === 'email' ? 'active' : '' ?>">
                <i class="fas fa-envelope"></i>
                Email Template
            </a>
        </div>
    </div>
</div>

<!-- General Settings -->
<div class="content-card">
    <div class="card-header">
        <h3 class="card-title">Pengaturan Umum</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="/admin/settings/save" enctype="multipart/form-data">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <!-- Left Column -->
                <div>
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" value="<?= esc($settings['nama_sekolah'] ?? 'SD Nahdlatul Ulama') ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Alamat Sekolah</label>
                        <textarea name="alamat_sekolah" rows="3" 
                                  style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;"><?= esc($settings['alamat_sekolah'] ?? '') ?></textarea>
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Nomor Telepon</label>
                        <input type="text" name="telepon" value="<?= esc($settings['telepon'] ?? '') ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email Sekolah</label>
                        <input type="email" name="email" value="<?= esc($settings['email'] ?? '') ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Website</label>
                        <input type="url" name="website" value="<?= esc($settings['website'] ?? '') ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                </div>
                
                <!-- Right Column -->
                <div>
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Logo Sekolah</label>
                        <div style="border: 2px dashed #d1d5db; border-radius: 8px; padding: 2rem; text-align: center;">
                            <?php if (isset($settings['logo']) && !empty($settings['logo'])): ?>
                                <img src="<?= base_url($settings['logo']) ?>" alt="Logo" style="max-width: 150px; max-height: 150px; margin-bottom: 1rem;">
                            <?php else: ?>
                                <i class="fas fa-image" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem;"></i>
                            <?php endif; ?>
                            <div>
                                <input type="file" name="logo" accept="image/*" id="logoInput" style="display: none;">
                                <label for="logoInput" class="btn btn-secondary" style="cursor: pointer;">
                                    <i class="fas fa-upload"></i>
                                    Pilih Logo
                                </label>
                            </div>
                            <div style="font-size: 0.875rem; color: #64748b; margin-top: 0.5rem;">
                                Format: JPG, PNG, maksimal 2MB
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Deskripsi Sekolah</label>
                        <textarea name="deskripsi" rows="6" 
                                  style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;"
                                  placeholder="Masukkan deskripsi singkat tentang sekolah..."><?= esc($settings['deskripsi'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
            
            <!-- System Settings -->
            <div style="border-top: 1px solid #e2e8f0; padding-top: 2rem; margin-top: 2rem;">
                <h4 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 1.5rem;">Pengaturan Sistem</h4>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                    <div>
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tahun Ajaran Aktif</label>
                            <select name="tahun_ajaran_aktif" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                                <option value="2024/2025" <?= ($settings['tahun_ajaran_aktif'] ?? '') === '2024/2025' ? 'selected' : '' ?>>2024/2025</option>
                                <option value="2025/2026" <?= ($settings['tahun_ajaran_aktif'] ?? '') === '2025/2026' ? 'selected' : '' ?>>2025/2026</option>
                                <option value="2026/2027" <?= ($settings['tahun_ajaran_aktif'] ?? '') === '2026/2027' ? 'selected' : '' ?>>2026/2027</option>
                            </select>
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Maksimal Kuota Siswa</label>
                            <input type="number" name="max_kuota" value="<?= esc($settings['max_kuota'] ?? 100) ?>" 
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: flex; align-items: center; cursor: pointer;">
                                <input type="checkbox" name="auto_approve" value="1" 
                                       <?= ($settings['auto_approve'] ?? 0) ? 'checked' : '' ?>
                                       style="margin-right: 0.5rem;">
                                <span>Auto Approve Pendaftaran</span>
                            </label>
                            <div style="font-size: 0.875rem; color: #64748b; margin-top: 0.25rem;">
                                Otomatis menerima pendaftaran tanpa verifikasi manual
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Zona Waktu</label>
                            <select name="timezone" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                                <option value="Asia/Jakarta" <?= ($settings['timezone'] ?? '') === 'Asia/Jakarta' ? 'selected' : '' ?>>WIB (Asia/Jakarta)</option>
                                <option value="Asia/Makassar" <?= ($settings['timezone'] ?? '') === 'Asia/Makassar' ? 'selected' : '' ?>>WITA (Asia/Makassar)</option>
                                <option value="Asia/Jayapura" <?= ($settings['timezone'] ?? '') === 'Asia/Jayapura' ? 'selected' : '' ?>>WIT (Asia/Jayapura)</option>
                            </select>
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Format Nomor Registrasi</label>
                            <input type="text" name="format_no_reg" value="<?= esc($settings['format_no_reg'] ?? 'PPDB-{YYYY}-{NNNN}') ?>" 
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                            <div style="font-size: 0.875rem; color: #64748b; margin-top: 0.25rem;">
                                {YYYY} = Tahun, {NNNN} = Nomor urut
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: flex; align-items: center; cursor: pointer;">
                                <input type="checkbox" name="email_notification" value="1" 
                                       <?= ($settings['email_notification'] ?? 1) ? 'checked' : '' ?>
                                       style="margin-right: 0.5rem;">
                                <span>Kirim Notifikasi Email</span>
                            </label>
                            <div style="font-size: 0.875rem; color: #64748b; margin-top: 0.25rem;">
                                Kirim email notifikasi ke pendaftar
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e2e8f0;">
                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan Pengaturan
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-undo"></i>
                        Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
.settings-tab {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    text-decoration: none;
    color: #64748b;
    border-radius: 8px;
    transition: all 0.2s ease;
    border: 1px solid #e2e8f0;
    background: white;
}

.settings-tab:hover {
    color: #059669;
    border-color: #059669;
    background: #f0fdf4;
}

.settings-tab.active {
    color: white;
    background: #059669;
    border-color: #059669;
}

.settings-tab i {
    font-size: 1rem;
}

@media (max-width: 768px) {
    .content-card div[style*="grid-template-columns: 1fr 1fr"] {
        display: block;
    }
    
    .content-card div[style*="grid-template-columns: 1fr 1fr"] > div {
        margin-bottom: 2rem;
    }
    
    .settings-tab {
        flex: 1;
        justify-content: center;
        min-width: 0;
    }
    
    .settings-tab span {
        display: none;
    }
    
    .settings-tab i {
        font-size: 1.25rem;
    }
}
</style>

<script>
// Preview logo when selected
document.getElementById('logoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.querySelector('img[alt="Logo"]');
            if (preview) {
                preview.src = e.target.result;
            } else {
                const container = document.querySelector('.fas.fa-image').parentElement;
                container.innerHTML = `<img src="${e.target.result}" alt="Logo Preview" style="max-width: 150px; max-height: 150px; margin-bottom: 1rem;">`;
            }
        };
        reader.readAsDataURL(file);
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const namaSekolah = document.querySelector('input[name="nama_sekolah"]').value;
    const maxKuota = document.querySelector('input[name="max_kuota"]').value;
    
    if (!namaSekolah.trim()) {
        alert('Nama sekolah harus diisi');
        e.preventDefault();
        return;
    }
    
    if (!maxKuota || maxKuota < 1) {
        alert('Maksimal kuota harus diisi dengan nilai yang valid');
        e.preventDefault();
        return;
    }
});
</script>

<?= $this->endSection() ?>
