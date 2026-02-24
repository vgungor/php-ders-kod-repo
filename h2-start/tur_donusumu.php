<?php
//Otomatik Tür Dönüşümü (Type Juggling)
    echo "<h2 style='color:blue;'>Otomatik Tür Dönüşümü (Type Juggling):</h2>";
    $sayi = 5;       // Integer
    $metin = "10";   // String
    $sonuc = $sayi + $metin; // Sonuç: 15 (Integer)
    echo "variable type of \$sayi: " ;
    var_dump($sayi); // integer
    echo "<br>"; 
    echo "variable type of \$metin: " . gettype($metin) . "<br>"; // string
    echo "<br>";
    echo "Sonuç: " . $sonuc; // Sonuç: 15
    echo "<br>";
    echo "variable type of \$sonuc: " . gettype($sonuc) . "<br>"; // integer

    echo "<hr>";

    $sonuc = $metin + $sayi; // Sonuç: 15 (Integer)
    echo "variable type of \$sayi: " ;
    var_dump($sayi); // integer
    echo "<br>"; 
    echo "variable type of \$metin: " . gettype($metin) . "<br>"; // string
    echo "<br>";
    echo "Sonuç: " . $sonuc; // Sonuç: 15
    echo "<br>";
    echo "variable type of \$sonuc: " . gettype($sonuc) . "<br>"; // integer

    echo "<hr>";
    echo "<h2 style='color:blue;'>Manuel Tür Dönüşümü (Type Casting):</h2>";
    //Manuel Tür Dönüşümü (Type Casting)

    echo "<h3>Tam Sayıya Dönüştürme (int) veya (integer)</h3>";
    $fiyat = 150.99;
    $tamFiyat = (int)$fiyat; 
    // Sonuç: 150 (Veri kaybı yaşanır, .99 kısmı silinir)

    $metinSayi = "42isik";
    $sayi = (int)$metinSayi; 
    // Sonuç: 42 (Metnin başındaki sayıyı alır)
    $metinSayi2 = "isik42";
    $sayi2 = (int)$metinSayi2;
    // Sonuç: 0 (Metnin başında sayı olmadığı için sıfır olur)
    echo "Fiyat: " . $fiyat . " → Tam Fiyat: " . $tamFiyat; // Fiyat: 150.99 → Tam Fiyat: 150
    echo "<br>"; 
    echo "Metin Sayi: " . $metinSayi . " → Sayı: " . $sayi; // Metin Sayi: 42isik → Sayı: 42
    echo "<br>";
    echo "Metin Sayi 2: " . $metinSayi2 . " → Sayı 2: " . $sayi2; // Metin Sayi 2: isik42 → Sayı 2: 0
    echo "<br>";

    echo "<h3>Mantıksal Değere Dönüştürme (bool) veya (boolean)</h3>";
    echo "<pre> Bir değer boolean’a dönüştürülürken şu kurallar uygulanır:
        echo bir değeri string’e çevirerek ekrana basar.
        Boolean değerler string’e çevrilirken özel bir kural uygulanır:

        true  → \"1\"
        false → \"\" (boş string)

        Yani:

        echo true;   // 1
        echo false;  // hiçbir şey basmaz

        Bu yüzden:

        echo \"5 eşit mi 3?: \" . (5 == 3);

        Burada (5 == 3) → false
        false string’e çevrilince → \"\"
        Bu nedenle ekranda boş görünür.
        </pre>";

    $kayitliMi = 1;
    $durum = (bool)$kayitliMi; 

    echo "Kayıtlı mı?: ".  $kayitliMi . "--" . ($durum ? "Evet" : "Hayır"); // Kayıtlı mı?: Evet
    echo "<br>";
    echo "variable type of \$durum: " . gettype($durum) . "<br>"; // boolean
    // Sonuç: true

    $stok = 0;
    $stokDurumu = (bool)$stok; 
    echo "Stok var mı?: ".  $stok . "--" . ($stokDurumu ? "Evet" : "Hayır"); // Stok var mı?: Hayır
    echo "<br>";
    // Sonuç: false

    echo "<h3>Metne Dönüştürme (string)</h3>";
    $yil = 2026;
    $yilMetin = (string)$yil; 
    // Sonuç: "2026"

    $onay = true;
    $onayMetin = (string)$onay; 
    // Sonuç: "1" (true metne çevrildiğinde "1", false ise boş string döner)

    echo "Yıl: " . $yil . " → Yıl Metin: " . $yilMetin; // Yıl: 2026 → Yıl Metin: 2026
    echo "<br>";   
    echo "Onay: " . ($onay ? "Evet" : "Hayır") . " → Onay Metin: '" . $onayMetin . "'"; // On$y: Evet → Onay Metin: '1'
    echo "<br>";

    echo "<h3>Dizi ve Nesne Dönüşümleri (array) ve (object)</h3>";
    // Diziye Dönüştürme
    $isim = "Volkan";
    $diziYap = (array)$isim; 
    // Sonuç: ["Volkan"] (Tek elemanlı bir dizi olur)

    // Nesneye Dönüştürme
    $veri = ["ad" => "Mustafa", "soyad" => "Güngör"];
    $nesneYap = (object)$veri; 
    // Sonuç: Artık verilere $nesneYap->ad şeklinde erişilebilir.

    echo "İsim: " . $isim . " → Dizi Yap: ";
    print_r($diziYap); // İsim: Volkan → Dizi Yap: Array ( [0] => Volkan )
    echo "<br>";    
    echo "Veri: ";
    print_r($veri); // Veri: Array ( [ad] => Mustafa [soyad] => Güngör )
    echo "<br>";

    echo "<h2 style='color:blue;'>Özel Dönüşüm Fonksiyonları</h2>";
?>