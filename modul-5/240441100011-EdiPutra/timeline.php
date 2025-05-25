<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Pengalaman Kuliah</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8">
        <div class="relative border-l-4 border-blue-500">
            <?php
            // Array data
            $pengalaman = [
                ["tahun" => "Agustus 2024", "kegiatan" => "Mulai perkuliahan masih dalam suasana ospek dari yang universitas yaitu Sakera, Fakultas Pesona, serta Prodi Proksi sehingga masih dalam tahap adaptasi dengan suasana perkuliahan."],
                ["tahun" => "September 2024", "kegiatan" => "Mulai praktikum Algoritma Pemrograman dan mengenal dasar Pemrograman menggunakan bahasa pemograman Python. Diadakan setiap hari Rabu dan asistensi setiap minggunya dari modul 1 hingga modul 7 serta ada projek akhir."],
                ["tahun" => "Februari 2025", "kegiatan" => "Kembali ke perkuliahan setelah libur panjang selama tahun baru, mulai beradaptasi dengan mata kuliah serta lebih giat mengerjakan tugasnya."],
                ["tahun" => "Maret 2025", "kegiatan" => "Praktikum lagi di semester 2 yaitu pemrograman berbasis objek dan pemrograman berbasis web dengan jadwal praktikum serta asistensinya masing-masing."]
            ];
            // Fungsi sendiri
            function tampilkanPengalaman($data) {
                foreach ($data as $event) {
                    echo '<div class="bg-blue-50 mb-8 ml-6 rounded-lg">';
                    echo '<span class="absolute top-1 -left-3 w-6 h-6 bg-blue-500 rounded-full border-2 border-white hover:bg-blue-600 transition duration-500 ease-in-out"></span>';
                    echo '<h2 class="text-xl font-semibold px-2 pt-2 mb-1">' . $event['tahun'] . '</h2>';
                    echo '<p class="text-gray-700 px-2 pb-2">' . $event['kegiatan'] . '</p>';
                    echo '</div>';
                }
            }
            tampilkanPengalaman($pengalaman);
            ?>
        </div>
        <!-- navigasi ke profil dan blog -->
        <div class="mt-8 flex justify-between">
            <!-- profil -->
            <button class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-md hover:shadow-lg hover:bg-blue-600 hover:scale-[1.05] transition duration-500 ease-in-out">
                <a href="index.php">Kembali ke Profil</a>
            </button>
            <!-- blog -->
            <button class="bg-green-500 text-white px-4 py-2 rounded-full shadow-md hover:shadow-lg hover:bg-green-600 hover:scale-[1.05] transition duration-500 ease-in-out">
                <a href="blog.php">Menuju Blog</a>
            </button>
        </div>
    </div>
</body>
</html>