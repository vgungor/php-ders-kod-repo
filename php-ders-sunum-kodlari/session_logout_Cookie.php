<?php
session_start();

// 1. Session verilerini temizle
$_SESSION = array();
session_destroy();

// 2. "Beni Hatırla" çerezini sil (Vadesini geçmişe çekerek)
if(isset($_COOKIE["hatirla_kullanici"])){
    setcookie("hatirla_kullanici", "", time() - 3600, "/");
}

header("Location: session_login.html");
exit;
?>