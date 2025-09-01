<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="gradient-bg text-white py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                Tentang <span class="text-nu-gold">SDNU Pemanahan</span>
            </h1>
            <p class="text-xl text-green-100 max-w-3xl mx-auto">
                Lembaga pendidikan Islam terpercaya yang mengintegrasikan nilai-nilai Ahlussunnah wal Jamaah dengan pendidikan modern berkualitas
            </p>
        </div>
    </div>
</section>

<!-- Vision Mission -->
<section class="py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Visi -->
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-nu-green to-nu-dark rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-eye text-white text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-nu-dark mb-4">Visi</h2>
                </div>
                <div class="text-center">
                    <blockquote class="text-xl text-gray-700 italic leading-relaxed">
                        "Mencetak generasi santri yang Aswaja, mandiri, unggul, berwawasan global, dan berkarakter lokal"
                    </blockquote>
                </div>
            </div>
            
            <!-- Misi -->
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-nu-green to-nu-dark rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-target text-white text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-nu-dark mb-6">Misi</h2>
                </div>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <div class="w-6 h-6 bg-nu-green rounded-full flex items-center justify-center mt-1 mr-4 flex-shrink-0">
                            <span class="text-white text-sm font-bold">1</span>
                        </div>
                        <p class="text-gray-700">Menyelenggarakan pendidikan yang mengintegrasikan nilai-nilai Islam Ahlussunnah wal Jamaah</p>
                    </li>
                    <li class="flex items-start">
                        <div class="w-6 h-6 bg-nu-green rounded-full flex items-center justify-center mt-1 mr-4 flex-shrink-0">
                            <span class="text-white text-sm font-bold">2</span>
                        </div>
                        <p class="text-gray-700">Mengembangkan karakter siswa yang mandiri, kreatif, dan bertanggung jawab</p>
                    </li>
                    <li class="flex items-start">
                        <div class="w-6 h-6 bg-nu-green rounded-full flex items-center justify-center mt-1 mr-4 flex-shrink-0">
                            <span class="text-white text-sm font-bold">3</span>
                        </div>
                        <p class="text-gray-700">Memberikan pendidikan berkualitas dengan standar nasional dan internasional</p>
                    </li>
                    <li class="flex items-start">
                        <div class="w-6 h-6 bg-nu-green rounded-full flex items-center justify-center mt-1 mr-4 flex-shrink-0">
                            <span class="text-white text-sm font-bold">4</span>
                        </div>
                        <p class="text-gray-700">Mempersiapkan siswa menghadapi tantangan global dengan tetap melestarikan budaya lokal</p>
                    </li>
                    <li class="flex items-start">
                        <div class="w-6 h-6 bg-nu-green rounded-full flex items-center justify-center mt-1 mr-4 flex-shrink-0">
                            <span class="text-white text-sm font-bold">5</span>
                        </div>
                        <p class="text-gray-700">Menciptakan lingkungan belajar yang kondusif dan menyenangkan</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Sejarah Sekolah -->
<section class="bg-gray-50 py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Sejarah <span class="text-nu-green">Berdirinya</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Perjalanan panjang dalam membangun lembaga pendidikan Islam yang berkualitas di Bantul
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl p-8 lg:p-12 shadow-lg">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center mb-8">
                    <div class="lg:col-span-2">
                        <h3 class="text-2xl font-bold text-nu-dark mb-4">Latar Belakang Pendirian</h3>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            SD Nahdlatul Ulama Pemanahan didirikan atas inisiatif para tokoh masyarakat di Kecamatan Pleret yang memiliki 
                            tanggung jawab moral untuk berpartisipasi menyiapkan sumber daya manusia pada jenjang pendidikan dasar yang mampu 
                            merespon dan mengakses perkembangan global.
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            Sebagai Lembaga Pendidikan Ma'arif Nahdlatul Ulama, sekolah ini berkomitmen untuk memperhatikan realitas 
                            kehidupan modern dan perkembangan global sambil tetap melestarikan nilai-nilai keislaman dan kearifan lokal.
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="w-32 h-32 bg-gradient-to-br from-nu-green to-nu-dark rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-school text-white text-5xl"></i>
                        </div>
                        <p class="text-nu-green font-bold text-lg">Berdiri Sejak 2016</p>
                    </div>
                </div>
                
                <!-- Timeline -->
                <div class="border-t pt-8">
                    <h4 class="text-xl font-bold text-nu-dark mb-6">Timeline Perkembangan</h4>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-4 h-4 bg-nu-green rounded-full mt-2 mr-4 flex-shrink-0"></div>
                            <div>
                                <h5 class="font-bold text-nu-dark">2016 - Pendirian</h5>
                                <p class="text-gray-600">Berdirinya SDNU Pemanahan dengan visi mencetak generasi santri yang unggul</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-4 h-4 bg-nu-green rounded-full mt-2 mr-4 flex-shrink-0"></div>
                            <div>
                                <h5 class="font-bold text-nu-dark">2018 - Akreditasi</h5>
                                <p class="text-gray-600">Mendapat akreditasi B dari Badan Akreditasi Nasional Sekolah/Madrasah</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-4 h-4 bg-nu-green rounded-full mt-2 mr-4 flex-shrink-0"></div>
                            <div>
                                <h5 class="font-bold text-nu-dark">2020 - Program Tahfidz</h5>
                                <p class="text-gray-600">Launching program unggulan Tahfidz Al-Quran dengan target 5 juz</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-4 h-4 bg-nu-green rounded-full mt-2 mr-4 flex-shrink-0"></div>
                            <div>
                                <h5 class="font-bold text-nu-dark">2022 - Digitalisasi</h5>
                                <p class="text-gray-600">Implementasi sistem pembelajaran digital dan laboratorium komputer</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-4 h-4 bg-nu-green rounded-full mt-2 mr-4 flex-shrink-0"></div>
                            <div>
                                <h5 class="font-bold text-nu-dark">2024 - Prestasi Nasional</h5>
                                <p class="text-gray-600">Meraih berbagai prestasi di tingkat nasional dalam Olimpiade Sains</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kepala Sekolah -->
