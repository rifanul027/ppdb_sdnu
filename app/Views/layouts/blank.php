<?php
// Simple blank layout for PPDB views
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'PPDB SDNU') ?></title>
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex">

  <?= $this->renderSection('content') ?>

  <!-- Bagian Kanan: Gambar & Pengantar -->
  <div class="hidden md:flex w-1/2 bg-teal-600 items-center justify-center relative">
    <img src="/hero.jpg" alt="Hero Illustration" class="object-cover h-full w-full opacity-70">
    <div class="absolute inset-0 flex flex-col items-start justify-center px-8" style="top: 60%;">
      <h2 class="text-white text-5xl font-bold mb-4 drop-shadow-lg text-left">Selamat Datang di Portal PPDB SDNU Pemanahan</h2>
      <p class="text-white text-lg text-left drop-shadow-lg">Silakan login untuk melanjutkan proses pendaftaran dan mengakses informasi terbaru.</p>
    </div>
  </div>

  <!-- Scripts Section -->
  <?= $this->renderSection('scripts') ?>

</body>
</html>
