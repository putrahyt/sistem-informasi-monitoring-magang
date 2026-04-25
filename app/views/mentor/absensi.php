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
        <a class="nav-link" href="<?= BASEURL ?>/mentor/absensi">
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
      <h1>Absensi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/mentor">Home</a></li>
          <li class="breadcrumb-item active">Absensi Peserta</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Absensi Peserta <small>(<?= date('d M Y', time()) ?>)</small></h5>
                    <div class="row">
                        <div class="col-sm-3">
                            <form action="<?= BASEURL . '/mentor/absensi'?>" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keyword" placeholder="Cari nama, instansi..." autocomplete="off">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3">
                            <form action="<?= BASEURL . '/mentor/absensi'?>" method="post">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-calendar3"></i>
                                    </span>
                                    <input type="text" class="form-control" id="tanggalabsensi" name="tanggalabsensi" />
                                    <button class="btn btn-primary" type="submit" name="caritanggal">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <?php if(!empty($data['absensipeserta'])) : ?>
                    <table class="table table-bordered table-responsive-sm table-sm">
                        <thead>
                            <tr class="table-secondary">
                                <th scope="col" style="width: 3%; text-align:center; vertical-align:middle">#</th>
                                <th scope="col" style="width: 13%; text-align:center; vertical-align:middle">Tanggal</th>
                                <th scope="col" style="width: 15%; text-align:center; vertical-align:middle">Nama</th>
                                <th scope="col" style="width: 25%; text-align:center; vertical-align:middle">Instansi</th>
                                <th scope="col" style="width: 6%; text-align:center; vertical-align:middle">Absen Masuk</th>
                                <th scope="col" style="width: 6%; text-align:center; vertical-align:middle">Jam Masuk</th>
                                <th scope="col" style="width: 6%; text-align:center; vertical-align:middle">Absen Pulang</th>
                                <th scope="col" style="width: 6%; text-align:center; vertical-align:middle">Jam Pulang</th>
                                <th scope="col" style="width: 4%; text-align:center; vertical-align:middle">Aksi</th>
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
                            <td><?= $absensi['fullname_peserta'] ?></td>
                            <td><?= $absensi['instansi'] ?></td>
                            <td style="text-align: center;"><?= ($absensi['absen_masuk'] == 'true') ? '<i class="bi bi-check-circle-fill fs-5" style="color: green;" title="Hadir"></i>' : '<i class="bi bi-x-circle-fill fs-5" style="color: red;" title="Tidak Hadir"></i>' ?></td>
                            <td style="text-align: center;"><?= (!empty($absensi['jam_masuk']) && $absensi['jam_masuk'] !== 0) ? date('H:i:s', $absensi['jam_masuk']) : '<i class="bi bi-x-circle-fill fs-5" style="color: red;" title="Tidak Hadir"></i>' ?></td>
                            <td style="text-align: center;">
                                <?php if($absensi['absen_pulang'] == 'true') : ?>
                                <i class="bi bi-check-circle-fill fs-5" style="color: green;" title="Hadir"></i>
                                <?php elseif($absensi['absen_pulang'] == 'false') : ?>
                                <i class="bi bi-x-circle-fill fs-5" style="color: red;" title="Tidak Hadir"></i>
                                <?php endif ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if(!empty($absensi['jam_pulang'])) : ?>
                                <?= date('H:i:s', $absensi['jam_pulang']) ?>
                                <?php elseif($absensi['jam_pulang'] === 0) : ?>
                                <i class="bi bi-x-circle-fill fs-5" style="color: red;" title="Tidak Hadir"></i>                                    
                                <?php endif ?>
                            </td>
                            <td style="text-align: center;"><a href="<?= BASEURL . '/mentor/detailabsensi/' . $absensi['id_absensi']?>"><i class="bi bi-info-circle-fill me-1" style="color: blue;" title="Detail"></i></a></td>
                            </tr>
                            <?php $i++ ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <?php endif ?>
                    <?php if(empty($_POST['keyword']) && empty($_POST['tanggalabsensi'])) : ?>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-sm justify-content-center">
                        <?php if($data['hlmAktif'] > 1) : ?>
                            <?php $prev = $data['hlmAktif'] - 1; ?>
                            <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/absensi/' . $prev ?>">Previous</a></li>
                        <?php endif ?>

                        <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                            <?php if($i == $data['hlmAktif']) : ?>
                                <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                            <?php else : ?>
                                <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/absensi/' . $i ?>"><?= $i ?></a></li>
                            <?php endif ?>
                        <?php endfor ?>

                        <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                            <?php $next = $data['hlmAktif'] + 1; ?>
                            <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/absensi/' . $next ?>">Next</a></li>
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