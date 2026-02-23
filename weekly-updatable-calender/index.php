<?php
// --- FORM İŞLEME MANTIĞI ---
$mesaj = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sifre = $_POST['sifre'] ?? '';
    
    if ($sifre === 'merhaba') {
        // Gelen saati 24 saat formatında (HH:mm) garantiye alalım
        $baslangic = date("H:i", strtotime($_POST['baslangic']));
        $bitis = date("H:i", strtotime($_POST['bitis']));

        $yeni_ders = [
            "ders_adi"  => $_POST['ders_adi'],
            "gun"       => $_POST['gun'],
            "baslangic" => $baslangic,
            "bitis"     => $bitis,
            "sube"      => $_POST['sube'],
            "derslik"   => $_POST['derslik']
        ];

        // Mevcut veriyi oku
        $jsonData = file_get_contents('dersler.json');
        $dersler = json_decode($jsonData, true);
        
        // Yeni dersi ekle
        $dersler[] = $yeni_ders;
        
        // JSON dosyasına geri yaz
        if (file_put_contents('dersler.json', json_encode($dersler, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
            $mesaj = "<p style='color:green; font-weight:bold;'>Ders başarıyla eklendi!</p>";
        } else {
            $mesaj = "<p style='color:red;'>Hata: Dosya yazılamadı.</p>";
        }
    } else {
        $mesaj = "<p style='color:red;'>Hata: Geçersiz şifre!</p>";
    }
}

// --- TAKVİM VERİSİ HAZIRLIĞI ---
$jsonData = file_get_contents('dersler.json');
$dersler = json_decode($jsonData, true);
$gunler = ["Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma"];

$saat_seti = [];
foreach ($dersler as $ders) {
    $saat_seti[] = $ders['baslangic'];
}
$saatler = array_unique($saat_seti);
sort($saatler); 

$matris = [];
foreach ($dersler as $ders) {
    $matris[$ders['gun']][$ders['baslangic']] = $ders;
}
$atlanan_hucreler = []; 
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Akademik Takvim Yönetimi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2>Yeni Ders Ekle</h2>
        <?php echo $mesaj; ?>
        <form method="POST" action="">
          <div class="form-row">
              <input type="text" name="ders_adi" placeholder="Ders Adı (Örn: Web Prog.)" required>
              
              <select name="gun" required>
                  <option value="" disabled selected>Gün Seçin</option>
                  <?php foreach ($gunler as $g): ?>
                      <option value="<?php echo $g; ?>"><?php echo $g; ?></option>
                  <?php endforeach; ?>
              </select>

              <div class="input-group">
                  <small>Başlangıç - öğleden sonra için PM</small>
                  <input type="time" name="baslangic" required title="Lütfen 24 saat formatına göre seçin (AM/PM sistemindeyse öğleden sonra için PM seçiniz)">
              </div>

              <div class="input-group">
                  <small>Bitiş - öğleden sonra için PM</small>
                  <input type="time" name="bitis" required title="Lütfen 24 saat formatına göre seçin">
              </div>

              <input type="text" name="sube" placeholder="Şube" required>
              <input type="text" name="derslik" placeholder="Derslik" required>
              <input type="password" name="sifre" placeholder="Şifre" required>
              <button type="submit">Ekle</button>
          </div>
        </form>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th class="corner-cell">Saat</th>
                    <?php foreach ($gunler as $gun): ?>
                        <th><?php echo $gun; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($saatler as $s_index => $saat): ?>
                    <tr>
                        <td class="saat-kolonu"><?php echo $saat; ?></td>
                        <?php foreach ($gunler as $gun): ?>
                            <?php 
                            if (isset($atlanan_hucreler[$gun][$saat])) continue;

                            if (isset($matris[$gun][$saat])): 
                                $d = $matris[$gun][$saat];
                                $rowspan = 1;
                                $temp_index = $s_index + 1;
                                while (isset($saatler[$temp_index]) && $saatler[$temp_index] < $d['bitis']) {
                                    $atlanan_hucreler[$gun][$saatler[$temp_index]] = true;
                                    $rowspan++;
                                    $temp_index++;
                                }
                            ?>
                                <td rowspan="<?php echo $rowspan; ?>">
                                    <?php 
                                        $isMvg = (strpos($d['ders_adi'], '[MVG]') !== false);
                                        $extraClass = $isMvg ? ' ozel-ders' : '';
                                    ?>
                                    <div class="ders-item<?php echo $extraClass; ?>">
                                        <span class="ders-name"><?php echo $d['ders_adi']; ?></span>
                                        <div class="ders-info">
                                            <strong>Şube:</strong> <?php echo $d['sube']; ?> | 
                                            <strong>Derslik:</strong> <?php echo $d['derslik']; ?><br>
                                            <span class="time-badge"><?php echo $d['baslangic'] . "-" . $d['bitis']; ?></span>
                                        </div>
                                    </div>
                                </td>
                            <?php else: ?>
                                <td class="empty-cell"></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>