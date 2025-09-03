<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero -->
<div class="relative overflow-hidden">
  <!-- Gradients -->
  <div aria-hidden="true" class="flex absolute -top-96 start-1/2 transform -translate-x-1/2">
    <div class="bg-gradient-to-r from-nu-green/50 to-nu-dark/50 blur-3xl w-[25rem] h-[44rem] rotate-[-60deg] transform -translate-x-[10rem] dark:from-violet-900/50 dark:to-purple-900/50"></div>
    <div class="bg-gradient-to-tl from-nu-gold/50 via-nu-green/50 to-nu-dark/50 blur-3xl w-[90rem] h-[50rem] rounded-fulls origin-top-left -rotate-12 -translate-x-[15rem] dark:from-indigo-900/70 dark:via-indigo-900/70 dark:to-blue-900/70"></div>
  </div>
  <!-- End Gradients -->

  <div class="relative z-10">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
      <div class="max-w-2xl text-center mx-auto">
        <p class="inline-block text-sm font-medium bg-clip-text bg-gradient-to-l from-nu-green to-nu-dark text-transparent dark:from-blue-400 dark:to-violet-400">
          PPDB 2025/2026
        </p>

        <!-- Title -->
        <div class="mt-5 max-w-2xl">
          <h1 class="block font-semibold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-neutral-200">
            Info <span class="bg-clip-text bg-gradient-to-tl from-nu-green to-nu-gold text-transparent">PPDB 2025/2026</span>
          </h1>
        </div>
        <!-- End Title -->

        <div class="mt-5 max-w-3xl">
          <p class="text-lg text-gray-600 dark:text-neutral-400">Penerimaan Peserta Didik Baru SD Nahdlatul Ulama Pemanahan Tahun Ajaran 2025/2026</p>
        </div>

        <!-- Buttons -->
        <div class="mt-8 gap-3 flex justify-center">
          <a class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-nu-green text-white hover:bg-nu-dark focus:outline-none focus:bg-nu-dark disabled:opacity-50 disabled:pointer-events-none" href="/daftar">
            <i class="fas fa-edit"></i>
            Daftar Sekarang
          </a>
          <a class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="/syarat">
            <i class="fas fa-file-alt"></i>
            Lihat Syarat
          </a>
        </div>
        <!-- End Buttons -->
      </div>
    </div>
  </div>
</div>
<!-- End Hero -->

<!-- Stats -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
      <div class="p-4 md:p-5">
        <div class="flex items-center gap-x-2">
          <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
            Kuota Siswa
          </p>
        </div>

        <div class="mt-1 flex items-center gap-x-2">
          <h3 class="text-xl sm:text-2xl font-medium text-nu-gold dark:text-neutral-200">
            120
          </h3>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
      <div class="p-4 md:p-5">
        <div class="flex items-center gap-x-2">
          <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
            Gelombang
          </p>
        </div>

        <div class="mt-1 flex items-center gap-x-2">
          <h3 class="text-xl sm:text-2xl font-medium text-nu-gold dark:text-neutral-200">
            3
          </h3>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
      <div class="p-4 md:p-5">
        <div class="flex items-center gap-x-2">
          <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
            Usia (Tahun)
          </p>
        </div>

        <div class="mt-1 flex items-center gap-x-2">
          <h3 class="text-xl sm:text-2xl font-medium text-nu-gold dark:text-neutral-200">
            6-7
          </h3>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
      <div class="p-4 md:p-5">
        <div class="flex items-center gap-x-2">
          <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
            Pendaftaran
          </p>
        </div>

        <div class="mt-1 flex items-center gap-x-2">
          <h3 class="text-xl sm:text-2xl font-medium text-nu-gold dark:text-neutral-200">
            100% Online
          </h3>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Stats -->

