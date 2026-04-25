<?php
require_once "session_kontrol.php";
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Panel</title>
</head>
<body>

<h2>Yönetim Paneli</h2>

<p>Hoş geldiniz, <?php echo $_SESSION["kullanici_adi"]; ?></p>
<p>Rolünüz: <?php echo $_SESSION["rol"]; ?></p>
<p>Session ID: <?php echo session_id(); ?></p>

<ul>
    <li><a href="index.php">Öğrenci Listesi</a></li>
    <li><a href="notlar.php">Not Listesi</a></li>
    <li><a href="logout.php">Çıkış Yap</a></li>
</ul>

</body>
</html>