<?php
$girisYapildi = true;
$yetkiSeviyesi = 5;

if ($girisYapildi) {
    echo "Sisteme giriş başarılı.";

    // İç içe geçmiş ikinci kontrol
    if ($yetkiSeviyesi >= 7) {
        echo " Yönetici paneline erişebilirsiniz.";
    } else {
        echo " Ancak yönetici değilsiniz.";
    }
} else {
    echo "Lütfen önce giriş yapın.";
}
?>