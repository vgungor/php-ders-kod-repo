<?php
require_once "db.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = "DELETE FROM ogrenciler WHERE ogrenci_id = ?";

    $stmt = mysqli_prepare($baglanti, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    $sonuc = mysqli_stmt_execute($stmt);

    if ($sonuc) {
        header("Location: index.php");
        exit;
    } else {
        echo "Silme işlemi başarısız.";
    }
}
?>