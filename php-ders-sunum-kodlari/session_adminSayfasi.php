<h3> Session Yönetimi - Admin Sayfası </h3>
<?php
session_start();
$sid = session_id();

if(!isset($_SESSION["kullanici"])){
    header("Location: login.html");
    exit;
}

echo "Hoşgeldin " . $_SESSION["kullanici"] . "<br>";
echo "Rolün: " . $_SESSION["role"] . "<br>";
echo "Son Aktivite: " . date("Y-m-d H:i:s", $_SESSION["last_activity"]) . "<br>";
echo "Session ID: " . $sid;

?>
<h3> Dersler Listesi </h3>
<ul>
    <?php foreach($_SESSION["Dersler"] as $ders): ?>
        <li><?php echo $ders; ?></li>
    <?php endforeach; ?>
</ul>
<h3> Kayıt Bilgileri </h3>
<ul>
    <li>Ad: <?php echo $_SESSION["kayitBilgileri"]["kullaniciDetay"]["ad"]; ?></li>
    <li>Soyad: <?php echo $_SESSION["kayitBilgileri"]["kullaniciDetay"]["soyad"]; ?></li>
    <li>Email: <?php echo $_SESSION["kayitBilgileri"]["kullaniciDetay"]["email"]; ?></li>
</ul>

<?php echo "<br>Heryerdeki Değer: " . $_SESSION["heryerde"]; // Her sayfada erişilebilir olduğunu gösterir ?>

<form action="session_logout.php" method="POST">
    <button type="submit" name="logout">Çıkış Yap</button>
</form>