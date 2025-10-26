<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: ../user/login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Produk | Jossmen Laundry</title>
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
  <div class="min-h-screen flex">
    <aside class="hidden md:flex w-64 flex-col bg-white border-r border-gray-200">
      <div class="px-6 py-6 border-b border-gray-200">
        <div class="flex items-center gap-3">
          <img
            src="../assets/logo.jpg"
            alt="Logo Jossmen Laundry"
            class="h-12 w-12 rounded-full border border-pink-500" />
          <div>
            <div class="font-semibold">Jossmen Laundry</div>
            <div class="text-xs text-slate-500">Panel Admin</div>
          </div>
        </div>
      </div>
      <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
        <a
          href="./index.php"
          class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 hover:bg-pink-50">
          <span>Daftar Produk</span>
        </a>
        <a
          href="./pembelian.php"
          class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 hover:bg-pink-50">
          <span>Daftar Pembelian</span>
        </a>
        <a
          href="./laundry.php"
          class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 hover:bg-pink-50">
          <span>Daftar Laundry</span>
        </a>
      </nav>
      <div class="px-4 py-6 border-t border-gray-200 text-sm">
        <a
          href="../user/logout.php"
          class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl border border-pink-500 text-pink-500 hover:bg-pink-50">
          Keluar
        </a>
      </div>
    </aside>

    <div class="flex-1 flex flex-col">
      <header class="w-full border-b border-gray-200 bg-white/80 backdrop-blur">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
          <div>
            <h1 class="text-2xl font-semibold">Tambah Produk</h1>
            <p class="text-sm text-slate-500">
              Masukkan detail produk dan simpan ke daftar layanan.
            </p>
          </div>
          <div class="hidden md:flex items-center gap-3">
            <div class="flex items-center gap-3 bg-white border border-gray-200 rounded-full px-3 py-1.5">
              <div class="h-8 w-8 rounded-full bg-pink-500/20 flex items-center justify-center text-pink-500 font-semibold">
                A
              </div>
              <div class="text-xs">
                <div class="font-medium">Admin</div>
                <div class="text-slate-500">admin@jossmen.com</div>
              </div>
            </div>
          </div>
        </div>
      </header>

      <main class="flex-1">
        <div class="max-w-5xl mx-auto px-4 py-10">
          <section class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 md:p-8">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
              <div>
                <h2 class="text-lg font-semibold">Form Produk</h2>
                <p class="text-sm text-slate-500">
                  Lengkapi informasi produk sebelum menyimpannya.
                </p>
              </div>
              <a
                href="./index.php"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-gray-200 text-sm hover:border-pink-500">
                Kembali ke Daftar
              </a>
            </div>

            <form
              action="../services/tambahProdukService.php"
              method="POST"
              enctype="multipart/form-data"
              class="mt-6 grid gap-4 md:grid-cols-2">
              <div class="space-y-2">
                <label class="text-sm font-medium text-slate-600" for="title">Judul Produk</label>
                <input
                  id="title"
                  name="title"
                  type="text"
                  placeholder="Contoh: Cuci Setrika Reguler"
                  required
                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition" />
              </div>
              <div class="space-y-2">
                <label class="text-sm font-medium text-slate-600" for="harga">Harga</label>
                <input
                  id="harga"
                  name="harga"
                  type="number"
                  min="0"
                  step="0.01"
                  placeholder="7000"
                  required
                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition" />
              </div>
              <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-600" for="subtitle">Deskripsi Singkat</label>
                <textarea
                  id="subtitle"
                  name="subtitle"
                  rows="3"
                  placeholder="Tuliskan keunggulan utama layanan."
                  required
                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition"></textarea>
              </div>
              <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-600" for="image">Gambar Produk</label>
                <input
                  id="image"
                  name="image"
                  type="file"
                  accept="image/*"
                  required
                  class="block w-full text-sm text-slate-500 file:mr-4 file:px-4 file:py-2 file:rounded-xl file:border-0 file:bg-pink-500 file:text-white hover:file:opacity-90" />
                <p class="text-xs text-slate-400">
                  Unggah gambar JPG, PNG, atau WEBP ukuran maks 2 MB.
                </p>
              </div>
              <div class="md:col-span-2 flex flex-wrap gap-3 pt-2">
                <button
                  type="submit"
                  name="submit"
                  class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-pink-500 text-white text-sm font-medium hover:opacity-90">
                  Simpan Produk
                </button>
                <button
                  type="reset"
                  class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-gray-200 text-sm hover:border-pink-500">
                  Reset Form
                </button>
              </div>
            </form>
          </section>
        </div>
      </main>
    </div>
  </div>
</body>

</html>
