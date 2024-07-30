<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Barang</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-header">

            <!-- Tambah Barang -->
            <div class="col-12 mb-3">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="ri-folder-add-line"></i>Tambah Barang</button>

              <?php if ($level_user == 'admin') : ?>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalCetakPDF"><i class="ri-file-pdf-2-line"></i>Cetak PDF</button>
              <?php endif; ?>

              <!-- Modal Cetak PDF -->
              <div class="modal fade" id="modalCetakPDF" tabindex="-1" aria-labelledby="modalCetakPDFLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalCetakPDFLabel">Cetak Laporan Barang</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="/barang/generatepdf" method="get" target="_blank">
                        <div class="mb-3">
                          <label for="kategori" class="form-label">Kategori</label>
                          <select class="form-select" id="kategori" name="kategori">
                            <option value="">Semua Kategori</option>
                            <?php foreach ($kategori as $k) : ?>
                              <option value="<?= $k['idkategori'] ?>"><?= $k['nama_kategori'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="start_date" class="form-label">Tanggal Awal</label>
                          <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="mb-3">
                          <label for="end_date" class="form-label">Tanggal Akhir</label>
                          <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-success">Cetak PDF</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>

            </div>

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
            <div class="modal fade" id="basicModal" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Form Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <!-- Form -->
                    <form action="/barang/tambah" method="post" enctype="multipart/form-data" class="row g-3">
                      <?= csrf_field() ?>
                      <div class="col-12">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input name="nama_barang" type="text" class="form-control" id="nama_barang" required>
                      </div>
                      <div class="col-12">
                        <label for="no_index" class="form-label">index Barang</label>
                        <input name="no_index" type="number" class="form-control" id="no_index" value="1" min="1" required>
                      </div>
                      <div class="col-12">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="idkategori" class="form-select" aria-label="Pilih Kategori" id="idkategori" required>
                          <option selected disabled>Pilih Kategori</option>
                          <?php foreach ($kategori as $k) : ?>
                            <option value="<?= $k['idkategori'] ?>"><?= $k['nama_kategori'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="col-12">
                        <label for="kondisi_barang" class="form-label">Kondisi</label>
                        <select name="kondisi_barang" class="form-select" aria-label="Pilih Kondisi" id="kondisi_barang" required>
                          <option selected disabled>Pilih Kondisi</option>
                          <?php foreach ($kondisi_barang as $kondisi) : ?>
                            <option value="<?= $kondisi ?>"><?= $kondisi ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="col-12">
                        <label for="foto_barang" class="form-label">Foto Barang</label>
                        <input name="foto_barang" type="file" class="form-control" id="foto_barang" required>
                      </div>
                      <div class="col-12">
                        <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                        <input name="tgl_masuk" type="date" class="form-control" id="tgl_masuk" required>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                  </div>
                  </form><!-- Vertical Form -->

                </div>
              </div>
            </div><!-- End Basic Modal-->

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Tanggal Masuk</th>
                  <th>Kategori</th>
                  <th>Kondisi</th>
                  <th>Foto</th>
                  <th>Detail</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($barang as $brg) : ?>
                  <tr>
                    <td><?= $brg['kdbarang']; ?></td>
                    <td><?= $brg['nama_barang']; ?></td>
                    <td><?= date('d-M-Y', strtotime($brg['tgl_masuk'])); ?></td>
                    <td><?= $brg['nama_kategori']; ?></td>
                    <td><?= $brg['kondisi_barang']; ?></td>
                    <th scope="row">
                      <?php if ($brg['foto_barang']) : ?>
                        <a href="#"><img style="height: 65px;" src="img/<?= $brg['foto_barang']; ?>" alt=""></a>
                      <?php else : ?>
                        <span>Tidak ada foto</span>
                      <?php endif; ?>
                    </th>

                    <td>
                      <button type="button" class="btn btn-success btn" data-bs-toggle="modal" data-bs-target="#detail<?= $brg['kdbarang']; ?>">
                        Detail
                      </button>
                    </td>

                    <td>
                      <button type="button" class="btn btn-warning btn-" data-bs-toggle="modal" data-bs-target="#edit<?= $brg['kdbarang']; ?>">
                        <i class="ri-edit-box-line"></i>
                      </button>

                      <button type="button" class="btn btn-danger btn" data-bs-toggle="modal" data-bs-target="#hapus<?= $brg['kdbarang']; ?>">
                        <i class="ri-delete-bin-2-line"></i>
                      </button>
                    </td>

                  </tr>

                  <!-- Modal detail -->
                  <div class="modal fade" id="detail<?= $brg['kdbarang']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Detail Barang</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="card-body">
                            <img src="img/<?= $brg['foto_barang']; ?>" class="card-img-top" alt="...">
                            <h5 class="card-title"><?= $brg['nama_barang']; ?> (<?= $brg['kondisi_barang']; ?>)</h5>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Basic Modal-->

                  <!-- Modal Hapus -->
                  <div class="modal fade" id="hapus<?= $brg['kdbarang']; ?>" tabindex="-1" data-bs-backdrop="false">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title"><i class="ri-alert-line"></i> Peringatan</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                          Apakah Anda Yakin Ingin Menghapus Barang <b><?= $brg['nama_barang']; ?></b>?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <form action="/barang/hapus/<?= $brg['kdbarang'] ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Basic Modal-->

                <?php endforeach; ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

            <!-- Modal Edit -->
            <?php foreach ($barang as $brg) : ?>
              <div class="modal fade" id="edit<?= $brg['kdbarang']; ?>" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Form Edit Barang</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                      <!-- Form -->
                      <form action="/barang/edit<?= $brg['kdbarang']; ?>" method="post" enctype="multipart/form-data" class="row g-3" id="form-edit <?= $brg['kdbarang']; ?>">
                        <div class="col-12">
                          <label for="kdbarang" class="form-label">Kode Barang</label>
                          <input type="text" class="form-control" id="kdbarang" name="kdbarang" value="<?= $brg['kdbarang']; ?>">
                        </div>
                        <div class="col-12">
                          <label for="nama_barang" class="form-label">Nama Barang</label>
                          <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $brg['nama_barang']; ?>">
                        </div>
                        <div class="col-12">
                          <label for="kategori" class="form-label">kategori barang</label>
                          <select name="idkategori" class="form-select" aria-label="Pilih kategori" id="idkategori" required>
                            <option selected disabled>Pilih Kategori</option>
                            <?php foreach ($kategori as $k) : ?>
                              <option value="<?= $k['idkategori']; ?>" <?= ($brg['idkategori'] == $k['idkategori']) ? 'selected' : ''; ?>><?= $k['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-12">
                          <label for="kondisi_barang" class="form-label">Kondisi</label>
                          <select class="form-select" id="kondisi_barang" name="kondisi_barang">
                            <?php foreach ($kondisi_barang as $kondisi) : ?>
                              <option value="<?= $kondisi ?>"><?= $kondisi ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>

                        <div class="col-12">
                          <label for="foto_barang" class="form-label">Foto Barang</label>
                          <input type="file" class="form-control" id="foto_barang" name="foto_barang">
                          <?php if ($brg['foto_barang']) : ?>
                            <img src="/img/<?= $brg['foto_barang'] ?>" alt="Foto Barang" class="img-thumbnail mt-2" width="200">
                          <?php endif; ?>
                        </div>
                        <div class="col-12">
                          <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                          <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= $brg['tgl_masuk']; ?>">
                        </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    </form><!-- Vertical Form -->

                  </div>
                </div>
              </div><!-- End Basic Modal-->
            <?php endforeach; ?>

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->