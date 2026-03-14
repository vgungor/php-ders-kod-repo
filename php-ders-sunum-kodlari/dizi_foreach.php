<?php

$ogrenciler = [
    ["ad"=>"Ali","yas"=>20,"ders"=>"MBP214"],
    ["ad"=>"Ayşe","yas"=>22,"ders"=>"MBP192"],
    ["ad"=>"Mehmet","yas"=>21,"ders"=>"MBP305"]
];

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Çok Boyutlu Dizi Örneği</title>
<style>
    body{font-family:Arial; padding:20px;}
    table{border-collapse:collapse; width:50%;}
    th, td{border:1px solid #ccc; padding:8px; text-align:center;}
    th{background:#f4f4f4;}
</style>
</head>
<body>

<h2>Öğrenci Listesi (Çok Boyutlu Dizi)</h2>

<table>
<tr>
<th>Ad</th>
<th>Yaş</th>
<th>Ders Kodu</th>
</tr>

<?php foreach($ogrenciler as $ogrenci): ?>
<tr>
<td><?php echo $ogrenci["ad"]; ?></td>
<td><?php echo $ogrenci["yas"]; ?></td>
<td><?php echo $ogrenci["ders"]; ?></td>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>