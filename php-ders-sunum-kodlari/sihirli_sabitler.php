<!DOCTYPE html>
<html>
<body>
    <?php
    // Sihirli Sabitler: PHP 8.1 ile gelen yeni özellikler
    // __LINE__, __FILE__, __DIR__, __FUNCTION__, __CLASS__, __TRAIT__, __METHOD__, __NAMESPACE__ gibi sabitler artık sınıf, fonksiyon veya dosya bağlamında daha anlamlı bilgiler sağlar.
    // Örneğin: __LINE__ içinde bulunduğu satır numarasını, __FILE__ dosya yolunu, __DIR__ dizin yolunu verir.
    // Bu sabitler hata ayıklama ve dinamik içerik oluşturma gibi durumlarda oldukça faydalıdır.
    echo "__LINE__ ÇIKTISI: Bu satırın numarası: " . __LINE__ . "<br>";
    echo "__FILE__ ÇIKTISI: Bu dosyanın yolu: " . __FILE__ . "<br>";
    echo "__DIR__ ÇIKTISI: Bu dizinin yolu: " . __DIR__ . "<br>";

    function testFonksiyonu() {
        echo "__FUNCTION__ ÇIKTISI: Şu an çalışan fonksiyon: " . __FUNCTION__ . "<br>"; // 
    }

    testFonksiyonu();    ?>


    
    <?php
    //SORU: Aşağıdaki kod parçacığında __LINE__ sabiti kaç değerini döndürür?
    echo __LINE__; // Satır 23
    echo "<br>";
    echo __LINE__; // Satır 25
    ?>
</body>
</html>