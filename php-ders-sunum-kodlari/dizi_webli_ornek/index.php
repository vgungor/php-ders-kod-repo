<?php
session_start();

// Session dizisi yoksa oluştur
if(!isset($_SESSION['ogrenciler'])){
    $_SESSION['ogrenciler'] = [];
}

// Form işlemleri
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Öğrenci ekle
    if(isset($_POST['ekle'])){
        $isim = htmlspecialchars($_POST['isim']);
        $numara = htmlspecialchars($_POST['numara']);
        $not = htmlspecialchars($_POST['not']);

        if($isim && $numara && $not){
            $_SESSION['ogrenciler'][] = [
                'isim'=>$isim,
                'numara'=>$numara,
                'not'=>$not
            ];
        }
    }

    // Tek öğrenci sil
    if(isset($_POST['sil'])){
        $index = $_POST['sil'];
        if(isset($_SESSION['ogrenciler'][$index])){
            unset($_SESSION['ogrenciler'][$index]);
            $_SESSION['ogrenciler'] = array_values($_SESSION['ogrenciler']); // diziyi yeniden indeksle
        }
    }

    // Listeyi boşalt
    if(isset($_POST['bosalt'])){
        $_SESSION['ogrenciler'] = [];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Öğrenci Notları Yönetimi</title>
<style>
    body{font-family:Arial; padding:20px;}
    input{padding:5px; margin:5px;}
    button{padding:5px 10px; margin:3px;}
    table{border-collapse:collapse; margin-top:20px; width:60%;}
    th,td{border:1px solid #ccc; padding:8px; text-align:center;}
    th{background:#f4f4f4;}
</style>
</head>
<body>

<h2>Öğrenci Bilgi Girişi</h2>
<form method="POST">
    <input type="text" name="isim" placeholder="Öğrenci Adı" required>
    <input type="text" name="numara" placeholder="Numara" required>
    <input type="number" name="not" placeholder="Not" required>
    <button type="submit" name="ekle">Ekle</button>
</form>

<h3>Eklenen Öğrenciler</h3>

<?php if(!empty($_SESSION['ogrenciler'])): ?>
<table>
    <tr>
        <th>İsim</th>
        <th>Numara</th>
        <th>Not</th>
        <th>İşlem</th>
    </tr>
    <?php foreach($_SESSION['ogrenciler'] as $index => $ogrenci): ?>
    <tr>
        <td><?php echo $ogrenci['isim']; ?></td>
        <td><?php echo $ogrenci['numara']; ?></td>
        <td><?php echo $ogrenci['not']; ?></td>
        <td>
            <!-- Tek tek silme butonu -->
            <form method="POST" style="display:inline;">
                <button type="submit" name="sil" value="<?php echo $index; ?>">Sil</button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>
</table>

<!-- Listeyi boşaltma -->
<form method="POST" style="margin-top:10px;">
    <button type="submit" name="bosalt" style="background:#f44336; color:white;">Listeyi Boşalt</button>
</form>

<?php else: ?>
    <p>Henüz öğrenci eklenmedi.</p>
<?php endif; ?>

</body>
</html>