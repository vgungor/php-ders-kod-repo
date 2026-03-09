<!DOCTYPE html>
<html>
    <head><title>Formlar ve POST Metodu</title></head>
    <body>
        <form method="POST">
        <input type="text" name="kullanici_adi" placeholder="Kullanıcı adı">
        <button type="submit">Gönder</button>
        </form>

        
        <?php
        // Formun gönderilip gönderilmediğini kontrol edelim
            echo "<h3>isset() Fonksiyonu ile Kontrol</h3>";

            if (isset($_POST['kullanici_adi'])) {
                $username = $_POST['kullanici_adi'];
                $isSetDegeri = isset($_POST['kullanici_adi']);

                echo "isset değeri: " ;
                var_dump($isSetDegeri);

                echo "Hoş geldin, " . $username;
            } 
            else {
                echo "isset değeri: " ;
                var_dump($isSetDegeri);

                echo "Lütfen formu doldurun.";
            }
        ?>

</body>
</html>

