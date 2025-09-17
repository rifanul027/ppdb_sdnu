<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-white to-green-50">
  <div class="absolute inset-0 opacity-20">
    <div class="absolute top-10 left-10 w-20 h-20 bg-green-500/20 rounded-full blur-xl animate-pulse"></div>
    <div class="absolute top-32 right-20 w-32 h-32 bg-blue-500/20 rounded-full blur-2xl animate-pulse delay-300"></div>
    <div class="absolute bottom-20 left-32 w-24 h-24 bg-purple-500/20 rounded-full blur-xl animate-pulse delay-700"></div>
  </div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center">
      <div class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 border border-green-200 mb-6">
        <i class="fas fa-calendar-alt text-green-600 mr-2"></i>
        <span class="text-sm font-semibold text-green-700">PPDB <?= date('Y') ?>/<?= date('Y') + 1 ?></span>
      </div>

      <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
        <span class="text-green-600">Pengumuman</span> PPDB
      </h1>
      
      <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
        Informasi Terbaru Penerimaan Peserta Didik Baru SD Nahdlatul Ulama Pemanahan
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="/daftar" class="inline-flex items-center justify-center px-6 py-3 rounded-lg bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
          <i class="fas fa-edit mr-2"></i>
          Daftar Sekarang
        </a>
        <a href="/ppdb" class="inline-flex items-center justify-center px-6 py-3 rounded-lg border-2 border-green-600 text-green-600 font-semibold hover:bg-green-600 hover:text-white transition-all duration-200">
          <i class="fas fa-info-circle mr-2"></i>
          Info PPDB
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <!-- Tab Navigation -->
  <div class="flex p-1 bg-gray-100 rounded-xl mb-8" role="tablist">
    <button
      class="flex-1 py-3 px-6 rounded-lg text-sm font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 bg-white text-green-600 shadow-sm tab-active"
      id="tab-pengumuman"
      onclick="switchTab('pengumuman')"
      role="tab"
      aria-selected="true"
    >
      <i class="fas fa-bullhorn mr-2"></i>
      Pengumuman
    </button>
    <button
      class="flex-1 py-3 px-6 rounded-lg text-sm font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 text-gray-500 hover:text-gray-700 tab-inactive"
      id="tab-siswa"
      onclick="switchTab('siswa')"
      role="tab"
      aria-selected="false"
    >
      <i class="fas fa-graduation-cap mr-2"></i>
      Daftar Siswa
    </button>
  </div>

  <!-- Tab Content -->
  <div class="mt-8">
    <!-- Pengumuman Tab -->
    <div id="content-pengumuman" class="tab-content">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Pengumuman <span class="text-green-600">Terbaru</span>
        </h2>
        <p class="text-lg text-gray-600">Pantau terus pengumuman penting dari SDNU Pemanahan</p>
      </div>

      <?php if (!empty($pengumuman) && is_array($pengumuman)): ?>
        <div class="space-y-6">
          <?php foreach ($pengumuman as $index => $announce): ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-300 announcement-card" id="card-<?= $index ?>">
              <div class="p-6">
                <div class="flex items-start gap-4">
                  <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-bullhorn text-green-600"></i>
                  </div>
                  
                  <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between mb-3">
                      <h3 class="text-xl font-bold text-gray-900"><?= esc($announce['nama']) ?></h3>
                      <div class="flex items-center text-sm text-gray-500 ml-4">
                        <i class="fas fa-calendar mr-1"></i>
                        <span><?= date('d M Y', strtotime($announce['created_at'])) ?></span>
                      </div>
                    </div>
                    
                    <div class="content-container">
                      <div class="text-gray-600 leading-relaxed content-preview" id="preview-<?= $index ?>">
                        <?php 
                          $description = esc($announce['deskripsi']);
                          $preview = strlen($description) > 200 ? substr($description, 0, 200) . '...' : $description;
                          echo nl2br($preview);
                        ?>
                      </div>
                      
                      <div class="text-gray-600 leading-relaxed content-full hidden" id="full-<?= $index ?>">
                        <?= nl2br(esc($announce['deskripsi'])) ?>
                        
                        <?php if (!empty($announce['image_url'])): ?>
                          <div class="mt-6">
                            <div class="relative max-w-2xl">
                              <img 
                                src="<?= esc($announce['image_url']) ?>" 
                                alt="<?= esc($announce['nama']) ?>"
                                class="w-full h-64 object-cover rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300"
                                loading="lazy"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                              >
                              
                              <!-- Error fallback -->
                              <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center hidden">
                                <div class="text-center text-gray-400">
                                  <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                                  <p class="text-sm">Gambar tidak dapat dimuat</p>
                                </div>
                              </div>
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
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                      <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-clock mr-1"></i>
                        <span><?= date('H:i', strtotime($announce['created_at'])) ?> WIB</span>
                        
                        <?php if (!empty($announce['image_url'])): ?>
                          <span class="mx-2">•</span>
                          <i class="fas fa-image mr-1"></i>
                          <span>Ada Gambar</span>
                        <?php endif; ?>
                      </div>
                      
                      <?php if (strlen($announce['deskripsi']) > 200): ?>
                        <button onclick="toggleExpand(<?= $index ?>)" 
                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-lg border border-green-200 bg-green-50 text-green-700 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200"
                                id="expand-btn-<?= $index ?>">
                          <i class="fas fa-chevron-down mr-1 transition-transform duration-200" id="expand-icon-<?= $index ?>"></i>
                          <span id="expand-text-<?= $index ?>">Selengkapnya</span>
                        </button>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="bg-white rounded-2xl p-12 shadow-sm text-center border border-gray-200">
          <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
            <i class="fas fa-bullhorn text-3xl text-gray-400"></i>
          </div>
          
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Pengumuman</h3>
          <p class="text-gray-600 mb-8 max-w-md mx-auto">
            Pengumuman terbaru mengenai PPDB <?= date('Y') ?>/<?= date('Y') + 1 ?> akan muncul di sini.
          </p>
          
          <a href="/ppdb" class="inline-flex items-center justify-center px-6 py-3 rounded-lg bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
            <i class="fas fa-info-circle mr-2"></i>
            Lihat Info PPDB
          </a>
        </div>
      <?php endif; ?>
    </div>

    <!-- Siswa Tab -->
    <div id="content-siswa" class="tab-content hidden">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Daftar <span class="text-green-600">Siswa</span>
        </h2>
        <p class="text-lg text-gray-600">Siswa yang telah diterima di SDNU Pemanahan</p>
      </div>

      <!-- Filter -->
      <!-- <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
          <div class="flex items-center gap-2">
            <i class="fas fa-filter text-green-600"></i>
            <span class="text-sm font-medium text-gray-700">Filter Tahun Ajaran:</span>
          </div>
          
          <select id="tahun-ajaran-filter" onchange="filterByTahunAjaran()" 
                  class="w-full sm:w-auto min-w-0 sm:min-w-[200px] px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
            <option value="">Semua Tahun Ajaran</option>
            <?php if (!empty($tahun_ajaran_list)): ?>
              <?php foreach ($tahun_ajaran_list as $tahun): ?>
                <option value="<?= esc($tahun['id']) ?>" 
                        <?= ($selected_tahun_ajaran == $tahun['id']) ? 'selected' : '' ?>>
                  <?= esc($tahun['nama']) ?>
                </option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
      </div> -->

      <?php if (!empty($siswa_list) && is_array($siswa_list)): ?>
        <!-- Stats -->
        <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-xl p-6 border border-green-200 mb-8">
          <div class="text-center">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Total Siswa Diterima</h3>
            <div class="text-4xl font-bold text-green-600 mb-2"><?= count($siswa_list) ?></div>
            <?php if ($selected_tahun_ajaran && !empty($tahun_ajaran_list)): ?>
              <?php 
                $selectedTahunAjaranData = null;
                foreach ($tahun_ajaran_list as $ta) {
                  if ($ta['id'] == $selected_tahun_ajaran) {
                    $selectedTahunAjaranData = $ta;
                    break;
                  }
                }
              ?>
              <?php if ($selectedTahunAjaranData): ?>
                <p class="text-gray-600"><?= esc($selectedTahunAjaranData['nama']) ?></p>
                <p class="text-sm text-gray-500"><?= esc($selectedTahunAjaranData['tahun_mulai']) ?>/<?= esc($selectedTahunAjaranData['tahun_selesai']) ?></p>
              <?php endif; ?>
            <?php else: ?>
              <p class="text-gray-600">Semua Tahun Ajaran</p>
            <?php endif; ?>
          </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead>
                <tr class="bg-gradient-to-r from-green-600 to-green-700">
                  <th class="px-6 py-4 text-left text-sm font-semibold text-white">No</th>
                  <th class="px-6 py-4 text-left text-sm font-semibold text-white">Nama</th>
                  <th class="px-6 py-4 text-left text-sm font-semibold text-white">Alamat</th>
                  <?php if (!$selected_tahun_ajaran): ?>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-white">Tahun Ajaran</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($siswa_list as $index => $siswa): ?>
                  <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                      <?= $index + 1 ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                          <i class="fas fa-user text-green-600"></i>
                        </div>
                        <div>
                          <div class="text-sm font-medium text-gray-900"><?= esc($siswa['nama_lengkap']) ?></div>
                          <div class="text-sm text-gray-500">NIS: <?= esc($siswa['nis'] ?? '-') ?></div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      <div class="text-sm text-gray-900"><?= esc($siswa['alamat']) ?></div>
                      <?php if (!empty($siswa['domisili']) && $siswa['domisili'] !== $siswa['alamat']): ?>
                        <div class="text-sm text-gray-500 mt-1">Domisili: <?= esc($siswa['domisili']) ?></div>
                      <?php endif; ?>
                    </td>
                    <?php if (!$selected_tahun_ajaran): ?>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?= esc($siswa['tahun_ajaran_nama'] ?? '-') ?></div>
                      </td>
                    <?php endif; ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php else: ?>
        <div class="bg-white rounded-2xl p-12 shadow-sm text-center border border-gray-200">
          <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
            <i class="fas fa-graduation-cap text-3xl text-gray-400"></i>
          </div>
          
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Siswa</h3>
          <p class="text-gray-600 mb-8 max-w-md mx-auto">
            Daftar siswa yang telah diterima akan muncul di sini setelah proses seleksi selesai.
          </p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Call to Action -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-8 text-center border border-green-200">
    <h3 class="text-2xl font-bold text-gray-900 mb-4">Butuh Informasi Lebih Lanjut?</h3>
    <p class="text-gray-600 mb-6">Hubungi kami untuk mendapatkan informasi terkini seputar PPDB SDNU Pemanahan</p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="/daftar" class="inline-flex items-center justify-center px-6 py-3 rounded-lg bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
        <i class="fas fa-edit mr-2"></i>
        Daftar Sekarang
      </a>
      <a href="https://wa.me/6282223008689?text=Assalamu'alaikum, saya ingin bertanya tentang PPDB SDNU Pemanahan" class="inline-flex items-center justify-center px-6 py-3 rounded-lg border-2 border-green-600 text-green-600 font-semibold hover:bg-green-600 hover:text-white transition-all duration-200">
        <i class="fab fa-whatsapp mr-2"></i>
        Tanya via WhatsApp
      </a>
    </div>
  </div>
