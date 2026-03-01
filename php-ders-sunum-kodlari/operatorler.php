<?php
/**
 * PHP TEMEL KAVRAMLAR VE OPERATÖRLER REHBERİ
 * Bu dosya; değişkenler, veri tipleri, kapsamlar ve operatörleri içerir.
 */

// --- 1. DEĞİŞKEN TANIMLAMA VE KURALLAR ---
// Değişkenler $ işareti ile başlar, harf veya _ ile devam eder.
$randevuID = 101;          // Uygun: Harf ile başlar.
$_musteri = "Mustafa";     // Uygun: Alt çizgi ile başlar.
$fiyat_2026 = 250.50;      // Uygun: İçinde sayı barındırabilir.
$değişken = "Riskli";      // Riskli: Türkçe karakter (önerilmez).

/* Hatalı Tanımlamalar (Yorumdan çıkarılırsa hata verir):
$2randevu = "14:30";   // HATA: Sayı ile başlayamaz.
$toplam-tutar = 500;   // HATA: Tire kullanılamaz.
*/

// --- 2. VERİ TİPLERİ VE var_dump() ---
// PHP dinamik bir dildir; veri tipini otomatik belirler.
$metin = "MBP 192 Operatörler";   // String
$tamSayi = 42;             // Integer
$ondalik = 19.99;          // Float
$durum = true;             // Boolean
$dizi = ["Saç", "Sakal"];  // Array
$bos = null;               // NULL

// Object Veri Tipi Örneği (Nesne Yönelimli Yaklaşım)
class Berber {
    public $ad;
    public function __construct($name) { $this->ad = $name; }
}
$berberObj = new Berber("Volkan");

// --- 3. DEĞİŞKEN KAPSAMI (SCOPE) ---
$globalDegisken = "Global Alan";

function kapsamTesti() {
    $yerelDegisken = "Yerel Alan"; // Sadece fonksiyon içinde erişilir.
    global $globalDegisken;        // Dışarıdaki değişkene erişim izni.
    static $sayac = 0;             // Değerini hafızada tutar.
    $sayac++;
    return "Sayac: $sayac";
}

// --- 4. OPERATÖR TÜRLERİ ---

// A. Aritmetik
$toplam = 10 + 5; 
$mod = 10 % 3; // Kalan: 1

// B. Atama ve Birleştirme
$mesaj = "Merhaba";
$mesaj .= " Dünya"; // . birleştirme operatörüdür.

// C. Karşılaştırma ve Mantıksal
$yas = 25;
$girisIzni = ($yas >= 18 && $durum == true); // Ve (&&) operatörü.

// D. Hata Operatörü (@)
$dosya = @file("olmayan_dosya.txt"); // Hata mesajını bastırır.

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>PHP Özet Dosyası</title>
</head>
<body>
    <h1>PHP Temel Bilgiler</h1>
    
    <h3>Değişken ve Veri Tipleri Kontrolü (var_dump):</h3>
    <pre>
        <?php 
        var_dump($metin); 
        var_dump($tamSayi);
        var_dump($berberObj);
        ?>
    </pre>

    <h3>Operatör Çıktıları:</h3>
    <p>Birleştirilmiş Metin: <?php echo $mesaj; ?></p>
    <p>Hesaplanan Toplam: <?php echo $toplam; ?></p>

    <p>
        <?php 
        // HTML içinde dinamik geçiş örneği
        echo "Bu satır PHP 'echo' komutu ile HTML içine yazdırıldı."; 
        ?>
    </p>

    <h2> Operatörler</h2>
        <h3>String (Metin) Operatörleri - Birleştirme Operatörü (.)</h3>
    <?php
$ad = "Emrah";
$soyad = "Yüksel";

