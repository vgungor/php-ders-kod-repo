<?php
// --- 1. UYGUN OLAN TANIMLAMALAR ---
// Harf ile başlar, standart kurallara tam uyar.
$randevuID = 101; 

// Alt çizgi ile başlayabilir, bu da geçerli bir kuraldır.
$_musteri = "Volkan"; 

// İçinde sayı barındırabilir (sadece başında olamaz).
$fiyat_2026 = 250.50; 


// --- 2. UYGUN OLMAYAN TANIMLAMALAR ---
// (Bu satırların başındaki // işaretini kaldırırsanız kod hata verir)

// $2randevu = "14:30";   // HATA: Sayı ile başlayamaz.
// $toplam-tutar = 500;   // HATA: Tire (-) matematiksel operatör (çıkarma) algılanır.
// $ad soyad = "Mustafa"; // HATA: Değişken adında boşluk olamaz.


// --- 3. RİSKLİ TANIMLAMALAR ---
// Teknik olarak çalışır ama dosya kodlamasına göre bozulma riski taşır.
$değişken = "Türkçe karakter kullanımı"; 


// --- ÇIKTI ALANI ---
// PHP'nin HTML içine gömülebilme özelliğini kullanarak sonuçları görelim.
echo "<h1>Randevu Bilgileri</h1>";
echo "ID: " . $randevuID . "<br>";
echo "Müşteri: " . $_musteri . "<br>";
echo "Ücret: " . $fiyat_2026 . " TL<br>";
echo "Not: " . $değişken;
?>

<?php 
# Hatalı değişken tanımlaması.
// $8 = 9; 
?>

<?php 
// echo  $8; 
?>