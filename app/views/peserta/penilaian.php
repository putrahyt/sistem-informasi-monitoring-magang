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
        <a class="nav-link" href="<?= BASEURL ?>/peserta/penilaian">
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
      <h1>Penilaian</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/peserta">Home</a></li>
          <li class="breadcrumb-item active">Nilai Akhir Magang</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nilai Akhir Magang</h5>
                    <div class="row mb-3">
                        <label for="" class="col-form-label col-sm-3">Nama Lengkap</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" value="<?= $data['username_peserta']['fullname_peserta'] ?>" disabled required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="col-form-label col-sm-3">Instansi</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" value="<?= $data['username_peserta']['instansi'] ?>" disabled required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="" class="col-form-label col-sm-3">Divisi Magang</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" value="<?= $data['username_peserta']['divisi_magang'] ?>" disabled required>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <a href="<?= BASEURL . '/peserta/printpenilaian/' . base64_encode($_SESSION['session']['username']) ?>" class="btn btn-success mb-2 ms-auto" title="Print Penilaian" target="_blank"><i class="bi bi-printer"></i></a>
                    </div>
                    <table class="table table-bordered table-responsive-sm table-sm">
                        <thead>
                            <tr class="table-secondary">
                                <th scope="col" style="width: 5%; text-align:center; vertical-align:middle">#</th>
                                <th scope="col" style="width: 20%; text-align:center; vertical-align:middle">Aspek Penilaian</th>
                                <th scope="col" style="width: 30%; text-align:center; vertical-align:middle">Indikator Penilaian</th>
                                <th scope="col" style="width: 15%; text-align:center; vertical-align:middle">Penilaian (0-100)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;">1</td>
                                <td rowspan="4" style="text-align: center; vertical-align:middle">Sikap</td>
                                <td>Disiplin</td>
                                <td style="text-align: center;"><?= empty($data['penilaian']['n_disiplin']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_disiplin'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">2</td>
                                <td>Kejujuran</td>
                                <td style="text-align: center;"><?= empty($data['penilaian']['n_kejujuran']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_kejujuran'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">3</td>
                                <td>Etika</td>
                                <td style="text-align: center;"><?= empty($data['penilaian']['n_etika']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_etika'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">4</td>
                                <td>Tanggung Jawab</td>
                                <td style="text-align: center;"><?= empty($data['penilaian']['n_tanggungjawab']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_tanggungjawab'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">5</td>
                                <td rowspan="3" style="text-align: center; vertical-align:middle">Komunikasi</td>
                                <td>Kerjasama Tim</td>
                                <td style="text-align: center;"><?= empty($data['penilaian']['n_kerjatim']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_kerjatim'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">6</td>
                                <td>Aktif Diskusi</td>
                                <td style="text-align: center;"><?= empty($data['penilaian']['n_aktifdiskusi']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_aktifdiskusi'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">7</td>
                                <td>Komunikatif</td>
                                <td style="text-align: center;"><?= empty($data['penilaian']['n_komunikatif']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_komunikatif'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">8</td>
                                <td rowspan="3" style="text-align: center; vertical-align:middle">Kemampuan Teknis</td>
                                <td>Penerapan Ilmu Jurusan</td>
                                <td style="text-align: center;"><?= empty($data['penilaian']['n_ilmujurusan']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_ilmujurusan'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">9</td>
                                <td>Penggunaan Alat Kerja</td>
                                <td style="text-align: center;"><?= empty($data['penilaian']['n_penggunaansoftware']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_penggunaansoftware'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">10</td>
                                <td>Kualitas Hasil Kerja</td>
                                <td style="text-align: center;"><?= empty($data['penilaian']['n_hasilkerja']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_hasilkerja'] ?></td>
                            </tr>
                            <tr class="border-secondary-subtle">
                                <td colspan="3" style="text-align: center;" class="fw-bold bg-secondary-subtle border-secondary-subtle">Total Rata-Rata</td>
                                <td style="text-align: center;" class="fw-bold bg-secondary-subtle border-secondary-subtle"><?= (empty($data['penilaian'])) ? 0 : (($data['penilaian']['n_disiplin'] + $data['penilaian']['n_kejujuran'] + $data['penilaian']['n_etika'] + $data['penilaian']['n_tanggungjawab'] + $data['penilaian']['n_ilmujurusan'] + $data['penilaian']['n_penggunaansoftware'] + $data['penilaian']['n_hasilkerja'] + $data['penilaian']['n_kerjatim'] + $data['penilaian']['n_komunikatif'] + $data['penilaian']['n_aktifdiskusi']) / 10) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

      </div>
    </section>

</main>