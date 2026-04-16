<?php

for ($i = 1; $i <= 20; $i++) {

    // 1 ile 10 arasında rastgele sayı üret
    $rastgele = rand(1, 10);

    // Eğer sayı 10'a tam bölünüyorsa
    if ($i % 10 == 0) {
        echo "Merhaba " . $i . "<br>";
    }

    // Eğer sayı tek ise
    if ($i % 2 != 0) {
        $sonuc = $i * $rastgele;
        echo "$i tek sayıdır → $i x $rastgele = $sonuc <br>";
    }
    // Eğer sayı çift ise
    else {
        $kare = $i * $i;
        echo "$i çift sayıdır → karesi = $kare <br>";
    }
}

?>
