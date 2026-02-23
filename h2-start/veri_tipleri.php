<?php
// 1. String (Metinsel) - Çift veya tek tırnak içinde yazılır
$metin = "İEÜ Bilgisayar Prog. PHP"; 

// 2. Integer (Tam Sayı) - Ondalık içermeyen sayılar
$tamSayi = 2026; 

// 3. Float (Ondalıklı Sayı) - Virgüllü (noktalı) sayılar
$ondalikSayi = 150.75; 

// 4. Boolean (Mantıksal) - Doğru veya Yanlış (true/false)
$mantiksal = TRUE; 

// 5. Array (Dizi) - Birden fazla değeri tek değişkende tutar
$dizi = array("Saç Kesimi", "Sakal Tıraşı", 150);

$dizi_sozluk = array ( "ad" => "Ali", "soyad" => "Yazar",);

// 6. NULL - Değişkenin boş olduğunu belirtir
$bosVeri = null;

// 7. Object (Nesne)
// 1. Sınıf (Şablon) Tanımlama
class Berber {
    public $isim;
    public $uzmanlik;

    // Nesne oluşturulduğunda çalışan fonksiyon
    public function __construct($ad, $alan) {
        $this->isim = $ad;
        $this->uzmanlik = $alan;
    }

    public function selamVer() {
        return "Merhaba, ben " . $this->isim . ". Uzmanlık alanım: " . $this->uzmanlik;
    }
}

// 2. Nesne (Object) Oluşturma
$berberNesnesi = new Berber("Volkan", "Saç Tasarımı");

// 3. Yapısını İnceleme
echo "<h2>Object Veri Tipi Yapısı:</h2>";
var_dump($berberNesnesi); 

echo "<br><br>";
// Nesne içindeki metoda erişim
echo $berberNesnesi->selamVer();


// --- var_dump() ile Veri Tiplerini İnceleyelim ---
echo "<h2>Değişkenlerin Yapısı (var_dump):</h2>";

echo "Metin Değişkeni: ";
var_dump($metin);      // Çıktı: string(10) "İEÜ Bilgisayar Prog. PHP" (Karakter sayısını da verir)
echo "<br>";
echo "<hr>";

echo "Yıl: ";
var_dump($tamSayi);    // Çıktı: int(2026)
echo "<br>";
echo "<hr>";

echo "Fiyat: ";
var_dump($ondalikSayi); // Çıktı: float(150.75)
echo "<br>";
echo "<hr>";

echo "Durum: ";
var_dump($mantiksal);  // Çıktı: bool(true)
echo "<br>";
echo "<hr>";

print "Hizmetler Dizisi: ";
var_dump($dizi);       // Çıktı: Dizinin her bir elemanının tipini ve değerini listeler
echo "<br>";
echo "<hr>";

echo "Sözlük Dizisi: ";
var_dump($dizi_sozluk); 
echo "<br>";
echo "dizinin \"ad\" indexli elemanını yaz";
echo $dizi_sozluk["ad"];    // Çıktı: Dizinin her bir elemanının tipini ve değerini listeler
echo "<br>";
echo "<hr>";


echo "Boş Değişken: ";
var_dump($bosVeri);    // Çıktı: NULL
echo "<hr>";
?>