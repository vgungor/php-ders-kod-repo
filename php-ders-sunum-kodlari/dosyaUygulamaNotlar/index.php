<?php
// 1. JSON dosyasını oku
$json_verisi = file_get_contents("ogrenciler.json");
$veri_seti = json_decode($json_verisi, true);

$sonuclar_listesi = []; // Yeni JSON için dizi

echo "<h2>Dönem Sonu Not Çizelgesi</h2>";
echo "<table border='1' cellpadding='10' style='border-collapse: collapse; width: 100%; text-align: left;'>
        <tr style='background-color: #f2f2f2;'>
            <th>Okul No</th>
            <th>Ad Soyad</th>
            <th>Vize</th>
            <th>Ödev</th>
            <th>Proje</th>
            <th>Final</th>
            <th>Ortalama</th>
            <th>Harf Notu</th>
            <th>Durum</th>
        </tr>";

foreach ($veri_seti['ogrenciler'] as $ogrenci) {
    $n = $ogrenci['notlar'];
    
    // 2. Ağırlıklı Ortalama Hesaplama
    $ortalama = ($n['vize'] * 0.25) + ($n['odev'] * 0.25) + ($n['proje'] * 0.05) + ($n['final'] * 0.45);
    
    // 3. Harf Notu ve Statü Belirleme (Match veya If-Else yapısı)
    $harf_notu = "";
    $statu = "";
    $katsayi = 0;

    if ($ortalama >= 90) { $harf_notu = "AA"; $katsayi = 4.0; $statu = "Başarılı"; }
    elseif ($ortalama >= 85) { $harf_notu = "BA"; $katsayi = 3.5; $statu = "Başarılı"; }
    elseif ($ortalama >= 80) { $harf_notu = "BB"; $katsayi = 3.0; $statu = "Başarılı"; }
    elseif ($ortalama >= 75) { $harf_notu = "CB"; $katsayi = 2.5; $statu = "Geçer"; }
    elseif ($ortalama >= 70) { $harf_notu = "CC"; $katsayi = 2.0; $statu = "Geçer"; }
    elseif ($ortalama >= 65) { $harf_notu = "DC"; $katsayi = 1.5; $statu = "Koşullu Geçer"; }
    elseif ($ortalama >= 60) { $harf_notu = "DD"; $katsayi = 1.0; $statu = "Koşullu Geçer"; }
    elseif ($ortalama >= 50) { $harf_notu = "FD"; $katsayi = 0.5; $statu = "Başarısız"; }
    else { $harf_notu = "FF"; $katsayi = 0.0; $statu = "Başarısız"; }

    // Tabloya Yazdır
    echo "<tr>
            <td>{$ogrenci['okul_no']}</td>
            <td>{$ogrenci['ad_soyad']}</td>
            <td>{$n['vize']}</td>
            <td>{$n['odev']}</td>
            <td>{$n['proje']}</td>
            <td>{$n['final']}</td>
            <td><strong>" . number_format($ortalama, 2) . "</strong></td>
            <td><strong>$harf_notu</strong></td>
            <td>$statu</td>
          </tr>";

    // 4. Yeni JSON verisi için diziye ekle
    $sonuclar_listesi[] = [
        "okul_no" => $ogrenci['okul_no'],
        "ad_soyad" => $ogrenci['ad_soyad'],
        "donem_sonu_notu" => round($ortalama, 2),
        "harf_notu" => $harf_notu,
        "katsayi" => $katsayi,
        "statu" => $statu
    ];
}
echo "</table>";

// 5. Yeni JSON dosyasını oluştur ve kaydet
$yeni_json = json_encode(["sonuclar" => $sonuclar_listesi], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents("donem_sonu_sonuclar.json", $yeni_json);

echo "<p><em>'donem_sonu_sonuclar.json' dosyası başarıyla oluşturuldu.</em></p>";
?>