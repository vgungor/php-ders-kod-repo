<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Öğrenci Ekle</title>
</head>
<body>

<h2>Yeni Öğrenci Ekle</h2>

<form action="ogrenci_kaydet.php" method="POST">
    <label>Öğrenci No:</label><br>
    <input type="text" name="ogrenci_no"><br><br>

    <label>Ad:</label><br>
    <input type="text" name="ad"><br><br>

    <label>Soyad:</label><br>
    <input type="text" name="soyad"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <button type="submit" name="kaydet">Kaydet</button>
</form>

<br>
<a href="index.php">Listeye Dön</a>

</body>
</html>