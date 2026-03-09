<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Güvenli Kayıt Özeti</title>
</head>
<body>

<?php
// 1. ADIM: Form gönderildi mi kontrol et (isset)
// 'kullanici' ve 'sehir' anahtarlarının POST içerisinde var olup olmadığına bakıyoruz.
if (isset($_POST['kullanici']) && isset($_POST['sehir'])) {
    
    // 2. ADIM: Gelen verileri al ve htmlspecialchars ile temizle
    // Kullanıcı <script>alert('XSS')</script> yazsa bile bu fonksiyon onu etkisiz hale getirir.
    $kullanici = htmlspecialchars($_POST['kullanici'], ENT_QUOTES, 'UTF-8');
    $sehir = htmlspecialchars($_POST['sehir'], ENT_QUOTES, 'UTF-8');

    // 3. ADIM: Sonucu ekrana bas
    echo "<h2>Kayıt Başarılı!</h2>";
    echo "<p>Hoş geldin <strong>" . $kullanici . "</strong>!</p>";
    echo "<p>Sistemimizdeki kaydınız <strong>" . $sehir . "</strong> şehri üzerinden oluşturuldu.</p>";
    echo "<hr>";
}
?>

    <h3>Kayıt Formu</h3>
    <form method="POST" action="">
        <div>
            <label>Kullanıcı Adı:</label><br>
            <input type="text" name="kullanici" required placeholder="Adınızı yazın...">
        </div>
        <br>
        <div>
            <label>Yaşadığınız Şehir:</label><br>
            <input type="text" name="sehir" required placeholder="Şehir yazın...">
        </div>
        <br>
        <button type="submit">Bilgileri Gönder</button>
    </form>

</body>
</html>

<!-- isset() Kullanımı: Eğer form gönderilmeden sayfayı açarsan PHP hata vermez, çünkü if bloğu sadece buton tıklandığında (veriler geldiğinde) çalışır.

XSS Koruması: htmlspecialchars() sayesinde, kötü niyetli bir kullanıcı "Kullanıcı Adı" kısmına HTML kodları yazarak sayfanın tasarımını bozamaz veya başkalarının oturum bilgilerine erişemez.

ENT_QUOTES Parametresi: Bu parametre hem tek tırnağı hem de çift tırnağı (' ve ") güvenli hale getirir, böylece güvenlik açığı riski minimuma iner. -->