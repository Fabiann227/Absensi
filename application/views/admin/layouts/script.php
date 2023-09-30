<!-- jQuery -->
<script src="<?= base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url()?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url()?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url()?>assets/plugins/toastr/toastr.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url()?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url()?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
	const flash_success = $('.flash_success').data('flash_success');
	if (flash_success) {
		toastr.success(flash_success)
	}
</script>

<script>
	const flash_error = $('.flash_error').data('flash_error');
	if (flash_error) {
		toastr.error(flash_error)
	}
</script>

<script>
  $(document).ready(function(){
    $('#uploadfile').change(function(){
      var uploadButton = document.getElementById('uploadbutton');
      
      if (this.files.length > 0) 
      {
        uploadButton.disabled = false;
          
      } 
      else 
      {
        uploadButton.disabled = true;
      }
    });
  });
</script>

<script>
  $(document).ready(function(){

    $('#dateb').change(function(){
      var dateb = $('#dateb').val();
      var selectedDate = new Date($('#dateb').val() + "-01");
      var selectedMonth = selectedDate.getMonth() + 1;

      var exportButton = document.getElementById('exportButton');
      
      if (this.files.length > 0) 
      {
        exportButton.disabled = false;
      } 
      else 
      {
        exportButton.disabled = true;
      }

      $.ajax({
        url: '<?php echo site_url(); ?>laporan/cetak_laporan',
        type: 'post',
        data: {selectedMonth:selectedMonth},
        //dataType: 'json',
        success: function(data)
        {
          $('#laporanBulan').html(data);
          $("#tbllaporanBulan").DataTable({
            "responsive": false, "lengthChange": false, "autoWidth": true,
            "language": {
                "paginate": {
                    "next": ">",
                    "previous": "<"
                },
            }
          });
        },
        error:function()
        {
          alert('error ' + selectedMonth + '');
        }
      })
    });
  });
</script>

<script>
  $(document).ready(function(){
    $(function () {
      $("#tabel").DataTable({
        "responsive": false, "lengthChange": false, "autoWidth": true,
        "language": {
            "paginate": {
                "next": ">",
                "previous": "<"
            },
        }
      }).buttons().container().appendTo('#tabelguru_wrapper .col-md-6:eq(0)');
      $("#tbllapBulan").DataTable({
        "responsive": false, "lengthChange": false, "autoWidth": true,
        "language": {
            "paginate": {
                "next": ">",
                "previous": "<"
            },
        }
      }).buttons().container().appendTo('#tabelguru_wrapper .col-md-6:eq(0)');
    });
  });
</script>

<script>
    $(function () {
      $('.select2').select2({
        theme: 'bootstrap4'
      })
  })
</script>

<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>

<script>
  $(document).ready(function(){
    $('#kelas').change(function(){
      var kelas = $(this).val();
      var date = $('#date').val()
      var hari = new Date(date).getDay();

      $.ajax({
        url: '<?php echo site_url(); ?>admin/data_jadwal',
        type: 'post',
        data: {kelas:kelas, date:date, hari:hari},
        dataType: 'json',
        success: function(data)
        {
          $('#dataguru').html(data);
        },
        error:function()
        {
          alert(''+ hari +' '+ kelas);
        }
      })
    });
  });
</script>

<script>
  $(document).ready(function(){
    $('#hari').change(function(){
      var hari = $(this).val();

      $.ajax({
        url: '<?php echo site_url(); ?>admin/data_jadwal_gurupiket',
        type: 'post',
        data: {hari:hari},
        dataType: 'json',
        success: function(data)
        {
          $('#datajadwalgp').html(data);
        },
        error:function()
        {
          alert(''+ hari);
        }
      })
    });
  });
</script>

</body>
</html>