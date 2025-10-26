<?php
if (! isset($_POST['submit'])) {
  echo "<script>alert('Permintaan tidak valid.'); window.location.href='../admin/tambahProduk.php';</script>";
  exit;
}

include '../config/connection.php';

$title = trim($_POST['title'] ?? '');
$subtitle = trim($_POST['subtitle'] ?? '');
$hargaInput = trim($_POST['harga'] ?? '');

if ($title === '' || $subtitle === '' || $hargaInput === '') {
  echo "<script>alert('Judul, deskripsi, dan harga wajib diisi.'); history.back();</script>";
  $conn->close();
  exit;
}

if (! is_numeric($hargaInput)) {
  echo "<script>alert('Harga harus berupa angka.'); history.back();</script>";
  $conn->close();
  exit;
}

if (! isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
  echo "<script>alert('Silakan pilih gambar produk.'); history.back();</script>";
  $conn->close();
  exit;
}

if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
  echo "<script>alert('Upload gagal. Kode: " . $_FILES['image']['error'] . "'); history.back();</script>";
  $conn->close();
  exit;
}

$harga = number_format((float) $hargaInput, 2, '.', '');

$originalName = $_FILES['image']['name'];
$extension = pathinfo($originalName, PATHINFO_EXTENSION);
$safeName = preg_replace('/[^a-zA-Z0-9-_]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
$fileName = $safeName . '_' . time() . ($extension ? ".{$extension}" : '');

$targetDir = dirname(__DIR__) . '/assets/images/';

if (! is_dir($targetDir) && ! mkdir($targetDir, 0755, true)) {
  echo "<script>alert('Folder upload tidak dapat dibuat.'); history.back();</script>";
  $conn->close();
  exit;
}

if (! is_writable($targetDir)) {
  echo "<script>alert('Folder upload tidak dapat ditulisi.'); history.back();</script>";
  $conn->close();
  exit;
}

$targetPath = $targetDir . $fileName;

if (! move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
  echo "<script>alert('File gagal dipindahkan.'); history.back();</script>";
  $conn->close();
  exit;
}

$safeTitle = mysqli_real_escape_string($conn, $title);
$safeSubtitle = mysqli_real_escape_string($conn, $subtitle);
$safeHarga = mysqli_real_escape_string($conn, $harga);
$safeImage = mysqli_real_escape_string($conn, $fileName);

$sql = "INSERT INTO produk (title, subtitle, harga, image_path) VALUES ('$safeTitle', '$safeSubtitle', '$safeHarga', '$safeImage')";

if ($conn->query($sql) === true) {
  echo "<script>alert('Produk berhasil ditambahkan.'); window.location.href='../admin/index.php';</script>";
} else {
  if (file_exists($targetPath)) {
    @unlink($targetPath);
  }
  echo "<script>alert('Gagal menyimpan produk.'); history.back();</script>";
}

$conn->close();
