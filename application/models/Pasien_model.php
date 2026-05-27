<?php
/*
|--------------------------------------------------------------------------
| application/models/Pasien_model.php
|--------------------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->order_by('nama', 'ASC')->get('pasien')->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('pasien', array('id' => $id))->row();
    }

    public function get_by_user_id($user_id) {
        return $this->db->get_where('pasien', array('user_id' => $user_id))->row();
    }

    public function insert($data) {
        $this->db->insert('pasien', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('pasien', $data);
    }

    public function delete($id) {
        // Pendaftaran akan ter-delete otomatis karena CASCADE
        $this->db->where('id', $id);
        return $this->db->delete('pasien');
    }

    public function count_all() {
        return $this->db->count_all('pasien');
    }
}