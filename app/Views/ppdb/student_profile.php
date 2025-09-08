<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
if (!session()->get('logged_in')) {
    header('Location: /login');
    exit;
}
if (!session()->get('student_id')) {
    header('Location: /daftar');
    exit;
}
?>

<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="relative overflow-hidden bg-gradient-to-br from-nu-cream via-white to-nu-cream">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-10">
        <!-- Title -->
        <div class="max-w-2xl text-center mx-auto mb-8">
            <h1 class="block font-bold text-nu-dark text-3xl md:text-4xl lg:text-5xl mb-4">
                Profil 
                <span class="bg-clip-text bg-gradient-to-r from-nu-green to-nu-gold text-transparent">Siswa</span>
            </h1>
            <p class="text-lg text-gray-700">Data lengkap pendaftaran siswa SDNU Pemanahan</p>
        </div>
        
        <!-- Status Badge -->
        <div class="flex justify-center mb-8">
            <?php if (isset($student) && $student['status'] == 'calon'): ?>
                <div class="inline-flex items-center gap-x-2 bg-gradient-to-r from-yellow-500 to-yellow-600 border border-yellow-400/20 text-sm text-white p-2 px-4 rounded-full shadow-lg">
                    <i class="fas fa-clock"></i>
                    <span class="font-medium">Status: Calon Siswa</span>
                </div>
            <?php elseif (isset($student) && $student['status'] == 'siswa'): ?>
                <div class="inline-flex items-center gap-x-2 bg-gradient-to-r from-nu-green to-nu-dark border border-nu-green/20 text-sm text-white p-2 px-4 rounded-full shadow-lg">
                    <i class="fas fa-check-circle"></i>
                    <span class="font-medium">Status: Siswa Aktif</span>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex justify-center gap-4 mb-8">
            <a href="/edit-profile" class="inline-flex items-center gap-x-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-300">
                <i class="fas fa-edit"></i>
                Edit Profil
            </a>
        </div>
    </div>
</div>

<!-- Profile Content -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto bg-white">
    <?php if (isset($student)): ?>
        <div class="max-w-6xl mx-auto">
            <!-- Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Data Akun -->
                <div class="bg-gradient-to-br from-nu-cream via-white to-nu-cream border border-nu-green/20 rounded-xl p-6 shadow-lg">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="inline-flex justify-center items-center size-10 rounded-full border border-nu-green/30 bg-white text-nu-green shadow-sm">
                            <i class="fas fa-user-circle"></i>
                        </span>
                        <h3 class="text-xl font-bold text-nu-dark">Data Akun</h3>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Username:</span>
                            <span class="font-semibold text-nu-dark"><?= session()->get('username') ?></span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Email:</span>
                            <span class="font-semibold text-nu-dark"><?= session()->get('email') ?></span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">No. Registrasi:</span>
                            <span class="font-bold text-nu-green bg-nu-green/10 px-3 py-1 rounded-full text-sm"><?= esc($student['no_registrasi']) ?></span>
                        </div>
                        <?php if (!empty($student['nis'])): ?>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">NIS:</span>
                                <span class="font-semibold text-nu-dark"><?= esc($student['nis']) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Data Pribadi -->
                <div class="bg-gradient-to-br from-nu-cream via-white to-nu-cream border border-nu-green/20 rounded-xl p-6 shadow-lg">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="inline-flex justify-center items-center size-10 rounded-full border border-nu-green/30 bg-white text-nu-green shadow-sm">
                            <i class="fas fa-id-card"></i>
                        </span>
                        <h3 class="text-xl font-bold text-nu-dark">Data Pribadi</h3>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Nama Lengkap:</span>
                            <span class="font-semibold text-nu-dark"><?= esc($student['nama_lengkap']) ?></span>
                        </div>
                        <?php if (!empty($student['nisn'])): ?>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">NISN:</span>
                                <span class="font-semibold text-nu-dark"><?= esc($student['nisn']) ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Agama:</span>
                            <span class="font-semibold text-nu-dark"><?= esc($student['agama']) ?></span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Jenis Kelamin:</span>
                            <span class="font-semibold text-nu-dark"><?= $student['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Tempat Lahir:</span>
                            <span class="font-semibold text-nu-dark"><?= esc($student['tempat_lahir']) ?></span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 font-medium">Tanggal Lahir:</span>
                            <span class="font-semibold text-nu-dark"><?= date('d/m/Y', strtotime($student['tanggal_lahir'])) ?></span>
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
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Nama Ayah:</span>
                            <span class="font-semibold text-nu-dark"><?= esc($student['nama_ayah']) ?></span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 font-medium">Nama Ibu:</span>
                            <span class="font-semibold text-nu-dark"><?= esc($student['nama_ibu']) ?></span>
                        </div>
                    </div>
                </div>
                
                <!-- Data Kontak & Alamat -->
                <div class="bg-gradient-to-br from-nu-cream via-white to-nu-cream border border-nu-green/20 rounded-xl p-6 shadow-lg">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="inline-flex justify-center items-center size-10 rounded-full border border-nu-green/30 bg-white text-nu-green shadow-sm">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <h3 class="text-xl font-bold text-nu-dark">Kontak & Alamat</h3>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium block mb-1">Alamat:</span>
                            <span class="font-medium text-nu-dark"><?= esc($student['alamat']) ?></span>
                        </div>
                        <div class="py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium block mb-1">Domisili:</span>
                            <span class="font-medium text-nu-dark"><?= esc($student['domisili']) ?></span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">No. Telepon:</span>
                            <span class="font-semibold text-nu-dark"><?= esc($student['nomor_telepon']) ?></span>
                        </div>
                        <?php if (!empty($student['asal_tk_ra'])): ?>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Asal TK/RA:</span>
                                <span class="font-semibold text-nu-dark"><?= esc($student['asal_tk_ra']) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Dokumen Section -->
            <div class="bg-gradient-to-br from-nu-cream via-white to-nu-cream border border-nu-green/20 rounded-xl p-6 shadow-lg mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex justify-center items-center size-10 rounded-full border border-nu-green/30 bg-white text-nu-green shadow-sm">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    <h3 class="text-xl font-bold text-nu-dark">Dokumen Pendukung</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php if (!empty($student['akta_url'])): ?>
                        <div class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="inline-flex items-center justify-center size-12 bg-red-500 text-white rounded-full mb-4">
                                <i class="fas fa-file-pdf text-xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-nu-dark mb-2">Akta Kelahiran</h4>
                            <a href="<?= base_url($student['akta_url']) ?>" target="_blank" class="inline-flex items-center gap-x-2 text-sm text-nu-green hover:text-nu-dark font-medium hover:underline transition-colors duration-300">
                                <i class="fas fa-external-link-alt"></i>
                                Lihat Dokumen
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