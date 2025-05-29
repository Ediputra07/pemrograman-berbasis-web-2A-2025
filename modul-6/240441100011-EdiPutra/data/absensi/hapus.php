<?php
include '../../config/koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
  die("ID tidak ditemukan.");
}

// Eksekusi query hapus
$query = "DELETE FROM karyawan_absensi WHERE id = '$id'";
if (mysqli_query($conn, $query)) {
  header("Location: tampil.php");
  exit;
} else {
  echo "Gagal menghapus data: " . mysqli_error($conn);
}
?>