<!-- Pricing -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">
      Jadwal <span class="text-nu-green">Pendaftaran</span>
    </h2>
    <p class="mt-1 text-gray-600 dark:text-neutral-400">Pendaftaran dibuka dalam 3 gelombang dengan benefit yang berbeda</p>
  </div>
  <!-- End Title -->

  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:items-center">
    <!-- Card -->
    <div class="flex flex-col border border-gray-200 text-center rounded-xl p-8 dark:border-neutral-700">
      <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">Gelombang 2</h4>
      <span class="mt-5 font-bold text-3xl text-gray-800 dark:text-neutral-200">1 April - 30 Juni 2025</span>
      <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">Segera Dibuka</p>

      <ul class="mt-7 space-y-2.5 text-sm">
        <li class="flex space-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
          <span class="text-gray-800 dark:text-neutral-400">Diskon biaya pendaftaran 10%</span>
        </li>
        <li class="flex space-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
          <span class="text-gray-800 dark:text-neutral-400">Gratis tas sekolah</span>
        </li>
        <li class="flex space-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
          <span class="text-gray-800 dark:text-neutral-400">Potongan biaya seragam 50%</span>
        </li>
        <li class="flex space-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
          <span class="text-gray-800 dark:text-neutral-400">Program persiapan gratis</span>
        </li>
      </ul>

      <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#" disabled>
        Pendaftaran Belum Dibuka
      </a>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col border-2 border-nu-green text-center shadow-xl rounded-xl p-8 dark:border-blue-700">
      <p class="mb-3">
        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-xs uppercase font-semibold bg-nu-green text-white dark:bg-blue-600 dark:text-white">Terbuka</span>
      </p>
      <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">Gelombang 1</h4>
      <span class="mt-5 font-bold text-3xl text-gray-800 dark:text-neutral-200">1 Januari - 31 Maret 2025</span>
      <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">SPP/Bulan: Rp 400.000</p>

      <ul class="mt-7 space-y-2.5 text-sm">
        <li class="flex space-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
          <span class="text-gray-800 dark:text-neutral-400">Diskon biaya pendaftaran 20%</span>
        </li>
        <li class="flex space-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
          <span class="text-gray-800 dark:text-neutral-400">Gratis seragam lengkap</span>
        </li>
        <li class="flex space-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
          <span class="text-gray-800 dark:text-neutral-400">Prioritas pemilihan kelas</span>
        </li>
        <li class="flex space-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
          <span class="text-gray-800 dark:text-neutral-400">Bebas biaya tes masuk</span>
        </li>
      </ul>

      <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-nu-green text-white hover:bg-nu-dark disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-nu-dark" href="/daftar?gelombang=1">
        Daftar Gelombang 1
      </a>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col border border-gray-200 text-center rounded-xl p-8 dark:border-neutral-700">
      <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">Gelombang 3</h4>
      <span class="mt-5 font-bold text-3xl text-gray-800 dark:text-neutral-200">1 Juli - 31 Juli 2025</span>
      <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">Segera Dibuka</p>

      <ul class="mt-7 space-y-2.5 text-sm">
        <li class="flex space-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
          <span class="text-gray-800 dark:text-neutral-400">Benefit standar</span>
        </li>
        <li class="flex space-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
          <span class="text-gray-800 dark:text-neutral-400">Tanpa potongan harga</span>
        </li>
        <li class="flex space-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
          <span class="text-gray-800 dark:text-neutral-400">Sisa kuota terbatas</span>
        </li>
      </ul>

      <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#" disabled>
        Pendaftaran Belum Dibuka
      </a>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Pricing -->

