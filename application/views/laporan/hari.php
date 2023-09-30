<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cetak Laporan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Laporan Hari</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="flash_success" data-flash_success="<?php echo $this->session->flashdata('success'); ?>"></div>
      <div class="flash_error" data-flash_error="<?php echo $this->session->flashdata('error'); ?>"></div>
      <button type="button" style="display: none" id="tombol-cetak" class="btn btn-success btn-flat" onclick="printJS('daftar', 'html')"><i class="fas fa-print"></i>
        Cetak
      </button><br>

      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Laporan Harian</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="input-group date" id="" data-target-input="nearest">
                    <input id="lapHari" type="date" class="form-control datetimepicker-input" value="<?php  echo TODAY_DATE ?>">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="input-group date" id="" data-target-input="nearest">
                  <input id="infoLaporan" type="text" class="form-control datetimepicker-input" value="<?php echo $sudah_absen ?> Kelas Belum Absen Hari ini" readonly>
                  <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Pilih tanggal untuk mengecek laporan sebelumnya.
        </div>
      </div>
      <div id="laporanHari">
        <?php foreach ($kelas as $row): ?>
        <div class="card card-default">
          <div class="container-fluid">
            <div class="card-header">
              <h3 class="card-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;"><?= $row->kelas ?></h3>
              <div class="card-tools">
                <a href="#" class="btn btn-tool open-modal" data-kelas="<?php echo str_replace(' ', '-', $row->kelas); ?>" data-tanggal="<?php echo TODAY_DATE; ?>">
                  <i class="fas fa-camera"></i>
                </a>
              </div>
            </div>
            <br>
            <div class="table-responsive">
              <table border="all" style="border-collapse: collapse;" class="table table-hover table-bordered custom-table">
                <thead>
                  <tr>
                    <th style="width: 10px;">No</th>
                    <th style="width: 500px;">Nama</th>
                    <th style="width: 150px;">Absensi</th>
                    <th style="width: 250px;">Keterangan Lain</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php 
                      $absensi_kelas = $this->mlaporan->absensi_harian($row->kelas, TODAY_DATE);
                      foreach ($absensi_kelas as $laporan): 
                  ?>
                  <tr>
                    <td ><?= $no++ ?></td>
                    <td ><?= $laporan->nama_guru ?></td>
                    <td ><?= $laporan->status_absen ?></td>
                    <td ><?= $laporan->keterangan ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <br>
    <div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="gambarModalLabel">Bukti Gambar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <img id="gambarPreview" src="" alt="Bukti Gambar" style="max-width: 100%;">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->