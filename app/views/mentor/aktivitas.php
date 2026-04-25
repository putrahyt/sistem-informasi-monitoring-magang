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
          <span>Aktivitas Peserta</span>
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
          <li class="breadcrumb-item active">Laporan Aktivitas Peserta</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
    <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::tipe(); ?>"></div>
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Laporan Aktivitas Peserta</h5>
                <div class="row">
                    <div class="col-sm-3 mt-1">
                        <form action="<?= BASEURL . '/mentor/aktivitas'?>" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Cari nama, aktivitas..." autocomplete="off">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-3 mt-1">
                        <form action="<?= BASEURL . '/mentor/aktivitas'?>" method="post">
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
                          <th scope="col" style="width: 10%; vertical-align:middle; text-align:center">Status</th>
                          <th scope="col" style="width: 15%; vertical-align:middle; text-align:center">Tanggal</th>
                          <th scope="col" style="width: 20%; vertical-align:middle; text-align:center">Nama</th>
                          <th scope="col" style="width: 40%; vertical-align:middle; text-align:center">Aktivitas</th>
                          <th scope="col" style="width: 7%; text-align:center; vertical-align:middle">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1 + $data['awalData']; ?>
                        <?php foreach($data['aktivitas'] as $aktivitas) : ?>
                        <tr>
                          <td style="text-align: center;"><?= $i; ?></td>
                          <?php if($aktivitas['status'] == 0) : ?>
                            <td style="text-align: center">
                              <span style="cursor:pointer;" class="badge text-bg-danger tolakaktivitas" data-bs-toggle="modal" data-bs-target="#tolakaktivitas" data-id="<?= $aktivitas['id_aktivitas'] ?>">Tolak</span>
                              <span style="cursor:pointer;"  class="badge text-bg-success accaktivitas" data-bs-toggle="modal" data-bs-target="#accaktivitas" data-id="<?= $aktivitas['id_aktivitas'] ?>">Acc</span>
                            </td>
                          <?php elseif($aktivitas['status'] == 1) : ?>
                            <td style="text-align: center;" title="Acc"><i class="bi bi-check2 fs-5" style="color: #0bef4f"></i></td>
                          <?php else : ?>
                            <td style="text-align: center;" title="Ditolak"><i class="bi bi-x-lg fs-5" style="color: #ef0b0b"></i></td>
                          <?php endif ?>
                          <td><?= date('d F Y H:i:s', $aktivitas['tanggal']) ?></td>
                          <td><?= $aktivitas['fullname_peserta'] ?></td>
                          <td><?= $aktivitas['aktivitas'] ?></td>
                          <td style="text-align: center;">
                            <a href="<?= BASEURL . '/mentor/detailaktivitas/' . $aktivitas['id_aktivitas']?>"><i class="bi bi-info-circle-fill me-1" style="color: blue;" title="Detail"></i></a>
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
                            <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/aktivitas/' . $prev ?>">Previous</a></li>
                        <?php endif ?>

                        <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                            <?php if($i == $data['hlmAktif']) : ?>
                                <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                            <?php else : ?>
                                <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/aktivitas/' . $i ?>"><?= $i ?></a></li>
                            <?php endif ?>
                        <?php endfor ?>

                        <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                            <?php $next = $data['hlmAktif'] + 1; ?>
                            <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/aktivitas/' . $next ?>">Next</a></li>
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

<!-- Catatan Acc -->
<div class="modal fade" id="accaktivitas" tabindex="-1" aria-labelledby="pesan" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="catatan">Beri Catatan <small>(opsional)</small></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL ?>/mentor/aktivitas" method="post">
          <input type="hidden" name="id_aktivitas" id="id_aktivitas_acc" value="<?= $aktivitas['id_aktivitas'] ?>">
          <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" name="catatan" id="floatingTextarea"></textarea>
            <label for="floatingTextarea">Masukkan Catatan</label>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="accaktivitas" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Catatan Ditolak -->
<div class="modal fade" id="tolakaktivitas" tabindex="-1" aria-labelledby="pesan" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="catatan">Beri Catatan <small>(opsional)</small></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL ?>/mentor/aktivitas" method="post">
          <input type="hidden" name="id_aktivitas" id="id_aktivitas_tolak" value="<?= $aktivitas['id_aktivitas'] ?>">
          <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" name="catatan" id="floatingTextarea"></textarea>
            <label for="floatingTextarea">Masukkan Catatan</label>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="tolakaktivitas" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>