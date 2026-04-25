<?php

$host = "localhost";
$kullanici = "root";
$sifre = "";
$veritabani = "okul_db";

$baglanti = mysqli_connect($host, $kullanici, $sifre, $veritabani);

if (!$baglanti) {
    die("Veritabanı bağlantı hatası: " . mysqli_connect_error());
}

mysqli_set_charset($baglanti, "utf8");

?>