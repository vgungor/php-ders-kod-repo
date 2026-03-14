<?php
echo '<h4>array_merge($ders1_ogrencileri, 
$ders2_ogrencileri)</h4>';

$ders1_ogrencileri = ["Ali", "Veli", "Deli"];
$ders2_ogrencileri = ["Gelir", "Mi", "Geri"];
echo "<pre>";
print_r($ders1_ogrencileri); 

echo "</pre>";
echo "<pre>";
print_r($ders2_ogrencileri); 
echo "</pre>";

$birlesikDizi = array_merge($ders1_ogrencileri, $ders2_ogrencileri);
echo "<pre>";
print_r($birlesikDizi); 
// ["Ali", "Veli", "Deli", "Gelir", "Mi", "Geri"]
echo "</pre>";

echo '<h4>array_slice($birlesikDizi,1,2)</h4>';
echo '<pre>dizi1\'den 
1. indexten başla. 
2 eleman al</pre>';

$dizi = array_slice($birlesikDizi,1,2);
echo "<pre>";
print_r($dizi);
// ["Veli", "Deli"]
echo "</pre>";

echo '<h4>array_unique($tekrarliDizi)</h4>';
$tekrarliDizi = ["Ali", "Veli", "Deli", "Ali", "Veli"];
echo "<pre>";
print_r($tekrarliDizi);
echo "</pre>";
$benzersizDizi = array_unique($tekrarliDizi);
echo "<pre>";
print_r($benzersizDizi);
// ["Ali", "Veli", "Deli"]
echo "</pre>";

?>