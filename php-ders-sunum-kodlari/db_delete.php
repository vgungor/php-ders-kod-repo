<?php 
include "db_baglanti.php";

$sql = "DELETE FROM ogrenciler 
    WHERE ogrenci_id=5";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo "Kayıt silindi";
} else {
    echo "Hata: " . $conn->error;
}
?>