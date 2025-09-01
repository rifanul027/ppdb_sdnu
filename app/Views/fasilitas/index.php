<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="gradient-bg text-white py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                Fasilitas <span class="text-nu-gold">Sekolah</span>
            </h1>
            <p class="text-xl text-green-100 max-w-3xl mx-auto">
                Fasilitas lengkap dan modern untuk mendukung pembelajaran yang optimal dan menyenangkan
            </p>
        </div>
    </div>
</section>

<!-- Overview Fasilitas -->
<section class="py-16 lg:py-24 relative -mt-12">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Stats -->
            <div class="bg-white rounded-2xl p-6 shadow-lg text-center">
                <div class="w-16 h-16 bg-nu-green rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-door-open text-white text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-nu-dark mb-2">18</h3>
                <p class="text-gray-600">Ruang Kelas</p>
            </div>
            
            <div class="bg-white rounded-2xl p-6 shadow-lg text-center">
                <div class="w-16 h-16 bg-nu-green rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-laptop text-white text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-nu-dark mb-2">2</h3>
                <p class="text-gray-600">Lab Komputer</p>
            </div>
            
            <div class="bg-white rounded-2xl p-6 shadow-lg text-center">
                <div class="w-16 h-16 bg-nu-green rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-book text-white text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-nu-dark mb-2">1</h3>
                <p class="text-gray-600">Perpustakaan</p>
            </div>
            
            <div class="bg-white rounded-2xl p-6 shadow-lg text-center">
                <div class="w-16 h-16 bg-nu-green rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-mosque text-white text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-nu-dark mb-2">1</h3>
                <p class="text-gray-600">Mushola</p>
            </div>
        </div>
    </div>
</section>

<!-- Fasilitas Akademik -->
<section class="bg-gray-50 py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Fasilitas <span class="text-nu-green">Akademik</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Fasilitas penunjang kegiatan belajar mengajar yang modern dan lengkap
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Ruang Kelas -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 card-hover">
                <div class="h-48 bg-gradient-to-br from-nu-green to-nu-dark flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-nu-dark mb-3">Ruang Kelas Ber-AC</h3>
                    <p class="text-gray-600 mb-4">
                        18 ruang kelas dengan fasilitas AC, proyektor, dan papan tulis interaktif untuk pembelajaran yang nyaman.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-1">
                        <li>• Kapasitas 25-30 siswa per kelas</li>
                        <li>• Dilengkapi AC dan ventilasi baik</li>
                        <li>• Proyektor LCD untuk multimedia</li>
                        <li>• Papan tulis whiteboard</li>
                    </ul>
                </div>
            </div>
            
            <!-- Lab Komputer -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 card-hover">
                <div class="h-48 bg-gradient-to-br from-nu-green to-nu-dark flex items-center justify-center">
                    <i class="fas fa-desktop text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-nu-dark mb-3">Laboratorium Komputer</h3>
                    <p class="text-gray-600 mb-4">
                        2 lab komputer dengan 30 unit PC untuk pembelajaran teknologi informasi dan coding dasar.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-1">
                        <li>• 30 unit komputer modern</li>
                        <li>• Koneksi internet stabil</li>
                        <li>• Software pembelajaran interaktif</li>
                        <li>• AC dan penerangan optimal</li>
                    </ul>
                </div>
            </div>
            
            <!-- Perpustakaan -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 card-hover">
                <div class="h-48 bg-gradient-to-br from-nu-green to-nu-dark flex items-center justify-center">
                    <i class="fas fa-books text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-nu-dark mb-3">Perpustakaan</h3>
                    <p class="text-gray-600 mb-4">
                        Perpustakaan dengan koleksi buku lengkap, area baca yang nyaman, dan sistem digital.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-1">
                        <li>• 5000+ koleksi buku</li>
                        <li>• Buku digital dan e-library</li>
                        <li>• Area baca yang nyaman</li>
                        <li>• Sistem katalog digital</li>
                    </ul>
                </div>
            </div>
            
            <!-- Lab Sains -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 card-hover">
                <div class="h-48 bg-gradient-to-br from-nu-green to-nu-dark flex items-center justify-center">
                    <i class="fas fa-flask text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-nu-dark mb-3">Laboratorium Sains</h3>
                    <p class="text-gray-600 mb-4">
                        Lab sains dengan peralatan lengkap untuk eksperimen dan praktek pembelajaran IPA.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-1">
                        <li>• Alat peraga IPA lengkap</li>
                        <li>• Mikroskop dan alat ukur</li>
                        <li>• Kit eksperimen sederhana</li>
                        <li>• Safety equipment</li>
                    </ul>
                </div>
            </div>
            
            <!-- Ruang Multimedia -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 card-hover">
                <div class="h-48 bg-gradient-to-br from-nu-green to-nu-dark flex items-center justify-center">
                    <i class="fas fa-video text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-nu-dark mb-3">Ruang Multimedia</h3>
                    <p class="text-gray-600 mb-4">
                        Ruang khusus untuk presentasi, seminar, dan pembelajaran menggunakan teknologi multimedia.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-1">
                        <li>• Proyektor HD dan layar besar</li>
                        <li>• Sound system berkualitas</li>
                        <li>• Kapasitas 100 orang</li>
                        <li>• Lighting dan AC optimal</li>
                    </ul>
                </div>
            </div>
            
            <!-- Kelas Tahfidz -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 card-hover">
                <div class="h-48 bg-gradient-to-br from-nu-green to-nu-dark flex items-center justify-center">
                    <i class="fas fa-quran text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-nu-dark mb-3">Ruang Tahfidz</h3>
                    <p class="text-gray-600 mb-4">
                        Ruang khusus untuk program tahfidz dengan suasana tenang dan kondusif untuk menghafal Al-Quran.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-1">
                        <li>• Kedap suara dan nyaman</li>
                        <li>• Karpet dan bantal duduk</li>
                        <li>• Mushaf Al-Quran lengkap</li>
                        <li>• Audio sistem murotal</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fasilitas Pendukung -->
