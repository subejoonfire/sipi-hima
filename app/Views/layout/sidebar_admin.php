<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="/dashboard" id="dashboard-link">
        <i class="ri-dashboard-line"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-heading">Menu</li>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" id="data-barang-link">
        <i class="ri-archive-line"></i>
        <span>Data Barang</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="/barang" id="kelola-barang-link">
            <i class="bi bi-circle"></i><span>Kelola Barang</span>
          </a>
        </li>
        <li>
          <a href="/kategori" id="kelola-kategori-barang-link">
            <i class="bi bi-circle"></i><span>Kelola Kategori Barang</span>
          </a>
        </li>
      </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#" id="data-peminjaman-link">
        <i class="bi bi-journal-text"></i><span>Data Peminjaman</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="/peminjaman" id="kelola-peminjaman-link">
            <i class="bi bi-circle"></i><span>Kelola Peminjaman</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
        </li>
      </ul>
    </li><!-- End Forms Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#penitipan-nav" data-bs-toggle="collapse" href="#" id="data-penitipan-link">
        <i class="bi bi-journal-text"></i><span>Data Penitipan</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="penitipan-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="/penitipan" id="kelola-penitipan-link">
            <i class="bi bi-circle"></i><span>Kelola Penitipan</span>
          </a>
        </li>
      </ul>
    </li><!-- End Penitipan Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="/pelanggan" id="data-pelanggan-link">
        <i class="ri-group-3-line"></i>
        <span>Data Pelanggan</span>
      </a>
    </li><!-- End Pelanggan Nav -->

    <?php if ($level_user == 'admin') : ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/user" id="kelola-petugas-link">
          <i class="ri-user-add-line"></i>
          <span>Kelola Petugas</span>
        </a>
      </li><!-- End Petugas Nav -->
    <?php endif; ?>

    <li class="nav-heading"></li>

    <form action="/logout" method="get">
      <li class="nav-item">
        <button class="nav-link collapsed" type="submit" id="logout-link">
          <i class="ri-logout-box-line"></i>
          <span>Logout</span>
        </button>
      </li><!-- End Logout Nav -->
    </form>


  </ul>
</aside><!-- End Sidebar -->