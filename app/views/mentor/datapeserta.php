<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/mentor">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= BASEURL ?>/mentor/datapeserta">
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
      <h1>Data Peserta</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/mentor">Home</a></li>
          <li class="breadcrumb-item active">Data Peserta</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Peserta Magang</h5>
                    <div class="row">
                        <div class="col-sm-3">
                          <form action="<?= BASEURL . '/mentor/datapeserta'?>" method="post">
                            <div class="input-group">
                              <input type="text" class="form-control" name="keyword" placeholder="Cari peserta..." autocomplete="off">
                              <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                          </form>
                        </div>
                    </div>


                    <?php if(!empty($data["peserta"])) : ?>
                      <div class="row mt-4">
                        <div class="col-sm-12">
                          <table class="table table-bordered table-responsive-sm table-sm">
                            <thead>
                                <tr class="table-secondary">
                                  <th scope="col" style="width: 2%; text-align:center; vertical-align:middle">#</th>
                                  <th scope="col" style="width: 4%; vertical-align:middle">Image</th>
                                  <th scope="col" style="width: 30%; vertical-align:middle">Nama</th>
                                  <th scope="col" style="width: 30%; vertical-align:middle">Instansi</th>
                                  <th scope="col" style="width: 30%; vertical-align:middle">Divisi Magang</th>
                                  <th scope="col" style="width: 4%; text-align: center; vertical-align:middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $i = 1 + $data['awalData']; ?>
                              <?php foreach($data["peserta"] as $peserta) : ?>
                                <tr>
                                    <th scope="row" style="text-align: center;"><?= $i; ?></th>
                                    <td style="text-align: center;"><img src="<?= BASEURL . '/asset/img/profil/' . $peserta['image'] ?>" width="100%" height="47px" class="rounded-circle" style="object-fit: cover;" alt="profil"></td>
                                    <td><?= $peserta['fullname_peserta'] ?></td>
                                    <td><?= $peserta['instansi'] ?></td>
                                    <td><?= $peserta['divisi_magang'] ?></td>
                                    <td style="text-align: center;">
                                        <a href="<?= BASEURL . '/mentor/detailpeserta/' . $peserta['id_peserta']?>"><i class="bi bi-info-circle-fill me-1" style="color: blue;" title="Detail"></i></a>
                                    </td>
                                </tr>
                              <?php $i++; ?>
                              <?php endforeach ?>
                            </tbody>
                          </table>
                          <?php if(empty($_POST['keyword'])) : ?>
                          <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-sm justify-content-center">
                              <?php if($data['hlmAktif'] > 1) : ?>
                                  <?php $prev = $data['hlmAktif'] - 1; ?>
                                  <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/datapeserta/' . $prev ?>">Previous</a></li>
                              <?php endif ?>

                              <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                                  <?php if($i == $data['hlmAktif']) : ?>
                                      <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                                  <?php else : ?>
                                      <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/datapeserta/' . $i ?>"><?= $i ?></a></li>
                                  <?php endif ?>
                              <?php endfor ?>

                              <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                                  <?php $next = $data['hlmAktif'] + 1; ?>
                                  <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/datapeserta/' . $next ?>">Next</a></li>
                              <?php endif ?>
                            </ul>
                          </nav>
                          <?php endif ?>
                        </div>
                      </div>
                    <?php endif; ?>
                
                </div>
            </div>
        </div>

      </div>
    </section>

</main>