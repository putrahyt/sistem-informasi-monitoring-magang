<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $data['judul'] ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="<?= BASEURL ?>/asset/img/icon.png" rel="icon">

  <link href="<?= BASEURL ?>/asset/css/bootstrap-css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="<?= BASEURL ?>/asset/css/style.css" rel="stylesheet">

</head>

<body>

<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="<?= BASEURL ?>/asset/img/logo.png" alt="">
        <span class="d-none d-lg-block" style="font-size: medium;">Sistem informasi Monitoring Magang</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- <i class="bi bi-person-fill fs-4"></i> -->
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['session']['username'] ?></span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>MAGANGKU</h6>
              <span>Anda login sebagai <?= $_SESSION['session']['username'] ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
           
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= BASEURL ?>/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
              </a>
            </li>

          </ul>
        </li>

      </ul>
    </nav>

</header>