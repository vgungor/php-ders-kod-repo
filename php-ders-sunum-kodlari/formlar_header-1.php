<?php

$kalan =5;
?>

<div id="sayac"></div>

<script>
var kalanSaniye = <?php echo $kalan; ?>;
function sayac() {
    var sn = Math.floor(kalanSaniye % 60);

    document.getElementById('sayac').innerHTML = sn + "s";
    
    if (kalanSaniye > 0) {
        kalanSaniye--;
    }
}
setInterval(sayac, 1000);
</script>


<?php
echo "Form verileri işlendi. Şimdi kullanıcıyı ana sayfaya yönlendiriyoruz...";

// Kullanıcıyı ana sayfaya yönlendir
// header("Location: formlar_header_Yonlendirme.php");
header("Refresh: 5; url=formlar_header_Yonlendirme.php"); // 5 saniye sonra sayfa.php'ye yönlendir
exit; // Yönlendirmeden sonra kodun çalışmaya devam etmemesi için 'exit' şarttır.
?>