<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                
            <div class="card mb-3">
                
                <div class="card-body">
                    
                  <div class="pt-3 pb-3">
                    <h5 class="card-title text-center pb-0 fs-4">Registrasi Peserta</h5>
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <?php Flasher::flashLogin(); ?>
                    </div>
                  </div>

                  <form class="row g-3 needs-validation" method="post" action="<?= BASEURL ?>/login/registrasipeserta" novalidate>

                    <div class="col-12">
                        <label for="fullname" class="form-label">Nama lengkap</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" required>
                        <div class="invalid-feedback">Please enter your fullname!</div>
                    </div>

                    <div class="col-12">
                        <label for="instansi" class="form-label">Instansi</label>
                        <input type="text" name="instansi" class="form-control" id="instansi" required>
                        <div class="invalid-feedback">Please enter your instansi!</div>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                        <div class="invalid-feedback">Please enter a valid Email address!</div>
                    </div>
                    
                    <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" required>
                        <div class="invalid-feedback">Please enter a username!</div>
                    </div>
                    
                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                        <label for="mentormagang" class="form-label">Mentor Magang</label>
                        <select class="form-select" name="mentormagang" id="mentormagang" required>
                            <option disabled selected value></option>
                            <?php foreach($data['mentor'] as $mentor) : ?>
                              <option value="<?= $mentor['username'] ?>"><?= $mentor['fullname'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">Please choose a mentor magang!</div>
                    </div>

                    <div class="col-12">
                        <label for="divisimagang" class="form-label">Divisi Magang</label>
                        <select class="form-select" name="divisimagang" id="divisimagang" required>
                            <option disabled selected value></option>
                            <option value="Aplikasi Informatika">Aplikasi Informatika</option>
                            <option value="Teknologi Informatika">Teknologi Informatika</option>
                            <option value="Komunikasi Publik">Komunikasi Publik</option>
                            <option value="Persandian">Persandian</option>
                            <option value="Statistika dan Informasi Publik">Statistika dan Informasi Publik</option>
                            <option value="Sekretariat">Sekretariat</option>
                        </select>
                        <div class="invalid-feedback">Please choose a divisi magang!</div>
                    </div>

                    <div class="col-12 mt-4 mb-2 mx-auto">
                        <button class="btn btn-primary w-100" type="submit" name="registrasi">Registrasi</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0 text-center">Sudah Punya Akun? <a href="<?= BASEURL ?>/login">Log In</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>