<section class="py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Fasilitas <span class="text-nu-green">Pendukung</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Fasilitas penunjang untuk kenyamanan dan keamanan seluruh warga sekolah
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Mushola -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 card-hover">
                <div class="h-48 bg-gradient-to-br from-nu-green to-nu-dark flex items-center justify-center">
                    <i class="fas fa-mosque text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-nu-dark mb-3">Mushola</h3>
                    <p class="text-gray-600 mb-4">
                        Mushola yang luas dan nyaman untuk sholat berjamaah dan kegiatan keagamaan.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-1">
                        <li>• Kapasitas 200 jamaah</li>
                        <li>• Karpet berkualitas tinggi</li>
                        <li>• Sound system untuk adzan</li>
                        <li>• Tempat wudhu bersih</li>
                    </ul>
                </div>
            </div>
            
            <!-- Kantin -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 card-hover">
                <div class="h-48 bg-gradient-to-br from-nu-green to-nu-dark flex items-center justify-center">
                    <i class="fas fa-utensils text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-nu-dark mb-3">Kantin Sehat</h3>
                    <p class="text-gray-600 mb-4">
                        Kantin dengan menu makanan sehat, bergizi, dan halal untuk siswa dan guru.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-1">
                        <li>• Menu makanan bergizi</li>
                        <li>• Sertifikat halal dan sehat</li>
                        <li>• Harga terjangkau</li>
                        <li>• Area makan yang bersih</li>
                    </ul>
                </div>
            </div>
            
            <!-- UKS -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 card-hover">
                <div class="h-48 bg-gradient-to-br from-nu-green to-nu-dark flex items-center justify-center">
                    <i class="fas fa-heartbeat text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-nu-dark mb-3">Unit Kesehatan Sekolah</h3>
                    <p class="text-gray-600 mb-4">
                        UKS dengan fasilitas lengkap untuk pertolongan pertama dan pemeriksaan kesehatan rutin.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-1">
                        <li>• Tempat tidur dan peralatan medis</li>
                        <li>• Obat-obatan dasar</li>
                        <li>• Timbangan dan alat ukur</li>
                        <li>• Tenaga kesehatan terlatih</li>
                    </ul>
                </div>
            </div>
            
            <!-- Lapangan -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 card-hover">
                <div class="h-48 bg-gradient-to-br from-nu-green to-nu-dark flex items-center justify-center">
                    <i class="fas fa-running text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-nu-dark mb-3">Lapangan Olahraga</h3>
                    <p class="text-gray-600 mb-4">
                        Lapangan multifungsi untuk berbagai kegiatan olahraga dan upacara sekolah.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-1">
                        <li>• Lapangan basket/futsal</li>
                        <li>• Area upacara bendera</li>
                        <li>• Tribun untuk penonton</li>
                        <li>• Peralatan olahraga lengkap</li>
                    </ul>
                </div>
            </div>
            
            <!-- Parkir -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 card-hover">
                <div class="h-48 bg-gradient-to-br from-nu-green to-nu-dark flex items-center justify-center">
                    <i class="fas fa-car text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-nu-dark mb-3">Area Parkir</h3>
                    <p class="text-gray-600 mb-4">
                        Area parkir yang luas dan aman untuk kendaraan guru, staff, dan orang tua siswa.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-1">
                        <li>• Kapasitas 50+ kendaraan</li>
                        <li>• Sistem keamanan CCTV</li>
                        <li>• Petugas parkir</li>
                        <li>• Akses mudah dan aman</li>
                    </ul>
                </div>
            </div>
            
            <!-- Taman -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 card-hover">
                <div class="h-48 bg-gradient-to-br from-nu-green to-nu-dark flex items-center justify-center">
                    <i class="fas fa-seedling text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-nu-dark mb-3">Taman Sekolah</h3>
                    <p class="text-gray-600 mb-4">
                        Taman hijau yang asri untuk pembelajaran alam dan tempat refreshing siswa.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-1">
                        <li>• Berbagai tanaman hias</li>
                        <li>• Gazebo untuk diskusi</li>
                        <li>• Tempat duduk outdoor</li>
                        <li>• Area pembelajaran alam</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fasilitas Keamanan -->
