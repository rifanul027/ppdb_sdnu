<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="gradient-bg text-white py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                Hubungi <span class="text-nu-gold">Kami</span>
            </h1>
            <p class="text-xl text-green-100 max-w-3xl mx-auto">
                Kami siap membantu menjawab pertanyaan Anda seputar PPDB dan informasi sekolah
            </p>
        </div>
    </div>
</section>

<!-- Contact Options -->
<section class="py-16 lg:py-24 relative -mt-12">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- WhatsApp -->
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 card-hover text-center">
                <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fab fa-whatsapp text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-nu-dark mb-2">WhatsApp</h3>
                <p class="text-gray-600 mb-4">Chat langsung dengan admin</p>
                <a href="https://wa.me/6282223008689?text=Assalamu'alaikum, saya ingin bertanya tentang PPDB SDNU Pemanahan" 
                   target="_blank"
                   class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition-all duration-300 inline-block">
                    <i class="fab fa-whatsapp mr-2"></i>Chat Sekarang
                </a>
            </div>
            
            <!-- Telepon -->
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 card-hover text-center">
                <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-phone text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-nu-dark mb-2">Telepon</h3>
                <p class="text-gray-600 mb-4">Hubungi langsung sekolah</p>
                <a href="tel:+6282223008689" 
                   class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition-all duration-300 inline-block">
                    <i class="fas fa-phone mr-2"></i>Telepon
                </a>
            </div>
            
            <!-- Email -->
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 card-hover text-center">
                <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-envelope text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-nu-dark mb-2">Email</h3>
                <p class="text-gray-600 mb-4">Kirim pesan detail</p>
                <a href="mailto:sdnupemanahan@gmail.com" 
                   class="bg-red-500 text-white px-6 py-2 rounded-full hover:bg-red-600 transition-all duration-300 inline-block">
                    <i class="fas fa-envelope mr-2"></i>Kirim Email
                </a>
            </div>
            
            <!-- Kunjungi -->
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 card-hover text-center">
                <div class="w-16 h-16 bg-nu-green rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-nu-dark mb-2">Kunjungi</h3>
                <p class="text-gray-600 mb-4">Datang langsung ke sekolah</p>
                <a href="#lokasi" 
                   class="bg-nu-green text-white px-6 py-2 rounded-full hover:bg-nu-dark transition-all duration-300 inline-block">
                    <i class="fas fa-directions mr-2"></i>Lihat Lokasi
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form & Info -->
<section class="bg-gray-50 py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <h2 class="text-3xl font-bold text-nu-dark mb-6">Kirim Pesan</h2>
                <p class="text-gray-600 mb-8">
                    Silakan isi form di bawah ini untuk mengirim pesan kepada kami. Kami akan merespons dalam 1x24 jam.
                </p>
                
                <form class="space-y-6" action="/contact/send" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" id="nama" name="nama" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">No. WhatsApp *</label>
                            <input type="tel" id="phone" name="phone" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
                        </div>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
                    </div>
                    
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori Pertanyaan *</label>
                        <select id="kategori" name="kategori" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300">
                            <option value="">Pilih Kategori</option>
                            <option value="ppdb">PPDB (Penerimaan Peserta Didik Baru)</option>
                            <option value="akademik">Akademik & Kurikulum</option>
                            <option value="fasilitas">Fasilitas Sekolah</option>
                            <option value="biaya">Biaya Pendidikan</option>
                            <option value="program">Program Unggulan</option>
                            <option value="umum">Pertanyaan Umum</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="pesan" class="block text-sm font-medium text-gray-700 mb-2">Pesan *</label>
                        <textarea id="pesan" name="pesan" rows="5" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nu-green focus:border-transparent transition-all duration-300"
                                  placeholder="Tulis pertanyaan atau pesan Anda di sini..."></textarea>
                    </div>
                    
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-nu-green to-nu-dark text-white py-3 px-6 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
                    </button>
                </form>
                
                <div class="mt-6 p-4 bg-nu-cream rounded-lg">
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-info-circle text-nu-green mr-2"></i>
                        Untuk respon lebih cepat, Anda dapat menghubungi kami melalui WhatsApp di nomor 
                        <a href="https://wa.me/6282223008689" class="text-nu-green font-semibold">+62 822-2300-8689</a>
                    </p>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="space-y-8">
                <!-- Office Hours -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <h3 class="text-2xl font-bold text-nu-dark mb-6">Jam Operasional</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="font-medium text-gray-700">Senin - Jumat</span>
                            <span class="text-nu-green font-semibold">07:00 - 15:00 WIB</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="font-medium text-gray-700">Sabtu</span>
                            <span class="text-nu-green font-semibold">07:00 - 12:00 WIB</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-700">Minggu</span>
                            <span class="text-red-500 font-semibold">Tutup</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                        <p class="text-sm text-blue-800">
                            <i class="fas fa-clock text-blue-600 mr-2"></i>
                            Untuk kunjungan, disarankan membuat janji terlebih dahulu melalui WhatsApp atau telepon.
                        </p>
                    </div>
                </div>
                
                <!-- Contact Details -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <h3 class="text-2xl font-bold text-nu-dark mb-6">Informasi Kontak</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-nu-green rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-nu-dark">Alamat</h4>
                                <p class="text-gray-600">Gg. Dahlia, RT 12 Kerto Kidul</p>
                                <p class="text-gray-600">Desa Pleret, Kec. Pleret</p>
                                <p class="text-gray-600">Kabupaten Bantul, DIY</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-nu-green rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-nu-dark">Telepon</h4>
                                <p class="text-gray-600">+62 822-2300-8689</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-nu-green rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-nu-dark">Email</h4>
                                <p class="text-gray-600">sdnupemanahan@gmail.com</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-nu-green rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-globe text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-nu-dark">Website</h4>
                                <p class="text-gray-600">https://sdnupemanahan.sch.id/</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <h3 class="text-2xl font-bold text-nu-dark mb-6">Media Sosial</h3>
                    <div class="flex space-x-4">
                        <a href="https://web.facebook.com/search/top/?q=Sdnu%20Pemanahan" target="_blank"
                           class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-all duration-300">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                        <a href="https://www.instagram.com/sdnupemanahan/" target="_blank"
                           class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center hover:bg-pink-600 transition-all duration-300">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                        <a href="https://www.youtube.com/@SDNUPemanahan" target="_blank"
                           class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition-all duration-300">
                            <i class="fab fa-youtube text-white"></i>
                        </a>
                        <a href="mailto:sdnupemanahan@gmail.com"
                           class="w-12 h-12 bg-gray-600 rounded-full flex items-center justify-center hover:bg-gray-700 transition-all duration-300">
                            <i class="fas fa-envelope text-white"></i>
                        </a>
                    </div>
                    <p class="text-sm text-gray-600 mt-4">
                        Ikuti media sosial kami untuk mendapatkan update terbaru seputar kegiatan sekolah dan informasi PPDB.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Location Map -->
