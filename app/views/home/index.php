<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?= $data['judul'] ?></title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?= BASEURL; ?>/asset/img/icon.png" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= BASEURL; ?>/asset/css/bootstrap-css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Main CSS File -->
  <link href="<?= BASEURL; ?>/asset/css/landingpage.css" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid position-relative d-flex justify-content-around gap-lg-5">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <img src="<?= BASEURL ?>/asset/img/logo.png" alt="">
        <h1 class="sitename">Sistem Informasi Monitoring Magang</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#fitur">Fitur</a></li>
          <li><a href="#galeri">Galeri Foto</a></li>
          <li class="dropdown"><a href="#"><span>Login</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="<?= BASEURL ?>/login/admin">Login as Admin</a></li>
              <li><a href="<?= BASEURL ?>/login/mentor">Login as Mentor</a></li>
              <li><a href="<?= BASEURL ?>/login">Login as Peserta</a></li>
              <li><a href="<?= BASEURL ?>/login/tamu">Login as Tamu</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="<?= BASEURL; ?>/asset/img/diskominfo.jpg" alt="">

      <div class="container text-center">
        <div class="row justify-content-center">
          <div class="col-lg-9">
            <h2>Sistem Informasi Monitoring Magang</h2>
            <p>Platform website untuk memantau aktivitas, absensi serta penilaian peserta magang diskominfo medan</p>
            <div class="dropdown">
              <a class="btn-get-started dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Get Started
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= BASEURL ?>/login/admin">Login as Admin</a></li>
                <li><a class="dropdown-item" href="<?= BASEURL ?>/login/mentor">Login as Mentor</a></li>
                <li><a class="dropdown-item" href="<?= BASEURL ?>/login">Login as Peserta</a></li>
                <li><a class="dropdown-item" href="<?= BASEURL ?>/login/tamu">Login as Tamu</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::tipe(); ?>"></div>

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Tentang Sistem Informasi Monitoring Magang</h2>
        <p>Platform Monitoring Peserta Magang Diskominfo Medan</p>
      </div>

      <div class="container">

        <div class="row gy-3">

          <div class="col-lg-6">
            <img src="<?= BASEURL; ?>/asset/img/about.png" alt="" class="img-fluid">
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center">
            <div class="about-content ps-0 ps-lg-3">
              <h3>Solusi digital yang mendukung program magang lebih tertata, transparan, dan profesional.</h3>
              <p class="fst-italic">
              Magangku adalah sistem informasi berbasis web yang dirancang untuk memudahkan proses pemantauan kegiatan peserta magang di lingkungan Dinas Komunikasi dan Informatika Kota Medan.
              </p>
              <ul>
                <li>
                  <i class="bi bi-list-check"></i>
                  <div>
                    <h4>Manajemen Magang Lebih Terstruktur</h4>
                    <p>Sistem ini membantu seluruh pihak terkait memantau aktivitas peserta magang secara rapi, mulai dari absensi hingga penilaian.</p>
                  </div>
                </li>
                <li>
                  <i class="bi bi-clock"></i>
                  <div>
                    <h4>Akses Mudah & Real-Time</h4>
                    <p>Semua data peserta dapat diakses secara online, kapan pun dan di mana pun, memudahkan pembimbing dan mentor dalam pemantauan.</p>
                  </div>
                </li>
              </ul>
            </div>

          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Fitur Section -->
    <section id="fitur" class="services section light-background">

      <div class="container section-title" data-aos="fade-up">
        <h2>Fitur Website</h2>
        <p>Berbagai fitur dirancang khusus untuk mendukung kelancaran proses magang</p>
      </div>

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item  position-relative">
              <div class="icon">
                <i class="bi bi-camera"></i>
              </div>
              <h3>Absensi</h3>
              <p>Peserta magang dapat melakukan absensi secara online melalui sistem, lengkap dengan unggahan foto sebagai bukti kehadiran.</p>
            </div>
          </div>

          <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-clipboard-check"></i>
              </div>
              <h3>Aktivitas Harian</h3>
              <p>Setiap peserta dapat mengisi aktivitas harian yang mereka lakukan selama masa magang guna membantu mentor dan pembimbing mengetahui progres harian.</p>
            </div>
          </div>

          <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-journal-text"></i>
              </div>
              <h3>Bimbingan</h3>
              <p>Fitur ini memungkinkan mentor memberikan arahan, masukan, dan catatan langsung kepada peserta selama masa magang.</p>
            </div>
          </div>

          <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-pencil-square"></i>
              </div>
              <h3>Penilaian Magang</h3>
              <p>Mentor dapat memberikan penilaian akhir kepada peserta magang yang sudah menyelesaikan magangnya.</p>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Fitur Section -->

    <!-- Galeri Section -->
    <section id="galeri" class="portfolio section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Galeri Foto</h2>
        <p>Galeri foto peserta magang diskominfo medan</p>
      </div>

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-4 col-md-6 portfolio-item">
              <img src="<?= BASEURL; ?>/asset/img/portfolio/1.png" class="img-fluid" alt="">
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item">
              <img src="<?= BASEURL; ?>/asset/img/portfolio/2.png" class="img-fluid" alt="">
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item">
              <img src="<?= BASEURL; ?>/asset/img/portfolio/3.png" class="img-fluid" alt="">
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item">
              <img src="<?= BASEURL; ?>/asset/img/portfolio/4.png" class="img-fluid" alt="">
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item">
              <img src="<?= BASEURL; ?>/asset/img/portfolio/5.png" class="img-fluid" alt="">
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item">
              <img src="<?= BASEURL; ?>/asset/img/portfolio/6.png" class="img-fluid" alt="">
            </div>

          </div>

        </div>

      </div>

    </section><!-- /Galeri Section -->

  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-5">
        <div class="col-lg-6 col-md-12 footer-about">
          <a href="<?= BASEURL ?>" class="logo d-flex align-items-center">
           <img src="<?= BASEURL ?>/asset/img/logo.png" alt="">
            <span class="sitename">Sistem Informasi Monitoring Magang</span>
          </a>
          <p>Platform berbasis website untuk monitoring peserta magang di lingkungan Dinas Komunikasi dan Informatika Kota Medan</p>
          <div class="social-links d-flex mt-4">
            <a href="https://www.instagram.com/diskominfomedan/"><i class="bi bi-instagram"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Menu Aplikasi</h4>
          <ul>
            <li><a href="#hero">Home</a></li>
            <li><a href="#about">Tentang</a></li>
            <li><a href="#fitur">Fitur</a></li>
            <li><a href="#galeri">Galeri Foto</a></li>
          </ul>
        </div>

      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= BASEURL ?>/asset/js/jquery-3.5.1.min.js"></script>
  <script src="<?= BASEURL ?>/asset/js/bootstrap-js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Main JS File -->
  <script src="<?= BASEURL ?>/asset/js/main.js"></script>
  <script src="<?= BASEURL ?>/asset/js/landingpage.js"></script>

</body>

</html>