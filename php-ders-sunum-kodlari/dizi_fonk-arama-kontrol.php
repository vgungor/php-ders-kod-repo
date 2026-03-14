<?php
    $dersler = ["MBP214","MBP192","MBP101"];

    if(in_array("MBP192",$dersler)){
        echo "Ders dizide var";
    }else{
        echo "Ders yok";
    }

    $ogrenci = [
        "ad" => "Ali",
        "soyad" => "Yılmaz",
        "yas" => 21
        ];
    if(array_key_exists("yas",$ogrenci)){
        echo "Anahtar mevcut";
    }else{
        echo "Anahtar yok";
    }


    if(array_key_exists("yas",$ogrenci)){
        echo "Anahtar mevcut";
    }else{
        echo "Anahtar yok";
    }

?>