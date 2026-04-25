<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/admin">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= BASEURL ?>/admin/datamentor">
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
      <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::tipe(); ?>"></div>
      <h1>Data Mentor</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin/datamentor">Data Mentor</a></li>
          <li class="breadcrumb-item active">Detail Mentor</li>
        </ol>
      </nav>
    </div>

    <section class="section profile">
        <div class="row">

            <div class="col-xl-4">
                <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <div style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden;">
                    <img src="<?= BASEURL . '/asset/img/profil/' . $data['mentor']['image']?>" alt="Profile" style="width: 100%; height: 100%; object-fit: cover; object-position: center 20%">
                    </div>
                    <h2><?= $data['mentor']['fullname'] ?></h2>
                    <h3>Mentor Magang Diskominfo</h3>
                </div>
                </div>
            </div>

            <div class="col-xl-8">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Detail Data Mentor</h5>

                  <div class="row mb-3">
                      <label for="fullname" class="col-form-label fw-bold">Nama Lengkap</label>
                      <div class="col-sm-12">
                          <input type="text" id="fullname" class="form-control" value="<?= $data['mentor']['fullname'] ?>" readonly disabled>
                      </div>
                  </div>

                  <div class="row mb-3">
                      <label for="username" class="col-form-label fw-bold">Username</label>
                      <div class="col-sm-12">
                          <input type="text" id="username" class="form-control" value="<?= $data['mentor']['username'] ?>" readonly disabled>
                      </div>
                  </div>

                  <div class="row mb-3">
                      <label for="username" class="col-form-label fw-bold">Peserta Magang</label>
                      <div class="col-sm-12">
                          <input type="text" id="username" class="form-control" value="<?= (empty($data['totalpeserta']['total_peserta'])) ? "0 Peserta" : $data['totalpeserta']['total_peserta'] . " Peserta" ?>" readonly disabled>
                      </div>
                  </div>

                  <div class="row mb-3">
                      <label for="username" class="col-form-label fw-bold">Date Created</label>
                      <div class="col-sm-12">
                          <input type="text" id="username" class="form-control" value="<?= date('d F Y, H:i:s', $data['mentor']['date_created']) ?>" readonly disabled>
                      </div>
                  </div>
                  
                  <h5 class="card-title">Peserta Magang</h5>
                  <div class="row">
                    <div class="col-sm-4">
                      <form action="<?= BASEURL . '/admin/detailmentor/'. $data['id']?>" method="post">
                        <div class="input-group">
                          <input type="text" class="form-control" name="keyword" placeholder="Cari peserta..." autocomplete="off">
                          <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  
                  <div class="row mt-3">
                    <div class="col-sm-12">
                      <table class="table table-bordered table-responsive-sm table-sm">
                        <thead>
                          <tr class="table-secondary">
                            <th scope="col" style="width: 2%;">#</th>
                            <th scope="col" style="width: 25%;">Nama</th>
                            <th scope="col" style="width: 30%;">Instansi</th>
                            <th scope="col" style="width: 10%; text-align:center">Aksi</th>
                          </tr>
                        </thead>
                        <?php if(!empty($data['peserta'])) : ?>
                        <tbody>
                          <?php $i = 1 + $data['awalData']; ?>
                          <?php foreach($data["peserta"] as $peserta) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $peserta['fullname_peserta'] ?></td>
                                <td><?= $peserta['instansi'] ?></td>
                                <td style="text-align: center;">
                                    <a href="<?= BASEURL . '/admin/detailpeserta/' . $peserta['id_peserta']?>"><i class="bi bi-info-circle-fill me-1" style="color: blue;" title="Detail"></i></a>
                                </td>
                            </tr>
                          <?php $i++; ?>
                          <?php endforeach ?>
                        </tbody>
                        <?php endif ?>
                      </table>
                      <?php if(empty($_POST['keyword'])) : ?>
                        <nav aria-label="Page navigation example">
                          <ul class="pagination pagination-sm justify-content-center">
                            <?php if($data['hlmAktif'] > 1) : ?>
                                <?php $prev = $data['hlmAktif'] - 1; ?>
                                <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/detailmentor/' . $data['id'] . '/' . $prev ?>">Previous</a></li>
                            <?php endif ?>

                            <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                                <?php if($i == $data['hlmAktif']) : ?>
                                    <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                                <?php else : ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/detailmentor/' . $data['id'] . '/'  . $i ?>"><?= $i ?></a></li>
                                <?php endif ?>
                            <?php endfor ?>

                            <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                                <?php $next = $data['hlmAktif'] + 1; ?>
                                <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/detailmentor/' . $data['id'] . '/'  . $next ?>">Next</a></li>
                            <?php endif ?>
                          </ul>
                        </nav>
                      <?php endif ?>
                    </div>
                  </div>
                  
                  <div class="row">
                      <div class="col-sm-5">
                          <a href="<?= BASEURL . '/admin/datamentor/' ?>" class="btn btn-danger mt-2">Kembali</a>
                      </div>
                  </div>
                </div>
              </div>
            </div>

        </div>
    </section>

</main>