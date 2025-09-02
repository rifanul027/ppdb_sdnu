<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex">

  <!-- Bagian Kiri: Konten Login -->
  <div class="w-full md:w-1/2 flex items-center justify-center px-8 bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
      <!-- Judul -->
    <div class="flex justify-center mb-4">
      <img src="/logo_sdnu.png" alt="Logo SDNU" class="h-16 w-auto">
    </div>
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
        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-800"
          />
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium mb-1">Password</label>
          <input
        id="password"
        type="password"
        placeholder="••••••••"
        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-800"
          />
        </div>

        <!-- Ingat saya & Lupa password -->
        <div class="flex items-center justify-between text-sm">
          <label class="flex items-center space-x-2">
        <input type="checkbox" class="rounded border-gray-300 text-green-800 focus:ring-green-800" />
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

<!-- Bagian Kanan: Gambar & Pengantar -->
<div class="hidden md:flex w-1/2 bg-teal-600 items-center justify-center relative">
  <img src="/hero.jpg" alt="Login Illustration" class="object-cover h-full w-full opacity-70">
  <div class="absolute inset-0 flex flex-col items-start justify-center px-8" style="top: 60%;">
    <h2 class="text-white text-5xl font-bold mb-4 drop-shadow-lg text-left">Selamat Datang di Portal PPDB SDNU Pemanahan</h2>
    <p class="text-white text-lg text-left drop-shadow-lg">Silakan login untuk melanjutkan proses pendaftaran dan mengakses informasi terbaru.</p>
  </div>
</div>

</body>
</html>
