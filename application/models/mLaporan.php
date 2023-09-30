<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mLaporan extends CI_Model {

   public function kelas_sudah_absen($tanggal)
   {
      $this->db->distinct();
      $this->db->select('kelas');
      $this->db->where('tanggal', $tanggal);
      $this->db->group_by('kelas');
      $this->db->order_by('kelas', 'ASC');
      return $this->db->get('tb_absensi')->result();
   }

   public function get_data_guru()
   {
     return $this->db->get('tb_guru')->result();
   }

   public function get_data_siswa($kelas)
   {
    $this->db->where('nama_kelas', $kelas);
    return $this->db->get('tb_siswa')->result();
   }

   public function absensi_harian($kelas, $tanggal)
   {
     $this->db->where('kelas', $kelas);
     $this->db->where('tanggal', $tanggal);
     return $this->db->get('tb_absensi')->result();
   }

   public function absensi_harian_siswa($kelas, $tanggal)
   {
     $this->db->where('kelas', $kelas);
     $this->db->where('tanggal', $tanggal);
     return $this->db->get('tb_absensi_siswa')->result();
   }

   public function getAbsensiSiswaByMonth($bulan, $siswa)
  {
    $query = "SELECT nama_siswa,
        SUM(CASE WHEN status_absen = 'Hadir' THEN 1 ELSE 0 END) AS total_hadir,
        SUM(CASE WHEN status_absen = 'Sakit' THEN 1 ELSE 0 END) AS total_sakit,
        SUM(CASE WHEN status_absen = 'Ijin' THEN 1 ELSE 0 END) AS total_izin,
        SUM(CASE WHEN status_absen = 'Alpa' THEN 1 ELSE 0 END) AS total_alpa,
        GROUP_CONCAT(keterangan) AS keterangan
        FROM tb_absensi_siswa
        WHERE MONTH(tanggal) = '$bulan'
        AND nama_siswa = '$siswa'";

    return $this->db->query($query)->result();
  }

  public function getAbsensiSiswaByDate($tanggal, $bulan, $kelas) {

    $query = "SELECT dg.nama_siswa,
        SUM(CASE WHEN da.status_absen = 'Hadir' THEN 1 ELSE 0 END) AS hadir,
        SUM(CASE WHEN da.status_absen = 'Sakit' THEN 1 ELSE 0 END) AS sakit,
        SUM(CASE WHEN da.status_absen = 'Ijin' THEN 1 ELSE 0 END) AS izin,
        SUM(CASE WHEN da.status_absen = 'Alpa' THEN 1 ELSE 0 END) AS alpa
    FROM tb_siswa dg 
    LEFT JOIN tb_absensi_siswa da ON dg.nama_siswa = da.nama_siswa AND DAY(da.tanggal) = '$tanggal' AND MONTH(da.tanggal) = '$bulan'
    WHERE dg.nama_kelas = '$kelas'
    GROUP BY dg.id";

    return $this->db->query($query)->result();
    }

    public function getAbsensiDataByDate($tanggal, $bulan) {

        $query = "SELECT
            dg.nama_guru,
            SUM(CASE WHEN selected_da.max_priority = 4 THEN 1 ELSE 0 END) AS hadir,
            SUM(CASE WHEN selected_da.max_priority = 3 THEN 1 ELSE 0 END) AS sakit,
            SUM(CASE WHEN selected_da.max_priority = 2 THEN 1 ELSE 0 END) AS izin,
            SUM(CASE WHEN selected_da.max_priority = 1 THEN 1 ELSE 0 END) AS alpa
        FROM tb_guru dg
        LEFT JOIN (
            SELECT
                nama_guru,
                MAX(CASE
                    WHEN status_absen = 'Hadir' THEN 4
                    WHEN status_absen = 'Sakit' THEN 3
                    WHEN status_absen = 'Ijin' THEN 2
                    ELSE 1
                END) AS max_priority
            FROM tb_absensi
            WHERE DAY(tanggal) = '$tanggal' AND MONTH(tanggal) = '$bulan'
            GROUP BY nama_guru
        ) AS selected_da ON dg.nama_guru = selected_da.nama_guru
        GROUP BY dg.nama_guru";

        return $this->db->query($query)->result();
    }

    public function getAbsensiDataByMonth($bulan, $guru)
    {
        $query = "SELECT nama_guru,
         SUM(CASE WHEN status_absen = 'Hadir' THEN 1 ELSE 0 END) AS total_hadir,
         SUM(CASE WHEN status_absen = 'Sakit' THEN 1 ELSE 0 END) AS total_sakit,
         SUM(CASE WHEN status_absen = 'Ijin' THEN 1 ELSE 0 END) AS total_izin,
         SUM(CASE WHEN status_absen = 'Alpa' THEN 1 ELSE 0 END) AS total_alpa,
         GROUP_CONCAT(keterangan) AS keterangan
         FROM tb_absensi
         WHERE MONTH(tanggal) = '$bulan'
         AND nama_guru = '$guru'";

     return $this->db->query($query)->result();
    }

    public function getLaporanData($bulan)
    {
        $query = "SELECT
            dg.nama_guru,
            SUM(CASE WHEN selected_da.max_priority = 4 THEN 1 ELSE 0 END) AS total_hadir,
            SUM(CASE WHEN selected_da.max_priority = 3 THEN 1 ELSE 0 END) AS total_sakit,
            SUM(CASE WHEN selected_da.max_priority = 2 THEN 1 ELSE 0 END) AS total_izin,
            SUM(CASE WHEN selected_da.max_priority = 1 THEN 1 ELSE 0 END) AS total_alpa
        FROM tb_guru dg
        LEFT JOIN (
            SELECT
                nama_guru,
                MAX(CASE
                    WHEN status_absen = 'Hadir' THEN 4
                    WHEN status_absen = 'Sakit' THEN 3
                    WHEN status_absen = 'Ijin' THEN 2
                    ELSE 1
                END) AS max_priority
            FROM (
                SELECT DISTINCT nama_guru, tanggal, status_absen
                FROM tb_absensi
            ) AS distinct_absensi
            WHERE MONTH(tanggal) = '$bulan'
            GROUP BY nama_guru, tanggal
        ) AS selected_da ON dg.nama_guru = selected_da.nama_guru
        GROUP BY dg.nama_guru";

        return $this->db->query($query)->result();
    }

    public function count($absensiData)
    {
        $countData = array(
            'total_hadir' => 0,
            'total_sakit' => 0,
            'total_izin' => 0,
            'total_alpa' => 0
        );

        foreach ($absensiData as $absen) {
            $countData['total_hadir'] += $absen->hadir;
            $countData['total_sakit'] += $absen->sakit;
            $countData['total_izin'] += $absen->izin;
            $countData['total_alpa'] += $absen->alpa;
        }

        return $countData;
    }

    public function getDataLaporanSiswa($bulan, $kelas)
    {
        $query = "SELECT dg.nama_siswa,
            SUM(CASE WHEN da.status_absen = 'Hadir' THEN 1 ELSE 0 END) AS total_hadir,
            SUM(CASE WHEN da.status_absen = 'Sakit' THEN 1 ELSE 0 END) AS total_sakit,
            SUM(CASE WHEN da.status_absen = 'Ijin' THEN 1 ELSE 0 END) AS total_izin,
            SUM(CASE WHEN da.status_absen = 'Alpa' THEN 1 ELSE 0 END) AS total_alpa,
            GROUP_CONCAT(da.keterangan) AS keterangan
        FROM tb_siswa dg
        LEFT JOIN tb_absensi_siswa da ON dg.nama_siswa = da.nama_siswa AND MONTH(da.tanggal) = '$bulan'
        WHERE dg.nama_kelas = '$kelas'
        GROUP BY dg.id";

        return $this->db->query($query)->result();
    }
}