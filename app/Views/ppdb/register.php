<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Registrasi</title>
  <!-- Tailwind CDN untuk cepat prototipe -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-md">
    <div class="bg-white p-6 rounded-2xl shadow">
      <h1 class="text-2xl font-semibold mb-6 text-center">Registrasi</h1>

      <form action="#" method="post" class="space-y-4">
        <!-- Nama lengkap -->
        <div>
          <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
          <input type="text" name="full_name"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            placeholder="Nama lengkap">
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Tempat Lahir</label>
            <input type="text" name="full_name"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            placeholder="Kabupaten/Kota">
        </div>

        <!-- Tanggal lahir -->
        <div>
          <label class="block text-sm font-medium mb-1">Tanggal Lahir</label>
          <input type="date" name="dob"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
        </div>

        <!-- Email -->
        <div>
          <label class="block text-sm font-medium mb-1">Email</label>
          <input type="email" name="email"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            placeholder="contoh@email.com">
        </div>

        <!-- Username -->
        <div>
          <label class="block text-sm font-medium mb-1">Username</label>
          <input type="text" name="username"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            placeholder="username">
        </div>

        <!-- Password -->
        <div>
          <label class="block text-sm font-medium mb-1">Password</label>
          <input type="password" name="password"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            placeholder="Minimal 8 karakter">
        </div>

        <!-- Tombol submit -->
        <div class="pt-2">
          <button type="submit"
            class="w-full bg-green-700 text-white py-2 rounded-lg hover:bg-green-800 transition">
            Daftar
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
