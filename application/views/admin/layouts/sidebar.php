<?php 
$segmen1 = $this->uri->segment(1);
$segmen2 = $this->uri->segment(2);
$segmen3 = $this->uri->segment(3);

 ?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo site_url('admin'); ?>" class="brand-link">
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
            <a href="<?php echo site_url('admin'); ?>" class="nav-link <?php if ($segmen1 == '' || ($segmen1 == 'admin' && $segmen2 == '')) {echo 'active';} ?>">
            <i class="nav-icon fas fa-chart-pie"></i>
              <p>Dashboard</p>
            </a>
          </li>
          
          <li class="nav-header">Kelola Data</li>
          
          <li class="nav-item <?php if ($segmen2 == 'jadwal' || $segmen2 == 'jadwal_gurupiket') {echo 'menu-open';} ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Data Jadwal
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url(); ?>admin/jadwal" class="nav-link <?php if ($segmen1 == 'admin' && $segmen2 == 'jadwal') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Pelajaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url(); ?>admin/jadwal_gurupiket" class="nav-link <?php if ($segmen1 == 'admin' && $segmen2 == 'jadwal_gurupiket') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Guru Piket</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if ($segmen2 == 'guru' || $segmen2 == 'siswa' || $segmen2 == 'kelas' || $segmen2 == 'user') {echo 'menu-open';} ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Data Lainnya
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url(); ?>admin/user" class="nav-link <?php if ($segmen1 == 'admin' && $segmen2 == 'user') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Akun</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url(); ?>admin/guru" class="nav-link <?php if ($segmen1 == 'admin' && $segmen2 == 'guru') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Guru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url(); ?>admin/siswa" class="nav-link <?php if ($segmen1 == 'admin' && $segmen2 == 'siswa') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url(); ?>admin/kelas" class="nav-link <?php if ($segmen1 == 'admin' && $segmen2 == 'kelas') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kelas</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-header">Absensi Guru</li>

          <li class="nav-item <?php if ($segmen2 == 'absensi_hadir' || $segmen2 == 'absensi_pulang') {echo 'menu-open';} ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Absensi Guru
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/absensi_hadir'); ?>" class="nav-link <?php if ($segmen1 == 'admin' && $segmen2 == 'absensi_hadir') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Absen Kehadiran</p>
                </a>
                <a href="<?php echo site_url('admin/absensi_pulang'); ?>" class="nav-link <?php if ($segmen1 == 'admin' && $segmen2 == 'absensi_pulang') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Absen Pulang</p>
                </a>
              </li>
            </ul>
            </li>

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
                <a href="<?php echo site_url('admin/laporan_hari'); ?>" class="nav-link <?php if ($segmen1 == 'admin' && $segmen2 == 'laporan_hari') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hari</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/laporan_bulan'); ?>" class="nav-link <?php if ($segmen1 == 'admin' && $segmen2 == 'laporan_bulan') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bulan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">Absensi Siswa</li>
          <li class="nav-item <?php if ($segmen2 == 'laporan_hari_siswa' || $segmen2 == 'laporan_bulan_siswa' || $segmen2 == 'absen_siswa') {echo 'menu-open';} ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Cetak Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/laporan_hari_siswa'); ?>" class="nav-link <?php if ($segmen1 == 'admin' && $segmen2 == 'laporan_hari_siswa') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hari</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/laporan_bulan_siswa'); ?>" class="nav-link <?php if ($segmen1 == 'admin' && $segmen2 == 'laporan_bulan_siswa') {echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bulan</p>
                </a>
              </li>
            </ul>
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