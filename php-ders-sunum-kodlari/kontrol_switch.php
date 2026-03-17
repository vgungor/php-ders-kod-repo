<?php
$hava = "Gunesli";

switch ($hava) {
    case "Yagmurlu":
        echo "Semsiyeni yanina almayi unutma";
        break;

    case "Gunesli":
        echo "Hafif giyin";

    case "Bulutlu":
        echo "Disari cik";
        break;

    case "Karli":
        echo "Kalin giyin";
        break;

    case "Firtinali":
        echo "Bir süre disari cikma";
        break;

    default:
        echo "Bilinmeyen hava durumu: " . $hava;
        break;
}
?>