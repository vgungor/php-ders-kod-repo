<?php 
$sayi = rand(1, 100); // Dışarıda üretilen sayı

function testEt() {
    global $sayi; // global anahtar kelimesi ile dışarıdaki $sayi değişkenine erişiyoruz
    // Bu satır hata verir veya boş döner çünkü $sayi içeride tanımlı değil
    echo "Üretilen sayı: " . $sayi; 
}

testEt();
?>