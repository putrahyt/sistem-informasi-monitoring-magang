<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                
            <div class="card mb-3">
                
                <div class="card-body">
                    
                  <div class="pt-3 pb-3">
                    <h5 class="card-title text-center pb-0 fs-4">Ubah Password Peserta</h5>
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <?php Flasher::flashLogin(); ?>
                    </div>
                  </div>

                  <form class="row g-3 needs-validation" method="post" action="<?= BASEURL .'/verifikasi/verifikasipeserta/' . $data['token'] ?>" novalidate>

                    <div class="col-12">
                      <label for="password1" class="form-label">Password</label>
                      <input type="password" name="password1" class="form-control" id="password1" required>
                      <div class="invalid-feedback">Please enter your password.</div>
                    </div>

                    <div class="col-12">
                      <label for="password2" class="form-label">Konfirmasi Password</label>
                      <input type="password" name="password2" class="form-control" id="password2" required>
                      <div class="invalid-feedback">Please enter your confirm password.</div>
                    </div>
                   
                    <div class="col-12 mt-4 mx-auto">
                        <button class="btn btn-primary w-100" type="submit" name="resetpass">Kirim</button>
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