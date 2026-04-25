<?php
require_once "db.php";

$sql = "
SELECT 
    ogrenciler.ogrenci_no,
    ogrenciler.ad,
    ogrenciler.soyad,
    dersler.ders_adi,
    egitmenler.ad AS egitmen_ad,
    egitmenler.soyad AS egitmen_soyad,
    notlar.vize,
    notlar.final,
    (notlar.vize * 0.4 + notlar.final * 0.6) AS ortalama
FROM notlar
INNER JOIN ogrenciler ON notlar.ogrenci_id = ogrenciler.ogrenci_id
INNER JOIN dersler ON notlar.ders_id = dersler.ders_id
INNER JOIN egitmenler ON dersler.egitmen_id = egitmenler.egitmen_id
";

$sonuc = mysqli_query($baglanti, $sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Not Listesi</title>
</head>
<body>

<h2>Öğrenci Notları</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Öğrenci No</th>
        <th>Ad Soyad</th>
        <th>Ders</th>
        <th>Eğitmen</th>
        <th>Vize</th>
        <th>Final</th>
        <th>Ortalama</th>
        <th>Durum</th>
    </tr>

    <?php while ($satir = mysqli_fetch_assoc($sonuc)) { ?>

        <?php
            $ortalama = $satir["ortalama"];

            if ($ortalama >= 50) {
                $durum = "Geçti";
            } else {
                $durum = "Kaldı";
            }
        ?>

        <tr>
            <td><?php echo $satir["ogrenci_no"]; ?></td>
            <td><?php echo $satir["ad"] . " " . $satir["soyad"]; ?></td>
            <td><?php echo $satir["ders_adi"]; ?></td>
            <td><?php echo $satir["egitmen_ad"] . " " . $satir["egitmen_soyad"]; ?></td>
            <td><?php echo $satir["vize"]; ?></td>
            <td><?php echo $satir["final"]; ?></td>
            <td><?php echo number_format($ortalama, 2); ?></td>
            <td><?php echo $durum; ?></td>
        </tr>

    <?php } ?>

</table>

<br>
<a href="index.php">Öğrenci Listesine Dön</a>

</body>
</html>