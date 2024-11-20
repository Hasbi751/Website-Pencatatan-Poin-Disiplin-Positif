<?php
include 'db.php';

$student_id = $_POST['student_id'];
$duties = $_POST['duties'];
$date = date('Y-m-d');

if (isset($duties) && !empty($duties)) {
    foreach ($duties as $duty_id) {
        $sql = "INSERT INTO points (student_id, duty_id, date) VALUES ('$student_id', '$duty_id', '$date')";
        $conn->query($sql);
    }
    echo "Poin berhasil ditambahkan untuk siswa!";
} else {
    echo "Tidak ada kriteria yang dipilih!";
}
?>

<br><br>
<a href="index.php">Kembali</a>