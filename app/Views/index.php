<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-nu-cream via-white to-nu-cream">
  <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
    <!-- Announcement Banner -->
    <div class="flex justify-center">
      <p class="inline-block text-sm font-semibold text-nu-green bg-nu-cream px-4 py-2 rounded-full border border-nu-green/20">
          PPDB <?= date('Y') ?>/<?= date('Y') + 1 ?>
        </p>
    </div>
    <!-- End Announcement Banner -->

    <!-- Title -->
    <div class="mt-5 max-w-2xl text-center mx-auto">
      <h1 class="block font-bold text-nu-dark text-4xl md:text-5xl lg:text-6xl">
        PPDB 
        <span class="bg-clip-text bg-gradient-to-r from-nu-green to-nu-gold text-transparent">SDNU Pemanahan</span>
      </h1>
    </div>
    <!-- End Title -->

    <div class="mt-5 max-w-3xl text-center mx-auto">
      <p class="text-lg text-gray-700">Lembaga pendidikan Islam terpercaya yang mengintegrasikan nilai-nilai Ahlussunnah wal Jamaah dengan pendidikan modern berkualitas</p>
    </div>

    <!-- Buttons -->
    <div class="mt-8 gap-3 flex justify-center">
      <a class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-r from-nu-green to-nu-dark hover:from-nu-dark hover:to-nu-green border border-transparent text-white text-sm font-medium rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 py-3 px-6" href="/daftar">
        <i class="fas fa-edit"></i>
        Daftar Sekarang
      </a>
      <a class="inline-flex justify-center items-center gap-x-3.5 text-center border border-nu-green/30 hover:border-nu-green bg-white hover:bg-nu-green/5 text-sm text-nu-dark font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300 py-3 px-6" href="/ppdb">
        <i class="fas fa-info-circle"></i>
        Info PPDB
      </a>
    </div>
    <!-- End Buttons -->

    <div class="mt-5 flex justify-center items-center gap-x-1 sm:gap-x-3">
      <span class="text-sm text-gray-600">Kuota Terbatas:</span>
      <span class="text-sm font-bold text-nu-dark">30 siswa</span>
    </div>
  </div>
</div>

<!-- Features -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto bg-white">
  <!-- Grid -->
  <div class="grid md:grid-cols-2 gap-12">
    <div class="lg:w-3/4">
      <h2 class="text-3xl text-nu-dark font-bold lg:text-4xl">
        Informasi <span class="text-nu-green">PPDB <?= date('Y') ?>/<?= date('Y') + 1 ?></span>
      </h2>
      <p class="mt-3 text-gray-600">
        Segera daftarkan putra-putri Anda di sekolah terbaik dengan proses pendaftaran yang mudah dan cepat
      </p>
      <p class="mt-5">
        <a class="inline-flex items-center gap-x-1 text-sm text-nu-green decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="/ppdb">
          Selengkapnya
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </a>
      </p>
    </div>
    <!-- End Col -->

    <div class="space-y-6 lg:space-y-10">
      <!-- Icon Block -->
      <div class="flex gap-x-5 sm:gap-x-8">
        <!-- Icon -->
        <span class="shrink-0 inline-flex justify-center items-center size-[46px] rounded-full border border-nu-green/20 bg-nu-cream text-nu-green shadow-sm">
          <i class="fas fa-users shrink-0 size-5"></i>
        </span>
        <div class="grow">
          <h3 class="text-base sm:text-lg font-semibold text-nu-dark">
            Kuota Terbatas
          </h3>
          <p class="mt-1 text-gray-600">
            Hanya <span class="font-semibold text-nu-green">30 siswa</span> per angkatan untuk memastikan kualitas pembelajaran yang optimal
          </p>
        </div>
      </div>
      <!-- End Icon Block -->

      <!-- Icon Block -->
      <div class="flex gap-x-5 sm:gap-x-8">
        <!-- Icon -->
        <span class="shrink-0 inline-flex justify-center items-center size-[46px] rounded-full border border-nu-green/20 bg-nu-cream text-nu-green shadow-sm">
          <i class="fas fa-file-alt shrink-0 size-5"></i>
        </span>
        <div class="grow">
          <h3 class="text-base sm:text-lg font-semibold text-nu-dark">
            Syarat Mudah
          </h3>
          <p class="mt-1 text-gray-600">
            Cukup siapkan Akta Kelahiran, Foto, & Kartu Keluarga untuk proses pendaftaran
          </p>
        </div>
      </div>
      <!-- End Icon Block -->

      <!-- Icon Block -->
      <div class="flex gap-x-5 sm:gap-x-8">
        <!-- Icon -->
        <span class="shrink-0 inline-flex justify-center items-center size-[46px] rounded-full border border-nu-green/20 bg-nu-cream text-nu-green shadow-sm">
          <i class="fas fa-clock shrink-0 size-5"></i>
        </span>
        <div class="grow">
          <h3 class="text-base sm:text-lg font-semibold text-nu-dark">
            Keuntungan kategori Pendaftaran
          </h3>
          <p class="mt-1 text-gray-600">
            Pilih kategori pendaftaran yang sesuai dengan kebutuhan dan dapatkan benefit menarik
          </p>
        </div>
      </div>
      <!-- End Icon Block -->
    </div>
    <!-- End Col -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Features -->

