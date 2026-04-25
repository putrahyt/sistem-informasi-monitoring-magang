<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/admin">
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
        <a class="nav-link" href="<?= BASEURL ?>/admin/laporan">
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
      <h1>Laporan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Home</a></li>
          <li class="breadcrumb-item active">Laporan</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Pilih Laporan</h5>
                <form action="<?= BASEURL ?>/admin/laporan" class="row g-3 needs-validation" method="post" novalidate>
                    <div class="row mb-3">
                        <label for="tipepencarian" class="col-form-label col-sm-4">Tipe Pencarian</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="tipepencarian" id="tipepencarian" required>
                                <option disabled selected value>-- Pilih Tipe Pencarian --</option>
                                <option value="absensi">Absensi Peserta</option>
                                <option value="aktivitas">Aktivitas Peserta</option>
                            </select>
                            <div class="invalid-feedback">Pilih tipe pencarian!</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="namapeserta" class="col-form-label col-sm-4">Nama Peserta</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="namapeserta" id="namapeserta" required>
                                <option disabled selected value>-- Pilih Nama Peserta --</option>
                                <?php foreach($data['peserta'] as $peserta) : ?>
                                    <option value="<?= $peserta['username'] ?>"><?= $peserta['fullname_peserta'] ?> / <?= $peserta['instansi'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Pilih nama peserta!</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="periode" class="col-form-label col-sm-4">Periode</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-calendar3"></i>
                                </span>
                                <input type="text" class="form-control" id="periode" name="periode" required />
                                <div class="invalid-feedback">Pilih periode!</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-primary" name="tombollaporan">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>

        <?php if(!empty($data['laporan'])) : ?>
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-11">
                  <h5 class="card-title">Laporan <?= $data['laporan'] ?> Peserta <small>(<?= $data['tanggalAwal'] . ' s.d ' . $data['tanggalAkhir']?>)</small></h5>
                </div>
                <div class="col-sm-1 mt-3">
                  <?php 
                    if($data['laporan'] == 'Absensi') {
                      $url = BASEURL . '/admin/printabsensi';
                    } else if($data['laporan'] == 'Aktivitas') {
                      $url = BASEURL . '/admin/printaktivitas';
                    }
                  ?>
                  <form action="<?= $url ?>" method="post" target="_blank">
                    <input type="hidden" name="peserta" value="<?= $data['profilpeserta']['username'] ?>">
                    <input type="hidden" name="periode" value="<?= $data['periode'] ?>">
                    <button type="submit" class="btn btn-success"><i class="bi bi-printer-fill" title="Cetak Absensi"></i></button>
                  </form>
                </div>
              </div>
              <hr>
              <div class="row mb-3">
                <label for="tipepencarian" class="col-form-label col-sm-3">Nama</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" value="<?= $data['profilpeserta']['fullname_peserta'] ?>" readonly disabled>
                </div>
              </div>
              <div class="row mb-3">
                <label for="namapeserta" class="col-form-label col-sm-3">Instansi</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" value="<?= $data['profilpeserta']['instansi'] ?>" readonly disabled/>
                </div>
              </div>
              <div class="row mb-3">
                <label for="periode" class="col-form-label col-sm-3">Divisi Magang</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" value="<?= $data['profilpeserta']['divisi_magang'] ?>" readonly disabled/>
                </div>
              </div>
              <div class="row mb-4">
                <label for="periode" class="col-form-label col-sm-3">Mentor</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" value="<?= $data['profilpeserta']['fullname'] ?>" readonly disabled/>
                </div>
              </div>
              <?php if(!empty(($data['laporan']) && $data['laporan'] == 'Absensi')) : ?>
              <table class="table table-bordered table-responsive-sm table-sm">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col" style="width: 3%; text-align:center; vertical-align:middle">#</th>
                        <th scope="col" style="width: 13%; text-align:center; vertical-align:middle">Tanggal</th>
                        <th scope="col" style="width: 6%; text-align:center; vertical-align:middle">Absen Masuk</th>
                        <th scope="col" style="width: 6%; text-align:center; vertical-align:middle">Jam Masuk</th>
                        <th scope="col" style="width: 6%; text-align:center; vertical-align:middle">Absen Pulang</th>
                        <th scope="col" style="width: 6%; text-align:center; vertical-align:middle">Jam Pulang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1 ?>
                    <?php if(!empty($data['absensi'])) : ?>
                    <?php foreach($data['absensi'] as $absensi) : ?>
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
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach ?>
                    <?php else : ?>
                    <tr>
                      <td colspan="6" style="text-align: center;">Tidak ada data</td>
                    </tr>
                    <?php endif ?>
                </tbody>
              </table>
              <?php elseif(!empty(($data['laporan']) && $data['laporan'] == 'Aktivitas')) : ?>
              <table class="table table-bordered table-responsive-sm table-sm">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col" style="width: 3%; text-align:center; vertical-align:middle">#</th>
                        <th scope="col" style="width: 18%; text-align:center; vertical-align:middle">Tanggal</th>
                        <th scope="col" style="width: 45%; text-align:center; vertical-align:middle">Aktivitas</th>
                        <th scope="col" style="width: 25%; text-align:center; vertical-align:middle">Catatan Mentor</th>
                        <th scope="col" style="width: 5%; text-align:center; vertical-align:middle">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1 ?>
                    <?php if(!empty($data['aktivitas'])) : ?>
                    <?php foreach($data['aktivitas'] as $aktivitas) : ?>
                    <tr>
                      <td style="text-align: center;"><?= $i; ?></td>
                      <td><?= date('d F Y H:i:s', $aktivitas['tanggal']) ?></td>
                      <td><?= $aktivitas['aktivitas'] ?></td>
                      <td><?= empty($aktivitas['catatan_mentor']) ? '-' : $aktivitas['catatan_mentor'] ?></td>
                      <?php if($aktivitas['status'] == 0) : ?>
                        <td style="text-align: center;" title="Proses"><i class="bi bi-arrow-repeat fs-5"></i></td>
                      <?php elseif($aktivitas['status'] == 1) : ?>
                        <td style="text-align: center;" title="Acc"><i class="bi bi-check2 fs-5" style="color: #0bef4f"></i></td>
                      <?php else : ?>
                        <td style="text-align: center;" title="Ditolak"><i class="bi bi-x-lg fs-5" style="color: #ef0b0b"></i></td>
                      <?php endif ?>
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach ?>
                    <?php else : ?>
                    <tr>
                      <td colspan="6" style="text-align: center;">Tidak ada data</td>
                    </tr>
                    <?php endif ?>
                </tbody>
              </table>
              <?php endif ?>
            </div>
          </div>
        </div>
        <?php endif ?>

      </div>
    </section>

</main>