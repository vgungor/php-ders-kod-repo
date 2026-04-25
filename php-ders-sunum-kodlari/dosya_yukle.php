<?php
// yukle.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo "Dosya Adı: " . $_FILES["kullanici_dosyasi"]["name"] . "<br>";
    echo "Dosya Boyutu: " . $_FILES["kullanici_dosyasi"]["size"] . " bytes<br>";
    echo "Dosya Türü: " . $_FILES["kullanici_dosyasi"]["type"] . "<br>";
    echo "Geçici Konum: " . $_FILES["kullanici_dosyasi"]["tmp_name"] . "<br>";
    echo "Hata Kodu: " . $_FILES["kullanici_dosyasi"]["error"] . "<br>";
    echo "<hr>";

    echo "Dosya Yükleme İşlemi Başladı...<br>";
    // echo __DIR__; // __DIR__ si dosyanın bulunduğu klasörün yolunu verir
    $dizin = __DIR__ . "\dosyaYuklemeAlani\\"; // __DIR__ dosyanın olduğu klasörü verir
    // echo "Hedef Klasör: " . $dizin . "<br>";

    $hedef_klasor = $dizin . basename($_FILES['kullanici_dosyasi']['name']);
    echo "Hedef Dosya Yolu: " . $hedef_klasor . "<br>";

    // Güvenlik Kontrolü: Sadece TXT dosyalarına izin verelim
    // Dosya uzantısını kontrol et
    $dosyaTipi = strtolower(pathinfo($hedef_klasor, PATHINFO_EXTENSION));
    echo "Dosya Uzantısı: " . $dosyaTipi . "<br>";

    if ($dosyaTipi != "txt" && $dosyaTipi != "json" || $_FILES["kullanici_dosyasi"]["size"] > 500000) {
        echo "Hata: Sadece .txt ve .json uzantılı ve boyutu 500KB'dan küçük dosyalara izin var!";
    } else {
        // Dosyayı geçici konumdan hedef konuma taşı
        if (move_uploaded_file($_FILES["kullanici_dosyasi"]["tmp_name"], $hedef_klasor)) {
            echo $hedef_klasor . " klasörüne dosya başarıyla yüklendi: " . $_FILES["kullanici_dosyasi"]["name"];
        } else {
            echo "Bir hata oluştu.";
        }
    }
}
?>