<!DOCTYPE html>
<html>
<head><title>Mantıksal Operatörler</title></head>
<body>
    <h2>Berber Randevu Sistemi - Erişim Kontrolü</h2>

    <?php
    $kullaniciGirisYapmis = true;
    $yetkiSeviyesi = "admin";
    $randevuDolu = false;

    echo "<b>Durum:</b> Giriş: " . ($kullaniciGirisYapmis ? 'Evet' : 'Hayır') . ", Yetki: $yetkiSeviyesi <br><br>";

    // AND (&&) Operatörü: Hem giriş yapmış olmalı hem de admin olmalı
    echo "Yönetim Paneline Giriş İzni (Giriş VE Admin): ";
    var_dump($kullaniciGirisYapmis && $yetkiSeviyesi == "admin");
    echo "<br>";

    // OR (||) Operatörü: Giriş yapmış olması VEYA misafir yetkisi olması yeterli
    echo "Randevu Listesini Görüntüleme (Giriş VEYA Admin): ";
    var_dump($kullaniciGirisYapmis || $yetkiSeviyesi == "misafir");
    echo "<br>";

    // NOT (!) Operatörü: Randevu dolu DEĞİLSE randevu alınabilir
    echo "Randevu Alınabilir mi? (Dolu Değilse): ";
    var_dump(!$randevuDolu);
    ?>

</body>
</html>