<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-content">
        <div>
            <h2 class="page-title">Edit Pendaftar</h2>
            <p class="page-subtitle">Edit data calon siswa</p>
        </div>
        <div class="page-actions">
            <a href="/admin/pendaftar" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                <span class="btn-text">Kembali</span>
            </a>
        </div>
    </div>
</div>

<!-- Form Edit -->
<form action="/admin/pendaftar/update/<?= $student['id'] ?>" method="post" class="space-y-8">
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
                    <input type="text" name="nama_lengkap" value="<?= esc($student['nama_lengkap']) ?>" 
                           class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Tahun Ajaran <span class="required">*</span></label>
                    <select name="tahun_ajaran_id" class="form-input" required>
                        <option value="">Pilih Tahun Ajaran</option>
                        <?php if (!empty($tahunAjaranList)): ?>
                            <?php foreach ($tahunAjaranList as $tahun): ?>
                                <option value="<?= $tahun['id'] ?>" <?= $student['tahun_ajaran_id'] == $tahun['id'] ? 'selected' : '' ?>>
                                    <?= $tahun['nama'] ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Agama <span style="color: #ef4444;">*</span></label>
                    <select name="agama" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" required>
                        <option value="">Pilih Agama</option>
                        <option value="Islam" <?= $student['agama'] === 'Islam' ? 'selected' : '' ?>>Islam</option>
                        <option value="Kristen" <?= $student['agama'] === 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                        <option value="Katolik" <?= $student['agama'] === 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                        <option value="Hindu" <?= $student['agama'] === 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                        <option value="Buddha" <?= $student['agama'] === 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                        <option value="Konghucu" <?= $student['agama'] === 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
                    </select>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Jenis Kelamin <span style="color: #ef4444;">*</span></label>
                    <select name="jenis_kelamin" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" <?= $student['jenis_kelamin'] === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= $student['jenis_kelamin'] === 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Tempat Lahir <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="tempat_lahir" value="<?= esc($student['tempat_lahir']) ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                           required>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Tanggal Lahir <span style="color: #ef4444;">*</span></label>
                    <input type="date" name="tanggal_lahir" value="<?= $student['tanggal_lahir'] ?>" 
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
                    <input type="text" name="nama_ayah" value="<?= esc($student['nama_ayah']) ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                           required>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nama Ibu <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="nama_ibu" value="<?= esc($student['nama_ibu']) ?>" 
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
                              required><?= esc($student['alamat']) ?></textarea>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Alamat Domisili <span style="color: #ef4444;">*</span></label>
                    <textarea name="domisili" rows="3" 
                              style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;" 
                              required><?= esc($student['domisili']) ?></textarea>
                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #64748b;">Alamat tempat tinggal saat ini</p>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nomor Telepon <span style="color: #ef4444;">*</span></label>
                        <input type="tel" name="nomor_telepon" value="<?= esc($student['nomor_telepon']) ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                               required>
                    </div>
                    
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Asal TK/RA</label>
                        <input type="text" name="asal_tk_ra" value="<?= esc($student['asal_tk_ra']) ?>" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                        <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #64748b;">Nama TK/RA asal (opsional)</p>
                    </div>
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
            <span class="btn-text">Simpan Perubahan</span>
        </button>
    </div>
</form>

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
}
</style>

<?= $this->endSection() ?>
