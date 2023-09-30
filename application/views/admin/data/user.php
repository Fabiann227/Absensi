<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Akun</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Users</li>
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
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Users</h3>
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
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($user as $row) { ?>
              <tr>
                  <td style="width: 30px;"><?php echo $row->id; ?></td>
                  <td style=""><?php echo $row->username; ?></td>
                  <td style=""><?php echo $row->role; ?></td>
                  <td style="width: 30px;">
                  <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $row->id; ?>">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?php echo site_url('admin/delete_user/' . $row->id); ?>" class="btn btn-danger btn-sm btn-del">
                      <i class="fa fa-trash"></i>
                    </a>
                  </td>
              </tr>
              <div class="modal fade" id="modal-edit<?php echo $row->id; ?>">
                <div class="modal-dialog modal-edit">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Data</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="<?php echo site_url() ?>admin/edit_tbusers" method="post">
                      <div class="modal-body">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                          </div>
                          <input type="hidden" value="<?php echo $row->id; ?>" name="id">
                          <input type="text" class="form-control" value="<?php echo $row->username; ?>" name="nama" required>
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
    <!-- /.container-fluid -->
    <div class="modal fade" id="modal-add">
      <div class="modal-dialog modal-edit">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Akun</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo site_url() ?>admin/add_user" method="post">
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-6">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input name="username" type="text" class="form-control" placeholder="Username" required>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input name="password" type="text" class="form-control" placeholder="Password" required>
                  </div>
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <div class="input-group mb-3">
                <select id="role" name="role" class="form-control select2" style="width: 100%;" required>
                  <option value="Admin">Admin</option>
                  <option value="Guru Piket">Guru Piket</option>
                  <option value="Guru Manage">Guru Manage</option>
                </select>
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
    <!-- /.modal -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->