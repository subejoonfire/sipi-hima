<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Pengguna</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <button type="button" class="btn btn-primary mt-3 mb-2" data-bs-toggle="modal" data-bs-target="#verticalycentered">
              Tambah Pengguna
            </button>

            <!-- Flash Data -->
            <?php if (session()->getFlashdata('success')) : ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <!-- Modal Tambah -->
            <div class="modal fade" id="verticalycentered" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengguna</h5>
                  </div>
                  <div class="modal-body">
                    <form action="/pengguna/tambah" method="post" enctype="multipart/form-data" class="row g-3">
                      <?= csrf_field() ?>
                      <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <input name="username" type="text" class="form-control" id="username" required>
                      </div>
                      <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="password" required>
                      </div>
                      <div class="col-12">
                        <label for="nama" class="form-label">Nama</label>
                        <input name="nama" type="text" class="form-control" id="nama" required>
                      </div>
                      <div class="col-12">
                        <label for="level" class="form-label">Level</label>
                        <select id="level" class="form-select" required name="level">
                          <option selected>Pilih...</option>
                          <option>admin</option>
                          <option>petugas</option>
                        </select>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                      </div>

                  </div>
                </div>
              </div>
              </form><!-- Vertical Form -->
            </div><!-- End Vertically centered Modal-->


            <!-- Table with stripped rows -->
            <table class="table datatable text-center">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Username</th>
                  <th class="text-center">Password</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Level</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php $no = 1;
                  foreach ($Pengguna as $usr) : ?>
                    <td><?= $no++; ?></td>
                    <td><?= $usr['username']; ?></td>
                    <td><?= $usr['password']; ?></td>
                    <td><?= $usr['nama']; ?></td>
                    <td><?= $usr['level']; ?></td>
                    <td>

                      <!-- Button edit barang -->
                      <button type="button" class="btn btn-warning btn" data-bs-toggle="modal" data-bs-target="#edit<?= $usr['iduser'] ?>">
                        <i class="ri-edit-box-line"></i></button>
                      <!-- Button hapus barang -->
                      <button type="button" class="btn btn-danger btn" data-bs-toggle="modal" data-bs-target="#hapus<?= $usr['iduser']; ?>">
                        <i class="ri-delete-bin-2-line"></i></button>

                      <!-- Delete Confirmation Modal -->
                      <div class="modal fade" id="hapus<?= $usr['iduser']; ?>" tabindex="-1" data-bs-backdrop="false">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title"><i class="ri-alert-line"></i> Peringatan</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">Apakah Anda Yakin Ingin Menghapus Pengguna <b><?= $usr['nama'] ?></b> dapat menghilangkan data Pengguna </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                              <form action="/pengguna/hapus/<?= $usr['iduser'] ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div><!-- End Basic Modal-->

                    </td>
                </tr>

              <?php endforeach; ?>
              </tbody>
            </table>

            <!-- Modal edit -->
            <?php foreach ($Pengguna as $usr) : ?>
              <div class="modal fade" id="edit<?= $usr['iduser'] ?>" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit Pengguna</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="/pengguna/edit<?= $usr['iduser'] ?>" method="post" class="row g-3" id="form-edit-<?= $usr['iduser'] ?>">
                        <div class="col-12">
                          <label for="username" class="form-label">Username</label>
                          <input name="username" type="text" class="form-control" id="username" value="<?= $usr['username'] ?>" required>
                        </div>
                        <div class="col-12">
                          <label for="password" class="form-label">Password</label>
                          <input name="password" type="password" class="form-control" id="password" value="<?= $usr['password'] ?>" required>
                        </div>
                        <div class="col-12">
                          <label for="nama" class="form-label">Nama</label>
                          <input name="nama" type="text" class="form-control" id="nama" value="<?= $usr['nama'] ?>" required>
                        </div>
                        <div class="col-12">
                          <label for="level" class="form-label">Level</label>
                          <select id="level" class="form-select" required name="level">
                            <option value="<?= $usr['level'] ?>" selected><?= $usr['level'] ?></option>
                            <option>admin</option>
                            <option>petugas</option>
                          </select>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                          <button type="submit" class="btn btn-primary">Tambah</button>
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <!-- penutup nya -->
        <?php endforeach; ?><!-- End Basic Modal-->
        <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
    </div>
  </section>

</main><!-- End #main -->