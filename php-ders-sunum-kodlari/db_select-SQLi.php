<?php 
include "db_baglanti.php";

$ad = "Volkan"; //formdan gelsin

$stmt = $conn->prepare(
    "SELECT * FROM ogrenciler
     WHERE ad = ?");

$stmt->bind_param("s", $ad);
$stmt->execute();
$result = $stmt->get_result();


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