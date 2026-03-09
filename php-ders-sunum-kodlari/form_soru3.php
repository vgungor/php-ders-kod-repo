<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Güvenli Sepet Hesaplama</title>
</head>
<body>

<?php
// 1. Veri Geldi mi Kontrolü (isset)
if (isset($_POST['adet'])) {
    
    // 2. Tür Dönüşümü (Type Casting)
    // Kullanıcı harf veya zararlı kod girse bile (int) bunu sayıya zorlar.
    // Örneğin: "5 adet" -> 5 olur, "<script>..." -> 0 olur.
    $adet = (int)$_POST['adet']; 
    
    $birim_fiyat = 50; // Ürünün sabit fiyatı
    $toplam_tutar = $adet * $birim_fiyat;

    // 3. Sonucu Yazdırma
    echo "<h3>Sipariş Detayı</h3>";
    
    // Sayısal verilerde XSS riski düşüktür ama ekrana basarken 
    // htmlspecialchars kullanmak her zaman en iyi alışkanlıktır.
    echo "Seçilen Adet: " . htmlspecialchars($adet, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "Birim Fiyat: " . $birim_fiyat . " TL <br>";
    echo "<strong>Toplam Ödenecek: " . $toplam_tutar . " TL</strong>";
    echo "<hr>";
}
?>

    <form method="POST" action="">
        <label for="adet">Kaç adet satın almak istiyorsunuz?</label><br>
        <input type="number" name="adet" id="adet" required min="1" value="1">
        <br><br>
        <button type="submit">Hesapla</button>
    </form>

</body>
</html>