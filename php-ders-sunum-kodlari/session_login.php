<?php
session_set_cookie_params(300); // 10 dakika
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];

    // Basit kontrol (gerçekte DB olur)
    if($username == "admin" && $password == "1234"){

        $_SESSION["kullanici"] = $username;

        header("Location: session_adminSayfasi.php");
        exit;
    }

    elseif($username == "user" && $password == "1234"){

        $_SESSION["kullanici"] = $username;

        header("Location: session_kullaniciSayfasi.php");
        exit;

    } 
    else {
        echo "Hatalı giriş";
    }
}
?>