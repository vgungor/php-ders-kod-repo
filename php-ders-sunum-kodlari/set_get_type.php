<pre>settype() değişkenin kendisini değiştirir</pre>
<?php


$deger = "100";
echo gettype($deger); // string

settype($deger, "integer");

echo "<br>";
echo gettype($deger); // integer
echo "<br>";
echo $deger; // 100

?>
<pre>gettype() uygulama ve çıktı</pre>
<?php

$a = 10;
$b = 10.5;
$c = "Merhaba";
$d = true;
$e = [1, 2, 3];

echo gettype($a); // integer
echo "<br>";
echo gettype($b); // double
echo "<br>";
echo gettype($c); // string
echo "<br>";
echo gettype($d); // boolean
echo "<br>";
echo gettype($e); // array

?>
<pre>gettype() örnek</pre>
<?php

$deger = "123";
echo gettype($deger); // string

$deger = intval($deger);
echo "<br>";
echo gettype($deger); // integer

?>