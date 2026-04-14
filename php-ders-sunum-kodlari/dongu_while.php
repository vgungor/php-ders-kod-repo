<?php

$toplam = 0;
$negatifSayac = 0;

if (isset($_POST["sayilar"])) {

    $dizi = explode(",", $_POST["sayilar"]);
    $i = 0;

    while ($i < count($dizi)) {

        $sayi = (int)$dizi[$i];

        if ($sayi == 0) {
            break;
        }

        if ($sayi > 0) {
            $toplam += $sayi;
        } else {
            $negatifSayac++;
            echo "Negatif sayı girildi!<br>";
        }

        $i++;
    }

    echo "<br>Toplam: $toplam<br>";
    echo "Negatif sayı adedi: $negatifSayac";
}
?>

<form method="post">
    Sayıları giriniz: <br>
    <input type="text" name="sayilar">
    <button type="submit">Gönder</button>
</form>