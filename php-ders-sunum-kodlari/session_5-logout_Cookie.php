<?php
session_start();

// 1. Session verilerini temizle
$_SESSION = array();
// Tüm session verilerini temizle
// Cookie'yi de sil
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}
// Tüm session verilerini temizle
session_unset();
session_destroy();

// 2. "Beni Hatırla" çerezini sil (Vadesini geçmişe çekerek)
if(isset($_COOKIE["hatirla_kullanici"])){
    setcookie("hatirla_kullanici", "", time() - 3600, "/");
    
}

header("Location: session_1-loginBeniHatirla.html");
exit;
?>