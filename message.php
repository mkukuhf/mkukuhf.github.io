<?php

function displayBarang() {
    // Ganti informasi koneksi database sesuai dengan database Anda
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'db_contact';

    // Membuat koneksi ke database
    $conn = new mysqli($host, $username, $password, $database);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Mengambil data dari tabel berdasarkan pencarian
    $nama = isset($_GET['nama']) ? $_GET['nama'] : '';
    $email = isset($_GET['email']) ? $_GET['email'] : '';
    $nomor = isset($_GET['nomor']) ? $_GET['nomor'] : '';
    $pesan = isset($_GET['pesan']) ? $_GET['pesan'] : '';

    $sql = "SELECT nama, email, nomor, pesan FROM tbl_psn 
            WHERE nama LIKE '%$nama%' AND email LIKE '%$email%' 
            AND nomor LIKE '%$nomor%' AND pesan LIKE '%$pesan%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Menampilkan tabel HTML jika terdapat data dalam tabel
        echo "<table>";
        echo "<thead><tr><th>Nama</th><th>Email</th><th>Nomor Handphone</th><th>Pesan</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nama"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["nomor"] . "</td>";
            echo "<td>" . $row["pesan"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "Tidak ada data dalam tabel.";
    }

    // Menutup koneksi database
    $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pesan Contact</title>
    <link rel="stylesheet" href="pesan.css">
</head>

<body>
    <h1>Data Pesan</h1>
    <?php
        displayBarang();
    ?>
    <button onclick="location.href='index.html'">Go to Index</button>
</body>
</html>
