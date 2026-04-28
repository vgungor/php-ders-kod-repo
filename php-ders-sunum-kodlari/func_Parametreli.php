<?php

/**
 * Belirli bir klasördeki dosyaları tarar ve temiz bir dizi olarak döndürür.
 */
function dosyaListesiniGetir($dizin) {
    if (!is_dir($dizin)) return [];
    
    // Klasörü tara, . ve .. gibi sistem dizinlerini temizle
    $tumIcerik = scandir($dizin);
    $dosyalar = array_filter($tumIcerik, function($oge) use ($dizin) {
        return is_file($dizin . DIRECTORY_SEPARATOR . $oge) && !str_starts_with($oge, '.');
    });

    return $dosyalar;
}

/**
 * Dosya adını parçalar ve ilk bölümü (Öğrenci No) döndürür.
 */
function ogrenciNoAyikla($dosyaAdi) {
    $temizAd = pathinfo($dosyaAdi, PATHINFO_FILENAME);
    $parcalar = explode("_", $temizAd);
    
    return (!empty($parcalar[0])) ? $parcalar[0] : null;
}

/**
 * Klasör yolunu alarak içindeki tüm öğrenci numaralarını benzersiz bir dizi olarak döndürür.
 */
function klasordenOgrenciNolariniTopla($klasorYolu) {
    $dosyaListesi = dosyaListesiniGetir($klasorYolu);
    $ogrenciNolar = [];

    foreach ($dosyaListesi as $dosya) {
        $no = ogrenciNoAyikla($dosya);
        if ($no) {
            $ogrenciNolar[] = $no;
        }
    }

    // Aynı öğrenci birden fazla dosya yüklediyse (Rev 1, Rev 2 gibi) 
    // her numarayı sadece bir kez listelemek için:
    return array_unique($ogrenciNolar);
}

// --- KULLANIM (MAIN) ---

$hedefKlasor = "odevler/"; // Klasör ismini buraya yazın
$numaralar = klasordenOgrenciNolariniTopla($hedefKlasor);

echo "<h2>Öğrenci Numaraları Listesi</h2>";

if (!empty($numaralar)) {
    echo "<ul>";
    foreach ($numaralar as $ogrenciNo) {
        echo "<li>" . htmlspecialchars($ogrenciNo) . "</li>";
    }
    echo "</ul>";
    echo "<strong>Toplam Tekil Öğrenci Sayısı:</strong> " . count($numaralar);
} else {
    echo "<p>İşlenecek dosya bulunamadı veya klasör boş.</p>";
}

?>