<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section>
  <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
      <!-- Judul -->
      <h1 class="text-2xl font-bold text-center mb-6">Login</h1>

      <!-- Form -->
      <form class="space-y-4">
        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium mb-1">Email</label>
          <input
            id="email"
            type="email"
            placeholder="nama@contoh.com"
            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"
          />
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium mb-1">Password</label>
          <div class="relative">
            <input
              id="password"
              type="password"
              placeholder="••••••••"
              class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 pr-10"
            />
            <button
              type="button"
              onclick="togglePassword()"
              class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 focus:outline-none"
              tabindex="-1"
            >
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 0a9 9 0 0118 0c0 2.5-2.5 7-9 7s-9-4.5-9-7z" />
              </svg>
            </button>
          </div>
        </div>
        <script>
          function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
              passwordInput.type = 'text';
              eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13.875 18.825A10.05 10.05 0 0112 19c-6.5 0-9-4.5-9-7a9 9 0 0115.584-5.917M19.94 19.94l-1.414-1.414M4.06 4.06l1.414 1.414M9.88 9.88a3 3 0 004.24 4.24" />`;
            } else {
              passwordInput.type = 'password';
              eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 0a9 9 0 0118 0c0 2.5-2.5 7-9 7s-9-4.5-9-7z" />`;
            }
          }
        </script>

        <!-- Ingat saya & Lupa password -->
        <div class="flex items-center justify-between text-sm">
          <label class="flex items-center space-x-2">
            <input type="checkbox" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500" />
            <span>Ingat saya</span>
          </label>
          <a href="#" class="text-teal-600 hover:underline">Lupa password?</a>
        </div>

        <!-- Tombol -->
        <button
          type="submit"
          class="w-full bg-teal-600 text-white py-2 rounded-lg font-medium hover:bg-teal-700 transition"
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
</section>

<?= $this->endSection() ?>