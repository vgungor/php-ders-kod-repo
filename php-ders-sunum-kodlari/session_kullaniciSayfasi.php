<h3> Session Yönetimi - Kullanıcı Sayfası </h3>
<?php
session_start();
$sid = session_id();

if(!isset($_SESSION["kullanici"])){
    header("Location: login.html");
    exit;
}

echo "Hoşgeldin " . $_SESSION["kullanici"] . "<br>";
echo "Session ID: " . $sid;

?>

<form action="session_logout.php" method="POST">
    <button type="submit" name="logout">Çıkış Yap</button>
</form>