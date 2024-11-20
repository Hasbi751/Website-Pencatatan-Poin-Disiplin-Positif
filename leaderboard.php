<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Leaderboard Poin Bulanan</h1>
        <table>
            <tr>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Total Poin</th>
            </tr>
            <?php
            include 'db.php';
            $current_month = date('m');
            $current_year = date('Y');

            $sql = "SELECT s.name, s.class, SUM(p.point) AS total_points 
                    FROM points p 
                    JOIN students s ON p.student_id = s.id 
                    WHERE MONTH(p.date) = '$current_month' AND YEAR(p.date) = '$current_year' 
                    GROUP BY p.student_id 
                    ORDER BY total_points DESC 
                    LIMIT 5";

            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['class']}</td>
                        <td>{$row['total_points']}</td>
                      </tr>";
            }
            ?>
        </table>
        <a href="index.php" class="back-btn">Kembali</a>
    </div>
</body>
</html>