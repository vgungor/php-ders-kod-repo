<?php
    echo "<h2 style='color:blue;'>
        Ozel Tür Dönüşümü (settype() Fonksiyonu):</h2>";  

    echo "<h3>settype() Fonksiyonu ile Tür Dönüşümü</h3>";
    $fiyat = "150.75";
    echo $fiyat . " Değişken tipi: " 
        . gettype($fiyat) 
        . "<br>"; // string
        
    settype($fiyat, "float");

    if (settype($fiyat, "float")) {
        echo "settype() fonksiyonu ile dönüşüm başarılı.<br>";
    }
    else {
        echo "settype() fonksiyonu ile dönüşüm başarısız.<br>";
    }

    echo "Yeni değer: $fiyat<br> vardump ile kontrol: ";
    var_dump($fiyat);

    echo "<hr>";

    //Boş string ("") ve null değerlerini 
    //boolean tipine dönüştürerek sonuçlarını var_dump() ile gösteriniz.

    $bos_string = "";
    $null_deger = null;

    settype($bos_string, "boolean");
    settype($null_deger, "boolean");

    echo "<h3>Boş String ve Null Değerlerin <b>SETTYPE</b> ile Boolean Tipine Dönüşümü:</h3>";
    echo "Boş string: ";
    var_dump($bos_string);
    echo "<br>";
    echo "Null değer: ";
    var_dump($null_deger);

    echo "<hr>";
    echo "<h3>Değer Döndüren Fonksiyonlar (intval, floatval, strval)</h3>";
    $sayi = "100";
    echo "Sayı: " . $sayi . " ilk atama değişken tipi: " 
        . gettype($sayi) . "<br>"; // string
    $sayiInt = intval($sayi); // Sonuç: 100 (Integer)
    $sayiFloat = floatval($sayi); // Sonuç: 100.0 (Float)
    $sayiStr = strval($sayi); // Sonuç: "100" (String)
    echo "Sayı: " . $sayi . " → Integer: " . $sayiInt . " → Float: " . $sayiFloat . " → String: " . $sayiStr;
    echo "<br>";

    echo "<hr>";
    echo "<h3>\"2026 yılı\" ifadesinden yılı sayısal 
    olarak elde ediniz.</h3>";    
    $veri = "2026 yılı";
    $yil_int = intval($veri); 
    // Sonuç: 2026 (çünkü "2026" sayısal olarak tanınır, "yılı" kısmı göz ardı edilir)
    echo "Veri: " . $veri . " → Yıl: " . $yil_int; // Veri: 2026 yılı → Yıl: 2026

    $yil_int_manual = (int)$veri; // Alternatif olarak (int) ile de dönüştürülebilir
    echo "<br>Alternatif (int) ile dönüştürme: " . $veri 
        . " → Yıl: " . $yil_int_manual; // Veri: 2026 yılı → Yıl: 2026
    echo "<hr>"; 


    
?>
