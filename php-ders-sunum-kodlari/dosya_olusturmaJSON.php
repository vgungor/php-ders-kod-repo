<?php 
$sonuclar = [
    ["no" => "202401", "ort" => 85, "harf" => "BA"],
    ["no" => "202402", "ort" => 45, "harf" => "FF"]
];

$dosya = __DIR__ . "\dosyaYuklemeAlani\\donem_sonu.json";

// PHP dizisini JSON metnine dönüştür
// JSON_PRETTY_PRINT: Dosyanın okunabilir (girintili) olmasını sağlar
// JSON_UNESCAPED_UNICODE: Türkçe karakterlerin bozulmasını önler
$jsonCiktisi = json_encode($sonuclar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// Veriyi dosyaya kaydet
file_put_contents($dosya, $jsonCiktisi);
?>