  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Pelanggan</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

              <button type="button" class="btn btn-primary mt-3 mb-2" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                TAMBAH PELANGGAN
              </button>
              <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">TAMBAH PELANGGAN</h5>
                    </div>
                    <div class="modal-body">
                      <form class="row g-3">
                        <div class="col-12">
                          <label for="inputNanme4" class="form-label">Nama Pelanggan</label>
                          <input type="text" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                          <label for="satuanBarang" class="form-label">No Hp</label>
                          <input type="number" class="form-control" id="satuanBarang" name="satuanBarang" required>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                          <button type="submit" class="btn btn-primary">Tambah</button>
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
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
                    <th class="text-center">NO</th>
                    <th class="text-center">
                      <b>N</b>ama Kategori
                    </th>
                    <th class="text-center">No Hp</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>01</td>
                    <td>artod</td>
                    <td>083143974070</td>
                    <td>
                      <!-- Button detail barang -->
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal"><i class="bi bi-eye"></i></button>

                      <!-- Modal -->
                      <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="detailModalLabel">DETAIL PELANGGAN</h5>
                            </div>

                            <div class="modal-body">
                              <div class="row g-3">
                                <div class="col-12 d-flex justify-content-between">
                                  <label class="form-label">Nama Pelanggan:</label>
                                  <p id="namaBarang" class="mb-0">Artod</p>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                  <label class="form-label">No Hp:</label>
                                  <p id="satuanBarang" class="mb-0">083143974070</p>
                                </div>

                              </div>
                            </div>
                            <div class="modal-footer text-center">
                              <button type="button" class="btn btn-danger mx-auto" data-bs-dismiss="modal">Kembali</button>
                            </div>
                          </div>
                        </div>
                      </div>
            </div>
            <!-- penutup nya -->

            <!-- Button edit barang -->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil"></i></button>

            <!-- Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="editForm">
                      <div class="col-12">
                        <label for="inputNanme4" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="inputNanme4">
                      </div>
                      <div class="col-12">
                        <label for="satuanBarang" class="form-label">No Hp</label>
                        <input type="number" class="form-control" id="satuanBarang" name="satuanBarang" required>
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

          <!-- Button hapus barang -->
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-trash"></i></button>

          <!-- Delete Confirmation Modal -->
          <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel">Hapus Data Pelanggan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Anda yakin ingin menghapus Data Pelanggan ini?</p>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                  <button type="button" class="btn btn-primary" id="confirmDeleteButton">Yakin</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Penutup nya -->

        </td>
        </tr>
        <tr>
          <td>02</td>
          <td>Theodore Duran</td>
          <td>8971</td>
          <td>Dhanbad</td>


        </tr>
        <tr>
          <td>03</td>
          <td>Artra</td>
          <td>9958</td>
          <td>Curicó</td>


        </tr>
        <tr>
          <td>04</td>
          <td>Theodorerrr Duran</td>
          <td>8971</td>
          <td>Dhanbad</td>


        </tr>
        <tr>
          <td>05</td>
          <td>Artsfsfa</td>
          <td>9958</td>
          <td>Curicó</td>


        </tr>
        <tr>
          <td>06</td>
          <td>jhbkjaThescodor</td>
          <td>8971</td>
          <td>Dhanbad</td>

        </tr>
        <tr>
          <td>07</td>
          <td>mhjArta</td>
          <td>9958</td>
          <td>Curicó</td>


        </tr>
        <tr>
          <td>08</td>
          <td>bxvTheodore Duran</td>
          <td>8971</td>
          <td>Dhanbad</td>


        </tr>
        <tr>
          <td>09</td>
          <td>qdcArta</td>
          <td>9958</td>
          <td>Curicó</td>


        </tr>
        <tr>
          <td>10</td>
          <td>qweTheodore Duran</td>
          <td>8971</td>
          <td>Dhanbad</td>


        </tr>
        <tr>
          <td>11</td>
          <td>rtyArta</td>
          <td>9958</td>
          <td>Curicó</td>


        </tr>
        <tr>
          <td>12</td>
          <td>lavdsvTheodore Duran</td>
          <td>8971</td>
          <td>Dhanbad</td>

        </tr>
        <tr>
          <td>13</td>
          <td>svArta</td>
          <td>9958</td>
          <td>Curicó</td>

        </tr>
        <tr>
          <td>14</td>
          <td>bfTheodore Duran</td>
          <td>8971</td>
          <td>Dhanbad</td>

        </tr>

        </tbody>
        </table>
        <!-- End Table with stripped rows -->

      </div>
      </div>

      </div>
      </div>
    </section>

  </main><!-- End #main -->