<?php 
// 1. Adım: Dosya içeriğini string olarak al
$dosya = __DIR__ . "\dosyaYuklemeAlani\\okulJson.json";
$jsonMetni = file_get_contents($dosya);

// 2. Adım: Metni PHP İlişkili Dizisine (Associative Array) çevir
// İkinci parametre olan 'true' veriyi dizi olarak almamızı sağlar.
$ogrenciListesi = json_decode($jsonMetni, true);

// 3. Adım: Veriye erişim
echo "<h2>Öğrenci Listesi</h2>";
echo "<ul>";
foreach ($ogrenciListesi['ogrenciler'] as $ogrenci) {
    echo "<li><strong>" . $ogrenci['ad'] . " " . $ogrenci['soyad'] 
        . "</strong> - Bölüm: " . $ogrenci['bolum'] . "</li>";
}
echo "</ul>";
?>