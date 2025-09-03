<?= $this->extend('layouts/blank') ?>

<?= $this->section('content') ?>

  <!-- Bagian Kiri: Konten Login -->
  <div class="w-full md:w-1/2 flex items-center justify-center px-8 bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
      <!-- Judul -->
    <div class="flex justify-center mb-4">
      <img src="/logo_sdnu.png" alt="Logo SDNU" class="h-16 w-auto">
    </div>
    <h1 class="text-2xl font-bold text-center mb-6">Login</h1>

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
      <form action="/login" method="POST" class="space-y-4">
        <?= csrf_field() ?>
        
        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium mb-1">Email</label>
          <input
        id="email"
        name="email"
        type="email"
        placeholder="nama@contoh.com"
        value="<?= old('email') ?>"
        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-800"
        required
          />
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium mb-1">Password</label>
          <input
        id="password"
        name="password"
        type="password"
        placeholder="••••••••"
        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-800"
        required
          />
        </div>

        <!-- Ingat saya & Lupa password -->
        <div class="flex items-center justify-between text-sm">
          <label class="flex items-center space-x-2">
        <input type="checkbox" name="remember" class="rounded border-gray-300 text-green-800 focus:ring-green-800" />
        <span>Ingat saya</span>
          </label>
          <a href="#" class="text-green-800 hover:underline">Lupa password?</a>
        </div>

        <!-- Tombol -->
        <button
          type="submit"
          class="w-full bg-green-800 text-white py-2 rounded-lg font-medium hover:bg-green-900 transition"
        >
          Masuk
        </button>
      </form>

      <!-- Link daftar -->
      <p class="text-center text-sm text-gray-500 mt-6">
        Belum punya akun?
        <a href="/register" class="text-teal-600 hover:underline">Daftar</a>
      </p>
    </div>
  </div>

<?= $this->endSection() ?>
