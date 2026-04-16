<!DOCTYPE html>
<html>
<body>

<h3>Dizi Elemanları</h3>

<ul>
<?php

$sayilar = [10, 20, 30, 40, 50];
$i = 0;

do {
    echo "<li>" . $sayilar[$i] . "</li>";
    $i++;
} while ($i > count($sayilar));

?>
</ul>

</body>
</html>