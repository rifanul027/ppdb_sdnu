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
            <span class="text-nu-green">Pengumuman</span> PPDB
          </h1>
        </div>
        <!-- End Title -->

        <div class="mt-6 max-w-3xl">
          <p class="text-lg text-gray-700 leading-relaxed">Informasi Terbaru Penerimaan Peserta Didik Baru SD Nahdlatul Ulama Pemanahan</p>
        </div>

        <!-- Buttons -->
        <div class="mt-8 gap-4 flex flex-col sm:flex-row justify-center">
          <a class="py-3 px-6 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gradient-to-r from-nu-green to-nu-dark text-white hover:from-nu-dark hover:to-nu-green focus:outline-none focus:ring-2 focus:ring-nu-green focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl" href="/daftar">
            <i class="fas fa-edit"></i>
            Daftar Sekarang
          </a>
          <a class="py-3 px-6 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border-2 border-nu-green bg-white text-nu-green hover:bg-nu-green hover:text-white focus:outline-none focus:ring-2 focus:ring-nu-green focus:ring-offset-2 transition-all duration-300" href="/ppdb">
            <i class="fas fa-info-circle"></i>
            Info PPDB
          </a>
        </div>
        <!-- End Buttons -->
      </div>
    </div>
  </div>
</div>
<!-- End Hero -->

