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
        <a class="nav-link " href="<?= BASEURL ?>/admin/datapeserta">
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
      <h1>Data Peserta</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Home</a></li>
          <li class="breadcrumb-item active">Data Peserta</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::tipe(); ?>"></div>
      <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Peserta Magang</h5>
                    <div class="row">
                        <div class="col-sm-4">
                          <form action="<?= BASEURL . '/admin/datapeserta'?>" method="post">
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
                                  <th scope="col" style="width: 2%; text-align:center">#</th>
                                  <th scope="col" style="width: 25%;">Nama</th>
                                  <th scope="col" style="width: 25%;">Instansi</th>
                                  <th scope="col" style="width: 25%;">Divisi Magang</th>
                                  <th scope="col" style="width: 10%; text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $i = 1 + $data['awalData']; ?>
                              <?php foreach($data["peserta"] as $peserta) : ?>
                                <tr>
                                    <th scope="row" style="text-align: center;"><?= $i; ?></th>
                                    <td><?= $peserta['fullname_peserta'] ?></td>
                                    <td><?= $peserta['instansi'] ?></td>
                                    <td><?= $peserta['divisi_magang'] ?></td>
                                    <td style="text-align: center;">
                                        <a href="<?= BASEURL . '/admin/detailpeserta/' . $peserta['id_peserta']?>"><i class="bi bi-info-circle-fill me-1" style="color: blue;" title="Detail"></i></a>
                                        <a href="<?= BASEURL . '/admin/deletepeserta/' . $peserta['id_peserta']?>" class="hapusPeserta"><i class="bi bi-trash-fill" style="color: red;" title="Hapus"></i></a>
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
                                  <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/datapeserta/' . $prev ?>">Previous</a></li>
                              <?php endif ?>

                              <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                                  <?php if($i == $data['hlmAktif']) : ?>
                                      <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                                  <?php else : ?>
                                      <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/datapeserta/' . $i ?>"><?= $i ?></a></li>
                                  <?php endif ?>
                              <?php endfor ?>

                              <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                                  <?php $next = $data['hlmAktif'] + 1; ?>
                                  <li class="page-item"><a class="page-link" href="<?= BASEURL . '/admin/datapeserta/' . $next ?>">Next</a></li>
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