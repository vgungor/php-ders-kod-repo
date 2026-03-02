<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - DayNight Admin</title>
    <script>
      // Prevent flash of white in dark mode - runs before CSS/page render
      if (localStorage.getItem("daynight-theme") === "carbon") {
        document.documentElement.classList.add("carbon");
      }
    </script>
    <link rel="stylesheet" href="templatemo-daynight-style.css" />
    <!--

TemplateMo 608 DayNight Admin

https://templatemo.com/tm-608-daynight-admin

-->
  </head>
  <body>
    <?php
    $isim = "Volkan";
    $kar = 48250;
    $artis = 12.5;
    $kullaniciSayisi = 2420;
    $kullaniciArtisOrani = 8.3;
    $siparisSayisi = 1840;
    $siparisSayisiDegisimOrani = -3.1;
    $donusumOrani = 3.24;
    $donusumOraniDegisim = "0.8";

    ?>
    <div class="app-container">

      <!-- Main Content -->
      <main class="main-content">
        <!-- Page Header -->
        <div class="page-header">
          <h1 class="greeting" id="greeting">
            <?php echo "Good morning, $isim"; ?>
          </h1>
          <p class="greeting-sub">
            Artık ders uygulamalarında HTML safya şablonları da kullanabilecek miyiz?.
          </p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-label">Toplam Kar</div>
            <div class="stat-value">$<?php echo number_format($kar, 0, ',', '.'); ?></div>
            <div class="stat-change positive">
              <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                <polyline points="17 6 23 6 23 12" />
              </svg>
              <?php echo "Son döneme göre +" . strval($artis) . "% artış"; ?>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Aktif Kullanıcı</div>
            <div class="stat-value"><?php echo $kullaniciSayisi; ?></div>
            <div class="stat-change positive">
              <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                <polyline points="17 6 23 6 23 12" />
              </svg>
              +<?php echo $kullaniciArtisOrani; ?>% arttı
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Toplam Sipariş</div>
            <div class="stat-value"><?php echo $siparisSayisi; ?></div>
            <div class="stat-change negative">
              <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <polyline points="23 18 13.5 8.5 8.5 13.5 1 6" />
                <polyline points="17 18 23 18 23 12" />
              </svg>
              -<?php echo $siparisSayisiDegisimOrani; ?>% düşüş
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Dönüşüm Oranı Rate</div>
            <div class="stat-value"><?php echo $donusumOrani; ?>%</div>
            <div class="stat-change positive">
              <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                <polyline points="17 6 23 6 23 12" />
              </svg>
              +<?php echo floatval($donusumOraniDegisim); ?> % artış
            </div>
          </div>
        </div>
      </main>

      <!-- Footer -->
      <?php
      include "footer.php";
      ?>
    </div>

    <script src="templatemo-daynight-script.js"></script>
  </body>
</html>