<section id="lokasi" class="py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Lokasi <span class="text-nu-green">Sekolah</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                SDNU Pemanahan terletak di lokasi strategis yang mudah dijangkau dari berbagai arah
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Map -->
            <div class="order-2 lg:order-1">
                <div class="bg-white rounded-2xl p-4 shadow-lg">
                    <div class="aspect-w-16 aspect-h-12 bg-gray-200 rounded-xl flex items-center justify-center min-h-96">
                        <div class="text-center">
                            <i class="fas fa-map text-nu-green text-6xl mb-4"></i>
                            <h3 class="text-xl font-bold text-nu-dark mb-2">Peta Lokasi</h3>
                            <p class="text-gray-600 mb-6">SDNU Pemanahan, Pleret, Bantul</p>
                            <div class="space-y-3">
                                <a href="https://maps.google.com/?q=SD+Nahdlatul+Ulama+Pemanahan" target="_blank"
                                   class="bg-nu-green text-white px-6 py-3 rounded-lg hover:bg-nu-dark transition-all duration-300 inline-block">
                                    <i class="fas fa-external-link-alt mr-2"></i>Buka di Google Maps
                                </a>
                                <br>
                                <a href="https://waze.com/ul?q=SD+Nahdlatul+Ulama+Pemanahan" target="_blank"
                                   class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition-all duration-300 inline-block">
                                    <i class="fas fa-route mr-2"></i>Buka di Waze
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Location Info -->
            <div class="order-1 lg:order-2">
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <h3 class="text-2xl font-bold text-nu-dark mb-6">Petunjuk Arah</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-bold text-nu-green mb-3">Dari Yogyakarta:</h4>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-route text-nu-green mt-1 mr-3"></i>
                                    Ambil Jl. Solo ke arah Prambanan
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-route text-nu-green mt-1 mr-3"></i>
                                    Belok kiri setelah Candi Prambanan
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-route text-nu-green mt-1 mr-3"></i>
                                    Ikuti jalan menuju Pleret sekitar 5 km
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h4 class="font-bold text-nu-green mb-3">Dari Bantul:</h4>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-route text-nu-green mt-1 mr-3"></i>
                                    Ambil Jl. Bantul-Imogiri
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-route text-nu-green mt-1 mr-3"></i>
                                    Belok kanan ke Jl. Pleret
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-route text-nu-green mt-1 mr-3"></i>
                                    Lurus hingga Gg. Dahlia
                                </li>
                            </ul>
                        </div>
                        
                        <div class="bg-nu-cream p-4 rounded-lg">
                            <h4 class="font-bold text-nu-dark mb-2">Patokan:</h4>
                            <p class="text-gray-600 text-sm">
                                Dekat dengan Kantor Kecamatan Pleret dan Puskesmas Pleret. 
                                Cari Gang Dahlia di Kerto Kidul.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Transportation -->
                <div class="bg-white rounded-2xl p-8 shadow-lg mt-8">
                    <h3 class="text-2xl font-bold text-nu-dark mb-6">Transportasi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-bus text-blue-600"></i>
                            </div>
                            <h4 class="font-semibold text-nu-dark">Trans Jogja</h4>
                            <p class="text-sm text-gray-600">Halte Prambanan</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-motorcycle text-green-600"></i>
                            </div>
                            <h4 class="font-semibold text-nu-dark">Ojek Online</h4>
                            <p class="text-sm text-gray-600">Tersedia</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-car text-purple-600"></i>
                            </div>
                            <h4 class="font-semibold text-nu-dark">Parkir</h4>
                            <p class="text-sm text-gray-600">Area Luas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="bg-gray-50 py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-nu-dark mb-6">
                Pertanyaan <span class="text-nu-green">Sering Diajukan</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Temukan jawaban atas pertanyaan yang sering diajukan seputar SDNU Pemanahan
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto">
            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="w-full px-6 py-4 text-left font-semibold text-nu-dark hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors duration-200 flex justify-between items-center"
                            onclick="toggleFAQ(1)">
                        <span>Kapan pendaftaran PPDB dibuka?</span>
                        <i class="fas fa-chevron-down transform transition-transform duration-200" id="icon-1"></i>
                    </button>
                    <div id="content-1" class="px-6 py-4 border-t bg-gray-50 hidden">
                        <p class="text-gray-600">
                            Pendaftaran PPDB SDNU Pemanahan untuk tahun ajaran 2025/2026 dibuka dalam 3 gelombang:
                            Gelombang 1 (1 Januari - 31 Maret 2025), Gelombang 2 (1 April - 30 Juni 2025), 
                            dan Gelombang 3 (1 Juli - 31 Juli 2025).
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="w-full px-6 py-4 text-left font-semibold text-nu-dark hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors duration-200 flex justify-between items-center"
                            onclick="toggleFAQ(2)">
                        <span>Berapa biaya pendidikan di SDNU Pemanahan?</span>
                        <i class="fas fa-chevron-down transform transition-transform duration-200" id="icon-2"></i>
                    </button>
                    <div id="content-2" class="px-6 py-4 border-t bg-gray-50 hidden">
                        <p class="text-gray-600">
                            Biaya pendaftaran bervariasi per gelombang (Rp 250.000 - Rp 350.000). 
                            SPP bulanan Rp 400.000 dengan berbagai program unggulan termasuk tahfidz, 
                            program trilingual, dan fasilitas lengkap. Tersedia diskon early bird untuk gelombang 1.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="w-full px-6 py-4 text-left font-semibold text-nu-dark hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors duration-200 flex justify-between items-center"
                            onclick="toggleFAQ(3)">
                        <span>Apa saja program unggulan SDNU Pemanahan?</span>
                        <i class="fas fa-chevron-down transform transition-transform duration-200" id="icon-3"></i>
                    </button>
                    <div id="content-3" class="px-6 py-4 border-t bg-gray-50 hidden">
                        <p class="text-gray-600">
                            Program unggulan meliputi: Program Tahfidz Al-Quran (target 5 juz), 
                            Program Trilingual (Arab, Inggris, Indonesia), Program STEAM 
                            (Science, Technology, Engineering, Arts, Math), dan Program Pembentukan Karakter Islami.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="w-full px-6 py-4 text-left font-semibold text-nu-dark hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors duration-200 flex justify-between items-center"
                            onclick="toggleFAQ(4)">
                        <span>Bagaimana proses seleksi masuk?</span>
                        <i class="fas fa-chevron-down transform transition-transform duration-200" id="icon-4"></i>
                    </button>
                    <div id="content-4" class="px-6 py-4 border-t bg-gray-50 hidden">
                        <p class="text-gray-600">
                            Proses seleksi meliputi tes kemampuan dasar (membaca, menulis, berhitung), 
                            wawancara dengan calon siswa dan orang tua, serta observasi psikologis sederhana. 
                            Tidak ada tes yang memberatkan, fokus pada kesiapan anak masuk SD.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 5 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="w-full px-6 py-4 text-left font-semibold text-nu-dark hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors duration-200 flex justify-between items-center"
                            onclick="toggleFAQ(5)">
                        <span>Apakah tersedia beasiswa?</span>
                        <i class="fas fa-chevron-down transform transition-transform duration-200" id="icon-5"></i>
                    </button>
                    <div id="content-5" class="px-6 py-4 border-t bg-gray-50 hidden">
                        <p class="text-gray-600">
                            Ya, tersedia beasiswa prestasi dan beasiswa untuk keluarga kurang mampu. 
                            Beasiswa prestasi diberikan berdasarkan hasil tes masuk dan wawancara. 
                            Untuk informasi lebih detail, silakan hubungi bagian administrasi sekolah.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function toggleFAQ(index) {
    const content = document.getElementById(`content-${index}`);
    const icon = document.getElementById(`icon-${index}`);
    
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.classList.add('rotate-180');
    } else {
        content.classList.add('hidden');
        icon.classList.remove('rotate-180');
    }
}
</script>

<?= $this->endSection() ?>
