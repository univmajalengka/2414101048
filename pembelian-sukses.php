<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: index.php');
  exit;
}

include './config/connection.php';

$productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$buyerName = trim($_POST['buyer_name'] ?? '');
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, ['options' => ['default' => 1, 'min_range' => 1]]);
$paymentMethod = trim($_POST['payment_method'] ?? '');
$address = trim($_POST['address'] ?? '');

$allowedPaymentMethods = ['e-wallet', 'bank', 'qris'];

$errors = [];

if (! $productId) {
  $errors[] = 'Produk tidak valid.';
}

if ($buyerName === '' || strlen($buyerName) > 150) {
  $errors[] = 'Nama pembeli wajib diisi (maks 150 karakter).';
}

if (! $quantity || $quantity < 1) {
  $errors[] = 'Jumlah pembelian tidak valid.';
}

if (! in_array($paymentMethod, $allowedPaymentMethods, true)) {
  $errors[] = 'Metode pembayaran tidak valid.';
}

if ($address === '') {
  $errors[] = 'Alamat wajib diisi.';
}

$product = null;

if (! $errors) {
  if ($stmt = $conn->prepare('SELECT id, title, subtitle, harga FROM produk WHERE id = ? LIMIT 1')) {
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
    $errors[] = 'Produk tidak ditemukan.';
  }
}

$orderId = null;
$unitPrice = $product ? (float) $product['harga'] : 0;
$totalPrice = $unitPrice * max(1, $quantity ?? 1);

if (! $errors) {
  if ($stmt = $conn->prepare('INSERT INTO pembelian (product_id, buyer_name, quantity, unit_price, total_price, payment_method, address) VALUES (?, ?, ?, ?, ?, ?, ?)')) {
    $stmt->bind_param(
      'isiddss',
      $productId,
      $buyerName,
      $quantity,
      $unitPrice,
      $totalPrice,
      $paymentMethod,
      $address
    );

    if ($stmt->execute()) {
      $orderId = $stmt->insert_id;
    } else {
      $errors[] = 'Gagal menyimpan data pembelian.';
    }

    $stmt->close();
  } else {
    $errors[] = 'Gagal menyiapkan penyimpanan data.';
  }
}

$conn->close();

if ($errors) {
  http_response_code(400);
}

function h($value)
{
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$formattedUnitPrice = 'Rp' . number_format($unitPrice, 0, ',', '.');
$formattedTotalPrice = 'Rp' . number_format($totalPrice, 0, ',', '.');

$paymentLabels = [
  'e-wallet' => 'E-Wallet',
  'bank' => 'Transfer Bank',
  'qris' => 'QRIS',
];

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $errors ? 'Pembelian Gagal' : 'Pembelian Berhasil' ?> | Jossmen Laundry</title>
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
  <main class="min-h-screen flex items-center justify-center px-4 py-10">
    <div class="max-w-3xl w-full">
      <div class="bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden">
        <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r <?= $errors ? 'from-red-500 to-red-400' : 'from-pink-500 to-pink-400' ?> text-white">
          <h1 class="text-2xl font-semibold">
            <?= $errors ? 'Pembelian Gagal' : 'Pembelian Berhasil' ?>
          </h1>
          <p class="text-sm opacity-80">
            <?= $errors ? 'Terjadi kesalahan saat memproses pembelian Anda.' : 'Terima kasih telah mempercayakan laundry Anda kepada kami.' ?>
          </p>
        </div>

        <div class="px-6 py-8 space-y-6">
          <?php if ($errors): ?>
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600">
              <ul class="list-disc list-inside space-y-1">
                <?php foreach ($errors as $error): ?>
                  <li><?= h($error) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="flex justify-end">
              <a
                href="index.php"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-gray-200 text-sm hover:border-pink-500">
                Kembali ke Beranda
              </a>
            </div>
          <?php else: ?>
            <div class="grid md:grid-cols-2 gap-6">
              <div class="space-y-2">
                <h2 class="text-lg font-semibold text-slate-700">Informasi Pembeli</h2>
                <dl class="text-sm text-slate-600 space-y-2">
                  <div>
                    <dt class="font-medium text-slate-500">Nama Pembeli</dt>
                    <dd><?= h($buyerName) ?></dd>
                  </div>
                  <div>
                    <dt class="font-medium text-slate-500">Alamat</dt>
                    <dd><?= nl2br(h($address)) ?></dd>
                  </div>
                  <div>
                    <dt class="font-medium text-slate-500">Metode Pembayaran</dt>
                    <dd><?= h($paymentLabels[$paymentMethod] ?? $paymentMethod) ?></dd>
                  </div>
                </dl>
              </div>

              <div class="space-y-2">
                <h2 class="text-lg font-semibold text-slate-700">Detail Produk</h2>
                <dl class="text-sm text-slate-600 space-y-2">
                  <div>
                    <dt class="font-medium text-slate-500">Nama Produk</dt>
                    <dd><?= h($product['title'] ?? '-') ?></dd>
                  </div>
                  <div>
                    <dt class="font-medium text-slate-500">Harga Satuan</dt>
                    <dd><?= h($formattedUnitPrice) ?></dd>
                  </div>
                  <div>
                    <dt class="font-medium text-slate-500">Jumlah</dt>
                    <dd><?= h($quantity) ?> item</dd>
                  </div>
                  <div>
                    <dt class="font-medium text-slate-500">Total Pembayaran</dt>
                    <dd class="text-lg font-semibold text-pink-600"><?= h($formattedTotalPrice) ?></dd>
                  </div>
                  <?php if ($orderId): ?>
                    <div>
                      <dt class="font-medium text-slate-500">Nomor Pesanan</dt>
                      <dd>#<?= h(str_pad((string) $orderId, 6, '0', STR_PAD_LEFT)) ?></dd>
                    </div>
                  <?php endif; ?>
                </dl>
              </div>
            </div>

            <div class="flex justify-end">
              <a
                href="index.php"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-gray-200 text-sm hover:border-pink-500">
                Kembali ke Beranda
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
