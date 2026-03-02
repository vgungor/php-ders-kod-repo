<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verileri alırken htmlspecialchars kullanarak XSS saldırılarını engelliyoruz
    $ad_soyad = htmlspecialchars($_POST['ad_soyad']);
    $eposta = htmlspecialchars($_POST['eposta']);
    $mesaj = htmlspecialchars($_POST['mesaj']);

    // Basit bir doğrulama
    if (!empty($ad_soyad) && !empty($eposta) && !empty($mesaj)) {
        
        // Burada normalde veritabanına kayıt veya e-posta gönderme işlemi yapılır.
        // Biz şimdilik ekrana onay mesajı basalım:
        
        echo "<h3>Mesajınız Başarıyla Alındı!</h3>";
        echo "<p><strong>Gönderen:</strong> $ad_soyad</p>";
        echo "<p><strong>E-posta:</strong> $eposta</p>";
        echo "<p><strong>Mesaj:</strong> $mesaj</p>";
        
        echo "<br><a href='index.php'>Geri Dön</a>";
        
    } else {
        echo "Lütfen tüm alanları doldurun.";
    }
} else {
    // Tarayıcıdan doğrudan bu sayfaya erişilmeye çalışılırsa ana sayfaya yönlendir
    header("Location: index.php");
}
?>