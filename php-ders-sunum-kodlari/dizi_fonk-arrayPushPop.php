<?php

// Bir kullanıcı profili dizisi (Associative Array)
$dersler = ["MBP214", "MBP192"];

echo "<pre>";
print_r($dersler); 
echo "</pre>";

array_push($dersler, "MBP216", "MBP200");
echo "array_push() sonrası: <br>";
echo "<pre>";
print_r($dersler); 
echo "</pre>";

$sonEleman = array_pop($dersler);
echo "array_pop() ile çıkarılan eleman: " . $sonEleman . "<br>";
echo "array_pop() sonrası: <br>";   
echo "<pre>";
print_r($dersler);
echo "</pre>";

array_unshift($dersler, "MBP519");
echo "array_unshift() sonrası: <br>";   
echo "<pre>";
print_r($dersler);
echo "</pre>";

$ilkEleman = array_shift($dersler);
echo "array_shift() ile çıkarılan eleman: " . $ilkEleman . "<br>";
echo "array_shift() sonrası: <br>";     
echo "<pre>";
print_r($dersler);
echo "</pre>";

?>