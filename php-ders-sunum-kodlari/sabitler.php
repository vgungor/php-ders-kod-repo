<!DOCTYPE html>
<html>
<body>
    <?php
    // define("SABİT_ADI", "değer");
    define("VERITABANI", "berber_otomasyon");
    define("KDV_ORANI", 0.20);

    const SITE_URL = "https://www.google.com";

    echo "Bağlanılan Veritabanı: " . VERITABANI . "<br>";
    echo "Uygulanan KDV: " . (KDV_ORANI * 100) . "% <br>";

    echo "<a href='" . SITE_URL . "'>Google'a Git</a>";
    ?>
</body>
</html>