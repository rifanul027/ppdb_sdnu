<?= $this->extend('layouts        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
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
                            <a href="/edit-profile" class="w-full inline-flex justify-center items-center gap-x-2 bg-nu-green text-white px-4 py-2 rounded-lg hover:bg-nu-dark transition-colors">
                                <i class="fas fa-edit"></i>
                                Edit Profil
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">n') ?>
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
        <div class="max-w-6xl mx-auto">
            <!-- Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
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
                                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-3">
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
                            </div>
                        </div>
                    </div>
                    <!-- Status Pembayaran -->
                    <div class="bg-white shadow-lg rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Status Pembayaran</h3>
                        </div>
                        <div class="p-6">
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
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                    <p class="text-sm text-blue-700">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Pembayaran sedang diverifikasi oleh admin.
                                    </p>
                                </div>
                            <?php else: ?>
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                                    <p class="text-yellow-700 mb-4">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        Belum ada data pembayaran. Silakan upload bukti pembayaran.
                                    </p>
                                    <a href="/upload-payment" class="inline-flex items-center bg-nu-green text-white px-4 py-2 rounded-lg hover:bg-nu-dark transition-colors">
                                        <i class="fas fa-upload mr-2"></i>Upload Bukti Pembayaran
                                    </a>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900 mb-3">Informasi Pembayaran:</h4>
                                    <div class="text-sm space-y-1">
                                        <p><strong>Biaya:</strong> Rp 250.000</p>
                                        <p><strong>Bank:</strong> BRI - 1234-5678-9012-3456</p>
                                        <p><strong>Atas Nama:</strong> SDNU Pemanahan</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
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
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($student['kk_url'])): ?>
                        <div class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="inline-flex items-center justify-center size-12 bg-blue-500 text-white rounded-full mb-4">
                                <i class="fas fa-file-pdf text-xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-nu-dark mb-2">Kartu Keluarga</h4>
                            <a href="<?= base_url($student['kk_url']) ?>" target="_blank" class="inline-flex items-center gap-x-2 text-sm text-nu-green hover:text-nu-dark font-medium hover:underline transition-colors duration-300">
                                <i class="fas fa-external-link-alt"></i>
                                Lihat Dokumen
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($student['ijazah_url'])): ?>
                        <div class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="inline-flex items-center justify-center size-12 bg-green-500 text-white rounded-full mb-4">
                                <i class="fas fa-file-pdf text-xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-nu-dark mb-2">Ijazah TK/RA</h4>
                            <a href="<?= base_url($student['ijazah_url']) ?>" target="_blank" class="inline-flex items-center gap-x-2 text-sm text-nu-green hover:text-nu-dark font-medium hover:underline transition-colors duration-300">
                                <i class="fas fa-external-link-alt"></i>
                                Lihat Dokumen
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Timeline Section -->
            <div class="bg-gradient-to-br from-nu-cream via-white to-nu-cream border border-nu-green/20 rounded-xl p-6 shadow-lg mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex justify-center items-center size-10 rounded-full border border-nu-green/30 bg-white text-nu-green shadow-sm">
                        <i class="fas fa-history"></i>
                    </span>
                    <h3 class="text-xl font-bold text-nu-dark">Timeline Pendaftaran</h3>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-4 h-4 bg-nu-green rounded-full border-4 border-nu-green/30"></div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-nu-dark">Pendaftaran Dibuat</h4>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <?= date('d F Y, H:i', strtotime($student['created_at'])) ?> WIB
                            </p>
                        </div>
                    </div>
                    
                    <?php if (!empty($student['accepted_at'])): ?>
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-4 h-4 bg-blue-500 rounded-full border-4 border-blue-500/30"></div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-nu-dark">Diterima Sebagai Siswa</h4>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    <?= date('d F Y, H:i', strtotime($student['accepted_at'])) ?> WIB
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Payment Section -->
            <div class="bg-gradient-to-br from-nu-cream via-white to-nu-cream border border-nu-green/20 rounded-xl p-6 shadow-lg">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex justify-center items-center size-10 rounded-full border border-nu-green/30 bg-white text-nu-green shadow-sm">
                        <i class="fas fa-credit-card"></i>
                    </span>
                    <h3 class="text-xl font-bold text-nu-dark">Informasi Pembayaran</h3>
                </div>
                
                <?php if (isset($payment) && $payment): ?>
                    <!-- Payment Information Display -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="inline-flex items-center justify-center size-8 bg-green-500 text-white rounded-full">
                                <i class="fas fa-check text-sm"></i>
                            </span>
                            <h4 class="text-lg font-semibold text-green-800">Pembayaran Telah Diupload</h4>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Nama Pembayar:</span>
                                <span class="font-semibold text-nu-dark"><?= esc($payment['nama']) ?></span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Metode Pembayaran:</span>
                                <span class="font-semibold text-nu-dark"><?= ucfirst($payment['metode']) ?></span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Tanggal Upload:</span>
                                <span class="font-semibold text-nu-dark"><?= date('d F Y, H:i', strtotime($payment['created_at'])) ?> WIB</span>
                            </div>
                            <?php if (!empty($payment['bukti_url'])): ?>
                                <div class="py-2">
                                    <span class="text-gray-600 font-medium block mb-2">Bukti Pembayaran:</span>
                                    <a href="<?= base_url($payment['bukti_url']) ?>" target="_blank" class="inline-flex items-center gap-x-2 text-sm text-nu-green hover:text-nu-dark font-medium hover:underline transition-colors duration-300">
                                        <i class="fas fa-file-pdf"></i>
                                        Lihat Bukti Pembayaran
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-sm text-blue-700">
                                <i class="fas fa-info-circle mr-2"></i>
                                Status pembayaran sedang dalam proses verifikasi oleh admin. Anda akan dihubungi jika ada informasi lebih lanjut.
                            </p>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Payment Upload Form -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                            <p class="text-yellow-700 font-medium">Silakan upload bukti pembayaran untuk melengkapi proses pendaftaran.</p>
                        </div>
                    </div>
                    
                    <form action="/upload-payment" method="post" enctype="multipart/form-data" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-nu-dark font-semibold mb-2">Nama Pembayar <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_pembayar" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300" required>
                                <p class="mt-1 text-sm text-gray-500">Nama yang tertera pada bukti pembayaran</p>
                            </div>
                            
                            <div>
                                <label class="block text-nu-dark font-semibold mb-2">Metode Pembayaran <span class="text-red-500">*</span></label>
                                <select name="metode" id="metode" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="cash">Tunai</option>
                                </select>
                            </div>
                        </div>
                        
                        <div id="bukti-upload" class="hidden">
                            <label class="block text-nu-dark font-semibold mb-2">Bukti Pembayaran <span class="text-red-500">*</span></label>
                            <input type="file" name="bukti_pembayaran" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-nu-green file:text-white hover:file:bg-nu-dark" accept=".pdf,.jpg,.jpeg,.png">
                            <p class="mt-1 text-sm text-gray-500">Format: PDF, JPG, atau PNG (Maksimal 5MB)</p>
                        </div>
                        
                        <!-- Payment Info -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-nu-dark mb-4">
                                <i class="fas fa-info-circle mr-2"></i>
                                Informasi Pembayaran
                            </h4>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Biaya Pendaftaran:</span>
                                    <span class="font-semibold text-nu-green">Rp 250.000</span>
                                </div>
                                <hr>
                                <div>
                                    <p class="font-medium text-nu-dark mb-2">Transfer Bank:</p>
                                    <div class="bg-gray-50 p-3 rounded-lg space-y-1">
                                        <p><strong>Bank:</strong> BRI</p>
                                        <p><strong>No. Rekening:</strong> 1234-5678-9012-3456</p>
                                        <p><strong>Atas Nama:</strong> SDNU Pemanahan</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="font-medium text-nu-dark mb-2">Pembayaran Tunai:</p>
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <p>Dapat dilakukan di kantor SDNU Pemanahan pada jam kerja (08:00 - 15:00 WIB)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-r from-nu-green to-nu-dark hover:from-nu-dark hover:to-nu-green border border-transparent text-white text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 py-4 px-8">
                                <i class="fas fa-upload"></i>
                                Upload Bukti Pembayaran
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        
    <?php else: ?>
        <!-- Error State -->
        <div class="max-w-2xl mx-auto">
            <div class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl p-8 text-center">
                <div class="inline-flex items-center justify-center size-16 bg-red-500 text-white rounded-full mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-red-800 mb-2">Data Tidak Ditemukan</h3>
                <p class="text-red-700 mb-6">Data siswa tidak ditemukan atau terjadi kesalahan sistem. Silakan hubungi administrator.</p>
                <a href="/" class="inline-flex items-center gap-x-2 text-center bg-gradient-to-r from-nu-green to-nu-dark hover:from-nu-dark hover:to-nu-green border border-transparent text-white text-sm font-medium rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 py-3 px-6">
                    <i class="fas fa-home"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    // Handle payment method change
    document.addEventListener('DOMContentLoaded', function() {
        const metodeSelect = document.getElementById('metode');
        const buktiUpload = document.getElementById('bukti-upload');
        
        if (metodeSelect) {
            metodeSelect.addEventListener('change', function() {
                if (this.value === 'transfer') {
                    buktiUpload.classList.remove('hidden');
                    buktiUpload.querySelector('input[type="file"]').required = true;
                } else if (this.value === 'cash') {
                    buktiUpload.classList.add('hidden');
                    buktiUpload.querySelector('input[type="file"]').required = false;
                } else {
                    buktiUpload.classList.add('hidden');
                    buktiUpload.querySelector('input[type="file"]').required = false;
                }
            });
        }
        
        // File upload validation
        const fileInput = document.querySelector('input[type="file"][name="bukti_pembayaran"]');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    // Check file size (5MB limit)
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 5MB.');
                        this.value = '';
                        return;
                    }
                    
                    // Check file type
                    const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                    if (!allowedTypes.includes(file.type)) {
                        alert('Format file tidak didukung. Gunakan PDF, JPG, atau PNG.');
                        this.value = '';
                        return;
                    }
                }
            });
        }
    });
</script>

<?= $this->endSection() ?>