<?php
// Tüm çerezleri geçmişe çekerek sil
setcookie("oturum_kullanici", "", time() - 3600, "/");
setcookie("oturum_rol", "", time() - 3600, "/");
setcookie("oturum_ad_soyad", "", time() - 3600, "/");

// Giriş sayfasına dön
header("Location: login_cookie.php");
exit;
?>