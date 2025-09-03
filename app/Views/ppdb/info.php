<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero -->
<div class="relative overflow-hidden bg-gradient-to-br from-nu-cream via-white to-green-50">
  <!-- Subtle Pattern -->
  <div aria-hidden="true" class="absolute inset-0 opacity-30">
    <div class="absolute top-10 left-10 w-20 h-20 bg-nu-green/10 rounded-full blur-xl"></div>
    <div class="absolute top-32 right-20 w-32 h-32 bg-nu-gold/10 rounded-full blur-2xl"></div>
    <div class="absolute bottom-20 left-32 w-24 h-24 bg-nu-dark/10 rounded-full blur-xl"></div>
  </div>
  <!-- End Pattern -->

  <div class="relative z-10">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
      <div class="max-w-2xl text-center mx-auto">
        <p class="inline-block text-sm font-semibold text-nu-green bg-nu-cream px-4 py-2 rounded-full border border-nu-green/20">
          PPDB 2025/2026
        </p>

        <!-- Title -->
        <div class="mt-6 max-w-2xl">
          <h1 class="block font-bold text-nu-dark text-4xl md:text-5xl lg:text-6xl">
            Info <span class="text-nu-green">PPDB 2025/2026</span>
          </h1>
        </div>
        <!-- End Title -->

        <div class="mt-6 max-w-3xl">
          <p class="text-lg text-gray-700 leading-relaxed">Penerimaan Peserta Didik Baru SD Nahdlatul Ulama Pemanahan Tahun Ajaran 2025/2026</p>
        </div>

        <!-- Buttons -->
        <div class="mt-8 gap-4 flex flex-col sm:flex-row justify-center">
          <a class="py-3 px-6 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gradient-to-r from-nu-green to-nu-dark text-white hover:from-nu-dark hover:to-nu-green focus:outline-none focus:ring-2 focus:ring-nu-green focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl" href="/daftar">
            <i class="fas fa-edit"></i>
            Daftar Sekarang
          </a>
          <a class="py-3 px-6 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border-2 border-nu-green bg-white text-nu-green hover:bg-nu-green hover:text-white focus:outline-none focus:ring-2 focus:ring-nu-green focus:ring-offset-2 transition-all duration-300" href="/syarat">
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
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto bg-gray-50">
  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    <!-- Card -->
    <div class="flex flex-col bg-white border border-nu-green/20 shadow-lg rounded-xl hover:shadow-xl transition-all duration-300">
      <div class="p-6 text-center">
        <div class="w-12 h-12 bg-nu-green/10 rounded-full flex items-center justify-center mx-auto mb-3">
          <i class="fas fa-users text-nu-green text-xl"></i>
        </div>
        <div class="flex items-center justify-center gap-x-2">
          <h3 class="text-3xl font-bold text-nu-dark">120</h3>
        </div>
        <p class="text-sm font-medium text-gray-600 mt-2">Kuota Siswa</p>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border border-nu-green/20 shadow-lg rounded-xl hover:shadow-xl transition-all duration-300">
      <div class="p-6 text-center">
        <div class="w-12 h-12 bg-nu-green/10 rounded-full flex items-center justify-center mx-auto mb-3">
          <i class="fas fa-layer-group text-nu-green text-xl"></i>
        </div>
        <div class="flex items-center justify-center gap-x-2">
          <h3 class="text-3xl font-bold text-nu-dark">3</h3>
        </div>
        <p class="text-sm font-medium text-gray-600 mt-2">Gelombang</p>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border border-nu-green/20 shadow-lg rounded-xl hover:shadow-xl transition-all duration-300">
      <div class="p-6 text-center">
        <div class="w-12 h-12 bg-nu-green/10 rounded-full flex items-center justify-center mx-auto mb-3">
          <i class="fas fa-child text-nu-green text-xl"></i>
        </div>
        <div class="flex items-center justify-center gap-x-2">
          <h3 class="text-3xl font-bold text-nu-dark">6-7</h3>
        </div>
        <p class="text-sm font-medium text-gray-600 mt-2">Usia (Tahun)</p>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border border-nu-green/20 shadow-lg rounded-xl hover:shadow-xl transition-all duration-300">
      <div class="p-6 text-center">
        <div class="w-12 h-12 bg-nu-green/10 rounded-full flex items-center justify-center mx-auto mb-3">
          <i class="fas fa-laptop text-nu-green text-xl"></i>
        </div>
        <div class="flex items-center justify-center gap-x-2">
          <h3 class="text-2xl font-bold text-nu-dark">100%</h3>
        </div>
        <p class="text-sm font-medium text-gray-600 mt-2">Online</p>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Stats -->

