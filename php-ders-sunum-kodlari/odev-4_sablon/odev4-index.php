<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Netflix Benzeri Ana Sayfa - Statik Şablon</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      background-color: #141414;
      color: #ffffff;
    }

    a {
      text-decoration: none;
      color: white;
    }

    .navbar {
      width: 100%;
      background-color: #111;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px 32px;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 2px 10px rgba(0,0,0,0.4);
    }

    .nav-left {
      display: flex;
      align-items: center;
      gap: 28px;
      flex-wrap: wrap;
    }

    .logo {
      font-size: 28px;
      font-weight: bold;
      color: #e50914;
      letter-spacing: 1px;
    }

    .menu {
      display: flex;
      gap: 18px;
      flex-wrap: wrap;
    }

    .menu a {
      font-size: 15px;
      color: #e5e5e5;
      transition: 0.2s;
    }

    .menu a:hover {
      color: #ffffff;
    }

    .nav-right select {
      background-color: #222;
      color: white;
      border: 1px solid #555;
      padding: 8px 10px;
      border-radius: 6px;
      cursor: pointer;
    }

    .hero {
      min-height: 360px;
      background: linear-gradient(to right, rgba(0,0,0,0.85), rgba(0,0,0,0.35)),
                  url('https://picsum.photos/1400/500?blur=1') center/cover no-repeat;
      display: flex;
      align-items: center;
      padding: 50px 40px;
    }

    .hero-content {
      max-width: 550px;
    }

    .hero h1 {
      font-size: 46px;
      margin-bottom: 16px;
    }

    .hero p {
      font-size: 18px;
      line-height: 1.6;
      color: #dddddd;
      margin-bottom: 20px;
    }

    .hero-buttons {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }

    .btn {
      padding: 12px 22px;
      border: none;
      border-radius: 6px;
      font-size: 15px;
      cursor: pointer;
      font-weight: bold;
    }

    .btn-primary {
      background-color: white;
      color: black;
    }

    .btn-secondary {
      background-color: rgba(109, 109, 110, 0.7);
      color: white;
    }

    .content {
      padding: 30px 40px 50px;
    }

    .category {
      margin-bottom: 40px;
    }

    .category h2 {
      margin-bottom: 18px;
      font-size: 24px;
      color: #ffffff;
    }

    .card-row {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
      gap: 20px;
    }

    .card {
      background-color: #1f1f1f;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 18px rgba(0,0,0,0.4);
    }

    .card img {
      width: 100%;
      height: 170px;
      object-fit: cover;
      display: block;
    }

    .card-body {
      padding: 14px;
    }

    .card-title {
      font-size: 18px;
      margin-bottom: 8px;
      font-weight: bold;
    }

    .card-type {
      display: inline-block;
      font-size: 13px;
      color: #cfcfcf;
      background-color: #333;
      padding: 6px 10px;
      border-radius: 20px;
    }

    .footer {
      text-align: center;
      color: #999;
      padding: 25px 15px 35px;
      border-top: 1px solid #2a2a2a;
      font-size: 14px;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
      }

      .hero {
        padding: 35px 20px;
        min-height: 300px;
      }

      .hero h1 {
        font-size: 34px;
      }

      .hero p {
        font-size: 16px;
      }

      .content {
        padding: 24px 20px 40px;
      }
    }
  </style>
