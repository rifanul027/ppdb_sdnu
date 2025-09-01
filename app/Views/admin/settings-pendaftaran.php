<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">Pengaturan Pendaftaran</h2>
        <p style="color: #64748b;">Kelola jadwal dan persyaratan pendaftaran</p>
    </div>
    <a href="/admin/settings" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Settings
    </a>
</div>

<!-- Settings Navigation -->
<div class="content-card" style="margin-bottom: 2rem;">
    <div class="card-body" style="padding: 1rem;">
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="/admin/settings" class="settings-tab">
                <i class="fas fa-cogs"></i>
                Pengaturan Umum
            </a>
            <a href="/admin/settings/biaya" class="settings-tab">
                <i class="fas fa-money-bill-wave"></i>
                Biaya Sekolah
            </a>
            <a href="/admin/settings/pendaftaran" class="settings-tab active">
                <i class="fas fa-calendar-alt"></i>
                Pendaftaran
            </a>
            <a href="/admin/settings/email" class="settings-tab">
                <i class="fas fa-envelope"></i>
                Email Template
            </a>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <!-- Jadwal Pendaftaran -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Jadwal Pendaftaran</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="/admin/settings/pendaftaran/jadwal">
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tanggal Buka Pendaftaran</label>
                    <input type="date" name="tanggal_buka" value="<?= $settings['tanggal_buka'] ?? '2025-01-01' ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;" required>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tanggal Tutup Pendaftaran</label>
                    <input type="date" name="tanggal_tutup" value="<?= $settings['tanggal_tutup'] ?? '2025-06-30' ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;" required>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Jam Buka</label>
                        <input type="time" name="jam_buka" value="<?= $settings['jam_buka'] ?? '08:00' ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Jam Tutup</label>
                        <input type="time" name="jam_tutup" value="<?= $settings['jam_tutup'] ?? '16:00' ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Hari Libur Pendaftaran</label>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 0.5rem;">
                        <?php 
                        $hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
                        $hariLibur = $settings['hari_libur'] ?? ['minggu'];
                        ?>
                        <?php foreach ($hari as $h): ?>
                            <label style="display: flex; align-items: center; cursor: pointer; padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 8px;">
                                <input type="checkbox" name="hari_libur[]" value="<?= $h ?>" 
                                       <?= in_array($h, $hariLibur) ? 'checked' : '' ?>
                                       style="margin-right: 0.5rem;">
                                <span style="text-transform: capitalize;"><?= $h ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div style="padding: 1rem; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: start; gap: 0.5rem;">
                        <i class="fas fa-info-circle" style="color: #059669; margin-top: 0.25rem;"></i>
                        <div>
                            <div style="font-weight: 500; color: #065f46; margin-bottom: 0.25rem;">Status Pendaftaran</div>
                            <div id="statusPendaftaran" style="color: #065f46; font-size: 0.875rem;">
                                <?= $this->getStatusPendaftaran() ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-save"></i>
                    Simpan Jadwal
                </button>
            </form>
        </div>
    </div>
    
    <!-- Persyaratan Pendaftaran -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Persyaratan Usia & Dokumen</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="/admin/settings/pendaftaran/persyaratan">
                <div style="margin-bottom: 2rem;">
                    <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 1rem; color: #374151;">Batasan Usia</h4>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Usia Minimal (tahun)</label>
                            <input type="number" name="min_umur" value="<?= $settings['min_umur'] ?? 6 ?>" min="5" max="8"
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Usia Maksimal (tahun)</label>
                            <input type="number" name="max_umur" value="<?= $settings['max_umur'] ?? 7 ?>" min="5" max="8"
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                        </div>
                    </div>
                    
                    <div style="padding: 0.75rem; background: #fef3c7; border: 1px solid #fbbf24; border-radius: 8px; margin-bottom: 1.5rem;">
                        <div style="font-size: 0.875rem; color: #92400e;">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Catatan:</strong> Usia dihitung berdasarkan tanggal 1 Juli tahun ajaran berjalan
                        </div>
                    </div>
                </div>
                
                <div style="margin-bottom: 2rem;">
                    <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 1rem; color: #374151;">Dokumen Persyaratan</h4>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Dokumen Wajib</label>
                        <textarea name="persyaratan" rows="6" 
                                  style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;"
                                  placeholder="Masukkan daftar dokumen yang wajib dilengkapi..."><?= $settings['persyaratan'] ?? 'Fotokopi akte kelahiran
