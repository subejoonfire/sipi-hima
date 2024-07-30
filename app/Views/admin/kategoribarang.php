<main id="main" class="main">

    <div class="pagetitle">
        <h1>Kategori Barang</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">

                        <!-- Tambah Barang -->
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#basicModal">
                            Tambah Kategori
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
                        <div class="modal fade" id="basicModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form Tambah Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- Form -->
                                        <form action="/kategori/tambah" method="post" class="row g-3">
                                            <div class="col-12">
                                                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                                <input name="nama_kategori" type="text" class="form-control" id="nama_kategori">
                                            </div>

                                            <div class="col-12">
                                                <label for="nama_kategori" class="form-label">Deskripsi Kategori</label>
                                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="8" placeholder="Tuliskan Deskripsi Kategori" required></textarea>
                                            </div>
                                            <!-- Vertical Form -->

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- End Basic Modal-->

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Kategori Barang</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kategori as $k) : ?>
                                    <tr>
                                        <td><?= $k['nama_kategori']; ?></td>
                                        <td><?= $k['deskripsi']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn" data-bs-toggle="modal" data-bs-target="#edit<?= $k['idkategori'] ?>">
                                                <i class="ri-edit-box-line"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger btn" data-bs-toggle="modal" data-bs-target="#hapus<?= $k['idkategori']; ?>">
                                                <i class="ri-delete-bin-2-line"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapus<?= $k['idkategori']; ?>" tabindex="-1" data-bs-backdrop="false">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><i class="ri-alert-line"></i> Peringatan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    Apakah Anda Yakin Ingin Menghapus Kategori <b><?= $k['nama_kategori'] ?></b> dapat menghilangkan data barang ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="/kategori/hapus/<?= $k['idkategori'] ?>" method="post">
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
                        <?php foreach ($kategori as $k) : ?>
                            <div class="modal fade" id="edit<?= $k['idkategori'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Form Edit Kategori</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/kategori/edit<?= $k['idkategori'] ?>" method="post" class="row g-3" id="form-edit-<?= $k['idkategori'] ?>">
                                                <div class="col-12">
                                                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                                    <input name="nama_kategori" type="text" class="form-control" id="nama_kategori" value="<?= $k['nama_kategori'] ?>">
                                                </div>
                                                <div class="col-12">
                                                    <label for="deskripsi" class="form-label">Deskripsi Kategori</label>
                                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="8"><?= $k['deskripsi'] ?></textarea>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" form="form-edit-<?= $k['idkategori'] ?>" class="btn btn-success">Simpan</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?><!-- End Basic Modal-->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->