<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<style>
/* Custom styling untuk button WhatsApp */
.btn-whatsapp {
    transition: all 0.2s ease;
    font-weight: 500;
}

.btn-whatsapp:hover {
    transform: translateY(-1px);
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
}

/* Styling untuk button warning dan success */
.btn-warning:hover {
    transform: translateY(-1px);
    box-shadow: 0 3px 10px rgba(255, 193, 7, 0.3);
}

.btn-success:hover {
    transform: translateY(-1px);
    box-shadow: 0 3px 10px rgba(40, 167, 69, 0.3);
}

/* Page Header Responsive */
.page-header {
    margin-bottom: 2rem;
}

.page-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.page-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
}

.page-subtitle {
    color: #64748b;
    margin: 0;
    font-size: 0.875rem;
}

.page-actions {
    display: flex;
    gap: 1rem;
    flex-shrink: 0;
    flex-wrap: wrap;
}

.btn-text {
    margin-left: 0.5rem;
}

/* Mobile Styles */
@media (max-width: 768px) {
    .page-header-content {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }

    .page-actions {
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-text {
        display: none;
    }

    .btn {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }
}

/* Extra Small Mobile */
@media (max-width: 480px) {
    .page-title {
        font-size: 1.25rem;
    }

    .page-actions {
        flex-direction: column;
        gap: 0.5rem;
    }

    .btn {
        justify-content: center;
        padding: 0.625rem 1rem;
    }
}
</style>

<div class="page-header">
    <div class="page-header-content">
        <div>
            <h2 class="page-title">Detail Pendaftar</h2>
            <p class="page-subtitle">Detail informasi calon siswa</p>
        </div>
        <div class="page-actions">
            <a href="/admin/pendaftar" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                <span class="btn-text">Kembali</span>
            </a>
            <?php if (!$student['accepted_at']): ?>
            <button onclick="validateStudent(<?= $student['id'] ?>)" class="btn btn-success" id="validateBtn">
                <i class="fas fa-check"></i>
                <span class="btn-text">Validasi Data</span>
            </button>
            <?php endif; ?>
            <a href="/admin/pendaftar/edit/<?= $student['id'] ?>" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                <span class="btn-text">Edit Data</span>
            </a>
        </div>
    </div>
</div>

<!-- Student Info Cards -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
    <!-- Status Card -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Status Pendaftar</h3>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">No. Registrasi</label>
                    <div style="font-family: monospace; font-weight: 600; color: #059669; font-size: 1.1rem;">
                        <?= esc($student['no_registrasi']) ?>
                    </div>
                </div>
                <div>
                    <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Status</label>
                    <span class="badge badge-<?= $student['status'] === 'siswa' ? 'success' : 'warning' ?>" style="font-size: 0.9rem; padding: 0.5rem 1rem;">
                        <?= ucfirst($student['status']) ?>
                    </span>
                </div>
                <div>
                    <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Tanggal Daftar</label>
                    <div style="font-weight: 600;">
                        <?= date('d F Y, H:i', strtotime($student['created_at'])) ?> WIB
                    </div>
                </div>
                <div>
                    <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Status Validasi</label>
                    <?php if ($student['accepted_at']): ?>
                        <span class="badge badge-success" style="font-size: 0.9rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-check"></i> Divalidasi
                        </span>
                        <div style="font-size: 0.875rem; color: #64748b; margin-top: 0.5rem;">
                            <?= date('d F Y, H:i', strtotime($student['accepted_at'])) ?> WIB
                        </div>
                    <?php else: ?>
                        <span class="badge badge-warning" style="font-size: 0.9rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-clock"></i> Belum Divalidasi
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Button Hubungi Pendaftar -->
            <?php if (!empty($student['nomor_telepon'])): ?>
            <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0;">
                <div style="display: flex; gap: 10px;">
                    <button onclick="hubungiPerbaikanData('<?= esc($student['nomor_telepon']) ?>', '<?= esc($student['nama_lengkap']) ?>', '<?= esc($student['no_registrasi']) ?>')" 
                            class="btn btn-warning" style="flex: 1; padding: 10px 12px; font-size: 14px;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 14px; margin-right: 6px;"></i>
                        Perlu Perbaikan
                    </button>
                    <button onclick="hubungiValidasiSelesai('<?= esc($student['nomor_telepon']) ?>', '<?= esc($student['nama_lengkap']) ?>', '<?= esc($student['no_registrasi']) ?>')" 
                            class="btn btn-success" style="flex: 1; padding: 10px 12px; font-size: 14px;">
                        <i class="fas fa-check-circle" style="font-size: 14px; margin-right: 6px;"></i>
                        Data Divalidasi
                    </button>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- User Account Info -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Informasi Akun</h3>
        </div>
        <div class="card-body">
            <div style="display: grid; gap: 1rem;">
                <div>
                    <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Username</label>
                    <div style="font-weight: 600;">
                        <?= $student['username'] ? esc($student['username']) : '<span style="color: #64748b;">Tidak ada akun</span>' ?>
                    </div>
                </div>
                <div>
                    <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Email</label>
                    <div style="font-weight: 600;">
                        <?= $student['email'] ? esc($student['email']) : '<span style="color: #64748b;">Tidak ada email</span>' ?>
                    </div>
                </div>
                <div>
                    <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Tahun Ajaran</label>
                    <div style="font-weight: 600;">
                        <?= $student['tahun_ajaran_nama'] ? esc($student['tahun_ajaran_nama']) : '<span style="color: #64748b;">Tidak ada</span>' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Data Pribadi -->
<div class="content-card" style="margin-bottom: 2rem;">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user"></i>
            Data Pribadi Siswa
        </h3>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <div>
                <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Nama Lengkap</label>
                <div style="font-weight: 600; font-size: 1.1rem;"><?= esc($student['nama_lengkap']) ?></div>
            </div>
            <div>
                <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Jenis Kelamin</label>
                <span class="badge badge-<?= $student['jenis_kelamin'] === 'L' ? 'primary' : 'pink' ?>">
                    <?= $student['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?>
                </span>
            </div>
            <div>
                <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Tempat Lahir</label>
                <div style="font-weight: 600;"><?= esc($student['tempat_lahir']) ?></div>
            </div>
            <div>
                <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Tanggal Lahir</label>
                <div style="font-weight: 600;"><?= date('d F Y', strtotime($student['tanggal_lahir'])) ?></div>
            </div>
            <div>
                <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Agama</label>
                <div style="font-weight: 600;"><?= esc($student['agama']) ?></div>
            </div>
            <div>
                <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Asal TK/RA</label>
                <div style="font-weight: 600;"><?= $student['asal_tk_ra'] ? esc($student['asal_tk_ra']) : '<span style="color: #64748b;">Tidak diisi</span>' ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Data Orang Tua -->
<div class="content-card" style="margin-bottom: 2rem;">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i>
            Data Orang Tua
        </h3>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div>
                <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Nama Ayah</label>
                <div style="font-weight: 600; font-size: 1.1rem;"><?= esc($student['nama_ayah']) ?></div>
            </div>
            <div>
                <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Nama Ibu</label>
                <div style="font-weight: 600; font-size: 1.1rem;"><?= esc($student['nama_ibu']) ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Alamat & Kontak -->
<div class="content-card" style="margin-bottom: 2rem;">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-map-marker-alt"></i>
            Alamat & Kontak
        </h3>
    </div>
    <div class="card-body">
        <div style="display: grid; gap: 1.5rem;">
            <div>
                <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Alamat Lengkap</label>
                <div style="font-weight: 600; line-height: 1.5;"><?= nl2br(esc($student['alamat'])) ?></div>
            </div>
            <div>
                <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Alamat Domisili</label>
                <div style="font-weight: 600; line-height: 1.5;"><?= nl2br(esc($student['domisili'])) ?></div>
            </div>
            <div>
                <label style="display: block; font-weight: 500; color: #64748b; margin-bottom: 0.5rem;">Nomor Telepon</label>
                <div style="font-weight: 600; font-family: monospace;"><?= esc($student['nomor_telepon']) ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Dokumen -->
<div class="content-card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-file-upload"></i>
            Dokumen
        </h3>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
            <div style="text-align: center; padding: 1rem; border: 2px dashed #d1d5db; border-radius: 8px;">
                <i class="fas fa-file-alt" style="font-size: 2rem; color: #64748b; margin-bottom: 0.5rem;"></i>
                <div style="font-weight: 500; margin-bottom: 0.5rem;">Akta Kelahiran</div>
                <?php if ($student['akta_url']): ?>
                    <a href="/uploads/<?= esc($student['akta_url']) ?>" target="_blank" class="btn btn-secondary btn-sm">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                <?php else: ?>
                    <span style="color: #64748b; font-size: 0.875rem;">Tidak ada file</span>
                <?php endif; ?>
            </div>
            
            <div style="text-align: center; padding: 1rem; border: 2px dashed #d1d5db; border-radius: 8px;">
                <i class="fas fa-file-alt" style="font-size: 2rem; color: #64748b; margin-bottom: 0.5rem;"></i>
                <div style="font-weight: 500; margin-bottom: 0.5rem;">Kartu Keluarga</div>
                <?php if ($student['kk_url']): ?>
                    <a href="/uploads/<?= esc($student['kk_url']) ?>" target="_blank" class="btn btn-secondary btn-sm">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                <?php else: ?>
                    <span style="color: #64748b; font-size: 0.875rem;">Tidak ada file</span>
                <?php endif; ?>
            </div>
            
            <div style="text-align: center; padding: 1rem; border: 2px dashed #d1d5db; border-radius: 8px;">
                <i class="fas fa-file-alt" style="font-size: 2rem; color: #64748b; margin-bottom: 0.5rem;"></i>
                <div style="font-weight: 500; margin-bottom: 0.5rem;">Ijazah TK/RA</div>
                <?php if ($student['ijazah_url']): ?>
                    <a href="/uploads/<?= esc($student['ijazah_url']) ?>" target="_blank" class="btn btn-secondary btn-sm">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                <?php else: ?>
                    <span style="color: #64748b; font-size: 0.875rem;">Tidak ada file</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
function validateStudent(id) {
    if (confirm('Apakah Anda yakin data pendaftar ini sudah valid dan ingin disetujui?')) {
        const validateBtn = document.getElementById('validateBtn');
        validateBtn.disabled = true;
        validateBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memvalidasi...';
        
        fetch('/admin/pendaftar/validate/' + id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert('Error: ' + data.message);
                validateBtn.disabled = false;
                validateBtn.innerHTML = '<i class="fas fa-check"></i> Validasi Data';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memvalidasi data');
            validateBtn.disabled = false;
            validateBtn.innerHTML = '<i class="fas fa-check"></i> Validasi Data';
        });
    }
}

function hubungiPerbaikanData(nomorTelepon, namaLengkap, noRegistrasi) {
    // Bersihkan nomor telepon (hapus karakter non-digit)
    let cleanNumber = nomorTelepon.replace(/\D/g, '');
    
    // Tambahkan kode negara Indonesia jika belum ada
    if (cleanNumber.startsWith('0')) {
        cleanNumber = '62' + cleanNumber.substring(1);
    } else if (!cleanNumber.startsWith('62')) {
        cleanNumber = '62' + cleanNumber;
    }
    
    // Template pesan untuk perbaikan data
    const templatePesan = `Assalamu'alaikum Wr. Wb.

Halo ${namaLengkap},

Saya dari Admin PPDB SD Nahdlatul Ulama. Terkait pendaftaran Anda dengan nomor registrasi: *${noRegistrasi}*

Setelah kami lakukan pengecekan, terdapat beberapa data yang perlu diperbaiki atau dilengkapi:

1. _(Sebutkan data/dokumen yang perlu diperbaiki)_
2. _(Contoh: Foto dokumen kurang jelas)_
3. _(Contoh: Data alamat perlu dilengkapi)_

Mohon untuk segera melakukan perbaikan melalui akun pendaftaran Anda dengan login di: 
*${window.location.origin}*

Batas waktu perbaikan: *3 hari kerja* dari sekarang.

Jika mengalami kendala, silakan hubungi kami kembali.

Terima kasih atas kerjasamanya.

Wassalamu'alaikum Wr. Wb.

*Admin PPDB SD Nahdlatul Ulama*`;

    // Encode pesan untuk URL
    const encodedMessage = encodeURIComponent(templatePesan);
    
    // Buka WhatsApp
    const whatsappUrl = `https://wa.me/${cleanNumber}?text=${encodedMessage}`;
    window.open(whatsappUrl, '_blank');
}

function hubungiValidasiSelesai(nomorTelepon, namaLengkap, noRegistrasi) {
    // Bersihkan nomor telepon (hapus karakter non-digit)
    let cleanNumber = nomorTelepon.replace(/\D/g, '');
    
    // Tambahkan kode negara Indonesia jika belum ada
    if (cleanNumber.startsWith('0')) {
        cleanNumber = '62' + cleanNumber.substring(1);
    } else if (!cleanNumber.startsWith('62')) {
        cleanNumber = '62' + cleanNumber;
    }
    
    // Template pesan untuk validasi selesai
    const templatePesan = `Assalamu'alaikum Wr. Wb.

Selamat! ${namaLengkap}

Kami dengan senang hati mengabarkan bahwa pendaftaran Anda dengan nomor registrasi *${noRegistrasi}* telah *BERHASIL DIVALIDASI* di SD Nahdlatul Ulama.

📋 *LANGKAH SELANJUTNYA - DAFTAR ULANG:*

1. *Waktu Daftar Ulang:*
   _(Akan diinformasikan kemudian sesuai jadwal)_

2. *Dokumen yang Perlu Dibawa:*
   • Dokumen asli untuk verifikasi
   • Fotocopy dokumen (2 rangkap)
   • Pas foto terbaru 3x4 (4 lembar)
   • Map plastik untuk berkas

3. *Biaya Daftar Ulang:*
   _(Sesuai ketentuan yang berlaku)_

4. *Lokasi Daftar Ulang:*
   SD Nahdlatul Ulama
   _(Alamat lengkap akan diinformasikan)_

*Informasi lengkap akan kami sampaikan melalui pengumuman resmi di website dan grup WhatsApp orangtua.*

Selamat bergabung di keluarga besar SD Nahdlatul Ulama!

Wassalamu'alaikum Wr. Wb.

*Admin PPDB SD Nahdlatul Ulama*`;

    // Encode pesan untuk URL
    const encodedMessage = encodeURIComponent(templatePesan);
    
    // Buka WhatsApp
    const whatsappUrl = `https://wa.me/${cleanNumber}?text=${encodedMessage}`;
    window.open(whatsappUrl, '_blank');
}
</script>

<?= $this->endSection() ?>
