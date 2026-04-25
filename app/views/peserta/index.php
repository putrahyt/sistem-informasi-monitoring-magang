<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?= BASEURL ?>/peserta">
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/peserta">Home</a></li>
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
                  <h5 class="card-title">Total Aktivitas</h5>
                  <a href="<?= BASEURL ?>/peserta/aktivitas">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-journal-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?= $data['totalaktivitas'] ?> Aktivitas</h6>
                    </div>
                  </div>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xxl-3 col-md-6">
              <div class="card info-card green-card">
                <div class="card-body">
                  <h5 class="card-title">Nilai Akhir Magang</h5>
                  <a href="<?= BASEURL ?>/peserta/penilaian">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-pencil-square"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?= (empty($data['penilaian'])) ? 'Belum dinilai' : (($data['penilaian']['n_disiplin'] + $data['penilaian']['n_kejujuran'] + $data['penilaian']['n_etika'] + $data['penilaian']['n_tanggungjawab'] + $data['penilaian']['n_ilmujurusan'] + $data['penilaian']['n_penggunaansoftware'] + $data['penilaian']['n_hasilkerja'] + $data['penilaian']['n_kerjatim'] + $data['penilaian']['n_komunikatif'] + $data['penilaian']['n_aktifdiskusi']) / 10) ?></h6>
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
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Aktivitas <span>| 5 aktivitas terakhir</span></h5>
              <table class="table table-bordered table-responsive-sm table-sm">
                <thead>
                  <tr class="table-secondary">
                    <th scope="col" style="width: 5%; text-align:center; vertical-align:middle">#</th>
                    <th scope="col" style="width: 10%; vertical-align:middle; text-align:center">Status</th>
                    <th scope="col" style="width: 35%; vertical-align:middle; text-align:center">Tanggal</th>
                    <th scope="col" style="width: 50%; vertical-align:middle; text-align:center">Aktivitas</th>
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
                    <td><?= date('d F Y H:i:s', $aktivitas['tanggal']) ?></td>
                    <td><?= $aktivitas['aktivitas'] ?></td>
                  </tr>
                  <?php $i++ ?>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Absensi <span>| 5 absensi terakhir</span></h5>
              <table class="table table-bordered table-responsive-sm table-sm">
                <thead>
                  <tr class="table-secondary">
                    <th scope="col" style="width: 5%; text-align:center; vertical-align:middle">#</th>
                    <th scope="col" style="width: 35%; vertical-align:middle; text-align:center">Tanggal</th>
                    <th scope="col" style="width: 20%; vertical-align:middle; text-align:center">Absen masuk</th>
                    <th scope="col" style="width: 20%; vertical-align:middle; text-align:center">Absen pulang</th>
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