<!DOCTYPE html>
<html>
    <head><title>Formlar ve POST Metodu</title></head>
<body>
    <form method="" action="formlar_baslangic_POST.php">
        <label>1. Sayı:</label><br>
        <input type="number" name="sayi1" required><br> 
        <label>2. Sayı:</label><br>
        <input type="number" name="sayi2" required><br><br>
        
        <input type="submit" value="Topla"> 
    </form>
    <?php
    // Formun gönderilip gönderilmediğini kontrol edelim
    if (isset($_POST['sayi1']) && isset($_POST['sayi2'])) {
        
        // Formdan gelen verileri değişkenlere atayalım 
        $s1 = $_POST['sayi1'];
        $s2 = $_POST['sayi2'];
        
        // Aritmetik toplama işlemi 
        $toplam = $s1 + $s2;
        
        // Sonucu HTML içine birleştirerek yazdıralım 
        echo "<h3>İşlem Sonucu</h3>";
        echo "<p>$s1 + $s2 = <b>$toplam</b></p>";
    }
    ?>

</body>
</html>

