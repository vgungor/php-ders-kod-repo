<h3> Session Yönetimi - Kullanıcı Sayfası </h3>
<?php
session_start();
// $sid = session_id();
$sid = $_COOKIE["PHPSESSID"]; // Session ID'yi cookie üzerinden alarak gösterelim

if(!isset($_SESSION["kullanici"])){
    header("Location: session_1-loginBeniHatirla.html");
    exit;
}

echo "Hoşgeldin " . $_SESSION["kullanici"] . "<br>";
echo "Session ID: " . $sid;

echo "<br>Heryerdeki Değer: " . $_SESSION["heryerde"]; // Her sayfada erişilebilir olduğunu gösterir

?>

<form action="session_5-logout_Cookie.php" method="POST">
    <button type="submit" name="logout">Çıkış Yap</button>
</form>