// Nokta (.) birleştirme operatörüdür
echo "Yazar: " . $ad . " " . $soyad; 
?>
    <h3>Aritmetik Operatörler</h3>
    <?php
        $a = 10;
        $b = 3;

        echo "Toplam: " . ($a + $b);  // Toplama: 13
        echo "<br>"; // Yeni satır
        echo "Çıkarma: " . ($a - $b);  // Çıkarma: 7
        echo "<br>"; // Yeni satır
        echo "Çarpma: " . ($a * $b);  // Çarpma: 30
        echo "<br>"; // Yeni satır  
        echo "Bölme: " . ($a / $b);  // Bölme: 3.33...
        echo "<br>"; // Yeni satır
        echo "Mod: " . ($a % $b);  // Mod (Kalan): 1
        echo "<br>"; // Yeni satır
        echo "Üs Alma: " . ($a ** $b); // Üs alma: 1000
        
    ?>
    <h3>Atama Operatörleri</h3>
    <?php
        $x = 20;      // Temel atama
        $x += 10;     // Toplayarak atama ($x = $x + 10) -> Sonuç: 30
        $x -= 5;      // Çıkararak atama ($x = $x - 5) -> Sonuç: 25
        $metinBaslik = "PHP";
        $metinDevam = " Kitabı"; // Birleştirerek atama -> Sonuç: "PHP Kitabı"
        
        echo "Atama Operatörleri, değişkenin mevcut değerini kullanarak yeni bir değer atamamıza olanak tanır.";
        echo "<br>"; // Yeni satır 
        echo "Son Değer: " . $x; // Son Değer: 25
        echo "<br>"; // Yeni satır 
        echo "<b>Metin:</b> " . $metinBaslik; // Metin: PHP Kitabı
        echo "<br>"; // Yeni satır 
        echo "Devam metni: " . $metinDevam; // Devam metni: PHP Kitabı
        echo "<br>"; // Yeni satır 
        echo "Birleştirilmiş metin: " . $metinBaslik . $metinDevam; // Birleştirilmiş metin: PHP Kitabı

        

    ?>
    <h3>Karşılaştırma Operatörleri</h3>

    <?php
        $s1 = 5;
        $s2 = "5";

        /*
        echo bir değeri string’e çevirerek ekrana basar.
        Boolean değerler string’e çevrilirken özel bir kural uygulanır:

        true  → "1"
        false → "" (boş string)

        Örnek:
        echo true;   // 1
        echo false;  // hiçbir şey basmaz

        Bu yüzden:

        echo "5 eşit mi 3?: " . (5 == 3);

        Burada (5 == 3) → false
        false string’e çevrilince → ""
        Bu nedenle ekranda boş görünür.
        */

        echo "<pre>
            echo bir değeri string’e çevirerek ekrana basar.
            Boolean değerler string’e çevrilirken özel bir kural uygulanır:

            true  → \"1\"
            false → \"\" (boş string)

            Yani:

            echo true;   // 1
            echo false;  // hiçbir şey basmaz

            Bu yüzden:

            echo \"5 eşit mi 3?: \" . (5 == 3);

            Burada (5 == 3) → false
            false string’e çevrilince → \"\"
            Bu nedenle ekranda boş görünür.
            </pre>";

        echo "Eşit mi?: ". ($s1 == $s2). "-----"; // Eşit mi? true (Değerler eşit ama tipler farklı; int vs string)
        echo "<br>"; // Yeni satır 
        echo "5 eşit mi 3?: ". (5 == 3); 
        echo "<br>"; // Yeni satır 
        echo "Özdeş mi?: ". ($s1 === $s2). "-----";        
        var_dump($s1 === $s2); // Özdeş mi? false (Değerler aynı ama tipler farklı; int vs string)
        echo "<br>"; // Yeni satır 
        echo "Eşit değil mi?: ". ($s1 != $s2). "-----";
        var_dump($s1 != $s2);  // Eşit değil mi? false
        echo "<br>"; // Yeni satır 
        echo "Büyük mü?: ". ($s1 > 3). "-----";
        var_dump($s1 > 3);     // Büyük mü? true
        echo "<br>"; // Yeni satır 
        echo "Küçük mü?: ". ($s1 < 10). "-----";
        var_dump($s1 < 10);    // Küçük mü? true
        echo "<br>"; // Yeni satır 
        echo "Büyük veya eşit mi?: ". ($s1 >= 5);   
        var_dump($s1 >= 5);   // Büyük veya eşit mi? true
        echo "<br>"; // Yeni satır
        echo "Spaceship: ". ($s1 <=> 10);
        var_dump($s1 <=> 10);  // Spaceship: -1 (Sol taraf küçük olduğu için)
    ?>
    <h3>Mantıksal Operatörler</h3>
    <?php
        $ehliyet = true;
        $yas = 20;

        // VE (&&): Her iki koşul da doğru olmalı
        if ($ehliyet && $yas >= 18) {
            echo "Araç kullanabilir.";
        }

        // VEYA (||): En az bir koşul doğru olmalı
        if ($yas < 18 || $ehliyet == false) {
            echo "Yasal engel var.";
        }
    ?>
    <h3>Artırma ve Azaltma Operatörleri</h3>
    <?php
        $sayi = 10;
        echo $sayi;
        echo "<br>"; // Yeni satır
        echo "++sayi: " . ++$sayi; // Önce artır, sonra yazdır: 11
        echo "<br>"; // Yeni satır
        echo "sayi++: " . $sayi++; // Önce yazdır (11), sonra artır (arka planda 12 oldu)
        echo "<br>"; // Yeni satır
        echo "sayi++ sonrası değer: " . $sayi;
        echo "<br>"; // Yeni satır
        echo "--sayi: " . --$sayi; // Önce azalt, sonra yazdır: 11
    ?>
    <h3>Hata Kontrol Operatörü (@)</h3>
    <?php
        // Dosya yoksa bile ekrana hata basmaz, işlemi sessizce geçer
        $dosya = @file("gizli_veriler.txt"); 
    ?>

    
</body>
</html>