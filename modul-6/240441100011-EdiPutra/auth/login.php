<?php
session_start();
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $user['username'];
            header("Location: ../dashboard.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
    <div class="flex justify-center items-center mb-6">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-fil mr-2" viewBox="0 0 16 16">
        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
      </svg>
      <h2 class="text-2xl font-bold text-center text-gray-800">Login</h2>
    </div>
    <form method="POST" id="loginForm" class="space-y-4">
      <div>
        <label for="username" class="block text-gray-700 mb-2">Username</label>
        <input type="text" name="username" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
      </div>
      <div id="LoginError">
        <label for="password" class="block text-gray-700 mb-2">Password</label>
        <input type="password" name="password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Login</button>
      <p class="text-center text-sm text-gray-600 mt-4">Belum punya akun? <a href="register.php" class="text-green-600 hover:underline">Daftar</a></p>
    </form>
  </div>
</body>
</html>