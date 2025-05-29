<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: auth/login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-3xl font-bold text-center mb-8">Dashboard</h1>

    <div class="space-y-6">
      <a href="data/karyawan/tampil.php" class="block w-full text-center bg-blue-500 text-white py-3 rounded-lg shadow-lg hover:bg-blue-600 transition">Data Karyawan</a>
      <a href="data/absensi/tampil.php" class="block w-full text-center bg-green-500 text-white py-3 rounded-lg shadow-lg hover:bg-green-600 transition">Data Absensi</a>
      <a href="auth/logout.php" class="block w-full text-center bg-red-500 text-white py-3 rounded-lg hover:bg-red-600 transition">Logout</a>
    </div>
  </div>
</body>
</html>