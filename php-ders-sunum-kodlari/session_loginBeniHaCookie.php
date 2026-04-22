<?php
// Oturum ayarlarını yap ve başlat
session_set_cookie_params(300); // Session süresi 5 dakika (örnekteki gibi)
session_start();

// --- 1. ADIM: OTOMATİK GİRİŞ KONTROLÜ ---
// Eğer kullanıcı daha önce "Beni Hatırla" demişse ve cookie varsa direkt içeri al
if (!isset($_SESSION["kullanici"]) && isset($_COOKIE["hatirla_kullanici"])) {
    $cerezdeki_kullanici = $_COOKIE["hatirla_kullanici"];
    
    // Basit doğrulama (Gerçek projede burada veritabanı kontrolü yapılır)
    if ($cerezdeki_kullanici == "admin") {
        $_SESSION["kullanici"] = "admin";
        $_SESSION["role"] = "admin";
        $_SESSION["last_activity"] = time();
        $_SESSION["Dersler"] = ["PHP", "JavaScript", "HTML", "CSS"];
        header("Location: session_adminSayfasi.php");
        exit;
    } elseif ($cerezdeki_kullanici == "user") {
        $_SESSION["kullanici"] = "user";
        header("Location: session_kullaniciSayfasi.php");
        exit;
    }
}

// --- 2. ADIM: FORM GÖNDERİLDİ Mİ KONTROLÜ ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];
    $remember = isset($_POST["remember"]); // Checkbox işaretli mi?

    $_SESSION["heryerde"] = "Heryerden erişilir...";

    // --- ADMIN GİRİŞİ ---
    if ($username == "admin" && $password == "1234") {
        $_SESSION["kullanici"] = $username;
        $_SESSION["role"] = "admin";
        $_SESSION["last_activity"] = time();
        $_SESSION["Dersler"] = ["PHP", "JavaScript", "HTML", "CSS"];
        $_SESSION["kayitBilgileri"] = [
            "kullaniciDetay" => [
                "ad" => "Volkan",
                "soyad" => "Güngör",
                "email" => "volkan@example.com"
            ]
        ];

        // Beni Hatırla seçilmişse 30 günlük cookie oluştur
        if ($remember) {
            setcookie("hatirla_kullanici", $username, time() + (86400 * 30), "/", "", false, true);
        }

        header("Location: session_adminSayfasi_Cookie.php");
        exit;
    } 
    // --- NORMAL KULLANICI GİRİŞİ ---
    elseif ($username == "user" && $password == "1234") {
        $_SESSION["kullanici"] = $username;

        if ($remember) {
            setcookie("hatirla_kullanici", $username, time() + (86400 * 30), "/", "", false, true);
        }

        header("Location: session_kullaniciSayfasi_Cookie.php");
        exit;
    } 
    // --- HATALI GİRİŞ ---
    else {
        echo "<script>alert('Hatalı kullanıcı adı veya şifre!'); window.location.href='session_login.html';</script>";
    }
} else {
    // Form post edilmeden bu sayfaya gelinirse login sayfasına at
    header("Location: session_loginBeniHatirla.html");
    exit;
}
?>