</head>
<body>
  <header class="navbar">
    <div class="nav-left">
      <div class="logo">MBP192/102</div>
      <nav class="menu">
        <a href="#">Ana Sayfa</a>
        <a href="#">Filmler</a>
        <a href="#">Diziler</a>
        <a href="#">Oyunlar</a>
        <a href="#">Yeni ve Popüler</a>
        <a href="#">Seçimler</a>
        <a href="#">Listem</a>
      </nav>
    </div>

    <div class="nav-right">
      <select>
        <option>Ali</option>
        <option>Veli</option>
        <option>Ayça</option>
        <option>Deniz</option>
        <option>Yeni kullanıcı ekle</option>
      </select>
    </div>
  </header>

  <section class="hero">
    <div class="hero-content">
      <h1>Bugün ne izlemek istersin?</h1>
      <p>
        Bu sayfa, PHP ödevi için hazırlanmış statik HTML şablonudur.
        Menü, kullanıcı seçimi ve film kart yapısı hazırdır. Öğrenciler daha sonra
        bunu PHP dizileri, döngüler ve form işlemleri ile dinamik hale getirebilir.
      </p>
      <div class="hero-buttons">
        <button class="btn btn-primary">İzle</button>
        <button class="btn btn-secondary">Daha Fazla Bilgi</button>
      </div>
    </div>
  </section>

  <main class="content">
    <section class="category">
      <h2>Bilim-Kurgu</h2>
      <div class="card-row">
        <div class="card">
          <img src="https://picsum.photos/200/150?random=1" alt="Inception">
          <div class="card-body">
            <div class="card-title">Inception</div>
            <div class="card-type">Bilim-Kurgu</div>
          </div>
        </div>
        <div class="card">
          <img src="https://picsum.photos/200/150?random=2" alt="Interstellar">
          <div class="card-body">
            <div class="card-title">Interstellar</div>
            <div class="card-type">Bilim-Kurgu</div>
          </div>
        </div>
        <div class="card">
          <img src="https://picsum.photos/200/150?random=6" alt="Gelecek">
          <div class="card-body">
            <div class="card-title">Gelecek</div>
            <div class="card-type">Bilim-Kurgu</div>
          </div>
        </div>
      </div>
    </section>

    <section class="category">
      <h2>Belgesel</h2>
      <div class="card-row">
        <div class="card">
          <img src="https://picsum.photos/200/150?random=7" alt="Planet Earth">
          <div class="card-body">
            <div class="card-title">Planet Earth</div>
            <div class="card-type">Belgesel</div>
          </div>
        </div>
        <div class="card">
          <img src="https://picsum.photos/200/150?random=8" alt="F1">
          <div class="card-body">
            <div class="card-title">F1</div>
            <div class="card-type">Belgesel</div>
          </div>
        </div>
        <div class="card">
          <img src="https://picsum.photos/200/150?random=10" alt="Dünya">
          <div class="card-body">
            <div class="card-title">Dünya</div>
            <div class="card-type">Belgesel</div>
          </div>
        </div>
      </div>
    </section>

    <section class="category">
      <h2>Animasyon</h2>
      <div class="card-row">
        <div class="card">
          <img src="https://picsum.photos/200/150?random=5" alt="Frozen">
          <div class="card-body">
            <div class="card-title">Frozen</div>
            <div class="card-type">Animasyon</div>
          </div>
        </div>
        <div class="card">
          <img src="https://picsum.photos/200/150?random=9" alt="GUPİ">
          <div class="card-body">
            <div class="card-title">GUPİ</div>
            <div class="card-type">Animasyon</div>
          </div>
        </div>
        <div class="card">
          <img src="https://picsum.photos/200/150?random=15" alt="Minik Kahraman">
          <div class="card-body">
            <div class="card-title">Minik Kahraman</div>
            <div class="card-type">Animasyon</div>
          </div>
        </div>
      </div>
    </section>

    <section class="category">
      <h2>Korku</h2>
      <div class="card-row">
        <div class="card">
          <img src="https://picsum.photos/200/150?random=3" alt="The Conjuring">
          <div class="card-body">
            <div class="card-title">The Conjuring</div>
            <div class="card-type">Korku</div>
          </div>
        </div>
        <div class="card">
          <img src="https://picsum.photos/200/150?random=16" alt="Gece Evi">
          <div class="card-body">
            <div class="card-title">Gece Evi</div>
            <div class="card-type">Korku</div>
          </div>
        </div>
        <div class="card">
          <img src="https://picsum.photos/200/150?random=17" alt="Kayıp Sesler">
          <div class="card-body">
            <div class="card-title">Kayıp Sesler</div>
            <div class="card-type">Korku</div>
          </div>
        </div>
      </div>
    </section>

    <section class="category">
      <h2>Fantastik</h2>
      <div class="card-row">
        <div class="card">
          <img src="https://picsum.photos/200/150?random=4" alt="Avatar">
          <div class="card-body">
            <div class="card-title">Avatar</div>
            <div class="card-type">Fantastik</div>
          </div>
        </div>
        <div class="card">
          <img src="https://picsum.photos/200/150?random=18" alt="Ejder Vadisi">
          <div class="card-body">
            <div class="card-title">Ejder Vadisi</div>
            <div class="card-type">Fantastik</div>
          </div>
        </div>
        <div class="card">
          <img src="https://picsum.photos/200/150?random=19" alt="Gölgeler Ülkesi">
          <div class="card-body">
            <div class="card-title">Gölgeler Ülkesi</div>
            <div class="card-type">Fantastik</div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer">
    Bu sayfa statik HTML/CSS şablonudur. PHP ödevinde dinamik yapıya dönüştürülmek üzere hazırlanmıştır.
  </footer>
</body>
</html>
