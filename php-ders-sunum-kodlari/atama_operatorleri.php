<?php
$sayi = 20;

echo "Başlangıç değeri: $sayi <br>";

$sayi += 10; // $sayi = $sayi + 10; 
echo "10 ekleyince (+=): $sayi <br>";

$sayi -= 5;  // $sayi = $sayi - 5; 
echo "5 çıkarınca (-=): $sayi <br>";

$sayi *= 2;  // $sayi = $sayi * 2;
echo "2 ile çarpınca (*=): $sayi <br>";

$ad = "Emrah";
$ad .= " Yüksel"; // Metin birleştirme
echo "İsim birleştirme (.=): " . $ad;
?>