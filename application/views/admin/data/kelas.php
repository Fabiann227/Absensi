<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Kelas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Kelas</li>
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
          <h3 class="card-title">Import From Excel</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="<?= site_url('admin/import_kelas'); ?>" method="post" enctype="multipart/form-data">
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
            $filename = 'Kelas.xlsx'; // Nama file yang ingin diunduh
            $download_url = site_url('admin/downloadFile/' . $filename);
          ?>
          Download template file excel <a href="<?= $download_url ?>">Disini</a>.
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Guru</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-add">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <table id="tabel" class="table table-bordered table-striped custom-table">
            <thead>
              <tr>
                <th style="width: 30px;">ID</th>
                <th style="width: 800px;">Kelas</th>
                <th style="width: 111px;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($kelas as $row) { ?>
              <tr>
                  <td><?php echo $row->id_kelas; ?></td>
                  <td><?php echo $row->nama_kelas; ?></td>
                  <td>
                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $row->id_kelas; ?>">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?php echo site_url('admin/delete_kelas/' . $row->id_kelas); ?>" class="btn btn-danger btn-sm btn-del">
                      <i class="fa fa-trash"></i>
                    </a>
                  </td>
              </tr>
              <div class="modal fade" id="modal-edit<?php echo $row->id_kelas; ?>">
                <div class="modal-dialog modal-edit">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Data</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="<?php echo site_url() ?>admin/edit_kelas" method="post">
                      <div class="modal-body">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                          </div>
                          <input type="hidden" value="<?php echo $row->id_kelas; ?>" name="id">
                          <input type="text" class="form-control" value="<?php echo $row->nama_kelas; ?>" name="nama" required>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-info">Save changes</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.row -->
    </div>
    <div class="modal fade" id="modal-add">
      <div class="modal-dialog modal-add">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo site_url() ?>admin/add_kelas" method="post">
            <div class="modal-body">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Nama Kelas" name="nama" required>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="submit" class="btn btn-info">Submit</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->