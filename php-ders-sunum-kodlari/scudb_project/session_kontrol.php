<?php
session_start();

if (!isset($_SESSION["giris_yapildi"])) {
    header("Location: login.php");
    exit;
}
?>