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
        <?= form_input_simple('full_name', 'Nama Lengkap', [
            'placeholder' => 'Nama lengkap',
            'required' => true
        ]) ?>

        <!-- Email -->
        <?= form_input_simple('email', 'Email', [
            'type' => 'email',
            'placeholder' => 'contoh@email.com',
            'required' => true
        ]) ?>

        <!-- Username & Password (side by side) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
          <?= form_input_simple('username', 'Username', [
              'placeholder' => 'username',
              'required' => true
          ]) ?>

          <div class="flex flex-col h-full justify-end">
            <?= form_input_password('password', 'Password', [
          'placeholder' => 'Minimal 8 karakter',
          'required' => true,
          'toggle_id' => 'toggleRegisterPassword',
          'eye_open_id' => 'registerEyeOpen',
          'eye_closed_id' => 'registerEyeClosed'
            ]) ?>
          </div>
        </div>

        <!-- Tombol submit -->
        <button type="submit"
          class="w-full bg-green-600 text-white py-2 rounded-lg font-medium hover:bg-green-700 transition">
          Daftar
        </button>
      </form>

      <!-- Link login -->
      <p class="text-center text-sm text-gray-500 mt-6">
        Sudah punya akun?
        <a href="/login" class="text-green-600 hover:underline">Login</a>
      </p>
    </div>
  </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= password_toggle_script('password', 'toggleRegisterPassword', 'registerEyeOpen', 'registerEyeClosed') ?>
<?= $this->endSection() ?>
