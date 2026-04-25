<?php
require_once "db.php";

$sql = "SELECT * FROM ogrenciler";
$sonuc = mysqli_query($baglanti, $sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Öğrenci Listesi</title>
</head>
<body>

<h2>Öğrenci Listesi</h2>

<a href="ogrenci_ekle.php">Yeni Öğrenci Ekle</a>
<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Öğrenci No</th>
        <th>Ad</th>
        <th>Soyad</th>
        <th>Email</th>
        <th>Kayıt Tarihi</th>
        <th>İşlemler</th>
    </tr>

    <?php while ($satir = mysqli_fetch_assoc($sonuc)) { ?>
        <tr>
            <td><?php echo $satir["ogrenci_id"]; ?></td>
            <td><?php echo $satir["ogrenci_no"]; ?></td>
            <td><?php echo $satir["ad"]; ?></td>
            <td><?php echo $satir["soyad"]; ?></td>
            <td><?php echo $satir["email"]; ?></td>
            <td><?php echo $satir["kayit_tarihi"]; ?></td>
            <td>
                <a href="ogrenci_sil.php?id=<?php echo $satir["ogrenci_id"]; ?>">
                    Sil
                </a>
            </td>
        </tr>
    <?php } ?>

</table>

</body>
</html>