<?php

if (isset($_POST['kullanici_giris'])) {
    echo "Kullanıcı Form verileri işleniyor...<br>";
    $ad = $_POST['ad'];
    $sifre = $_POST['sifre'];
    $kullanici_giris = $_POST['kullanici_giris'];


    echo "Kullanıcı Adı: " . $ad . "<br>";
    echo "Şifre: " . $sifre . "<br>";
    echo "Giriş Yap butonuna basıldı: " . $kullanici_giris . " - türü:" . gettype($kullanici_giris) . "<br>";
    // var_dump($kullanici_giris); 
    echo 'print_r  $_?POST verileri:<br>';
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
} else {
    echo "Gönderilen form Kullanıcı Formu değil... <br>";
}
?>


<?php

if (isset($_POST['admin_giris'])) {
    echo "Admin Form verileri işleniyor...<br>";
    $ad = $_POST['ad'];
    $sifre = $_POST['sifre'];
    $admin_giris = $_POST['admin_giris'];


    echo "Admin Adı: " . $ad . "<br>";
    echo "Admin Şifre: " . $sifre . "<br>";
    echo "Admin Giriş butonuna basıldı: " . $admin_giris . " - türü:" . gettype($admin_giris) ."<br>";
    // var_dump($admin_giris);

    echo 'print_r  $_?POST verileri:<br>';
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
} else {
    echo "Gönderilen form Admin Formu değil... <br>";
}
?>