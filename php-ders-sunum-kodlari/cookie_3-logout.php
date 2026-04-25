<?php
session_start();

// 1. Session'ı temizle ve yok et
$_SESSION = array();
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

// 2. Beni Hatırla çerezini temizle
if (isset($_COOKIE["remember_me"])) {
    setcookie("remember_me", "", time() - 3600, "/");
}

header("Location: cookie_1-session.php");
exit;