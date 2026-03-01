<?php
$sayi = 10;

echo "Başlangıç: " . $sayi . "<br>";    // 10

// Önce artırma akışı
echo "Önce artır (++$sayi): " . ++$sayi . "<br>"; // Ekranda 11 görürüz.

// Sonradan artırma akışı
echo "Sonra artır ($sayi++): " . $sayi++ . "<br>"; // Ekranda hala 11 görürüz (çünkü işlemden sonra artacak).
echo "Artırma sonrası son durum: " . $sayi . "<br>"; // Şimdi 12 olduğunu görürüz.

// Azaltma akışı
echo "Önce azalt (--$sayi): " . --$sayi; // Ekranda 11 görürüz.
?>