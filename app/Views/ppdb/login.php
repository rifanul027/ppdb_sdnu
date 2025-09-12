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
        <?= form_input_simple('email', 'Email', [
            'type' => 'email',
            'placeholder' => 'nama@contoh.com',
            'required' => true
        ]) ?>

        <!-- Password -->
        <?= form_input_password('password', 'Password', [
            'placeholder' => '••••••••',
            'required' => true
        ]) ?>

        <!-- Ingat saya & Lupa password -->
        <div class="flex items-center justify-between text-sm">
          <?= form_checkbox('remember', 'Ingat saya') ?>
          <a href="#" class="text-green-600 hover:underline">Lupa password?</a>
        </div>

        <!-- Tombol -->
        <button
          type="submit"
          class="w-full bg-green-600 text-white py-2 rounded-lg font-medium hover:bg-green-700 transition"
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

<?= $this->section('scripts') ?>
<?= password_toggle_script('password', 'togglePassword', 'passwordEyeOpen', 'passwordEyeClosed') ?>
<?= $this->endSection() ?>
