<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="<?= BASEURL ?>/tamu">
          <i class="bi bi-people-fill"></i>
          <span>Peserta</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/tamu/search">
          <i class="bi bi-search"></i>
          <span>Aktivitas & Absensi</span>
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
      <h1>Peserta</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/tamu">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/tamu">Peserta Magang</a></li>
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
                    <h3 class="mt-2">Peserta Magang Diskominfo</h3>
                </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Detail Data peserta</h5>

                        <div class="row mb-3">
                            <label for="fullname" class="col-form-label fw-bold">Nama Lengkap</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?= $data['peserta']['fullname_peserta'] ?>" readonly disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-form-label fw-bold">Username</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?= $data['peserta']['username'] ?>" readonly disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-form-label fw-bold">Instansi</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?= $data['peserta']['instansi'] ?>" readonly disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-form-label fw-bold">Email</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?= $data['peserta']['email'] ?>" readonly disabled>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="username" class="col-form-label fw-bold">Mentor Magang</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?= (empty($data['mentormagang'])) ? "-" : $data['mentormagang']['fullname'] ?>" readonly disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-form-label fw-bold">Divisi Magang</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?= $data['peserta']['divisi_magang'] ?>" readonly disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-form-label fw-bold">Date Created</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?= date('d F Y, H:i:s', $data['peserta']['date_created']) ?>" readonly disabled>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-5">
                                <a href="<?= BASEURL . '/tamu' ?>" class="btn btn-danger mt-2">Kembali</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

</main>