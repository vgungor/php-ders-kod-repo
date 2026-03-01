<!-- Yerel Kapsam (Local Scope) -->
<?php
function randevuMesaji() {
    $mesaj = "Randevunuz oluşturuldu."; // Yerel kapsam
    echo $mesaj;
}

randevuMesaji();
// echo $mesaj; // HATA! Fonksiyon dışından bu değişkene erişilemez.
?>


<!-- Global Kapsam (Global Scope) -->
<?php
$berber_adi = "Volkan"; // Global kapsam

function berberGoster() {
    global $berber_adi; // Global değişkeni fonksiyon içine çağırıyoruz
    echo "Hizmet veren: " . $berber_adi;
}

berberGoster();
?>


<!-- Statik Kapsam (Static Scope) -->
<?php
function ziyaretciSayaci() {
    static $sayac = 0; // Sadece ilk çağrıda tanımlanır
    $sayac++;
    echo "Ziyaretçi sayısı: " . $sayac . "<br>";
}

ziyaretciSayaci(); // Çıktı: 1
ziyaretciSayaci(); // Çıktı: 2 (Değerini korudu)
?>