<!-- Features -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">
      Syarat & <span class="text-nu-green">Ketentuan</span>
    </h2>
    <p class="mt-1 text-gray-600 dark:text-neutral-400">Persyaratan yang harus dipenuhi untuk mendaftar di SDNU Pemanahan</p>
  </div>
  <!-- End Title -->

  <!-- Grid -->
  <div class="grid md:grid-cols-2 gap-6 lg:gap-12">
    <div class="space-y-6 lg:space-y-10">
      <!-- Icon Block -->
      <div class="flex gap-x-5 sm:gap-x-8">
        <!-- Icon -->
        <span class="shrink-0 inline-flex justify-center items-center size-[46px] rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm mx-auto dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200">
          <i class="fas fa-user-check text-nu-green shrink-0 size-5"></i>
        </span>
        <div class="grow">
          <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-neutral-200">
            Usia Calon Siswa
          </h3>
          <p class="mt-1 text-gray-600 dark:text-neutral-400">
            Berusia 6-7 tahun per 1 Juli 2025
          </p>
        </div>
      </div>
      <!-- End Icon Block -->

      <!-- Icon Block -->
      <div class="flex gap-x-5 sm:gap-x-8">
        <!-- Icon -->
        <span class="shrink-0 inline-flex justify-center items-center size-[46px] rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm mx-auto dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200">
          <i class="fas fa-heart text-nu-green shrink-0 size-5"></i>
        </span>
        <div class="grow">
          <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-neutral-200">
            Kesehatan
          </h3>
          <p class="mt-1 text-gray-600 dark:text-neutral-400">
            Sehat jasmani dan rohani (surat keterangan dokter)
          </p>
        </div>
      </div>
      <!-- End Icon Block -->

      <!-- Icon Block -->
      <div class="flex gap-x-5 sm:gap-x-8">
        <!-- Icon -->
        <span class="shrink-0 inline-flex justify-center items-center size-[46px] rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm mx-auto dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200">
          <i class="fas fa-baby text-nu-green shrink-0 size-5"></i>
        </span>
        <div class="grow">
          <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-neutral-200">
            Tidak Sedang Bersekolah
          </h3>
          <p class="mt-1 text-gray-600 dark:text-neutral-400">
            Belum pernah bersekolah di SD/MI atau sederajat
          </p>
        </div>
      </div>
      <!-- End Icon Block -->
    </div>
    <!-- End Col -->

    <div class="space-y-6 lg:space-y-10">
      <!-- Icon Block -->
      <div class="flex gap-x-5 sm:gap-x-8">
        <!-- Icon -->
        <span class="shrink-0 inline-flex justify-center items-center size-[46px] rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm mx-auto dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200">
          <i class="fas fa-file-alt text-nu-green shrink-0 size-5"></i>
        </span>
        <div class="grow">
          <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-neutral-200">
            Akta Kelahiran
          </h3>
          <p class="mt-1 text-gray-600 dark:text-neutral-400">
            Fotocopy akta kelahiran yang telah dilegalisir
          </p>
        </div>
      </div>
      <!-- End Icon Block -->

      <!-- Icon Block -->
      <div class="flex gap-x-5 sm:gap-x-8">
        <!-- Icon -->
        <span class="shrink-0 inline-flex justify-center items-center size-[46px] rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm mx-auto dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200">
          <i class="fas fa-id-card text-nu-green shrink-0 size-5"></i>
        </span>
        <div class="grow">
          <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-neutral-200">
            Kartu Keluarga
          </h3>
          <p class="mt-1 text-gray-600 dark:text-neutral-400">
            Fotocopy kartu keluarga terbaru
          </p>
        </div>
      </div>
      <!-- End Icon Block -->

      <!-- Icon Block -->
      <div class="flex gap-x-5 sm:gap-x-8">
        <!-- Icon -->
        <span class="shrink-0 inline-flex justify-center items-center size-[46px] rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm mx-auto dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200">
          <i class="fas fa-camera text-nu-green shrink-0 size-5"></i>
        </span>
        <div class="grow">
          <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-neutral-200">
            Pas Foto
          </h3>
          <p class="mt-1 text-gray-600 dark:text-neutral-400">
            Pas foto berwarna ukuran 3x4 sebanyak 4 lembar
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

<?= $this->endSection() ?>
