<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SMKN 4 - Ganti Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/adminlte.min.css">

  <link rel="shortcut icon" href="<?= base_url()?>assets/images/faviconn.png" />

  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
        <a href="#" class="h1"><b>Change </b>Password</a>
    </div>
    <div class="card-body">
      <div class="flashdata" data-flashdata="<?php echo $this->session->flashdata('error'); ?>">
      
      </div>
      <div class="text-center">
        <img src="<?= base_url()?>assets/dist/img/SkanpatLogo.png">
      </div>
      <br>
      <form action="<?php echo site_url(); ?>login/change_password" method="post">
        <div class="input-group mb-3">
        <input type="password" name="passwordLama" id="passwordlama" class="form-control" placeholder="Password Sekarang" value="<?php echo set_value('passwordLama') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div><p><?php echo form_error('passwordlama') ?></p>
        <div class="input-group mb-3">
        <input type="password" name="passwordBaru" id="passwordBaru" class="form-control" placeholder="Password Baru">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <p><?php echo form_error('passwordBaru') ?></p>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Ganti password</button>
          </div>
        </div>
        <p class="mt-3 mb-1">
          <a href="<?php echo site_url(); ?>gurupiket">Kembali</a>
        </p>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url()?>assets/plugins/toastr/toastr.min.js"></script>
<script>
  const flashdata = $('.flashdata').data('flashdata');
  if (flashdata) {
    toastr.warning(flashdata)
  }
</script>
</body>
</html>