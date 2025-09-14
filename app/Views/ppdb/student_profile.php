<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Profil Siswa</h1>
            <p class="text-gray-600">Data lengkap pendaftaran PPDB SDNU Pemanahan</p>
        </div>

        <!-- Status Badge -->
        <?php if (isset($student)): ?>
            <div class="mb-6 flex justify-center">
                <?php if ($student['status'] == 'calon'): ?>
                    <span class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-full text-sm font-medium">
                        <i class="fas fa-clock mr-2"></i>Status: Calon Siswa
                    </span>
                <?php elseif ($student['status'] == 'siswa'): ?>
                    <span class="inline-block bg-nu-green text-white px-4 py-2 rounded-full text-sm font-medium">
                        <i class="fas fa-check-circle mr-2"></i>Status: Siswa Aktif
                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <?php if (isset($student)): ?>
                <!-- Student Info Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white shadow-lg rounded-xl p-6">
                        <div class="text-center mb-6">
                            <div class="w-20 h-20 bg-nu-green rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-user text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">
                                <?= esc($student['nama_lengkap'] ?? '-') ?>
                            </h3>
                            <p class="text-gray-600 mb-2"><?= esc($student['no_registrasi'] ?? '-') ?></p>
                            <span class="inline-block bg-nu-green text-white px-3 py-1 rounded-full text-xs font-medium">
                                <?= esc(ucfirst($student['status'] ?? '-')) ?>
                            </span>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-4">
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">NISN:</span>
                                    <span class="text-sm font-medium"><?= esc($student['nisn'] ?? '-') ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Jenis Kelamin:</span>
                                    <span class="text-sm font-medium"><?= $student['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Agama:</span>
                                    <span class="text-sm font-medium"><?= esc($student['agama'] ?? '-') ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-500 mb-2">Mendaftar pada</p>
                            <p class="font-semibold text-gray-900">
                                <?= date('d F Y', strtotime($student['created_at'])) ?>
                            </p>
                        </div>
                        
                        <div class="mt-6">
                            <?php if (empty($student['accepted_at'])): ?>
                                <span class="inline-block bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-medium">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Data belum divalidasi
                                </span>
                                <a href="/edit-profile" class="w-full inline-flex justify-center items-center gap-x-2 bg-nu-green text-white px-4 py-2 rounded-lg hover:bg-nu-dark transition-colors mt-4">
                                    <i class="fas fa-edit"></i>
                                    Edit Profil
                                </a>
                            <?php else: ?>
                                <span class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Data sudah divalidasi pada <?= date('d F Y', strtotime($student['accepted_at'])) ?>
                                </span>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
                
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Data Pribadi -->
                    <div class="bg-white shadow-lg rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Data Pribadi</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <p class="text-gray-900"><?= esc($student['nama_lengkap'] ?? '-') ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                                    <p class="text-gray-900"><?= esc($student['nisn'] ?? '-') ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                                    <p class="text-gray-900"><?= esc($student['tempat_lahir'] ?? '-') ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                    <p class="text-gray-900"><?= date('d F Y', strtotime($student['tanggal_lahir'])) ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                    <p class="text-gray-900"><?= $student['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                                    <p class="text-gray-900"><?= esc($student['agama'] ?? '-') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Data Orang Tua & Kontak -->
                    <div class="bg-white shadow-lg rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Data Orang Tua & Kontak</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                                    <p class="text-gray-900"><?= esc($student['nama_ayah'] ?? '-') ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                                    <p class="text-gray-900"><?= esc($student['nama_ibu'] ?? '-') ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                    <p class="text-gray-900"><?= esc($student['nomor_telepon'] ?? '-') ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Asal TK/RA</label>
                                    <p class="text-gray-900"><?= esc($student['asal_tk_ra'] ?? '-') ?></p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <p class="text-gray-900"><?= esc($student['alamat'] ?? '-') ?></p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Domisili</label>
                                    <p class="text-gray-900"><?= esc($student['domisili'] ?? '-') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dokumen -->
                    <div class="bg-white shadow-lg rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Dokumen Pendukung</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <?php if (!empty($student['akta_url'])): ?>
                                <div class="text-center p-4 border border-gray-200 rounded-lg">
                                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-file-pdf text-white"></i>
                                    </div>
                                    <h4 class="text-sm font-medium mb-2">Akta Kelahiran</h4>
                                    <a href="<?= base_url($student['akta_url']) ?>" target="_blank" 
                                       class="text-nu-green hover:text-nu-dark text-sm">
                                        <i class="fas fa-eye mr-1"></i>Lihat
                                    </a>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($student['kk_url'])): ?>
                                <div class="text-center p-4 border border-gray-200 rounded-lg">
                                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-file-pdf text-white"></i>
                                    </div>
                                    <h4 class="text-sm font-medium mb-2">Kartu Keluarga</h4>
                                    <a href="<?= base_url($student['kk_url']) ?>" target="_blank" 
                                       class="text-nu-green hover:text-nu-dark text-sm">
                                        <i class="fas fa-eye mr-1"></i>Lihat
                                    </a>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($student['ijazah_url'])): ?>
                                <div class="text-center p-4 border border-gray-200 rounded-lg">
                                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-file-pdf text-white"></i>
                                    </div>
                                    <h4 class="text-sm font-medium mb-2">Ijazah TK/RA</h4>
                                    <a href="<?= base_url($student['ijazah_url']) ?>" target="_blank" 
                                       class="text-nu-green hover:text-nu-dark text-sm">
                                        <i class="fas fa-eye mr-1"></i>Lihat
                                    </a>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($student['ktp_ayah'])): ?>
                                <div class="text-center p-4 border border-gray-200 rounded-lg">
                                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-file-pdf text-white"></i>
                                    </div>
                                    <h4 class="text-sm font-medium mb-2">KTP Ayah</h4>
                                    <a href="<?= base_url($student['ktp_ayah']) ?>" target="_blank" 
                                       class="text-nu-green hover:text-nu-dark text-sm">
                                        <i class="fas fa-eye mr-1"></i>Lihat
                                    </a>
                                </div>
                                <?php endif; ?>
                               
                                <?php if (!empty($student['ktp_ibu'])): ?>
                                <div class="text-center p-4 border border-gray-200 rounded-lg">
                                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-file-pdf text-white"></i>
                                    </div>
                                    <h4 class="text-sm font-medium mb-2">KTP Ibu</h4>
                                    <a href="<?= base_url($student['ktp_ibu']) ?>" target="_blank" 
                                       class="text-nu-green hover:text-nu-dark text-sm">
                                        <i class="fas fa-eye mr-1"></i>Lihat
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Status Pembayaran -->
                    <div class="bg-white shadow-lg rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Status Pembayaran</h3>
                        </div>
                        <div class="p-6">
                            <?php if (isset($student['accepted_at']) && !empty($student['accepted_at'])): ?>
                                <?php if (isset($payment) && $payment): ?>
                                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                                        <div class="flex items-center mb-3">
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                            <h4 class="font-semibold text-green-800">Pembayaran Sudah Diupload</h4>
                                        </div>
                                        <div class="space-y-2">
                                            <div class="flex justify-between">
                                                <span class="text-sm text-gray-600">Nama Pembayar:</span>
                                                <span class="text-sm font-medium"><?= esc($payment['nama'] ?? '-') ?></span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-sm text-gray-600">Metode:</span>
                                                <span class="text-sm font-medium"><?= ucfirst($payment['metode'] ?? '-') ?></span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-sm text-gray-600">Upload:</span>
                                                <span class="text-sm font-medium"><?= date('d M Y', strtotime($payment['created_at'])) ?></span>
                                            </div>
                                            <?php if (!empty($payment['bukti_url'])): ?>
                                            <div class="pt-2">
                                                <a href="<?= base_url($payment['bukti_url']) ?>" target="_blank" 
                                                   class="inline-flex items-center text-nu-green hover:text-nu-dark">
                                                    <i class="fas fa-file-pdf mr-2"></i>Lihat Bukti Pembayaran
                                                </a>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                                        <?php if (empty($payment['accepted_at'])): ?>
                                            <p class="text-sm text-yellow-700">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                Pembayaran sedang diverifikasi oleh admin.
                                            </p>
                                        <?php else: ?>
                                            <p class="text-sm text-green-700">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                Pembayaran sudah diverifikasi oleh admin pada <?= date('d F Y', strtotime($payment['accepted_at'])) ?>.
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                                        <p class="text-yellow-700 mb-4">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            Belum ada data pembayaran. Silakan upload bukti pembayaran.
                                        </p>
                                        <button type="button" id="openUploadModal" class="inline-flex items-center bg-nu-green text-white px-4 py-2 rounded-lg hover:bg-nu-dark transition-colors">
                                                <i class="fas fa-upload mr-2"></i>Upload Bukti Pembayaran
                                        </button>

                                        <!-- Modal Upload Pembayaran -->
                                        <div id="uploadPaymentModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                                                <button type="button" id="closeUploadModal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                                                    <i class="fas fa-times fa-lg"></i>
                                                </button>
                                                <h3 class="text-lg font-semibold mb-4">Upload Bukti Pembayaran</h3>
                                                <form action="/upload-payment" method="POST" enctype="multipart/form-data" class="space-y-4">
                                                    <div>
                                                        <label for="nama_pembayar" class="block text-sm font-medium text-gray-700 mb-1">Nama Pembayar</label>
                                                        <input type="text" name="nama_pembayar" id="nama_pembayar" class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                                                    </div>
                                                    <div>
                                                        <label for="metode" class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                                                        <select name="metode" id="metode" class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                                                            <option value="transfer">Transfer</option>
                                                            <option value="cash">Cash</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti (PNG)</label>
                                                        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/png" class="w-full" required>
                                                    </div>
                                                    <div class="flex justify-end gap-2 pt-2">
                                                        <button type="button" id="cancelUploadModal" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">Batal</button>
                                                        <button type="submit" class="px-4 py-2 rounded-lg bg-nu-green text-white hover:bg-nu-dark">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <script>
                                            // Modal logic
                                            const openBtn = document.getElementById('openUploadModal');
                                            const modal = document.getElementById('uploadPaymentModal');
                                            const closeBtn = document.getElementById('closeUploadModal');
                                            const cancelBtn = document.getElementById('cancelUploadModal');
                                            openBtn.addEventListener('click', () => { modal.classList.remove('hidden'); });
                                            closeBtn.addEventListener('click', () => { modal.classList.add('hidden'); });
                                            cancelBtn.addEventListener('click', () => { modal.classList.add('hidden'); });
                                        </script>
                                    </div>
                                    
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <h4 class="font-medium text-gray-900 mb-3">Informasi Pembayaran:</h4>
                                        <div class="text-sm space-y-1">
                                            <p><strong>Biaya:</strong> Rp 350.000</p>
                                            <p><strong>Bank:</strong> BRI - 1234-5678-9012-3456</p>
                                            <p><strong>Atas Nama:</strong> SDNU Pemanahan</p>
                                            <p><strong>Kegunaan:</strong> Baju seragam</p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <p class="text-blue-700">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Data pendaftaran sedang diproses validasi oleh admin.
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Kategori Siswa</h3>
                        </div>
                        <div class="p-6">
                            <?php if (!empty($student['kategori_id']) && !empty($kategori)): ?>
                                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                    <div class="flex items-center mb-3">
                                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                        <h4 class="font-semibold text-green-800">Kategori Siswa Ditetapkan</h4>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div class="md:col-span-1">
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Nama Kategori</label>
                                            <p class="text-muted"><?= esc($kategori['nama_kategori'] ?? '-') ?></p>
                                            <label class="block text-sm font-bold text-gray-700 mt-4 mb-1">SPP</label>
                                            <p class="text-muted">Rp <?= number_format($kategori['spp'] ?? 0, 0, ',', '.') ?></p>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Catatan</label>
                                            <p class="text-muted"><?= esc($kategori['catatan'] ?? '-') ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <p class="text-blue-700">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Kategori siswa sedang diproses oleh admin.
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

            <?php else: ?>
                <!-- Error State -->
                <div class="lg:col-span-3">
                    <div class="bg-red-50 border border-red-200 rounded-xl p-8 text-center">
                        <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-red-800 mb-2">Data Tidak Ditemukan</h3>
                        <p class="text-red-700 mb-6">Data siswa tidak ditemukan. Silakan hubungi administrator.</p>
                        <a href="/" class="inline-flex items-center bg-nu-green text-white px-6 py-3 rounded-lg hover:bg-nu-dark transition-colors">
                            <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
