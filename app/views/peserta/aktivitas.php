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
      <h1>Aktivitas</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/peserta">Home</a></li>
          <li class="breadcrumb-item active">Laporan Aktivitas</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
    <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::tipe(); ?>"></div>
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Laporan Aktivitas</h5>
                <div class="row">
                    <div class="col-sm-2">
                        <a href="<?= BASEURL ?>/peserta/addaktivitas" class="btn btn-primary mt-1"><i class="bi bi-plus-lg"></i> Tambah Aktivitas</a>
                    </div>
                    <div class="col-sm-4 mt-1">
                      <a href="<?= BASEURL . '/peserta/printaktivitas/' . base64_encode($_SESSION['session']['username']) ?>" target="_blank" class="btn btn-success" title="Cetak Aktivitas"><i class="bi bi-printer-fill"></i></a>
                    </div>
                    <div class="col-sm-3 mt-1">
                        <form action="<?= BASEURL . '/peserta/aktivitas'?>" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Cari aktivitas..." autocomplete="off">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-3 mt-1">
                        <form action="<?= BASEURL . '/peserta/aktivitas'?>" method="post">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-calendar3"></i>
                                </span>
                                <input type="text" class="form-control" id="tanggalaktivitas" name="tanggalaktivitas" />
                                <button class="btn btn-primary" type="submit" name="caritanggal">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if(!empty($data['aktivitas'])) : ?>
                <hr>
                <div class="row">
                  <div class="col-sm-12">
                    <table class="table table-bordered table-responsive-sm table-sm">
                      <thead>
                        <tr class="table-secondary">
                          <th scope="col" style="width: 3%; text-align:center; vertical-align:middle">#</th>
                          <th scope="col" style="width: 5%; vertical-align:middle; text-align:center">Status</th>
                          <th scope="col" style="width: 15%; vertical-align:middle; text-align:center">Tanggal</th>
                          <th scope="col" style="width: 35%; vertical-align:middle; text-align:center">Aktivitas</th>
                          <th scope="col" style="width: 20%; vertical-align:middle; text-align:center">Catatan dari mentor</th>
                          <th scope="col" style="width: 7%; text-align:center; vertical-align:middle">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1 + $data['awalData']; ?>
                        <?php foreach($data['aktivitas'] as $aktivitas) : ?>
                        <tr>
                          <td style="text-align: center;"><?= $i; ?></td>
                          <?php if($aktivitas['status'] == 0) : ?>
                            <td style="text-align: center;" title="Proses"><i class="bi bi-arrow-repeat fs-5"></i></td>
                          <?php elseif($aktivitas['status'] == 1) : ?>
                            <td style="text-align: center;" title="Acc"><i class="bi bi-check2 fs-5" style="color: #0bef4f"></i></td>
                          <?php else : ?>
                            <td style="text-align: center;" title="Ditolak"><i class="bi bi-x-lg fs-5" style="color: #ef0b0b"></i></td>
                          <?php endif ?>
                          <td><?= date('d F Y H:i:s', $aktivitas['tanggal']) ?></td>
                          <td><?= $aktivitas['aktivitas'] ?></td>
                          <td><?= (!empty($aktivitas['catatan_mentor'])) ? $aktivitas['catatan_mentor'] : '-' ?></td>
                          <td style="text-align: center;">
                            <?php if(($aktivitas['status'] == 1) || $aktivitas['status'] == 2) : ?>
                            <a href="<?= BASEURL . '/peserta/detailaktivitas/' . $aktivitas['id_aktivitas']?>"><i class="bi bi-info-circle-fill me-1" style="color: blue;" title="Detail"></i></a>
                            <a href="<?= BASEURL . '/peserta/deleteaktivitas/' . $aktivitas['id_aktivitas']?>" class="hapusAktivitas"><i class="bi bi-trash-fill" style="color: red;" title="Hapus"></i></a>
                            <?php else : ?>
                            <a href="<?= BASEURL . '/peserta/detailaktivitas/' . $aktivitas['id_aktivitas']?>"><i class="bi bi-info-circle-fill me-1" style="color: blue;" title="Detail"></i></a>
                            <a href="<?= BASEURL . '/peserta/editaktivitas/' . $aktivitas['id_aktivitas']?>"><i class="bi bi-pencil-fill me-1" style="color:rgb(254, 169, 0);" title="Edit"></i></a>
                            <a href="<?= BASEURL . '/peserta/deleteaktivitas/' . $aktivitas['id_aktivitas']?>" class="hapusAktivitas"><i class="bi bi-trash-fill" style="color: red;" title="Hapus"></i></a>
                            <?php endif ?>
                          </td>
                        </tr>
                        <?php $i++ ?>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                    <?php if(empty($_POST['keyword']) && empty($_POST['tanggalaktivitas'])) : ?>
                    <nav aria-label="Page navigation example">
                      <ul class="pagination pagination-sm justify-content-center">
                        <?php if($data['hlmAktif'] > 1) : ?>
                            <?php $prev = $data['hlmAktif'] - 1; ?>
                            <li class="page-item"><a class="page-link" href="<?= BASEURL . '/peserta/aktivitas/' . $prev ?>">Previous</a></li>
                        <?php endif ?>

                        <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                            <?php if($i == $data['hlmAktif']) : ?>
                                <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                            <?php else : ?>
                                <li class="page-item"><a class="page-link" href="<?= BASEURL . '/peserta/aktivitas/' . $i ?>"><?= $i ?></a></li>
                            <?php endif ?>
                        <?php endfor ?>

                        <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                            <?php $next = $data['hlmAktif'] + 1; ?>
                            <li class="page-item"><a class="page-link" href="<?= BASEURL . '/peserta/aktivitas/' . $next ?>">Next</a></li>
                        <?php endif ?>
                      </ul>
                    </nav>
                    <?php endif ?>
                  </div>
                </div>
                <?php endif ?>
            </div>
          </div>
        </div>

      </div>
    </section>

</main>