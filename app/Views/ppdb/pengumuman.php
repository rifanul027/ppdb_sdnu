<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="gradient-bg text-white py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                <span class="text-nu-gold">Pengumuman</span> PPDB
            </h1>
            <p class="text-xl text-green-100 max-w-3xl mx-auto">
                Informasi Terbaru Penerimaan Peserta Didik Baru SD Nahdlatul Ulama Pemanahan
            </p>
        </div>
        
        <!-- Quick Info -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white border-opacity-20">
                <h3 class="text-3xl font-bold text-nu-gold mb-2">0</h3>
                <p class="text-green-100">Pengumuman Aktif</p>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white border-opacity-20">
                <h3 class="text-3xl font-bold text-nu-gold mb-2">1</h3>
                <p class="text-green-100">Gelombang Aktif</p>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white border-opacity-20">
                <h3 class="text-3xl font-bold text-nu-gold mb-2">120</h3>
                <p class="text-green-100">Kuota Tersisa</p>
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
                Pantau terus pengumuman penting dari SDNU Pemanahan
            </p>
        </div>
        
        <!-- Empty State -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl p-12 shadow-lg text-center border border-gray-100">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <i class="fas fa-bullhorn text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-nu-dark mb-4">Belum Ada Pengumuman</h3>
                <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                    Pengumuman terbaru mengenai PPDB 2025/2026 akan muncul di sini. 
                    Pastikan Anda mengecek halaman ini secara berkala untuk mendapatkan informasi terkini.
                </p>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/ppdb" class="bg-nu-green text-white px-8 py-3 rounded-lg font-semibold hover:bg-nu-dark transition-all duration-300 inline-flex items-center justify-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Lihat Info PPDB
                    </a>
                    <button onclick="location.reload()" class="border-2 border-nu-green text-nu-green px-8 py-3 rounded-lg font-semibold hover:bg-nu-green hover:text-white transition-all duration-300 inline-flex items-center justify-center">
                        <i class="fas fa-sync-alt mr-2"></i>
                        Refresh Halaman
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>



<?= $this->endSection() ?>
