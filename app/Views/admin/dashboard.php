<style>
  .center-text {
    text-align: center;
  }
</style>


<main id="main" class="main">

  <div class="pagetitle">
    <h1>BERANDA</h1>
    <!-- <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Blank</li>
        </ol>
      </nav> -->
  </div><!-- End Page Title -->

  <div class="container mt-2">
    <div class="row">
      <div class="col"></div> <!-- Ini adalah kolom kosong untuk memberikan jarak di sebelah kiri -->
      <div class="col-6 center-text pagetitle">
        <h3>Selamat Datang di
          Sistem Informasi Pengelolaan Inventaris Barang HIMA-TI Politala</h3>
      </div>
      <div class="col"></div> <!-- Ini adalah kolom kosong untuk memberikan jarak di sebelah kanan -->
    </div>
  </div>

  <section class="section mt-3">
    <div class="row">

      <div class="col-lg-3">
        <div class="card bg-danger text-white">
          <div class="card-body">
            <h5 class="card-title text-white">Data Barang</h5>
            <div class="center-text">
              <h1><?= $jumlahbarang; ?></h1>
            </div>
            <div class="center-text mt-3">
              <a href="/barang" class="text-decoration-none text-white">Lihat Detail</a>
            </div>
          </div>
        </div>
      </div>


      <div class="col-lg-3">

        <div class="card bg-warning text-white">
          <div class="card-body">
            <h5 class="card-title text-white">Data Peminjaman</h5>
            <div class="center-text">
              <h1>50</h1>
            </div>
            <div class="center-text mt-3">
              <a href="#" class="text-decoration-none text-white">Lihat Detail</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3">

        <div class="card bg-info text-white">
          <div class="card-body">
            <h5 class="card-title text-white">Data penitipan</h5>
            <div class="center-text">
              <h1>50</h1>
            </div>
            <div class="center-text mt-3">
              <a href="#" class="text-decoration-none text-white">Lihat Detail</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3">

        <div class="card bg-success text-white">
          <div class="card-body">
            <h5 class="card-title text-white">Data pengembalian</h5>
            <div class="center-text">
              <h1>50</h1>
            </div>
            <div class="center-text mt-3">
              <a href="#" class="text-decoration-none text-white">Lihat Detail</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mx-auto">

        <?php if ($level_user == 'admin') : ?>
          <div class="card bg-primary text-white">
            <div class="card-body">
              <h5 class="card-title text-white">Data pengguna</h5>
              <div class="center-text">
                <h1><?= $jumlahpengguna; ?></h1>
              </div>
              <div class="center-text mt-3">
                <a href="#" class="text-decoration-none text-white">Lihat Detail</a>
              </div>
            </div>
          </div>
        <?php endif; ?>

      </div>

    </div>
  </section>

</main><!-- End #main -->