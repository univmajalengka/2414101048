<?php
include './config/connection.php';

$productId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (! $productId) {
  http_response_code(400);
  echo '<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Produk tidak ditemukan</title></head><body><p>Produk tidak valid.</p></body></html>';
  exit;
}

$product = null;

if ($stmt = $conn->prepare('SELECT id, title, subtitle, harga, image_path FROM produk WHERE id = ? LIMIT 1')) {
  $stmt->bind_param('i', $productId);
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result && $result->num_rows === 1) {
      $product = $result->fetch_assoc();
    }
  }
  $stmt->close();
}

if (! $product) {
  $conn->close();
  http_response_code(404);
  echo '<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Produk tidak ditemukan</title></head><body><p>Produk tidak ditemukan.</p></body></html>';
  exit;
}

$imageFile = $product['image_path'] ?? '';
$publicImagePath = 'assets/images/' . $imageFile;
$fullImagePath = __DIR__ . '/assets/images/' . $imageFile;

if (empty($imageFile) || ! file_exists($fullImagePath)) {
  $publicImagePath = 'assets/jumbotron.jpg';
}

$unitPrice = (float) ($product['harga'] ?? 0);
$formattedPrice = 'Rp' . number_format($unitPrice, 0, ',', '.');

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Beli <?= htmlspecialchars($product['title'] ?? 'Produk', ENT_QUOTES, 'UTF-8') ?> | Jossmen Laundry</title>
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
        href="index.php#products"
        class="hidden sm:inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full border border-pink-500 text-pink-500 hover:bg-pink-50 transition text-sm">
        Kembali ke Produk
      </a>
    </div>
  </header>

  <main class="py-10 px-4">
    <div class="max-w-5xl mx-auto grid lg:grid-cols-2 gap-8">
      <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-lg">
        <img
          src="<?= htmlspecialchars($publicImagePath, ENT_QUOTES, 'UTF-8') ?>"
          alt="<?= htmlspecialchars($product['title'] ?? 'Produk laundry', ENT_QUOTES, 'UTF-8') ?>"
          class="w-full h-64 object-cover" />
        <div class="p-6 space-y-3">
          <h1 class="text-2xl font-semibold"><?= htmlspecialchars($product['title'] ?? '-', ENT_QUOTES, 'UTF-8') ?></h1>
          <p class="text-sm text-slate-500 leading-relaxed">
            <?= nl2br(htmlspecialchars($product['subtitle'] ?? '-', ENT_QUOTES, 'UTF-8')) ?>
          </p>
          <div class="text-xl font-semibold text-pink-600"><?= $formattedPrice ?></div>
        </div>
      </div>

      <div class="bg-white border border-gray-200 rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Formulir Pembelian</h2>
        <form
          action="pembelian-sukses.php"
          method="POST"
          class="space-y-4">
          <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>" />
          <input type="hidden" name="product_title" value="<?= htmlspecialchars($product['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />
          <input type="hidden" name="product_price" value="<?= htmlspecialchars((string) $unitPrice, ENT_QUOTES, 'UTF-8') ?>" />

          <div class="space-y-2">
            <label for="buyer_name" class="text-sm font-medium text-slate-600">Nama Pembeli</label>
            <input
              type="text"
              id="buyer_name"
              name="buyer_name"
              required
              maxlength="150"
              placeholder="Masukkan nama lengkap"
              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition" />
          </div>

          <div class="space-y-2">
            <label for="quantity" class="text-sm font-medium text-slate-600">Jumlah Pembelian</label>
            <input
              type="number"
              id="quantity"
              name="quantity"
              min="1"
              step="1"
              value="1"
              required
              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition" />
            <p class="text-xs text-slate-400">Total pembayaran akan dihitung otomatis.</p>
          </div>

          <div class="space-y-2">
            <label class="text-sm font-medium text-slate-600">Total Harga</label>
            <div class="px-4 py-3 rounded-xl border border-gray-200 bg-slate-50 text-pink-600 font-semibold" id="totalDisplay"></div>
            <input type="hidden" name="total_price" id="totalPriceInput" value="">
          </div>

          <div class="space-y-2">
            <label for="payment_method" class="text-sm font-medium text-slate-600">Metode Pembayaran</label>
            <select
              id="payment_method"
              name="payment_method"
              required
              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition">
              <option value="">Pilih metode pembayaran</option>
              <option value="e-wallet">E-Wallet</option>
              <option value="bank">Transfer Bank</option>
              <option value="qris">QRIS</option>
            </select>
          </div>

          <div class="space-y-2">
            <label for="address" class="text-sm font-medium text-slate-600">Alamat Pengiriman</label>
            <textarea
              id="address"
              name="address"
              rows="4"
              required
              placeholder="Tuliskan alamat lengkap Anda"
              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition"></textarea>
          </div>

          <button
            type="submit"
            class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-pink-500 text-white font-medium hover:opacity-90 transition">
            Beli Sekarang
          </button>
        </form>
      </div>
    </div>
  </main>

  <script>
    (function() {
      const quantityInput = document.getElementById('quantity');
      const totalDisplay = document.getElementById('totalDisplay');
      const totalPriceInput = document.getElementById('totalPriceInput');
      const unitPrice = <?= json_encode($unitPrice) ?>;

      const formatRupiah = (value) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
      };

      const updateTotal = () => {
        const quantity = Math.max(1, parseInt(quantityInput.value || '1', 10));
        quantityInput.value = quantity;
        const total = unitPrice * quantity;
        totalDisplay.textContent = formatRupiah(total);
        totalPriceInput.value = total.toFixed(2);
      };

      quantityInput.addEventListener('input', updateTotal);
      updateTotal();
    })();
  </script>
</body>

</html>
