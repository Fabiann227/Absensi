<?php

use SebastianBergmann\Environment\Console;

defined('BASEPATH') OR exit('No direct script access allowed');

class GuruManage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
    $this->load->model('minputdata');
		$this->load->model('mabsensi');
		$this->load->model('mlaporan');
    	$this->load->helper('url');
		$this->load->library('session');
	}

	public function index()
	{
		if ($this->session->userdata('role') != 'Guru Manage') {
            redirect('','refresh');
        }

		$data['gurumanage'] = $this->mabsensi->jumlah_users('Guru Manage');
		$data['guru'] = $this->mabsensi->jumlah_guru();
		$data['kelas'] = $this->mabsensi->jumlah_kelas();
		$data['sudah_absen'] = $this->mabsensi->j_kelas_sudah_absen(TODAY_DATE);
    $data['guru_sudah_absen'] = $this->mabsensi->j_guru_sudah_absen(TODAY_DATE);
		$data['jadwal'] = $this->mabsensi->jumlah_jadwal();
		$data['guruAlpa'] = $this->mabsensi->GuruAlpa(TODAY_DATE);

		$this->load->view('guru_manage/layouts/meta');
		$this->load->view('guru_manage/layouts/navbar');
		$this->load->view('guru_manage/layouts/sidebar');
		$this->load->view('guru_manage/dashboard', $data);
		$this->load->view('guru_manage/layouts/footer');
		$this->load->view('guru_manage/layouts/script');
	}

	//PEPELEG start

	public function absensi_hadir()
    {
      if ($this->session->userdata('role') != 'Guru Manage') {
        redirect('','refresh');
      }

      $this->load->view('guru_manage/layouts/meta');
      $this->load->view('guru_manage/layouts/navbar');
      $this->load->view('guru_manage/layouts/sidebar');
      $this->load->view('guru_manage/absen/absensi_hadir');
      $this->load->view('guru_manage/layouts/footer');
      $this->load->view('laporan/script');
    }

	public function absensi_pulang()
    {
      if ($this->session->userdata('role') != 'Guru Manage') {
        redirect('','refresh');
      }

      $this->load->view('guru_manage/layouts/meta');
      $this->load->view('guru_manage/layouts/navbar');
      $this->load->view('guru_manage/layouts/sidebar');
      $this->load->view('guru_manage/absen/absensi_pulang');
      $this->load->view('guru_manage/layouts/footer');
      $this->load->view('laporan/script');
    }

	public function laporan_bulan()
    {
        if ($this->session->userdata('role') != 'Guru Manage') {
          redirect('','refresh');
        }

        $this->load->view('guru_manage/layouts/meta');
        $this->load->view('guru_manage/layouts/navbar');
        $this->load->view('guru_manage/layouts/sidebar');
        $this->load->view('guru_manage/laporan/bulan');
        $this->load->view('guru_manage/layouts/footer');
        $this->load->view('guru_manage/laporan/script');
    }
    public function laporan_hari()
    {
        if ($this->session->userdata('role') != 'Guru Manage') {
          redirect('','refresh');
        }

        $data['guru_sudah_absen'] = $this->mabsensi->jumlah_guru() - $this->mabsensi->j_guru_sudah_absen(TODAY_DATE);

        $list_guru_sudah_absen = $this->mlaporan->guru_sudah_absen(TODAY_DATE);

        $data['nama_guru'] = $list_guru_sudah_absen;

        $this->load->view('guru_manage/layouts/meta');
        $this->load->view('guru_manage/layouts/navbar');
        $this->load->view('guru_manage/layouts/sidebar');
        $this->load->view('guru_manage/laporan/hari', $data);
        $this->load->view('guru_manage/layouts/footer');
        $this->load->view('guru_manage/laporan/script');
    }
	//PEPELEG end
}