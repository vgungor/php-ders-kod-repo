

<html>
    <head>
    <title>Form Farklı Uygulamalar</title>
    <style>
        td.auto-fit {
    width: 1px;
    white-space: nowrap;
}
    </style>
    </head>
<body>
    <h2>Form Farklı Uygulamalar</h2>
    <h3>Form verileri alınırken;</h3>
    <ul>
        <li>$_GET süper globali ile URL üzerinden veri alınabilir.</li>
        <li>$_POST süper globali ile form verileri alınabilir.</li>
        <li>$_REQUEST süper globali ile hem GET hem POST verileri alınabilir.</li>
    </ul>

    <h3>Form verileri gönderilirken;</h3>
    <ul>
        <li>Formun action özelliği ile verilerin gönderileceği dosya belirtilir.</li>
        <li>Formun method özelliği ile verilerin nasıl gönderileceği (GET veya POST) belirlenir.</li>
    </ul>
    <h3>Form verileri işlenirken;</h3>
    <ul>
        <li>Veriler süper global değişkenler aracılığıyla alınır.</li>
        <li>Verilerin güvenliği için htmlspecialchars() gibi fonksiyonlar kullanılabilir.</li>
        <li>Verilerin türü gerektiğinde dönüştürülebilir (örneğin, (int) ile tam sayıya dönüştürme).</li>   
    </ul>

    <hr>
<h2>Form Verilerini $_POST ile Almak</h2>
<table border="1" >
    <tr>
        <td><pre>         
if (isset($_REQUEST['submit'])) {
    $kullanici_adi = $_POST['kullanici_adi'];
    $eposta = $_POST['eposta'];
    echo "Kullanıcı Adı: " . $kullanici_adi ;
    echo "E-posta: " . $eposta ;
}
else {
    echo "Form gönderilmedi.";
}
        </pre></td>
    </tr>
</table>
<?php
    if (isset($_POST['submit'])) {
        $kullanici_adi = $_POST['kullanici_adi']; 
        $eposta = $_POST['eposta']; 
        echo "Kullanıcı Adı: " . $kullanici_adi . "<br>"; 
        echo "E-posta: " . $eposta . "<br>"; 
    }
    else {
        echo "Form gönderilmedi.";
    }  
?>

<h2>Form Verilerini $_REQUEST ile Almak</h2>
<table border="1" >
    <tr>
        <td><pre>          
if (isset($_REQUEST['submit'])) {
    $kullanici_adi = $_REQUEST['kullanici_adi'];
    $eposta = $_REQUEST['eposta'];
    echo "Kullanıcı Adı: " . $kullanici_adi ;
    echo "E-posta: " . $eposta ;
}
else {
    echo "Form gönderilmedi.";
}
        </pre></td>
    </tr>
</table>
<?php
    if (isset($_REQUEST['submit'])) {
        $kullanici_adi = $_REQUEST['kullanici_adi'];
        $eposta = $_REQUEST['eposta'];
        echo "Kullanıcı Adı: " . $kullanici_adi . "<br>";
        echo "E-posta: " . $eposta . "<br>";
    }
    else {
        echo "Form gönderilmedi.";
    }
?>
</html>