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

<?= $this->endSection() ?>
