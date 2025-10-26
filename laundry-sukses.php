<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: laundry.php');
  exit;
}

include './services/laundryServices.php';
include './config/connection.php';

$services = getLaundryServices();

$customerName = trim($_POST['customer_name'] ?? '');
$whatsapp = trim($_POST['whatsapp'] ?? '');
$address = trim($_POST['address'] ?? '');
$pickupDate = trim($_POST['pickup_date'] ?? '');
$serviceId = $_POST['service_id'] ?? '';
$quantity = isset($_POST['quantity']) ? (float) $_POST['quantity'] : 0;
$notes = trim($_POST['notes'] ?? '');

$errors = [];

if ($customerName === '' || strlen($customerName) > 150) {
  $errors[] = 'Nama pelanggan wajib diisi (maks 150 karakter).';
}

if ($whatsapp === '' || strlen($whatsapp) > 20) {
  $errors[] = 'Nomor WhatsApp wajib diisi (maks 20 karakter).';
}

if ($address === '') {
  $errors[] = 'Alamat wajib diisi.';
}

if ($pickupDate === '' || ! preg_match('/^\d{4}-\d{2}-\d{2}$/', $pickupDate)) {
  $errors[] = 'Tanggal ambil tidak valid.';
}

if (! isset($services[$serviceId])) {
  $errors[] = 'Jenis layanan tidak valid.';
}

if ($quantity <= 0) {
  $errors[] = 'Jumlah atau berat cucian harus lebih dari 0.';
}

$service = $services[$serviceId] ?? null;
$unitPrice = $service ? (float) $service['price'] : 0;
$totalPrice = $unitPrice * $quantity;

$photoPath = null;

if (! empty($_FILES['laundry_photo']['name'])) {
  $fileError = $_FILES['laundry_photo']['error'];
  if ($fileError === UPLOAD_ERR_OK) {
    $fileSize = $_FILES['laundry_photo']['size'];
    if ($fileSize > 2 * 1024 * 1024) {
      $errors[] = 'Ukuran foto maksimal 2 MB.';
    } else {
      $tmpName = $_FILES['laundry_photo']['tmp_name'];
      $mimeType = mime_content_type($tmpName);
      $allowedMime = ['image/jpeg', 'image/png', 'image/webp'];
      if (! in_array($mimeType, $allowedMime, true)) {
        $errors[] = 'Format foto harus JPG, PNG, atau WEBP.';
      } else {
        $extensionMap = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        $extension = $extensionMap[$mimeType];
        $targetDir = __DIR__ . '/uploads/laundry/';
        if (! is_dir($targetDir) && ! mkdir($targetDir, 0755, true)) {
          $errors[] = 'Folder unggahan tidak dapat dibuat.';
        }
        if (! $errors) {
          $fileName = 'laundry_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $extension;
          $targetPath = $targetDir . $fileName;
          if (move_uploaded_file($tmpName, $targetPath)) {
            $photoPath = 'uploads/laundry/' . $fileName;
          } else {
            $errors[] = 'Gagal menyimpan foto cucian.';
          }
        }
      }
    }
  } elseif ($fileError !== UPLOAD_ERR_NO_FILE) {
    $errors[] = 'Terjadi kesalahan saat mengunggah foto.';
  }
}

if ($errors) {
  $conn->close();
}

