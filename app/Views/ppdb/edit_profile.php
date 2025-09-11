<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-nu-cream via-white to-nu-cream">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-10">
        <!-- Title -->
        <div class="max-w-2xl text-center mx-auto mb-8">
            <h1 class="block font-bold text-nu-dark text-3xl md:text-4xl lg:text-5xl mb-4">
                Edit 
                <span class="bg-clip-text bg-gradient-to-r from-nu-green to-nu-gold text-transparent">Profil</span>
            </h1>
            <p class="text-lg text-gray-700">Perbarui data profil siswa SDNU Pemanahan</p>
        </div>
        
        <!-- Progress Indicator -->
        <div class="flex justify-center mb-8">
            <div class="inline-flex items-center gap-x-2 bg-gradient-to-r from-nu-green to-nu-dark border border-nu-green/20 text-sm text-white p-2 px-4 rounded-full shadow-lg">
                <i class="fas fa-user-edit"></i>
                <span class="font-medium">Edit Data Siswa</span>
            </div>
        </div>
    </div>
</div>

<!-- Form Section -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto bg-white">
    <div class="max-w-4xl mx-auto">
        <!-- Alert Messages -->
        <?php if (isset($validation)): ?>
            <div class="mb-8 p-4 border border-red-200 bg-red-50 rounded-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan validasi:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <form action="/edit-profile" method="post" class="space-y-8">
            <!-- Data Pribadi -->
            <div class="bg-gradient-to-br from-nu-cream via-white to-nu-cream border border-nu-green/20 rounded-xl p-6 shadow-lg">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex justify-center items-center size-10 rounded-full border border-nu-green/30 bg-white text-nu-green shadow-sm">
                        <i class="fas fa-user"></i>
                    </span>
                    <h3 class="text-xl font-bold text-nu-dark">Data Pribadi Siswa</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" value="<?= old('nama_lengkap', $student['nama_lengkap']) ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300" required>
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">NISN</label>
                        <input type="text" name="nisn" value="<?= old('nisn', $student['nisn']) ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300" pattern="\d{10}" maxlength="10">
                        <p class="mt-1 text-sm text-gray-500">10 digit nomor NISN (opsional)</p>
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Agama <span class="text-red-500">*</span></label>
                        <select name="agama" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300" required>
                            <option value="">Pilih Agama</option>
                            <option value="Islam" <?= old('agama', $student['agama']) == 'Islam' ? 'selected' : '' ?>>Islam</option>
                            <option value="Kristen" <?= old('agama', $student['agama']) == 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                            <option value="Katolik" <?= old('agama', $student['agama']) == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                            <option value="Hindu" <?= old('agama', $student['agama']) == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                            <option value="Buddha" <?= old('agama', $student['agama']) == 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                            <option value="Konghucu" <?= old('agama', $student['agama']) == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" <?= old('jenis_kelamin', $student['jenis_kelamin']) == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= old('jenis_kelamin', $student['jenis_kelamin']) == 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat_lahir" value="<?= old('tempat_lahir', $student['tempat_lahir']) ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300" required>
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" value="<?= old('tanggal_lahir', $student['tanggal_lahir']) ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300" required>
                    </div>
                </div>
            </div>
            
            <!-- Data Orang Tua -->
            <div class="bg-gradient-to-br from-nu-cream via-white to-nu-cream border border-nu-green/20 rounded-xl p-6 shadow-lg">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex justify-center items-center size-10 rounded-full border border-nu-green/30 bg-white text-nu-green shadow-sm">
                        <i class="fas fa-users"></i>
                    </span>
                    <h3 class="text-xl font-bold text-nu-dark">Data Orang Tua</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Nama Ayah <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_ayah" value="<?= old('nama_ayah', $student['nama_ayah']) ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300" required>
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Nama Ibu <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_ibu" value="<?= old('nama_ibu', $student['nama_ibu']) ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300" required>
                    </div>
                </div>
            </div>
            
            <!-- Alamat & Kontak -->
            <div class="bg-gradient-to-br from-nu-cream via-white to-nu-cream border border-nu-green/20 rounded-xl p-6 shadow-lg">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex justify-center items-center size-10 rounded-full border border-nu-green/30 bg-white text-nu-green shadow-sm">
                        <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <h3 class="text-xl font-bold text-nu-dark">Alamat & Kontak</h3>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300" required><?= old('alamat', $student['alamat']) ?></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Alamat Domisili <span class="text-red-500">*</span></label>
                        <textarea name="domisili" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300" required><?= old('domisili', $student['domisili']) ?></textarea>
                        <p class="mt-1 text-sm text-gray-500">Alamat tempat tinggal saat ini</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-nu-dark font-semibold mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                            <input type="tel" name="nomor_telepon" value="<?= old('nomor_telepon', $student['nomor_telepon']) ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300" required>
                        </div>
                        
                        <div>
                            <label class="block text-nu-dark font-semibold mb-2">Asal TK/RA</label>
                            <input type="text" name="asal_tk_ra" value="<?= old('asal_tk_ra', $student['asal_tk_ra']) ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
                            <p class="mt-1 text-sm text-gray-500">Nama TK/RA asal (opsional)</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button type="submit" class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-r from-nu-green to-nu-dark hover:from-nu-dark hover:to-nu-green border border-transparent text-white text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 py-4 px-8">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
                <a href="/profile-siswa" class="inline-flex justify-center items-center gap-x-3 text-center bg-gray-500 hover:bg-gray-600 border border-transparent text-white text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 py-4 px-8">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
