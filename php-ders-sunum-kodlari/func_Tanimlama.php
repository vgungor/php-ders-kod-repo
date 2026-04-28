<?php
    function selamVerPsiz() {
        echo "Merhaba Dünya";
    }

    selamVerPsiz(); // çağırma
?>


<?php
    function selamVerP($metin) {
        echo "Gelen parametre: " . $metin;
    }

    selamVerP("Merhaba, dünya!"); 
?>