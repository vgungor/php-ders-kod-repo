<?php
include "db_baglanti.php";

$sql = "INSERT INTO ogrenciler (ad, soyad, email, kayit_tarihi) 
    VALUES ('Ali', 'Veli', 'ali@veli.com', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "Kayıt eklendi";
} else {
    echo "Hata: " . $conn->error;
}
?>