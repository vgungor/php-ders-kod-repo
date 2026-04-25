<?php
$dosya = __DIR__ . "\dosyaYuklemeAlani\\okulJson.json";
$uzanti = pathinfo($dosya, PATHINFO_EXTENSION);

// Uzantı kontrolü
if ($uzanti == "json" || $uzanti == "txt") {
    
    if (file_exists($dosya)) {
        // file() dosyayı satır satır diziye atar
        $satirlar = file($dosya);
        print_r($satirlar); // Dizi yapısını görmek için

        echo "<h3>Dosya İçeriği:</h3>";
        echo "<div style='border:1px solid #000; padding:10px;'>";
        
        // Dizi elemanlarını (satırları) ekrana yazdır
        foreach ($satirlar as $satirNo => $icerik) {
            echo "<strong>Satır " . ($satirNo + 1) 
                . ":</strong> " . htmlspecialchars($icerik) . "<br>";
        }
        
        echo "</div>";
    } else {
        echo "Dosya bulunamadı.";
    }

} else {
    echo "Sadece .json veya .txt dosyaları okunabilir.";
}
?>