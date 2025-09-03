<?= $this->extend('layouts/blank') ?>

<?= $this->section('content') ?>

  <!-- Bagian Kiri: Konten Registrasi -->
  <div class="w-full md:w-1/2 flex items-center justify-center px-8 bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
      <!-- Judul -->
      <div class="flex justify-center mb-4">
        <img src="/logo_sdnu.png" alt="Logo SDNU" class="h-16 w-auto">
      </div>
      <h1 class="text-2xl font-bold text-center mb-6">Registrasi</h1>

      <!-- Alert Messages -->
      <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('errors')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
              <li><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <!-- Form -->
      <form action="/register" method="POST" class="space-y-4">
        <?= csrf_field() ?>
        
        <!-- Nama lengkap -->
        <div>
          <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
          <input type="text" name="full_name"
            value="<?= old('full_name') ?>"
            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-800"
            placeholder="Nama lengkap"
            required>
        </div>

        <!-- Tempat & Tanggal Lahir (side by side) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium mb-1">Tempat Lahir</label>
            <input type="text" name="birth_place"
              value="<?= old('birth_place') ?>"
              class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-800"
              placeholder="Kabupaten/Kota"
              required>
          </div>
          
          <div>
            <label class="block text-sm font-medium mb-1">Tanggal Lahir</label>
            <input type="date" name="dob"
              value="<?= old('dob') ?>"
              class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-800"
              required>
          </div>
        </div>

        <!-- Email -->
        <div>
          <label class="block text-sm font-medium mb-1">Email</label>
          <input type="email" name="email"
            value="<?= old('email') ?>"
            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-800"
            placeholder="contoh@email.com"
            required>
        </div>

        <!-- Username & Password (side by side) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium mb-1">Username</label>
            <input type="text" name="username"
              value="<?= old('username') ?>"
              class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-800"
              placeholder="username"
              required>
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password"
              class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-800"
              placeholder="Minimal 8 karakter"
              required>
          </div>
        </div>

        <!-- Tombol submit -->
        <button type="submit"
          class="w-full bg-green-800 text-white py-2 rounded-lg font-medium hover:bg-green-900 transition">
          Daftar
        </button>
      </form>

      <!-- Link login -->
      <p class="text-center text-sm text-gray-500 mt-6">
        Sudah punya akun?
        <a href="/login" class="text-teal-600 hover:underline">Login</a>
      </p>
    </div>
  </div>

<?= $this->endSection() ?>
