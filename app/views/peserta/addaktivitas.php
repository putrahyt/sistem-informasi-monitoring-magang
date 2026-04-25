<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/peserta">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/peserta/absensi">
          <i class="bi bi-calendar-check"></i>
          <span>Absensi</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= BASEURL ?>/peserta/aktivitas">
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
      <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::tipe(); ?>"></div>
      <h1>Aktivitas</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/peserta">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/peserta/aktivitas">Laporan Aktivitas</a></li>
          <li class="breadcrumb-item active">Tambah Laporan Aktivitas</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">

        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Tambah Laporan Aktivitas</h5>

                    <form class="row g-3 needs-validation" method="post" action="<?= BASEURL ?>/peserta/addaktivitas" enctype="multipart/form-data" novalidate>
                        <div class="row mb-3">
                            <label for="tanggal" class="col-form-label col-sm-4">Tanggal *</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d\TH:i') ?>" required>
                                <div class="invalid-feedback">Please enter your tanggal aktivitas!</div>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="aktivitas" class="col-form-label col-sm-4">Aktivitas *</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="aktivitas" id="aktivitas" autocomplete="off" required></textarea>
                                <div class="invalid-feedback">Please enter your aktivitas!</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="catatan" class="col-form-label col-sm-4">Catatan</label>
                            <div class="col-sm-8">
                                <textarea name="catatan" id="catatan" class="form-control" autocomplete="off"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="fileaktivitas" class="col-form-label col-sm-4">File</label>
                            <div class="col-sm-8">
                                <input type="file" name="fileaktivitas" id="fileaktivitas" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="urlaktivitas" class="col-form-label col-sm-4">URL</label>
                            <div class="col-sm-8">
                                <input type="url" name="urlaktivitas" id="urlaktivitas" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-5">
                                <a href="<?= BASEURL ?>/peserta/aktivitas" class="btn btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-primary" name="tambahaktivitas">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

      </div>
    </section>

</main>