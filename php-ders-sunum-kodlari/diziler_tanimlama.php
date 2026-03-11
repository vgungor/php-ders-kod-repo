<?php
// Sunumdaki örnek: Hizmetler dizisi 
$hizmetler = array(
    "Saç Kesimi", 
    "Sakal Tıraşı", 
    "Cilt Bakımı");

//alternatif tanımlama yöntemi (kısa dizi sözdizimi)
$meyveler = ["Elma", "Armut", "Muz", "Çilek"];

echo $meyveler; // Dizi doğrudan ekrana yazdırılamaz, bu bir hata verecektir.

/* Dizinin yapısını incelemek için var_dump kullanılır
veya print_r kullanılabilir. 
var_dump daha detaylı bilgi verir (tip ve uzunluk gibi), 
print_r ise daha okunabilir bir formatta gösterir. */
echo "<h2>Hizmetler Dizisi Yapısı:</h2>";
var_dump($hizmetler);
echo "<br><br>";
echo "<h2>Hizmetler Dizisi İçeriği:</h2>";
print_r($hizmetler);
echo "<br><br>";
echo "<h2>Meyveler Dizisi Yapısı:</h2>";    
echo "<h2>Meyveler Dizisi İçeriği:</h2>";
print_r($meyveler);
?>

<!DOCTYPE html>
<html>
<body>
    <?php
        // Sunumdaki örnek: Hizmetler dizisi 
        $hizmetler = array(
            "Saç Kesimi", 
            "Sakal Tıraşı", 
            "Cilt Bakımı");

        //alternatif tanımlama yöntemi (kısa dizi sözdizimi)
        $meyveler = ["Elma", "Armut", "Muz", "Çilek"];
    ?>

    <?php echo $hizmetler;?>
</body>
</html>