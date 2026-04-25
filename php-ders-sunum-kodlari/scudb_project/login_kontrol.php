<?php
session_start();
require_once "db.php";

if (isset($_POST["giris"])) {

    $kullanici_adi = $_POST["kullanici_adi"];
    $sifre = $_POST["sifre"];

    $sql = "SELECT * FROM kullanicilar 
            WHERE kullanici_adi = ? AND sifre = ?";

    $stmt = mysqli_prepare($baglanti, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $kullanici_adi, $sifre);
    mysqli_stmt_execute($stmt);

    $sonuc = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($sonuc) == 1) {

        $kullanici = mysqli_fetch_assoc($sonuc);

        $_SESSION["giris_yapildi"] = true;
        $_SESSION["kullanici_id"] = $kullanici["kullanici_id"];
        $_SESSION["kullanici_adi"] = $kullanici["kullanici_adi"];
        $_SESSION["rol"] = $kullanici["rol"];

        if (isset($_POST["beni_hatirla"])) {
            setcookie("son_kullanici", $kullanici_adi, time() + 60 * 60 * 24 * 7);
        }

        header("Location: panel.php");
        exit;

    } else {
        echo "Kullanıcı adı veya şifre hatalı.";
        echo "<br><a href='login.php'>Tekrar dene</a>";
    }
}
?>