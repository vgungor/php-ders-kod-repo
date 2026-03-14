<?php
session_start();

/* SESSION örneği */
if(!isset($_SESSION["sayac"])){
    $_SESSION["sayac"] = 1;
}else{
    $_SESSION["sayac"]++;
}

/* COOKIE örneği */
if(!isset($_COOKIE["ziyaretci"])){
    setcookie("ziyaretci","Misafir",time()+3600);
}

/* POST verisi */
$postIsim = "";
if(isset($_POST["isim"])){
    $postIsim = htmlspecialchars($_POST["isim"]);
}

/* GET verisi */
$getMesaj = "";
if(isset($_GET["mesaj"])){
    $getMesaj = htmlspecialchars($_GET["mesaj"]);
}

/* REQUEST verisi */
$requestDeger = "";
if(isset($_REQUEST["isim"])){
    $requestDeger = $_REQUEST["isim"];
}

/* FILES örneği */
$dosyaMesaj = "";
if(isset($_FILES["dosya"])){
    $dosyaMesaj = $_FILES["dosya"]["name"];
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP Süper Küresel Diziler</title>

<style>
body{font-family:Arial; padding:20px;}
.kutu{border:1px solid #ccc; padding:15px; margin-bottom:20px;}
h2{color:#333;}
</style>

</head>
<body>

<h1>PHP Süper Küresel Diziler Örneği</h1>

<div class="kutu">
<h2>$_SERVER</h2>
Sunucu Adı: <?php echo $_SERVER["SERVER_NAME"]; ?><br>
İstek Türü: <?php echo $_SERVER["REQUEST_METHOD"]; ?><br>
Kullanıcı IP: <?php echo $_SERVER["REMOTE_ADDR"]; ?>
</div>

<div class="kutu">
<h2>$_GET Örneği</h2>
<a href="?mesaj=MerhabaDunya">GET ile Mesaj Gönder</a><br><br>
GET Mesajı: <?php echo $getMesaj; ?>
</div>

<div class="kutu">
<h2>$_POST Örneği</h2>

<form method="POST">

İsim:
<input type="text" name="isim">

<button type="submit">Gönder</button>

</form>

POST ile gelen isim: <?php echo $postIsim; ?>
</div>

<div class="kutu">
<h2>$_REQUEST Örneği</h2>

REQUEST ile gelen değer: <?php echo $requestDeger; ?>

</div>

<div class="kutu">
<h2>$_SESSION Örneği</h2>

Sayfa ziyaret sayısı: <?php echo $_SESSION["sayac"]; ?>

</div>

<div class="kutu">
<h2>$_COOKIE Örneği</h2>

Cookie değeri: 

<?php
if(isset($_COOKIE["ziyaretci"])){
    echo $_COOKIE["ziyaretci"];
}else{
    echo "Cookie oluşturuldu (sayfayı yenileyin)";
}
?>

</div>

<div class="kutu">
<h2>$_FILES Örneği</h2>

<form method="POST" enctype="multipart/form-data">

Dosya seç:
<input type="file" name="dosya">

<button type="submit">Yükle</button>

</form>

Yüklenen dosya: <?php echo $dosyaMesaj; ?>

</div>

</body>
</html>