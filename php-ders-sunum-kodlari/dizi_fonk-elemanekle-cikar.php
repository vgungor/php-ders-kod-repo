<?php
session_start();

// Eğer dizi henüz oluşturulmamışsa boş bir dizi başlat
if (!isset($_SESSION['dersler'])) {
    $_SESSION['dersler'] = ["MBP214", "MBP192"];
}

$mesaj = "";

// Form gönderildiğinde yapılacak işlemler
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $yeni_deger = htmlspecialchars($_POST['deger']);
    $islem = $_POST['islem'];

    switch ($islem) {
        case 'push':
            if ($yeni_deger) array_push($_SESSION['dersler'], $yeni_deger);
            $mesaj = "Sona eklendi: $yeni_deger";
            break;
        case 'pop':
            $cikarilan = array_pop($_SESSION['dersler']);
            $mesaj = "Sondan çıkarıldı: $cikarilan";
            break;
        case 'shift':
            $cikarilan = array_shift($_SESSION['dersler']);
            $mesaj = "Baştan çıkarıldı: $cikarilan";
            break;
        case 'unshift':
            if ($yeni_deger) array_unshift($_SESSION['dersler'], $yeni_deger);
            $mesaj = "Başa eklendi: $yeni_deger";
            break;
        case 'sifirla':
            $_SESSION['dersler'] = ["MBP214", "MBP192"];
            $mesaj = "Dizi varsayılana döndü.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>PHP Dizi Yönetimi</title>
    <style>
        body { font-family: sans-serif; padding: 20px; line-height: 1.6; }
        .dizi-kutu { background: #f4f4f4; padding: 15px; border-radius: 8px; border: 1px solid #ddd; }
        .butonlar button { padding: 8px 15px; cursor: pointer; margin-right: 5px; }
        .mesaj { color: #d9534f; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Dizi Yönetim Paneli</h2>

    <div class="dizi-kutu">
        <strong>Mevcut Dizi:</strong> 
        [ <?php echo implode(", ", $_SESSION['dersler']); ?> ]
    </div>

    <p class="mesaj"><?php echo $mesaj; ?></p>

    <form method="POST">
        <input type="text" name="deger" placeholder="Bir değer yazın..." autocomplete="off">
        <br><br>
        <div class="butonlar">
            <button type="submit" name="islem" value="push">Sona Ekle (Push)</button>
            <button type="submit" name="islem" value="unshift">Başa Ekle (Unshift)</button>
            <button type="submit" name="islem" value="pop" style="background:#ffc107;">Sondan Sil (Pop)</button>
            <button type="submit" name="islem" value="shift" style="background:#ffc107;">Baştan Sil (Shift)</button>
            <button type="submit" name="islem" value="sifirla" style="background:#eee;">Sıfırla</button>
        </div>
    </form>

</body>
</html>