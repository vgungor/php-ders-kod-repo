<!DOCTYPE html>
<html>
    <head><title>Formlar ve POST Metodu</title></head>
    <body>
        <form method="POST">
        <input type="text" name="kullanici_adi" placeholder="Kullanıcı adı">
        <button type="submit">Gönder</button>
        </form>
        
        <?php
            /* htmlspecialchars() Fonksiyonu ile Kontrol 
            form içinde <script>alert('XSS Saldırısı');</script> gönderilirse*/

            $girilenDeger = $_POST['kullanici_adi'] ?? '';

            echo "<h3>Kontrol yok!!! Alert verir!!!</h3>";
            echo "<h3>Girilen Değer</h3>";
                echo "<pre>"; 
                echo "Girilen değer: " . $girilenDeger; 
                echo "</pre>";

            echo "<h3>htmlspecialchars() Fonksiyonu ile Kontrol</h3>";
            echo "<pre>"; 
            echo "htmlspecialchars değeri: " ; 
            echo htmlspecialchars($girilenDeger, ENT_QUOTES, 'UTF-8');
            echo "</pre>";
            echo "<h5>htmlspecialchars() fonksiyonu ile 
                kontrol var!!! Alert vermez!!!</h5>";

        ?>

</body>
</html>