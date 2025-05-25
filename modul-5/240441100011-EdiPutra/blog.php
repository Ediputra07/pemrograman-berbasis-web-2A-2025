<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Reflektif</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8">
        <?php
        // Array artikel
        $artikel = [
        1 => [
            'judul'   => 'Perkuliahan Awal Semester',
            'tanggal' => '01-08-2024',
            'isi'     => 'Pada minggu pertama, saya menyesuaikan diri dengan ritme perkuliahan dan mulai memahami materinya. Tantangan utamanya adalah membagi waktu antara tugas dan adaptasi lingkungan kampus.',
            'gambar'  => './img/artikel1.png',
            'sumber'  => 'https://iti.ac.id/manajemen-waktu-mahasiswa'
        ],
        2 => [
            'judul'   => 'Pengalaman Pertama Praktikum',
            'tanggal' => '06-09-2024',
            'isi'     => 'Saya sangat bingung sekaligus senang karena akhirnya inilah saya merasakan belajar coding serta mempelajari pemrograman melalui bahasa Python.',
            'gambar'  => './img/artikel2.jpg',
            'sumber'  => ''
        ],
        3 => [
            'judul'   => 'Praktikum Kedua, Dua Praktikum',
            'tanggal' => '14-03-2025',
            'isi'     => 'Pengalaman kedua awalnya siap dengan praktikum, tapi ketika ada double praktikum langsung down.',
            'gambar'  => './img/artikel3.jpg',
            'sumber'  => ''
        ]
        ];
        // Array kutipan
        $kutipan = [
        'Kesuksesan dimulai dari kegagalan yang tidak berhenti dicoba kembali.',
        'Belajar hari ini adalah investasi untuk masa depan yang lebih baik.',
        'Setiap baris kode adalah peluang untuk menciptakan sesuatu yang bermanfaat.'
        ];
        // Ambil ID dari GET
        $id    = isset($_GET['id']) ? (int)$_GET['id'] : null;
        $minId = min(array_keys($artikel));
        $maxId = max(array_keys($artikel));

        if ($id && isset($artikel[$id])) {
        // Detail artikel
        $a = $artikel[$id];
        echo '<h1 class="text-2xl font-bold mb-2">' . $a['judul'] . '</h1>';
        echo '<p class="text-gray-600 italic mb-4">' . $a['tanggal'] . '</p>';
        echo '<p class="mb-6">' . $a['isi'] . '</p>';
        echo '<img src="' . $a['gambar'] . '" alt="Ilustrasi" class="w-full max-h-[300px] object-cover rounded-lg shadow-md mb-6 hover:shadow-xl hover:scale-[1.03] transition duration-500 ease-in-out">';
        // Cetak kutipan random dengan fungsi sendiri
        function tampilkanKutipan($list) {
            return $list[array_rand($list)];
        }
        echo '<p class="font-semibold text-blue-700 mb-4">"' . tampilkanKutipan($kutipan) . '"</p>';
        if (!empty($a['sumber'])) {
            echo '<p><a href="' . $a['sumber'] . '" target="_blank" class="text-blue-500 underline">Sumber Referensi</a></p>';
        }

        // Navigasi sebelumnya, daftar, dan berikutnya
        echo '<div class="mt-8 flex justify-between">';
        if ($id > $minId) {
            $prev = $id - 1;
            echo '<a href="blog.php?id=' . $prev . '" class="bg-gray-200 px-4 py-2 rounded-full shadow-md hover:shadow-lg hover:bg-gray-300 hover:scale-[1.05] transition duration-500 ease-in-out">Sebelumnya</a>';
        } else {
            echo '<span></span>';
        }
        // Kembali ke daftar
        echo '<a href="blog.php" class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-md hover:shadow-lg hover:bg-blue-600 hover:scale-[1.05] transition duration-500 ease-in-out">Kembali ke Daftar</a>';
        if ($id < $maxId) {
            $next = $id + 1;
            echo '<a href="blog.php?id=' . $next . '" class="bg-gray-200 px-4 py-2 rounded-full shadow-md hover:shadow-lg hover:bg-gray-300 hover:scale-[1.05] transition duration-500 ease-in-out">Berikutnya</a>';
        }
        echo '</div>';

        } else {
        // Daftar artikel
        echo '<h1 class="text-3xl font-bold mb-6">Daftar Artikel Blog Reflektif</h1>';
        foreach ($artikel as $key => $a) {
            echo '<div class="mb-4">';
            echo '<a href="blog.php?id=' . $key . '" class="text-xl text-blue-600 hover:underline">' . $a['judul'] . '</a>';
            echo '<p class="text-gray-500 italic">' . $a['tanggal'] . '</p>';
            echo '</div>';
        }
        // tombol ke timeline
        echo '<div class="mt-8">';
        echo '<button class="bg-green-500 text-white px-4 py-2 rounded-full shadow-md hover:shadow-lg hover:bg-green-600 hover:scale-[1.05] transition duration-500 ease-in-out"><a href="timeline.php">Kembali ke Timeline Kuliah</a></button>';
        echo '</div>';
        }
        ?>
    </div>
</body>
</html>