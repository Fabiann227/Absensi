<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Absensi Pulang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Absensi Pulang</li>
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
                    <h3 class="card-title">Tunjukkan Qr Disini</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card_widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="scan-message" style="color: red;"></div>
                    <label for="uploadfile">PPLG Corp.</label>
                    <div id="error-message" style="color: red;"></div>
                    <div id="scan-message" style="color: red;"></div>
                    <main>
                        <div id="reader"></div>
                        <div id="result"></div>
                    </main>
                </div>
                <div class="card-footer">
                    <button class="tesbut" onclick="startScan()">Mulai Pemindaian QR</button>
                    <br>
                    <!-- Tambahkan tombol refresh -->
                    <button class="tesbut" onclick="refreshPage()">Scan Lagi?</button>
                </div>
            </div>
            <form action="<?php echo site_url() ?>admin/input_absen" method="post">
                <div class="card card-default table-responsive" id="dataguru">
                    <div class="card-header">
                        <h3 class="card-title">Keterangan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                function tgl_indo($tanggal){
                  $bulan = array (
                    1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                  );
                  $pecahkan = explode('-', $tanggal);
                  
                  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                }
                ?>
                                <table>
                                    <tr>
                                        <td style="padding-right: 20px">Nama Guru</td>
                                        <td>:</td>
                                        <td style="padding-left: 10px">
                                            <div id="Name_Guru"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td style="padding-left: 10px">
                                            <div id="Status_Absen"></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card -->
        </div><!-- /.container-fluid -->

        </form>
</div>
</section>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"
    integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
.tesbut {
    display: inline-block;
    outline: 0;
    cursor: pointer;
    padding: 5px 16px;
    font-size: 14px;
    font-weight: 500;
    line-height: 20px;
    vertical-align: middle;
    border: 1px solid;
    border-radius: 6px;
    color: #24292e;
    background-color: #fafbfc;
    border-color: #1b1f2326;
    box-shadow: rgba(27, 31, 35, 0.04) 0px 1px 0px 0px, rgba(255, 255, 255, 0.25) 0px 1px 0px 0px inset;
    transition: 0.2s cubic-bezier(0.3, 0, 0.5, 1);
    transition-property: color, background-color, border-color;
}

.tesbut:hover {
    background-color: #f3f4f6;
    border-color: #1b1f2326;
    transition-duration: 0.1s;
}
</style>
<script>
let scanner;

function checkTime() {
    const now = new Date();
    const currentHour = now.getHours();
    const currentMinute = now.getMinutes();

    // Batas waktu untuk pagi (7 pagi sampai 9 pagi)
    const morningStart = 7;
    const morningEnd = 9;

    // Batas waktu untuk sore (14 siang sampai 17 sore)
    const afternoonStart = 15;
    const afternoonEnd = 17;

    // Memeriksa apakah waktu saat ini berada dalam batas waktu yang diizinkan
    if ((currentHour >= morningStart && currentHour <= morningEnd) ||
        (currentHour >= afternoonStart && currentHour <= afternoonEnd)) {
        // Waktu mencukupi, hilangkan pesan kesalahan
        document.getElementById('scan-message').innerHTML = "";
        return true;
    } else {
        // Jika waktu saat ini di luar batas waktu yang diizinkan, tampilkan pesan kesalahan
        const errorMessage =
            `Absen Pulang hanya dapat dilakukan pada jam 15:00 - 17:00 sore. Sekarang jam ${currentHour}:${currentMinute}.`;
        document.getElementById('error-message').innerHTML = errorMessage;
        Swal.fire({
            icon: 'warning',
            title: 'Belum Waktu Absen 😊',
            text: errorMessage,
            showConfirmButton: false,
            timer: 2000
        });
        return false;
    }
}

// Fungsi pemindaian QR yang dipanggil saat tombol pemindaian QR ditekan
function startScan() {
    if (checkTime()) {
        // Memulai pemindaian QR hanya jika waktu mencukupi
        scanner = new Html5QrcodeScanner('reader', {
            qrbox: {
                width: 250,
                height: 250,
            },
            fps: 20,
        });

        scanner.render(success, error);
    }
}



function success(result) {
    try {
        const qrData = JSON.parse(result);
        const nama = qrData.nama_guru;
        const id = qrData.id_guru;

        // Menampilkan nama ke dalam elemen HTML
        document.getElementById('result').innerHTML = `
                <h2>Berhasil untuk absen!</h2>
            `;
        document.getElementById('Name_Guru').innerHTML = `
                ${nama}
            `;
        document.getElementById('Status_Absen').innerHTML = `
                Absen Pulang Berhasil
            `;

         Swal.fire({
            icon: 'success',
            title: 'Terima Kasih!! 👌',
            text: "Absen Pulang Telah Berhasil",
            showConfirmButton: false,
            timer: 2000
        });

        scanner.clear();
        document.getElementById('reader').remove();

        // Deklarasikan data yang akan dikirim
        var data = {
            id: id,
            nama: nama
        };

        // Kirim data ke PHP menggunakan XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", window.location.href, true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Response dari server (PHP) jika diperlukan
                console.log('Data berhasil dikirim.');
            } else {
                // Penanganan kesalahan jika terjadi
                console.error("Terjadi kesalahan: " + xhr.status);
            }
        };

        // Mengubah objek JavaScript menjadi JSON dan kirimkan
        var json = JSON.stringify(data);
        xhr.send(json);
    } catch (error) {
        console.error('Gagal mengurai hasil QR code:', error);
    }
}

function error(err) {
    console.error(err);
    // Prints any errors to the console
}

function refreshPage() {
    location.reload(); // Reload halaman
}
</script>



<?php
$conn = new mysqli('localhost', 'root', '', 'absen');
$date_info = getdate();
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah ada data yang dikirimkan dari JavaScript
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Terima data dari JavaScript
    $data = json_decode(file_get_contents("php://input"));

    $id_guru = $data->id;
    $nama = $data->nama; // Menggunakan $pelajaran bukan $email

    $currentDate = date("Y-m-d"); // Get the current date in YYYY-MM-DD format
    $sql = "INSERT INTO `tb_absensi_guru` (`tanggal`, `nama_guru`, `status_absen`, `keterangan`) VALUES ('$currentDate', '$nama', 'Hadir', 'Absensi Pulang');";
    

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
