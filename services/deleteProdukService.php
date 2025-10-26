<?php
if (! isset($_GET['id'])) {
  echo "<script>alert('Produk tidak ditemukan.'); window.location.href='../admin/index.php';</script>";
  exit;
}

include '../config/connection.php';

$id = (int) $_GET['id'];

if ($id <= 0) {
  echo "<script>alert('Produk tidak valid.'); window.location.href='../admin/index.php';</script>";
  $conn->close();
  exit;
}

$productQuery = $conn->query("SELECT image_path FROM produk WHERE id = {$id} LIMIT 1");

if (! $productQuery || $productQuery->num_rows === 0) {
  echo "<script>alert('Produk tidak tersedia.'); window.location.href='../admin/index.php';</script>";
  $conn->close();
  exit;
}

$product = $productQuery->fetch_assoc();

$deleteSql = "DELETE FROM produk WHERE id = {$id}";

if ($conn->query($deleteSql) === true) {
  if (! empty($product['image_path'])) {
    $imageFile = dirname(__DIR__) . '/assets/images/' . $product['image_path'];
    if (file_exists($imageFile)) {
      @unlink($imageFile);
    }
  }

  echo "<script>alert('Produk berhasil dihapus.'); window.location.href='../admin/index.php';</script>";
} else {
  echo "<script>alert('Gagal menghapus produk.'); window.location.href='../admin/index.php';</script>";
}

$conn->close();
