<?php
include '../../config/koneksi.php';

$result = mysqli_query($conn, "SELECT DISTINCT id, nip, nama, tanggal_absensi, jam_masuk, jam_pulang FROM karyawan_absensi");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Data Absensi Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-16 mx-auto">
      <!-- judul -->
      <h1 class="text-3xl font-bold">Data Absensi Karyawan</h1>
      <div class="space-x-2">
        <!-- kembali ke dashboard -->
        <a href="../../dashboard.php" class="bg-gray-500 rounded-lg py-2 px-4 text-white hover:bg-gray-600">Kembali</a>
        <!-- logout -->
        <a href="../../auth/logout.php" class="bg-red-500 rounded-lg py-2 px-4 text-white hover:bg-red-600">Logout</a>
      </div>
    </div>
    <!-- slider -->
    <div class="overflow-x-auto">
      <!-- tabel -->
      <table class="bg-white border border-gray-200 w-full">
        <!-- judul tabel -->
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2 border">NIP</th>
            <th class="px-4 py-2 border">Nama</th>
            <th class="px-4 py-2 border">Tanggal</th>
            <th class="px-4 py-2 border">Jam Masuk</th>
            <th class="px-4 py-2 border">Jam Pulang</th>
            <th class="px-4 py-2 border"></th>
          </tr>
        </thead>
        <!-- isi tabel -->
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr class="text-center border-t">
              <td class="px-4 py-2"><?= htmlspecialchars($row['nip']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['nama']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['tanggal_absensi']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['jam_masuk']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['jam_pulang']) ?></td>
              <td class="px-4 py-2">
                <div class="flex justify-between items-center gap-2">
                  <!-- edit -->
                  <a href="edit.php?id=<?= $row['id'] ?>" class="text-yellow-500 hover:text-yellow-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                  </a>
                  <!-- hapus -->
                  <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-500 hover:text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                      <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                    </svg>
                  </a>
                </div>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>