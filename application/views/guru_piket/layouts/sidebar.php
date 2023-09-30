<?php 
$segmen1 = $this->uri->segment(1);
$segmen2 = $this->uri->segment(2);
$segmen3 = $this->uri->segment(3);

 ?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo site_url('gurupiket'); ?>" class="brand-link">
      <img src="<?= base_url()?>assets/dist/img/SkanpatLogo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SMK NEGERI 4</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- SidebarSearch Form -->
      <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo site_url('gurupiket'); ?>" class="nav-link <?php if ($segmen1 == '' || ($segmen1 == 'gurupiket' && $segmen2 == '')) {echo 'active';} ?>">
            <i class="nav-icon fas fa-chart-pie"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header">Input Absensi</li>
          <li class="nav-item">
            <a href="<?php echo site_url('gurupiket/input_absensi'); ?>" class="nav-link <?php if ($segmen1 == 'gurupiket' && $segmen2 == 'input_absensi') {echo 'active';} ?>">
            <i class="nav-icon fas fa-edit"></i>
              <p>Input Absensi</p>
            </a>
          </li>
          <li class="nav-header">Absensi Guru</li>
          <li class="nav-item <?php if ($segmen2 == 'laporan_hari' || $segmen2 == 'laporan_bulan') {echo 'menu-open';} ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Cetak Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('gurupiket/laporan_hari'); ?>" class="nav-link <?php if ($segmen1 == 'gurupiket' && $segmen2 == 'laporan_hari') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hari</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('gurupiket/laporan_bulan'); ?>" class="nav-link <?php if ($segmen1 == 'gurupiket' && $segmen2 == 'laporan_bulan') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bulan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Absensi Siswa</li>
          <li class="nav-item <?php if ($segmen2 == 'laporan_hari_siswa' || $segmen2 == 'laporan_bulan_siswa') {echo 'menu-open';} ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Cetak Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('gurupiket/laporan_hari_siswa'); ?>" class="nav-link <?php if ($segmen1 == 'gurupiket' && $segmen2 == 'laporan_hari_siswa') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hari</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('gurupiket/laporan_bulan_siswa'); ?>" class="nav-link <?php if ($segmen1 == 'gurupiket' && $segmen2 == 'laporan_bulan_siswa') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bulan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Account</li>
          <li class="nav-item">
            <a href="<?php echo site_url(); ?>login/change_password" class="nav-link">
            <i class="nav-icon fas fa-key"></i>
              <p>Ganti Password</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <div class="sidebar-custom">
      <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
    </div>
    <!-- /.sidebar -->
  </aside>