<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Removed PHP redirect from view - handled by controller now -->

<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-nu-cream via-white to-nu-cream">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-10">
        <!-- Title -->
        <div class="max-w-2xl text-center mx-auto mb-8">
            <h1 class="block font-bold text-nu-dark text-3xl md:text-4xl lg:text-5xl mb-4">
                Formulir 
                <span class="bg-clip-text bg-gradient-to-r from-nu-green to-nu-gold text-transparent">Pendaftaran</span>
            </h1>
            <p class="text-lg text-gray-700">Silakan lengkapi data di bawah ini untuk mendaftar sebagai siswa baru SDNU Pemanahan</p>
        </div>
        
        <!-- Progress Indicator -->
        <div class="flex justify-center mb-8">
            <div class="inline-flex items-center gap-x-2 bg-gradient-to-r from-nu-green to-nu-dark border border-nu-green/20 text-sm text-white p-2 px-4 rounded-full shadow-lg">
                <i class="fas fa-user-plus"></i>
                <span class="font-medium">Tahap Pendaftaran Siswa Baru</span>
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
        
        
        <form action="/daftar" method="post" enctype="multipart/form-data" class="space-y-8">
            <?= csrf_field() ?>
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
                        <input type="text" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Tahun Ajaran <span class="text-red-500">*</span></label>
                        <select name="tahun_ajaran_id" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
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
                        <label class="block text-nu-dark font-semibold mb-2">Agama <span class="text-red-500">*</span></label>
                        <select name="agama" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
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
                        <label class="block text-nu-dark font-semibold mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" <?= old('jenis_kelamin') === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= old('jenis_kelamin') === 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat_lahir" value="<?= old('tempat_lahir') ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" value="<?= old('tanggal_lahir') ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
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
                        <input type="text" name="nama_ayah" value="<?= old('nama_ayah') ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Nama Ibu <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_ibu" value="<?= old('nama_ibu') ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
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
                        <textarea name="alamat" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300"><?= old('alamat') ?></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Alamat Domisili <span class="text-red-500">*</span></label>
                        <textarea name="domisili" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300"><?= old('domisili') ?></textarea>
                        <p class="mt-1 text-sm text-gray-500">Alamat tempat tinggal saat ini</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-nu-dark font-semibold mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                            <input type="tel" name="nomor_telepon" value="<?= old('nomor_telepon') ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
                        </div>
                        
                        <div>
                            <label class="block text-nu-dark font-semibold mb-2">Asal TK/RA</label>
                            <input type="text" name="asal_tk_ra" value="<?= old('asal_tk_ra') ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
                            <p class="mt-1 text-sm text-gray-500">Nama TK/RA asal (opsional)</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Dokumen -->
            <div class="bg-gradient-to-br from-nu-cream via-white to-nu-cream border border-nu-green/20 rounded-xl p-6 shadow-lg">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex justify-center items-center size-10 rounded-full border border-nu-green/30 bg-white text-nu-green shadow-sm">
                        <i class="fas fa-file-upload"></i>
                    </span>
                    <h3 class="text-xl font-bold text-nu-dark">Upload Dokumen</h3>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Akta Kelahiran <span class="text-red-500">*</span></label>
                        <input type="file" name="akta" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-nu-green file:text-white hover:file:bg-nu-dark" accept=".pdf,.jpg,.jpeg,.png">
                        <p class="mt-1 text-sm text-gray-500">Format: PDF, JPG, atau PNG (Maksimal 5MB)</p>
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Kartu Keluarga <span class="text-red-500">*</span></label>
                        <input type="file" name="kk" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-nu-green file:text-white hover:file:bg-nu-dark" accept=".pdf,.jpg,.jpeg,.png">
                        <p class="mt-1 text-sm text-gray-500">Format: PDF, JPG, atau PNG (Maksimal 5MB)</p>
                    </div>
                    
                    <div>
                        <label class="block text-nu-dark font-semibold mb-2">Ijazah TK/RA</label>
                        <input type="file" name="ijazah" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-nu-green file:text-white hover:file:bg-nu-dark" accept=".pdf,.jpg,.jpeg,.png">
                        <p class="mt-1 text-sm text-gray-500">Upload jika ada (opsional) - Format: PDF, JPG, atau PNG (Maksimal 5MB)</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <button type="submit" class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-r from-nu-green to-nu-dark hover:from-nu-dark hover:to-nu-green border border-transparent text-white text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 py-4 px-8">
                    <i class="fas fa-paper-plane"></i>
                    Kirim Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>