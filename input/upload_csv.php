<?php
include 'db.php';  // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv_file'])) {
    $file = $_FILES['csv_file'];

    // Cek apakah file yang di-upload adalah CSV
    if ($file['type'] == 'text/csv' || $file['type'] == 'application/vnd.ms-excel') {
        // Membaca file CSV
        if (($handle = fopen($file['tmp_name'], 'r')) !== FALSE) {
            // Mengabaikan baris pertama jika berisi header (opsional)
            $header = fgetcsv($handle);  // Jika ada header, kita bisa melewatkan baris pertama

            // Membaca setiap baris (nama siswa dan kelas)
            while (($data = fgetcsv($handle)) !== FALSE) {
                $name = $data[0];  // Nama siswa di kolom A
                $class = $data[1]; // Kelas siswa di kolom B

                // Memastikan bahwa kedua kolom ada isinya
                if (!empty($name) && !empty($class)) {
                    // Menyisipkan data siswa ke dalam tabel students
                    $stmt = $conn->prepare("INSERT INTO students (name, class) VALUES (?, ?)");
                    $stmt->bind_param("ss", $name, $class);
                    $stmt->execute();
                }
            }
            fclose($handle);
            echo "Data siswa berhasil diupload!";
        } else {
            echo "Tidak dapat membuka file CSV.";
        }
    } else {
        echo "Tolong upload file dalam format CSV.";
    }
} else {
    echo "File tidak ditemukan!";
}
?>