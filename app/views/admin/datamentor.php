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
      <h1>Data Mentor</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Home</a></li>
          <li class="breadcrumb-item active">Data Mentor</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::tipe(); ?>"></div>
      <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Data Mentor Magang</h5>
                    <div class="row">
                        <div class="col-sm-8">
                          <a href="<?= BASEURL ?>/admin/addnewmentor" class="btn btn-primary mt-1"><i class="bi bi-plus-lg"></i> Add Mentor</a>
                        </div>
                        <div class="col-sm-4 mt-1">
                          <form action="<?= BASEURL . '/admin/datamentor'?>" method="post">
                            <div class="input-group">
                              <input type="text" class="form-control" name="keyword" placeholder="Cari mentor..." autocomplete="off">
                              <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                          </form>
                        </div>
                    </div>


                    <?php if(!empty($data["mentor"])) : ?>
                      <div class="row mt-4">
                        <div class="col-sm-12">
                          <table class="table table-bordered table-responsive-sm table-sm">
                            <thead>
                                <tr class="table-secondary">
                                  <th scope="col" style="width: 2%;">#</th>
                                  <th scope="col" style="width: 30%;">Nama</th>
                                  <th scope="col" style="width: 25%;">Username</th>
                                  <th scope="col" style="width: 10%; text-align:center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $i = 1 + $data['awalData']; ?>
                              <?php foreach($data["mentor"] as $mentor) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $mentor['fullname'] ?></td>
                                    <td><?= $mentor['username'] ?></td>
                                    <td style="text-align: center;">
                                        <a href="<?= BASEURL . '/admin/detailmentor/' . $mentor['id_mentor']?>"><i class="bi bi-info-circle-fill me-1" style="color: blue;" title="Detail"></i></a>
                                        <a href="<?= BASEURL . '/admin/editmentor/' . $mentor['id_mentor']?>"><i class="bi bi-pencil-fill me-1" style="color:rgb(254, 169, 0);" title="Edit"></i></a>
                                        <a href="<?= BASEURL . '/admin/deletementor/' . $mentor['id_mentor']?>" class="hapusMentor"><i class="bi bi-trash-fill" style="color: red;" title="Hapus"></i></a>
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
                                  <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/datamentor/' . $prev ?>">Previous</a></li>
                              <?php endif ?>

                              <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                                  <?php if($i == $data['hlmAktif']) : ?>
                                      <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                                  <?php else : ?>
                                      <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/datamentor/' . $i ?>"><?= $i ?></a></li>
                                  <?php endif ?>
                              <?php endfor ?>

                              <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                                  <?php $next = $data['hlmAktif'] + 1; ?>
                                  <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/datamentor/' . $next ?>">Next</a></li>
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