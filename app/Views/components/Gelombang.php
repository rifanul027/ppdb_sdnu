<?php
/**
 * Component: Gelombang
 * Expects variables:
 * - $currentGelombang (array|null) : current active gelombang
 * - $allGelombang (array) : list of gelombang arrays with keys 'id','nama','tanggal_mulai','tanggal_selesai'
 */
?>

<div class="w-full min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-nu-cream via-white to-nu-cream px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
  <!-- Title Section -->
  <div class="max-w-3xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight text-nu-dark">
      Gelombang <span class="text-nu-green">Pendaftaran</span>
    </h2>
    <p class="mt-3 text-gray-600 text-lg">
      Lihat gelombang pendaftaran yang sedang berjalan dan jadwal gelombang selanjutnya
    </p>
  </div>

  <!-- Grid Wrapper -->
  <div class="flex justify-center w-full">
    <div class="grid gap-8 w-full max-w-6xl items-center">
      <!-- Main Content - Current Wave -->
      <div class="lg:col-span-2 space-y-6">
        <!-- Active Wave Card -->
        <div class="bg-white rounded-2xl p-8 shadow-xl border-2 border-nu-green/20 hover:shadow-2xl transition-all duration-300">
          <div class="flex items-center gap-3 mb-6">
            <div class="p-2 bg-nu-green/10 rounded-lg">
              <svg class="w-6 h-6 text-nu-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-nu-dark">Gelombang Aktif</h3>
          </div>

          <?php if (!empty($currentGelombang)): ?>
            <div class="relative p-6 rounded-xl bg-gradient-to-r from-nu-green/5 to-nu-dark/5 border-2 border-nu-green/20 overflow-hidden">
              <!-- Background Pattern -->
              <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, #22c55e 2px, transparent 2px); background-size: 24px 24px;"></div>
              </div>
              
              <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                  <h4 class="text-2xl font-bold text-nu-dark"><?= esc($currentGelombang['nama']) ?></h4>
                  <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-nu-green text-white shadow-lg">
                    <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                    Aktif Sekarang
                  </span>
                </div>
                
                <div class="grid sm:grid-cols-2 gap-4">
                  <div class="flex items-center space-x-3">
                    <div class="p-2 bg-green-100 rounded-lg">
                      <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                      </svg>
                    </div>
                    <div>
                      <p class="text-sm text-gray-600">Mulai Pendaftaran</p>
                      <p class="font-bold text-nu-dark"><?= date('d M Y', strtotime($currentGelombang['tanggal_mulai'])) ?></p>
                    </div>
                  </div>
                  
                  <div class="flex items-center space-x-3">
                    <div class="p-2 bg-red-100 rounded-lg">
                      <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                      </svg>
                    </div>
                    <div>
                      <p class="text-sm text-gray-600">Batas Akhir</p>
                      <p class="font-bold text-nu-dark"><?= date('d M Y', strtotime($currentGelombang['tanggal_selesai'])) ?></p>
                    </div>
                  </div>
                </div>

                <!-- Countdown or Progress -->
                <?php
                  $now = time();
                  $end = strtotime($currentGelombang['tanggal_selesai']);
                  $start = strtotime($currentGelombang['tanggal_mulai']);
                  $remaining = $end - $now;
                  $total = $end - $start;
                  $progress = max(0, min(100, (($now - $start) / $total) * 100));
                ?>
                
                <div class="mt-6 p-4 bg-white/80 backdrop-blur-sm rounded-lg border border-nu-green/20">
                  <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Progress Gelombang</span>
                    <span class="text-sm font-bold text-nu-dark"><?= number_format($progress, 1) ?>%</span>
                  </div>
                  <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div class="bg-gradient-to-r from-nu-green to-nu-dark h-3 rounded-full transition-all duration-500 ease-out shadow-sm" style="width: <?= $progress ?>%"></div>
                  </div>
                  <?php if ($remaining > 0): ?>
                    <p class="text-xs text-gray-600 mt-2 text-center">
                      Tersisa <?= ceil($remaining / (24 * 60 * 60)) ?> hari lagi
                    </p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php else: ?>
            <div class="p-8 rounded-xl bg-gradient-to-r from-yellow-50 to-orange-50 border-2 border-yellow-200 text-center">
              <div class="w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.19 2.5 1.732 2.5z"/>
                </svg>
              </div>
              <h4 class="text-lg font-semibold text-gray-800 mb-2">Tidak Ada Gelombang Aktif</h4>
              <p class="text-gray-600">Saat ini belum ada gelombang pendaftaran yang sedang berjalan</p>
            </div>
          <?php endif; ?>
        </div>

        <!-- All Waves List -->
        <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-200/50">
          <div class="flex items-center gap-3 mb-6">
            <div class="p-2 bg-nu-dark/10 rounded-lg">
              <svg class="w-6 h-6 text-nu-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
              </svg>
            </div>
            <h4 class="text-xl font-bold text-nu-dark">Semua Gelombang Pendaftaran</h4>
          </div>
          
          <?php if (!empty($allGelombang)): ?>
            <div class="space-y-4">
              <?php foreach ($allGelombang as $index => $g): ?>
                <div class="group relative bg-gradient-to-r from-gray-50 to-white border-2 border-gray-100 rounded-xl p-6 hover:border-nu-green/30 hover:shadow-lg transition-all duration-300">
                  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-start space-x-4">
                      <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-nu-green/20 to-nu-dark/20 rounded-xl flex items-center justify-center">
                        <span class="text-lg font-bold text-nu-dark"><?= $index + 1 ?></span>
                      </div>
                      <div>
                        <h5 class="text-lg font-bold text-nu-dark group-hover:text-nu-green transition-colors duration-300">
                          <?= esc($g['nama']) ?>
                        </h5>
                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-600">
                          <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span><?= date('d M Y', strtotime($g['tanggal_mulai'])) ?></span>
                          </div>
                          <span class="text-gray-400">—</span>
                          <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span><?= date('d M Y', strtotime($g['tanggal_selesai'])) ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="flex-shrink-0">
                      <?php
                        $now = date('Y-m-d');
                        if ($now >= $g['tanggal_mulai'] && $now <= $g['tanggal_selesai']) {
                          echo '<span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-nu-green to-green-600 text-white shadow-lg">
                                  <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                                  Aktif
                                </span>';
                        } else if ($now < $g['tanggal_mulai']) {
                          echo '<span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-nu-gold to-yellow-600 text-white shadow-lg">
                                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                  </svg>
                                  Akan Datang
                                </span>';
                        } else {
                          echo '<span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-gray-400 text-white">
                                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                  </svg>
                                  Selesai
                                </span>';
                        }
                      ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="text-center py-12">
              <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
              </div>
              <p class="text-gray-600 text-lg">Belum ada data gelombang pendaftaran</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
