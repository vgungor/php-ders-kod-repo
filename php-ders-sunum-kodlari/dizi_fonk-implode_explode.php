
<!DOCTYPE html>
<html>
<head>
    <style>
        ol li::marker {
            font-weight: bold;
            font-style: italic;
        }
        ol li h3 {
            color: blue;
        }
        span {
            color: blue;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Dizi Fonksiyonları - Dizi/Metin geçişi</h1>
    <pre>
        $etiket_metni = "php,programlama,web-gelistirme,backend";
    </pre>
    <h2> <span>explode()</span> – Bir String’i Diziye Dönüştürme </h2>
    <?php

use function PHPSTORM_META\type;

    $etiket_metni = "php,programlama,web-gelistirme,backend";
    $etiketler = explode(",", $etiket_metni);
    echo "Etiketler dizisi: ";
    echo "<pre>";
    print_r($etiketler);
    echo "</pre>";
    ?>
    <h2> <span>implode()</span> – Dizi Elemanlarını Birleştirerek metne çevirir </h2>
    <?php
    $etiketler = explode(",", $etiket_metni);
    echo "Birleştirilmiş metin: <br>";
    $yeniMetin = implode(" - ", $etiketler);
    echo $yeniMetin;
    echo "<br>Yeni metnin veri tipi: ";
    echo gettype($yeniMetin);
    ?>

</body>
</html>