<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Jadwal Guru Piket</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Jadwal Guru Piket</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="flash_success" data-flash_success="<?php echo $this->session->flashdata('success'); ?>"></div>
    <div class="flash_error" data-flash_error="<?php echo $this->session->flashdata('error'); ?>"></div>
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Tambah Data Jadwal</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="<?= site_url('admin/import_jadwal_gurupiket'); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="uploadfile">File input</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="uploadfile" name="uploadfile" accept=".xlsx, .xls">
                  <label class="custom-file-label" for="uploadfile">Choose file</label>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-info" id="uploadbutton" disabled>Import From Excel</button>
          </form>
          <!-- /.row -->
        </div>
        <div class="card-footer">
          <?php
            $filename = 'jadwal_gurupiket.xlsx'; // Nama file yang ingin diunduh
            $download_url = site_url('admin/downloadFile/' . $filename);
          ?>
          Download template file excel <a href="<?= $download_url ?>">Disini</a>.
        </div>
      </div>
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Pilih Hari</h3>

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
                <select id="hari" class="form-control select2" style="width: 100%;" required="">
                  <option value="">-- Pilih Hari --</option>
                  <?php foreach ($hari as $hari): ?>
                    <option value="<?php echo $hari->nama_hari ?>"><?php echo $hari->nama_hari ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <form action="<?php echo site_url() ?>admin/input_absen" method="post">
        <div class="card card-default table-responsive" id="datajadwalgp">
          <div class="card-header"> 
            <h3 class="card-title">Jadwal Guru Piket</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <table>
                  <tr>
                    <td>Hari</td><td>:</td><td style="padding-left: 10px">Silahkan Pilih Hari</td>
                  </tr>
                </table>
            </div>
          </div>

        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->

      </form>
    </div>
  </section>
</div>