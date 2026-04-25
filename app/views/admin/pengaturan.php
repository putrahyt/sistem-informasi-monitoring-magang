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
        <a class="nav-link collapsed" href="<?= BASEURL ?>/admin/laporan">
          <i class="bi bi-file-earmark-text"></i>
          <span>Laporan Aktivitas & Absensi</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= BASEURL ?>/admin/pengaturan">
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
      <h1>Pengaturan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/admin">Home</a></li>
          <li class="breadcrumb-item active">Pengaturan</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4">Ubah Password Admin</h5>
              <form class="row g-3 needs-validation" method="post" action="<?= BASEURL . '/admin/pengaturan/' ?>" novalidate>
                <div class="row mb-3">
                    <label for="currentpassword" class="col-form-label col-sm-5">Password Saat Ini</label>
                    <div class="col-sm-7">
                        <input type="password" name="currentpassword" id="currentpassword" class="form-control" autocomplete="off" required>
                        <div class="invalid-feedback">Please enter your current password!</div>
                    </div>
                </div>
                
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
                        <button type="submit" class="btn btn-primary" name="ubahpasswordadmin">Ubah Password</button>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4">Ubah Koordinat Absensi</h5>
              <form class="row g-3 needs-validation" method="post" action="<?= BASEURL . '/admin/pengaturan/' ?>" novalidate>
                <div class="row mb-3">
                    <label for="latitude" class="col-form-label col-sm-5">Latitude</label>
                    <div class="col-sm-7">
                        <input type="text" name="latitude" id="latitude" class="form-control" value="<?= $data['koordinat']['latitude'] ?>" autocomplete="off" required>
                        <div class="invalid-feedback">Please enter your latitude!</div>
                      </div>
                </div>
                
                <div class="row mb-3">
                    <label for="longitude" class="col-form-label col-sm-5">Longitude</label>
                    <div class="col-sm-7">
                        <input type="text" name="longitude" id="longitude" class="form-control" value="<?= $data['koordinat']['longitude'] ?>" autocomplete="off" required>
                        <div class="invalid-feedback">Please enter your longitude!</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="jarak" class="col-form-label col-sm-5">Jarak (meter)</label>
                    <div class="col-sm-7">
                        <input type="text" name="jarak" id="jarak" class="form-control" value="<?= $data['koordinat']['jarak'] ?>" autocomplete="off" required>
                        <div class="invalid-feedback">Please enter your jarak!</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-primary" name="ubahkoordinat">Ubah</button>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4">Ubah Email / Username</h5>

              <form class="row g-3 needs-validation" method="post" action="<?= BASEURL . '/admin/pengaturan/'?>" novalidate>
                <div class="row mb-3">
                    <label for="username" class="col-form-label col-sm-4">Username</label>
                    <div class="col-sm-8">
                        <input type="text" name="username" id="username" class="form-control" value="<?= $data['user']['username'] ?>" autocomplete="off" required>
                        <div class="invalid-feedback">Please enter your username!</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-form-label col-sm-4">Email</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" id="email" class="form-control" value="<?= $data['user']['email'] ?>" autocomplete="off" required>
                        <div class="invalid-feedback">Please enter your email!</div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-primary" name="editadmin">Ubah</button>
                    </div>
                </div>
              </form>

            </div>
          </div>
        </div>
        
      </div>
    </section>

</main>