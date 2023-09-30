<?php

use SebastianBergmann\Environment\Console;

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('minputdata');
		$this->load->model('mabsensi');
		$this->load->model('mlaporan');
		$this->load->model('Absensi_model');
		$this->load->helper('form');
    	$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('download');
	}

	public function index()
	{
		if ($this->session->userdata('role') != 'Admin') {
			redirect('','refresh');
		}

		$data['admin'] = $this->mabsensi->jumlah_users('Admin');
		$data['guru'] = $this->mabsensi->jumlah_guru();
		$data['kelas'] = $this->mabsensi->jumlah_kelas();
		$data['jadwal'] = $this->mabsensi->jumlah_jadwal();

		$this->load->view('admin/layouts/meta');
		$this->load->view('admin/layouts/navbar');
		$this->load->view('admin/layouts/sidebar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/layouts/footer');
		$this->load->view('admin/layouts/script');
	}

	public function user()
	{
		if ($this->session->userdata('role') != 'Admin') {
			redirect('','refresh');
		}

		$data['user'] = $this->minputdata->GetDataUsers();

		$this->load->view('admin/layouts/meta');
		$this->load->view('admin/layouts/navbar');
		$this->load->view('admin/layouts/sidebar');
		$this->load->view('admin/data/user', $data);
		$this->load->view('admin/layouts/footer');
		$this->load->view('admin/layouts/script');
	}

	public function guru()
	{
		if ($this->session->userdata('role') != 'Admin') {
			redirect('','refresh');
		}

		$data['guru'] = $this->minputdata->GetDataGuru();

		$this->load->view('admin/layouts/meta');
		$this->load->view('admin/layouts/navbar');
		$this->load->view('admin/layouts/sidebar');
		$this->load->view('admin/data/guru', $data);
		$this->load->view('admin/layouts/footer');
		$this->load->view('admin/layouts/script');
	}

	public function siswa()
	{
		if ($this->session->userdata('role') != 'Admin') {
			redirect('','refresh');
		}

		$data['siswa'] = $this->minputdata->GetDataSiswa();

		$this->load->view('admin/layouts/meta');
		$this->load->view('admin/layouts/navbar');
		$this->load->view('admin/layouts/sidebar');
		$this->load->view('admin/data/siswa', $data);
		$this->load->view('admin/layouts/footer');
		$this->load->view('admin/layouts/script');
	}

	public function kelas()
	{
		if ($this->session->userdata('role') != 'Admin') {
			redirect('','refresh');
		}

		$data['kelas'] = $this->minputdata->GetDataKelas();

		$this->load->view('admin/layouts/meta');
		$this->load->view('admin/layouts/navbar');
		$this->load->view('admin/layouts/sidebar');
		$this->load->view('admin/data/kelas', $data);
		$this->load->view('admin/layouts/footer');
		$this->load->view('admin/layouts/script');
	}

	public function jadwal()
	{
		if ($this->session->userdata('role') != 'Admin') {
			redirect('','refresh');
		}

		$data['kelas'] = $this->mabsensi->GetDataKelas('X');
		
		$this->load->view('admin/layouts/meta');
		$this->load->view('admin/layouts/navbar');
		$this->load->view('admin/layouts/sidebar');
		$this->load->view('admin/data/jadwal', $data);
		$this->load->view('admin/layouts/footer');
		$this->load->view('admin/layouts/script');
	}

	public function jadwal_gurupiket()
	{
		if ($this->session->userdata('role') != 'Admin') {
			redirect('','refresh');
		}

		$data['hari'] = $this->mabsensi->GetDataHari();
		
		$this->load->view('admin/layouts/meta');
		$this->load->view('admin/layouts/navbar');
		$this->load->view('admin/layouts/sidebar');
		$this->load->view('admin/data/jadwal_gurupiket', $data);
		$this->load->view('admin/layouts/footer');
		$this->load->view('admin/layouts/script');
	}

	public function absen_xii()
	{
		if ($this->session->userdata('role') != 'Admin') {
			redirect('','refresh');
		}

		$tanggal = date('Y-m-d');
		$data['kelas'] = $this->mabsensi->GetKelasBelumAbsen('XII ', $tanggal);

		$this->load->view('guru_piket/layouts/meta');
		$this->load->view('guru_piket/layouts/navbar');
		$this->load->view('guru_piket/layouts/sidebar');
		$this->load->view('guru_piket/absen/input_absen', $data);
		$this->load->view('guru_piket/layouts/footer');
		$this->load->view('guru_piket/layouts/script');
	}

	public function absen_xi()
	{
		if ($this->session->userdata('role') != 'Admin') {
			redirect('','refresh');
		}

		$tanggal = date('Y-m-d');
		$data['kelas'] = $this->mabsensi->GetKelasBelumAbsen('XI ', $tanggal);

		$this->load->view('guru_piket/layouts/meta');
		$this->load->view('guru_piket/layouts/navbar');
		$this->load->view('guru_piket/layouts/sidebar');
		$this->load->view('guru_piket/absen/input_absen', $data);
		$this->load->view('guru_piket/layouts/footer');
		$this->load->view('guru_piket/layouts/script');
	}

	public function absen_x()
	{
		if ($this->session->userdata('role') != 'Admin') {
			redirect('','refresh');
		}

		$tanggal = date('Y-m-d');
		$data['kelas'] = $this->mabsensi->GetKelasBelumAbsen('X ', $tanggal);

		$this->load->view('guru_piket/layouts/meta');
		$this->load->view('guru_piket/layouts/navbar');
		$this->load->view('guru_piket/layouts/sidebar');
		$this->load->view('guru_piket/absen/input_absen', $data);
		$this->load->view('guru_piket/layouts/footer');
		$this->load->view('guru_piket/layouts/script');
	}

	//PEPELEG start

	public function absensi_hadir()
    {
      if ($this->session->userdata('role') != 'Admin') {
        redirect('','refresh');
      }

      $this->load->view('admin/layouts/meta');
      $this->load->view('admin/layouts/navbar');
      $this->load->view('admin/layouts/sidebar');
      $this->load->view('absensiSRC/absensi_hadir');
      $this->load->view('admin/layouts/footer');
      $this->load->view('laporan/script');
    }

	public function absensi_pulang()
    {
      if ($this->session->userdata('role') != 'Admin') {
        redirect('','refresh');
      }

      $this->load->view('admin/layouts/meta');
      $this->load->view('admin/layouts/navbar');
      $this->load->view('admin/layouts/sidebar');
      $this->load->view('absensiSRC/absensi_pulang');
      $this->load->view('admin/layouts/footer');
      $this->load->view('laporan/script');
    }

	public function edit_tbusers() 
	{
		$idakun = $this->input->post('id');
        $namaakun = $this->input->post('nama');
		
		$insert = $this->minputdata->update_data_users($idakun, $namaakun);
		if ($insert) {
			$this->session->set_flashdata('success', 'Edit Nama User berhasil');
		} else {
			$this->session->set_flashdata('error', 'Edit Nama User Gagal');
		}

		redirect('admin/user','refresh');
    }

	//PEPELEG end
	
	public function laporan_hari()
    {
      if ($this->session->userdata('role') != 'Admin') {
        redirect('','refresh');
      }

      $data['sudah_absen'] = $this->mabsensi->jumlah_kelas() - $this->mabsensi->j_kelas_sudah_absen(TODAY_DATE);

      $list_kelas_sudah_absen = $this->mlaporan->kelas_sudah_absen(TODAY_DATE);

      $data['kelas'] = $list_kelas_sudah_absen;

      $this->load->view('admin/layouts/meta');
      $this->load->view('admin/layouts/navbar');
      $this->load->view('admin/layouts/sidebar');
      $this->load->view('laporan/hari', $data);
      $this->load->view('admin/layouts/footer');
      $this->load->view('laporan/script');
    }

	public function laporan_hari_siswa()
    {
      if ($this->session->userdata('role') != 'Admin') {
        redirect('','refresh');
      }

      $data['sudah_absen'] = $this->mabsensi->jumlah_kelas() - $this->mabsensi->j_kelas_sudah_absen(TODAY_DATE);

      $list_kelas_sudah_absen = $this->mlaporan->kelas_sudah_absen(TODAY_DATE);

      $data['kelas'] = $list_kelas_sudah_absen;

      $this->load->view('admin/layouts/meta');
      $this->load->view('admin/layouts/navbar');
      $this->load->view('admin/layouts/sidebar');
      $this->load->view('laporan_siswa/hari', $data);
      $this->load->view('admin/layouts/footer');
      $this->load->view('laporan/script');
    }

    public function laporan_bulan()
    {
      if ($this->session->userdata('role') != 'Admin') {
        redirect('','refresh');
      }

      $this->load->view('admin/layouts/meta');
      $this->load->view('admin/layouts/navbar');
      $this->load->view('admin/layouts/sidebar');
      $this->load->view('laporan/bulan');
      $this->load->view('admin/layouts/footer');
      $this->load->view('laporan/script');
    }

	public function laporan_bulan_siswa()
    {
        if ($this->session->userdata('role') != 'Admin') {
          redirect('','refresh');
        }

		$data['kelas'] = $this->minputdata->GetDataKelas();

        $this->load->view('admin/layouts/meta');
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('laporan_siswa/bulan', $data);
        $this->load->view('admin/layouts/footer');
        $this->load->view('laporan/script');
    }


	public function edit_guru() 
	{
		$idGuru = $this->input->post('id');
        $namaGuru = $this->input->post('nama');
		
		$insert = $this->minputdata->update_guru($idGuru, $namaGuru);
		if ($insert) {
			$this->session->set_flashdata('success', 'Edit Nama Guru berhasil');
		} else {
			$this->session->set_flashdata('error', 'Edit Nama Guru Gagal');
		}

		redirect('admin/guru','refresh');
    }

	public function add_user() 
	{
        if ($this->input->post()) {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role')
            );

            $this->minputdata->insert_user($data);
            $this->session->set_flashdata('success', 'Tambah Guru berhasil');
        }

		redirect('admin/user','refresh');
    }

    public function delete_user($id) 
    {
        $deleted = $this->minputdata->delete_user($id);
        
        if ($deleted) {
            $this->session->set_flashdata('success', 'Hapus User berhasil');
        } else {
            $this->session->set_flashdata('error', 'Hapus User Gagal');
        }

        redirect('admin/user','refresh');
    }

	public function add_guru() 
	{
        $namaGuru = $this->input->post('nama');
		
		$insert = $this->minputdata->add_guru($namaGuru);
		if ($insert) {
			$this->session->set_flashdata('success', 'Tambah Guru berhasil');
		} else {
			$this->session->set_flashdata('error', 'Tambah Guru Gagal');
		}

		redirect('admin/guru','refresh');
    }

    public function delete_guru($id_guru) 
    {
        $deleted = $this->minputdata->delete_guru($id_guru);
        
        if ($deleted) {
            $this->session->set_flashdata('success', 'Hapus Guru berhasil');
        } else {
            $this->session->set_flashdata('error', 'Hapus Guru Gagal');
        }

        redirect('admin/guru','refresh');
    }

    public function edit_kelas() 
	{
		$idKelas = $this->input->post('id');
        $namaKelas = $this->input->post('nama');
		
		$insert = $this->minputdata->update_kelas($idKelas, $namaKelas);
		if ($insert) {
			$this->session->set_flashdata('success', 'Edit Nama Kelas berhasil');
		} else {
			$this->session->set_flashdata('error', 'Edit Nama Kelas Gagal');
		}

		redirect('admin/kelas','refresh');
    }

	public function add_kelas() 
	{
        $nama = $this->input->post('nama');
		
		$insert = $this->minputdata->add_kelas($nama);
		if ($insert) {
			$this->session->set_flashdata('success', 'Tambah Kelas berhasil');
		} else {
			$this->session->set_flashdata('error', 'Tambah Kelas Gagal');
		}

		redirect('admin/kelas','refresh');
    }

    public function delete_kelas($id_kelas) 
    {
        $deleted = $this->minputdata->delete_kelas($id_kelas);
        
        if ($deleted) {
            $this->session->set_flashdata('success', 'Hapus Kelas berhasil');
        } else {
            $this->session->set_flashdata('error', 'Hapus Kelas Gagal');
        }

        redirect('admin/kelas','refresh');
    }

	public function import_kelas() 
	{
        //$this->load->library('PhpSpreadsheet');
        
        if ($_FILES['uploadfile']['name']) 
		{
            $inputFileName = $_FILES['uploadfile']['tmp_name'];

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            $headers = array_shift($rows);

            foreach ($rows as $row) {
                $data = array_combine($headers, $row);

                $guru_data = array(
                    'nama_kelas' => $data['nama_kelas']
                );

                $this->db->insert('tb_kelas', $guru_data);
            }

			$this->session->set_flashdata('success', 'Import data kelas berhasil');
            redirect('admin/kelas','refresh');
        }
    }

	public function import_guru() 
	{
        //$this->load->library('PhpSpreadsheet');
        
        if ($_FILES['uploadfile']['name']) 
		{
            $inputFileName = $_FILES['uploadfile']['tmp_name'];

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            $headers = array_shift($rows);

            foreach ($rows as $row) {
                $data = array_combine($headers, $row);

                $guru_data = array(
                    'nama_guru' => $data['nama_guru'],
					'username' => $data['username']
                );

                $this->db->insert('tb_users', $guru_data);
            }

			$this->session->set_flashdata('success', 'Import data Guru berhasil');
            redirect('admin/guru','refresh');
        }
    }

	public function import_siswa() 
	{
        //$this->load->library('PhpSpreadsheet');
        
        if ($_FILES['uploadfile']['name']) 
		{
            $inputFileName = $_FILES['uploadfile']['tmp_name'];

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            $headers = array_shift($rows);

            foreach ($rows as $row) {
                $data = array_combine($headers, $row);

                $data_siswa = array(
                    'nis' => $data['nis'],
					'nisn' => $data['nisn'],
					'nama_siswa' => $data['nama_siswa'],
					'jk' => $data['jk'],
					'id_kelas' => $data['id_kelas'],
					'nama_kelas' => $data['nama_kelas']
                );

                $this->db->insert('tb_siswa', $data_siswa);
            }

			$this->session->set_flashdata('success', 'Import data Siswa berhasil');
            redirect('admin/siswa','refresh');
        }
    }

	public function import_jadwal() 
	{
        //$this->load->library('PhpSpreadsheet');
        
        if ($_FILES['uploadfile']['name']) 
		{
            $inputFileName = $_FILES['uploadfile']['tmp_name'];

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            $headers = array_shift($rows);

            foreach ($rows as $row) {
                $data = array_combine($headers, $row);

                $data_jadwal = array(
                    'id_hari' => $data['id_hari'],
					'nama_hari' => $data['nama_hari'],
					'id_kelas' => $data['id_kelas'],
					'nama_kelas' => $data['nama_kelas'],
					'id_guru' => $data['id_guru'],
					'nama_guru' => $data['nama_guru'],
					'keterangan' => $data['keterangan']
                );

                $this->db->insert('tb_jadwal', $data_jadwal);
            }

			$this->session->set_flashdata('success', 'Import data Jadwal berhasil');
            redirect('admin/jadwal','refresh');
        }
    }

	public function import_jadwal_gurupiket() 
	{
        //$this->load->library('PhpSpreadsheet');
        
        if ($_FILES['uploadfile']['name']) 
		{
            $inputFileName = $_FILES['uploadfile']['tmp_name'];

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            $headers = array_shift($rows);

            foreach ($rows as $row) {
                $data = array_combine($headers, $row);

                $data_jadwal = array(
                    'id_hari' => $data['id_hari'],
					'nama_hari' => $data['nama_hari'],
					'username' => $data['username'],
					'id_guru' => $data['id_guru'],
					'nama_guru' => $data['nama_guru'],
					'area_piket' => $data['area_piket'],
					'ket' => $data['ket']
                );

                $this->db->insert('tb_users', $data_jadwal);
            }

			$this->session->set_flashdata('success', 'Import data Jadwal berhasil');
            redirect('admin/jadwal_gurupiket','refresh');
        }
    }

	
    public function input_absen_guru() {
        // Validasi data
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|date');
        $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'required');
        $this->form_validation->set_rules('kehadiran', 'Kehadiran', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim');
    
        if ($this->form_validation->run() == FALSE) {
            // Data tidak valid, kembalikan ke halaman input_absen_guru
            return redirect('input_absen_guru');
        }
    
        // Ambil data dari formulir
        $data = array(
            'kelas' => $this->input->post('kelas'),
            'tanggal' => $this->input->post('tanggal'),
            'nama_guru' => $this->input->post('nama_guru'),
            'kehadiran' => $this->input->post('kehadiran'),
            'keterangan' => $this->input->post('keterangan')
        );
    
        // Masukkan data absensi ke dalam database menggunakan model
        $inserted_id = $this->Absensi_model->insert_absensi($data);
    
        if ($inserted_id) {
            // Data berhasil disisipkan, $inserted_id berisi ID data yang baru disisipkan
            $this->session->set_flashdata('success', 'Data absensi berhasil disimpan.');
        } else {
            // Gagal menyisipkan data
            $this->session->set_flashdata('error', 'Gagal menyimpan data absensi.');
        }
    
        // Redirect kembali ke tampilan input_absen_guru (atau tampilan lain yang sesuai)
        redirect('input_absen_guru', 'refresh');
    }

	public function downloadFile($filename)
	{
    	$file_path = FCPATH . 'assets/files/' . $filename;
		$new_file_name = $filename;

		force_download($new_file_name, file_get_contents($file_path));
		$this->session->set_flashdata('success', 'File sedang di download.');
		redirect('admin/guru','refresh');
	}

	public function data_jadwal()
	{
		$kelas = $_POST['kelas'];
	    $tg = $_POST['date'];
	    $idhariini = $_POST['hari'];

	    function tgl_indo($tanggal)
        {
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
                <table class="table table-bordered custom-table">
                  <thead class="bg-info">
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>';
        $no = 1;
        foreach ($jadwal_pelajaran as $query) {
        	$data .= '<tr><td>';
        	$data .= $no++;
        	$data .= '</td>';
        	$data .= '<td>';
        	$data .= $query->nama_guru;
        	$data .= '<td>';
        	$data .= $query->keterangan;
        	$data .= '</td></tr>';

        }
        $data .= '</tbody></table>';
        $data .= '</div></div></div></div>';
        	
		echo json_encode($data);
	}

	public function data_jadwal_gurupiket()
	{
	    $hari = $_POST['hari'];

	    $query = $this->db->get_where('tb_users', array('nama_hari' => $hari, 'role' => 'Guru Piket'));
	    $jadwal_gurupiket = $query->result();

		$data = '';
		$data .= '<div class="card-header"> 
		<h3 class="card-title">Jadwal Guru Piket</h3>
	  </div><div class="card-body">
	  <div class="row">
		<div class="col-md-12">
		  <table>
			<tr>
			  <td>Hari</td><td>:</td><td style="padding-left: 10px">';
        $data .= $hari;
        $data .= '</td>
					</tr>
				</table>
                <br>
                <table class="table table-bordered custom-table">
                  <thead class="bg-info">
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
					  <th>Area Piket</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>';
        $no = 1;
        foreach ($jadwal_gurupiket as $query) {
        	$data .= '<tr><td>';
        	$data .= $no++;
        	$data .= '</td>';
        	$data .= '<td>';
        	$data .= $query->nama_guru;
        	$data .= '</td><td>';
			$data .= $query->area_piket;
        	$data .= '</td><td>';
        	$data .= $query->ket;
        	$data .= '</td></tr>';
 
        }
        $data .= '</tbody></table>';
        $data .= '</div></div></div></div>';
        	
		echo json_encode($data);
	}
}