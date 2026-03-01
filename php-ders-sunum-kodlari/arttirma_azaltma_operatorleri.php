<?php
$x = 5;

echo "<h3>Artırma İşlemleri</h3>";
echo "Başlangıç: $x <br>";

// Sonradan Artırma: Önce değeri yazar, sonra artırır 
echo "Sonradan Artır (\$x++): " . $x++ . " (Hala 5 görünür) <br>";
echo "İşlem sonrası değer: $x <br><br>";

$y = 5;
// Önce Artırma: Önce değeri artırır, sonra yazar 
echo "Önceden Artır (++\$y): " . ++$y . " (Hemen 6 olur) <br>";
?>