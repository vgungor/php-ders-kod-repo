<?php
    // settype() Fonksiyonu
    echo "<h2 style='color:blue;'>Ozel Tür Dönüşümü (settype() Fonksiyonu):</h2>";
    echo "<h3>settype() Fonksiyonu ile Tür Dönüşümü</h3>";
    $fiyat = "150.75";
    echo $fiyat . " Değişken tipi: " . gettype($fiyat) . "<br>"; // string
    var_dump($fiyat); // string(6) "150.75"
    echo "<pre> settype($fiyat, \"float\"); </pre>";
    settype($fiyat, "float");

    echo "Dönüş değerine göre kontrol";
    if (settype($fiyat, "float")) {
        echo "settype() fonksiyonu ile dönüşüm başarılı.<br>";
    }
    else {
        echo "settype() fonksiyonu ile dönüşüm başarısız.<br>";
    }

    echo "<hr>";
    //NE yapar??
    $var = "";
    settype($var, 'bool');
    var_dump($var); 
    echo "<br>";
    $var2 = null;
    settype($var2, 'bool');
    var_dump($var); 

    echo "<hr>";
    
    // $fiyat değişkeni artık kalıcı olarak float tipindedir.
    echo $fiyat . " Değişken tipi: " . gettype($fiyat) . "<br>"; // float
    var_dump($fiyat); // float(150.75)

    //Değer Döndüren Fonksiyonlar (intval, floatval, strval)
    echo "<h3>Değer Döndüren Fonksiyonlar (intval, floatval, strval)</h3>";
    $sayi = "100"; 
    echo "Sayı: " . $sayi . " ilk atama değişken tipi: " . gettype($sayi) . "<br>"; // string
    $sayiInt = intval($sayi); // Sonuç: 100 (Integer)
    $sayiFloat = floatval($sayi); // Sonuç: 100.0 (Float)
    $sayiStr = strval($sayi); // Sonuç: "100" (String)
    echo "Sayı: " . $sayi . " → Integer: " . $sayiInt . " → Float: " . $sayiFloat . " → String: " . $sayiStr;
    echo "<br>";
    var_dump($sayi); // string(3) "100"
    echo " → ";
    var_dump($sayiInt); // int(100) 
    echo " → ";
    var_dump($sayiFloat); // float(100)
    echo " → ";
    var_dump($sayiStr); // string(3) "100"
    
    echo "<br>";
    $veri = "2026 yılı";
    $yil = intval($veri); // Sonuç: 0 (çünkü "yılı" bir sayısal değer değil)
    // $veri hala "yılı" (string) olarak kalır.
    echo "Veri: " . $veri . " → Yıl: " . $yil; // Veri: yılı → Yıl: 
    echo "<br>";
    $veri = "yılı";
    $yil = intval($veri); // Sonuç: 0 (çünkü "yılı" bir sayısal değer değil)
    // $veri hala "yılı" (string) olarak kalır.
    echo "Veri: " . $veri . " → Yıl: " . $yil; // Veri: yılı → Yıl: 0
    echo "<br>";
    var_dump($veri); // string(9) "2026 yılı"
    echo " → ";
    var_dump($yil); // int(2026)
?>