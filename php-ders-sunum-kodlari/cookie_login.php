<?php
// Form gönderildiyse
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Basit bir kontrol (Admin girişi)
    if ($username == "admin" && $password == "1234") {
        $sure = time() + (86400 * 30); // 30 Günlük süre

        // Bilgileri Session yerine Cookie'ye atıyoruz
        setcookie("oturum_kullanici", $username, $sure, "/");
        setcookie("oturum_rol", "admin", $sure, "/");
        setcookie("oturum_ad_soyad", "Volkan Gungor", $sure, "/");

        header("Location: cookie_profil.php");
        exit;
    } else {
        echo "Hatalı giriş!";
    }
}
?>

<form method="POST">
  Kullanıcı Adı: <input type="text" name="username" /><br />
  Şifre: <input type="password" name="password" /><br />
  <button type="submit">Çerezle Giriş Yap</button>
</form>