<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">Tambah Pendaftar</h2>
        <p style="color: #64748b;">Tambahkan data calon siswa baru</p>
    </div>
    <div>
        <a href="/admin/pendaftar" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>
</div>

<!-- Form Tambah -->
<form action="/admin/pendaftar/store" method="post" class="space-y-8">
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
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nama Lengkap <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                           required>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Tahun Ajaran <span style="color: #ef4444;">*</span></label>
                    <select name="tahun_ajaran_id" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" required>
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
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Agama <span style="color: #ef4444;">*</span></label>
                    <select name="agama" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" required>
                        <option value="">Pilih Agama</option>
                        <option value="Islam" <?= old('agama') === 'Islam' ? 'selected' : '' ?>>Islam</option>
                        <option value="Kristen" <?= old('agama') === 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                        <option value="Katolik" <?= old('agama') === 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                        <option value="Hindu" <?= old('agama') === 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                        <option value="Buddha" <?= old('agama') === 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                        <option value="Konghucu" <?= old('agama') === 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
                    </select>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Jenis Kelamin <span style="color: #ef4444;">*</span></label>
                    <select name="jenis_kelamin" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" <?= old('jenis_kelamin') === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= old('jenis_kelamin') === 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Tempat Lahir <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="tempat_lahir" value="<?= old('tempat_lahir') ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" 
                           required>
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

<?= $this->endSection() ?>
