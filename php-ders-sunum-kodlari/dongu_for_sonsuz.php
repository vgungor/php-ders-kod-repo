<?php

echo "<table border='1' cellpadding='10'>";
echo "<tr>
        <th>Örnek</th>
        <th>Döngü Kodu</th>
        <th>Açıklama</th>
      </tr>";


// 1. Koşulsuz sonsuz döngü
echo "<tr><td>1</td><td>for (\$i = 0; ; \$i++)</td><td>Koşul yok → sonsuz döngü</td></tr>";

for ($i = 0; ; $i++) {
    if ($i == 1) break;
}


// 2. Sürekli artan sonsuz döngü
echo "<tr><td>2</td><td>for (\$i = 0; \$i >= 0; \$i++)</td><td>i sürekli artar → sonsuz</td></tr>";

for ($i = 0; $i >= 0; $i++) {
    if ($i == 1) break;
}


// 3. Sürekli azalan sonsuz döngü
echo "<tr><td>3</td><td>for (\$i = 0; \$i <= 0; \$i--)</td><td>i sürekli azalır → sonsuz</td></tr>";

for ($i = 0; $i <= 0; $i--) {
    if ($i == -1) break;
}


// 4. Artış yok (i sabit)
echo "<tr><td>4</td><td>for (\$i = 1; \$i <= 5; )</td><td>i değişmez → sonsuz</td></tr>";

for ($i = 1; $i <= 5; ) {
    break;
}


// 5. Negatiften başlayıp hep doğru kalan
echo "<tr><td>5</td><td>for (\$i = -1; \$i < 10; \$i--)</td><td>i azalır → koşul hep true</td></tr>";

for ($i = -1; $i < 10; $i--) {
    if ($i == -2) break;
}


echo "</table>";

?>