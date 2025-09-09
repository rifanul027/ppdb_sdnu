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
          PPDB <?= date('Y') ?>/<?= date('Y') + 1 ?>
        </p>

        <!-- Title -->
        <div class="mt-6 max-w-2xl">
          <h1 class="block font-bold text-nu-dark text-4xl md:text-5xl lg:text-6xl">
            Info <span class="text-nu-green">PPDB <?= date('Y') ?>/<?= date('Y') + 1 ?></span>
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

  <!-- FAQ Section -->
  <div class="mt-16">
    <!-- Title -->
    <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
      <h2 class="text-3xl font-bold md:text-4xl md:leading-tight text-nu-dark">
        Pertanyaan <span class="text-nu-green">Umum</span>
      </h2>
      <p class="mt-4 text-lg text-gray-600">Jawaban untuk pertanyaan yang sering diajukan tentang PPDB SDNU Pemanahan</p>
    </div>
    <!-- End Title -->

    <div class="max-w-4xl mx-auto">
      <div class="divide-y divide-gray-200">
        <!-- FAQ Item -->
        <div class="py-6">
          <details class="group">
            <summary class="flex items-center justify-between cursor-pointer list-none focus-visible:outline-none focus-visible:ring focus-visible:ring-nu-green focus-visible:ring-opacity-50 rounded-lg p-4 hover:bg-nu-green/5 transition-colors duration-200">
              <h3 class="text-lg font-semibold text-nu-dark group-open:text-nu-green transition-colors duration-200">
                Kapan jadwal pendaftaran PPDB SDNU Pemanahan?
              </h3>
              <svg class="ml-4 h-5 w-5 text-nu-green group-open:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </summary>
            <div class="mt-4 px-4">
              <p class="text-gray-600 leading-relaxed">
                Pendaftaran PPDB SDNU Pemanahan dibuka mulai bulan Januari hingga Maret <?= date('Y') + 1 ?>. Pengumuman hasil seleksi akan diumumkan pada bulan April <?= date('Y') + 1 ?>.
              </p>
            </div>
          </details>
        </div>

        <!-- FAQ Item -->
        <div class="py-6">
          <details class="group">
            <summary class="flex items-center justify-between cursor-pointer list-none focus-visible:outline-none focus-visible:ring focus-visible:ring-nu-green focus-visible:ring-opacity-50 rounded-lg p-4 hover:bg-nu-green/5 transition-colors duration-200">
              <h3 class="text-lg font-semibold text-nu-dark group-open:text-nu-green transition-colors duration-200">
                Berapa biaya pendaftaran dan SPP bulanan?
              </h3>
              <svg class="ml-4 h-5 w-5 text-nu-green group-open:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </summary>
            <div class="mt-4 px-4">
              <p class="text-gray-600 leading-relaxed">
                Biaya pendaftaran sebesar Rp 150.000. SPP bulanan untuk siswa baru tahun ajaran <?= date('Y') ?>/<?= date('Y') + 1 ?> sebesar Rp 200.000 per bulan. Tersedia program beasiswa untuk siswa berprestasi dan kurang mampu.
              </p>
            </div>
          </details>
        </div>

        <!-- FAQ Item -->
        <div class="py-6">
          <details class="group">
            <summary class="flex items-center justify-between cursor-pointer list-none focus-visible:outline-none focus-visible:ring focus-visible:ring-nu-green focus-visible:ring-opacity-50 rounded-lg p-4 hover:bg-nu-green/5 transition-colors duration-200">
              <h3 class="text-lg font-semibold text-nu-dark group-open:text-nu-green transition-colors duration-200">
                Apakah ada tes seleksi masuk?
              </h3>
              <svg class="ml-4 h-5 w-5 text-nu-green group-open:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </summary>
            <div class="mt-4 px-4">
              <p class="text-gray-600 leading-relaxed">
                Tidak ada tes seleksi akademik. Seleksi dilakukan berdasarkan kelengkapan berkas, usia sesuai ketentuan, dan ketersediaan kuota. Prioritas diberikan kepada siswa yang mendaftar lebih awal.
              </p>
            </div>
          </details>
        </div>

        <!-- FAQ Item -->
        <div class="py-6">
          <details class="group">
            <summary class="flex items-center justify-between cursor-pointer list-none focus-visible:outline-none focus-visible:ring focus-visible:ring-nu-green focus-visible:ring-opacity-50 rounded-lg p-4 hover:bg-nu-green/5 transition-colors duration-200">
              <h3 class="text-lg font-semibold text-nu-dark group-open:text-nu-green transition-colors duration-200">
                Fasilitas apa saja yang tersedia di SDNU Pemanahan?
              </h3>
              <svg class="ml-4 h-5 w-5 text-nu-green group-open:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </summary>
            <div class="mt-4 px-4">
              <p class="text-gray-600 leading-relaxed">
                SDNU Pemanahan memiliki fasilitas lengkap termasuk ruang kelas ber-AC, perpustakaan, laboratorium komputer, ruang UKS, mushola, kantin sehat, dan area bermain yang aman untuk siswa.
              </p>
            </div>
          </details>
        </div>

        <!-- FAQ Item -->
        <div class="py-6">
          <details class="group">
            <summary class="flex items-center justify-between cursor-pointer list-none focus-visible:outline-none focus-visible:ring focus-visible:ring-nu-green focus-visible:ring-opacity-50 rounded-lg p-4 hover:bg-nu-green/5 transition-colors duration-200">
              <h3 class="text-lg font-semibold text-nu-dark group-open:text-nu-green transition-colors duration-200">
                Bagaimana cara menghubungi sekolah untuk informasi lebih lanjut?
              </h3>
              <svg class="ml-4 h-5 w-5 text-nu-green group-open:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </summary>
            <div class="mt-4 px-4">
              <p class="text-gray-600 leading-relaxed">
                Anda dapat menghubungi kami melalui WhatsApp di nomor 082223008689, datang langsung ke sekolah di Jl. Raya Pemanahan, atau melalui website resmi sekolah. Tim kami siap membantu dari Senin-Jumat pukul 07.00-15.00 WIB.
              </p>
            </div>
          </details>
        </div>
      </div>
    </div>
  </div>
  <!-- End FAQ Section -->

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
