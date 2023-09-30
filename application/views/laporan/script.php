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
<!-- Toastr -->
<script src="<?= base_url()?>assets/plugins/toastr/toastr.min.js"></script>

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
    $(function () {
      $("#tbllaporanBulan").DataTable({
        "responsive": false, "lengthChange": false, "autoWidth": true,
        "language": {
            "paginate": {
                "next": ">",
                "previous": "<"
            },
        }
      });
    });
  });
</script>

<script>
  $(document).ready(function () {
    $(".open-modal").click(function () {
      var kelas = $(this).data("kelas");
      var tanggal = $(this).data("tanggal");
      var gambarURL = "<?php echo base_url('assets/bukti'); ?>/" + kelas + "-" + tanggal + ".jpg";
      $("#gambarPreview").attr("src", gambarURL);
      $("#gambarModal").modal("show");
    });
  });
</script>

<script>
  $(document).ready(function(){

    $('#bulan').change(function(){
      var bulan = $('#bulan').val();
      var kelas = $('#kelas').val();
      var selectedDate = new Date($('#bulan').val() + "-01");
      var selectedMonth = selectedDate.getMonth() + 1;

      document.getElementById('hiddenMonth').value = selectedMonth;
      document.getElementById('hiddenClass').value = kelas;
      document.getElementById('exportButton').disabled = false;

      $.ajax({
        url: '<?php echo site_url(); ?>laporan/cetak_laporan_siswa',
        type: 'post',
        data: {kelas:kelas, selectedMonth:selectedMonth},
        //dataType: 'json',
        success: function(data)
        {
          $('#laporanBulanSiswa').html(data);
        },
        error: function (xhr, status, error) {
          console.error('Terjadi kesalahan:');
          console.error('Status error: ' + status);
          console.error('Error: ' + error);
          console.error('Bulan yang dipilih: ' + selectedMonth);
          console.error('Kelas: ' + kelas);

          // Jika Anda ingin menampilkan juga pesan kesalahan dalam bentuk pop-up alert, Anda bisa menambahkannya seperti ini:
          alert('Terjadi kesalahan: ' + selectedMonth + ' kelas: ' + kelas);
        }
      })
    });
  });
</script>

<script>
  $(document).ready(function(){

    $('#dateb').change(function(){
      var dateb = $('#dateb').val();
      var selectedDate = new Date($('#dateb').val() + "-01");
      var selectedMonth = selectedDate.getMonth() + 1;

      document.getElementById('hiddenMonth').value = selectedMonth;
      document.getElementById('exportButton').disabled = false;

      $.ajax({
        url: '<?php echo site_url(); ?>laporan/cetak_laporan',
        type: 'post',
        data: {selectedMonth:selectedMonth},
        //dataType: 'json',
        success: function(data)
        {
          $('#laporanBulan').html(data);
          $("#tbllapBulan").DataTable({
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
    $('#lapHari').change(function(){

      var date = $(this).val();

      $.ajax({
        url: '<?php echo site_url(); ?>laporan/jumlah_kelas_sudah_absen/' + date,
        type: 'GET',
        data: { date: date },
        success: function(result) {
          var infoLaporan = parseInt(result) + " Kelas Belum Absen";
          $('#infoLaporan').val(infoLaporan);
        }
      });

      $.ajax({
        url: '<?php echo site_url(); ?>laporan/laporanHari',
        type: 'post',
        data: {date:date},
        dataType: 'json',
        success: function(data)
        {
          $('#laporanHari').html(data);
        },
        error:function()
        {
          alert(''+ date);
        }
      })
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

</body>
</html>