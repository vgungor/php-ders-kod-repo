<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Gelişmiş Fiyat Hesaplama</title>
</head>
<body>

<?php
// 1. Kontrol: Her iki değer de formdan gelmiş mi?
if (isset($_POST['adet'], $_POST['birim_fiyat']) && isset($_POST['urun_adi'])) {
    
    $urun_adi = (string)$_POST['urun_adi'];

    // 2. Tür Dönüşümü (Type Casting)
    // Adet tam sayı olmalı (int)
    $adet = (int)$_POST['adet']; 
    
    // Birim fiyat ondalıklı olabilir (float/double) 
    // Örn: 10.50 TL gibi değerler için float kullanılır.
    $birim_fiyat = (float)$_POST['birim_fiyat']; 

    // 3. Matematiksel İşlem
    $toplam_tutar = $adet * $birim_fiyat;

    // 4. Güvenli Yazdırma (XSS Koruması)
    echo "<h3>Hesaplama Sonucu</h3>";
    echo "Ürün Adı: " . htmlspecialchars($urun_adi, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "Adet: " . htmlspecialchars($adet, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "Birim Fiyat: " . htmlspecialchars($birim_fiyat, ENT_QUOTES, 'UTF-8') . " TL <br>";
    
    echo "<strong>Toplam Tutar: " . number_format($toplam_tutar, 2, ',', '.') . " TL</strong>";
    echo "<hr>";
}
?>

    <form method="POST" action="">
        <div>
            <label>Ürün Adı:</label><br>
            <input type="text" name="urun_adi" required>
        </div>
        <br>
        <div>
            <label>Ürün Adedi:</label><br>
            <input type="number" name="adet" required min="1" step="1">
        </div>
        <br>
        <div>
            <label>Birim Fiyat (TL):</label><br>
            <input type="number" name="birim_fiyat" required min="0" step="0.01">
        </div>
        <br>
        <button type="submit">Hesapla</button>
    </form>

</body>
</html>