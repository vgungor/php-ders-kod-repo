<h3>Çerez Oluşturma, Okuma ve Silme</h3>
<h4>Çerez Oluşturma</h4>
<?php
// "kullanici" adında bir çerez oluşturuyoruz, değeri "Volkan"
// time() + 3600 ifadesi, şu andan itibaren 1 saat (3600 saniye) geçerli olacağını söyler.
setcookie("kullanici", "Volkan", time() + 3600, "/"); 

// Sadece HTTPS üzerinden ve sadece HTTP (JavaScript erişemez) ile çalışacak güvenli çerez:
setcookie("dil", "tr", time() + (86400 * 30), "/", "", true, true);
?>

<p>Çerez oluşturuldu. Lütfen İncele(inspect F12) >> Uygulama(Application) >> Cookies altında kullnıcı cookie varlığını kontrol ediniz. Sonra aşağıdaki kodu çalıştırınız.

</p>
<h4>Çerez Okuma</h4>
<?php
if(isset($_COOKIE["kullanici"])) {
    echo "Hoş geldin " . $_COOKIE["kullanici"];
} else {
    echo "Çerez bulunamadı veya süresi dolmuş.";
}
?>
<h4>Çerez Silme</h4>
<?php
// Süreyi mevcut zamandan 1 saat öncesine çekerek çerezi geçersiz kılıyoruz
setcookie("kullanici", "", time() - 3600, "/");
echo "Çerez silindi.";
?>