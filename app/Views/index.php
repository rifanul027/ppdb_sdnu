<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-nu-cream via-white to-nu-cream">
  <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
    <!-- Announcement Banner -->
    <div class="flex justify-center">
      <a class="inline-flex items-center gap-x-2 bg-gradient-to-r from-nu-green to-nu-dark border border-nu-green/20 text-sm text-white p-1 ps-3 rounded-full transition hover:from-nu-dark hover:to-nu-green shadow-lg" href="/daftar">
        PENDAFTARAN DIBUKA! Gelombang 1: 1 Januari - 31 Maret 2025
        <span class="py-1.5 px-2.5 inline-flex justify-center items-center gap-x-2 rounded-full bg-white/20 font-semibold text-sm text-white">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </span>
      </a>
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
      <span class="text-sm font-bold text-nu-dark">120 siswa</span>
      <svg class="size-5 text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M6 13L10 3" stroke="currentColor" stroke-linecap="round"/>
      </svg>
      <a class="inline-flex items-center gap-x-1 text-sm text-nu-green decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="/syarat">
        Syarat Pendaftaran
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
      </a>
    </div>
  </div>
</div>

<!-- Features -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto bg-white">
  <!-- Grid -->
  <div class="grid md:grid-cols-2 gap-12">
    <div class="lg:w-3/4">
      <h2 class="text-3xl text-nu-dark font-bold lg:text-4xl">
        Informasi <span class="text-nu-green">PPDB 2025/2026</span>
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
            Hanya <span class="font-semibold text-nu-green">120 siswa</span> per angkatan untuk memastikan kualitas pembelajaran yang optimal
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
            3 Gelombang Pendaftaran
          </h3>
          <p class="mt-1 text-gray-600">
            Pilih gelombang pendaftaran yang sesuai dengan kebutuhan dan dapatkan benefit menarik
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
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight text-nu-dark">Gelombang Pendaftaran</h2>
    <p class="mt-1 text-gray-600">Pilih gelombang yang sesuai dengan rencana Anda</p>
  </div>
  <!-- End Title -->

<!-- Grid -->
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:items-center">
    <!-- Card -->
    <div class="flex flex-col border border-gray-200 bg-white text-center rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
        <h4 class="font-medium text-lg text-nu-dark">Gelombang 2</h4>
        <span class="mt-7 font-bold text-5xl text-nu-dark">
            <span class="font-bold text-2xl -me-2">Rp</span>
            300K
        </span>
        <p class="mt-2 text-sm text-gray-500">1 April - 30 Juni 2025</p>

        <ul class="mt-7 space-y-2.5 text-sm">
            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-nu-green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                <span class="text-gray-700">
                    Beasiswa SPP 300K (3 bulan)
                </span>
            </li>

            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-nu-green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                <span class="text-gray-700">
                    Gratis tas sekolah
                </span>
            </li>

            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-nu-green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                <span class="text-gray-700">
                    Potongan seragam 50%
                </span>
            </li>
        </ul>

        <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors duration-300" href="#" disabled>
            Segera Dibuka
        </a>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col border-2 border-nu-green bg-white text-center shadow-xl rounded-xl p-8 transform scale-105">
        <p class="mb-3">
            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-xs uppercase font-semibold bg-nu-green text-white">Terbuka Sekarang</span>
        </p>
        <h4 class="font-medium text-lg text-nu-dark">Gelombang 1</h4>
        <span class="mt-5 font-bold text-5xl text-nu-dark">
            <span class="font-bold text-2xl -me-2">Rp</span>
            250K
        </span>
        <p class="mt-2 text-sm text-gray-500">1 Januari - 31 Maret 2025</p>

        <ul class="mt-7 space-y-2.5 text-sm">
            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-nu-green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                <span class="text-gray-700">
                    <strong>Beasiswa SPP 600K (6 bulan)</strong>
                </span>
            </li>

            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-orange-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                <span class="text-orange-600 font-semibold">
                    10 pendaftar pertama
                </span>
            </li>

            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-nu-green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                <span class="text-gray-700">
                    Gratis seragam lengkap
                </span>
            </li>

            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-nu-green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                <span class="text-gray-700">
                    Prioritas pemilihan kelas
                </span>
            </li>
        </ul>

        <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-gradient-to-r from-nu-green to-nu-dark text-white hover:from-nu-dark hover:to-nu-green shadow-lg hover:shadow-xl transition-all duration-300" href="/daftar?gelombang=1">
            Daftar Gelombang 1
        </a>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col border border-gray-200 bg-white text-center rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
        <h4 class="font-medium text-lg text-nu-dark">Gelombang 3</h4>
        <span class="mt-7 font-bold text-5xl text-nu-dark">
            <span class="font-bold text-2xl -me-2">Rp</span>
            350K
        </span>
        <p class="mt-2 text-sm text-gray-500">1 Juli - 31 Juli 2025</p>

        <ul class="mt-7 space-y-2.5 text-sm">
            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                <span class="text-gray-600">
                    Tanpa diskon
                </span>
            </li>

            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                <span class="text-gray-600">
                    Standar benefit
                </span>
            </li>

            <li class="flex space-x-2">
                <svg class="shrink-0 mt-0.5 size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                <span class="text-gray-600">
                    Sisa kuota terbatas
                </span>
            </li>
        </ul>

        <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors duration-300" href="#" disabled>
            Segera Dibuka
        </a>
    </div>
    <!-- End Card -->
</div>
<!-- End Grid -->

<!-- Special Offers Section -->
<div class="mt-16 max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <h3 class="text-2xl font-bold text-nu-dark">Program Beasiswa Khusus</h3>
        <p class="mt-2 text-gray-600">Dapatkan keringanan SPP dengan syarat dan ketentuan berlaku</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-6">
        <!-- Beasiswa Desa Pemanahan -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-6 text-center">
            <div class="inline-flex items-center justify-center size-12 bg-blue-500 text-white rounded-full mb-4">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <h4 class="text-lg font-semibold text-blue-800 mb-2">Warga Desa Pemanahan</h4>
            <div class="text-3xl font-bold text-blue-600 mb-2">SPP Rp 75K</div>
            <p class="text-sm text-blue-700 mb-4">Potongan khusus untuk warga setempat</p>
            <div class="text-xs text-blue-600 bg-blue-200 rounded-full px-3 py-1 inline-block">
                Berlaku untuk semua gelombang
            </div>
        </div>

        <!-- Beasiswa Kakak Adik -->
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl p-6 text-center">
            <div class="inline-flex items-center justify-center size-12 bg-purple-500 text-white rounded-full mb-4">
                <i class="fas fa-users"></i>
            </div>
            <h4 class="text-lg font-semibold text-purple-800 mb-2">Kakak Adik Bersaudara</h4>
            <div class="text-3xl font-bold text-purple-600 mb-2">SPP Rp 75K</div>
            <p class="text-sm text-purple-700 mb-4">Diskon untuk saudara kandung</p>
            <div class="text-xs text-purple-600 bg-purple-200 rounded-full px-3 py-1 inline-block">
                Minimal 2 anak terdaftar
            </div>
        </div>
    </div>
</div>
<!-- End Special Offers Section -->
</div>
<!-- End Pricing -->

<?= $this->endSection() ?>