<!-- Pricing -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto bg-white">
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-3xl font-bold md:text-4xl md:leading-tight text-nu-dark">
      Jadwal <span class="text-nu-green">Pendaftaran</span>
    </h2>
    <p class="mt-4 text-lg text-gray-600">Pendaftaran dibuka dalam 3 gelombang dengan benefit yang berbeda</p>
  </div>
  <!-- End Title -->

  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:items-stretch">
    <!-- Card -->
    <div class="flex flex-col border-2 border-gray-200 text-center rounded-2xl p-8 hover:border-gray-300 transition-all duration-300 bg-gray-50">
      <div class="mb-4">
        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs uppercase font-semibold bg-gray-400 text-white">Segera</span>
      </div>
      <h4 class="font-bold text-xl text-nu-dark mb-2">Gelombang 2</h4>
      <div class="text-center mb-4">
        <span class="text-2xl font-bold text-nu-dark">1 April - 30 Juni 2025</span>
      </div>
      <p class="text-sm text-gray-600 mb-6">Biaya Pendaftaran: Rp 270.000 (Diskon 10%)</p>

      <ul class="space-y-3 text-sm mb-8 flex-grow">
        <li class="flex items-start space-x-2">
          <i class="fas fa-check-circle text-nu-green mt-0.5 flex-shrink-0"></i>
          <span class="text-gray-700">Diskon biaya pendaftaran 10%</span>
        </li>
        <li class="flex items-start space-x-2">
          <i class="fas fa-check-circle text-nu-green mt-0.5 flex-shrink-0"></i>
          <span class="text-gray-700">Gratis tas sekolah</span>
        </li>
        <li class="flex items-start space-x-2">
          <i class="fas fa-check-circle text-nu-green mt-0.5 flex-shrink-0"></i>
          <span class="text-gray-700">Potongan biaya seragam 50%</span>
        </li>
        <li class="flex items-start space-x-2">
          <i class="fas fa-check-circle text-nu-green mt-0.5 flex-shrink-0"></i>
          <span class="text-gray-700">Program persiapan gratis</span>
        </li>
      </ul>

      <button class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border-2 border-gray-400 bg-gray-100 text-gray-500 cursor-not-allowed" disabled>
        Pendaftaran Belum Dibuka
      </button>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col border-2 border-nu-green text-center shadow-xl rounded-2xl p-8 bg-white transform hover:scale-105 transition-all duration-300">
      <div class="mb-4">
        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs uppercase font-semibold bg-nu-green text-white">Terbuka</span>
      </div>
      <h4 class="font-bold text-xl text-nu-dark mb-2">Gelombang 1</h4>
      <div class="text-center mb-4">
        <span class="text-2xl font-bold text-nu-green">1 Januari - 31 Maret 2025</span>
      </div>
      <p class="text-sm text-gray-600 mb-6">Biaya Pendaftaran: Rp 200.000 (Diskon 20%)</p>

      <ul class="space-y-3 text-sm mb-8 flex-grow">
        <li class="flex items-start space-x-2">
          <i class="fas fa-check-circle text-nu-green mt-0.5 flex-shrink-0"></i>
          <span class="text-gray-700">Diskon biaya pendaftaran 20%</span>
        </li>
        <li class="flex items-start space-x-2">
          <i class="fas fa-check-circle text-nu-green mt-0.5 flex-shrink-0"></i>
          <span class="text-gray-700">Gratis seragam lengkap</span>
        </li>
        <li class="flex items-start space-x-2">
          <i class="fas fa-check-circle text-nu-green mt-0.5 flex-shrink-0"></i>
          <span class="text-gray-700">Prioritas pemilihan kelas</span>
        </li>
        <li class="flex items-start space-x-2">
          <i class="fas fa-check-circle text-nu-green mt-0.5 flex-shrink-0"></i>
          <span class="text-gray-700">Bebas biaya tes masuk</span>
        </li>
      </ul>

      <a class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gradient-to-r from-nu-green to-nu-dark text-white hover:from-nu-dark hover:to-nu-green focus:outline-none focus:ring-2 focus:ring-nu-green focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl" href="/daftar?gelombang=1">
        Daftar Gelombang 1
      </a>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col border-2 border-gray-200 text-center rounded-2xl p-8 hover:border-gray-300 transition-all duration-300 bg-gray-50">
      <div class="mb-4">
        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs uppercase font-semibold bg-gray-400 text-white">Segera</span>
      </div>
      <h4 class="font-bold text-xl text-nu-dark mb-2">Gelombang 3</h4>
      <div class="text-center mb-4">
        <span class="text-2xl font-bold text-nu-dark">1 Juli - 31 Juli 2025</span>
      </div>
      <p class="text-sm text-gray-600 mb-6">Biaya Pendaftaran: Rp 350.000 (Harga Normal)</p>

      <ul class="space-y-3 text-sm mb-8 flex-grow">
        <li class="flex items-start space-x-2">
          <i class="fas fa-check-circle text-gray-400 mt-0.5 flex-shrink-0"></i>
          <span class="text-gray-600">Benefit standar</span>
        </li>
        <li class="flex items-start space-x-2">
          <i class="fas fa-check-circle text-gray-400 mt-0.5 flex-shrink-0"></i>
          <span class="text-gray-600">Tanpa potongan harga</span>
        </li>
        <li class="flex items-start space-x-2">
          <i class="fas fa-check-circle text-gray-400 mt-0.5 flex-shrink-0"></i>
          <span class="text-gray-600">Sisa kuota terbatas</span>
        </li>
        <li class="flex items-start space-x-2">
          <i class="fas fa-exclamation-triangle text-orange-400 mt-0.5 flex-shrink-0"></i>
          <span class="text-gray-600">Tergantung ketersediaan</span>
        </li>
      </ul>

      <button class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border-2 border-gray-400 bg-gray-100 text-gray-500 cursor-not-allowed" disabled>
        Pendaftaran Belum Dibuka
      </button>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Pricing -->

