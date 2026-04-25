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
        <a class="nav-link" href="<?= BASEURL ?>/peserta/bimbingan">
          <i class="bi bi-chat-left-dots"></i>
          <span>Bimbingan Magang</span>
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

    <div class="flash-data" data-pesandata="<?= Flasher::pesan(); ?>" data-tipedata="<?= Flasher::tipe(); ?>"></div>
    <div class="pagetitle">
      <h1>Bimbingan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/peserta">Home</a></li>
          <li class="breadcrumb-item active">Bimbingan Magang</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">History Bimbingan Magang (Mentor : <?= $data['user']['fullname'] ?>)</h5>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPesan"><i class="bi bi-plus-lg"></i> Buat Baru</a>
                    <?php if(!empty($data['bimbingan'])) : ?>
                    <table class="table table-bordered table-responsive-sm table-sm mt-3">
                      <thead>
                        <tr class="table-secondary">
                          <th scope="col" style="width: 3%; text-align:center; vertical-align:middle">#</th>
                          <th scope="col" style="width: 35%; vertical-align:middle">Pesan</th>
                          <th scope="col" style="width: 35%; vertical-align:middle">Tanggapan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1 + $data['awalData']; ?>
                        <?php foreach($data["bimbingan"] as $bimbingan) : ?>
                          <tr>
                            <td style="text-align: center;"><?= $i ?></td>
                            <td>
                              <b><?= $bimbingan['pesan'] ?></b>
                              <div style="font-size: 11px;">(<?= $bimbingan['nama_pengirim'] ?>, <?= date('d M Y H:i:s', $bimbingan['date_created_pesan']) ?>)</div>
                            </td>
                            <?php if(($bimbingan['tanggapan'] === null) && ($bimbingan['nama_penerima'] === $data['user']['fullname_peserta'])) : ?>
                              <td style="text-align: center;">
                                <!-- edit tanggapan -->
                                <span class="badge text-bg-primary btnTanggapan" type="button" title="Beri tanggapan" data-bs-toggle="modal" data-bs-target="#addTanggapan" data-id="<?= $bimbingan['id_bimbingan'] ?>"><i class="bi bi-pencil-fill"></i></span>
                              </td>
                            <?php elseif(!empty($bimbingan['tanggapan'])) : ?>
                              <td>
                                <b><?= $bimbingan['tanggapan'] ?></b>
                                <div style="font-size: 11px;">(<?= $bimbingan['nama_penerima'] ?>, <?= date('d M Y H:i:s', $bimbingan['date_created_tanggapan']) ?>)</div>
                              </td>
                            <?php else : ?>
                              <td style="text-align: center;"><i>Belum ada tanggapan</i></td>
                            <?php endif ?>
                          </tr>
                        <?php $i++ ?>
                        <?php endforeach ?>
                       <?php endif ?>
                    </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                      <ul class="pagination pagination-sm justify-content-center">
                        <?php if($data['hlmAktif'] > 1) : ?>
                            <?php $prev = $data['hlmAktif'] - 1; ?>
                            <li class="page-item"><a class="page-link" href="<?= BASEURL . '/peserta/bimbingan/' . $prev ?>">Previous</a></li>
                        <?php endif ?>

                        <?php for($i = 1; $i <= $data['jmlHalaman']; $i++) : ?>
                            <?php if($i == $data['hlmAktif']) : ?>
                                <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                            <?php else : ?>
                                <li class="page-item"><a class="page-link" href="<?= BASEURL . '/peserta/bimbingan/' . $i ?>"><?= $i ?></a></li>
                            <?php endif ?>
                        <?php endfor ?>

                        <?php if($data['hlmAktif'] < $data['jmlHalaman']) : ?>
                            <?php $next = $data['hlmAktif'] + 1; ?>
                            <li class="page-item"><a class="page-link" href="<?= BASEURL . '/peserta/bimbingan/' . $next ?>">Next</a></li>
                        <?php endif ?>
                      </ul>
                    </nav>
                </div>
            </div>
        </div>
      </div>
    </section>

</main>

<!-- Add Pesan -->
<div class="modal fade" id="addPesan" tabindex="-1" aria-labelledby="pesan" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="pesan">Pesan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL ?>/peserta/bimbingan" method="post" class="needs-validation" novalidate>
          <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" name="pesanBimbingan" id="floatingTextarea" required></textarea>
            <label for="floatingTextarea">Masukkan Pesan</label>
            <div class="invalid-feedback">Please enter your pesan!</div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="pesan" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Add Tanggapan -->
<div class="modal fade" id="addTanggapan" tabindex="-1" aria-labelledby="tanggapan" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tanggapan">Tanggapan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL ?>/peserta/bimbingan" method="post" class="needs-validation" novalidate>
          <input type="hidden" name="id_bimbingan" id="id_bimbingan">
          <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" name="pesanTanggapan" id="floatingTextarea" required></textarea>
            <label for="floatingTextarea">Masukkan Tanggapan</label>
            <div class="invalid-feedback">Please enter your tanggapan!</div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="tanggapan" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>