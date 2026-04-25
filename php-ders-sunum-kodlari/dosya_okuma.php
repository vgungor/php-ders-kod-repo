<?php
// Hedef dizin yolu
$dizin = __DIR__ . "\dosyaYuklemeAlani\\";
$icerik = "";
$secilenDosya = "";

// Dizindeki dosyaları listele (Sadece json ve txt)
$dosyalar = [];
if (is_dir($dizin)) {
    $tumDosyalar = scandir($dizin);
    foreach ($tumDosyalar as $dosya) {
        $uzanti = pathinfo($dosya, PATHINFO_EXTENSION);
        if (in_array($uzanti, ['json', 'txt'])) {
            $dosyalar[] = $dosya;
        }
    }
}

// Form gönderildiğinde dosyayı oku
if (isset($_POST['dosya_sec'])) {
    $secilenDosya = $_POST['dosya_sec'];
    $dosyaYolu = $dizin . $secilenDosya;

    // Güvenlik kontrolü: Dosya gerçekten var mı ve izin verilen listede mi?
    if (file_exists($dosyaYolu) && in_array(pathinfo($dosyaYolu, PATHINFO_EXTENSION), ['json', 'txt'])) {
        $icerik = file_get_contents($dosyaYolu);
        // HTML içinde güvenli görüntüleme için htmlspecialchars kullanıyoruz
        $icerik = htmlspecialchars($icerik); 
    } else {
        $icerik = "Geçersiz dosya seçimi!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>PHP Dosya Okuyucu</title>
    <style>
        body { font-family: sans-serif; padding: 20px; line-height: 1.6; }
        .container { max-width: 800px; margin: auto; border: 1px solid #ccc; padding: 20px; border-radius: 8px; }
        pre { background: #f4f4f4; padding: 15px; border: 1px solid #ddd; overflow-x: auto; }
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h2>Dosya İçeriği Okuma</h2>
    
    <form method="post">
        <label for="dosya_sec">Okunacak Dosyayı Seçin:</label>
        <select name="dosya_sec" id="dosya_sec" required>
            <option value="">-- Seçiniz --</option>
            <?php foreach ($dosyalar as $dosya): ?>
                <option value="<?php echo $dosya; ?>" <?php echo ($secilenDosya == $dosya) ? 'selected' : ''; ?>>
                    <?php echo $dosya; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">İçeriği Getir</button>
    </form>

    <hr>

    <?php if ($secilenDosya): ?>
        <h3>Dosya: <span class="success"><?php echo htmlspecialchars($secilenDosya); ?></span></h3>
        <p>İçerik:</p>
        <pre><?php echo $icerik; ?></pre>
    <?php endif; ?>
</div>

</body>
</html>