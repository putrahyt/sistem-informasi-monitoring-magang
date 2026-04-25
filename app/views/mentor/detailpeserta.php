<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/mentor">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= BASEURL ?>/mentor/datapeserta">
          <i class="bi bi-people"></i>
          <span>Data Peserta</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/mentor/absensi">
          <i class="bi bi-calendar-check"></i>
          <span>Absensi Peserta</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/mentor/aktivitas">
          <i class="bi bi-journal-check"></i>
          <span>Aktivitas Peserta <?= !empty($data['notifaktivitas']) ? '<sup class="badge bg-primary">'.$data['notifaktivitas']. '</sup>' : '' ?></span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/mentor/bimbingan">
          <i class="bi bi-chat-left-dots"></i>
          <span>Bimbingan Magang <?= !empty($data['notifbimbingan']) ? '<sup class="badge bg-primary">'.$data['notifbimbingan']. '</sup>' : '' ?></span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/mentor/penilaian">
          <i class="bi bi-pencil-square"></i>
          <span>Penilaian Peserta</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/mentor/laporan">
          <i class="bi bi-file-earmark-text"></i>
          <span>Laporan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/mentor/profil">
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
      <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::tipe(); ?>"></div>
      <h1>Data Peserta</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/mentor">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/mentor/datapeserta">Data Peserta</a></li>
          <li class="breadcrumb-item active">Detail Peserta</li>
        </ol>
      </nav>
    </div>

    <section class="section profile">
        <div class="row">

            <div class="col-xl-4">
                <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <div style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden;">
                    <img src="<?= BASEURL . '/asset/img/profil/' . $data['peserta']['image']?>" alt="Profile" style="width: 100%; height: 100%; object-fit: cover; object-position: center 20%">
                    </div>
                    <h2><?= $data['peserta']['fullname_peserta'] ?></h2>
                    <h3>Peserta Magang Diskominfo</h3>
                </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Detail Data peserta</h5>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label for="fullname" class="col-form-label fw-bold">Nama Lengkap</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?= $data['peserta']['fullname_peserta'] ?>" readonly disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label for="username" class="col-form-label fw-bold">Instansi</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?= $data['peserta']['instansi'] ?>" readonly disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label for="username" class="col-form-label fw-bold">Jurusan</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?= (!empty($data['profilpeserta']['jurusan']) ? $data['profilpeserta']['jurusan'] : '-') ?>" readonly disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label for="username" class="col-form-label fw-bold">Email</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?= $data['peserta']['email'] ?>" readonly disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label for="username" class="col-form-label fw-bold">No. Handphone</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?= (!empty($data['profilpeserta']['noHP']) ? $data['profilpeserta']['noHP'] : '-') ?>" readonly disabled>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label for="username" class="col-form-label fw-bold">Mentor Magang</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?= (empty($data['mentormagang'])) ? "-" : $data['mentormagang']['fullname'] ?>" readonly disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label for="username" class="col-form-label fw-bold">Divisi Magang</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?= $data['peserta']['divisi_magang'] ?>" readonly disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label for="username" class="col-form-label fw-bold">Date Created</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?= date('d F Y, H:i:s', $data['peserta']['date_created']) ?>" readonly disabled>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-5">
                                <a href="<?= BASEURL . '/mentor/datapeserta/' ?>" class="btn btn-danger mt-2">Kembali</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

</main>