<!-- Features -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto bg-gray-50">
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-3xl font-bold md:text-4xl md:leading-tight text-nu-dark">
      Syarat & <span class="text-nu-green">Ketentuan</span>
    </h2>
    <p class="mt-4 text-lg text-gray-600">Persyaratan yang harus dipenuhi untuk mendaftar di SDNU Pemanahan</p>
  </div>
  <!-- End Title -->

  <!-- Grid -->
  <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
    <div class="bg-white rounded-2xl p-8 shadow-lg border border-nu-green/20">
      <h3 class="text-xl font-bold text-nu-dark mb-6 flex items-center">
        <div class="w-10 h-10 bg-nu-green/10 rounded-full flex items-center justify-center mr-3">
          <i class="fas fa-user-check text-nu-green"></i>
        </div>
        Syarat Umum
      </h3>
      <div class="space-y-6">
        <!-- Icon Block -->
        <div class="flex gap-x-4">
          <!-- Icon -->
          <span class="shrink-0 inline-flex justify-center items-center size-[40px] rounded-full bg-nu-green/10 text-nu-green">
            <i class="fas fa-child"></i>
          </span>
          <div class="grow">
            <h4 class="text-base font-semibold text-nu-dark">
              Usia Calon Siswa
            </h4>
            <p class="mt-1 text-gray-600">
              Berusia 6-7 tahun per 1 Juli 2025
            </p>
          </div>
        </div>
        <!-- End Icon Block -->

        <!-- Icon Block -->
        <div class="flex gap-x-4">
          <!-- Icon -->
          <span class="shrink-0 inline-flex justify-center items-center size-[40px] rounded-full bg-nu-green/10 text-nu-green">
            <i class="fas fa-heart"></i>
          </span>
          <div class="grow">
            <h4 class="text-base font-semibold text-nu-dark">
              Kesehatan
            </h4>
            <p class="mt-1 text-gray-600">
              Sehat jasmani dan rohani (surat keterangan dokter)
            </p>
          </div>
        </div>
        <!-- End Icon Block -->

        <!-- Icon Block -->
        <div class="flex gap-x-4">
          <!-- Icon -->
          <span class="shrink-0 inline-flex justify-center items-center size-[40px] rounded-full bg-nu-green/10 text-nu-green">
            <i class="fas fa-school"></i>
          </span>
          <div class="grow">
            <h4 class="text-base font-semibold text-nu-dark">
              Status Pendidikan
            </h4>
            <p class="mt-1 text-gray-600">
              Belum pernah bersekolah di SD/MI atau sederajat
            </p>
          </div>
        </div>
        <!-- End Icon Block -->
      </div>
    </div>
    <!-- End Col -->

    <div class="bg-white rounded-2xl p-8 shadow-lg border border-nu-green/20">
      <h3 class="text-xl font-bold text-nu-dark mb-6 flex items-center">
        <div class="w-10 h-10 bg-nu-green/10 rounded-full flex items-center justify-center mr-3">
          <i class="fas fa-file-alt text-nu-green"></i>
        </div>
        Dokumen Diperlukan
      </h3>
      <div class="space-y-6">
        <!-- Icon Block -->
        <div class="flex gap-x-4">
          <!-- Icon -->
          <span class="shrink-0 inline-flex justify-center items-center size-[40px] rounded-full bg-nu-gold/10 text-nu-gold">
            <i class="fas fa-certificate"></i>
          </span>
          <div class="grow">
            <h4 class="text-base font-semibold text-nu-dark">
              Akta Kelahiran
            </h4>
            <p class="mt-1 text-gray-600">
              Fotocopy akta kelahiran yang telah dilegalisir
            </p>
          </div>
        </div>
        <!-- End Icon Block -->

        <!-- Icon Block -->
        <div class="flex gap-x-4">
          <!-- Icon -->
          <span class="shrink-0 inline-flex justify-center items-center size-[40px] rounded-full bg-nu-gold/10 text-nu-gold">
            <i class="fas fa-id-card"></i>
          </span>
          <div class="grow">
            <h4 class="text-base font-semibold text-nu-dark">
              Kartu Keluarga
            </h4>
            <p class="mt-1 text-gray-600">
              Fotocopy kartu keluarga terbaru
            </p>
          </div>
        </div>
        <!-- End Icon Block -->

        <!-- Icon Block -->
        <div class="flex gap-x-4">
          <!-- Icon -->
          <span class="shrink-0 inline-flex justify-center items-center size-[40px] rounded-full bg-nu-gold/10 text-nu-gold">
            <i class="fas fa-camera"></i>
          </span>
          <div class="grow">
            <h4 class="text-base font-semibold text-nu-dark">
              Pas Foto
            </h4>
            <p class="mt-1 text-gray-600">
              Pas foto berwarna ukuran 3x4 sebanyak 4 lembar
            </p>
          </div>
        </div>
        <!-- End Icon Block -->
      </div>
    </div>
    <!-- End Col -->
  </div>
  <!-- End Grid -->

  <!-- CTA Section -->
  <div class="mt-12 text-center">
    <div class="bg-gradient-to-r from-nu-green/5 to-nu-gold/5 rounded-2xl p-8 border border-nu-green/20">
      <h3 class="text-2xl font-bold text-nu-dark mb-4">Siap Mendaftar?</h3>
      <p class="text-gray-600 mb-6">Jangan lewatkan kesempatan untuk bergabung dengan SDNU Pemanahan</p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="/daftar" class="inline-flex items-center justify-center gap-x-2 py-3 px-6 text-sm font-semibold rounded-lg border border-transparent bg-gradient-to-r from-nu-green to-nu-dark text-white hover:from-nu-dark hover:to-nu-green focus:outline-none focus:ring-2 focus:ring-nu-green focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl">
          <i class="fas fa-edit"></i>
          Daftar Sekarang
        </a>
        <a href="https://wa.me/6282223008689?text=Assalamu'alaikum, saya ingin bertanya tentang PPDB SDNU Pemanahan" class="inline-flex items-center justify-center gap-x-2 py-3 px-6 text-sm font-semibold rounded-lg border-2 border-nu-green bg-white text-nu-green hover:bg-nu-green hover:text-white focus:outline-none focus:ring-2 focus:ring-nu-green focus:ring-offset-2 transition-all duration-300">
          <i class="fab fa-whatsapp"></i>
          Tanya via WhatsApp
        </a>
      </div>
    </div>
  </div>
  <!-- End CTA Section -->
</div>
<!-- End Features -->

<?= $this->endSection() ?>
