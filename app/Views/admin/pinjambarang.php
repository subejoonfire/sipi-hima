<main id="main" class="main">

  <div class="pagetitle">
    <h1>Peminjaman Barang</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <!-- Button to Open Add Modal -->
            <button type="button" class="btn btn-primary mt-3 mb-2" data-bs-toggle="modal" data-bs-target="#addModal">
              TAMBAH PEMINJAMAN
            </button>

            <?php if (session()->getFlashdata('error')) : ?>
              <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
              </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')) : ?>
              <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
              </div>
            <?php endif; ?>

            <!-- Add Loan Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">TAMBAH PEMINJAMAN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="addForm" class="row g-3" method="post" action="<?= base_url('peminjaman/tambah') ?> ">
                      <div class="col-12">
                        <label for="selectPeminjam" class="form-label">Nama Peminjam</label>
                        <select class="form-control" id="selectPeminjam" name="selectPeminjam" required>
                          <option value="" disabled selected>Pilih Peminjam</option>
                          <!-- Dynamic dropdown options -->
                          <?php foreach ($pelanggan as $item) : ?>
                            <option value="<?= $item['idpelanggan']; ?>"><?= $item['nama_pelanggan']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="col-12">
                        <label for="selectBarang" class="form-label">Nama Barang</label>
                        <select class="form-control" id="selectBarang" name="selectBarang" required>
                          <option value="" disabled selected>Pilih Barang</option>
                          <!-- Dynamic dropdown options -->
                          <?php foreach ($barang as $item) : ?>
                            <option value="<?= $item['kdbarang']; ?>"><?= $item['nama_barang']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="col-12">
                        <label for="satuanBarang" class="form-label">Satuan</label>
                        <input type="number" class="form-control" id="satuanBarang" name="satuanBarang" required>
                      </div>
                      <div class="col-12">
                        <label for="waktuPinjam" class="form-label">Waktu Pinjam</label>
                        <input type="datetime-local" class="form-control" id="waktuPinjam" name="waktuPinjam" required>
                      </div>
                      <div class="col-12">
                        <label for="waktuKembali" class="form-label">Waktu Kembali</label>
                        <input type="datetime-local" class="form-control" id="waktuKembali" name="waktuKembali" required>
                      </div>
                      <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div><!-- End Add Loan Modal -->

            <!-- Button to Open Print Modal -->
            <button type="button" class="btn btn-primary mt-3 mb-2" id="printButton">
              CETAK
            </button>

            <!-- Table with Data -->
            <table class="table datatable text-center">
              <thead>
                <tr>
                  <th class="text-center">NO</th>
                  <th class="text-center">Nama Peminjam</th>
                  <th class="text-center">Nama Barang</th>
                  <th class="text-center">Tanggal Pinjam</th>
                  <th class="text-center">Tanggal Kembali</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $key => $pinjam) : ?>
                  <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $pinjam['nama_pelanggan']; ?></td>
                    <td><?= $pinjam['nama_barang']; ?></td>
                    <td><?= date('d/m/Y', strtotime($pinjam['tanggal_peminjaman'])); ?></td>
                    <td><?= date('d/m/Y', strtotime($pinjam['tanggal_pengembalian'])); ?></td>
                    <td><?= $pinjam['status']; ?></td>
                    <td>
                      <!-- Button Detail -->
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal<?= $pinjam['id_peminjaman']; ?>">
                        <i class="bi bi-eye"></i>
                      </button>
                      <!-- Detail Modal -->
                      <div class="modal fade" id="detailModal<?= $pinjam['id_peminjaman']; ?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">DETAIL PEMINJAMAN</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row g-3">
                                <div class="col-12 d-flex justify-content-between">
                                  <label class="form-label">Status:</label>
                                  <p class="mb-0"><?= $pinjam['status']; ?></p>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                  <label class="form-label">Nama Pelanggan:</label>
                                  <p class="mb-0"><?= $pinjam['nama_pelanggan']; ?></p>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                  <label class="form-label">Nama Barang:</label>
                                  <p class="mb-0"><?= $pinjam['nama_barang']; ?></p>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                  <label class="form-label">Waktu Pinjam:</label>
                                  <p class="mb-0"><?= date('d/m/Y', strtotime($pinjam['tanggal_peminjaman'])); ?></p>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                  <label class="form-label">Waktu Kembali:</label>
                                  <p class="mb-0"><?= date('d/m/Y', strtotime($pinjam['tanggal_pengembalian'])); ?></p>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer text-center">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Button Edit -->
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $pinjam['id_peminjaman']; ?>">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <!-- Edit Modal -->
                      <div class="modal fade" id="editModal<?= $pinjam['id_peminjaman']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Edit Peminjaman</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form id="editForm<?= $pinjam['id_peminjaman']; ?>" action="<?= base_url('peminjaman/edit/' . $pinjam['id_peminjaman']); ?>" method="post">
                                <div class="col-12">
                                  <label for="editNamaPeminjam<?= $pinjam['id_peminjaman']; ?>" class="form-label">Nama Peminjam</label>
                                  <select class="form-control" id="editSelectPeminjam<?= $pinjam['id_peminjaman']; ?>" name="editSelectPeminjam" required>
                                    <option value="" disabled>Pilih Peminjam</option>
                                    <?php foreach ($pelanggan as $item) : ?>
                                      <option value="<?= $item['idpelanggan']; ?>" <?= $item['idpelanggan'] == $pinjam['idpelanggan'] ? 'selected' : ''; ?>>
                                        <?= $item['nama_pelanggan']; ?>
                                      </option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="col-12">
                                  <label for="editSelectBarang<?= $pinjam['id_peminjaman']; ?>" class="form-label">Nama Barang</label>
                                  <select class="form-control" id="editSelectBarang<?= $pinjam['id_peminjaman']; ?>" name="editSelectBarang" required>
                                    <option value="" disabled>Pilih Barang</option>
                                    <?php foreach ($barang as $item) : ?>
                                      <option value="<?= $item['kdbarang']; ?>" <?= $item['kdbarang'] == $pinjam['kdbarang'] ? 'selected' : ''; ?>>
                                        <?= $item['nama_barang']; ?>
                                      </option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="col-12">
                                  <label for="editWaktuPinjam<?= $pinjam['id_peminjaman']; ?>" class="form-label">Waktu Pinjam</label>
                                  <input type="datetime-local" class="form-control" id="editWaktuPinjam<?= $pinjam['id_peminjaman']; ?>" name="editWaktuPinjam" value="<?= date('Y-m-d\TH:i', strtotime($pinjam['tanggal_peminjaman'])); ?>" required>
                                </div>
                                <div class="col-12">
                                  <label for="editWaktuKembali<?= $pinjam['id_peminjaman']; ?>" class="form-label">Waktu Kembali</label>
                                  <input type="datetime-local" class="form-control" id="editWaktuKembali<?= $pinjam['id_peminjaman']; ?>" name="editWaktuKembali" value="<?= date('Y-m-d\TH:i', strtotime($pinjam['tanggal_pengembalian'])); ?>" required>
                                </div>
                                <div class="col-12">
                                  <label for="editStatus<?= $pinjam['id_peminjaman']; ?>" class="form-label">Status</label>
                                  <select class="form-control" id="editStatus<?= $pinjam['id_peminjaman']; ?>" name="status" required>
                                    <option value="Diproses" <?= $pinjam['status'] == 'Diproses' ? 'selected' : ''; ?>>Diproses</option>
                                    <option value="Sedang dipinjam" <?= $pinjam['status'] == 'Sedang dipinjam' ? 'selected' : ''; ?>>Sedang dipinjam</option>
                                    <option value="Selesai" <?= $pinjam['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                                  </select>
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $pinjam['id_peminjaman'] ?>"><i class="bi bi-trash"></i></button>
                      <!-- Modal Hapus Penitipan -->
                      <div class="modal fade" id="hapusModal<?= $pinjam['id_peminjaman'] ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="hapusModalLabel">HAPUS PEMINJAMAN</h5>
                            </div>
                            <div class="modal-body">
                              <p>Apakah Anda yakin ingin menghapus peminjaman barang ini?</p>
                              <form method="post" action="<?= base_url('peminjaman/hapus/' . $pinjam['id_peminjaman']) ?>">
                                <div class="modal-footer d-flex justify-content-center">
                                  <button type="submit" class="btn btn-danger">Hapus</button>
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Modal Hapus Penitipan -->

                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->