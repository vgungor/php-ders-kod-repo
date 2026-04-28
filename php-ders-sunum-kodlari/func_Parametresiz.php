<?php
/**
 * Dosya adını parçalayarak öğrenci bilgilerini döndürür.
 * * @param string $dosyaAdi Parçalanacak dosya adı
 * @return array|bool Başarılıysa dizi, format hatalıysa false döner.
 */
function dosyaBilgileriniCozumle($dosyaAdi) {
    // Uzantıyı temizle
    $temizAd = pathinfo($dosyaAdi, PATHINFO_FILENAME);
    
    // Parçala
    $parcalar = explode("_", $temizAd);
    print_r($parcalar); // Parçaların doğru ayrıldığını görmek için

    // Format kontrolü
    if (count($parcalar) === 5) {
        return [
            'ogrenci_no' => $parcalar[0],
            'ad_soyad'   => $parcalar[1],
            'ders'       => $parcalar[2],
            'sube'       => $parcalar[3],
            'proje'      => $parcalar[4]
        ];
    }

    return false; // Format uygun değilse
}

// --- KULLANIM ÖRNEĞİ ---

$ornekDosya = "2520XXXX_MVolkanGungor_MBP192-102-SubeX_Proje.docx";
$sonuc = dosyaBilgileriniCozumle($ornekDosya);

if ($sonuc) {
    echo "<h3>Fonksiyon Çıktısı:</h3>";
    echo "Öğrenci No: " . $sonuc['ogrenci_no'] . "<br>";
    echo "Ad Soyad: " . $sonuc['ad_soyad'] . "<br>";
    echo "Ders: " . $sonuc['ders'] . "<br>";
    echo "Şube: " . $sonuc['sube'] . "<br>";
    echo "Proje: " . $sonuc['proje'];
} else {
    echo "Hata: Dosya adı formatı uygun değil! Proje Ödevinden 0 aldınız...";
}
?>