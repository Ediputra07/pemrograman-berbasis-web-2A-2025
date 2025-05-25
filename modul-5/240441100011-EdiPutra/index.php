<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Interaktif Mahasiswa</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="p-6 bg-gray-100">
    <div class="max-w-3xl mx-auto">
        <div class="flex flex-col md:flex-row justify-center items-center gap-8 p-8 bg-white rounded-lg shadow-md mb-6">
            <!-- foto profil -->
            <img src="./img/profil.jpg" class="w-40 h-40 object-cover rounded-full shadow-md ring-4 ring-blue-300 hover:scale-[1.05] transition duration-500 ease-in-out hover:shadow-lg" alt="Foto Profil">
            <!-- tabel -->
            <table class="border shadow-md hover:scale-[1.05] transition duration-500 ease-in-out hover:shadow-lg">
                <tr><th class="border px-4 py-2 bg-blue-100">Nama</th><td class="border px-4 py-2">Edi Putra</td></tr>
                <tr><th class="border px-4 py-2 bg-blue-100">NIM</th><td class="border px-4 py-2">240441100011</td></tr>
                <tr><th class="border px-4 py-2 bg-blue-100">Tempat, Tanggal Lahir</th><td class="border px-4 py-2">Bangkalan, 12 April 2007</td></tr>
                <tr><th class="border px-4 py-2 bg-blue-100">Email</th><td class="border px-4 py-2">edi075412@gmail.com</td></tr>
                <tr><th class="border px-4 py-2 bg-blue-100">Nomor HP</th><td class="border px-4 py-2">081234276246</td></tr>
            </table>
        </div>
        <!-- form -->
        <div class="max-w-3xl mx-auto">
            <form method="POST" class="bg-gray-50 py-8 px-18 rounded-lg shadow-md space-y-6">
                <!-- bahasa pemograman -->
                <div>
                    <label class="font-medium">Bahasa Pemrograman yang Dikuasai:</label>
                    <input class="block border px-2 py-1 mt-1 w-full rounded-lg shadow-lg border-2 border-blue-300 focus:outline-blue-600" name="bahasa[]" type="text">
                    <input class="block border px-2 py-1 mt-1 w-full rounded-lg shadow-lg border-2 border-blue-300 focus:outline-blue-600" name="bahasa[]" type="text">
                    <input class="block border px-2 py-1 mt-1 w-full rounded-lg shadow-lg border-2 border-blue-300 focus:outline-blue-600" name="bahasa[]" type="text">
                </div>
                <!-- pengalaman -->
                <div>
                    <label class="font-medium">Pengalaman Proyek Pribadi:</label>
                    <textarea name="pengalaman" class="block border px-2 py-1 mt-1 w-full rounded-lg shadow-lg border-2 border-blue-300 focus:outline-blue-600"></textarea>
                </div>
                <!-- software -->
                <div>
                    <label class="font-medium">Software yang Sering Digunakan:</label><br>
                    <label class='inline-block mr-4'><input type='checkbox' name='software[]' value='VS Code'> VS Code</label>
                    <label class='inline-block mr-4'><input type='checkbox' name='software[]' value='XAMPP'> XAMPP</label>
                    <label class='inline-block mr-4'><input type='checkbox' name='software[]' value='Git'> Git</label>
                </div>
                <!-- os -->
                <div>
                    <label class="font-medium">Sistem Operasi:</label><br>
                    <label class='inline-block mr-4'><input type='radio' name='os' value='Windows'> Windows</label>
                    <label class='inline-block mr-4'><input type='radio' name='os' value='Linux'> Linux</label>
                    <label class='inline-block mr-4'><input type='radio' name='os' value='Mac'> Mac</label>
                </div>
                <!-- php skill -->
                <div>
                    <label class="font-medium">Tingkat Penguasaan PHP:</label>
                    <select name="tingkat" class="block border px-2 py-1 mt-1 w-full rounded-lg shadow-lg border-2 border-blue-300 focus:outline-blue-600">
                        <option value="">-- Pilih --</option>
                        <option value="Pemula">Pemula</option>
                        <option value="Menengah">Menengah</option>
                        <option value="Mahir">Mahir</option>
                    </select>
                </div>
                <!-- kirim -->
                <input type="submit" name="submit" value="Kirim" class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-600 rounded-xl shadow-md hover:shadow-lg hover:scale-[1.05] transition duration-500 ease-in-out">
            </form>
        </div>
        <!-- php -->
        <?php
        function tampilkanData($bahasa, $software, $os, $tingkat, $pengalaman) {
            echo "<div class='mt-6 bg-slate-200 p-4 shadow-lg rounded-lg'>";
            echo "<h2 class='text-xl font-semibold mb-2'>Hasil Input:</h2>";
            echo "<table class='table-auto border border-gray-400 mb-4'>";
            echo "<tr><th class='border px-4 py-2'>Bahasa</th><td class='border px-4 py-2'>" . implode(", ", array_filter($bahasa)) . "</td></tr>";
            echo "<tr><th class='border px-4 py-2'>Software</th><td class='border px-4 py-2'>" . implode(", ", $software) . "</td></tr>";
            echo "<tr><th class='border px-4 py-2'>OS</th><td class='border px-4 py-2'>$os</td></tr>";
            echo "<tr><th class='border px-4 py-2'>Tingkat PHP</th><td class='border px-4 py-2'>$tingkat</td></tr>";
            echo "</table>";
            echo "<p><strong>Pengalaman:</strong> $pengalaman</p>";
            if (count(array_filter($bahasa)) > 2) {
                echo "<p class='mt-2 text-green-600'>Anda cukup berpengalaman dalam pemrograman!</p>";
            }
            echo "</div>";
        }

        if (isset($_POST['submit'])) {
            $bahasa = $_POST['bahasa'];
            $pengalaman = $_POST['pengalaman'];
            $software = $_POST['software'] ?? [];
            $os = $_POST['os'] ?? '';
            $tingkat = $_POST['tingkat'];
            if (empty(array_filter($bahasa)) || empty($pengalaman) || empty($software) || empty($os) || empty($tingkat)) {
                echo "<p class='text-red-600 mt-4'>Semua isian wajib diisi!</p>";
            } else {
                tampilkanData($bahasa, $software, $os, $tingkat, $pengalaman);
            }
        }
        ?>
        <!-- tombol ke timeline kuliah -->
        <button class="my-6 bg-blue-500 text-white px-4 py-2 rounded-full shadow-md hover:shadow-lg hover:bg-blue-600 hover:scale-[1.05] transition duration-500 ease-in-out">
            <a href="timeline.php">Menuju Timeline Kuliah</a>
        </button>
    </div>
</body>
</html>