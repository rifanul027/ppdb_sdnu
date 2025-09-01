<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="gradient-bg text-white py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                PPDB <span class="text-nu-gold">SDNU Pemanahan</span>
            </h1>
            <p class="text-xl text-green-100 max-w-3xl mx-auto">
                Lembaga pendidikan Islam terpercaya yang mengintegrasikan nilai-nilai Ahlussunnah wal Jamaah dengan pendidikan modern berkualitas
            </p>
        </div>
    </div>
</section>

<!-- Info PPDB Banner -->
<section class="bg-nu-gold py-4 relative overflow-hidden">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-center">
            <div class="flex items-center space-x-4 text-nu-dark">
                <i class="fas fa-bullhorn text-2xl animate-pulse"></i>
                <div class="font-bold text-lg">
                    PENDAFTARAN DIBUKA! 
                    <span class="font-normal">Gelombang 1: 1 Januari - 31 Maret 2025</span>
                </div>
                <a href="/daftar" class="bg-nu-dark text-white px-6 py-2 rounded-full hover:bg-green-800 transition-all duration-300">
                    Daftar →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- PPDB Information -->
<section class="py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Informasi <span class="text-nu-green">PPDB 2025/2026</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Segera daftarkan putra-putri Anda di sekolah terbaik dengan proses pendaftaran yang mudah dan cepat
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Gelombang 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg border-2 border-nu-green">
                <div class="text-center">
                    <div class="w-16 h-16 bg-nu-green rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">1</span>
                    </div>
                    <h3 class="text-2xl font-bold text-nu-dark mb-2">Gelombang 1</h3>
                    <p class="text-nu-green font-semibold mb-4">1 Januari - 31 Maret 2025</p>
                    <div class="space-y-2 mb-6">
                        <div class="flex justify-between text-sm">
                            <span>Biaya Pendaftaran:</span>
                            <span class="font-semibold">Rp 250.000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>SPP:</span>
                            <span class="font-semibold">Rp 400.000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Diskon Early Bird:</span>
                            <span class="font-semibold text-red-500">20%</span>
                        </div>
                    </div>
                    <a href="/daftar?gelombang=1" class="w-full bg-nu-green text-white py-3 rounded-lg font-semibold hover:bg-nu-dark transition-all duration-300 block text-center">
                        Daftar Gelombang 1
                    </a>
                </div>
            </div>
            
            <!-- Gelombang 2 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">2</span>
                    </div>
                    <h3 class="text-2xl font-bold text-nu-dark mb-2">Gelombang 2</h3>
                    <p class="text-gray-600 font-semibold mb-4">1 April - 30 Juni 2025</p>
                    <div class="space-y-2 mb-6">
                        <div class="flex justify-between text-sm">
                            <span>Biaya Pendaftaran:</span>
                            <span class="font-semibold">Rp 300.000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>SPP:</span>
                            <span class="font-semibold">Rp 400.000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Diskon:</span>
                            <span class="font-semibold text-red-500">10%</span>
                        </div>
                    </div>
                    <button class="w-full bg-gray-300 text-gray-600 py-3 rounded-lg font-semibold cursor-not-allowed">
                        Segera Dibuka
                    </button>
                </div>
            </div>
            
            <!-- Gelombang 3 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">3</span>
                    </div>
                    <h3 class="text-2xl font-bold text-nu-dark mb-2">Gelombang 3</h3>
                    <p class="text-gray-600 font-semibold mb-4">1 Juli - 31 Juli 2025</p>
                    <div class="space-y-2 mb-6">
                        <div class="flex justify-between text-sm">
                            <span>Biaya Pendaftaran:</span>
                            <span class="font-semibold">Rp 350.000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>SPP:</span>
                            <span class="font-semibold">Rp 400.000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Diskon:</span>
                            <span class="font-semibold">-</span>
                        </div>
                    </div>
                    <button class="w-full bg-gray-300 text-gray-600 py-3 rounded-lg font-semibold cursor-not-allowed">
                        Segera Dibuka
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Quick Info -->
        <div class="bg-nu-cream rounded-2xl p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center">
                    <i class="fas fa-users text-nu-green text-3xl mb-3"></i>
                    <h4 class="font-bold text-nu-dark mb-2">Kuota Terbatas</h4>
                    <p class="text-sm text-gray-600">Hanya 120 siswa per angkatan</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-calendar-check text-nu-green text-3xl mb-3"></i>
                    <h4 class="font-bold text-nu-dark mb-2">Tes Masuk</h4>
                    <p class="text-sm text-gray-600">Wawancara & Tes Kemampuan Dasar</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-graduation-cap text-nu-green text-3xl mb-3"></i>
                    <h4 class="font-bold text-nu-dark mb-2">Usia</h4>
                    <p class="text-sm text-gray-600">6-7 tahun per 1 Juli 2025</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-file-alt text-nu-green text-3xl mb-3"></i>
                    <h4 class="font-bold text-nu-dark mb-2">Syarat</h4>
                    <p class="text-sm text-gray-600">Akta Kelahiran & Foto</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
