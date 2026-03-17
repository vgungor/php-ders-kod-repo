<?php 
$yas = 18;

if ($yas >= 18) {
    $durum = "Ehliyet alabilir.";
} else {
    $durum = "Yaşı yetmiyor.";
}
echo $durum . "<br>";


$durum = ($yas >= 18) ? "Ehliyet alabilir." : "Yaşı yetmiyor.";
echo $durum;

?>

<?php $stokMiktari = 5; ?>

<p style="color: <?php 
    echo ($stokMiktari < 10) ? 'red' : 'green'; 
    ?>;">
    Mevcut Stok: <?php echo $stokMiktari; ?>
</p>

<?php
// Eğer $_GET['isim'] yoksa 'Ziyaretçi' yazdır
$kullanici = $_GET['isim'] ?? "Ziyaretçi";
echo "Merhaba $kullanici";
?>kontrol_iciceİ<f class="php"></f>