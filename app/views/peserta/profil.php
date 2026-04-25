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
        <a class="nav-link collapsed" href="<?= BASEURL ?>/peserta/penilaian">
          <i class="bi bi-pencil-square"></i>
          <span>Nilai Akhir Magang</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= BASEURL ?>/peserta/profil">
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
      <h1>Profil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/peserta">Home</a></li>
          <li class="breadcrumb-item active">Profil</li>
        </ol>
      </nav>
    </div>

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <div style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden;">
                  <img src="<?= BASEURL . '/asset/img/profil/' . $data['user']['image']?>" alt="Profile" style="width: 100%; height: 100%; object-fit: cover; object-position: center 20%">
                </div>
                <h2><?= $data['user']['fullname_peserta'] ?></h2>
                <h3>Peserta Magang Diskominfo Medan</h3>
              </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                        </li>
                        
                        <li class="nav-item">
                          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                        </li>
        
                        <li class="nav-item">
                          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                        </li>
                    </ul>

                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Detail Profil</h5>
        
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                <div class="col-lg-9 col-md-8"><?= $data['user']['fullname_peserta'] ?></div>
                            </div>
            
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tempat Lahir</div>
                                <div class="col-lg-9 col-md-8"><?= (empty($data['profil'])) ? "<i>Belum diisi</i>" : $data['profil']['tempat_lahir']  ?></div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tanggal Lahir</div>
                                <div class="col-lg-9 col-md-8"><?= (empty($data['profil'])) ? "<i>Belum diisi</i>" : date("d F Y", $data['profil']['tanggal_lahir'])  ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                <div class="col-lg-9 col-md-8"><?= (empty($data['profil'])) ? "<i>Belum diisi</i>" : $data['profil']['jenis_kelamin']  ?></div>
                            </div>
            
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">No. Handphone</div>
                                <div class="col-lg-9 col-md-8"><?= (empty($data['profil'])) ? "<i>Belum diisi</i>" : $data['profil']['noHP']  ?></div>
                            </div>
            
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8"><?= $data['user']['email'] ?></div>
                            </div>
            
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Alamat</div>
                                <div class="col-lg-9 col-md-8"><?= (empty($data['profil'])) ? "<i>Belum diisi</i>" : $data['profil']['alamat']  ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Instansi</div>
                                <div class="col-lg-9 col-md-8"><?= $data['user']['instansi'] ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jurusan</div>
                                <div class="col-lg-9 col-md-8"><?= (empty($data['profil'])) ? "<i>Belum diisi</i>" : $data['profil']['jurusan']  ?></div>
                            </div>

                            <h5 class="card-title">Informasi Magang</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Mentor Magang</div>
                                <div class="col-lg-9 col-md-8"><?= (empty($data['mentor'])) ? "-" : $data['mentor']['fullname'] ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Divisi Magang</div>
                                <div class="col-lg-9 col-md-8"><?= $data['user']['divisi_magang'] ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Date Created</div>
                                <div class="col-lg-9 col-md-8"><?= date("d F Y, h:i:s A", $data['user']['date_created']) ?></div>
                            </div>
                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                          <form action="<?= BASEURL ?>/peserta/profil" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                            <div class="row mb-3">
                              <label class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                              <div class="col-md-8 col-lg-9">
                                <img src="<?= BASEURL . '/asset/img/profil/' . $data['user']['image'] ?>" alt="Profile">
                                <div class="pt-2">
                                  <input type="file" class="form-control-file" name="gambar"><br>
                                  <small><i>(Maks 1 Mb dengan ekstensi JPG, JPEG atau PNG)</i></small>
                                </div>
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="fullname" type="text" class="form-control" id="fullName" value="<?= $data['user']['fullname_peserta'] ?>" required>
                                <div class="invalid-feedback">Please enter your fullname!</div>
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="tempatlahir" class="col-md-4 col-lg-3 col-form-label">Tempat Lahir</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="tempatlahir" type="text" class="form-control" id="tempatlahir" value="<?= (empty($data['profil'])) ? "" : $data['profil']['tempat_lahir']  ?>" required>
                                <div class="invalid-feedback">Please enter your Tempat Lahir!</div>
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="tanggallahir" class="col-md-4 col-lg-3 col-form-label">Tanggal Lahir</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="tanggallahir" type="date" class="form-control" id="tanggallahir" value="<?= (empty($data['profil'])) ? "" : date("Y-m-d", $data['profil']['tanggal_lahir'])  ?>" required>
                                <div class="invalid-feedback">Please enter your Tanggal Lahir!</div>
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="jeniskelamin" class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                              <div class="col-md-8 col-lg-9">
                                <select name="jeniskelamin" id="jeniskelamin" class="form-select" required>
                                    <?php if(empty($data['profil'])) : ?>
                                      <option disabled selected value></option>
                                      <option value="Laki-Laki">Laki-Laki</option>
                                      <option value="Perempuan">Perempuan</option>
                                    <?php elseif($data['profil']['jenis_kelamin'] === "Laki-Laki") : ?>
                                      <option selected value="Laki-Laki">Laki-Laki</option>
                                      <option value="Perempuan">Perempuan</option>
                                    <?php else : ?>
                                      <option value="Laki-Laki">Laki-Laki</option>
                                      <option selected value="Perempuan">Perempuan</option>
                                    <?php endif ?>
                                </select>
                                <div class="invalid-feedback">Please enter your Jenis kelamin!</div>
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="Phone" class="col-md-4 col-lg-3 col-form-label">No. Handphone</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="phone" type="number" class="form-control" id="Phone" value="<?= (empty($data['profil'])) ? "" : $data['profil']['noHP']  ?>" required>
                                <div class="invalid-feedback">Please enter your No. Handphone!</div>
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="email" type="email" class="form-control" id="Email" value="<?= $data['user']['email'] ?>" required>
                                <div class="invalid-feedback">Please enter your email!</div>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="Alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="alamat" type="text" class="form-control" id="Alamat" value="<?= (empty($data['profil'])) ? "" : $data['profil']['alamat']  ?>" required>
                                <div class="invalid-feedback">Please enter your alamat!</div>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="Instansi" class="col-md-4 col-lg-3 col-form-label">Instansi</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="instansi" type="text" class="form-control" id="Instansi" value="<?= $data['user']['instansi'] ?>" required>
                                <div class="invalid-feedback">Please enter your instansi!</div>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="Jurusan" class="col-md-4 col-lg-3 col-form-label">Jurusan</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="jurusan" type="text" class="form-control" id="Jurusan" value="<?= (empty($data['profil'])) ? "" : $data['profil']['jurusan']  ?>" required>
                                <div class="invalid-feedback">Please enter your jurusan!</div>
                              </div>
                            </div>
        
                            <button type="submit" name="ubahdatadiri" class="btn btn-primary">Save Changes</button>
                          </form>
                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                          <form action="<?= BASEURL ?>/peserta/profil" method="post" class="needs-validation" novalidate>
                            <div class="row mb-3">
                              <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Saat Ini</label>
                              <div class="col-md-8 col-lg-9 position-relative">
                                <input name="currentpassword" type="password" class="form-control" id="currentPassword" required>
                                <div class="invalid-feedback">Please enter your password saat ini</div>
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                              <div class="col-md-8 col-lg-9 position-relative">
                                <input name="newpassword" type="password" class="form-control" id="newPassword" required>
                                <div class="invalid-feedback">Please enter your password baru</div>
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Ulangi Password Baru</label>
                              <div class="col-md-8 col-lg-9 position-relative">
                                <input name="renewpassword" type="password" class="form-control" id="renewPassword" required>
                                <div class="invalid-feedback">Please enter your ulangi password baru</div>
                              </div>
                            </div>
        
                            <button type="submit" name="changePassword" class="btn btn-primary">Change Password</button>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>

</main>