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
  $umur = (int) $_POST['umur'] ?? 0;
  $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
  $departemen = $_POST['departemen'] ?? '';
  $jabatan = $_POST['jabatan'] ?? '';
  $kota_asal = $_POST['kota_asal'] ?? '';

  // Validasi
  if (!$nip || !$nama || !$umur || !$jenis_kelamin || !$departemen || !$jabatan || !$kota_asal) {
    $error = "Mohon isi semua field wajib.";
  } else {
    // Cek apakah NIP sudah digunakan oleh ID lain
    $cek = $conn->prepare("SELECT id FROM karyawan_absensi WHERE nip = ? AND id != ?");
    $cek->bind_param("si", $nip, $id);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
      $error = "NIP sudah digunakan oleh karyawan lain.";
    } else {
      $stmt = $conn->prepare("UPDATE karyawan_absensi SET 
        nip = ?, nama = ?, umur = ?, jenis_kelamin = ?, departemen = ?, jabatan = ?, kota_asal = ?
        WHERE id = ?");
      $stmt->bind_param("ssissssi", $nip, $nama, $umur, $jenis_kelamin, $departemen, $jabatan, $kota_asal, $id);

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
  <title>Edit Data Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <!-- judul -->
    <h1 class="text-2xl font-bold mb-6">Edit Data Karyawan</h1>
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
        <!-- umur -->
        <div>
          <label class="block">Umur</label>
          <input name="umur" type="number" value="<?= htmlspecialchars($_POST['umur'] ?? $data['umur']) ?>" required class="w-full p-2 border rounded" />
        </div>
        <!-- jenis kelamin -->
        <div>
          <label class="block">Jenis Kelamin</label>
          <select name="jenis_kelamin" class="w-full p-2 border rounded">
            <option value="Laki-laki" <?= (($_POST['jenis_kelamin'] ?? $data['jenis_kelamin']) === 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
            <option value="Perempuan" <?= (($_POST['jenis_kelamin'] ?? $data['jenis_kelamin']) === 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
          </select>
        </div>
        <!-- departemen -->
        <div>
          <label class="block">Departemen</label>
          <input name="departemen" value="<?= htmlspecialchars($_POST['departemen'] ?? $data['departemen']) ?>" required class="w-full p-2 border rounded" />
        </div>
        <!-- jabatan -->
        <div>
          <label class="block">Jabatan</label>
          <input name="jabatan" value="<?= htmlspecialchars($_POST['jabatan'] ?? $data['jabatan']) ?>" required class="w-full p-2 border rounded" />
        </div>
        <!-- kota asal -->
        <div>
          <label class="block">Kota Asal</label>
          <input name="kota_asal" value="<?= htmlspecialchars($_POST['kota_asal'] ?? $data['kota_asal']) ?>" required class="w-full p-2 border rounded" />
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