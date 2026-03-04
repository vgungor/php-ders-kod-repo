<?php
$dersler = array("MBP192", "MBP214", "MBP216");

isset($dersler[2]) ? print_r("3. ders mevcut: " . $dersler[2]) : print_r("Hata: Aradığınız ders listede bulunamadı!");

if (isset($dersler[2])) {
    echo "3. ders mevcut: " . $dersler[2];
} else {
    echo "Hata: Aradığınız ders listede bulunamadı!";
}
?>