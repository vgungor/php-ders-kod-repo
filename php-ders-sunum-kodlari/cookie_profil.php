<?php
// 1. OTOMATİK KONTROL: Çerez var mı?
if (!isset($_COOKIE["oturum_kullanici"])) {
    // Çerez yoksa giriş sayfasına yönlendir
    header("Location: login_cookie.php");
    exit;
}

// 2. VERİLERİ ÇEREZDEN OKUMA
$kullanici = $_COOKIE["oturum_kullanici"];
$rol = $_COOKIE["oturum_rol"];
$adSoyad = $_COOKIE["oturum_ad_soyad"];
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Profil Sayfası (Sadece Cookie ile Çalışır)</h2>
    <p>Hoş geldin, <b><?php echo $adSoyad; ?></b></p>
    <p>Kullanıcı Adınız: <?php echo $kullanici; ?></p>
    <p>Yetkiniz: <?php echo $rol; ?></p>

    <hr>
    <a href="cookie_logout.php">Güvenli Çıkış</a>
</body>
</html>