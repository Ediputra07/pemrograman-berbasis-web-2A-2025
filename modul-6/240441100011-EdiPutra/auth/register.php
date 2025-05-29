<?php
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    
    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        echo "<p class='text-red-500'>Registrasi gagal: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Daftar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Registrasi</h2>
    <form method="POST" class="space-y-4">
      <div>
        <label for="username" class="block text-gray-700 mb-2">Username</label>
        <input type="text" name="username" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
      </div>
      <div>
        <label for="password" class="block text-gray-700 mb-2">Password</label>
        <input type="password" name="password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
      </div>
      <div>
        <label for="confirm_password" class="block text-gray-700 mb-2">Konfirmasi Password</label>
        <input type="password" name="confirm_password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
      </div>
      <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition">Daftar</button>
      <p class="text-center text-sm text-gray-600 mt-4">Sudah punya akun? <a href="login.php" class="text-blue-600 hover:underline">Login</a></p>
    </form>
  </div>
</body>
</html>