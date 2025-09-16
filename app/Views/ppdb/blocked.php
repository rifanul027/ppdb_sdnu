<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Blocked / Coming Soon Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-nu-cream via-white to-nu-cream">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-20">
        <div class="max-w-3xl mx-auto text-center">
            <p class="inline-block text-sm font-semibold text-nu-green bg-nu-cream px-4 py-2 rounded-full border border-nu-green/20">
                Info PPDB <?= date('Y') ?>/<?= date('Y') + 1 ?>
            </p>

            <h1 class="mt-6 text-3xl md:text-4xl lg:text-5xl font-bold text-nu-dark">
                Pendaftaran Belum Dibuka
            </h1>

            <p class="mt-4 text-gray-600">
                Saat ini pendaftaran belum dibuka. Silakan cek pengumuman atau kembali lagi nanti untuk informasi lebih lanjut.
            </p>

            <div class="mt-8 flex justify-center gap-3">
                <a href="/" class="inline-flex items-center gap-x-3 bg-gradient-to-r from-nu-green to-nu-dark text-white text-sm font-medium rounded-lg shadow-lg transition-all duration-300 py-3 px-5">
                    <i class="fas fa-home"></i>
                    Beranda
                </a>

                <a href="/ppdb" class="inline-flex items-center gap-x-3 border border-nu-green/30 bg-white hover:bg-nu-green/5 text-sm text-nu-dark font-medium rounded-lg shadow-md transition-all duration-300 py-3 px-5">
                    <i class="fas fa-info-circle"></i>
                    Info PPDB
                </a>
            </div>

            <div class="mt-6 text-sm text-gray-600">
                Jika Anda memiliki pertanyaan, silakan hubungi admin sekolah atau cek halaman pengumuman.
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
