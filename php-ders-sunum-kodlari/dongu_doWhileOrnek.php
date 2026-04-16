<?php

echo "Do-While Döngüsü Örneği";
echo "Girilen sayı 5'ten büyük olduğu sürece tekrar sayı girmesi istenir.";

do {
    $sayi = (int) readline("Sayı giriniz: ");
} while ($sayi > 5);

echo "Girilen sayı: " . $sayi;
if ($sayi <= 5) {
    echo "Sayı 5 veya daha küçük.";
}


?>