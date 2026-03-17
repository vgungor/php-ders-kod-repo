<?php
$sayi = 9;

if ($sayi == 5):
    echo "Sayı değişkenin değeri 5";
elseif ($sayi == 6):
    echo "Sayı değişkenin değeri 6";
else:
    echo "Değişken değeri tespit edilemedi.";
endif;
?>

<?php
$sayi = 5;

if ($sayi == 5) {
    echo "Sayı değişkenin değeri 5";
} else if ($sayi == 6) {
    echo "Sayı değişkenin değeri 6";
} else {
    echo "Değişken değeri tespit edilemedi.";
}
?>

<?php
$havaSicakligi = 25;

if ($havaSicakligi > 30) {
    echo "Hava çok sıcak!";
} elseif ($havaSicakligi >= 20) {
    echo "Hava gayet güzel.";
} elseif ($havaSicakligi >= 10) {
    echo "Hava biraz serin.";
} else {
    echo "Hava çok soğuk, sıkı giyin.";
}
?>