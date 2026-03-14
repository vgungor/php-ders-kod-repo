<?php

// Bir kullanıcı profili dizisi (Associative Array)
$kullanici = [
    "ad" => "Volkan",
    "soyad" => "Gungor",
    "sehir" => "Izmir",
    "rol" => "Developer"
];
echo "<pre>";
// 1. COUNT(): Dizide toplam kaç bilgi (eleman) var?
echo count($kullanici) . " adet bilgi alanı var.<br>"; 
// 4
// 2. ARRAY_KEYS(): Sadece hangi kategorilerin (anahtarların) olduğunu alalım
print_r(array_keys($kullanici)); 
// ["ad", "soyad", "sehir", "rol"]
echo "<br>";
// 3. ARRAY_VALUES(): Sadece değerleri alalım (anahtarları atar, indisleri 0'dan başlatır)
print_r(array_values($kullanici)); 
// ["Volkan", "Gungor", "Izmir", "Developer"]
echo "</pre>";
?>