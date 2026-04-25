<?php
session_start();

// --- OTOMATİK BAĞLANTI KONTROLÜ ---
if (!isset($_SESSION["user_id"]) && isset($_COOKIE["remember_me"])) {
    // Session yok ama Cookie var! 
    $remembered_user = base64_decode($_COOKIE["remember_me"]);
    
    // Veritabanından bu kullanıcıyı sorguladığımızı varsayalım
    if ($remembered_user == "admin") {
        // Session'ı Cookie verileriyle tekrar hayata döndür
        $_SESSION["user_id"] = "101";
        $_SESSION["user_name"] = "admin";
        $_SESSION["role"] = "admin";
    }
}

// --- ERİŞİM KONTROLÜ ---
if (!isset($_SESSION["user_id"])) {
    header("Location: cookie_1-session.php");
    exit;
}
?>
<h1>Hoş geldin, <?php echo $_SESSION["user_name"]; ?></h1>
<p>Şu an hem Session aktif hem de (eğer seçtiysen) Cookie seni hatırlıyor.</p>
<a href="cookie_3-logout.php">Güvenli Çıkış</a>