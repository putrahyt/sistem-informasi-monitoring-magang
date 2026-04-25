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
    <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::tipe(); ?>"></div>
    <div class="pagetitle">
      <h1>Absensi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/peserta">Home</a></li>
          <li class="breadcrumb-item active">Absensi</li>
        </ol>
      </nav>
    </div>

    <section class="section">
        <div class="row mb-3">
            <div class="col-lg-12">
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#absensi"><i class="bi bi-camera"></i> Absensi</a>
                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#tidakhadir"><i class="bi bi-x-lg"></i> Tidak Hadir</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                          <div><h5 class="card-title">Absensi Peserta <small>(<?= date('d M Y', time()) ?>)</small></h5></div>
                          <div class="ms-auto mt-3"><a href="<?= BASEURL . '/peserta/printabsensi/' . base64_encode($_SESSION['session']['username']) ?>" target="_blank" class="btn btn-success"><i class="bi bi-printer-fill" title="Cetak Absensi"></i></a></div>
                        </div>
                        <?php if(!empty($data['absensipeserta'])) : ?>
                        <table class="table table-bordered table-responsive-sm table-sm mt-1">
                            <thead>
                                <tr class="table-secondary">
                                    <th scope="col" style="width: 3%; text-align:center; vertical-align:middle">#</th>
                                    <th scope="col" style="width: 10%; text-align:center; vertical-align:middle">Tanggal</th>
                                    <th scope="col" style="width: 10%; text-align:center; vertical-align:middle">Absen Masuk</th>
                                    <th scope="col" style="width: 10%; text-align:center; vertical-align:middle">Jam Masuk</th>
                                    <th scope="col" style="width: 10%; text-align:center; vertical-align:middle">Absen Pulang</th>
                                    <th scope="col" style="width: 10%; text-align:center; vertical-align:middle">Jam Pulang</th>
                                    <th scope="col" style="width: 5%; text-align:center; vertical-align:middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $i=1 + $data['awalData']; ?>
                              <?php foreach($data['absensipeserta'] as $absensi) : ?>
                              <tr>
                                <td style="text-align: center;"><?= $i; ?></td>
                                <td>
                                  <?php 
                                    $hari = ['Sunday' => 'Minggu','Monday' => 'Senin','Tuesday' => 'Selasa','Wednesday' => 'Rabu','Thursday' => 'Kamis','Friday' => 'Jumat','Saturday' => 'Sabtu'];
                                    $bulan = ['01' => 'Januari','02' => 'Februari','03' => 'Maret','04' => 'April','05' => 'Mei','06' => 'Juni','07' => 'Juli','08' => 'Agustus','09' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember'];
                                    $date = new DateTime($absensi['tanggal']); $namaHari = $hari[$date->format('l')]; $tgl = $date->format('d'); $namaBulan = $bulan[$date->format('m')]; $tahun = $date->format('Y'); $hasil = "$namaHari, $tgl $namaBulan $tahun";
                                  ?>
                                  <?= $hasil ?>
                                </td>
                                <td style="text-align: center;"><?= ($absensi['absen_masuk'] == 'true') ? '<i class="bi bi-check-circle-fill fs-5" style="color: green;" title="Hadir"></i>' : '<i class="bi bi-x-circle-fill fs-5" style="color: red;" title="Tidak Hadir"></i>' ?></td>
                                <td style="text-align: center;"><?= (!empty($absensi['jam_masuk']) && $absensi['jam_masuk'] !== 0) ? date('H:i:s', $absensi['jam_masuk']) . ' WIB' : '-' ?></td>
                                <td style="text-align: center;">
                                  <?php if($absensi['absen_pulang'] == 'true') : ?>
                                    <i class="bi bi-check-circle-fill fs-5" style="color: green;" title="Hadir"></i>
                                  <?php elseif($absensi['absen_pulang'] == 'false') : ?>
                                    <i class="bi bi-x-circle-fill fs-5" style="color: red;" title="Tidak Hadir"></i>
                                  <?php endif ?>
                                </td>
                                <td style="text-align: center;">
                                  <?php if(!empty($absensi['jam_pulang'])) : ?>
                                    <?= date('H:i:s', $absensi['jam_pulang']) . ' WIB' ?>
                                  <?php elseif($absensi['jam_pulang'] === 0) : ?>
                                    -                                 
                                  <?php endif ?>
                                </td>
                                <td style="text-align: center;"><a href="<?= BASEURL . '/peserta/detailabsensi/' . $absensi['id_absensi']?>"><i class="bi bi-info-circle-fill me-1" style="color: blue;" title="Detail"></i></a></td>
                              </tr>
                              <?php $i++ ?>
                              <?php endforeach ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                          <ul class="pagination pagination-sm justify-content-center">
                            <?php if($data['hlmAktif'] > 1) : ?>
                                <?php $prev = $data['hlmAktif'] - 1; ?>
                                <li class="page-item"><a class="page-link" href="<?= BASEURL . '/peserta/absensi/' . $prev ?>">Previous</a></li>
                            <?php endif ?>

                            <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                                <?php if($i == $data['hlmAktif']) : ?>
                                    <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                                <?php else : ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/peserta/absensi/' . $i ?>"><?= $i ?></a></li>
                                <?php endif ?>
                            <?php endfor ?>

                            <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                                <?php $next = $data['hlmAktif'] + 1; ?>
                                <li class="page-item"><a class="page-link" href="<?= BASEURL . '/peserta/absensi/' . $next ?>">Next</a></li>
                            <?php endif ?>
                          </ul>
                        </nav>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<!-- Absensi -->
<div class="modal fade" id="absensi" tabindex="-1" aria-labelledby="pesan" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="absensi">Absensi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL ?>/peserta/absensikehadiran" method="post" class="needs-validation" novalidate>
            <select class="form-select" name="absensi" id="absensi" required>
                <option disabled selected value>Pilih Absensi</option>
                <option value="masuk">Absensi Masuk</option>
                <option value="pulang">Absensi Pulang</option>
            </select>
            <div class="invalid-feedback">Pilih waktu kehadiran!</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="tombolabsensi" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Tidak hadir -->
<div class="modal fade" id="tidakhadir" tabindex="-1" aria-labelledby="pesan" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tidakhadir">Tidak Hadir</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL ?>/peserta/absensi" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
          <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" name="alasan" id="floatingTextarea" required></textarea>
            <label for="floatingTextarea">Masukkan Alasan</label>
            <div class="invalid-feedback">Please enter your alasan!</div>
          </div>
          <div class="row mt-3">
            <label for="filependukung" class="col-form-label">Bukti Pendukung <small>(.PDF Maks 2 Mb)</small></label>
            <div class="col-sm-12">
              <input type="file" name="filependukung" id="filependukung" class="form-control" required>
              <div class="invalid-feedback">Please choose a file!</div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="tombolTidakHadir" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>