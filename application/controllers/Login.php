<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('minputdata');
	}

	public function index()
	{

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login/loginpage');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$query = $this->db->get_where('tb_users',['username' => $username])->row_array();
		$default_password = 'smkn4bdl';

		if ($query) {
			if (password_verify($password, $query['password'])) 
			{
				$data = 
				[
					'id' => $query['id'],
					'nama' => $query['username'],
					'session' => date('d-m-Y H:m:s'),
					'role' => $query['role'],
					'nama_hari' => $query['nama_hari'],
				];
				
				$this->session->set_userdata( $data );

				if ($query['role'] == 'Admin') {
					redirect('admin','refresh');
				}
				else if ($query['role'] == 'Guru Piket') {
					if (password_verify($default_password, $query['password'])) 
					{
						$this->session->set_flashdata('error', 'Anda belum mengganti password default, Ubahlah Segera!');
						redirect('gurupiket','refresh');
					}
					else
					{
						$this->session->set_flashdata('success', 'Login berhasil');
						redirect('gurupiket','refresh');
					}
				}
				else if ($query['role'] == 'Guru Manage') {
					if (password_verify($default_password, $query['password'])) 
					{
						$this->session->set_flashdata('error', 'Anda belum mengganti password default, Ubahlah Segera!');
						redirect('gurumanage','refresh');
					}
					else
					{
						$this->session->set_flashdata('success', 'Login berhasil');
						redirect('gurumanage','refresh');
					}
				}
				else {
					redirect('gurupiket','refresh');
				}

			} else {
				$this->session->set_flashdata('error', 'Password Salah');
				redirect('','refresh');
			}
		} else {
			$this->session->set_flashdata('error', 'Username dan Password salah');
			redirect('','refresh');
		}
	}

	public function change_password()
	{
		$this->form_validation->set_rules('passwordLama', 'Password Lama', 'trim|required');
        $this->form_validation->set_rules('passwordBaru', 'Password Baru', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/change_pw');
        } else {
            $this->_ganti_password();
        }
    }

    private function _ganti_password()
    {
        $passwordLama = $this->input->post('passwordLama');
        $passwordBaru = $this->input->post('passwordBaru');

        $username = $this->session->userdata('nama');
        $user = $this->db->get_where('tb_users',['username' => $username])->row_array();

        if (password_verify($passwordLama, $user['password'])) {
            $hashed_password = password_hash($passwordBaru, PASSWORD_DEFAULT);
            
			$this->minputdata->update_password($user['id'], $hashed_password);

            $this->session->set_flashdata('success', 'Password Berhasil Diganti, Silahkan Login Kembali');
			redirect('','refresh');
        } else {
            $this->session->set_flashdata('error', 'Password Lama Salah!');
			redirect('login/change_password','refresh');
        }
    }

	public function logout()
	{
		session_destroy();
		redirect('','refresh');
	}
}
