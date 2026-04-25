<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $remember = isset($_POST['remember']);

    // Basit doğrulama
    if ($user == "admin" && $pass == "1234") {
        // 1. SESSION OLUŞTUR (Kısa süreli, güvenli çalışma)
        $_SESSION["user_id"] = "101";
        $_SESSION["user_name"] = $user;
        $_SESSION["role"] = "admin";

        // 2. COOKIE OLUŞTUR (Beni Hatırla seçildiyse)
        if ($remember) {
            $cookie_val = base64_encode($user); // Gerçek projede güvenli bir "token" olmalı
            setcookie("remember_me", $cookie_val, time() + (86400 * 30), "/"); 
        }

        header("Location: cookie_2-dashboard.php");
        exit;
    }
}
?>
<form method="POST">
    Kullanıcı: <input type="text" name="username"><br>
    Şifre: <input type="password" name="password"><br>
    <input type="checkbox" name="remember"> Beni Hatırla<br>
    <button type="submit">Giriş Yap</button>
</form>