<!-- Pengumuman -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto bg-white">
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-3xl font-bold md:text-4xl md:leading-tight text-nu-dark">
      Pengumuman <span class="text-nu-green">Terbaru</span>
    </h2>
    <p class="mt-4 text-lg text-gray-600">Pantau terus pengumuman penting dari SDNU Pemanahan</p>
  </div>
  <!-- End Title -->

  <?php if (!empty($pengumuman) && is_array($pengumuman)): ?>
    <!-- List Layout -->
    <div class="max-w-4xl mx-auto space-y-6">
      <?php foreach ($pengumuman as $index => $announce): ?>
        <!-- Card -->
        <div class="bg-white rounded-xl p-6 shadow-md border border-nu-green/20 hover:shadow-lg transition-all duration-300 announcement-card" id="card-<?= $index ?>">
          <div class="flex items-start gap-4">
            <!-- Icon -->
            <div class="w-10 h-10 bg-nu-green/10 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
              <i class="fas fa-bullhorn text-nu-green text-sm"></i>
            </div>
            
            <!-- Content -->
            <div class="flex-1 min-w-0">
              <!-- Header -->
              <div class="flex items-start justify-between mb-3">
                <h3 class="text-lg font-bold text-nu-dark pr-4"><?= esc($announce['nama']) ?></h3>
                <div class="flex items-center text-xs text-gray-500 flex-shrink-0">
                  <i class="fas fa-calendar mr-1"></i>
                  <span><?= date('d M Y', strtotime($announce['created_at'])) ?></span>
                </div>
              </div>
              
              <!-- Content Preview -->
              <div class="content-container">
                <div class="text-gray-600 leading-relaxed content-preview" id="preview-<?= $index ?>">
                  <?php 
                    $description = esc($announce['deskripsi']);
                    $preview = strlen($description) > 200 ? substr($description, 0, 200) . '...' : $description;
                    echo nl2br($preview);
                  ?>
                </div>
                
                <!-- Full Content (Hidden by default) -->
                <div class="text-gray-600 leading-relaxed content-full hidden" id="full-<?= $index ?>">
                  <?= nl2br(esc($announce['deskripsi'])) ?>
                  
                  <!-- Image shown in expanded state -->
                  <?php if (!empty($announce['image_url'])): ?>
                    <div class="mt-4">
                      <img src="<?= esc($announce['image_url']) ?>" alt="<?= esc($announce['nama']) ?>" class="w-full max-w-md h-auto object-cover rounded-lg border border-gray-200 shadow-sm">
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              
              <!-- Footer -->
              <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
                <div class="flex items-center text-xs text-gray-500">
                  <i class="fas fa-clock mr-1"></i>
                  <span><?= date('H:i', strtotime($announce['created_at'])) ?> WIB</span>
                  
                  <?php if (!empty($announce['image_url'])): ?>
                    <span class="mx-2">•</span>
                    <i class="fas fa-image mr-1"></i>
                    <span>Ada Gambar</span>
                  <?php endif; ?>
                </div>
                
                <!-- Expand/Collapse Button -->
                <?php if (strlen($announce['deskripsi']) > 200 || !empty($announce['image_url'])): ?>
                  <button onclick="toggleExpand(<?= $index ?>)" 
                          class="expand-button inline-flex items-center gap-x-1 py-1.5 px-3 text-xs font-medium rounded-md border border-nu-green/30 bg-nu-green/5 text-nu-green hover:bg-nu-green hover:text-white focus:outline-none focus:ring-2 focus:ring-nu-green/50 transition-all duration-200"
                          id="expand-btn-<?= $index ?>">
                    <i class="fas fa-chevron-down transition-transform duration-200" id="expand-icon-<?= $index ?>"></i>
                    <span id="expand-text-<?= $index ?>">Selengkapnya</span>
                  </button>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <!-- End Card -->
      <?php endforeach; ?>
    </div>
    <!-- End List -->
    
    <!-- JavaScript for Expand Functionality -->
    <script>
      function toggleExpand(index) {
        const preview = document.getElementById(`preview-${index}`);
        const full = document.getElementById(`full-${index}`);
        const btn = document.getElementById(`expand-btn-${index}`);
        const icon = document.getElementById(`expand-icon-${index}`);
        const text = document.getElementById(`expand-text-${index}`);
        const card = document.getElementById(`card-${index}`);
        
        if (preview.classList.contains('hidden')) {
          // Collapse - Show preview, hide full
          preview.classList.remove('hidden');
          full.classList.add('hidden');
          icon.className = 'fas fa-chevron-down transition-transform duration-200';
          text.textContent = 'Selengkapnya';
          
          // Smooth scroll to card top when collapsing
          card.scrollIntoView({ behavior: 'smooth', block: 'start', inline: 'nearest' });
        } else {
          // Expand - Hide preview, show full
          preview.classList.add('hidden');
          full.classList.remove('hidden');
          icon.className = 'fas fa-chevron-up transition-transform duration-200';
          text.textContent = 'Sembunyikan';
        }
      }
    </script>

    <!-- Enhanced CSS for List Layout -->
    <style>
      .announcement-card {
        transition: all 0.3s ease;
      }
      
      .announcement-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      }
      
      .content-container {
        overflow: hidden;
      }
      
      .content-preview, .content-full {
        line-height: 1.6;
        transition: all 0.3s ease;
      }
      
      .content-preview {
        display: block;
      }
      
      .content-full {
        animation: fadeIn 0.3s ease-in-out;
      }
      
      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(10px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      
      .expand-button {
        transition: all 0.2s ease;
      }
      
      .expand-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(72, 187, 120, 0.2);
      }
      
      .expand-button:active {
        transform: translateY(0);
      }
      
      /* Icon rotation animation */
      .expand-button i {
        transition: transform 0.2s ease;
      }
      
      /* Responsive adjustments */
      @media (max-width: 640px) {
        .announcement-card {
          margin: 0 -1rem;
          border-radius: 0.75rem;
        }
        
        .content-preview {
          font-size: 0.9rem;
        }
        
        .expand-button {
          font-size: 0.75rem;
          padding: 0.375rem 0.75rem;
        }
      }
    </style>
  <?php else: ?>
    <!-- Empty State -->
    <div class="max-w-4xl mx-auto">
      <div class="bg-white rounded-2xl p-12 shadow-lg text-center border border-gray-100">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-8">
          <i class="fas fa-bullhorn text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-3xl font-bold text-nu-dark mb-4">Belum Ada Pengumuman</h3>
        <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
          Pengumuman terbaru mengenai PPDB 2025/2026 akan muncul di sini. 
          Pastikan Anda mengecek halaman ini secara berkala untuk mendapatkan informasi terkini.
        </p>
        
        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="/ppdb" class="inline-flex items-center justify-center gap-x-2 py-3 px-6 text-sm font-semibold rounded-lg border border-transparent bg-gradient-to-r from-nu-green to-nu-dark text-white hover:from-nu-dark hover:to-nu-green focus:outline-none focus:ring-2 focus:ring-nu-green focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl">
            <i class="fas fa-info-circle"></i>
            Lihat Info PPDB
          </a>
          <button onclick="location.reload()" class="inline-flex items-center justify-center gap-x-2 py-3 px-6 text-sm font-semibold rounded-lg border-2 border-nu-green bg-white text-nu-green hover:bg-nu-green hover:text-white focus:outline-none focus:ring-2 focus:ring-nu-green focus:ring-offset-2 transition-all duration-300">
            <i class="fas fa-sync-alt"></i>
            Refresh Halaman
          </button>
        </div>
      </div>
    </div>
    <!-- End Empty State -->
  <?php endif; ?>
</div>
<!-- End Pengumuman -->

<!-- CTA Section -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto bg-gray-50">
  <div class="bg-gradient-to-r from-nu-green/5 to-nu-gold/5 rounded-2xl p-8 border border-nu-green/20">
    <div class="text-center">
      <h3 class="text-2xl font-bold text-nu-dark mb-4">Butuh Informasi Lebih Lanjut?</h3>
      <p class="text-gray-600 mb-6">Hubungi kami untuk mendapatkan informasi terkini seputar PPDB SDNU Pemanahan</p>
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
</div>
<!-- End CTA Section -->

<?= $this->endSection() ?>
