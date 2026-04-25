<?php 
include "db_baglanti.php";

$sql = "SELECT ogrenci_id, ogrenci_no, ad, soyad FROM ogrenciler";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Her bir satırı döngüyle al
    while($row = $result->fetch_assoc()) {
        echo "Id: " . $row["ogrenci_id"]
            . " - Ogrenci No: " . $row["ogrenci_no"]
            . " - Ad: " . $row["ad"]
            . " " . $row["soyad"]. "<br>";
    }
} else {
    echo "Sonuç bulunamadı.";
}
?>