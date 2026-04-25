<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "okul_db";

$conn = new mysqli($host, $user, $password, $database);

// Hata kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

echo "Bağlantı başarılı! - db_baglanti.php sayfası include edildi.<br>";
?>