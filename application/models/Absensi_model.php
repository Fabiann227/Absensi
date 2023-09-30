<?php
class Absensi_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_absensi($data) {
        $this->db->insert('tb_absensi', $data);
        return $this->db->insert_id(); // Mengembalikan ID data yang baru disisipkan
    }
}
