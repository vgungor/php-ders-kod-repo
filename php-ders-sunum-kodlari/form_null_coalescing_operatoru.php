<!DOCTYPE html>
<html>
    <head><title>Formlar ve POST Metodu</title></head>
    <body>
        <?php

        $username = $_POST['kullanici_adi'] ?? null;

        if ($username !== null && $username !== "") {
            echo "Kullanıcı adı değeri: ";
            var_dump($username);
            echo "<br>Hoş geldin, " . $username;
        } else {
            echo "Lütfen formu doldurun.";
        }

        ?>

        <form method="POST">
            <input type="text" name="kullanici_adi" 
            placeholder="Kullanıcı adı">
            <button type="submit">Gönder</button>
        </form>

</body>
</html>