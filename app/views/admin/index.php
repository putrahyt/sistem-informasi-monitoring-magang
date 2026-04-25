<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?= BASEURL ?>/admin">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/admin/datamentor">
          <i class="bi bi-people-fill"></i>
          <span>Data Mentor</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/admin/datapeserta">
          <i class="bi bi-people-fill"></i>
          <span>Data Peserta</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/admin/laporan">
          <i class="bi bi-file-earmark-text"></i>
          <span>Laporan Aktivitas & Absensi</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/admin/pengaturan">
          <i class="bi bi-gear-fill"></i>
          <span>Pengaturan</span>
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card blue-card">
                <div class="card-body">
                  <h5 class="card-title">Total Peserta</h5>
                  <a href="<?= BASEURL ?>/admin/datapeserta">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?= $data['totalpeserta'] ?> Peserta</h6>
                    </div>
                  </div>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xxl-3 col-md-6">
              <div class="card info-card blue-card">
                <div class="card-body">
                  <h5 class="card-title">Total Mentor</h5>
                  <a href="<?= BASEURL ?>/admin/datamentor">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?= $data['totalmentor'] ?> Mentor</h6>
                    </div>
                  </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr class="mb-5">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Aktivitas Peserta <span>| Hari ini</span></h5>
              <table class="table table-bordered table-responsive-sm table-sm">
                <thead>
                  <tr class="table-secondary">
                    <th scope="col" style="width: 3%; text-align:center; vertical-align:middle">#</th>
                    <th scope="col" style="width: 5%; vertical-align:middle; text-align:center">Status</th>
                    <th scope="col" style="width: 19%; vertical-align:middle; text-align:center">Tanggal</th>
                    <th scope="col" style="width: 22%; vertical-align:middle; text-align:center">Nama</th>
                    <th scope="col" style="width: 22%; vertical-align:middle; text-align:center">Mentor</th>
                    <th scope="col" style="width: 25%; vertical-align:middle; text-align:center">Aktivitas</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1 ?>
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
                    <td><?= date('d F Y H:i:s', $aktivitas['tanggal']) ?> WIB</td>
                    <td><?= $aktivitas['fullname_peserta'] ?></td>
                    <td><?= $aktivitas['fullname'] ?></td>
                    <td><?= $aktivitas['aktivitas'] ?></td>
                  </tr>
                  <?php $i++ ?>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Absensi Peserta <span>| Hari ini</span></h5>
              <table class="table table-bordered table-responsive-sm table-sm">
                <thead>
                  <tr class="table-secondary">
                    <th scope="col" style="width: 5%; text-align:center; vertical-align:middle">#</th>
                    <th scope="col" style="width: 15%; vertical-align:middle; text-align:center">Tanggal</th>
                    <th scope="col" style="width: 20%; vertical-align:middle; text-align:center">Nama</th>
                    <th scope="col" style="width: 25%; vertical-align:middle; text-align:center">Instansi</th>
                    <th scope="col" style="width: 10%; vertical-align:middle; text-align:center">Absen masuk</th>
                    <th scope="col" style="width: 10%; vertical-align:middle; text-align:center">Absen pulang</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1 ?>
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
                    <td><?= $absensi['fullname_peserta']; ?></td>
                    <td><?= $absensi['instansi']; ?></td>
                    <td style="text-align: center;"><?= ($absensi['absen_masuk'] == 'true') ? '<i class="bi bi-check-circle-fill fs-5" style="color: green;" title="Hadir"></i>' : '<i class="bi bi-x-circle-fill fs-5" style="color: red;" title="Tidak Hadir"></i>' ?></td>
                    <td style="text-align: center;">
                      <?php if($absensi['absen_pulang'] == 'true') : ?>
                        <i class="bi bi-check-circle-fill fs-5" style="color: green;" title="Hadir"></i>
                      <?php elseif($absensi['absen_pulang'] == 'false') : ?>
                        <i class="bi bi-x-circle-fill fs-5" style="color: red;" title="Tidak Hadir"></i>
                      <?php endif ?>
                    </td>
                  </tr>
                  <?php $i++ ?>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

</main>