<section class="py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Kepala <span class="text-nu-green">Sekolah</span>
            </h2>
        </div>
        
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg">
                <div class="grid grid-cols-1 lg:grid-cols-3">
                    <!-- Photo -->
                    <div class="lg:col-span-1 bg-gradient-to-br from-nu-green to-nu-dark p-8 flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-48 h-48 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-user-tie text-white text-6xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-white">Maftuh Lutfi Nur Fauzi, S.Pd.I</h3>
                            <p class="text-green-100">Kepala Sekolah</p>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="lg:col-span-2 p-8">
                        <h4 class="text-2xl font-bold text-nu-dark mb-4">Sambutan Kepala Sekolah</h4>
                        <blockquote class="text-gray-700 italic mb-6 text-lg leading-relaxed">
                            "Pendidikan Dasar merupakan fondasi penting untuk membentuk karakter anak. Pola perkembangan Gen Alpha yang tidak bisa lepas dari teknologi dan pola pendidikan pasca pandemi menjadi faktor yang paling diperhatikan dalam memberikan pembelajaran dan pengajaran kepada anak."
                        </blockquote>
                        
                        <div class="space-y-4">
                            <div>
                                <h5 class="font-bold text-nu-dark mb-2">Pendidikan</h5>
                                <ul class="text-gray-600 space-y-1">
                                    <li>• S1 Pendidikan Agama Islam</li>
                                    <li>• Sertifikat Pendidik</li>
                                </ul>
                            </div>
                            
                            <div>
                                <h5 class="font-bold text-nu-dark mb-2">Pengalaman</h5>
                                <ul class="text-gray-600 space-y-1">
                                    <li>• 10+ Tahun di bidang pendidikan</li>
                                    <li>• Kepala Sekolah sejak 2020</li>
                                    <li>• Aktivis Nahdlatul Ulama</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Data Sekolah -->
<section class="bg-nu-cream py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Data <span class="text-nu-green">Sekolah</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Informasi lengkap tentang profil dan statistik SDNU Pemanahan
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- Statistik -->
            <div class="bg-white rounded-2xl p-6 text-center shadow-lg">
                <div class="w-16 h-16 bg-nu-green rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-nu-dark mb-2">500+</h3>
                <p class="text-gray-600">Total Siswa</p>
            </div>
            
            <div class="bg-white rounded-2xl p-6 text-center shadow-lg">
                <div class="w-16 h-16 bg-nu-green rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-nu-dark mb-2">25</h3>
                <p class="text-gray-600">Guru & Staff</p>
            </div>
            
            <div class="bg-white rounded-2xl p-6 text-center shadow-lg">
                <div class="w-16 h-16 bg-nu-green rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-door-open text-white text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-nu-dark mb-2">18</h3>
                <p class="text-gray-600">Ruang Kelas</p>
            </div>
            
            <div class="bg-white rounded-2xl p-6 text-center shadow-lg">
                <div class="w-16 h-16 bg-nu-green rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trophy text-white text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-nu-dark mb-2">50+</h3>
                <p class="text-gray-600">Prestasi</p>
            </div>
        </div>
        
        <!-- Identitas Sekolah -->
        <div class="bg-white rounded-2xl p-8 shadow-lg">
            <h3 class="text-2xl font-bold text-nu-dark mb-6 text-center">Identitas Sekolah</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Nama Sekolah:</span>
                        <span class="text-nu-dark">SD Nahdlatul Ulama Pemanahan</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">NPSN:</span>
                        <span class="text-nu-dark">20401467</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Status:</span>
                        <span class="text-nu-dark">Swasta</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Bentuk Pendidikan:</span>
                        <span class="text-nu-dark">SD</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Status Kepemilikan:</span>
                        <span class="text-nu-dark">Yayasan</span>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">SK Pendirian:</span>
                        <span class="text-nu-dark">421.2/Kep.09/2016</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Tanggal SK:</span>
                        <span class="text-nu-dark">15 Juli 2016</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Akreditasi:</span>
                        <span class="text-nu-dark font-bold text-green-600">B</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Kurikulum:</span>
                        <span class="text-nu-dark">Kurikulum Merdeka</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Waktu Penyelenggaraan:</span>
                        <span class="text-nu-dark">Pagi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Guru dan Staff -->
