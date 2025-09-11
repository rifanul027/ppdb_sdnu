<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-content">
        <div>
            <h2 class="page-title">Tambah Pendaftar</h2>
            <p class="page-subtitle">Tambahkan data calon siswa baru</p>
        </div>
        <div class="page-actions">
            <a href="/admin/pendaftar" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                <span class="btn-text">Kembali</span>
            </a>
        </div>
    </div>
</div>

<!-- Alert Messages -->
<?php if (isset($validation)): ?>
    <div class="alert alert-danger" role="alert">
        <h5 class="alert-heading">
            <i class="fas fa-exclamation-triangle"></i>
            Terjadi kesalahan validasi
        </h5>
        <hr>
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger" role="alert">
        <i class="fas fa-exclamation-circle"></i>
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<!-- Form Tambah -->
<form action="/admin/pendaftar/store" method="post" enctype="multipart/form-data" class="space-y-8">
    <?= csrf_field() ?>
    
    <!-- Data Pribadi -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user"></i>
                Data Pribadi Siswa
            </h3>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" 
                           class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Tahun Ajaran <span class="required">*</span></label>
                    <select name="tahun_ajaran_id" class="form-input" required>
                        <option value="">Pilih Tahun Ajaran</option>
                        <?php if (!empty($tahunAjaranList)): ?>
                            <?php foreach ($tahunAjaranList as $tahun): ?>
                                <option value="<?= $tahun['id'] ?>" <?= old('tahun_ajaran_id') === $tahun['id'] ? 'selected' : '' ?>>
                                    <?= $tahun['nama'] ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Agama <span class="required">*</span></label>
                    <select name="agama" class="form-input" required>
                        <option value="">Pilih Agama</option>
                        <option value="Islam" <?= old('agama') === 'Islam' ? 'selected' : '' ?>>Islam</option>
                        <option value="Kristen" <?= old('agama') === 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                        <option value="Katolik" <?= old('agama') === 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                        <option value="Hindu" <?= old('agama') === 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                        <option value="Buddha" <?= old('agama') === 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                        <option value="Konghucu" <?= old('agama') === 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin <span class="required">*</span></label>
                    <select name="jenis_kelamin" class="form-input" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" <?= old('jenis_kelamin') === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= old('jenis_kelamin') === 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Tempat Lahir <span class="required">*</span></label>
                    <input type="text" name="tempat_lahir" value="<?= old('tempat_lahir') ?>" 
                           class="form-input" required>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Tanggal Lahir <span style="color: #ef4444;">*</span></label>
                    <input type="date" name="tanggal_lahir" value="<?= old('tanggal_lahir') ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                           required>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Data Orang Tua -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-users"></i>
                Data Orang Tua
            </h3>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nama Ayah <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="nama_ayah" value="<?= old('nama_ayah') ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                           required>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nama Ibu <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="nama_ibu" value="<?= old('nama_ibu') ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                           required>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Alamat & Kontak -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-map-marker-alt"></i>
                Alamat & Kontak
            </h3>
        </div>
        <div class="card-body">
            <div style="display: grid; gap: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Alamat Lengkap <span style="color: #ef4444;">*</span></label>
                    <textarea name="alamat" rows="3" 
                              style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;" 
                              required><?= old('alamat') ?></textarea>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Alamat Domisili <span style="color: #ef4444;">*</span></label>
                    <textarea name="domisili" rows="3" 
                              style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;" 
                              required><?= old('domisili') ?></textarea>
                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #64748b;">Alamat tempat tinggal saat ini</p>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nomor Telepon <span style="color: #ef4444;">*</span></label>
                        <input type="tel" name="nomor_telepon" value="<?= old('nomor_telepon') ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                               required>
                    </div>
                    
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Asal TK/RA</label>
                        <input type="text" name="asal_tk_ra" value="<?= old('asal_tk_ra') ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                        <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #64748b;">Nama TK/RA asal (opsional)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Data Akun User -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user-cog"></i>
                Data Akun User
            </h3>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Username <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="username" value="<?= old('username') ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                           required>
                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #64748b;">Username untuk login siswa</p>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Email <span style="color: #ef4444;">*</span></label>
                    <input type="email" name="email" value="<?= old('email') ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                           required>
                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #64748b;">Email untuk login siswa</p>
                </div>
            </div>
            
            <div style="margin-top: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Password <span style="color: #ef4444;">*</span></label>
                    <input type="password" name="password" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                           required>
                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #64748b;">Password untuk login siswa (minimal 8 karakter)</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Upload Dokumen -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-file-upload"></i>
                Upload Dokumen
            </h3>
        </div>
        <div class="card-body">
            <div style="display: grid; gap: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Akta Kelahiran <span style="color: #ef4444;">*</span></label>
                    <input type="file" name="akta" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                           accept=".pdf,.jpg,.jpeg,.png" required>
                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #64748b;">Format: PDF, JPG, atau PNG (Maksimal 5MB)</p>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Kartu Keluarga <span style="color: #ef4444;">*</span></label>
                    <input type="file" name="kk" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                           accept=".pdf,.jpg,.jpeg,.png" required>
                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #64748b;">Format: PDF, JPG, atau PNG (Maksimal 5MB)</p>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Ijazah TK/RA</label>
                    <input type="file" name="ijazah" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                           accept=".pdf,.jpg,.jpeg,.png">
                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #64748b;">Upload jika ada (opsional) - Format: PDF, JPG, atau PNG (Maksimal 5MB)</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Submit Button -->
    <div style="display: flex; gap: 1rem; justify-content: end;">
        <a href="/admin/pendaftar" class="btn btn-secondary">
            <i class="fas fa-times"></i>
            Batal
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            Simpan Data
        </button>
    </div>
