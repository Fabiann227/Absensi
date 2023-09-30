<!-- Content Wrapper. Contains page content -->
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
            <li class="breadcrumb-item active">Laporan Bulan</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Pilih Bulan</h3>

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
                <input id="" type="date" class="form-control" value="<?php  echo TODAY_DATE ?>" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input id="dateb" type="month" class="form-control" value="">
              </div>
            </div>      
          </div>
          <!-- /.row -->
        </div>
        <div class="card-footer">
          <form method="post" action="<?php echo site_url('laporan/exportToExcel'); ?>">
            <input id="hiddenMonth" type="hidden" name="bulan" value="">
            <button id="exportButton" type="submit" class="btn btn-primary" disabled>Export to Excel</button>
          </form>
        </div>
      </div>
      <div class="card card-default table-responsive" id="laporanBulan">
        <div class="container-fluid">
          <div style="text-align:center" class="card-header">
            <h3 class="card-title">Pilih Bulan terlebih Dahulu</h3>
          </div>
          <br>
          <table id="tbllaporanBulan" style="border-collapse: collapse; width:100%" class="table table-hover table-bordered custom-td">
              <thead class="bg-info">
                <tr>
                  <th rowspan="2" style="vertical-align : middle; text-align: center; width: 10px;">No</th>
                  <th rowspan="2" style="vertical-align : middle; text-align: center;">Nama</th>
                  <th rowspan="2" style="vertical-align : middle; text-align: center; width: 10px;">Jumlah Masuk Kelas</th>
                  <th colspan="4" style="vertical-align : middle; text-align: center;">Rekap Absensi</th>
                  <th rowspan="2" style="vertical-align : middle; text-align: center;  width: 20px;">Persentase Kehadiran</th>
                </tr>
                <tr>
                    <th>H</th>
                    <th>S</th>
                    <th>I</th>
                    <th>A</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
          </table>
          <br>
        </div>
      </div>
      <!-- /.row -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->