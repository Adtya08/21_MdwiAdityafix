<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMKN 1 Dlanggu - Informasi Kegiatan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .brand-logo {
  width: 45px;
  height: 45px;
  object-fit: contain;
}

.brand-text span {
  font-size: 0.85rem;
  line-height: 1;
}

.brand-text strong {
  font-size: 1rem;
  line-height: 1;
}
    /* ===== HERO CAROUSEL - MODERN FRAME CARD ===== */
    .hero-carousel-wrapper {
      position: relative;
      width: 100%;
      max-width: 460px;
    }
    .carousel-deco {
      position: absolute;
      border-radius: 50%;
      z-index: 0;
      pointer-events: none;
    }
    .carousel-deco-1 {
      width: 220px; height: 220px;
      background: rgba(14,165,233,0.18);
      top: -30px; right: -30px;
      filter: blur(40px);
    }
    .carousel-deco-2 {
      width: 160px; height: 160px;
      background: rgba(16,185,129,0.15);
      bottom: -20px; left: -20px;
      filter: blur(35px);
    }
    .carousel-frame-card {
      position: relative;
      z-index: 1;
      background: rgba(255,255,255,0.07);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1.5px solid rgba(255,255,255,0.18);
      border-radius: 28px;
      overflow: hidden;
      box-shadow: 0 24px 60px rgba(0,0,0,0.3), 0 0 0 1px rgba(255,255,255,0.05) inset;
    }
    .carousel-frame-topbar {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 18px;
      background: rgba(255,255,255,0.06);
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .carousel-topbar-dots {
      display: flex; gap: 6px;
    }
    .carousel-topbar-dots span {
      width: 10px; height: 10px; border-radius: 50%;
      background: rgba(255,255,255,0.25);
    }
    .carousel-topbar-dots span:first-child { background: #ff5f57; }
    .carousel-topbar-dots span:nth-child(2) { background: #ffbd2e; }
    .carousel-topbar-dots span:last-child { background: #28ca41; }
    .carousel-topbar-label {
      flex: 1;
      text-align: center;
      font-size: 0.78rem;
      color: rgba(255,255,255,0.6);
      font-weight: 500;
      letter-spacing: 0.5px;
    }
    .carousel-slide-counter {
      font-size: 0.75rem;
      color: rgba(255,255,255,0.5);
      font-variant-numeric: tabular-nums;
    }
    .carousel-inner-rounded {
      border-radius: 0 !important;
      overflow: hidden;
    }
    /* Carousel slide styles */
    .hc-slide {
      position: relative;
      height: 360px;
      overflow: hidden;
    }
    .hc-img {
      position: absolute;
      width: 100%; height: 100%;
      object-fit: cover;
      top: 0; left: 0;
      transition: transform 6s ease;
    }
    .carousel-item.active .hc-img { transform: scale(1.06); }
    .hc-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom, rgba(0,0,0,0.05) 30%, rgba(0,0,0,0.72) 100%);
      z-index: 1;
    }
    .hc-caption {
      position: absolute;
      bottom: 0; left: 0; right: 0;
      z-index: 2;
      padding: 24px 22px 20px;
    }
    .hc-tag {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      background: rgba(255,255,255,0.15);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,0.2);
      color: #fff;
      font-size: 0.72rem;
      font-weight: 600;
      letter-spacing: 0.5px;
      padding: 4px 10px;
      border-radius: 20px;
      margin-bottom: 8px;
      text-transform: uppercase;
    }
    .hc-title {
      font-size: 1.2rem;
      font-weight: 700;
      color: #fff;
      line-height: 1.3;
      margin-bottom: 4px;
    }
    .hc-sub {
      font-size: 0.82rem;
      color: rgba(255,255,255,0.75);
    }
    /* Nav buttons */
    .hc-nav {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      z-index: 10;
      width: 36px; height: 36px;
      border-radius: 50%;
      border: 1.5px solid rgba(255,255,255,0.3);
      background: rgba(255,255,255,0.12);
      backdrop-filter: blur(8px);
      color: #fff;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.2s;
      line-height: 1;
    }
    .hc-nav:hover {
      background: rgba(255,255,255,0.25);
      border-color: rgba(255,255,255,0.5);
      transform: translateY(-50%) scale(1.08);
    }
    .hc-nav-prev { left: 12px; }
    .hc-nav-next { right: 12px; }
    /* Bottom frame */
    .carousel-frame-bottom {
      padding: 12px 18px;
      display: flex;
      align-items: center;
      gap: 12px;
      background: rgba(0,0,0,0.15);
    }
    .hc-dots {
      display: flex;
      gap: 6px;
    }
    .hc-dot {
      width: 7px; height: 7px;
      border-radius: 50%;
      border: none;
      background: rgba(255,255,255,0.3);
      padding: 0;
      cursor: pointer;
      transition: all 0.3s;
    }
    .hc-dot.active {
      background: #fff;
      width: 20px;
      border-radius: 4px;
    }
    .hc-progress-bar {
      flex: 1;
      height: 3px;
      background: rgba(255,255,255,0.15);
      border-radius: 2px;
      overflow: hidden;
    }
    .hc-progress-fill {
      height: 100%;
      background: linear-gradient(90deg, #38bdf8, #34d399);
      border-radius: 2px;
      width: 20%;
      transition: width 0.4s ease;
    }

    /* ===== KONTAK SECTION - BENTO LAYOUT ===== */
    .kontak-section {
      padding: 80px 0;
      background: var(--bg-alt);
      position: relative;
      overflow: hidden;
    }
    .kontak-bg-deco {
      position: absolute;
      inset: 0;
      pointer-events: none;
      overflow: hidden;
    }
    .kontak-blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(60px);
      opacity: 0.35;
    }
    .kontak-blob-1 {
      width: 350px; height: 350px;
      background: radial-gradient(circle, #0ea5e9, transparent);
      top: -80px; left: -80px;
    }
    .kontak-blob-2 {
      width: 300px; height: 300px;
      background: radial-gradient(circle, #10b981, transparent);
      bottom: -60px; right: -60px;
    }

    /* Bento grid */
    .kontak-bento {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      height: 100%;
    }
    .kb-card {
      background: #fff;
      border-radius: 18px;
      padding: 18px 16px;
      border: 1px solid #e8eef5;
      box-shadow: 0 2px 12px rgba(30,58,95,0.06);
      transition: transform 0.22s, box-shadow 0.22s;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }
    .kb-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 28px rgba(30,58,95,0.12);
    }
    .kb-alamat {
      grid-column: 1 / -1;
      flex-direction: row;
      align-items: center;
      gap: 14px;
    }
    .kb-half {
      grid-column: span 1;
    }
    .kb-dev {
      grid-column: 1 / -1;
      flex-direction: row;
      align-items: center;
      gap: 14px;
      background: linear-gradient(135deg, #1e3a5f 0%, #0f766e 100%);
      border-color: transparent;
      color: #fff;
    }
    .kb-icon-wrap {
      width: 42px; height: 42px;
      border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.1rem;
      flex-shrink: 0;
    }
    .kb-icon-blue { background: #dbeafe; color: #1d4ed8; }
    .kb-icon-green { background: #d1fae5; color: #059669; }
    .kb-icon-orange { background: #ffedd5; color: #ea580c; }
    .kb-icon-purple { background: #ede9fe; color: #7c3aed; }
    .kb-icon-teal { background: #ccfbf1; color: #0d9488; }
    .kb-label {
      font-size: 0.72rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.6px;
      color: #94a3b8;
      margin-bottom: 2px;
    }
    .kb-dev .kb-label { color: rgba(255,255,255,0.6); }
    .kb-value {
      font-size: 0.88rem;
      font-weight: 600;
      color: #1e293b;
      line-height: 1.4;
    }
    .kb-link {
      color: #0f766e;
      text-decoration: none;
      transition: color 0.2s;
    }
    .kb-link:hover { color: #1e3a5f; text-decoration: underline; }
    .kb-meta {
      font-size: 0.72rem;
      color: #94a3b8;
      margin-top: 2px;
    }
    .kb-content { flex: 1; }
    /* Dev card inner */
    .kb-dev-avatar {
      width: 46px; height: 46px;
      border-radius: 14px;
      background: rgba(255,255,255,0.15);
      display: flex; align-items: center; justify-content: center;
      font-size: 1.3rem;
      color: #fff;
      flex-shrink: 0;
    }
    .kb-dev-name {
      font-size: 1rem;
      font-weight: 700;
      color: #fff;
    }
    .kb-dev-role {
      font-size: 0.75rem;
      color: rgba(255,255,255,0.65);
    }
    .kb-dev-badge {
      margin-left: auto;
      font-size: 1.5rem;
      color: #34d399;
    }
    /* Map wrapper */
    .kontak-map-wrapper {
      position: relative;
      border-radius: 22px;
      overflow: hidden;
      height: 100%;
      min-height: 480px;
      box-shadow: 0 8px 32px rgba(30,58,95,0.13);
      border: 1px solid #e2e8f0;
    }
    .kontak-map-tag {
      position: absolute;
      top: 16px; left: 16px;
      z-index: 10;
      background: rgba(30,58,95,0.9);
      backdrop-filter: blur(8px);
      color: #fff;
      font-size: 0.8rem;
      font-weight: 600;
      padding: 7px 14px;
      border-radius: 20px;
      display: flex; align-items: center;
    }
    .kontak-map-btn {
      position: absolute;
      bottom: 16px; left: 50%;
      transform: translateX(-50%);
      z-index: 10;
      background: linear-gradient(135deg, #1e3a5f, #0f766e);
      color: #fff;
      font-size: 0.85rem;
      font-weight: 600;
      padding: 10px 24px;
      border-radius: 30px;
      text-decoration: none;
      display: flex; align-items: center;
      white-space: nowrap;
      box-shadow: 0 4px 18px rgba(0,0,0,0.25);
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .kontak-map-btn:hover {
      transform: translateX(-50%) translateY(-2px);
      box-shadow: 0 8px 24px rgba(0,0,0,0.3);
      color: #fff;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-smk navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      
      <!-- LOGO -->
      <img src="assets/img/logo.png" alt="Logo Sekolah" class="brand-logo">

      <!-- TEXT -->
      <div class="brand-text ms-2">
        <span class="d-block">SMK Negeri 1</span>
        <strong>Dlanggu</strong>
      </div>

    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
      style="border-color:rgba(255,255,255,0.3);">
      <span style="color:#fff; font-size:1.3rem;">
        <i class="bi bi-list"></i>
      </span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
        <li class="nav-item">
          <a class="nav-link active" href="#home">
            <i class="bi bi-house me-1"></i>Home
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#kegiatan">
            <i class="bi bi-calendar3 me-1"></i>Kegiatan
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#kontak">
            <i class="bi bi-telephone me-1"></i>Hubungi Kami
          </a>
        </li>

        <li class="nav-item ms-lg-2">
          <a class="nav-link nav-login-btn" href="login.php">
            <i class="bi bi-lock me-1"></i>Login
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero-section" id="home">
  <div class="hero-particles">
    <div class="particle"></div><div class="particle"></div><div class="particle"></div>
    <div class="particle"></div><div class="particle"></div>
  </div>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7 hero-content">
        <div class="hero-badge animate-fade-up" style="animation-delay:0.1s"><span>●</span> Website Resmi SMKN 1 Dlanggu</div>
        <h1 class="animate-fade-up" style="animation-delay:0.2s">Informasi Kegiatan<br>SMK Negeri 1 Dlanggu</h1>
        <p class="animate-fade-up" style="animation-delay:0.3s">Temukan berbagai informasi kegiatan terbaru dari SMK Negeri 1 Dlanggu, Mojokerto. Kami berkomitmen mencetak lulusan berkualitas dan siap bersaing di dunia kerja.</p>
        <div class="d-flex gap-3 mt-4 animate-fade-up" style="animation-delay:0.4s">
          <a href="#kontak" class="btn btn-hero-primary">
            <i class="bi bi-telephone me-2"></i>Hubungi Kami
          </a>
          <a href="http://www.smkn1dlanggu.sch.id" target="_blank" class="btn btn-hero-secondary">
            <i class="bi bi-globe me-2"></i>Website Resmi
          </a>
        </div>
      </div>
      <div class="col-lg-5 d-none d-lg-flex justify-content-end align-items-center" style="padding:20px;">
        <div class="hero-carousel-wrapper">
          <!-- Decorative floating elements -->
          <div class="carousel-deco carousel-deco-1"></div>
          <div class="carousel-deco carousel-deco-2"></div>

          <div class="carousel-frame-card">
            <!-- Top bar -->
            <div class="carousel-frame-topbar">
              <div class="carousel-topbar-dots">
                <span></span><span></span><span></span>
              </div>
              <div class="carousel-topbar-label">
                <i class="bi bi-camera me-1"></i> Galeri Sekolah
              </div>
              <div class="carousel-slide-counter" id="carouselCounter">1 / 5</div>
            </div>

            <!-- Carousel -->
            <div id="heroSchoolCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
              <div class="carousel-inner carousel-inner-rounded">

                <div class="carousel-item active">
                  <div class="hc-slide">
                    <img src="assets/img/skul.jpg" alt="SMK Negeri 1 Dlanggu" class="hc-img">
                    <div class="hc-overlay"></div>
                    <div class="hc-caption">
                      <div class="hc-tag"><i class="bi bi-building me-1"></i>Gedung Utama</div>
                      <div class="hc-title">SMK Negeri 1 Dlanggu</div>
                      <div class="hc-sub">Mojokerto, Jawa Timur</div>
                    </div>
                  </div>
                </div>

                <div class="carousel-item">
                  <div class="hc-slide">
                    <img src="assets/img/laborator.jpg" alt="Laboratorium Komputer" class="hc-img">
                    <div class="hc-overlay"></div>
                    <div class="hc-caption">
                      <div class="hc-tag"><i class="bi bi-pc-display me-1"></i>Fasilitas</div>
                      <div class="hc-title">Laboratorium Komputer</div>
                      <div class="hc-sub">Fasilitas Belajar Modern</div>
                    </div>
                  </div>
                </div>

                <div class="carousel-item">
                  <div class="hc-slide">
                    <img src="assets/img/skuls.jpg" alt="Wisuda & Kelulusan" class="hc-img">
                    <div class="hc-overlay"></div>
                    <div class="hc-caption">
                      <div class="hc-tag"><i class="bi bi-mortarboard me-1"></i>Kelulusan</div>
                      <div class="hc-title">Wisuda & Kelulusan</div>
                      <div class="hc-sub">Lulusan Siap Kerja</div>
                    </div>
                  </div>
                </div>

                <div class="carousel-item">
                  <div class="hc-slide">
                    <img src="assets/img/skuls.jpg" alt="Prestasi & Lomba" class="hc-img">
                    <div class="hc-overlay"></div>
                    <div class="hc-caption">
                      <div class="hc-tag"><i class="bi bi-trophy me-1"></i>Prestasi</div>
                      <div class="hc-title">Prestasi & Lomba</div>
                      <div class="hc-sub">Juara Tingkat Kabupaten</div>
                    </div>
                  </div>
                </div>

                <div class="carousel-item">
                  <div class="hc-slide">
                    <img src="assets/img/skuls.jpg" alt="Praktik Kerja Lapangan" class="hc-img">
                    <div class="hc-overlay"></div>
                    <div class="hc-caption">
                      <div class="hc-tag"><i class="bi bi-tools me-1"></i>PKL</div>
                      <div class="hc-title">Praktik Kerja Lapangan</div>
                      <div class="hc-sub">Pengalaman Industri Nyata</div>
                    </div>
                  </div>
                </div>

              </div>

              <!-- Custom nav -->
              <button class="hc-nav hc-nav-prev" type="button" data-bs-target="#heroSchoolCarousel" data-bs-slide="prev">
                <i class="bi bi-chevron-left"></i>
              </button>
              <button class="hc-nav hc-nav-next" type="button" data-bs-target="#heroSchoolCarousel" data-bs-slide="next">
                <i class="bi bi-chevron-right"></i>
              </button>
            </div>

            <!-- Bottom dot indicators -->
            <div class="carousel-frame-bottom">
              <div class="hc-dots">
                <button class="hc-dot active" data-bs-target="#heroSchoolCarousel" data-bs-slide-to="0"></button>
                <button class="hc-dot" data-bs-target="#heroSchoolCarousel" data-bs-slide-to="1"></button>
                <button class="hc-dot" data-bs-target="#heroSchoolCarousel" data-bs-slide-to="2"></button>
                <button class="hc-dot" data-bs-target="#heroSchoolCarousel" data-bs-slide-to="3"></button>
                <button class="hc-dot" data-bs-target="#heroSchoolCarousel" data-bs-slide-to="4"></button>
              </div>
              <div class="hc-progress-bar"><div class="hc-progress-fill" id="hcProgressFill"></div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- KEGIATAN LIST -->
<section id="kegiatan" style="padding: 70px 0;">
  <div class="container">
    <div class="section-header animate-on-scroll">
      <div class="section-line"></div>
      <h2 class="section-title">Kegiatan Terkini</h2>
      <p class="section-subtitle">Informasi terbaru seputar kegiatan dan aktivitas di SMKN 1 Dlanggu</p>
    </div>

    <?php
      $sql = "SELECT * FROM kegiatan ORDER BY tanggal DESC, id DESC";
      $result = $conn->query($sql);
      $is_first = true;
    ?>

    <?php if ($result->num_rows > 0): ?>
    <div class="row g-4">
      <?php $card_index = 0; while ($row = $result->fetch_assoc()): ?>
      <div class="col-md-6 col-lg-4 animate-on-scroll" style="animation-delay:<?= $card_index * 0.1 ?>s">
        <div class="activity-card">
          <div class="card-img-wrapper">
            <?php
              $img_path = 'assets/img/' . $row['gambar'];
              $has_image = !empty($row['gambar']) && file_exists($img_path);
            ?>
            <?php if ($has_image): ?>
              <img src="<?= htmlspecialchars($img_path) ?>" alt="<?= htmlspecialchars($row['judul']) ?>" class="card-img-top-custom">
            <?php else: ?>
              <div class="card-img-fallback">
                <i class="bi bi-image"></i>
              </div>
            <?php endif; ?>
            <?php if ($is_first): ?>
              <span class="badge-new"><i class="bi bi-star-fill me-1"></i>Terbaru</span>
              <?php $is_first = false; ?>
            <?php endif; ?>
          </div>
          <div class="card-body-custom">
            <span class="card-date">
              <i class="bi bi-calendar3"></i>
              <?= date('d M Y', strtotime($row['tanggal'])) ?>
            </span>
            <h5 class="card-title-custom"><?= htmlspecialchars($row['judul']) ?></h5>
            <p class="card-text-custom"><?= htmlspecialchars(mb_substr($row['deskripsi'], 0, 100)) . (mb_strlen($row['deskripsi']) > 100 ? '...' : '') ?></p>
            <button class="btn-detail-berita"
              data-judul="<?= htmlspecialchars($row['judul']) ?>"
              data-deskripsi="<?= htmlspecialchars($row['deskripsi']) ?>"
              data-tanggal="<?= date('d M Y', strtotime($row['tanggal'])) ?>"
              data-gambar="<?= $has_image ? htmlspecialchars($img_path) : '' ?>"
              onclick="showDetailBerita(this)">
              <i class="bi bi-eye me-1"></i> Lihat Detail
            </button>
          </div>
        </div>
      </div>
      <?php $card_index++; endwhile; ?>
    </div>
    <?php else: ?>
    <div class="text-center py-5" style="color:var(--text-muted);">
      <i class="bi bi-inbox" style="font-size:3rem;"></i>
      <p class="mt-3">Belum ada data kegiatan.</p>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- HUBUNGI KAMI SECTION - Fresh Bento Layout -->
<section id="kontak" class="kontak-section">
  <div class="kontak-bg-deco">
    <div class="kontak-blob kontak-blob-1"></div>
    <div class="kontak-blob kontak-blob-2"></div>
  </div>
  <div class="container position-relative">
    <div class="section-header animate-on-scroll">
      <div class="section-line"></div>
      <h2 class="section-title">Hubungi Kami</h2>
      <p class="section-subtitle">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami.</p>
    </div>

    <div class="row g-4 align-items-stretch">
      <!-- LEFT: Bento info cards -->
      <div class="col-lg-5 animate-on-scroll">
        <div class="kontak-bento">

          <!-- Alamat wide card -->
          <div class="kb-card kb-alamat">
            <div class="kb-icon-wrap kb-icon-blue">
              <i class="bi bi-geo-alt-fill"></i>
            </div>
            <div class="kb-content">
              <div class="kb-label">Alamat</div>
              <div class="kb-value">Jl. Raya Dlanggu No.1, Dlanggu,<br>Kab. Mojokerto, Jawa Timur 61372</div>
            </div>
          </div>

          <!-- Telepon -->
          <div class="kb-card kb-half">
            <div class="kb-icon-wrap kb-icon-green"><i class="bi bi-telephone-fill"></i></div>
            <div class="kb-label">Telepon</div>
            <a href="tel:0321591018" class="kb-value kb-link">(0321) 591018</a>
            <div class="kb-meta">Senin–Jumat · 07.00–15.00</div>
          </div>

          <!-- Email -->
          <div class="kb-card kb-half">
            <div class="kb-icon-wrap kb-icon-orange"><i class="bi bi-envelope-fill"></i></div>
            <div class="kb-label">Email</div>
            <a href="mailto:smkn1dlanggu@gmail.com" class="kb-value kb-link">smkn1dlanggu@gmail.com</a>
          </div>

          <!-- Website -->
          <div class="kb-card kb-half">
            <div class="kb-icon-wrap kb-icon-purple"><i class="bi bi-globe2"></i></div>
            <div class="kb-label">Website Resmi</div>
            <a href="http://www.smkn1dlanggu.sch.id" target="_blank" class="kb-value kb-link">smkn1dlanggu.sch.id</a>
          </div>

          <!-- Maps -->
          <div class="kb-card kb-half">
            <div class="kb-icon-wrap kb-icon-teal"><i class="bi bi-pin-map-fill"></i></div>
            <div class="kb-label">Google Maps</div>
            <a href="https://maps.google.com/?q=SMKN+1+Dlanggu+Mojokerto" target="_blank" class="kb-value kb-link">
              Buka Maps <i class="bi bi-arrow-up-right-circle-fill" style="font-size:0.75rem;"></i>
            </a>
          </div>

          <!-- Dev card -->
          <div class="kb-card kb-dev">
            <div class="kb-dev-avatar"><i class="bi bi-code-slash"></i></div>
            <div>
              <div class="kb-label">Dikembangkan oleh</div>
              <div class="kb-dev-name">Muhammad Dwi Aditya</div>
              <div class="kb-dev-role">Junior Web Programmer</div>
            </div>
            <div class="kb-dev-badge"><i class="bi bi-patch-check-fill"></i></div>
          </div>

        </div>
      </div>

      <!-- RIGHT: Map -->
      <div class="col-lg-7 animate-on-scroll" style="animation-delay:0.15s">
        <div class="kontak-map-wrapper">
          <div class="kontak-map-tag">
            <i class="bi bi-geo-alt me-1"></i> SMKN 1 Dlanggu
          </div>
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.7!2d112.536!3d-7.54!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sSMKN+1+Dlanggu!5e0!3m2!1sen!2sid!4v1"
            width="100%" height="100%" style="border:0;display:block;min-height:480px;" allowfullscreen="" loading="lazy">
          </iframe>
          <a href="https://maps.google.com/?q=SMKN+1+Dlanggu+Mojokerto" target="_blank" class="kontak-map-btn">
            <i class="bi bi-compass me-2"></i>Buka di Google Maps
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <p>© <?= date('Y') ?> <strong>SMK Negeri 1 Dlanggu</strong> — Jl. Raya Dlanggu, Mojokerto, Jawa Timur</p>
  <p class="mt-1" style="font-size:0.78rem;">Dikembangkan oleh <strong>Muhammad Dwi Aditya</strong> | Junior Web Programmer</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Smooth scroll for navbar links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      e.preventDefault();
      const navHeight = document.querySelector('.navbar-smk').offsetHeight;
      window.scrollTo({ top: target.offsetTop - navHeight - 8, behavior: 'smooth' });
    }
  });
});

// Navbar active link on scroll
const sections = document.querySelectorAll('section[id], div[id="home"]');
const navLinks = document.querySelectorAll('.navbar-smk .nav-link');
window.addEventListener('scroll', () => {
  let current = '';
  sections.forEach(sec => {
    if (window.scrollY >= sec.offsetTop - 80) current = sec.getAttribute('id');
  });
  navLinks.forEach(link => {
    link.classList.remove('active');
    if (link.getAttribute('href') === '#' + current) link.classList.add('active');
  });
});

// Intersection Observer for scroll animations
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

// ===== Hero Carousel: counter, dots, progress =====
(function() {
  var carouselEl = document.getElementById('heroSchoolCarousel');
  if (!carouselEl) return;
  var total = carouselEl.querySelectorAll('.carousel-item').length;
  var counter = document.getElementById('carouselCounter');
  var dots = carouselEl.parentElement.querySelectorAll('.hc-dot');
  var fill = document.getElementById('hcProgressFill');

  function updateCarouselUI(idx) {
    if (counter) counter.textContent = (idx + 1) + ' / ' + total;
    dots.forEach(function(d, i) { d.classList.toggle('active', i === idx); });
    if (fill) fill.style.width = ((idx + 1) / total * 100) + '%';
  }

  carouselEl.addEventListener('slide.bs.carousel', function(e) {
    updateCarouselUI(e.to);
  });

  // Init
  updateCarouselUI(0);
})();
</script>

<!-- MODAL DETAIL BERITA -->
<div class="modal fade" id="modalDetailBerita" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="border-radius:18px;border:none;overflow:hidden;">
      <div class="modal-header" style="background:linear-gradient(135deg,#1e3a5f,#0f766e);border:none;padding:20px 24px;">
        <h5 class="modal-title" id="modalDetailLabel" style="color:#fff;font-weight:700;font-size:1.1rem;"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="padding:24px;">
        <div id="modalDetailDate" style="color:#64748b;font-size:0.85rem;margin-bottom:16px;"><i class="bi bi-calendar3 me-1"></i></div>
        <div id="modalDetailImgWrapper" style="margin-bottom:20px;display:none;">
          <img id="modalDetailImg" src="" alt="" style="width:100%;max-height:380px;object-fit:cover;border-radius:12px;">
        </div>
        <div id="modalDetailDesc" style="color:#374151;line-height:1.8;font-size:0.95rem;white-space:pre-line;"></div>
      </div>
      <div class="modal-footer" style="border:none;padding:16px 24px;">
        <button type="button" class="btn" data-bs-dismiss="modal" style="background:#f1f5f9;color:#374151;border-radius:10px;font-size:0.88rem;padding:8px 20px;">
          <i class="bi bi-x-circle me-1"></i>Tutup
        </button>
      </div>
    </div>
  </div>
</div>

<script>
function showDetailBerita(btn) {
  var judul = btn.getAttribute('data-judul');
  var deskripsi = btn.getAttribute('data-deskripsi');
  var tanggal = btn.getAttribute('data-tanggal');
  var gambar = btn.getAttribute('data-gambar');
  document.getElementById('modalDetailLabel').textContent = judul;
  document.getElementById('modalDetailDate').innerHTML = '<i class="bi bi-calendar3 me-1"></i>' + tanggal;
  document.getElementById('modalDetailDesc').textContent = deskripsi;
  var imgWrapper = document.getElementById('modalDetailImgWrapper');
  if (gambar && gambar.trim() !== '') {
    document.getElementById('modalDetailImg').src = gambar;
    document.getElementById('modalDetailImg').alt = judul;
    imgWrapper.style.display = 'block';
  } else {
    imgWrapper.style.display = 'none';
  }
  var modal = new bootstrap.Modal(document.getElementById('modalDetailBerita'));
  modal.show();
}
</script>
</body>
</html>