if (! $errors) {
  $stmt = $conn->prepare('INSERT INTO laundry_orders (customer_name, whatsapp, address, pickup_date, service_id, service_name, service_category, service_unit, quantity, unit_price, total_price, notes, photo_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

  if ($stmt) {
    $serviceName = $service['name'];
    $serviceCategory = $service['category'];
    $serviceUnit = $service['unit'];
    $unitPriceValue = round($unitPrice, 2);
    $totalPriceValue = round($totalPrice, 2);

    $stmt->bind_param(
      'ssssssssdddss',
      $customerName,
      $whatsapp,
      $address,
      $pickupDate,
      $serviceId,
      $serviceName,
      $serviceCategory,
      $serviceUnit,
      $quantity,
      $unitPriceValue,
      $totalPriceValue,
      $notes,
      $photoPath
    );

    if (! $stmt->execute()) {
      $errors[] = 'Gagal menyimpan data pesanan.';
    }

    $stmt->close();
  } else {
    $errors[] = 'Gagal menyiapkan penyimpanan pesanan.';
  }

  $conn->close();
}

function h($value)
{
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$formattedUnitPrice = 'Rp' . number_format($unitPrice, 0, ',', '.');
$formattedTotalPrice = 'Rp' . number_format($totalPrice, 0, ',', '.');

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $errors ? 'Pesan Laundry Gagal' : 'Pesan Laundry Berhasil' ?> | Jossmen Laundry</title>
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
            <?= $errors ? 'Pesanan Gagal Diproses' : 'Pesanan Laundry Berhasil' ?>
          </h1>
          <p class="text-sm opacity-80">
            <?= $errors ? 'Silakan periksa kembali data pesanan dan coba lagi.' : 'Kami akan menghubungi Anda untuk proses selanjutnya.' ?>
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
            <div class="flex justify-end gap-3">
              <a
                href="laundry.php"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-gray-200 text-sm hover:border-pink-500">
                Kembali ke Form
              </a>
              <a
                href="index.php"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-gray-200 text-sm hover:border-pink-500">
                Beranda
              </a>
            </div>
          <?php else: ?>
            <div class="grid md:grid-cols-2 gap-6">
              <div class="space-y-3">
                <h2 class="text-lg font-semibold text-slate-700">Informasi Pelanggan</h2>
                <dl class="text-sm text-slate-600 space-y-2">
                  <div>
                    <dt class="font-medium text-slate-500">Nama</dt>
                    <dd><?= h($customerName) ?></dd>
                  </div>
                  <div>
                    <dt class="font-medium text-slate-500">WhatsApp</dt>
                    <dd><?= h($whatsapp) ?></dd>
                  </div>
                  <div>
                    <dt class="font-medium text-slate-500">Alamat</dt>
                    <dd><?= nl2br(h($address)) ?></dd>
                  </div>
                  <div>
                    <dt class="font-medium text-slate-500">Tanggal Ambil</dt>
                    <dd><?= h(date('d M Y', strtotime($pickupDate))) ?></dd>
                  </div>
                </dl>
              </div>

              <div class="space-y-3">
                <h2 class="text-lg font-semibold text-slate-700">Detail Layanan</h2>
                <dl class="text-sm text-slate-600 space-y-2">
                  <div>
                    <dt class="font-medium text-slate-500">Layanan</dt>
                    <dd><?= h($service['name'] ?? '-') ?> (<?= h($service['category'] ?? '-') ?>)</dd>
                  </div>
                  <div>
                    <dt class="font-medium text-slate-500">Harga Satuan</dt>
                    <dd><?= h($formattedUnitPrice) . ' / ' . h($service['unit'] ?? '-') ?></dd>
                  </div>
                  <div>
                    <dt class="font-medium text-slate-500">Jumlah</dt>
                    <dd><?= h(number_format($quantity, 1)) . ' ' . h($service['unit'] ?? '') ?></dd>
                  </div>
                  <div>
                    <dt class="font-medium text-slate-500">Total Estimasi</dt>
                    <dd class="text-lg font-semibold text-pink-600"><?= h($formattedTotalPrice) ?></dd>
                  </div>
                </dl>
              </div>
            </div>

            <?php if ($notes !== ''): ?>
              <div class="border border-gray-200 rounded-xl p-4 bg-slate-50">
                <div class="text-sm font-semibold text-slate-600 mb-2">Catatan Pelanggan</div>
                <p class="text-sm text-slate-600 leading-relaxed"><?= nl2br(h($notes)) ?></p>
              </div>
            <?php endif; ?>

            <?php if ($photoPath): ?>
              <div class="border border-gray-200 rounded-xl p-4">
                <div class="text-sm font-semibold text-slate-600 mb-2">Foto Cucian</div>
                <img src="<?= h($photoPath) ?>" alt="Foto cucian" class="max-h-48 rounded-lg object-cover border border-gray-200" />
              </div>
            <?php endif; ?>

            <div class="flex justify-end gap-3">
              <a
                href="laundry.php"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-gray-200 text-sm hover:border-pink-500">
                Buat Pesanan Baru
              </a>
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
