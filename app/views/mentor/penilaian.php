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
        <a class="nav-link" href="<?= BASEURL ?>/mentor/penilaian">
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/mentor">Home</a></li>
          <li class="breadcrumb-item active">Penilaian Akhir Peserta Magang</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::tipe(); ?>"></div>
      <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Penilaian Akhir Peserta Magang</h5>
                    <div class="d-flex mb-2">
                      <div class="col-sm-3">
                        <form action="<?= BASEURL . '/mentor/penilaian'?>" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Cari..." autocomplete="off">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>
                      </div>
                    </div>
                    <table class="table table-bordered table-responsive-sm table-sm">
                        <thead>
                            <tr class="table-secondary">
                                <th scope="col" style="width: 3%; text-align:center; vertical-align:middle">#</th>
                                <th scope="col" style="width: 25%; text-align:center; vertical-align:middle">Nama</th>
                                <th scope="col" style="width: 25%; text-align:center; vertical-align:middle">Instansi</th>
                                <th scope="col" style="width: 25%; text-align:center; vertical-align:middle">Divisi Magang</th>
                                <th scope="col" style="width: 10%; text-align:center; vertical-align:middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + $data['awalData']; ?>
                            <?php foreach($data['penilaian'] as $penilaian) : ?>
                            <tr>
                                <td style="text-align: center;"><?= $i ?></td>
                                <td><?= $penilaian['fullname_peserta'] ?></td>
                                <td><?= $penilaian['instansi'] ?></td>
                                <td><?= $penilaian['divisi_magang'] ?></td>
                                <?php if(!empty($penilaian['username_peserta'])) : ?>
                                <td style="text-align: center;"><a href="<?= BASEURL . '/mentor/detailnilaipeserta/' . $penilaian['id_penilaian'] ?>" class="badge text-bg-info"><i class="bi bi-eye"></i> Lihat</a></td>
                                <?php else : ?>
                                <td style="text-align: center;"><a href="<?= BASEURL . '/mentor/nilaipeserta/' . $penilaian['username'] ?>" class="badge text-bg-warning tombolPenilaian"><i class="bi bi-pencil-square"></i> Beri Nilai</a></td>
                                <?php endif ?>
                            </tr>
                            <?php $i++ ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <?php if(empty($_POST['keyword'])) : ?>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-sm justify-content-center">
                            <?php if($data['hlmAktif'] > 1) : ?>
                                <?php $prev = $data['hlmAktif'] - 1; ?>
                                <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/penilaian/' . $prev ?>">Previous</a></li>
                            <?php endif ?>

                            <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                                <?php if($i == $data['hlmAktif']) : ?>
                                    <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                                <?php else : ?>
                                    <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/penilaian/' . $i ?>"><?= $i ?></a></li>
                                <?php endif ?>
                            <?php endfor ?>

                            <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                                <?php $next = $data['hlmAktif'] + 1; ?>
                                <li class="page-item"><a class="page-link" href="<?= BASEURL . '/mentor/penilaian/' . $next ?>">Next</a></li>
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