<?php
// 1. AYARLAR
$cookie_name = "kullanici_oturum";
$cookie_value = "Ahmet_123"; // Örn: Veritabanı ID veya Token
$current_time = time();

// 2. İŞLEM KONTROLÜ (Silme veya Güncelleme)
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'sil') {
        // Çerezi silmek için süresini -1 saat (geçmiş) yapıyoruz
        setcookie($cookie_name, "", $current_time - 3600, "/");
        header("Location: " . $_SERVER['PHP_SELF']); // Sayfayı yenile
        exit;
    } 
    elseif ($_GET['action'] == 'guncelle') {
        // Çerezi 30 gün daha uzatıyoruz
        setcookie($cookie_name, $cookie_value, $current_time + (86400 * 30), "/");
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// 3. OTOMATİK BAĞLANMA MANTIĞI
$mesaj = "";
$oturum_aktif = false;

if (isset($_COOKIE[$cookie_name])) {
    $mesaj = "Hoş geldin! Sistem seni tanıdı: **" . $_COOKIE[$cookie_name] . "**";
    $oturum_aktif = true;
} else {
    $mesaj = "Henüz bir oturum açılmadı veya çerez silindi.";
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <title>PHP Cookie Yönetimi</title>
</head>
<body>

    <h2>Oturum Durumu</h2>
    <p><?php echo $mesaj; ?></p>

    <hr>

    <?php if (!$oturum_aktif): ?>
        <a href="?action=guncelle"><button>Oturumu Başlat (Cookie Ekle)</button></a>
    <?php else: ?>
        <a href="?action=sil"><button style="color:red;">Çerezi Gerçekten Sil</button></a>
        <a href="?action=guncelle"><button>Süreyi Güncelle (30 Gün Uzat)</button></a>
    <?php endif; ?>

</body>
</html>