<!-- Pricing -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto bg-gradient-to-br from-nu-cream via-white to-nu-cream">
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight text-nu-dark">Benefit Pendaftaran</h2>
    <p class="mt-1 text-gray-600">Pilih kategori siswa berdasarkan pendaftaran</p>
  </div>
  <!-- End Title -->

<!-- Grid -->
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:items-center">
    <!-- Card -->
    <div class="flex flex-col border border-gray-200 bg-white text-center rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
        <h4 class="font-medium text-lg text-nu-dark">Kakak Beradik</h4>
        <span class="mt-7 font-bold text-5xl text-nu-dark">
            <span class="font-bold text-2xl -me-2">Rp</span>
            75K
        </span>

        <ul class="mt-7 space-y-2.5 text-sm">
            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-nu-green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                <span class="text-gray-700">
                    Potongan Spp hingga 25%
                </span>
            </li>
        </ul>

        <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors duration-300" href="/daftar" disabled>
            Daftar Sekarang
        </a>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col border-2 border-nu-green bg-white text-center shadow-xl rounded-xl p-8 transform scale-105">
        <p class="mb-3">
            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-xs uppercase font-semibold bg-nu-green text-white">Terbuka</span>
        </p>
        <h4 class="font-medium text-lg text-nu-dark">Pendaftar Awal</h4>
        <span class="mt-5 font-bold text-5xl text-nu-dark">
            Beasiswa SPP
        </span>
        <ul class="mt-7 space-y-2.5 text-sm">
            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-nu-green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                <span class="text-gray-700">
                    <strong>untuk 10 pendaftar pertama (6 bulan)</strong>
                </span>
            </li>
            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-nu-green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                <span class="text-gray-700">
                    <strong>untuk 10 pendaftar kedua (3 bulan)</strong>
                </span>
            </li>
        </ul>

        <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-gradient-to-r from-nu-green to-nu-dark text-white hover:from-nu-dark hover:to-nu-green shadow-lg hover:shadow-xl transition-all duration-300" href="/daftar">
            Daftar Sekarang
        </a>
    </div>
    <div class="flex flex-col border border-gray-200 bg-white text-center rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
        <h4 class="font-medium text-lg text-nu-dark">Warga Kerto</h4>
        <span class="mt-7 font-bold text-5xl text-nu-dark">
            <span class="font-bold text-2xl -me-2">Rp</span>
            75k
        </span>
        <ul class="mt-7 space-y-2.5 text-sm">
            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                <span class="text-gray-600">
                    Potongan hingga 25%
                </span>
            </li>
        </ul>

        <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors duration-300" href="/daftar" disabled>
            Daftar Sekarang
        </a>
    </div>
</div>
</div>
<?= $this->endSection() ?>
