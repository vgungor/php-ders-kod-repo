<?php
$dosyaYolu = __DIR__ . "\dosyaYuklemeAlani\\okulJson.json";
$uzanti = pathinfo($dosyaYolu, PATHINFO_EXTENSION);

// 1. Uzantı Kontrolü
if ($uzanti == "json" || $uzanti == "txt") {

    // 2. Dosya var mı ve okunabilir mi?
    if (file_exists($dosyaYolu)) {
        
        // 3. Dosyayı okuma modunda ('r') aç
        $dosya = fopen($dosyaYolu, "r");

        echo "<h3>Dosya İçeriği (Satır Satır):</h3>";
        echo "<div style='background: #eee; padding: 10px;'>";

        // 4. feof (dosya sonuna gelene kadar) döngüye gir
        while (!feof($dosya)) {
            // Her seferinde bir satır oku
            $satir = fgets($dosya);
            echo htmlspecialchars($satir) . "<br>";
        }

        echo "</div>";

        // 5. Dosyayı kapat (Bellek yönetimi için önemli)
        fclose($dosya);

    } else {
        echo "Hata: Dosya bulunamadı.";
    }

} else {
    echo "Hata: Sadece .json veya .txt dosyaları kabul edilir.";
}
?>