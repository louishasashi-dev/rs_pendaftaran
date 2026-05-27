<?php
/*
|--------------------------------------------------------------------------
| application/models/User_model.php
|--------------------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function login($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('users');
        return ($query->num_rows() == 1) ? $query->row() : FALSE;
    }

    public function register($user_data, $pasien_data) {
        // Insert ke tabel users
        $this->db->insert('users', $user_data);
        $user_id = $this->db->insert_id();

        if (!$user_id) return FALSE;

        // Insert ke tabel pasien
        $pasien_data['user_id'] = $user_id;
        $this->db->insert('pasien', $pasien_data);

        return $user_id;
    }

    public function get_by_id($id) {
        return $this->db->get_where('users', array('id' => $id))->row();
    }

    public function is_unique_username($username) {
        $this->db->where('username', $username);
        return ($this->db->get('users')->num_rows() == 0);
    }
}