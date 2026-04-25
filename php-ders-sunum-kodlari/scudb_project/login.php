<?php
session_start();

if (isset($_SESSION["giris_yapildi"])) {
    header("Location: panel.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
</head>
<body>

<h2>Giriş Yap</h2>

<form action="login_kontrol.php" method="POST">
    <label>Kullanıcı Adı:</label><br>
    <input type="text" name="kullanici_adi"><br><br>

    <label>Şifre:</label><br>
    <input type="password" name="sifre"><br><br>

    <label>
        <input type="checkbox" name="beni_hatirla" value="1">
        Beni hatırla
    </label>

    <br><br>

    <button type="submit" name="giris">Giriş Yap</button>
</form>

</body>
</html>