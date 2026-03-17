<?php
// Bu değeri "user" yaparak "Yetkiniz Yok" mesajını görebilirsiniz.
$kullaniciRolu = "admin"; // "admin" veya "user"
?>


<h3>Ürün Yönetim Paneli</h3>
<hr>

<?php if ($kullaniciRolu == "admin"): ?>
    <div>
        <p>Hoş geldin Yönetici. Tüm yetkiler tanımlandı.</p>
        <button>
            ❌ Veriyi Kalıcı Olarak Sil
        </button>
    </div>

<?php else: ?>
    <div>
        <p><strong>Uyarı:</strong> 
        Bu işlem için yetkiniz bulunmamaktadır.</p>
        <p>Lütfen sistem yöneticisi ile iletişime geçin.</p>
    </div>

<?php endif; ?>
