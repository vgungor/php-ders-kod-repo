

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yönetim Paneli</title>
    <style>
        .card { border: 1px solid #ccc; padding: 15px; width: 200px; font-family: sans-serif; }
        .btn-sil { color: white; background-color: red; padding: 5px 10px; text-decoration: none; border-radius: 3px; }
    </style>
</head>
<body>
    <?php
        $kullaniciRolu = "admin"; // Bu değer "admin" veya "kullanici" olabilir
        $urunAdi = "Akıllı Telefon";
    ?>

    <div class="card">
        <h3><?php echo $urunAdi; ?></h3>
        <p>Stokta Var</p>

        <?php if ($kullaniciRolu == "admin"): ?>
            <a href="#" class="btn-sil">Ürünü Sil</a>
        <?php endif; ?>
        
    </div>

</body>
</html>