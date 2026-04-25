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
        <a class="nav-link" href="<?= BASEURL ?>/mentor/aktivitas">
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
      <h1>Aktivitas</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/mentor">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/mentor/aktivitas">Laporan Aktivitas Peserta</a></li>
          <li class="breadcrumb-item active">Detail Aktivitas Peserta</li>
        </ol>
      </nav>
    </div>

    <section class="section">
        <div class="row">

            <div class="col-xl-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Aktivitas Peserta</h5>
                        <div class="row mb-3">
                            <div class="col-sm-3"><label class="col-form-label fw-bold">Nama</label></div>
                            <div class="col-sm-9"><input type="text" class="form-control" value="<?= $data['aktivitas']['fullname_peserta'] ?>" readonly disabled></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><label class="col-form-label fw-bold">Instansi</label></div>
                            <div class="col-sm-9"><input type="text" class="form-control" value="<?= $data['aktivitas']['instansi'] ?>" readonly disabled></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><label class="col-form-label fw-bold">Divisi</label></div>
                            <div class="col-sm-9"><input type="text" class="form-control" value="<?= $data['aktivitas']['divisi_magang'] ?>" readonly disabled></div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-sm-3"><label class="col-form-label fw-bold">Tanggal Aktivitas</label></div>
                            <div class="col-sm-9"><input type="text" class="form-control" value="<?= date('d F Y H:i:s', $data['aktivitas']['tanggal']) ?>" readonly disabled></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><label class="col-form-label fw-bold">Aktivitas</label></div>
                            <div class="col-sm-9"><textarea class="form-control" readonly disabled><?= $data['aktivitas']['aktivitas'] ?></textarea></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><label class="col-form-label fw-bold">Catatan</label></div>
                            <div class="col-sm-9">
                                <?php if(empty($data['aktivitas']['catatan'])) : ?>
                                    <textarea class="form-control" readonly disabled>-</textarea>
                                <?php else : ?>
                                    <textarea class="form-control" readonly disabled><?= $data['aktivitas']['catatan'] ?></textarea>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><label class="col-form-label fw-bold">File Upload</label></div>
                            <?php if(empty($data['aktivitas']['file_laporan'])) : ?>
                                <div class="col-sm-5">-</div>
                            <?php else : ?>
                                <?php
                                    $namafile = explode('.', $data['aktivitas']['file_laporan']);
                                    $ekstensi = end($namafile);
                                ?>
                                <?php if($ekstensi === 'jpeg' || $ekstensi === 'jpg') : ?>
                                    <div class="col-sm-5"><a href="<?= BASEURL . '/asset/img/fileaktivitas/' . $data['aktivitas']['file_laporan'] ?>" target="_blank"><i class="bi bi-file-earmark-fill fs-4" title="File"></i><small><?= $data['aktivitas']['file_laporan'] ?></small></a></div>
                                <?php else :  ?>
                                    <div class="col-sm-5"><a href="<?= BASEURL . '/asset/img/fileaktivitas/' . $data['aktivitas']['file_laporan'] ?>" download><i class="bi bi-file-earmark-fill fs-4" title="File"></i><small><?= $data['aktivitas']['file_laporan'] ?></small></a></div>
                                <?php endif ?>
                            <?php endif ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"><label class="col-form-label fw-bold">Link Upload</label></div>
                            <?php if(empty($data['aktivitas']['link_laporan'])) : ?>
                                <div class="col-sm-5">-</div>
                            <?php else : ?>
                                <div class="col-sm-5"><a href="<?= $data['aktivitas']['link_laporan'] ?>" target="_blank"><i class="bi bi-link-45deg fs-4" title="Link"></i></a></div>
                            <?php endif ?>
                        </div>
                        <hr>
                        <h5 class="card-title">Catatan</h5>
                        <div class="row mb-3">
                            <div class="col-sm-3"><label class="col-form-label fw-bold">Catatan dari mentor</label></div>
                            <div class="col-sm-9">
                                <?php if(empty($data['aktivitas']['catatan_mentor'])) : ?>
                                    <textarea class="form-control" readonly disabled>-</textarea>
                                <?php else : ?>
                                    <textarea class="form-control" readonly disabled><?= $data['aktivitas']['catatan_mentor'] ?></textarea>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-5"><a href="<?= BASEURL . '/mentor/aktivitas/' ?>" class="btn btn-danger mt-2">Kembali</a></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</main>