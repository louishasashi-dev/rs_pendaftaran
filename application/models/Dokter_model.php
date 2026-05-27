<?php
/*
|--------------------------------------------------------------------------
| application/models/Dokter_model.php
|--------------------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->order_by('nama', 'ASC')->get('dokter')->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('dokter', array('id' => $id))->row();
    }

    public function insert($data) {
        $this->db->insert('dokter', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('dokter', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('dokter');
    }
}