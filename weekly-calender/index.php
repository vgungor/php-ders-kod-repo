<?php
$jsonData = file_get_contents('dersler.json');
$dersler = json_decode($jsonData, true);

$gunler = ["Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma"];

// 1. JSON'dan tüm benzersiz başlangıç saatlerini topla ve sırala
$saat_seti = [];
foreach ($dersler as $ders) {
    $saat_seti[] = $ders['baslangic'];
}
// Eğer JSON'da olmayan standart saatler eklemek istersen buraya merge edebilirsin
$saatler = array_unique($saat_seti);
sort($saatler); 

// 2. Dersleri hızlı erişim için haritala
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
    <title>Dinamik Akademik Takvim</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
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
                            // Rowspan nedeniyle atlanması gereken hücre kontrolü
                            if (isset($atlanan_hucreler[$gun][$saat])) continue;

                            if (isset($matris[$gun][$saat])): 
                                $d = $matris[$gun][$saat];
                                
                                // Dersin kaç satır süreceğini bitiş saatine göre hesapla
                                $rowspan = 1;
                                $temp_index = $s_index + 1;
                                // Bir sonraki satırın başlangıcı, mevcut dersin bitişinden küçükse rowspan artar
                                while (isset($saatler[$temp_index]) && $saatler[$temp_index] < $d['bitis']) {
                                    $atlanan_hucreler[$gun][$saatler[$temp_index]] = true;
                                    $rowspan++;
                                    $temp_index++;
                                }
                            ?>
                                <td rowspan="<?php echo $rowspan; ?>">
                                    <?php 
                                        // Ders adında [MVG] geçip geçmediğini kontrol et
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