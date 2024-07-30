<main id="main" class="main">

    <div class="pagetitle">
        <h1>Penitipan Barang</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">

                        <!-- Tambah Barang -->
                        <div class="col-12 mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="ri-folder-add-line"></i>Tambah Penitipan</button>

                            <?php if ($level_user == 'admin') : ?>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalCetakPDF"><i class="ri-file-pdf-2-line"></i>Cetak Data</button>
                            <?php endif; ?>

                            <!-- Modal Cetak PDF -->
                            <div class="modal fade" id="modalCetakPDF" tabindex="-1" aria-labelledby="modalCetakPDFLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalCetakPDFLabel">Cetak Laporan Penitipan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/penitipan/generatepdf" method="get" target="_blank">
                                                <div class="mb-3">
                                                    <label for="pelanggan" class="form-label">Pelanggan</label>
                                                    <select class="form-select" id="pelanggan" name="pelanggan">
                                                        <option value="">Semua Pelanggan</option>
                                                        <?php foreach ($pelanggan as $p) : ?>
                                                            <option value="<?= $p['idpelanggan'] ?>"><?= $p['nama_pelanggan'] ?></option>
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
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form Tambah Penitipan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/penitipan/tambah" method="post" enctype="multipart/form-data" class="row g-3">
                                            <?= csrf_field() ?>
                                            <div class="col-12">
                                                <label for="pelanggan" class="form-label">Pelanggan</label>
                                                <select name="idpelanggan" class="form-select" aria-label="Pilih Pelanggan" id="idpelanggan" required>
                                                    <option selected disabled>Pilih Pelanggan</option>
                                                    <?php foreach ($pelanggan as $p) : ?>
                                                        <option value="<?= $p['idpelanggan'] ?>"><?= $p['nama_pelanggan'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                                <input name="nama_barang" type="text" class="form-control" id="nama_barang" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="jumlah_barang" class="form-label">Jumlah</label>
                                                <input name="jumlah_barang" type="number" class="form-control" id="jumlah_barang" value="1" min="1" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="deskripsi_titip" class="form-label">Deskripsi Barang</label>
                                                <textarea class="form-control" name="deskripsi_titip" id="deskripsi_titip" rows="3" placeholder="Tuliskan Deskripsi Penitipan" required></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="tgl_titip" class="form-label">Tanggal Titip</label>
                                                <input name="tgl_titip" type="date" class="form-control" id="tgl_titip" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                                                <input name="tgl_kembali" type="date" class="form-control" id="tgl_kembali" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="foto_titip" class="form-label">Foto Barang</label>
                                                <input name="foto_titip" type="file" class="form-control" id="foto_titip" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" class="form-select" aria-label="Pilih Kondisi" id="status" required>
                                                    <option selected disabled>Pilih Kondisi</option>
                                                    <?php foreach ($status as $status_barang) : ?>
                                                        <option value="<?= $status_barang ?>"><?= $status_barang ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table datatable text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Nama Pelanggan</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Tanggal Pinjam</th>
                                    <th class="text-center">Tanggal Kembali</th>
                                    <th class="text-center">Foto Barang</th>
                                    <th class="text-center">status</th>
                                    <!-- <th class="text-center">Status</th> -->
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($titipbarang as $titipbrg) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $titipbrg['nama_pelanggan']; ?></td>
                                        <td><?= $titipbrg['nama_barang']; ?></td>
                                        <td><?= $titipbrg['jumlah_barang']; ?></td>
                                        <td><?= $titipbrg['tgl_titip']; ?></td>
                                        <td><?= $titipbrg['tgl_kembali']; ?></td>
                                        <th scope="row">
                                            <?php if ($titipbrg['foto_titip']) : ?>
                                                <a href="#"><img style="height: 65px;" src="img/<?= $titipbrg['foto_titip']; ?>" alt=""></a>
                                            <?php else : ?>
                                                <span>Tidak ada foto</span>
                                            <?php endif; ?>
                                        </th>

                                        <td><?= $titipbrg['status']; ?></td>
                                        <!-- <td>Selesai</td> -->
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!-- Button detail barang -->
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detail<?= $titipbrg['id_penitipan']; ?>">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <!-- Button edit barang -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $titipbrg['id_penitipan']; ?>">
                                                    <i class="ri-edit-box-line"></i>
                                                </button>
                                                <!-- Button hapus barang -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $titipbrg['id_penitipan']; ?>">
                                                    <i class="ri-delete-bin-2-line"></i>
                                                </button>
                                            </div>
                                            <!-- Modal detail -->
                                            <div class="modal fade" id="detail<?= $titipbrg['id_penitipan']; ?>" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Penitipan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <img src="img/<?= $titipbrg['foto_titip']; ?>" class="img-fluid" alt="Foto Barang">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5 class="card-title">
                                                                        <span class="badge bg-dark text-light"><?= $titipbrg['status']; ?></span>
                                                                    </h5>
                                                                    <h5 class="card-title">ID: <?= $titipbrg['id_penitipan']; ?> Nama Barang: <?= $titipbrg['nama_barang']; ?></h5>
                                                                    <p class="card-text">
                                                                        <strong>Pelanggan:</strong> <?= $titipbrg['nama_pelanggan']; ?><br>
                                                                        <strong>Kontak:</strong> <?= $titipbrg['no_kontak']; ?>
                                                                    </p>
                                                                    <p class="card-text">
                                                                        <strong>Tanggal Titip:</strong> <?= $titipbrg['tgl_titip']; ?><br>
                                                                        <strong>Tanggal Kembali:</strong> <?= $titipbrg['tgl_kembali']; ?>
                                                                    </p>
                                                                    <p class="card-text"><?= $titipbrg['deskripsi']; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <a href="/penitipan/cetaknota/<?= $titipbrg['id_penitipan']; ?>" class="btn btn-primary" target="_blank">Cetak Nota</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- End Basic Modal-->

                                            <!-- Delete Confirmation Modal -->
                                            <div class="modal fade" id="hapus<?= $titipbrg['id_penitipan']; ?>" tabindex="-1" data-bs-backdrop="false">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"><i class="ri-alert-line"></i> Peringatan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            Apakah Anda Yakin Ingin Menghapus Barang <b><?= $titipbrg['nama_barang']; ?></b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <form action="/penitipan/hapus/<?= $titipbrg['id_penitipan'] ?>" method="post">
                                                                <?= csrf_field() ?>
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- End Basic Modal-->

                                            <!-- Modal -->
                                            <?php foreach ($titipbarang as $titipbrg) : ?>
                                                <div class="modal fade" id="edit<?= $titipbrg['id_penitipan']; ?>" tabindex="-1">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Form Edit Penitipan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/penitipan/edit/<?= $titipbrg['id_penitipan']; ?>" method="post" enctype="multipart/form-data" class="row g-3" id="form-edit <?= $titipbrg['id_penitipan']; ?>">
                                                                    <div class="col-md-6">
                                                                        <label for="pelanggan" class="form-label">Pelanggan</label>
                                                                        <select name="idpelanggan" class="form-select" aria-label="Pilih Pelanggan" id="idpelanggan" required>
                                                                            <option selected disabled>Pilih Pelanggan</option>
                                                                            <?php foreach ($pelanggan as $p) : ?>
                                                                                <option value="<?= $p['idpelanggan'] ?>"><?= $p['nama_pelanggan'] ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="nama_barang" class="form-label">Nama Barang</label>
                                                                        <input name="nama_barang" type="text" class="form-control" id="nama_barang" value="<?= $titipbrg['nama_barang']; ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="jumlah_barang" class="form-label">Jumlah</label>
                                                                        <input name="jumlah_barang" type="number" class="form-control" id="jumlah_barang" value="1" min="1" value="<?= $titipbrg['jumlah_barang']; ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="deskripsi" class="form-label">Deskripsi Barang</label>
                                                                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" placeholder="Tuliskan Deskripsi Penitipan" value="<?= $titipbrg['deskripsi']; ?>"></textarea>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="tgl_titip" class="form-label">Tanggal Titip</label>
                                                                        <input name="tgl_titip" type="date" class="form-control" id="tgl_titip" value="<?= $titipbrg['tgl_titip']; ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                                                                        <input name="tgl_kembali" type="date" class="form-control" id="tgl_kembali" value="<?= $titipbrg['tgl_kembali']; ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="foto_titip" class="form-label">Foto Barang</label>
                                                                        <input type="file" class="form-control" id="foto_titip" name="foto_titip">
                                                                        <?php if ($titipbrg['foto_titip']) : ?>
                                                                            <img src="/img/<?= $titipbrg['foto_titip'] ?>" alt="Foto barang" class="img-thumbnail mt-2" width="200">
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="status" class="status">Status</label>
                                                                        <select class="form-select" id="status" name="status">
                                                                            <?php foreach ($status as $status_barang) : ?>
                                                                                <option value="<?= $status_barang ?>"><?= $status_barang ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- penutup nya -->
                                            <?php endforeach; ?>

                                            <!-- Penutup nya -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main> <!-- End #main -->