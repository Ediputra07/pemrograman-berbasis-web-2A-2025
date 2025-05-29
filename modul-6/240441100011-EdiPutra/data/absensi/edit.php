<?php
include '../../config/koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'] ?? null;
if (!$id) die("ID tidak ditemukan.");

// ambil data awal
$stmt = $conn->prepare("SELECT * FROM karyawan_absensi WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
if (!$data) die("Data tidak ditemukan.");
$stmt->close();

$error = "";

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nip = $_POST['nip'] ?? '';
  $nama = $_POST['nama'] ?? '';
  $tanggal = $_POST['tanggal'] ?? '';
  $jam_masuk = $_POST['jam_masuk'] ?? '';
  $jam_pulang = $_POST['jam_pulang'] ?? '';

  // Validasi
  if (!$nip || !$nama || !$tanggal || !$jam_masuk || !$jam_pulang) {
    $error = "Mohon isi semua field wajib.";
  } else {
      // Cek apakah absensi untuk NIP dan tanggal ini sudah ada
      $cek_absen = $conn->prepare("SELECT id FROM karyawan_absensi WHERE nip = ? AND tanggal_absensi = ?");
      $cek_absen->bind_param("ss", $nip, $tanggal);
      $cek_absen->execute();
      $cek_absen->store_result();

      if ($cek_absen->num_rows > 0) {
          $error = "Absensi untuk NIP dan tanggal ini sudah tercatat.";
      } else {
      // Simpan ke database
          $stmt = $conn->prepare("UPDATE karyawan_absensi SET 
            nip = ?, nama = ?, tanggal_absensi = ?, jam_masuk = ?, jam_pulang = ?
            WHERE id = ?");
          $stmt->bind_param("sssssi", $nip, $nama, $tanggal, $jam_masuk, $jam_pulang, $id);

          if ($stmt->execute()) {
            header("Location: tampil.php?status=updated");
            exit;
          } else {
            $error = "Gagal memperbarui data: " . $stmt->error;
          }
          $stmt->close();
      }
      $cek->close();
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Absensi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <!-- Judul -->
    <h1 class="text-2xl font-bold mb-6">Edit Absensi</h1>
    <!-- pesan error -->
    <?php if ($error): ?>
      <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <!-- form -->
    <form method="POST" class="space-y-4">
      <div class="grid grid-cols-2 gap-4">
        <!-- nip -->
        <div>
          <label class="block">NIP</label>
          <input name="nip" value="<?= htmlspecialchars($_POST['nip'] ?? $data['nip']) ?>" required class="w-full p-2 border rounded" />
        </div>
        <!-- nama -->
        <div>
          <label class="block">Nama</label>
          <input name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? $data['nama']) ?>" required class="w-full p-2 border rounded" />
        </div>
        <!-- tanggal -->
        <div>
          <label class="block">Tanggal Absensi</label>
          <input type="date" name="tanggal" value="<?= htmlspecialchars($_POST['tanggal'] ?? $data['tanggal_absensi']) ?>" required class="w-full p-2 border rounded" />
        </div>
        <!-- jam masuk -->
        <div>
          <label class="block">Jam Masuk</label>
          <input type="time" name="jam_masuk" value="<?= htmlspecialchars($_POST['jam_masuk'] ?? $data['jam_masuk']) ?>" required class="w-full p-2 border rounded" />
        </div>
        <!-- jam pulang -->
        <div>
          <label class="block">Jam Pulang</label>
          <input type="time" name="jam_pulang" value="<?= htmlspecialchars($_POST['jam_pulang'] ??  $data['jam_pulang']) ?>" class="w-full p-2 border rounded" />
        </div>
        <!-- tombol update dan batal -->
        <div class="flex justify-between items-center mt-6">
          <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Update</button>
          <a href="tampil.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
        </div>
      </div>
    </form>
  </div>
</body>
</html>