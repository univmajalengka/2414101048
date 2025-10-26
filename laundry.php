<?php
include './services/laundryServices.php';

$services = getLaundryServices();

$groupedServices = [];
foreach ($services as $id => $service) {
  $groupedServices[$service['category']][$id] = $service;
}

$today = date('Y-m-d');

function h($value)
{
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Laundry | Jossmen Laundry</title>
  <link rel="shortcut icon" href="assets/logo.jpg" type="image/x-icon" />
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
  <header class="w-full border-b border-gray-200 bg-white/90 backdrop-blur">
    <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
      <a href="index.php" class="flex items-center gap-3">
        <img
          src="assets/logo.jpg"
          alt="Logo Jossmen Laundry"
          class="rounded-full h-12 w-12 border border-pink-500" />
        <span class="font-semibold text-lg">Jossmen Laundry</span>
      </a>
      <a
        href="index.php"
        class="hidden sm:inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full border border-pink-500 text-pink-500 hover:bg-pink-50 transition text-sm">
        Kembali ke Beranda
      </a>
    </div>
  </header>

  <main class="py-10 px-4">
    <div class="max-w-5xl mx-auto grid gap-8 lg:grid-cols-2">
      <section class="bg-white border border-gray-200 rounded-2xl shadow-lg p-6 space-y-4">
        <div class="space-y-2">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pink-100 text-pink-600 text-xs font-medium">
            <span>Form Pemesanan Laundry</span>
          </div>
          <h1 class="text-2xl font-semibold">Pesan Layanan Laundry</h1>
          <p class="text-sm text-slate-500">
            Pilih layanan berdasarkan pricelist dan isi detail penjemputan untuk memulai proses laundry.
          </p>
        </div>

        <div class="space-y-3 text-sm">
          <div class="font-semibold text-slate-600">Ringkasan Pricelist</div>
          <?php foreach ($groupedServices as $category => $items): ?>
            <div class="border border-gray-200 rounded-xl p-3">
              <div class="text-xs text-pink-500 font-semibold uppercase tracking-widest mb-2">
                <?= h($category) ?>
              </div>
              <ul class="space-y-1 text-slate-600">
                <?php foreach ($items as $service): ?>
                  <li class="flex items-center justify-between text-xs sm:text-sm">
                    <span><?= h($service['name']) ?></span>
                    <span class="text-pink-600 font-medium">
                      <?= h('Rp' . number_format($service['price'], 0, ',', '.')) . ' / ' . h($service['unit']) ?>
                    </span>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <section class="bg-white border border-gray-200 rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Isi Data Pesanan</h2>
        <form
          action="laundry-sukses.php"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-4">
          <div class="space-y-2">
            <label for="customer_name" class="text-sm font-medium text-slate-600">Nama Pelanggan</label>
            <input
              type="text"
              id="customer_name"
              name="customer_name"
              required
              maxlength="150"
              placeholder="Nama lengkap"
              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition" />
          </div>

          <div class="space-y-2">
            <label for="whatsapp" class="text-sm font-medium text-slate-600">Nomor WhatsApp</label>
            <input
              type="tel"
              id="whatsapp"
              name="whatsapp"
              required
              maxlength="20"
              placeholder="Contoh: 62812xxxx"
              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition" />
          </div>

          <div class="space-y-2">
            <label for="address" class="text-sm font-medium text-slate-600">Alamat Lengkap</label>
            <textarea
              id="address"
              name="address"
              rows="3"
              required
              placeholder="Tuliskan alamat penjemputan"
              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition"></textarea>
          </div>

          <div class="space-y-2">
            <label for="pickup_date" class="text-sm font-medium text-slate-600">Tanggal Ambil</label>
            <input
              type="date"
              id="pickup_date"
              name="pickup_date"
              required
              min="<?= h($today) ?>"
              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition" />
          </div>

          <div class="space-y-2">
            <label for="service_id" class="text-sm font-medium text-slate-600">Jenis Layanan</label>
            <select
              id="service_id"
              name="service_id"
              required
              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition">
              <option value="">Pilih layanan</option>
              <?php foreach ($groupedServices as $category => $items): ?>
                <optgroup label="<?= h($category) ?>">
                  <?php foreach ($items as $id => $service): ?>
                    <option value="<?= h($id) ?>" data-price="<?= h($service['price']) ?>" data-unit="<?= h($service['unit']) ?>">
                      <?= h($service['name']) ?> (<?= h('Rp' . number_format($service['price'], 0, ',', '.')) . ' / ' . h($service['unit']) ?>)
                    </option>
                  <?php endforeach; ?>
                </optgroup>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="grid gap-4 sm:grid-cols-2">
            <div class="space-y-2">
              <label for="quantity" class="text-sm font-medium text-slate-600">Jumlah/Perkiraan Berat</label>
              <input
                type="number"
                id="quantity"
                name="quantity"
                min="0.5"
                step="0.1"
                value="1"
                required
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition" />
              <p class="text-xs text-slate-400">Gunakan satuan sesuai layanan (kg/pcs/m).</p>
            </div>
            <div class="space-y-2">
              <label class="text-sm font-medium text-slate-600">Total Estimasi Harga</label>
              <div class="px-4 py-3 rounded-xl border border-gray-200 bg-slate-50 text-pink-600 font-semibold" id="totalDisplay">
                Rp0
              </div>
              <input type="hidden" name="estimated_total" id="estimatedTotal" value="0">
            </div>
          </div>

          <div class="space-y-2">
            <label for="notes" class="text-sm font-medium text-slate-600">Catatan Tambahan</label>
            <textarea
              id="notes"
              name="notes"
              rows="3"
              placeholder="Tuliskan instruksi khusus (opsional)"
              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition"></textarea>
          </div>

          <div class="space-y-2">
            <label for="laundry_photo" class="text-sm font-medium text-slate-600">Foto Cucian (Opsional)</label>
            <input
              type="file"
              id="laundry_photo"
              name="laundry_photo"
              accept="image/*"
              class="block w-full text-sm text-slate-500 file:mr-4 file:px-4 file:py-2 file:rounded-xl file:border-0 file:bg-pink-500 file:text-white hover:file:opacity-90" />
            <p class="text-xs text-slate-400">Unggah foto maksimal 2 MB.</p>
          </div>

          <button
            type="submit"
            class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-pink-500 text-white font-medium hover:opacity-90 transition">
            Pesan Sekarang
          </button>
        </form>
      </section>
    </div>
  </main>

  <script>
    (function() {
      const serviceSelect = document.getElementById('service_id');
      const quantityInput = document.getElementById('quantity');
      const totalDisplay = document.getElementById('totalDisplay');
      const totalInput = document.getElementById('estimatedTotal');

      const formatRupiah = (value) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
      };

      const updateTotal = () => {
        const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
        const price = selectedOption ? parseFloat(selectedOption.getAttribute('data-price') || '0') : 0;
        const quantity = parseFloat(quantityInput.value || '0');
        const total = price * Math.max(quantity, 0);
        totalDisplay.textContent = formatRupiah(total || 0);
        totalInput.value = total.toFixed(2);
      };

      serviceSelect.addEventListener('change', updateTotal);
      quantityInput.addEventListener('input', updateTotal);

      updateTotal();
    })();
  </script>
</body>

</html>