<section class="bg-gray-50 py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Sistem <span class="text-nu-green">Keamanan</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Sistem keamanan terpadu untuk menjamin keselamatan dan kenyamanan seluruh warga sekolah
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- CCTV -->
            <div class="bg-white rounded-2xl p-6 shadow-lg text-center">
                <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-video text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-nu-dark mb-3">CCTV 24 Jam</h3>
                <p class="text-gray-600 text-sm">
                    Sistem CCTV yang memantau seluruh area sekolah 24 jam untuk keamanan maksimal.
                </p>
            </div>
            
            <!-- Security -->
            <div class="bg-white rounded-2xl p-6 shadow-lg text-center">
                <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-nu-dark mb-3">Security</h3>
                <p class="text-gray-600 text-sm">
                    Petugas keamanan yang berjaga 24 jam dan terlatih dalam menghadapi situasi darurat.
                </p>
            </div>
            
            <!-- Access Control -->
            <div class="bg-white rounded-2xl p-6 shadow-lg text-center">
                <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-key text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-nu-dark mb-3">Kontrol Akses</h3>
                <p class="text-gray-600 text-sm">
                    Sistem kontrol akses dengan kartu ID untuk membatasi akses ke area tertentu.
                </p>
            </div>
            
            <!-- Emergency -->
            <div class="bg-white rounded-2xl p-6 shadow-lg text-center">
                <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-nu-dark mb-3">Sistem Darurat</h3>
                <p class="text-gray-600 text-sm">
                    Sistem alarm darurat dan evacuation plan yang terintegrasi dengan pihak berwenang.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Virtual Tour CTA -->
<section class="gradient-bg text-white py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8 text-center">
        <h2 class="text-4xl lg:text-5xl font-bold mb-6">
            Ingin Melihat <span class="text-nu-gold">Fasilitas Langsung?</span>
        </h2>
        <p class="text-xl text-green-100 mb-8 max-w-3xl mx-auto">
            Kami mengundang Anda untuk berkunjung langsung dan melihat fasilitas sekolah kami secara real
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            <a href="/contact" class="bg-nu-gold text-nu-dark px-8 py-4 rounded-full font-bold hover:bg-yellow-400 transition-all duration-300 transform hover:scale-105 shadow-lg">
                <i class="fas fa-calendar-alt mr-2"></i>Jadwalkan Kunjungan
            </a>
            <a href="https://wa.me/6282223008689?text=Assalamu'alaikum, saya ingin berkunjung ke sekolah untuk melihat fasilitas" 
               target="_blank"
               class="bg-white bg-opacity-20 text-white px-8 py-4 rounded-full font-bold hover:bg-opacity-30 transition-all duration-300 backdrop-blur-sm border border-white border-opacity-30">
                <i class="fab fa-whatsapp mr-2"></i>Chat WhatsApp
            </a>
        </div>
        
        <!-- Jam Kunjungan -->
        <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-8 max-w-2xl mx-auto border border-white border-opacity-20">
            <h3 class="text-2xl font-bold text-white mb-4">Jam Kunjungan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-green-100">
                <div>
                    <p class="font-semibold">Senin - Jumat</p>
                    <p>08:00 - 15:00 WIB</p>
                </div>
                <div>
                    <p class="font-semibold">Sabtu</p>
                    <p>08:00 - 12:00 WIB</p>
                </div>
            </div>
            <p class="text-sm text-green-200 mt-4">
                <i class="fas fa-info-circle mr-2"></i>
                Mohon konfirmasi terlebih dahulu untuk memastikan jadwal yang tepat
            </p>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
