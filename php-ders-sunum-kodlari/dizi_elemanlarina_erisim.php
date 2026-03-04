
<pre>
<?php
$hizmetler = [
    "Saç Kesimi", 
    "Sakal Tıraşı", 
    "Cilt Bakımı"];
print_r ($hizmetler)
?>
</pre>
<?php
// Sunumdaki örnek: Hizmetler dizisi 


print_r("0. indis - ilk edizi elemanı: $hizmetler[0]"); // Saç Kesimi
echo "<br>";
print_r("1. indis - ikinci edizi elemanı: $hizmetler[1]"); // Sakal Tıraşı
echo "<br>";
print_r("2. indis - üçüncü edizi elemanı: $hizmetler[2]"); // Cilt Bakımı
echo "<br>";
try {
    print_r("3. indis - dördüncü edizi elemanı: $hizmetler[3]"); // Hata verir, çünkü 3. indis yok
} catch (\Throwable $th) {
    print_r($th);
} finally {
    echo "<br>";
    print("3. indis olmadığı için hata döner.");
    echo "<br>";
    echo "Finally her zaman çalışır, hata olsa da olmasa da.";
}


?>
<?php
print_r($hizmetler[0]); // Saç Kesimi
print_r($hizmetler[1]); // Sakal Tıraşı
print_r($hizmetler[2]); // Cilt Bakımı
?>