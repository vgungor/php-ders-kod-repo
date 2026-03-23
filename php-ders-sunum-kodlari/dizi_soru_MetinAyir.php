<?php

$metin = "php,java,python;dersi";

// 1. Virgüle göre ayır
$parcalar = explode(",", $metin);

$sonuc = [];

// 2. Her parçayı ; göre ayır
foreach ($parcalar as $parca) {
    $altParcalar = explode(";", $parca);
    
    foreach ($altParcalar as $alt) {
        $sonuc[] = $alt;
    }
}

// Sonucu yazdır
// foreach ($sonuc as $item) {
//     echo $item . "<br>";
// }

print_r($sonuc);
?>