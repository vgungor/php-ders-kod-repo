<!DOCTYPE html>
<html>
<body>
    <?php
        // Sunumdaki örnek: Hizmetler dizisi
        $dizi = ["Saç Kesimi", 2, "Cilt Bakımı",3,77, true, null];
    ?>

    <!-- <?php echo $dizi;?> // Dizi doğrudan ekrana yazdırılamaz, bu bir hata verecektir. -->
    <h2>Dizi İçeriği: print_r ile</h2>";
    <?php print_r($dizi);?>

    <pre>
        <?php print_r($dizi);?>
    </pre>
    
    <?php print_r($dizi[0]);?>
    <br>
    <?php echo($dizi[1]);?>
    <br>
    <?php echo($dizi[2]);?>

    <h2>Dizi İçeriği: var_dump ile</h2>";
    <?php var_dump($dizi);?>
</body>
</html>