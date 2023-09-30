<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Laporan extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->model('mlaporan');
      $this->load->model('mabsensi');
    }
  
    public function jumlah_kelas_sudah_absen($tanggal)
    {
      $date = $this->input->get('date');

      $result = $this->mabsensi->jumlah_kelas() - $this->mabsensi->j_kelas_sudah_absen($date);
      
      echo $result;
    }

    public function laporanHari()
    {
      $tanggal = $_POST['date'];
      $data = '';
      $kelas = $this->mlaporan->kelas_sudah_absen($tanggal);
      foreach ($kelas as $row) 
      {
            $data .='<div class="card card-default">
                  <div class="container-fluid">
                    <div style="text-align:center" class="card-header">
                      <h3 class="card-title">';
            $data .= $row->kelas;
            
            $data .='</h3>
                    <div class="card-tools">
                      <a href="' . site_url('laporan/lihat_bukti/' . str_replace(' ', '-', $row->kelas) . '/' . $tanggal) . '" class="btn btn-tool">
                          <i class="fas fa-file-image"></i>
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
                      <tbody>';
            $no = 1;
            $absensi_kelas = $this->mlaporan->absensi_harian($row->kelas, $tanggal);
            foreach ($absensi_kelas as $laporan) 
            {
                  $data .= '<tr><td>';
                  $data .= $no++;
                  $data .= '</td><td>';
                  $data .= $laporan->nama_guru;
                  $data .= '</td><td>';
                  $data .= $laporan->status_absen;
                  $data .= '</td><td>';
                  $data .= $laporan->keterangan;
                  $data .= '</td></tr>';
              }
              $data .= '</tbody></table></div></div></div>';
      }
      echo json_encode($data);
    }

    public function cetak_laporan_siswa()
    {
      $bulan = $_POST['selectedMonth'];
      $kelas = $_POST['kelas'];
      $namaBulan = date('F', mktime(0, 0, 0, $bulan, 1));

      $data = '';
      $data .= '<div class="container-fluid">
          <div style="text-align:center" class="card-header">
            <h3 class="card-title">Data Kehadiran Siswa - ';
      $data .= $namaBulan;
      $data .= '</h3>
          </div>
          <br>
          <table id="tbllapBulan" style="border-collapse: collapse; width:100%" class="table table-hover table-bordered custom-td">';
      $data .= '<thead class="bg-info">
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
                </thead>';
      $data .= '<tbody>';
      $no = 1; 
      $kelass = $this->mlaporan->get_data_siswa($kelas);
      foreach ($kelass as $row) 
      {
        $data .= '<tr>';
        $data .= '<td style="vertical-align : middle; text-align: center;">'. $no++ .'</td>';
        $data .= '<td >'. $row->nama_siswa .'</td>';
        $absensi_data = $this->mlaporan->getAbsensiSiswaByMonth($bulan, $row->nama_siswa);

        foreach ($absensi_data as $row) 
        {
          $total_kehadiran = $row->total_hadir + $row->total_sakit + $row->total_izin + $row->total_alpa;
          $data .= '<td style="vertical-align : middle; text-align: center;">' . $total_kehadiran .'</td>';
          $data .= '<td style="vertical-align : middle; text-align: center;">' . $row->total_hadir .'</td>';
          $data .= '<td style="vertical-align : middle; text-align: center;">'. $row->total_sakit .'</td>';
          $data .= '<td style="vertical-align : middle; text-align: center;">'. $row->total_izin .'</td>';
          $data .= '<td style="vertical-align : middle; text-align: center;">'. $row->total_alpa .'</td>';
          if ($total_kehadiran > 0) 
          {
              $persentasi_kehadiran = ($row->total_hadir / $total_kehadiran) * 100;
              $formatted_persentasi = number_format($persentasi_kehadiran);
              $data .= '<td style="vertical-align : middle; text-align: center;">'. $formatted_persentasi .'%</td>';
          } else {
              $data .= '<td style="vertical-align : middle; text-align: center;">-</td>';
          } 
          
        }

        $data .= '</tr>';
      }
      $data .= '</tbody></table><br></div>';
      echo $data;
    }

    public function exportToExcel_siswa() {
      $bulan = $this->input->post('bulan');
      $kelas = $this->input->post('kelas');
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $lastColumn = 'AM';
      $lastRow = 155;
      $sheet->getStyle('B4:' . $lastColumn . $lastRow)->applyFromArray([
          'borders' => ['allBorders' => ['borderStyle' => 'thin']],
      ]);

      $sheet->mergeCells('B2:AN2');
      $sheet->setCellValue('B2', 'Data laporan absensi siswa ' .$kelas);
      $sheet->getStyle('B2')->getFont()->setBold(true);

      $sheet->mergeCells('B4:B5');
      $sheet->setCellValue('B4', 'NO');
      $sheet->getStyle('B4')->getAlignment()->setHorizontal('center');
      $sheet->getColumnDimension('B')->setWidth(4);
      $sheet->getStyle('B4:B5')->applyFromArray([
          'alignment' => ['vertical' => 'center'],
      ]);

      $sheet->mergeCells('C4:C5');
      $sheet->getColumnDimension('C')->setWidth(30);
      $sheet->setCellValue('C4', 'Nama');
      $sheet->getStyle('C4:C5')->applyFromArray([
          'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
      ]);

      $sheet->mergeCells('D4:AH4');
      $sheet->setCellValue('D4', 'Bulan : ' . date('F', mktime(0, 0, 0, $bulan, 1)));

      $dates = range(1, 31);
      $col = 'D';
      
      foreach ($dates as $date) 
      {
        $dayOfWeek = date('N', strtotime("2023-$bulan-$date"));

        $isWeekend = ($dayOfWeek == 6 || $dayOfWeek == 7); 

        $style = [];
        if ($isWeekend) {
            $style = [
              'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'c72828']
              ]
            ];
        }
    
        $sheet->setCellValue($col . '5', $date);
        $sheet->getStyle($col . '5')->applyFromArray($style);

        $alignment = $sheet->getStyle($col)->getAlignment();

        $alignment->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $alignment->setVertical(Alignment::VERTICAL_CENTER);

        $absensi_data = $this->mlaporan->getAbsensiSiswaByDate($date, $bulan, $kelas);

        $rowNumber = 6;
        foreach ($absensi_data as $absensi) 
        {
            $absenText = '-';
            $fillColor = null;

            if ($absensi->hadir > 0) 
            {
              $absenText = 'H';
              $fillColor = '179c30';
            } 
            elseif ($absensi->sakit > 0) 
            {
                $absenText = 'S';
                $fillColor = 'f0d613';
            } 
            elseif ($absensi->izin > 0) 
            {
                $absenText = 'I';
                $fillColor = '15b5d1';
            } 
            elseif ($absensi->alpa > 0) 
            {
                $absenText = 'A';
                $fillColor = 'a30d05';
            }

            $sheet->setCellValue($col . $rowNumber, $absenText);

            if ($fillColor) {
              $sheet->getStyle($col . $rowNumber)->applyFromArray([
                  'fill' => [
                      'fillType' => Fill::FILL_SOLID,
                      'startColor' => [
                          'rgb' => $fillColor,
                      ],
                  ],
              ]);
            }

            $rowNumber++;
        }

        $sheet->getColumnDimension($col)->setWidth(4);
        $col++;
          
      }

      $sheet->mergeCells('AI4:AL4');
      $sheet->setCellValue('AI4', 'Rekap absensi');
      $sheet->getStyle('AI4:AL4')->applyFromArray([
          'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
      ]);

      $sheet->setCellValue('AI5', 'H');
      $sheet->setCellValue('AJ5', 'S');
      $sheet->setCellValue('AK5', 'I');
      $sheet->setCellValue('AL5', 'A');

      $sheet->getStyle('AI5:AL5')->applyFromArray([
          'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
      ]);

      $sheet->getColumnDimension('AI')->setWidth(4);
      $sheet->getColumnDimension('AJ')->setWidth(4);
      $sheet->getColumnDimension('AK')->setWidth(4);
      $sheet->getColumnDimension('AL')->setWidth(4);

      $absensi_data = $this->mlaporan->getDataLaporanSiswa($bulan, $kelas);
      $rowNumber = 6;
      $no = 1;
      foreach ($absensi_data as $absensi) 
      {
          $sheet->setCellValue('B' . $rowNumber, $no++);
          $sheet->setCellValue('C' . $rowNumber, $absensi->nama_siswa);

          $sheet->setCellValue('AI' . $rowNumber, $absensi->total_hadir);
          $sheet->setCellValue('AJ' . $rowNumber, $absensi->total_sakit);
          $sheet->setCellValue('AK' . $rowNumber, $absensi->total_izin);
          $sheet->setCellValue('AL' . $rowNumber, $absensi->total_alpa);

          $sheet->getStyle('AI' .$rowNumber. ':AL' .$rowNumber. '')->applyFromArray([
              'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
          ]);

          $total_kehadiran = $absensi->total_hadir + $absensi->total_sakit + $absensi->total_izin + $absensi->total_alpa;

          // Hitung persentasi kehadiran
          if ($total_kehadiran > 0) {
              $persentasi_kehadiran = ($absensi->total_hadir / $total_kehadiran) * 100;
              $formatted_persentasi = number_format($persentasi_kehadiran);
              $sheet->setCellValue('AM' . $rowNumber, $formatted_persentasi . '%');
          } else {
              $formatted_persentasi = '-';
          }

          $sheet->getStyle('AM' .$rowNumber. ':AN' .$rowNumber. '')->applyFromArray([
              'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
          ]);

          $rowNumber++;
      }

      $sheet->mergeCells('AM4:AM5');
      $sheet->getColumnDimension('AM')->setWidth(15);
      $sheet->setCellValue('AM4', '(%) Kehadiran');
      $sheet->getStyle('AM4:AM5')->applyFromArray([
          'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
      ]);

      $sheet->setTitle("Laporan Data Absensi Siswa");

      $namaBulan = date('F', mktime(0, 0, 0, $bulan, 1));
      $namaFile = "Rekap Absensi $kelas - $namaBulan.xlsx";

      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="' . $namaFile . '"');

      header('Cache-Control: max-age=0');
      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');
        
    }

    public function cetak_laporan()
    {
      $bulan = $_POST['selectedMonth'];
      $namaBulan = date('F', mktime(0, 0, 0, $bulan, 1));

      $guru = $this->db->get('tb_guru')->result();

      $data = '';
      $data .= '<div class="container-fluid">
          <div style="text-align:center" class="card-header">
            <h3 class="card-title">Data Kehadiran Guru - ';
      $data .= $namaBulan;
      $data .= '</h3>
          </div>
          <br>
          <table id="tbllapBulan" style="border-collapse: collapse; width:100%" class="table table-hover table-bordered custom-td">';
      $data .= '<thead class="bg-info">
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
                </thead>';
      $data .= '<tbody>';
      $no = 1; 
      $guru = $this->mlaporan->get_data_guru();
      $absensi_data = $this->mlaporan->getLaporanData($bulan);
      foreach ($absensi_data as $row) 
      {
        $data .= '<tr>';
        $data .= '<td style="vertical-align : middle; text-align: center;">'. $no++ .'</td>';
        $data .= '<td >'. $row->nama_guru .'</td>';
        $total_kehadiran = $row->total_hadir + $row->total_sakit + $row->total_izin + $row->total_alpa;
        $data .= '<td style="vertical-align : middle; text-align: center;">' . $total_kehadiran .'</td>';
        $data .= '<td style="vertical-align : middle; text-align: center;">' . $row->total_hadir .'</td>';
        $data .= '<td style="vertical-align : middle; text-align: center;">'. $row->total_sakit .'</td>';
        $data .= '<td style="vertical-align : middle; text-align: center;">'. $row->total_izin .'</td>';
        $data .= '<td style="vertical-align : middle; text-align: center;">'. $row->total_alpa .'</td>';
        if ($total_kehadiran > 0) 
        {
            $persentasi_kehadiran = ($row->total_hadir / $total_kehadiran) * 100;
            $formatted_persentasi = number_format($persentasi_kehadiran);
            $data .= '<td style="vertical-align : middle; text-align: center;">'. $formatted_persentasi .'%</td>';
        } else {
            $data .= '<td style="vertical-align : middle; text-align: center;">-</td>';
        } 

        $data .= '</tr>';
      }
      $data .= '</tbody></table><br></div>';
      echo $data;
    }

    public function exportToExcel() {
      $bulan = $this->input->post('bulan');
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $lastColumn = 'AN';
      $lastRow = 155;
      $sheet->getStyle('B4:' . $lastColumn . $lastRow)->applyFromArray([
          'borders' => ['allBorders' => ['borderStyle' => 'thin']],
      ]);

      $sheet->mergeCells('B2:AN2');
      $sheet->setCellValue('B2', 'Data laporan absensi guru');
      $sheet->getStyle('B2')->getFont()->setBold(true);

      $sheet->mergeCells('B4:B5');
      $sheet->setCellValue('B4', 'NO');
      $sheet->getStyle('B4')->getAlignment()->setHorizontal('center');
      $sheet->getColumnDimension('B')->setWidth(4);
      $sheet->getStyle('B4:B5')->applyFromArray([
          'alignment' => ['vertical' => 'center'],
      ]);

      $sheet->mergeCells('C4:C5');
      $sheet->getColumnDimension('C')->setWidth(30);
      $sheet->setCellValue('C4', 'Nama');
      $sheet->getStyle('C4:C5')->applyFromArray([
          'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
      ]);

      $sheet->mergeCells('D4:AH4');
      $sheet->setCellValue('D4', 'Bulan : ' . date('F', mktime(0, 0, 0, $bulan, 1)));

      $dates = range(1, 31);
      $col = 'D';
      
      foreach ($dates as $date) 
      {
        $dayOfWeek = date('N', strtotime("2023-$bulan-$date"));

        $isWeekend = ($dayOfWeek == 6 || $dayOfWeek == 7); 

        $style = [];
        if ($isWeekend) {
            $style = [
              'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'c72828']
              ]
            ];
        }
    
        $sheet->setCellValue($col . '5', $date);
        $sheet->getStyle($col . '5')->applyFromArray($style);

        $alignment = $sheet->getStyle($col)->getAlignment();

        $alignment->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $alignment->setVertical(Alignment::VERTICAL_CENTER);

        $absensi_data = $this->mlaporan->getAbsensiDataByDate($date, $bulan);

        $rowNumber = 6;
        foreach ($absensi_data as $absensi) 
        {
            $absenText = '-';
            $fillColor = null;

            if ($absensi->hadir > 0) 
            {
              $absenText = 'H';
              $fillColor = '179c30';
            } 
            elseif ($absensi->sakit > 0) 
            {
                $absenText = 'S';
                $fillColor = 'f0d613';
            } 
            elseif ($absensi->izin > 0) 
            {
                $absenText = 'I';
                $fillColor = '15b5d1';
            } 
            elseif ($absensi->alpa > 0) 
            {
                $absenText = 'A';
                $fillColor = 'a30d05';
            }

            $sheet->setCellValue($col . $rowNumber, $absenText);

            if ($fillColor) {
              $sheet->getStyle($col . $rowNumber)->applyFromArray([
                  'fill' => [
                      'fillType' => Fill::FILL_SOLID,
                      'startColor' => [
                          'rgb' => $fillColor,
                      ],
                  ],
              ]);
            }

            $rowNumber++;
        }

        $sheet->getColumnDimension($col)->setWidth(4);
        $col++;
          
      }

      $sheet->mergeCells('AI4:AL4');
      $sheet->setCellValue('AI4', 'Rekap absensi');
      $sheet->getStyle('AI4:AL4')->applyFromArray([
          'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
      ]);

      $sheet->setCellValue('AI5', 'H');
      $sheet->setCellValue('AJ5', 'S');
      $sheet->setCellValue('AK5', 'I');
      $sheet->setCellValue('AL5', 'A');

      $sheet->getStyle('AI5:AL5')->applyFromArray([
          'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
      ]);

      $sheet->getColumnDimension('AI')->setWidth(4);
      $sheet->getColumnDimension('AJ')->setWidth(4);
      $sheet->getColumnDimension('AK')->setWidth(4);
      $sheet->getColumnDimension('AL')->setWidth(4);

      $absensi_data = $this->mlaporan->getLaporanData($bulan);
      $rowNumber = 6;
      $no = 1;
      foreach ($absensi_data as $absensi) 
      {
          $sheet->setCellValue('B' . $rowNumber, $no++);
          $sheet->setCellValue('C' . $rowNumber, $absensi->nama_guru);

          $sheet->setCellValue('AI' . $rowNumber, $absensi->total_hadir);
          $sheet->setCellValue('AJ' . $rowNumber, $absensi->total_sakit);
          $sheet->setCellValue('AK' . $rowNumber, $absensi->total_izin);
          $sheet->setCellValue('AL' . $rowNumber, $absensi->total_alpa);

          $sheet->getStyle('AI' .$rowNumber. ':AL' .$rowNumber. '')->applyFromArray([
              'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
          ]);

          $total_kehadiran = $absensi->total_hadir + $absensi->total_sakit + $absensi->total_izin + $absensi->total_alpa;

          // Hitung persentasi kehadiran
          if ($total_kehadiran > 0) {
              $persentasi_kehadiran = ($absensi->total_hadir / $total_kehadiran) * 100;
              $formatted_persentasi = number_format($persentasi_kehadiran);
              $sheet->setCellValue('AN' . $rowNumber, $formatted_persentasi . '%');
          } else {
              $formatted_persentasi = '-';
          }

          $sheet->setCellValue('AM' . $rowNumber, $total_kehadiran);
          
          $sheet->getStyle('AM' .$rowNumber. ':AN' .$rowNumber. '')->applyFromArray([
              'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
          ]);

          $rowNumber++;
      }

      $sheet->mergeCells('AM4:AM5');
      $sheet->getColumnDimension('AM')->setWidth(15);
      $sheet->setCellValue('AM4', 'Total Kerja');
      $sheet->getStyle('AM4:AM5')->applyFromArray([
          'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
      ]);

      $sheet->mergeCells('AN4:AN5');
      $sheet->getColumnDimension('AN')->setWidth(15);
      $sheet->setCellValue('AN4', '(%) Kehadiran');
      $sheet->getStyle('AN4:AN5')->applyFromArray([
          'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
      ]);

      $sheet->setTitle("Laporan Data Absensi Guru");

      $namaBulan = date('F', mktime(0, 0, 0, $bulan, 1));
      $namaFile = "Rekap Absensi - $namaBulan.xlsx";

      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="' . $namaFile . '"');

      header('Cache-Control: max-age=0');
      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');
        
    }
}