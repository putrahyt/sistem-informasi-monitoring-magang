<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/peserta">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= BASEURL ?>/peserta/absensi">
          <i class="bi bi-calendar-check"></i>
          <span>Absensi</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/peserta/aktivitas">
          <i class="bi bi-journal-check"></i>
          <span>Aktivitas</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/peserta/bimbingan">
          <i class="bi bi-chat-left-dots"></i>
          <span>Bimbingan Magang <?= !empty($data['notifbimbingan']) ? '<sup class="badge bg-primary">'.$data['notifbimbingan']. '</sup>' : '' ?></span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/peserta/penilaian">
          <i class="bi bi-pencil-square"></i>
          <span>Nilai Akhir Magang</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/peserta/profil">
          <i class="bi bi-person-circle"></i>
          <span>Profil</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/logout">
          <i class="bi bi-box-arrow-left"></i>
          <span>Logout</span>
        </a>
      </li>
      
    </ul>

</aside>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Absensi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/peserta">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/peserta/absensi">Absensi</a></li>
          <li class="breadcrumb-item active">Foto Absensi</li>
        </ol>
      </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-5">
                <div class="card">
                  <div class="card-body" id="foto-absensi">
                    <h5 class="card-title">Absensi <?= ucfirst($data['absensi']) ?> Peserta</h5>
                    <p class="mb-4">Tanggal : <?= date('d M Y', time()) ?></p>
                    <hr>
                    <div id="koordinat" data-lat="<?= $data['koordinat']['latitude'] ?>" data-long="<?= $data['koordinat']['longitude'] ?>" data-jarak="<?= $data['koordinat']['jarak'] ?>"></div>
                    <form id="absensiForm" method="POST" action="<?= BASEURL . '/peserta/absensikehadiran' ?>">
                    <button type="button" id="btnKamera" class="btn btn-primary mb-3">Aktifkan Kamera</button>
                    <video id="video" width="100%" height="300px" autoplay playsinline class="rounded mb-2" style="background: #000;"></video>
                    <canvas id="canvas" style="display: none;"></canvas>
                      <input type="hidden" name="absensi" value="<?= $data['absensi'] ?>">
                      <input type="hidden" name="latitude" id="latInput">
                      <input type="hidden" name="longitude" id="lonInput">
                      <input type="hidden" name="fotoInput" id="fotoInput">
                      <button type="submit" class="btn btn-success w-100 mb-2" name="btnAbsen" id="btnAbsen" disabled>Ambil Foto & Absen</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </section>

</main>