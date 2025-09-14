<!-- ========== FOOTER ========== -->
<footer class="bg-gradient-to-r from-nu-green to-nu-dark">
  <div class="max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 lg:pt-20 mx-auto">
    <!-- Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
      
      <!-- Logo and Tagline -->
      <div class="col-span-full lg:col-span-1">
        <div class="flex items-center space-x-3 mb-4">
          <div class="w-12 h-12 rounded-full flex items-center justify-center">
            <img src="/logo_sdnuputih.png" alt="SDNU Pemanahan Logo" class="object-contain">
          </div>
          <div>
            <h3 class="text-xl font-bold text-white">SDNU Pemanahan</h3>
          </div>
        </div>
        <p class="mt-3 text-xs sm:text-sm text-green-100">
          "Santri Aswaja, Mandiri, Unggul, Berwawasan Global, Berkarakter Lokal"
        </p>
      </div>

      <!-- PPDB Links -->
      <div class="col-span-1">
        <h4 class="font-semibold text-gray-100 mb-3">PPDB <?= date('Y') ?>/<?= date('Y') + 1 ?></h4>
        <nav class="space-y-3">
          <a href="/daftar" class="flex items-center gap-x-2 text-green-100 hover:text-white focus:text-white transition-colors duration-200 text-sm">
            <i class="fas fa-chevron-right text-xs"></i>
            Daftar Online
          </a>
          <a href="/syarat" class="flex items-center gap-x-2 text-green-100 hover:text-white focus:text-white transition-colors duration-200 text-sm">
            <i class="fas fa-chevron-right text-xs"></i>
            Syarat Pendaftaran
          </a>
          <a href="/biaya" class="flex items-center gap-x-2 text-green-100 hover:text-white focus:text-white transition-colors duration-200 text-sm">
            <i class="fas fa-chevron-right text-xs"></i>
            Biaya Pendidikan
          </a>
          <a href="/ppdb/pengumuman" class="flex items-center gap-x-2 text-green-100 hover:text-white focus:text-white transition-colors duration-200 text-sm">
            <i class="fas fa-chevron-right text-xs"></i>
            Pengumuman
          </a>
        </nav>
      </div>

      <!-- Information Links -->
      <div class="col-span-1">
        <h4 class="font-semibold text-gray-100 mb-3">Informasi</h4>
        <nav class="space-y-3">
          <a href="/about" class="flex items-center gap-x-2 text-green-100 hover:text-white focus:text-white transition-colors duration-200 text-sm">
            <i class="fas fa-chevron-right text-xs"></i>
            Tentang Sekolah
          </a>
          <a href="/fasilitas" class="flex items-center gap-x-2 text-green-100 hover:text-white focus:text-white transition-colors duration-200 text-sm">
            <i class="fas fa-chevron-right text-xs"></i>
            Fasilitas
          </a>
          <a href="/contact" class="flex items-center gap-x-2 text-green-100 hover:text-white focus:text-white transition-colors duration-200 text-sm">
            <i class="fas fa-chevron-right text-xs"></i>
            Kontak
          </a>
        </nav>
      </div>

      <!-- Contact Information -->
      <div class="col-span-2">
        <h4 class="font-semibold text-gray-100 mb-3">Kontak Kami</h4>
        
        <!-- Address -->
        <div class="mb-4">
          <div class="flex items-start space-x-3">
            <i class="fas fa-map-marker-alt text-nu-gold mt-1 flex-shrink-0"></i>
            <address class="not-italic text-green-100 text-sm leading-relaxed">
              Gg. Dahlia, RT 12 Kerto Kidul<br>
              Desa Pleret, Kec. Pleret<br>
              Kabupaten Bantul, DIY
            </address>
          </div>
        </div>
        
        <!-- Phone -->
        <div class="flex items-center space-x-3 mb-3">
          <i class="fas fa-phone text-nu-gold flex-shrink-0"></i>
          <a href="https://wa.me/6282223008689" 
             class="text-green-100 hover:text-white transition-colors duration-300 text-sm"
             target="_blank"
             rel="noopener noreferrer"
             aria-label="Hubungi via WhatsApp">
            +62 822-2300-8689 (WhatsApp)
          </a>
        </div>
        
        <!-- Email -->
        <div class="flex items-center space-x-3 mb-6">
          <i class="fas fa-envelope text-nu-gold flex-shrink-0"></i>
          <a href="mailto:sdnupemanahan@gmail.com" 
             class="text-green-100 hover:text-white transition-colors duration-300 text-sm"
             aria-label="Kirim email">
            sdnupemanahan@gmail.com
          </a>
        </div>

        <!-- Social Media Links -->
        <div>
          <h5 class="font-semibold text-gray-100 mb-3">Ikuti Kami</h5>
          <div class="flex space-x-3">
            <a href="https://web.facebook.com/search/top/?q=Sdnu%20Pemanahan" 
               target="_blank" 
               rel="noopener noreferrer"
               class="inline-flex justify-center items-center w-8 h-8 text-sm font-semibold rounded-lg border border-gray-200 text-green-100 hover:bg-gray-100 hover:text-nu-green focus:outline-none focus:bg-gray-100 focus:text-nu-green transition-all duration-200"
               aria-label="Facebook SDNU Pemanahan">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/sdnupemanahan/" 
               target="_blank" 
               rel="noopener noreferrer"
               class="inline-flex justify-center items-center w-8 h-8 text-sm font-semibold rounded-lg border border-gray-200 text-green-100 hover:bg-gray-100 hover:text-nu-green focus:outline-none focus:bg-gray-100 focus:text-nu-green transition-all duration-200"
               aria-label="Instagram SDNU Pemanahan">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.youtube.com/@SDNUPemanahan" 
               target="_blank" 
               rel="noopener noreferrer"
               class="inline-flex justify-center items-center w-8 h-8 text-sm font-semibold rounded-lg border border-gray-200 text-green-100 hover:bg-gray-100 hover:text-nu-green focus:outline-none focus:bg-gray-100 focus:text-nu-green transition-all duration-200"
               aria-label="YouTube SDNU Pemanahan">
              <i class="fab fa-youtube"></i>
            </a>
            <a href="mailto:sdnupemanahan@gmail.com" 
               class="inline-flex justify-center items-center w-8 h-8 text-sm font-semibold rounded-lg border border-gray-200 text-green-100 hover:bg-gray-100 hover:text-nu-green focus:outline-none focus:bg-gray-100 focus:text-nu-green transition-all duration-200"
               aria-label="Email SDNU Pemanahan">
              <i class="fas fa-envelope"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="mt-8 sm:mt-12 pt-6 border-t border-green-600 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
      <p class="text-sm text-green-100">
        © <?= date('Y') ?> SD Nahdlatul Ulama Pemanahan. All rights reserved.
      </p>
      
      <!-- Footer Links -->
      <nav class="flex flex-wrap items-center space-x-6">
        <a href="/terms" class="text-sm text-green-100 hover:text-white focus:text-white transition-colors duration-200">
          Terms
        </a>
        <a href="/privacy" class="text-sm text-green-100 hover:text-white focus:text-white transition-colors duration-200">
          Privacy
        </a>
        <a href="/sitemap" class="text-sm text-green-100 hover:text-white focus:text-white transition-colors duration-200">
          Sitemap
        </a>
      </nav>
    </div>
  </div>
</footer>
<!-- ========== END FOOTER ========== -->