</form>

<!-- Modal Success -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">
                    <i class="fas fa-check-circle"></i>
                    Pendaftaran Berhasil!
                </h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Selamat!</h4>
                    <p>Data pendaftar berhasil disimpan. Berikut adalah informasi akun yang telah dibuat:</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-user"></i>
                                    Data Pendaftar
                                </h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>No. Registrasi:</strong></td>
                                        <td id="modal-no-registrasi"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama Lengkap:</strong></td>
                                        <td id="modal-nama-lengkap"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tahun Ajaran:</strong></td>
                                        <td id="modal-tahun-ajaran"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-key"></i>
                                    Informasi Login
                                </h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Username:</strong></td>
                                        <td id="modal-username"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td id="modal-email"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Password:</strong></td>
                                        <td id="modal-password"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info mt-3" role="alert">
                    <i class="fas fa-info-circle"></i>
                    <strong>Penting!</strong> Silakan catat atau screenshot informasi login di atas untuk diberikan kepada siswa/orang tua.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="redirectToPendaftar()">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Data Pendaftar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function redirectToPendaftar() {
    window.location.href = '/admin/pendaftar';
}

// Check if success data exists in session
<?php if (session()->get('success_data')): ?>
    $(document).ready(function() {
        const successData = <?= json_encode(session()->get('success_data')) ?>;
        
        // Populate modal with data
        $('#modal-no-registrasi').text(successData.no_registrasi);
        $('#modal-nama-lengkap').text(successData.nama_lengkap);
        $('#modal-tahun-ajaran').text(successData.tahun_ajaran);
        $('#modal-username').text(successData.username);
        $('#modal-email').text(successData.email);
        $('#modal-password').text(successData.password);
        
        // Show modal
        $('#successModal').modal('show');
    });
<?php endif; ?>
</script>

<style>
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
}

/* Form Responsive */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    display: block;
    font-weight: 500;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.required {
    color: #ef4444;
}

.form-input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-textarea {
    min-height: 100px;
    resize: vertical;
}

.btn-text {
    margin-left: 0.5rem;
}

/* Alert Responsive */
.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.alert-danger {
    background-color: #fee2e2;
    border: 1px solid #fca5a5;
    color: #dc2626;
}

.alert-heading {
    margin-bottom: 0.5rem;
    font-weight: 600;
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
    }

    .btn-text {
        display: none;
    }

    .form-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .form-input {
        padding: 0.625rem;
        font-size: 1rem;
    }

    .card-body {
        padding: 1rem;
    }

    .card-header {
        padding: 1rem 1rem 0;
    }
}

/* Extra Small Mobile */
@media (max-width: 480px) {
    .page-title {
        font-size: 1.25rem;
    }

    .btn {
        padding: 0.625rem 1rem;
        justify-content: center;
    }

    .form-input {
        padding: 0.5rem;
    }

    .content-card {
        margin-bottom: 1rem;
    }

    .alert {
        padding: 0.75rem;
        font-size: 0.875rem;
    }
}

/* Print Styles */
@media print {
    .page-actions,
    .btn {
        display: none !important;
    }
    
    .page-header {
        margin-bottom: 1rem;
    }
}
</style>

<?= $this->endSection() ?>
