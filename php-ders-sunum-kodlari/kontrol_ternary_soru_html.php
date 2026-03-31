<?php
// URL'de mod yoksa 'light' kabul et
$mod = $_GET['mod'] ?? 'light';

// Tek satırda ternary: mod 'light' ise 'dark' yap, değilse 'light' yap
$yeniMod = ($mod == 'light') ? 'dark' : 'light';
?>

<a href="?mod=<?= $yeniMod ?>">
    <?= ($mod == 'light') ? 'Karanlık Moda Geç' : 'Aydınlık Moda Geç' ?>
</a>

<style>
    body { 
        background: <?= ($mod == 'dark') ? '#222' : '#fff' ?>; 
        color: <?= ($mod == 'dark') ? '#fff' : '#222' ?>; 
    }
</style>