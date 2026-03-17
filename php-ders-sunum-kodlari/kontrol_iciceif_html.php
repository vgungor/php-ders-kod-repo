<?php
$kullaniciAdi = "admin";
$sifre = "1235"; // Hata durumunu görmek için şifreyi değiştirdik
?>

<!DOCTYPE html>
<html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Bootstrap Login Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php if ($kullaniciAdi === "admin"): ?>
        
        <?php if ($sifre === "1234"): ?>
            <div class="alert alert-success">
                <strong>Başarılı!</strong> Hoş geldin admin, sisteme giriş yaptın.
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                <strong>Hata!</strong> Kullanıcı adı doğru ama şifreniz yanlış.
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="alert alert-danger">
            <strong>Hata!</strong> Böyle bir kullanıcı tanımlı değil.
        </div>
    <?php endif; ?>

</body>
</html>