<?php 
include "db_baglanti.php";

try { 
    $sql = "UPDATE ogrenciler 
        SET ogrenci_no='20250010' 
        WHERE ogrenci_id=5";

    if ($conn->query($sql) === TRUE) {
    echo "Kayıt güncellendi";
    } else {
        echo "Hata: " . $conn->error;
    }

} catch (Exception $e) {
    echo "Hata: " . $e->getMessage();
}
?>