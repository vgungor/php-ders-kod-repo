<?php
$kullaniciAdi = "admin";
$sifre = "1234";

if ($kullaniciAdi === "admin") {
    if ($sifre === "1234") {
        echo "Giriş başarılı.";
    } else {
        echo "Şifre hatalı.";
    }
} else {
    echo "Kullanıcı adı bulunamadı.";
}
?>