Fotokopi Kartu Keluarga (KK)
Pas foto berwarna ukuran 3x4 sebanyak 4 lembar
Fotokopi KTP orang tua
Surat keterangan sehat dari dokter' ?></textarea>
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="verifikasi_dokumen" value="1" 
                                   <?= ($settings['verifikasi_dokumen'] ?? 1) ? 'checked' : '' ?>
                                   style="margin-right: 0.5rem;">
                            <span>Wajib Upload Dokumen Saat Pendaftaran</span>
                        </label>
                        <div style="font-size: 0.875rem; color: #64748b; margin-top: 0.25rem; margin-left: 1.5rem;">
                            Jika dicentang, pendaftar harus mengupload semua dokumen persyaratan
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-save"></i>
                    Simpan Persyaratan
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Pengaturan Tambahan -->
<div class="content-card" style="margin-top: 2rem;">
    <div class="card-header">
        <h3 class="card-title">Pengaturan Tambahan</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="/admin/settings/pendaftaran/tambahan">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <div>
                    <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 1rem; color: #374151;">Notifikasi & Email</h4>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="email_konfirmasi" value="1" 
                                   <?= ($settings['email_konfirmasi'] ?? 1) ? 'checked' : '' ?>
                                   style="margin-right: 0.5rem;">
                            <span>Kirim email konfirmasi setelah pendaftaran</span>
                        </label>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="sms_notifikasi" value="1" 
                                   <?= ($settings['sms_notifikasi'] ?? 0) ? 'checked' : '' ?>
                                   style="margin-right: 0.5rem;">
                            <span>Kirim SMS notifikasi (jika tersedia)</span>
                        </label>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="notif_whatsapp" value="1" 
                                   <?= ($settings['notif_whatsapp'] ?? 0) ? 'checked' : '' ?>
                                   style="margin-right: 0.5rem;">
                            <span>Notifikasi WhatsApp (jika tersedia)</span>
                        </label>
                    </div>
                </div>
                
                <div>
                    <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 1rem; color: #374151;">Pembatasan Pendaftaran</h4>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Maksimal Pendaftaran per Hari</label>
                        <input type="number" name="max_pendaftar_harian" value="<?= $settings['max_pendaftar_harian'] ?? 0 ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;"
                               placeholder="0 = tidak terbatas">
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="daftar_ulang_otomatis" value="1" 
                                   <?= ($settings['daftar_ulang_otomatis'] ?? 0) ? 'checked' : '' ?>
                                   style="margin-right: 0.5rem;">
                            <span>Daftar ulang otomatis setelah diterima</span>
                        </label>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="validasi_domisili" value="1" 
                                   <?= ($settings['validasi_domisili'] ?? 0) ? 'checked' : '' ?>
                                   style="margin-right: 0.5rem;">
                            <span>Validasi domisili sesuai wilayah sekolah</span>
                        </label>
                    </div>
                </div>
                
                <div>
                    <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 1rem; color: #374151;">Pengumuman & Publikasi</h4>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tanggal Pengumuman</label>
                        <input type="date" name="tanggal_pengumuman" value="<?= $settings['tanggal_pengumuman'] ?? '' ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="publikasi_website" value="1" 
                                   <?= ($settings['publikasi_website'] ?? 1) ? 'checked' : '' ?>
                                   style="margin-right: 0.5rem;">
                            <span>Publikasi pengumuman di website</span>
                        </label>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="cetak_formulir" value="1" 
                                   <?= ($settings['cetak_formulir'] ?? 1) ? 'checked' : '' ?>
                                   style="margin-right: 0.5rem;">
                            <span>Izinkan cetak formulir pendaftaran</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e2e8f0;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Pengaturan Tambahan
                </button>
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

