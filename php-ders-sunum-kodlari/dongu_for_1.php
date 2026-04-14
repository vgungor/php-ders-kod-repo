<?php

for ($dilim = 1; $dilim <= 8; $dilim++) {    
    echo $dilim . ". dilimi aldım!<br>";
}

$toplam = 0; 
for ($i = 1; $i <= 100; $i++) {    
	$toplam += $i;
	 echo $i . "<br>";
}
echo "1'den 100'e kadar olan sayıların toplamı: " . $toplam;


for ($i = 1; $i <= 10; $i++) {
   echo "5 x " . $i . " = " . (5 * $i) . "<br>";
}

?>