<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php 
// Helper function to generate fallback image
function generateFallbackImage($title) {
    $cleanTitle = urlencode(substr($title, 0, 30));
    return "https://via.placeholder.com/400x250/48BB78/FFFFFF?text=" . $cleanTitle;
}
?>

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
            <!-- Content Section -->
            <div class="w-full">
              <!-- Icon and Header -->
              <div class="flex items-start gap-4 mb-4">
                <div class="w-10 h-10 bg-nu-green/10 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <i class="fas fa-bullhorn text-nu-green text-sm"></i>
                </div>
                
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
                      
                      <!-- Image Section - Only shown in full content -->
                      <?php if (!empty($announce['image_url'])): ?>
                        <div class="mt-6 image-container" id="image-<?= $index ?>">
                          <div class="relative max-w-lg">
                            <!-- Skeleton loader -->
                            <div class="skeleton-loader w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center" id="skeleton-<?= $index ?>" style="display: flex;">
                              <div class="flex flex-col items-center justify-center text-center">
                                <i class="fas fa-image text-gray-400 text-4xl mb-3"></i>
                                <div class="w-32 h-2 bg-gray-300 rounded mb-2 animate-pulse"></div>
                                <div class="w-24 h-2 bg-gray-300 rounded animate-pulse"></div>
                                <div class="w-20 h-2 bg-gray-300 rounded mt-2 animate-pulse"></div>
                              </div>
                            </div>
                            
                            <img 
                              src="<?= esc($announce['image_url']) ?>" 
                              alt="<?= esc($announce['nama']) ?>"
                              class="w-full h-64 object-cover rounded-lg border border-gray-200 shadow-sm transition-all duration-300 hover:shadow-lg"
                              onload="hideSkeletonLoader(<?= $index ?>)"
                              onerror="showErrorSkeleton(<?= $index ?>)"
                              loading="lazy"
                              id="main-image-<?= $index ?>"
                              style="display: none;"
                            >
                            
                            <!-- Image overlay for better readability -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-lg opacity-0 hover:opacity-100 transition-opacity duration-300" id="overlay-<?= $index ?>" style="display: none;"></div>
                          </div>
                          
                          <p class="text-sm text-gray-500 mt-2 text-center">
                            <i class="fas fa-image mr-1"></i>
                            Gambar pengumuman
                          </p>
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
                    <?php if (strlen($announce['deskripsi']) > 200): ?>
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
      
      // Function to hide skeleton loader when image loads successfully
      function hideSkeletonLoader(index) {
        const skeleton = document.getElementById(`skeleton-${index}`);
        const mainImage = document.getElementById(`main-image-${index}`);
        const overlay = document.getElementById(`overlay-${index}`);
        
        if (skeleton && mainImage) {
          skeleton.style.display = 'none';
          mainImage.style.display = 'block';
          if (overlay) {
            overlay.style.display = 'block';
          }
        }
      }
      
      // Function to show error skeleton when image fails to load
      function showErrorSkeleton(index) {
        const skeleton = document.getElementById(`skeleton-${index}`);
        const mainImage = document.getElementById(`main-image-${index}`);
        
        if (skeleton && mainImage) {
          mainImage.style.display = 'none';
          skeleton.style.display = 'flex';
          skeleton.innerHTML = `
            <div class="flex flex-col items-center justify-center text-center">
              <i class="fas fa-exclamation-triangle text-red-400 text-4xl mb-3"></i>
              <p class="text-red-500 text-sm font-medium mb-1">Gambar tidak dapat dimuat</p>
              <p class="text-gray-400 text-xs mb-2">Skeleton placeholder</p>
              <div class="flex space-x-1 mt-2">
                <div class="w-2 h-2 bg-red-300 rounded-full animate-pulse"></div>
                <div class="w-2 h-2 bg-red-300 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                <div class="w-2 h-2 bg-red-300 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
              </div>
            </div>
          `;
          skeleton.classList.remove('animate-pulse');
          skeleton.classList.add('bg-red-50', 'border', 'border-red-200', 'border-dashed');
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
      
      /* Image container styling */
      .image-container {
        animation: slideDown 0.4s ease-out;
      }
      
      @keyframes slideDown {
        from {
          opacity: 0;
          transform: translateY(-20px);
          max-height: 0;
        }
        to {
          opacity: 1;
          transform: translateY(0);
          max-height: 500px;
        }
      }
      
      /* Skeleton loader styling */
      .skeleton-loader {
        background: linear-gradient(90deg, #f0f0f0 25%, #e8e8e8 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: skeletonLoading 1.5s infinite;
        border: 2px solid #e5e5e5;
        display: flex !important;
        align-items: center;
        justify-content: center;
        min-height: 264px; /* Ensure minimum height */
      }
      
      @keyframes skeletonLoading {
        0% {
          background-position: 200% 0;
        }
        100% {
          background-position: -200% 0;
        }
      }
      
      /* Skeleton content animation */
      .skeleton-loader .fas.fa-image {
        animation: skeletonPulse 2s infinite;
      }
      
      @keyframes skeletonPulse {
        0%, 100% {
          opacity: 0.6;
        }
        50% {
          opacity: 1;
        }
      }
      
      /* Error skeleton styling */
      .skeleton-loader.bg-red-50 {
        background: #fef2f2 !important;
        animation: none;
        display: flex !important;
        align-items: center;
        justify-content: center;
      }
      
      .skeleton-loader.bg-red-50 .fas {
        animation: errorPulse 1s infinite;
      }
      
      @keyframes errorPulse {
        0%, 100% {
          opacity: 0.7;
          transform: scale(1);
        }
        50% {
          opacity: 1;
          transform: scale(1.05);
        }
      }
      
      /* Image hover effects */
      .image-container img {
        transition: all 0.3s ease;
      }
      
      .image-container:hover img {
        filter: brightness(1.05);
        transform: scale(1.02);
      }
      
      /* Responsive adjustments */
      @media (max-width: 1024px) {
        .image-container {
          max-width: 100%;
        }
        
        .image-container img,
        .skeleton-loader {
          height: 250px;
          min-height: 250px;
        }
        
        .skeleton-loader .fas.fa-image {
          font-size: 3rem;
        }
      }
      
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
        
        .image-container img,
        .skeleton-loader {
          height: 200px;
          min-height: 200px;
        }
        
        .skeleton-loader .fas.fa-image {
          font-size: 2.5rem;
        }
        
        .skeleton-loader div div {
          height: 1.5px;
        }
      }
    </style>
  <?php else: ?>
    <!-- Empty State -->
    <div class="max-w-4xl mx-auto">
      <div class="bg-white rounded-2xl p-12 shadow-lg text-center border border-gray-100">
        <!-- Mockup Image for Empty State -->
        <div class="w-32 h-32 mx-auto mb-8 rounded-2xl overflow-hidden shadow-lg">
          <img 
            src="<?= generateFallbackImage('Belum Ada Pengumuman') ?>" 
            alt="Belum Ada Pengumuman"
            class="w-full h-full object-cover"
          >
        </div>
        
        <h3 class="text-3xl font-bold text-nu-dark mb-4">Belum Ada Pengumuman</h3>
        <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
          Pengumuman terbaru mengenai PPDB <?= date('Y') ?>/<?= date('Y') + 1 ?> akan muncul di sini. 
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
