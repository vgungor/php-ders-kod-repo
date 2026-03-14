<?php
$ogrenciler = [
    ["Ali", 20, "Bilgisayar"],
    ["Ayşe", 21, "Endüstri"],
    ["Mehmet", 19, "Matematik"],
    ["Volkan", 45, "EHB", "MIS"],
];

echo $ogrenciler[0][0]; // Ali
echo "<br>";
echo $ogrenciler[0][1]; // 20
echo "<br>";
echo $ogrenciler[0][2]; // Bilgisayar
echo "<br>";
echo $ogrenciler[1][0]; // Ayşe
echo "<br>";
echo $ogrenciler[1][1]; // 21
echo "<br>";
echo $ogrenciler[1][2]; // Endüstri
echo "<br>";
echo $ogrenciler[2][0]; // Mehmet
echo "<br>";
echo $ogrenciler[2][1]; // 19
echo "<br>";
echo $ogrenciler[2][2]; // Matematik
echo "<br>";
echo $ogrenciler[3][0]; // Volkan
echo "<br>";
echo $ogrenciler[3][3]; // MIS
echo "<br>";


echo "<hr>";
echo "<h3>Foreach ile Çok Boyutlu Dizi</h3>";
foreach ($ogrenciler as $ogrenci) {
    echo "Ad: " . $ogrenci[0] . ", Yaş: " . $ogrenci[1] . ", Bölüm: " . $ogrenci[2] . "<br>";
}
?>