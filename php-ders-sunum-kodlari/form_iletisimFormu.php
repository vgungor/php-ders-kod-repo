<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>PHP İletişim Formu</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f9; display: flex; justify-content: center; padding: 50px; }
        .form-container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 350px; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #5cb85c; border: none; color: white; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #4cae4c; }
        .success { color: green; margin-bottom: 10px; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Bizimle İletişime Geçin</h2>
    <form action="form_iletisiFormu_islem.php" method="POST">
        <input type="text" name="ad_soyad" placeholder="Adınız Soyadınız" required>
        <input type="email" name="eposta" placeholder="E-posta Adresiniz" required>
        <textarea name="mesaj" rows="5" placeholder="Mesajınız..." required></textarea>
        <button type="submit">Gönder</button>
    </form>
</div>

</body>
</html>

