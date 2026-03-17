<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Hava Durumu Kontrolü</title>
    <!-- <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; padding-top: 50px; background-color: #f4f4f9; }
        .container { background: white; padding: 20px; border-radius: 10px; shadow: 0 4px 8px rgba(0,0,0,0.1); width: 350px; }
        input[type="number"] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .result { margin-top: 20px; padding: 15px; border-radius: 5px; text-align: center; font-weight: bold; }
    </style> -->
</head>
<body>

<div class="container">
    <h2>Hava Sıcaklığı Kaç?</h2>
    <form method="POST">
        <input type="number" name="sicaklik" placeholder="Derece giriniz (Örn: 25)" required>
        <button type="submit">Mesajı Gör</button>
    </form>

    <?php
    // Formun gönderilip gönderilmediğini kontrol ediyoruz
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sicaklik = $_POST['sicaklik']; // Kullanıcının girdiği değer

        echo '<div class="result">';
        
        // Görseldeki mantık silsilesi
        if ($sicaklik < 0) {
            echo "<span style='color: blue;'>Hava dondurucu.</span>";
        } 
        elseif ($sicaklik >= 0 && $sicaklik < 20) {
            echo "<span style='color: green;'>Hava serin.</span>";
        } 
        elseif ($sicaklik >= 20 && $sicaklik < 35) {
            echo "<span style='color: orange;'>Hava ideal.</span>";
        } 
        else { // 35 ve üzeri ise
            echo "<span style='color: red;'>Hava çok sıcak.</span>";
        }
        
        echo '</div>';
    }
    ?>
</div>

</body>
</html>