<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AbsensiController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Absensi_model'); // Memuat model Absensi_model
    }

    public function input_data() {
        // Validasi data
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|integer');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|date');
        $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'required');
        $this->form_validation->set_rules('kehadiran', 'Kehadiran', 'required|in_list[hadir,tidak hadir]');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim');
    
        if ($this->form_validation->run() == FALSE) {
            // Data tidak valid, kembalikan ke halaman input_data
            return redirect('input_data');
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
    
        // Redirect kembali ke tampilan input_data (atau tampilan lain yang sesuai)
        redirect('input_data');
    }
}
