<?php
// Okunacak dosya adı (Örn: formdan gelebilir veya manuel yazılabilir)
$dosyaAdi = "okulJson.json"; 
$dizin = __DIR__ . "\dosyaYuklemeAlani\\";
$dosyaYolu = $dizin . $dosyaAdi;

// Uzantıyı kontrol et
$uzanti = pathinfo($dosyaYolu, PATHINFO_EXTENSION);

if ($uzanti == "json" || $uzanti == "txt") {
    if (file_exists($dosyaYolu)) {
        // İçeriği oku
        $icerik = file_get_contents($dosyaYolu);
        
        // HTML içinde göster
        echo "<h3>Dosya İçeriği ($dosyaAdi):</h3>";
        echo "<pre>" . htmlspecialchars($icerik) . "</pre>";
    } else {
        echo "Hata: Dosya bulunamadı.";
    }
} else {
    echo "Hata: Sadece .json veya .txt dosyaları okunabilir.";
}
?>