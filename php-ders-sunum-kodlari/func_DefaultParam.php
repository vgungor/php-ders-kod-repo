<?php 
function selamla($isim = "Misafir") {
    echo "Merhaba $isim!<br>";
}

selamla("Ahmet"); // Çıktı: Merhaba Ahmet!
selamla();        // Çıktı: Merhaba Misafir! 

function kahveYap($isim, $tur = "Türk Kahvesi", $seker = 0) {
    echo "$isim için $seker 
        şekerli bir $tur hazırlanıyor...<br>";
}

kahveYap("Volkan");           
kahveYap("Espresso");         
kahveYap("Latte", 2);   
kahveYap("Volkan", "Latte", 2);        
?>

