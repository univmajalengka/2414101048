<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Masuk | Jossmen Laundry</title>
  <link rel="shortcut icon" href="../assets/logo.jpg" type="image/x-icon" />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
    rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html,
    body {
      font-family: "Poppins", system-ui, Arial, sans-serif;
    }
  </style>
</head>

<body class="min-h-screen bg-[#FAF9F6] text-slate-900">
  <div class="min-h-screen flex flex-col">
    <header class="w-full border-b border-gray-200 bg-white/90 backdrop-blur">
      <div
        class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="../index.php" class="flex items-center gap-3">
          <img
            src="../assets/logo.jpg"
            alt="Logo Jossmen Laundry"
            class="rounded-full h-12 w-12 border border-pink-500" />
          <span class="font-semibold text-lg">Jossmen Laundry</span>
        </a>
        <a
          href="../index.php"
          class="hidden sm:inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full border border-pink-500 text-pink-500 hover:bg-pink-50 transition text-sm">
          Kembali ke Beranda
        </a>
      </div>
    </header>

    <main class="flex-1 flex items-center justify-center px-4 py-10">
      <div class="max-w-md w-full">
        <div
          class="bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden">
          <div
            class="bg-gradient-to-r from-pink-500 to-pink-400 text-white px-6 py-6">
            <h1 class="text-2xl font-semibold">Masuk</h1>
            <p class="text-sm text-pink-100">
              Kelola pesanan laundry dengan akun Jossmen Laundry.
            </p>
          </div>
          <form class="px-6 py-8 space-y-6" action="../services/loginService.php" method="POST">
            <div>
              <label
                for="username"
                class="block text-sm font-medium mb-2 text-slate-600">Email</label>
              <input
                type="text"
                id="username"
                name="username"
                placeholder="Masukkan Username"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition"
                required />
            </div>
            <div>
              <div class="flex items-center justify-between mb-2">
                <label
                  for="password"
                  class="block text-sm font-medium text-slate-600">Kata Sandi</label>
              </div>
              <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan Kata sandi"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition"
                required />
            </div>
            <button
              type="submit"
              name="login"
              class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-pink-500 text-white font-medium hover:opacity-90 transition">
              Masuk
            </button>
            <div class="text-center text-xs text-slate-500">
              Belum punya akun?
              <a href="../user/register.php" class="text-pink-500 hover:underline">Daftar sekarang</a>
            </div>
          </form>
        </div>
        <p class="mt-6 text-center text-xs text-slate-400">
          © 2024 Jossmen Laundry. Seluruh hak cipta dilindungi.
        </p>
      </div>
    </main>
  </div>
</body>

</html>