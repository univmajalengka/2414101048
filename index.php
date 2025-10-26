<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Jossmen Laundry</title>
  <link rel="shortcut icon" href="assets/logo.jpg" type="image/x-icon" />
  <!-- font -->
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
    rel="stylesheet" />
  <!-- tailwind cdn -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html,
    body {
      font-family: "Poppins", system-ui, Arial, sans-serif;
    }
  </style>
</head>

<body class="min-h-screen bg-[#FAF9F6] text-slate-900">
  <!-- navbar -->
  <div
    id="nav"
    class="w-full sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-gray-200">
    <div
      class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
      <div class="flex items-center gap-2">
        <img
          src="assets/logo.jpg"
          alt=""
          class="rounded-full h-12 w-12 border border-pink-500" />
        <div class="font-semibold">Jossmen Laundry</div>
      </div>
      <div class="hidden md:flex items-center gap-6 text-sm">
        <a href="#home" class="hover:opacity-80">Beranda</a>
        <a href="#products" class="hover:opacity-80">Produk</a>
        <a href="#pricelist" class="hover:opacity-80">Pricelist</a>
        <a href="#testimonials" class="hover:opacity-80">Testimoni</a>
        <a href="#lokasi" class="hover:opacity-80">Lokasi</a>
        <a
          href="user/login.php"
          class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-pink-500 text-white hover:opacity-90 transition text-sm">Login</a>
      </div>
      <button
        id="menuBtn"
        aria-label="toggle menu"
        class="md:hidden p-2 rounded-lg border border-gray-200">
        <div class="w-5 h-0.5 bg-slate-900 mb-1"></div>
        <div class="w-5 h-0.5 bg-slate-900 mb-1"></div>
        <div class="w-5 h-0.5 bg-slate-900"></div>
      </button>
    </div>
    <div id="mobileMenu" class="hidden md:hidden border-t border-gray-200">
      <div class="max-w-6xl mx-auto px-4 py-3 flex flex-col gap-3 text-sm">
        <a href="#home" class="py-1">Beranda</a>
        <a href="#products" class="py-1">Produk</a>
        <a href="#pricelist" class="py-1">Pricelist</a>
        <a href="#testimonials" class="py-1">Testimoni</a>
        <a href="#lokasi" class="py-1">Lokasi</a>
        <a
          href="user/login.php"
          class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-pink-500 text-white hover:opacity-90 transition text-sm w-full">Login</a>
      </div>
    </div>
  </div>

  <!-- jumbotron -->
  <div id="home" class="bg-[#FAF9F6]">
    <div
      class="max-w-6xl mx-auto px-4 py-10 md:py-16 grid md:grid-cols-2 gap-8 items-center">
      <div class="flex flex-col gap-4">
        <div
          class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-pink-50 text-pink-600 w-fit">
          Promo: Gratis antar min. 5 kg
        </div>
        <div class="text-3xl md:text-5xl font-semibold leading-tight">
          Laundry rapi, wangi, siap pakai.
        </div>
        <div class="text-slate-500">
          Antar jemput area sekitar. Proses cepat, hasil maksimal.
        </div>
        <div class="flex flex-wrap gap-3 pt-1">
          <a
            href="#pricelist"
            class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-pink-500 text-white hover:opacity-90 transition">Cek Pricelist</a>
          <a
            href="https://wa.me/6282219672424"
            class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full border border-pink-500 text-pink-500 bg-white hover:bg-pink-50 transition">Chat WhatsApp</a>
        </div>
        <div class="mt-4 max-w-md rounded-2xl border border-pink-100 bg-white shadow-sm p-4">
          <div class="text-sm text-slate-500">Ingin laundry dari rumah?</div>
          <div class="mt-2 flex flex-wrap items-center gap-3">
            <span class="text-sm text-slate-600">Klik tombol berikut untuk memilih layanan dan mulai pesan.</span>
            <a
              href="laundry.php"
              class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-full bg-pink-500 text-white text-sm hover:opacity-90 transition">
              Mulai Laundry
            </a>
          </div>
        </div>
        <div class="grid grid-cols-3 gap-3 pt-4 text-center">
          <div
            class="bg-white border border-gray-200 rounded-xl shadow-lg p-3">
            <div class="text-xl font-semibold">5 jam</div>
            <div class="text-xs text-slate-500">Express*</div>
          </div>
          <div
            class="bg-white border border-gray-200 rounded-xl shadow-lg p-3">
            <div class="text-xl font-semibold">Antar</div>
            <div class="text-xs text-slate-500">Radius terbatas</div>
          </div>
          <div
            class="bg-white border border-gray-200 rounded-xl shadow-lg p-3">
            <div class="text-xl font-semibold">Aman</div>
            <div class="text-xs text-slate-500">Kain sensitif</div>
          </div>
        </div>
      </div>
      <div
        class="bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">
        <img
          src="assets/nisa.jpeg"
          alt="Ilustrasi laundry"
          class="w-full h-72 md:h-[420px] object-cover" />
      </div>
    </div>
  </div>

  <!-- produk -->
  <div id="products" class="max-w-6xl mx-auto px-4 py-10">
    <div class="text-2xl md:text-3xl font-semibold mb-2">Produk Kami</div>
    <div class="text-slate-500 mb-6">Pilih kebutuhan laundry harianmu.</div>
    <?php
    include './config/connection.php';

    $sql = "SELECT * FROM produk ORDER BY created_at DESC";
    $result = $conn->query($sql);
    ?>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <?php
          $imageFile = $row['image_path'] ?? '';
          $publicPath = 'assets/images/' . $imageFile;
          $fullPath = __DIR__ . '/assets/images/' . $imageFile;
          if (empty($imageFile) || ! file_exists($fullPath)) {
            $publicPath = 'assets/jumbotron.jpg';
          }
          ?>
          <div class="bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">
            <img
              src="<?= htmlspecialchars($publicPath, ENT_QUOTES, 'UTF-8') ?>"
              class="w-full h-40 object-cover"
              alt="<?= htmlspecialchars($row['title'] ?? 'Produk laundry', ENT_QUOTES, 'UTF-8') ?>" />
            <div class="p-4">
              <div class="font-semibold"><?= $row['title'] ?></div>
              <div class="text-sm text-slate-500"><?= $row['subtitle'] ?></div>
              <div class="mt-3 flex items-center justify-between">
                <div class="text-sm font-medium">
                  <?= $row['harga'] ?? 'Rp0' ?>
                </div>
                <div class="flex gap-2">
                  <a
                    href="beli.php?id=<?= urlencode((string) ($row['id'] ?? '')) ?>"
                    class="px-3 py-1.5 text-sm rounded-full bg-pink-500 text-white hover:opacity-90 transition">
                    Beli
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="col-span-4 text-center text-gray-500">Belum ada produk.</p>
      <?php endif; ?>
    </div>

    <?php $conn->close(); ?>
  </div>

  <!-- harga -->
  <div id="pricelist" class="max-w-6xl mx-auto px-4 py-10">
    <div class="text-2xl md:text-3xl font-semibold mb-2">Pricelist</div>
    <div class="text-slate-500 mb-6">
      Harga dapat berubah sesuai kondisi & ukuran.
    </div>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-pink-50 border border-pink-200 rounded-2xl px-4 py-4">
      <div class="text-sm text-pink-700">
        Sudah menemukan layanan yang cocok? Klik tombol di samping untuk memesan penjemputan laundry sekarang juga.
      </div>
      <a
        href="laundry.php"
        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-pink-500 text-white text-sm font-medium hover:opacity-90 transition">
        Pesan Laundry
      </a>
    </div>

    <div class="flex flex-wrap gap-2 mb-6">
      <button
        data-tab="tab-kiloan"
        class="tab-btn inline-flex items-center px-3 py-1 rounded-full text-sm bg-pink-50 text-pink-600">
        Kiloan
      </button>
      <button
        data-tab="tab-pakaian"
        class="tab-btn inline-flex items-center px-3 py-1 rounded-full text-sm bg-pink-50 text-pink-600">
        Satuan - Pakaian
      </button>
      <button
        data-tab="tab-rumah"
        class="tab-btn inline-flex items-center px-3 py-1 rounded-full text-sm bg-pink-50 text-pink-600">
        Satuan - Rumah Tangga
      </button>
    </div>

    <div
      id="tab-kiloan"
      class="tab-panel grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-4">
        <div class="font-medium">Cuci Kering Setrika Reguler</div>
        <div class="text-xs text-slate-500">2 hari</div>
        <div class="mt-2 text-pink-600 font-semibold">7.000 / kg</div>
      </div>
      <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-4">
        <div class="font-medium">Cuci Kering Setrika Express</div>
        <div class="text-xs text-slate-500">1 hari</div>
        <div class="mt-2 text-pink-600 font-semibold">10.000 / kg</div>
      </div>
      <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-4">
        <div class="font-medium">Cuci Kering Setrika Super</div>
        <div class="text-xs text-slate-500">5 jam</div>
        <div class="mt-2 text-pink-600 font-semibold">13.000 / kg</div>
      </div>
    </div>

    <div
      id="tab-pakaian"
      class="tab-panel hidden grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-4">
        <div class="font-medium">Dress/Baju/Gamis</div>
        <div class="mt-2 text-pink-600 font-semibold">17.500 / pcs</div>
      </div>
      <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-4">
        <div class="font-medium">Kemeja/Batik</div>
        <div class="mt-2 text-pink-600 font-semibold">15.000 / pcs</div>
      </div>
      <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-4">
        <div class="font-medium">Jas</div>
        <div class="mt-2 text-pink-600 font-semibold">20.000 / pcs</div>
      </div>
    </div>

    <div
      id="tab-rumah"
      class="tab-panel hidden grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-4">
        <div class="font-medium">Bantal</div>
        <div class="mt-2 text-pink-600 font-semibold">15.000 / pcs</div>
      </div>
      <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-4">
        <div class="font-medium">Guling</div>
        <div class="mt-2 text-pink-600 font-semibold">15.000 / pcs</div>
      </div>
      <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-4">
        <div class="font-medium">Gorden</div>
        <div class="mt-2 text-pink-600 font-semibold">25.000 / m</div>
      </div>
    </div>
  </div>

  <!-- testi -->
  <div id="testimonials" class="max-w-6xl mx-auto px-4 py-10">
    <div class="text-2xl md:text-3xl font-semibold mb-6">
      Rating & Testimoni
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-5">
        <div class="font-semibold">Kevin</div>
        <div class="mt-1 flex items-center gap-1">
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
        </div>
        <div class="mt-2 text-slate-500 text-sm">
          Bajunya rapi, wangi soft. Pas untuk daily office.
        </div>
      </div>

      <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-5">
        <div class="font-semibold">Puki</div>
        <div class="mt-1 flex items-center gap-1">
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 opacity-30">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
        </div>
        <div class="mt-2 text-slate-500 text-sm">
          Express 5 jam aman! Mantap untuk urgent.
        </div>
      </div>

      <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-5">
        <div class="font-semibold">Lopy</div>
        <div class="mt-1 flex items-center gap-1">
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
          <svg
            viewBox="0 0 20 20"
            fill="currentColor"
            class="w-4 h-4 text-yellow-400">
            <path
              d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.564-.954L10 0l2.946 5.956 6.564.954-4.755 4.635 1.123 6.545z" />
          </svg>
        </div>
        <div class="mt-2 text-slate-500 text-sm">
          Karpet rumah jadi kinclong. Recommended!
        </div>
      </div>
    </div>
  </div>

  <!-- lokasi -->
  <div id="lokasi" class="max-w-6xl mx-auto px-4 py-10">
    <div class="text-2xl md:text-3xl font-semibold mb-4">Lokasi Kami</div>
    <div class="grid lg:grid-cols-2 gap-6 items-stretch">
      <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-5">
        <div class="font-medium">Alamat</div>
        <div class="text-sm text-slate-500">
          Jl. Kh. Abdul Halim No.188, Majalengka Kulon, Kec. Majalengka,
          Kabupaten Majalengka, Jawa Barat 45418
        </div>
        <div class="mt-4 text-sm">Buka: 06.00 – 19.00 (Senin–Minggu)</div>
        <a
          href="https://wa.me/6282219672424"
          class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-pink-500 text-white hover:opacity-90 transition mt-4 w-fit">Chat WhatsApp</a>
      </div>
      <div
        class="bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">
        <iframe
          title="Google Maps"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.7339168341512!2d108.2235760772241!3d-6.83437538633612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f2f0bbd686fc3%3A0xf20bfcda2373e8ed!2sJossmen%20Laundry%20Majalengka!5e0!3m2!1sen!2sid!4v1758184629464!5m2!1sen!2sid"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="w-full h-72 md:h-full">
        </iframe>
      </div>
    </div>
  </div>

  <!-- footer -->
  <div id="footer" class="bg-white border-t border-gray-200">
    <div class="max-w-6xl mx-auto px-4 py-10 grid md:grid-cols-3 gap-8">
      <div>
        <div class="font-semibold mb-2">Jossmen Laundry</div>
        <div class="text-sm text-slate-500">Bersih cepat, harga hemat.</div>
      </div>
      <div>
        <div class="font-semibold mb-2">Kontak</div>
        <div class="text-sm">WhatsApp: 6282219672424</div>
        <div class="text-sm">Instagram: @Jossmen Laundry</div>
      </div>
      <div>
        <div class="font-semibold mb-2">Menu</div>
        <div class="text-sm">
          <a href="#products" class="hover:opacity-80">Produk</a>
        </div>
        <div class="text-sm">
          <a href="#pricelist" class="hover:opacity-80">Pricelist</a>
        </div>
        <div class="text-sm">
          <a href="#lokasi" class="hover:opacity-80">Lokasi</a>
        </div>
      </div>
    </div>
    <div class="text-center text-xs text-slate-500 pb-8">
      © 2025 Jossmen Laundry.
    </div>
  </div>
  <script src="app.js"></script>
</body>

</html>
