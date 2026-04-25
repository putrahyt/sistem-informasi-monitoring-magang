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

    <div class="pagetitle">
      <h1>Absensi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/peserta">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/peserta/absensi">Absensi</a></li>
          <li class="breadcrumb-item active">Detail Absensi Kehadiran</li>
        </ol>
      </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Detail Absensi Kehadiran</h5>
                    <?php 
                      $hari = ['Sunday' => 'Minggu','Monday' => 'Senin','Tuesday' => 'Selasa','Wednesday' => 'Rabu','Thursday' => 'Kamis','Friday' => 'Jumat','Saturday' => 'Sabtu'];
                      $bulan = ['01' => 'Januari','02' => 'Februari','03' => 'Maret','04' => 'April','05' => 'Mei','06' => 'Juni','07' => 'Juli','08' => 'Agustus','09' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember'];
                      $date = new DateTime($data['absensi']['tanggal']); $namaHari = $hari[$date->format('l')]; $tgl = $date->format('d'); $namaBulan = $bulan[$date->format('m')]; $tahun = $date->format('Y'); $hasil = "$namaHari, $tgl $namaBulan $tahun";
                    ?>
                    <div class="row">
                        <div class="col-sm-3"><label class="col-form-label fw-bold">Tanggal</label></div>
                        <div class="col-sm-9"><input type="text" class="form-control" value="<?= $hasil ?>" readonly disabled></div>
                    </div>
                    <?php if($data['absensi']['izin_absen'] === null) : ?>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3"><label class="col-form-label fw-bold">Absensi Masuk</label></div>
                        <div class="col-sm-9"><input type="text" class="form-control" value="<?= ($data['absensi']['absen_masuk'] == 'true') ? 'Hadir' : 'Tidak Hadir' ?>" readonly disabled></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><label class="col-form-label fw-bold">Jam Masuk</label></div>
                        <div class="col-sm-9"><input type="text" class="form-control" value="<?= (!empty($data['absensi']['jam_masuk']) && $data['absensi']['jam_masuk'] !== 0) ? date('H:i:s', $data['absensi']['jam_masuk']) . ' WIB' : 'Tidak Hadir' ?>" readonly disabled></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><label class="col-form-label fw-bold">Bukti Foto</label></div>
                        <div class="col-sm-9">
                            <?php if(!empty($data['absensi']['img_absensi_masuk'])) : ?>
                                <a href="<?= BASEURL . '/asset/img/absen/' . $data['absensi']['img_absensi_masuk'] ?>" target="_blank"><i class="bi bi-file-image fs-4" title="File"></i></a>
                            <?php else : ?>
                                -
                            <?php endif ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3"><label class="col-form-label fw-bold">Absensi Pulang</label></div>
                        <?php if($data['absensi']['absen_pulang'] == 'true') : ?>
                            <div class="col-sm-9"><input type="text" class="form-control" value="Hadir" readonly disabled></div>
                        <?php elseif($data['absensi']['absen_pulang'] == 'false') : ?>
                            <div class="col-sm-9"><input type="text" class="form-control" value="Tidak Hadir" readonly disabled></div>
                        <?php else : ?>
                            <div class="col-sm-9">-</div>
                        <?php endif ?>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><label class="col-form-label fw-bold">Jam Pulang</label></div>
                        <?php if(!empty($data['absensi']['jam_pulang'])) : ?>
                            <div class="col-sm-9"><input type="text" class="form-control" value="<?= date('H:i:s', $data['absensi']['jam_pulang']) . ' WIB'?>" readonly disabled></div>
                        <?php elseif($data['absensi']['jam_pulang'] === 0) : ?>
                            <div class="col-sm-9"><input type="text" class="form-control" value="Tidak Hadir" readonly disabled></div>
                        <?php else : ?>
                            <div class="col-sm-9">-</div>
                        <?php endif ?>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-3"><label class="col-form-label fw-bold">Bukti Foto</label></div>
                        <div class="col-sm-9">
                            <?php if(!empty($data['absensi']['img_absensi_pulang'])) : ?>
                                <a href="<?= BASEURL . '/asset/img/absen/' . $data['absensi']['img_absensi_pulang'] ?>" target="_blank"><i class="bi bi-file-image fs-4" title="File"></i></a>
                            <?php else : ?>
                                -
                            <?php endif ?>
                        </div>
                    </div>
                    <?php endif ?>
                    <?php if($data['absensi']['izin_absen'] !== null) : ?>
                    <hr>
                    <h5 class="card-title">Izin Absen</h5>
                    <div class="row mb-3">
                        <div class="col-sm-3"><label class="col-form-label fw-bold">Alasan</label></div>
                        <?php if(!empty($data['absensi']['izin_absen'])) : ?>
                        <div class="col-sm-9">
                            <textarea class="form-control" readonly disabled><?= $data['absensi']['izin_absen'] ?></textarea>
                        </div>
                        <?php else : ?>
                            -
                        <?php endif ?>
                    </div>
                    <div class="row mb-4">
                      <div class="col-sm-3"><label class="col-form-label fw-bold">Bukti Pendukung</label></div>
                      <div class="col-sm-9">
                        <a href="<?= BASEURL . '/asset/img/absen/filetidakhadir/' . $data['absensi']['bukti_izin'] ?>" download><i class="bi bi-file-earmark-fill fs-4" title="File"></i><small><?= $data['absensi']['bukti_izin'] ?></small></a>
                      </div>
                    </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-sm-5"><a href="<?= BASEURL . '/peserta/absensi' ?>" class="btn btn-danger mt-2">Kembali</a></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>

</main>