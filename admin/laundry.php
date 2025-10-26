<?php
session_start();

if (! isset($_SESSION['username'])) {
  header('Location: ../user/login.php');
  exit();
}

include '../config/connection.php';

$sql = "SELECT id, customer_name, whatsapp, address, pickup_date, service_name, service_category, service_unit, quantity, total_price, notes, created_at FROM laundry_orders ORDER BY created_at DESC";
$result = $conn->query($sql);

function h($value)
{
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function formatCurrency($value)
{
  return 'Rp' . number_format((float) $value, 0, ',', '.');
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Laundry | Jossmen Laundry</title>
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
  <div
    id="mobileNav"
    class="fixed inset-0 z-50 hidden md:hidden"
    role="dialog"
    aria-modal="true">
    <div
      id="mobileNavBackdrop"
      class="absolute inset-0 bg-slate-900/40"
      aria-hidden="true"></div>
    <div class="relative ml-auto flex h-full w-72 max-w-[85%] flex-col bg-white shadow-xl">
      <div class="px-6 py-6 border-b border-gray-200 flex items-center justify-between">
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
        <button
          id="mobileCloseButton"
          class="inline-flex items-center justify-center rounded-xl border border-gray-200 p-2 text-slate-600"
          aria-label="Tutup menu">
          <span class="sr-only">Tutup menu</span>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M6 18L18 6" />
          </svg>
        </button>
      </div>
      <nav class="flex-1 px-6 py-6 space-y-1 text-sm">
        <a
          href="./index.php"
          class="block rounded-xl px-4 py-2 text-slate-600 hover:bg-pink-50">
          Daftar Produk
        </a>
        <a
          href="./pembelian.php"
          class="block rounded-xl px-4 py-2 text-slate-600 hover:bg-pink-50">
          Daftar Pembelian
        </a>
        <a
          href="./laundry.php"
          class="block rounded-xl bg-pink-500 px-4 py-2 text-white">
          Daftar Laundry
        </a>
      </nav>
      <div class="px-6 py-6 border-t border-gray-200 text-sm">
        <a
          href="../user/logout.php"
          class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl border border-pink-500 text-pink-500 hover:bg-pink-50">
          Keluar
        </a>
      </div>
    </div>
  </div>

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
          class="flex items-center gap-3 px-3 py-2 rounded-xl bg-pink-500 text-white">
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
          <div class="flex items-center gap-3">
            <button
              id="mobileMenuButton"
              class="md:hidden inline-flex items-center justify-center rounded-xl border border-gray-200 p-2 text-slate-700"
              aria-label="Buka menu navigasi">
              <span class="sr-only">Buka menu</span>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
            <div>
              <h1 class="text-2xl font-semibold">Daftar Laundry</h1>
              <p class="text-sm text-slate-500">
                Lihat pesanan laundry yang masuk lengkap dengan detail penjemputan.
              </p>
            </div>
          </div>
        </div>
      </header>

      <main class="flex-1">
        <div class="max-w-6xl mx-auto px-4 py-6 space-y-6">
          <section class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
              <div>
                <h2 class="text-lg font-semibold">Pesanan Laundry</h2>
                <p class="text-sm text-slate-500">
                  Data pelanggan, kontak, lokasi penjemputan, dan layanan yang dipilih.
                </p>
              </div>
            </div>

            <div class="mt-6 overflow-x-auto">
              <table class="min-w-full text-sm">
                <thead>
                  <tr class="text-left text-slate-500 border-b border-gray-200">
                    <th class="pb-3 pr-6">Nama Pelanggan</th>
                    <th class="pb-3 pr-6">WhatsApp</th>
                    <th class="pb-3 pr-6">Alamat</th>
                    <th class="pb-3 pr-6">Tanggal Ambil</th>
                    <th class="pb-3 pr-6">Jenis Layanan</th>
                    <th class="pb-3 pr-6">Catatan</th>
                    <th class="pb-3">Dipesan</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                      <tr class="hover:bg-pink-50/40 align-top">
                        <td class="py-4 pr-6 font-medium">
                          <?= h($row['customer_name'] ?? '-') ?>
                        </td>
                        <td class="py-4 pr-6">
                          <a href="https://wa.me/<?= h(preg_replace('/\D+/', '', $row['whatsapp'] ?? '')) ?>" target="_blank" class="text-pink-600 hover:underline">
                            <?= h($row['whatsapp'] ?? '-') ?>
                          </a>
                        </td>
                        <td class="py-4 pr-6 whitespace-pre-line">
                          <?= h($row['address'] ?? '-') ?>
                        </td>
                        <td class="py-4 pr-6">
                          <?= h(date('d M Y', strtotime($row['pickup_date'] ?? 'now'))) ?>
                        </td>
                        <td class="py-4 pr-6">
                          <div class="font-medium text-slate-700">
                            <?= h($row['service_name'] ?? '-') ?>
                          </div>
                          <div class="text-xs text-slate-500 mt-1">
                            <?= h($row['service_category'] ?? '-') ?> • <?= h(number_format((float) ($row['quantity'] ?? 0), 1)) . ' ' . h($row['service_unit'] ?? '') ?> • <?= h(formatCurrency($row['total_price'] ?? 0)) ?>
                          </div>
                        </td>
                        <td class="py-4 pr-6 whitespace-pre-line text-slate-600">
                          <?php if ($row['notes'] !== null && $row['notes'] !== ''): ?>
                            <?= nl2br(h($row['notes'])) ?>
                          <?php else: ?>
                            <span class="text-xs text-slate-400">Tidak ada</span>
                          <?php endif; ?>
                        </td>
                        <td class="py-4 text-slate-500">
                          <?= h(date('d M Y H:i', strtotime($row['created_at'] ?? 'now'))) ?>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="7" class="text-center py-6 text-slate-400">Belum ada pesanan laundry.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </main>
    </div>
  </div>

  <script>
    (function() {
      const mobileMenuButton = document.getElementById('mobileMenuButton');
      const mobileNav = document.getElementById('mobileNav');
      const mobileCloseButton = document.getElementById('mobileCloseButton');
      const mobileNavBackdrop = document.getElementById('mobileNavBackdrop');

      if (!mobileMenuButton || !mobileNav) {
        return;
      }

      const toggleMobileNav = (show) => {
        if (show) {
          mobileNav.classList.remove('hidden');
          document.body.classList.add('overflow-hidden');
        } else {
          mobileNav.classList.add('hidden');
          document.body.classList.remove('overflow-hidden');
        }
      };

      mobileMenuButton.addEventListener('click', () => toggleMobileNav(true));
      mobileCloseButton?.addEventListener('click', () => toggleMobileNav(false));
      mobileNavBackdrop?.addEventListener('click', () => toggleMobileNav(false));

      document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !mobileNav.classList.contains('hidden')) {
          toggleMobileNav(false);
        }
      });
    })();
  </script>
</body>

</html>
<?php $conn->close(); ?>
