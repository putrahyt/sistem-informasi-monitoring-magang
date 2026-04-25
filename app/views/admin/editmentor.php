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
          <li class="breadcrumb-item active">Edit Mentor</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4">Edit Mentor</h5>

              <form class="row g-3 needs-validation" method="post" action="<?= BASEURL . '/admin/editmentor/' . $data['mentor']['id_mentor'] ?>" novalidate>
                <input type="hidden" name="id_mentor" value="<?= $data['mentor']['id_mentor'] ?>">
                <div class="row mb-3">
                    <label for="fullname" class="col-form-label col-sm-4">Nama Lengkap</label>
                    <div class="col-sm-8">
                        <input type="text" name="fullname" id="fullname" class="form-control" value="<?= $data['mentor']['fullname'] ?>" autocomplete="off" required>
                        <div class="invalid-feedback">Please enter your fullname!</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="username" class="col-form-label col-sm-4">Username</label>
                    <div class="col-sm-8">
                        <input type="text" name="username" id="username" class="form-control" value="<?= $data['mentor']['username'] ?>" autocomplete="off" required>
                        <div class="invalid-feedback">Please enter your username!</div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-5">
                        <a href="<?= BASEURL . '/admin/datamentor/' ?>" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary" name="editmentor">Ubah</button>
                    </div>
                </div>
              </form>

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4">Ubah Password</h5>
              <form class="row g-3 needs-validation" method="post" action="<?= BASEURL . '/admin/editmentor/' . $data['mentor']['id_mentor'] ?>" novalidate>
                <input type="hidden" name="id_mentor" value="<?= $data['mentor']['id_mentor'] ?>">
                <div class="row mb-3">
                    <label for="password1" class="col-form-label col-sm-5">New Password</label>
                    <div class="col-sm-7">
                        <input type="password" name="password1" id="password1" class="form-control" autocomplete="off" required>
                        <div class="invalid-feedback">Please enter your new password!</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password2" class="col-form-label col-sm-5">Re-enter New Password</label>
                    <div class="col-sm-7">
                        <input type="password" name="password2" id="password2" class="form-control" autocomplete="off" required>
                        <div class="invalid-feedback">Please re-enter your new password!</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-primary" name="ubahpasswordmentor">Change Password</button>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </section>

</main>