@media (max-width: 768px) {
    div[style*="grid-template-columns: 1fr 1fr"] {
        display: block;
    }
    
    .content-card {
        margin-bottom: 2rem;
    }
    
    div[style*="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr))"] {
        display: block;
    }
    
    div[style*="grid-template-columns: repeat(auto-fit, minmax(120px, 1fr))"] {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

<script>
// Update status pendaftaran secara real-time
function updateStatusPendaftaran() {
    const tanggalBuka = document.querySelector('input[name="tanggal_buka"]').value;
    const tanggalTutup = document.querySelector('input[name="tanggal_tutup"]').value;
    const jamBuka = document.querySelector('input[name="jam_buka"]').value;
    const jamTutup = document.querySelector('input[name="jam_tutup"]').value;
    
    if (tanggalBuka && tanggalTutup) {
        const sekarang = new Date();
        const buka = new Date(tanggalBuka);
        const tutup = new Date(tanggalTutup);
        
        let status = '';
        let color = '';
        
        if (sekarang < buka) {
            status = `Pendaftaran belum dibuka (akan dibuka pada ${buka.toLocaleDateString('id-ID')})`;
            color = '#f59e0b';
        } else if (sekarang > tutup) {
            status = `Pendaftaran sudah ditutup (ditutup pada ${tutup.toLocaleDateString('id-ID')})`;
            color = '#ef4444';
        } else {
            status = `Pendaftaran sedang dibuka (sampai ${tutup.toLocaleDateString('id-ID')})`;
            color = '#22c55e';
        }
        
        const statusElement = document.getElementById('statusPendaftaran');
        statusElement.textContent = status;
        statusElement.style.color = color;
    }
}

// Add event listeners
document.addEventListener('DOMContentLoaded', function() {
    updateStatusPendaftaran();
    
    document.querySelector('input[name="tanggal_buka"]').addEventListener('change', updateStatusPendaftaran);
    document.querySelector('input[name="tanggal_tutup"]').addEventListener('change', updateStatusPendaftaran);
});

// Validation
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (form.querySelector('input[name="tanggal_buka"]') && form.querySelector('input[name="tanggal_tutup"]')) {
            const tanggalBuka = new Date(form.querySelector('input[name="tanggal_buka"]').value);
            const tanggalTutup = new Date(form.querySelector('input[name="tanggal_tutup"]').value);
            
            if (tanggalBuka >= tanggalTutup) {
                alert('Tanggal tutup harus setelah tanggal buka');
                e.preventDefault();
                return;
            }
        }
        
        if (form.querySelector('input[name="min_umur"]') && form.querySelector('input[name="max_umur"]')) {
            const minUmur = parseInt(form.querySelector('input[name="min_umur"]').value);
            const maxUmur = parseInt(form.querySelector('input[name="max_umur"]').value);
            
            if (minUmur >= maxUmur) {
                alert('Usia maksimal harus lebih besar dari usia minimal');
                e.preventDefault();
                return;
            }
        }
    });
});

// Auto-save draft
let saveTimeout;
document.querySelectorAll('input, textarea, select').forEach(input => {
    input.addEventListener('input', function() {
        clearTimeout(saveTimeout);
        saveTimeout = setTimeout(() => {
            // Save draft to localStorage
            const formData = new FormData(this.closest('form'));
            const data = Object.fromEntries(formData);
            localStorage.setItem('pendaftaran_settings_draft', JSON.stringify(data));
        }, 2000);
    });
});
</script>

<?= $this->endSection() ?>
