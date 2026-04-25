<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/mentor">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/mentor/datapeserta">
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
        <a class="nav-link" href="<?= BASEURL ?>/mentor/penilaian">
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
    <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::tipe(); ?>"></div>
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/mentor">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/mentor">Penilaian Akhir Peserta Magang</a></li>
          <li class="breadcrumb-item active">Detail Nilai Peserta</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-2">Peserta Magang</h5>
                    
                    <div class="row mb-3">
                        <label for="" class="col-form-label col-sm-3">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data['username_peserta']['fullname_peserta'] ?>" disabled required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="col-form-label col-sm-3">Instansi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data['username_peserta']['instansi'] ?>" disabled required>
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="col-form-label col-sm-3">Divisi Magang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data['username_peserta']['divisi_magang'] ?>" disabled required>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <label class="col-form-label col-sm-6"><h5 class="card-title">Nilai Sikap</h5></label>
                    </div>

                    <div class="row mb-3">
                        <label for="disiplin" class="col-form-label col-sm-4">Disiplin</label>
                        <div class="col-sm-3">
                            <input type="number" name="disiplin" value="<?= $data['penilaian']['n_disiplin'] ?>" id="disiplin" class="form-control" disabled required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="kejujuran" class="col-form-label col-sm-4">Kejujuran</label>
                        <div class="col-sm-3">
                            <input type="number" name="kejujuran" value="<?= $data['penilaian']['n_kejujuran'] ?>" id="kejujuran" class="form-control" disabled required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="etika" class="col-form-label col-sm-4">Etika</label>
                        <div class="col-sm-3">
                            <input type="number" name="etika" value="<?= $data['penilaian']['n_etika'] ?>" id="etika" class="form-control" disabled required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tanggungjawab" class="col-form-label col-sm-4">Tanggung jawab</label>
                        <div class="col-sm-3">
                            <input type="number" name="tanggungjawab" value="<?= $data['penilaian']['n_tanggungjawab'] ?>" id="tanggungjawab" class="form-control" disabled required>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-form-label col-sm-6"><h5 class="card-title">Nilai Komunikasi</h5></label>
                    </div> 

                    <div class="row mb-3">
                        <label for="kerjatim" class="col-form-label col-sm-4">Kerjasama tim</label>
                        <div class="col-sm-3">
                            <input type="number" name="kerjatim" value="<?= $data['penilaian']['n_kerjatim'] ?>" id="kerjatim" class="form-control" disabled required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="aktifdiskusi" class="col-form-label col-sm-4">Aktif diskusi</label>
                        <div class="col-sm-3">
                            <input type="number" name="aktifdiskusi" value="<?= $data['penilaian']['n_aktifdiskusi'] ?>" id="aktifdiskusi" class="form-control" disabled required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="komunikatif" class="col-form-label col-sm-4">Komunikatif</label>
                        <div class="col-sm-3">
                            <input type="number" name="komunikatif" value="<?= $data['penilaian']['n_komunikatif'] ?>" id="komunikatif" class="form-control" disabled required>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-form-label col-sm-6"><h5 class="card-title">Nilai Kemampuan Teknis</h5></label>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="ilmujurusan" class="col-form-label col-sm-4">Penerapan ilmu jurusan</label>
                        <div class="col-sm-3">
                            <input type="number" name="ilmujurusan" value="<?= $data['penilaian']['n_ilmujurusan'] ?>" id="ilmujurusan" class="form-control" disabled required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="penggunaansoftware" class="col-form-label col-sm-4">Penggunaan alat kerja</label>
                        <div class="col-sm-3">
                            <input type="number" name="penggunaansoftware" value="<?= $data['penilaian']['n_penggunaansoftware'] ?>" id="penggunaansoftware" class="form-control" disabled required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="hasilkerja" class="col-form-label col-sm-4">Kualitas hasil kerja</label>
                        <div class="col-sm-3">
                            <input type="number" name="hasilkerja" value="<?= $data['penilaian']['n_hasilkerja'] ?>" id="hasilkerja" class="form-control" disabled required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-5">
                            <a href="<?= BASEURL ?>/mentor/penilaian" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </section>

</main>