<?php
session_start();

// Kode akses yang valid
$valid_code = "DPs111***";

// Mengecek apakah pengguna sudah login atau belum
if (!isset($_SESSION['logged_in'])) {
    if (isset($_POST['access_code']) && $_POST['access_code'] === $valid_code) {
        // Jika kode benar, simpan session dan redirect ke halaman utama
        $_SESSION['logged_in'] = true;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Jika kode salah atau belum dimasukkan, tampilkan form input kode akses
        echo '<form action="" method="POST" style="text-align:center; margin-top: 20%;">
                <h2>Masukkan Kode Akses</h2>
                <input type="password" name="access_code" placeholder="Kode Akses" required>
                <button type="submit">Masuk</button>
              </form>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Poin Duta Disiplin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Pencatatan Poin Duta Disiplin Positif</h1>
        <form action="add_points.php" method="POST">
            <div class="search-container">
                <input type="text" id="studentSearch" placeholder="Cari Nama Siswa..." onkeyup="searchStudent()">
                <select name="student_id" id="studentList" required>
                    <option value="" disabled selected>Pilih Siswa</option>
                    <?php
                    include 'db.php';
                    $result = $conn->query("SELECT id, name, class FROM students ORDER BY name ASC");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['name']} - Kelas {$row['class']}</option>";
                    }
                    ?>
                </select>
            </div>

            <h3>Pilih Kriteria Poin yang Ingin Ditambahkan</h3>
            <div class="checkboxes">
                <?php
                $result = $conn->query("SELECT id, description FROM duties");
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <label>
                        <input type='checkbox' name='duties[]' value='{$row['id']}'> 
                        {$row['description']}
                    </label>";
                }
                ?>
            </div>

            <!-- Tombol Aksi -->
            <div class="button-group">
                <button type="submit">Tambah Poin</button>
                <a href="leaderboard.php" class="view-leaderboard">Lihat Leaderboard</a>
            </div>
        </form>
    </div>

    <script>
        // Fungsi untuk mencari nama siswa
        function searchStudent() {
            let input = document.getElementById('studentSearch').value.toLowerCase();
            let options = document.getElementById('studentList').options;
            for (let i = 0; i < options.length; i++) {
                let optionText = options[i].text.toLowerCase();
                options[i].style.display = optionText.includes(input) ? '' : 'none';
            }
        }
    </script>
</body>
</html>