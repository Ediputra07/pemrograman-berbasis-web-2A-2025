<?php
include '../../config/koneksi.php';

$error = "";

// Proses simpan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nip = $_POST['nip'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $umur = $_POST['umur'] ?? '';
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $departemen = $_POST['departemen'] ?? '';
    $jabatan = $_POST['jabatan'] ?? '';
    $kota_asal = $_POST['kota_asal'] ?? '';

    // Validasi semua field wajib
    if (!$nip || !$nama || !$umur || !$jenis_kelamin || !$departemen || !$jabatan || !$kota_asal) {
        $error = "Mohon isi semua field.";
    } else {
        // Cek duplikat NIP + tanggal absensi
        $cek = $conn->prepare("SELECT nip FROM karyawan_absensi WHERE nip = ?");
        $cek->bind_param("s", $nip);
        $cek->execute();
        $cek->store_result();

        if ($cek->num_rows > 0) {
            $error = "Absensi untuk NIP ini sudah terdaftar.";
        } else {
            // Simpan ke database
            $stmt = $conn->prepare("INSERT INTO karyawan_absensi (nip, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssissss", $nip, $nama, $umur, $jenis_kelamin, $departemen, $jabatan, $kota_asal);

            if ($stmt->execute()) {
                header("Location: tampil.php?status=sukses");
                exit;
            } else {
                $error = "Gagal menyimpan data: " . $stmt->error;
            }
            $stmt->close();
        }
        $cek->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <!-- judul -->
    <h1 class="text-2xl font-bold mb-6">Tambah Data Karyawan</h1>
    <!-- pesan error -->
    <?php if ($error): ?>
      <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <!-- form input -->
    <form method="POST" class="space-y-4">
      <div class="grid grid-cols-2 gap-4">
        <!-- nip -->
        <div>
          <label for="nip" class="block font-semibold mb-1">NIP</label>
          <input type="text" name="nip" id="nip" required value="<?= htmlspecialchars($_POST['nip'] ?? '') ?>"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>
        <!-- nama -->
        <div>
          <label for="nama" class="block font-semibold mb-1">Nama</label>
          <input type="text" name="nama" id="nama" required value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>
        <!-- umur -->
        <div>
          <label for="umur" class="block font-semibold mb-1">Umur</label>
          <input type="number" name="umur" id="umur" required value="<?= htmlspecialchars($_POST['umur'] ?? '') ?>"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>
        <!-- jenis kelamin -->
        <div>
          <label class="block font-semibold mb-1">Jenis Kelamin</label>
          <select name="jenis_kelamin" required
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option value="" disabled <?= !isset($_POST['jenis_kelamin']) ? 'selected' : '' ?>>Pilih Jenis Kelamin</option>
            <option value="Laki-laki" <?= (($_POST['jenis_kelamin'] ?? '') == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
            <option value="Perempuan" <?= (($_POST['jenis_kelamin'] ?? '') == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
          </select>
        </div>
        <!-- departemen -->
        <div>
          <label for="departemen" class="block font-semibold mb-1">Departemen</label>
          <input type="text" name="departemen" id="departemen" required value="<?= htmlspecialchars($_POST['departemen'] ?? '') ?>"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>
        <!-- jabatan -->
        <div>
          <label for="jabatan" class="block font-semibold mb-1">Jabatan</label>
          <input type="text" name="jabatan" id="jabatan" required value="<?= htmlspecialchars($_POST['jabatan'] ?? '') ?>"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>
        <!-- kota asal -->
        <div>
          <label for="kota_asal" class="block font-semibold mb-1">Kota Asal</label>
          <input type="text" name="kota_asal" id="kota_asal" required value="<?= htmlspecialchars($_POST['kota_asal'] ?? '') ?>"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>
        <!-- tombol simpan atau batal -->
        <div class="flex items-center justify-between mt-6">
          <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition">Simpan Data</button>
          <a href="tampil.php" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">Batal</a>
        </div>
      </div>
    </form>
  </div>
</body>
</html>