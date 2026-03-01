<!DOCTYPE html>
<html>
<body>
    <h2>PHP Karşılaştırma Operatörleri Örnekleri</h2>

    <?php
    $sayi = 10;
    $metin = "10";
    $digerSayi = 15;

    echo "<b>Değişkenler:</b> \$sayi = 10 (int), \$metin = '10' (string), \$digerSayi = 15 <br><br>";

    // Eşittir ve Özdeştir Farkı
    echo "Eşittir (==) Kontrolü: ";
    var_dump($sayi == $metin); // Değerler aynı olduğu için true 
    echo "<br>";

    echo "Özdeştir (===) Kontrolü: ";
    var_dump($sayi === $metin); // Tipler farklı (int vs string) olduğu için false 
    echo "<br><br>";

    // Büyüklük/Küçüklük
    echo "10 > 15 Kontrolü (\$sayi > \$digerSayi): ";
    var_dump($sayi > $digerSayi);
    echo "<br>";

    echo "10 < 15 Kontrolü (\$sayi < \$digerSayi): ";
    var_dump($sayi < $digerSayi);
    echo "<br><br>";

    // Spaceship Operatörü
    echo "Spaceship (<=>) 10 ile 15: ";
    echo ($sayi <=> $digerSayi); // 10 < 15 olduğu için -1 
    ?>

</body>
</html>