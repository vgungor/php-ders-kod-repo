<h3>POST Metodu ile Form İşlemleri</h3>             
<h4> Kullanıcı Giriş Formu </h4>
<form action="formlar_Islem.php" method="POST">
    Kullanıcı Adı: <input type="text" name="ad"><br>
    Şifre: <input type="text" name="sifre"><br>
    <input type="submit" value="Giriş Yap" name="kullanici_giris">
</form>
<h4> Admin Giriş Formu </h4>
<form action="formlar_Islem.php" method="POST">
    Admin: <input type="text" name="ad"><br>
    Admin Şifre: <input type="text" name="sifre"><br>
    <button type="submit" name="admin_giris" value="Admin Giriş Yap">Admin Giriş Yap</button>
</form>