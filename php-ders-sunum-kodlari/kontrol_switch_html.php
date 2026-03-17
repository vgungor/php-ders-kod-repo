<?php
$siparisDurumu = "kargoda"; // beklemede, kargoda, tamamlandi
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

    <div class="card w-50">
        <div class="card-body">
            <h5 class="card-title">Sipariş Takibi</h5>
            <p class="card-text">Sipariş No: #45821</p>
            
            <?php
            switch ($siparisDurumu) {
                case "beklemede":
                    echo '<span class="badge bg-warning text-dark">Sipariş Hazırlanıyor</span>';
                    break;
                case "kargoda":
                    echo '<span class="badge bg-info text-white">Ürün Kargoya Verildi</span>';
                    break;
                case "tamamlandi":
                    echo '<span class="badge bg-success">Teslim Edildi</span>';
                    break;
                default:
                    echo '<span class="badge bg-secondary">Durum Bilinmiyor</span>';
                    break;
            }
            ?>
            
        </div>
    </div>

</body>
</html>