<section class="py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Guru & <span class="text-nu-green">Tenaga Kependidikan</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Tim pendidik profesional yang berdedikasi untuk memberikan pendidikan terbaik
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Guru 1 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="gradient-bg p-6 text-center">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">Musfiroh, S.Pd</h3>
                    <p class="text-green-100">Guru Kelas</p>
                </div>
                <div class="p-6">
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center"><i class="fas fa-graduation-cap text-nu-green mr-2"></i>S1 Pendidikan</li>
                        <li class="flex items-center"><i class="fas fa-certificate text-nu-green mr-2"></i>Sertifikat Pendidik</li>
                        <li class="flex items-center"><i class="fas fa-calendar text-nu-green mr-2"></i>8+ Tahun Pengalaman</li>
                    </ul>
                </div>
            </div>
            
            <!-- Guru 2 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="gradient-bg p-6 text-center">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">Arif Kusuma Fadholy, S.Th.I</h3>
                    <p class="text-green-100">Guru PAI</p>
                </div>
                <div class="p-6">
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center"><i class="fas fa-graduation-cap text-nu-green mr-2"></i>S1 Ilmu Hadits</li>
                        <li class="flex items-center"><i class="fas fa-certificate text-nu-green mr-2"></i>Sertifikat Pendidik</li>
                        <li class="flex items-center"><i class="fas fa-calendar text-nu-green mr-2"></i>6+ Tahun Pengalaman</li>
                    </ul>
                </div>
            </div>
            
            <!-- Guru 3 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="gradient-bg p-6 text-center">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">Turus Anggoro Febrianto, S.Pd.Jas</h3>
                    <p class="text-green-100">Guru PJOK</p>
                </div>
                <div class="p-6">
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center"><i class="fas fa-graduation-cap text-nu-green mr-2"></i>S1 Pendidikan Jasmani</li>
                        <li class="flex items-center"><i class="fas fa-certificate text-nu-green mr-2"></i>Sertifikat Pendidik</li>
                        <li class="flex items-center"><i class="fas fa-calendar text-nu-green mr-2"></i>5+ Tahun Pengalaman</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="/guru-staff" class="inline-flex items-center text-nu-green font-semibold hover:text-nu-dark transition-colors duration-300">
                Lihat Semua Guru & Staff <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Lokasi -->
<section class="bg-gray-50 py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Lokasi <span class="text-nu-green">Sekolah</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Strategis dan mudah dijangkau dari berbagai arah
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Address Info -->
            <div>
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <h3 class="text-2xl font-bold text-nu-dark mb-6">Alamat Lengkap</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-nu-green mt-1 mr-4"></i>
                            <div>
                                <p class="font-semibold text-nu-dark">Alamat:</p>
                                <p class="text-gray-600">Gg. Dahlia, RT 12 Kerto Kidul, Desa Pleret, Kecamatan Pleret, Kabupaten Bantul, DIY</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone text-nu-green mr-4"></i>
                            <div>
                                <p class="font-semibold text-nu-dark">Telepon:</p>
                                <p class="text-gray-600">+62 822-2300-8689</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-nu-green mr-4"></i>
                            <div>
                                <p class="font-semibold text-nu-dark">Email:</p>
                                <p class="text-gray-600">sdnupemanahan@gmail.com</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-globe text-nu-green mr-4"></i>
                            <div>
                                <p class="font-semibold text-nu-dark">Website:</p>
                                <p class="text-gray-600">https://sdnupemanahan.sch.id/</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Akses Transportasi -->
                    <div class="mt-8 pt-6 border-t">
                        <h4 class="font-bold text-nu-dark mb-4">Akses Transportasi</h4>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-center">
                                <i class="fas fa-bus text-nu-green mr-3"></i>
                                Trans Jogja Halte Prambanan
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-motorcycle text-nu-green mr-3"></i>
                                Ojek Online tersedia
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-car text-nu-green mr-3"></i>
                                Area parkir luas
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Map -->
            <div>
                <div class="bg-white rounded-2xl p-4 shadow-lg">
                    <div class="aspect-w-16 aspect-h-12 bg-gray-200 rounded-xl flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-map text-nu-green text-4xl mb-4"></i>
                            <p class="text-gray-600 mb-4">Peta Lokasi SDNU Pemanahan</p>
                            <button class="bg-nu-green text-white px-6 py-2 rounded-lg hover:bg-nu-dark transition-colors duration-300">
                                <i class="fas fa-directions mr-2"></i>Buka Google Maps
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
