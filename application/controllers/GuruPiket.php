<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gurupiket extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('minputdata');
		$this->load->model('mabsensi');
		$this->load->model('mlaporan');
		$this->load->helper('form');
    	$this->load->helper('url');
		$this->load->library('session');
	}

	public function index()
	{
		if ($this->session->userdata('role') != 'Guru Piket') {
			redirect('','refresh');
		}

		$data['gurupiket'] = $this->mabsensi->jumlah_users('Guru Piket');
		$data['guru'] = $this->mabsensi->jumlah_guru();
		$data['kelas'] = $this->mabsensi->jumlah_kelas();
		$data['sudah_absen'] = $this->mabsensi->j_kelas_sudah_absen(TODAY_DATE);
		$data['jadwal'] = $this->mabsensi->jumlah_jadwal();
		$data['guruAlpa'] = $this->mabsensi->GuruAlpa(TODAY_DATE);

		$this->load->view('guru_piket/layouts/meta');
		$this->load->view('guru_piket/layouts/navbar');
		$this->load->view('guru_piket/layouts/sidebar');
		$this->load->view('guru_piket/dashboard', $data);
		$this->load->view('guru_piket/layouts/footer');
		$this->load->view('guru_piket/layouts/script');
	}

	public function input_absensi()
	{
		if ($this->session->userdata('role') != 'Guru Piket') {
			redirect('','refresh');
		}

		$name = $this->session->userdata('nama');
		$data['kelas'] = $this->mabsensi->GetAllKelasBelumAbsen($name, TODAY_DATE);

		$this->load->view('guru_piket/layouts/meta');
		$this->load->view('guru_piket/layouts/navbar');
		$this->load->view('guru_piket/layouts/sidebar');
		$this->load->view('guru_piket/absen/input_absen', $data);
		$this->load->view('guru_piket/layouts/footer');
		$this->load->view('guru_piket/layouts/script');
	}

	public function absen_xi()
	{
		if ($this->session->userdata('role') != 'Guru Piket') {
			redirect('','refresh');
		}

		$tanggal = TODAY_DATE;
		$data['kelas'] = $this->mabsensi->GetKelasBelumAbsenA($tanggal);

		$this->load->view('guru_piket/layouts/meta');
		$this->load->view('guru_piket/layouts/navbar');
		$this->load->view('guru_piket/layouts/sidebar');
		$this->load->view('guru_piket/absen/input_absen', $data);
		$this->load->view('guru_piket/layouts/footer');
		$this->load->view('guru_piket/layouts/script');
	}

	public function absen_x()
	{
		if ($this->session->userdata('role') != 'Guru Piket') {
			redirect('','refresh');
		}

		$tanggal = TODAY_DATE;
		$data['kelas'] = $this->mabsensi->GetKelasBelumAbsen('X ', $tanggal);

		$this->load->view('guru_piket/layouts/meta');
		$this->load->view('guru_piket/layouts/navbar');
		$this->load->view('guru_piket/layouts/sidebar');
		$this->load->view('guru_piket/absen/input_absen', $data);
		$this->load->view('guru_piket/layouts/footer');
		$this->load->view('guru_piket/layouts/script');
	}

	public function laporan_hari()
    {
        if ($this->session->userdata('role') != 'Guru Piket') {
          redirect('','refresh');
        }

        $data['sudah_absen'] = $this->mabsensi->jumlah_kelas() - $this->mabsensi->j_kelas_sudah_absen(TODAY_DATE);

        $list_kelas_sudah_absen = $this->mlaporan->kelas_sudah_absen(TODAY_DATE);

        $data['kelas'] = $list_kelas_sudah_absen;

        $this->load->view('guru_piket/layouts/meta');
        $this->load->view('guru_piket/layouts/navbar');
        $this->load->view('guru_piket/layouts/sidebar');
        $this->load->view('laporan/hari', $data);
        $this->load->view('guru_piket/layouts/footer');
        $this->load->view('laporan/script');
    }

	public function laporan_hari_siswa()
    {
      if ($this->session->userdata('role') != 'Guru Piket') {
        redirect('','refresh');
      }

      $data['sudah_absen'] = $this->mabsensi->jumlah_kelas() - $this->mabsensi->j_kelas_sudah_absen(TODAY_DATE);

      $list_kelas_sudah_absen = $this->mlaporan->kelas_sudah_absen(TODAY_DATE);

      $data['kelas'] = $list_kelas_sudah_absen;

      $this->load->view('guru_piket/layouts/meta');
      $this->load->view('guru_piket/layouts/navbar');
      $this->load->view('guru_piket/layouts/sidebar');
      $this->load->view('laporan_siswa/hari', $data);
      $this->load->view('guru_piket/layouts/footer');
      $this->load->view('laporan/script');
    }

    public function laporan_bulan()
    {
        if ($this->session->userdata('role') != 'Guru Piket') {
          redirect('','refresh');
        }

        $this->load->view('guru_piket/layouts/meta');
        $this->load->view('guru_piket/layouts/navbar');
        $this->load->view('guru_piket/layouts/sidebar');
        $this->load->view('laporan/bulan');
        $this->load->view('guru_piket/layouts/footer');
        $this->load->view('laporan/script');
    }

	public function laporan_bulan_siswa()
    {
        if ($this->session->userdata('role') != 'Guru Piket') {
          redirect('','refresh');
        }

		$data['kelas'] = $this->minputdata->GetDataKelas();

        $this->load->view('guru_piket/layouts/meta');
        $this->load->view('guru_piket/layouts/navbar');
        $this->load->view('guru_piket/layouts/sidebar');
        $this->load->view('laporan_siswa/bulan', $data);
        $this->load->view('guru_piket/layouts/footer');
        $this->load->view('laporan/script');
    }

	public function show_siswa()
	{
		$kelas = $_POST['kelas'];
	    $tg = $_POST['date'];
	    $idhariini = $_POST['hari'];

	    $query = $this->db->get_where('tb_siswa', array('nama_kelas' => $kelas));
	    $data_siswa = $query->result();

		$data = '';
        $data .= '
                  <thead class="bg-info">
                    <tr>
                      <th style="width: 10px;">No</th>
                      <th style="width: 500px;">Nama</th>
                      <th style="width: 150px;">Status Absensi</th>
                      <th style="width: 250px;">Keterangan Lain</th>
                    </tr>
                  </thead>
                  <tbody>';
        $no = 1;
        foreach ($data_siswa as $query) {
          	$data .= '<input type="hidden" name="nama_siswa[]" value="'.$query->nama_siswa.'"> ';
        	$data .= '<tr><td>';
        	$data .= $no++;
        	$data .= '</td>';
        	$data .= '<td>';
        	$data .= $query->nama_siswa;
					$data .= '<td>';
        	$data .= '<select name="absen_s[]" id="absen_s" class="form-control">
						<option value="Hadir">Hadir</option>
						<option value="Sakit">Sakit</option>
						<option value="Ijin">Ijin</option>
						<option value="Alpa">Tidak Hadir</option>
					</select>';
        	$data .= '</td>';
        	$data .= '<td>';
        	$data .= '<input type="text" name="ket_lain_s[]" id="ket_lain_s" class="form-control">';
        	$data .= '</td></tr>';

        }
        $data .= '</tbody>';
        	
		echo json_encode($data);

	}

  	public function show_jadwal()
	{
		$kelas = $_POST['kelas'];
	    $tg = $_POST['date'];
	    $idhariini = $_POST['hari'];

	    function tgl_indo($tanggal){
			$nama_hari = array(
				'Sunday' => 'Minggu',
				'Monday' => 'Senin',
				'Tuesday' => 'Selasa',
				'Wednesday' => 'Rabu',
				'Thursday' => 'Kamis',
				'Friday' => 'Jumat',
				'Saturday' => 'Sabtu'
			);

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
			$hari = date('l', strtotime($tanggal));
		
			return $nama_hari[$hari] . ', ' . $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . '';
	    }

	    $query = $this->db->get_where('tb_jadwal', array('nama_kelas' => $kelas, 'id_hari' => $idhariini));
	    $jadwal_pelajaran = $query->result();

		$data = '';
		$data .= '<div class="card-header"><h3 class="card-title">Input Absensi</h3></div><div class="card-body">
            <div class="row">
              <div class="col-md-12">
              	<div class="table-responsive">
                <table>
                  <tr>
                    <td style="padding-right: 20px">Nama Kelas</td><td>:</td><td style="padding-left: 10px">';
        $data .= $kelas;
        $data .= '<input type="hidden" name="kelas" value="'.$kelas.'"> ';

        $data .= '<input type="hidden" name="date" value="'.$tg.'"> ';
        $data .= '</td>
                  </tr><tr><td>Tanggal</td><td>:</td><td style="padding-left: 10px">';
        $data .= tgl_indo($tg);
        $data .= '</td>
                  </tr>
                </table>
                <br>
				<p>Absensi Guru</p>
                <table class="table table-bordered custom-table">
                  <thead class="bg-info">
                    <tr>
                      <th style="width: 10px;">No</th>
                      <th style="width: 500px;">Nama</th>
                      <th style="width: 150px;">Status Absensi</th>
                      <th style="width: 250px;">Keterangan Lain</th>
                    </tr>
                  </thead>
                  <tbody>';
        $no = 1;
        foreach ($jadwal_pelajaran as $query) {
          	$data .= '<input type="hidden" name="nama_guru[]" value="'.$query->nama_guru.'"> ';
        	$data .= '<tr><td>';
        	$data .= $no++;
        	$data .= '</td>';
        	$data .= '<td>';
        	$data .= $query->nama_guru;
					$data .= '<td>';
        	$data .= '<select name="absen[]" id="absen" class="form-control">
						<option value="Hadir">Hadir</option>
						<option value="Sakit">Sakit</option>
						<option value="Ijin">Ijin</option>
						<option value="Alpa">Tidak Hadir</option>
					</select>';
        	$data .= '</td>';
        	$data .= '<td>';
        	$data .= '<input type="text" name="ket_lain[]" id="ket_lain" class="form-control">';
        	$data .= '</td></tr>';

        }
        $data .= '</tbody></table><p>Absensi Siswa</p><table class="table table-bordered custom-table" id="datasiswa"></table></div>';
        $data .= '</div></div></div></div>';
        $data .= '<button type="submit" class="btn btn-info">Input</button>';
        	
		echo json_encode($data);

	}

	function input_absen()
	{
		$kelas = $this->input->post('kelas');
		$tanggal = $this->input->post('date');

		$kls = str_replace(' ', '-', $kelas);

		$config['upload_path'] = FCPATH . 'assets/bukti/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 1048;
        $config['file_name'] = $kls . '-' . $tanggal;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('bukti')) {
            $error = $this->upload->display_errors();
        } else {
            $upload_data = $this->upload->data();
            $filename = $upload_data['file_name'];
        }

		if (!$this->mabsensi->absensi_exists($kelas, $tanggal)) 
		{
  		    $nama_guru = $this->input->post('nama_guru[]');
			$absen = $this->input->post('absen[]');
			$ket_lain = $this->input->post('ket_lain[]');

			$nama_siswa = $this->input->post('nama_siswa[]');
			$absen_s = $this->input->post('absen_s[]');
			$ket_lain_s = $this->input->post('ket_lain_s[]');

			$data = array();
			$data_s = array();
			$index = 0;
			$idx = 0;
			foreach ($absen as $data_absen) {

				array_push($data, array(
					'kelas' => $this->input->post('kelas'),
					'tanggal' => $tanggal,
					'nama_guru' => $nama_guru[$index],
					'status_absen' => $absen[$index],
					'keterangan' => $ket_lain[$index],
				));

				$index++;
				
			}

			foreach ($nama_siswa as $data_absen_s) {

				array_push($data_s, array(
					'kelas' => $this->input->post('kelas'),
					'tanggal' => $tanggal,
					'nama_siswa' => $nama_siswa[$idx],
					'status_absen' => $absen_s[$idx],
					'keterangan' => $ket_lain_s[$idx],
				));

				$idx++;
				
			}
      
            $insert = $this->mabsensi->insert_absensi($data);
			$insert_siswa = $this->mabsensi->insert_absensi_siswa($data_s);
			if ($insert) {
				$this->session->set_flashdata('success', 'Input data absen berhasil');
				redirect('gurupiket/laporan_hari','refresh');
			} else {
				$this->session->set_flashdata('error', 'Input data absen kelas Gagal');
				redirect('gurupiket/laporan_hari','refresh');
			}
	    } 
	    else 
	    {
	  		$this->session->set_flashdata('error', 'Kelas ini sudah di absen');
			redirect('gurupiket/laporan_hari','refresh');
	    }
	}
}