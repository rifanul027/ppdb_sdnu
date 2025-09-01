<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="gradient-bg text-white py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                Info <span class="text-nu-gold">PPDB 2025/2026</span>
            </h1>
            <p class="text-xl text-green-100 max-w-3xl mx-auto">
                Penerimaan Peserta Didik Baru SD Nahdlatul Ulama Pemanahan Tahun Ajaran 2025/2026
            </p>
        </div>
        
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white border-opacity-20">
                <h3 class="text-3xl font-bold text-nu-gold mb-2">120</h3>
                <p class="text-green-100">Kuota Siswa</p>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white border-opacity-20">
                <h3 class="text-3xl font-bold text-nu-gold mb-2">3</h3>
                <p class="text-green-100">Gelombang</p>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white border-opacity-20">
                <h3 class="text-3xl font-bold text-nu-gold mb-2">6-7</h3>
                <p class="text-green-100">Usia (Tahun)</p>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white border-opacity-20">
                <h3 class="text-3xl font-bold text-nu-gold mb-2">100%</h3>
                <p class="text-green-100">Online</p>
            </div>
        </div>
    </div>
</section>

<!-- Jadwal Pendaftaran -->
<section class="py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Jadwal <span class="text-nu-green">Pendaftaran</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Pendaftaran dibuka dalam 3 gelombang dengan benefit yang berbeda
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Gelombang 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-xl border-2 border-nu-green relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-nu-green text-white px-4 py-2 text-sm font-bold">
                    TERBUKA
                </div>
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-nu-green rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-2xl">1</span>
                    </div>
                    <h3 class="text-2xl font-bold text-nu-dark mb-2">Gelombang 1</h3>
                    <p class="text-nu-green font-semibold text-lg">1 Januari - 31 Maret 2025</p>
                </div>
                
                <div class="space-y-4 mb-6">
                    <div class="bg-nu-cream rounded-lg p-4">
                        <h4 class="font-bold text-nu-dark mb-2">Benefit:</h4>
                        <ul class="space-y-1 text-sm text-gray-700">
                            <li>• Diskon biaya pendaftaran 20%</li>
                            <li>• Gratis seragam lengkap</li>
                            <li>• Prioritas pemilihan kelas</li>
                            <li>• Bebas biaya tes masuk</li>
                        </ul>
                    </div>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Biaya Pendaftaran:</span>
                            <div class="text-right">
                                <span class="line-through text-red-500 text-sm">Rp 250.000</span>
                                <span class="font-bold text-nu-green ml-2">Rp 200.000</span>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">SPP/Bulan:</span>
                            <span class="font-bold">Rp 400.000</span>
                        </div>
                    </div>
                </div>
                
                <a href="/daftar?gelombang=1" class="w-full bg-nu-green text-white py-3 rounded-lg font-semibold hover:bg-nu-dark transition-all duration-300 block text-center">
                    Daftar Gelombang 1
                </a>
            </div>
            
            <!-- Gelombang 2 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg relative">
                <div class="absolute top-0 right-0 bg-gray-400 text-white px-4 py-2 text-sm font-bold">
                    SEGERA
                </div>
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-2xl">2</span>
                    </div>
                    <h3 class="text-2xl font-bold text-nu-dark mb-2">Gelombang 2</h3>
                    <p class="text-gray-600 font-semibold text-lg">1 April - 30 Juni 2025</p>
                </div>
                
                <div class="space-y-4 mb-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-bold text-nu-dark mb-2">Benefit:</h4>
                        <ul class="space-y-1 text-sm text-gray-700">
                            <li>• Diskon biaya pendaftaran 10%</li>
                            <li>• Gratis tas sekolah</li>
                            <li>• Potongan biaya seragam 50%</li>
                            <li>• Program persiapan gratis</li>
                        </ul>
                    </div>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Biaya Pendaftaran:</span>
                            <div class="text-right">
                                <span class="line-through text-red-500 text-sm">Rp 300.000</span>
                                <span class="font-bold text-gray-600 ml-2">Rp 270.000</span>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">SPP/Bulan:</span>
                            <span class="font-bold">Rp 400.000</span>
                        </div>
                    </div>
                </div>
                
                <button class="w-full bg-gray-300 text-gray-600 py-3 rounded-lg font-semibold cursor-not-allowed">
                    Pendaftaran Belum Dibuka
                </button>
            </div>
            
            <!-- Gelombang 3 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg relative">
                <div class="absolute top-0 right-0 bg-gray-400 text-white px-4 py-2 text-sm font-bold">
                    SEGERA
                </div>
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-2xl">3</span>
                    </div>
                    <h3 class="text-2xl font-bold text-nu-dark mb-2">Gelombang 3</h3>
                    <p class="text-gray-600 font-semibold text-lg">1 Juli - 31 Juli 2025</p>
                </div>
                
                <div class="space-y-4 mb-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-bold text-nu-dark mb-2">Benefit:</h4>
                        <ul class="space-y-1 text-sm text-gray-700">
                            <li>• Tanpa potongan</li>
                            <li>• Program orientasi intensif</li>
                            <li>• Bimbingan adaptasi</li>
                            <li>• Tersisa sedikit kuota</li>
                        </ul>
                    </div>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Biaya Pendaftaran:</span>
                            <span class="font-bold text-gray-600">Rp 350.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">SPP/Bulan:</span>
                            <span class="font-bold">Rp 400.000</span>
                        </div>
                    </div>
                </div>
                
                <button class="w-full bg-gray-300 text-gray-600 py-3 rounded-lg font-semibold cursor-not-allowed">
                    Pendaftaran Belum Dibuka
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Syarat dan Ketentuan -->
<section class="bg-gray-50 py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Syarat & <span class="text-nu-green">Ketentuan</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Persyaratan yang harus dipenuhi untuk mendaftar di SDNU Pemanahan
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Syarat Umum -->
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <h3 class="text-2xl font-bold text-nu-dark mb-6 flex items-center">
                    <i class="fas fa-user-check text-nu-green mr-3"></i>Syarat Umum
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-nu-green mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-nu-dark">Usia</h4>
                            <p class="text-gray-600">Berusia 6-7 tahun per 1 Juli 2025</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-nu-green mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-nu-dark">Sehat Jasmani dan Rohani</h4>
                            <p class="text-gray-600">Tidak memiliki gangguan yang menghambat proses belajar</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-nu-green mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-nu-dark">Kemampuan Dasar</h4>
                            <p class="text-gray-600">Mampu berkomunikasi dengan baik dan siap mengikuti pembelajaran</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-nu-green mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-nu-dark">Komitmen Orang Tua</h4>
                            <p class="text-gray-600">Mendukung program sekolah dan visi-misi pendidikan Islam</p>
                        </div>
                    </li>
                </ul>
            </div>
            
            <!-- Dokumen Diperlukan -->
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <h3 class="text-2xl font-bold text-nu-dark mb-6 flex items-center">
                    <i class="fas fa-file-alt text-nu-green mr-3"></i>Dokumen Diperlukan
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i class="fas fa-file text-nu-green mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-nu-dark">Akta Kelahiran</h4>
                            <p class="text-gray-600">Fotocopy yang sudah dilegalisir</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-id-card text-nu-green mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-nu-dark">KK dan KTP Orang Tua</h4>
                            <p class="text-gray-600">Fotocopy Kartu Keluarga dan KTP ayah/ibu</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-camera text-nu-green mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-nu-dark">Pas Foto</h4>
                            <p class="text-gray-600">3x4 sebanyak 4 lembar (background merah)</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-file-medical text-nu-green mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-nu-dark">Surat Sehat</h4>
                            <p class="text-gray-600">Dari dokter atau puskesmas (opsional)</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-graduation-cap text-nu-green mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-nu-dark">Ijazah TK/RA</h4>
                            <p class="text-gray-600">Jika sudah lulus TK/RA (opsional)</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Pengumuman Terbaru -->
<section class="py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Pengumuman <span class="text-nu-green">Terbaru</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Informasi dan pengumuman penting seputar PPDB 2025/2026
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl p-8 shadow-lg text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-bullhorn text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-nu-dark mb-4">Belum Ada Pengumuman</h3>
                <p class="text-gray-600 text-lg">
                    Pengumuman terbaru akan muncul di sini. Pantau terus halaman ini untuk mendapatkan informasi terkini.
                </p>
                <div class="mt-6">
                    <button class="bg-nu-green text-white px-6 py-3 rounded-lg font-semibold hover:bg-nu-dark transition-all duration-300">
                        Refresh Halaman
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection() ?>
