<footer class="gradient-bg text-white mt-16">
    <!-- Main Footer Content -->
    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- School Info -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center">
                        <img src="/logo_sdnuputih.png" alt="SDNU Pemanahan Logo" class="object-contain">
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">SDNU Pemanahan</h3>
                        <p class="text-green-100 text-sm">Excellence in Islamic Education</p>
                    </div>
                </div>
                <p class="text-green-100 text-sm leading-relaxed">
                    "Santri Aswaja, Mandiri, Unggul, Berwawasan Global, Berkarakter Lokal"
                </p>
                <div class="flex space-x-3">
                    <a href="https://web.facebook.com/search/top/?q=Sdnu%20Pemanahan" target="_blank" 
                       class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition-all duration-300">
                        <i class="fab fa-facebook-f text-white"></i>
                    </a>
                    <a href="https://www.instagram.com/sdnupemanahan/" target="_blank" 
                       class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition-all duration-300">
                        <i class="fab fa-instagram text-white"></i>
                    </a>
                    <a href="https://www.youtube.com/@SDNUPemanahan" target="_blank" 
                       class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition-all duration-300">
                        <i class="fab fa-youtube text-white"></i>
                    </a>
                    <a href="mailto:sdnupemanahan@gmail.com" 
                       class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition-all duration-300">
                        <i class="fas fa-envelope text-white"></i>
                    </a>
                </div>
            </div>

            <!-- PPDB Info -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">PPDB 2025/2026</h4>
                <ul class="space-y-2">
                    <li><a href="/daftar" class="text-green-100 hover:text-white transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Daftar Online</a></li>
                    <li><a href="/syarat" class="text-green-100 hover:text-white transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Syarat Pendaftaran</a></li>
                    <li><a href="/biaya" class="text-green-100 hover:text-white transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Biaya Pendidikan</a></li>
                    <li><a href="/pengumuman" class="text-green-100 hover:text-white transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Pengumuman</a></li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Kontak Kami</h4>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-map-marker-alt text-nu-gold mt-1 flex-shrink-0"></i>
                        <div>
                            <p class="text-green-100 text-sm">Gg. Dahlia, RT 12 Kerto Kidul</p>
                            <p class="text-green-100 text-sm">Desa Pleret, Kec. Pleret</p>
                            <p class="text-green-100 text-sm">Kabupaten Bantul, DIY</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-phone text-nu-gold flex-shrink-0"></i>
                        <a href="https://wa.me/6282223008689" class="text-green-100 hover:text-white transition-colors duration-300 text-sm">
                            +62 822-2300-8689 (WhatsApp)
                        </a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-nu-gold flex-shrink-0"></i>
                        <a href="mailto:sdnupemanahan@gmail.com" class="text-green-100 hover:text-white transition-colors duration-300 text-sm">
                            sdnupemanahan@gmail.com
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bottom Footer -->
    <div class="border-t border-white border-opacity-20">
        <div class="container mx-auto px-4 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-center md:text-left">
                    <p class="text-green-100 text-sm">
                        &copy; <?= date('Y') ?> SD Nahdlatul Ulama Pemanahan. All rights reserved.
                    </p>
                    <p class="text-green-200 text-xs mt-1">
                        Supported by <span class="text-nu-gold">Teknologi Informasi SDNU Pemanahan</span>
                    </p>
                </div>
                <div class="flex items-center space-x-6 text-green-100 text-sm">
                    <a href="/privacy" class="hover:text-white transition-colors duration-300">Privacy Policy</a>
                    <a href="/terms" class="hover:text-white transition-colors duration-300">Terms of Service</a>
                    <a href="/sitemap" class="hover:text-white transition-colors duration-300">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>
