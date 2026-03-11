
<!DOCTYPE html>
<html>
<body>
    <?php
        $hizmetler = [
            "Saç Kesimi" => "200 TL",
            "Sakal Tıraşı" => "150 TL",
            "Cilt Bakımı" => "250 TL"
        ];
    ?>

    <pre>
        <?php print_r($hizmetler);?>
    </pre>
    
    <?php print_r($hizmetler["Saç Kesimi"]);?> <!--  200 TL -->
    <br>
     <?php echo($hizmetler["Sakal Tıraşı"]);?> <!--  150 TL -->
    <br>
     <?php echo($hizmetler["Cilt Bakımı"]);?> <!--  250 TL -->
    <br>
     <?php echo($hizmetler[3]);?> <!--  Hata verir,      
        çünkü 3. indis yok, çünkü bu bir ilişkili dizi ve anahtarlar string -->

</body>
</html>