<?php

//BU KODU TERMİNALDEN ÇALIŞTIRINIZ
//DOSYA LİNKİNE GİDEREK php dongu_whileSoru.php komutu ile çalışır.

$toplam = 0;
$adet = 0;

$sayi = 1; // başlangıç (0'dan farklı olmalı)

while ($sayi != 0) {

    $sayi = (int) readline("Sayı giriniz (0 çıkış): ");

    if ($sayi > 0) {
        $toplam += $sayi;
        $adet++;
    } 
    else if ($sayi < 0) {
        echo "Negatif sayı kabul edilmez!\n";
    }
}

echo "Toplam: " . $toplam . "\n";
echo "Geçerli sayı adedi: " . $adet;

?>