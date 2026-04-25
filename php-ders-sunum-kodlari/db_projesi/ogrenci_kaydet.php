<?php
require_once "db.php";

if (isset($_POST["kaydet"])) {

    $ogrenci_no = $_POST["ogrenci_no"];
    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    $email = $_POST["email"];

    $sql = "INSERT INTO ogrenciler 
            (ogrenci_no, ad, soyad, email, kayit_tarihi)
            VALUES 
            ('$ogrenci_no', '$ad', '$soyad', '$email', CURDATE())";

    $sonuc = mysqli_query($baglanti, $sql);

    if ($sonuc) {
        header("Location: index.php");
        exit;
    } else {
        echo "Kayıt eklenirken hata oluştu: " . mysqli_error($baglanti);
    }
}
?>