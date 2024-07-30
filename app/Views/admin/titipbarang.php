<main id="main" class="main">

  <!-- Page Title -->
  <div class="pagetitle">
    <h1>Penitipan Barang</h1>
  </div><!-- End Page Title -->

  <!-- Section -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <!-- Card -->
        <div class="card">
          <div class="card-body">

            <!-- Button Tambah Penitipan -->
            <button type="button" class="btn btn-primary mt-3 mb-2" data-bs-toggle="modal" data-bs-target="#tambahPenitipanModal">
              TAMBAH PENITIPAN
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
            
            <!-- Modal Tambah Penitipan -->
            <div class="modal fade" id="tambahPenitipanModal" tabindex="-1" aria-labelledby="tambahPenitipanModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="tambahPenitipanModalLabel">TAMBAH PENITIPAN</h5>
                  </div>
                  <div class="modal-body">
                    <form class="row g-3" method="post" action="<?= base_url('penitipan/tambah') ?>" enctype="multipart/form-data">
                      <div class="col-12">
                        <label for="namaPenitip" class="form-label">Nama Penitip</label>
                        <select class="form-control" id="namaPenitip" name="namaPenitip" required>
                          <option value="">Pilih Nama Penitip</option>
                          <?php foreach ($penitip as $pelanggan) : ?>
                            <option value="<?= $pelanggan['idpelanggan']; ?>"><?= $pelanggan['nama_pelanggan']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="col-12">
                        <label for="namaBarang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="namaBarang" name="namaBarang" required>
                      </div>
                      <div class="col-12">
                        <label for="satuanBarang" class="form-label">Satuan</label>
                        <input type="number" class="form-control" id="satuanBarang" name="satuanBarang" required>
                      </div>
                      <div class="col-12">
                        <label for="deskripsiBarang" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiBarang" name="deskripsiBarang" rows="3" required></textarea>
                      </div>
                      <div class="col-12">
                        <label for="noHp" class="form-label">No Hp</label>
                        <input type="number" class="form-control" id="noHp" name="noHp" required>
                      </div>
                      <div class="col-12">
                        <label for="waktuTitip" class="form-label">Waktu Titip</label>
                        <input type="datetime-local" class="form-control" id="waktuTitip" name="waktuTitip" required>
                      </div>
                      <div class="col-12">
                        <label for="waktuKembali" class="form-label">Waktu Kembali</label>
                        <input type="datetime-local" class="form-control" id="waktuKembali" name="waktuKembali" required>
                      </div>
                      <div class="col-12">
                        <label for="fotoBarang" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="fotoBarang" name="fotoBarang" accept="image/*" required>
                      </div>
                      <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div><!-- End Modal Tambah Penitipan -->

            <!-- Button Cetak -->
            <button type="button" class="btn btn-primary mt-3 mb-2" id="printButton">
              CETAK
            </button>

            <!-- Table -->
            <table class="table datatable text-center">
              <thead>
                <tr>
                  <th class="text-center">Nama Penitip</th>
                  <th class="text-center">Nama Barang</th>
                  <th class="text-center">Satuan</th>
                  <th class="text-center">Deskripsi</th>
                  <th class="text-center">No Hp</th>
                  <th class="text-center">Tanggal Pinjam</th>
                  <th class="text-center">Tanggal Kembali</th>
                  <th class="text-center">Foto</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $item) : ?>
                  <tr>
                    <td><?= $item['nama_pelanggan'] ?></td>
                    <td><?= $item['nama_barang'] ?></td>
                    <td><?= $item['jumlah_barang'] ?></td>
                    <td><?= $item['deskripsi'] ?></td>
                    <td><?= $item['no_kontak'] ?></td>
                    <td><?= $item['tgl_titip'] ?></td>
                    <td><?= $item['tgl_kembali'] ?></td>
                    <td><img src="<?= base_url('img/' . $item['foto_titip']) ?>" alt="<?= $item['nama_barang'] ?>" style="width: 100px; height: auto;"></td>
                    <td><?= $item['status'] ?></td>
                    <td>
                      <!-- Button detail barang -->
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal<?= $item['id_penitipan'] ?>"><i class="bi bi-eye"></i></button>

                      <!-- Modal Detail Penitipan -->
                      <div class="modal fade" id="detailModal<?= $item['id_penitipan'] ?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="detailModalLabel">DETAIL PENITIPAN</h5>
                            </div>

                            <div class="modal-body">
                              <div class="row g-3">
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                  <label class="form-label mb-0">Status:</label>
                                  <p id="statusBarang" class="mb-0 text-success"><?= $item['status'] ?></p>
                                </div>
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                  <label class="form-label mb-0">Nama Penitip:</label>
                                  <p id="namaPenitip" class="mb-0"><?= $item['nama_pelanggan'] ?></p>
                                </div>
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                  <label class="form-label mb-0">Nama Barang:</label>
                                  <p id="namaBarang" class="mb-0"><?= $item['nama_barang'] ?></p>
                                </div>
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                  <label class="form-label mb-0">Satuan:</label>
                                  <p id="satuanBarang" class="mb-0"><?= $item['jumlah_barang'] ?></p>
                                </div>
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                  <label class="form-label mb-0">Deskripsi:</label>
                                  <p id="deskripsiBarang" class="mb-0"><?= $item['deskripsi'] ?></p>
                                </div>
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                  <label class="form-label mb-0">No Hp:</label>
                                  <p id="deskripsiBarang" class="mb-0"><?= $item['no_kontak'] ?></p>
                                </div>
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                  <label class="form-label mb-0">Waktu Titip:</label>
                                  <p id="waktuTitip" class="mb-0"><?= $item['tgl_titip'] ?></p>
                                </div>
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                  <label class="form-label mb-0">Waktu Kembali:</label>
                                  <p id="waktuKembali" class="mb-0"><?= $item['tgl_kembali'] ?></p>
                                </div>
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                  <label class="form-label mb-0">Foto:</label>
                                  <p id="fotoBarang" class="mb-0"><?= $item['foto_titip'] ?></p>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Modal Detail Penitipan -->

                      <!-- Button edit barang -->
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id_penitipan'] ?>"><i class="bi bi-pencil"></i></button>

                      <!-- Modal Edit Penitipan -->
                      <div class="modal fade" id="editModal<?= $item['id_penitipan'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel">EDIT PENITIPAN</h5>
                            </div>
                            <div class="modal-body">
                              <form class="row g-3" method="post" action="<?= base_url('penitipan/edit/' . $item['id_penitipan']) ?>" enctype="multipart/form-data">
                                <div class="col-12">
                                  <label for="editNamaPenitip" class="form-label">Nama Penitip</label>
                                  <select class="form-control" id="editNamaPenitip" name="editNamaPenitip" required>
                                    <option value="">Pilih Nama Penitip</option>
                                    <?php foreach ($penitip as $pelanggan) : ?>
                                      <option value="<?= $pelanggan['idpelanggan']; ?>" <?= $pelanggan['idpelanggan'] == $item['idpelanggan'] ? 'selected' : '' ?>><?= $pelanggan['nama_pelanggan']; ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="col-12">
                                  <label for="editNamaBarang" class="form-label">Nama Barang</label>
                                  <input type="text" class="form-control" id="editNamaBarang" name="editNamaBarang" value="<?= $item['nama_barang'] ?>" required>
                                </div>
                                <div class="col-12">
                                  <label for="editSatuanBarang" class="form-label">Satuan</label>
                                  <input type="number" class="form-control" id="editSatuanBarang" name="editSatuanBarang" value="<?= $item['jumlah_barang'] ?>" required>
                                </div>
                                <div class="col-12">
                                  <label for="editDeskripsiBarang" class="form-label">Deskripsi</label>
                                  <textarea class="form-control" id="editDeskripsiBarang" name="editDeskripsiBarang" rows="3" required><?= $item['deskripsi'] ?></textarea>
                                </div>
                                <div class="col-12">
                                  <label for="editNoHp" class="form-label">No Hp</label>
                                  <input type="number" class="form-control" id="editNoHp" name="editNoHp" value="<?= $item['no_kontak'] ?>" required>
                                </div>
                                <div class="col-12">
                                  <label for="editWaktuTitip" class="form-label">Waktu Titip</label>
                                  <input type="datetime-local" class="form-control" id="editWaktuTitip" name="editWaktuTitip" value="<?= $item['tgl_titip'] ?>" required>
                                </div>
                                <div class="col-12">
                                  <label for="editWaktuKembali" class="form-label">Waktu Kembali</label>
                                  <input type="datetime-local" class="form-control" id="editWaktuKembali" name="editWaktuKembali" value="<?= $item['tgl_kembali'] ?>" required>
                                </div>
                                <div class="col-12">
                                  <label for="editFotoBarang" class="form-label">Foto</label>
                                  <input type="file" class="form-control" id="editFotoBarang" name="editFotoBarang" accept="image/*">
                                  <input type="hidden" name="existingFotoBarang" value="<?= $item['foto_titip'] ?>">
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                  <button type="submit" class="btn btn-primary">Edit</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Modal Edit Penitipan -->

                      <!-- Button hapus barang -->
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $item['id_penitipan'] ?>"><i class="bi bi-trash"></i></button>

                      <!-- Modal Hapus Penitipan -->
                      <div class="modal fade" id="hapusModal<?= $item['id_penitipan'] ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="hapusModalLabel">HAPUS PENITIPAN</h5>
                            </div>
                            <div class="modal-body">
                              <p>Apakah Anda yakin ingin menghapus penitipan barang ini?</p>
                              <form method="post" action="<?= base_url('penitipan/hapus/' . $item['id_penitipan']) ?>">
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
            </table><!-- End Table -->

          </div>
        </div><!-- End Card -->
      </div>
    </div>
  </section><!-- End Section -->

</main><!-- End Main -->

<script>
  // Print functionality
  document.getElementById('printButton').addEventListener('click', function () {
    window.print();
  });
</script>