</div>

<script>
function switchTab(tabName) {
  // Hide all content
  const contents = document.querySelectorAll('.tab-content');
  contents.forEach(content => content.classList.add('hidden'));
  
  // Reset all tabs
  const tabs = document.querySelectorAll('[id^="tab-"]');
  tabs.forEach(tab => {
    tab.classList.remove('tab-active', 'bg-white', 'text-green-600', 'shadow-sm');
    tab.classList.add('tab-inactive', 'text-gray-500');
    tab.setAttribute('aria-selected', 'false');
  });
  
  // Show active content
  document.getElementById(`content-${tabName}`).classList.remove('hidden');
  
  // Style active tab
  const activeTab = document.getElementById(`tab-${tabName}`);
  activeTab.classList.remove('tab-inactive', 'text-gray-500');
  activeTab.classList.add('tab-active', 'bg-white', 'text-green-600', 'shadow-sm');
  activeTab.setAttribute('aria-selected', 'true');
}

function filterByTahunAjaran() {
  const select = document.getElementById('tahun-ajaran-filter');
  const selectedValue = select.value;
  const currentUrl = new URL(window.location);
  
  if (selectedValue) {
    currentUrl.searchParams.set('tahun_ajaran', selectedValue);
  } else {
    currentUrl.searchParams.delete('tahun_ajaran');
  }
  
  window.location.href = currentUrl.toString();
}

function toggleExpand(index) {
  const preview = document.getElementById(`preview-${index}`);
  const full = document.getElementById(`full-${index}`);
  const icon = document.getElementById(`expand-icon-${index}`);
  const text = document.getElementById(`expand-text-${index}`);
  const card = document.getElementById(`card-${index}`);
  
  if (preview.classList.contains('hidden')) {
    // Collapse
    preview.classList.remove('hidden');
    full.classList.add('hidden');
    icon.classList.remove('rotate-180');
    text.textContent = 'Selengkapnya';
    
    // Smooth scroll to card
    card.scrollIntoView({ behavior: 'smooth', block: 'start' });
  } else {
    // Expand
    preview.classList.add('hidden');
    full.classList.remove('hidden');
    icon.classList.add('rotate-180');
    text.textContent = 'Lebih Sedikit';
  }
}
</script>

<?= $this->endSection() ?>