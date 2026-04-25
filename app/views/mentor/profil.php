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
        <a class="nav-link" href="<?= BASEURL ?>/mentor/profil">
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
          <li class="breadcrumb-item"><a href="<?= BASEURL ?>/mentor">Home</a></li>
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
                <h2><?= $data['user']['fullname'] ?></h2>
                <h3>Mentor Magang Diskominfo Medan</h3>
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
                                <div class="col-lg-9 col-md-8"><?= $data['user']['fullname'] ?></div>
                            </div>
            
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Divisi</div>
                                <div class="col-lg-9 col-md-8"><?= ($data['user']['divisi'] === null) ? "<i>Belum diisi</i>" : $data['user']['divisi']  ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jabatan</div>
                                <div class="col-lg-9 col-md-8"><?= ($data['user']['jabatan'] === null) ? "<i>Belum diisi</i>" : $data['user']['jabatan']  ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">No. Handphone</div>
                                <div class="col-lg-9 col-md-8"><?= ($data['user']['noHP'] === null) ? "<i>Belum diisi</i>" : $data['user']['noHP']  ?></div>
                            </div>
            
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8"><?= ($data['user']['email'] === null) ? "<i>Belum diisi</i>" : $data['user']['email'] ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Peserta Magang</div>
                                <div class="col-lg-9 col-md-8"><?= (empty($data['totalpeserta']['total_peserta'])) ? "0 Peserta" : $data['totalpeserta']['total_peserta'] . " Peserta" ?></div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Date Created</div>
                                <div class="col-lg-9 col-md-8"><?= date("d F Y, H:i:s", $data['user']['date_created']) ?></div>
                            </div>

                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                          <form action="<?= BASEURL ?>/mentor/profil" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
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
                                <input name="fullname" type="text" class="form-control" id="fullName" value="<?= $data['user']['fullname'] ?>" required>
                                <div class="invalid-feedback">Please enter your fullname!</div>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <?php
                                $divisi_list = [
                                    "Teknologi Informatika",
                                    "Aplikasi Informatika",
                                    "Komunikasi Publik",
                                    "Persandian",
                                    "Statistika dan Informasi Publik",
                                    "Sekretariat"
                                ];

                                $selected_divisi = $data['user']['divisi'] ?? null;
                              ?>
                              <label for="divisi" class="col-md-4 col-lg-3 col-form-label">Divisi</label>
                              <div class="col-md-8 col-lg-9">
                                <select name="divisi" id="divisi" class="form-select" required>
                                    <option disabled <?= is_null($selected_divisi) ? 'selected' : '' ?>></option>
                                    <?php foreach ($divisi_list as $divisi): ?>
                                        <option value="<?= $divisi ?>" <?= $divisi === $selected_divisi ? 'selected' : '' ?>>
                                            <?= $divisi ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">Please enter your divisi!</div>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="jabatan" class="col-md-4 col-lg-3 col-form-label">Jabatan</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="jabatan" type="text" class="form-control" id="jabatan" value="<?= ($data['user']['jabatan'] === null) ? "" : $data['user']['jabatan']  ?>" required>
                                <div class="invalid-feedback">Please enter your jabatan!</div>
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="Phone" class="col-md-4 col-lg-3 col-form-label">No. Handphone</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="phone" type="number" class="form-control" id="Phone" value="<?= ($data['user']['noHP'] === null) ? "" : $data['user']['noHP']  ?>" required>
                                <div class="invalid-feedback">Please enter your No. Handphone!</div>
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="email" type="email" class="form-control" id="Email" value="<?= ($data['user']['email'] === null) ? "" : $data['user']['email'] ?>" required>
                                <div class="invalid-feedback">Please enter your email!</div>
                              </div>
                            </div>

        
                            <button type="submit" name="ubahdatadiri" class="btn btn-primary">Save Changes</button>
                          </form>
                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                          <form action="<?= BASEURL ?>/mentor/profil" method="post" class="needs-validation" novalidate>
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