<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mInputData extends CI_Model {

	public function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function update_password($user_id, $new_password)
    {
        $data = array(
            'password' => $new_password
        );

        $this->db->where('id', $user_id);
        $this->db->update('tb_users', $data);
    }

    function GetDataUsers()
    {
        $query = $this->db->get('tb_users');
        return $query->result();
    }
    
	function GetDataGuru()
	{
		$query = $this->db->get('tb_guru');
        return $query->result();
	}

    function GetDataSiswa()
	{
		$query = $this->db->get('tb_siswa');
        return $query->result();
	}

	function GetDataKelas()
	{
		$query = $this->db->get('tb_kelas');
        return $query->result();
	}	

	function GetDataJadwal()
	{
		$query = $this->db->get('tb_jadwal');
        return $query->result();
	}
	
	public function update_guru($idGuru, $namaGuru) 
	{
        $data = array('nama_guru' => $namaGuru);
        $this->db->where('id_guru', $idGuru);
        return $this->db->update('tb_guru', $data);
    }

    public function insert_user($data)
    {
        return $this->db->insert('tb_users', $data);
    }

    public function delete_user($id) 
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_users');
        
        return $this->db->affected_rows() > 0;
    }


	public function add_guru($namaGuru) 
	{
		$guru_data = array(
			'nama_guru' => $namaGuru
		);
		return $this->db->insert('tb_guru', $guru_data);
    }

    public function delete_guru($id_guru) 
    {
        $this->db->where('id_guru', $id_guru);
        $this->db->delete('tb_guru');
        
        return $this->db->affected_rows() > 0;
    }

    public function update_kelas($idkelas, $namakelas) 
	{
        $data = array('nama_kelas' => $namakelas);
        $this->db->where('id_kelas', $idkelas);
        return $this->db->update('tb_kelas', $data);
    }

	public function add_kelas($namaKelas) 
	{
		$data = array(
			'nama_kelas' => $namaKelas
		);
		return $this->db->insert('tb_kelas', $data);
    }

    public function delete_kelas($id_kelas) 
    {
        $this->db->where('id_kelas', $id_kelas);
        $this->db->delete('tb_kelas');
        
        return $this->db->affected_rows() > 0;
    }

    // PEPELEG START
    public function update_data_users($idakun, $namaakun) 
	{
        $data = array('username' => $namaakun);
        $this->db->where('id', $idakun);
        return $this->db->update('tb_users', $data);
    }
    // PEPELEG END
}