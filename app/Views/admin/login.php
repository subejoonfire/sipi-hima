  <body>
    <main>
      <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                <!-- End Logo -->

                <div class="card mb-3">
                  <div class="card-body">
                    <div class="text-center pt-4 pb-2">
                      <img src="assets/img/hima.svg" alt="" style="height: 200px;" />
                      <div class="d-flex justify-content-center py-4">
                        <a href="index.html" class="logo d-flex align-items-center w-auto">
                          <span class="d-none d-lg-block">Inventaris HIMA-TI</span>
                        </a>
                      </div>
                    </div>

                    <!-- Flash Data -->
                    <?php if (session()->getFlashdata('success')) : ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('gagal')) : ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('gagal') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php endif; ?>

                    <form class="row g-3" action="<?= base_url('/login') ?>" method="post">
                      <div class="col-12">
                        <label for="Username" class="form-label">Username</label>
                        <div class="input-group has-validation">
                          <input type="text" name="username" class="form-control" id="Username" />
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="Password" />
                      </div>

                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">
                          Login
                        </button>
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
    <!-- End #main -->