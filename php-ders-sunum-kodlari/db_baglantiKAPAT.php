<?php
include "db_baglanti.php";
// Bağlantı Kapatma - db_baglantiKAPAT.php
if ($conn->close() === FALSE) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
else {
    echo "Bağlantı kapatıldı.<br>";
}
?>