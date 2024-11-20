<?php
session_start();

// Kode akses yang valid
$valid_code = "";

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
    <title>Upload Data Siswa</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Upload Data Siswa</h1>
        <form action="upload_csv.php" method="POST" enctype="multipart/form-data">
            <label for="csv_file">Pilih File CSV:</label>
            <input type="file" name="csv_file" id="csv_file" accept=".csv" required>
            <button type="submit">Upload File</button>
        </form>
    </div>
</body>
</html>