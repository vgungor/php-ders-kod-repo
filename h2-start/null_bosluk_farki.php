<?php
$a='';
$b=null;
 
if(isset($a)): echo "isset '' = true <br>"; else: echo "isset '' = false <br>"; endif;
if(isset($b)): echo "isset null = true <br>"; else: echo "isset null = false <br>"; endif;
echo "<br>";
if(empty($a)): echo "empty '' = true <br>"; else: echo "empty '' = false <br>"; endif;
if(empty($b)): echo "empty null = true <br>"; else: echo "empty null = false <br>"; endif;
echo "<br>";
if(is_null($a)): echo "is_null '' = true <br>"; else: echo "is_null '' = false <br>"; endif;
if(is_null($b)): echo "is_null null = true <br>"; else: echo "is_null null = false <br>"; endif;
echo "<br>";
if($a==$b): echo "''==null true <br>"; else: echo "''==null false <br>"; endif;
if($a===$b): echo "''===null true <br>"; else: echo "''===null false <br>"; endif;
?>

<hr>
Bir değişkene değer atanmamışsa, veya değeri sıfır yada boş alfanümerik (null string) ise, doğru TRUE değerini döndürür.
<br>
<?php
$veri = "";
 if(empty($veri)){
    echo "Değişken değeri boş veya geçersiz değer";
}

?>
<!-- Ekrandaki çıktı: Değişken değeri boş veya geçersiz değer -->
<hr>
<?php
$veri = null;
 if(empty($veri)){
    echo "Değişken değeri boş veya geçersiz değer";
}
?>