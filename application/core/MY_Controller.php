<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| application/core/MY_Controller.php
| Base controller — semua controller extends class ini
|--------------------------------------------------------------------------
*/

// Base untuk semua halaman yang butuh login
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Cek apakah sudah login
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu!');
            redirect('auth');
        }
    }
}

// Base khusus untuk Admin
class Admin_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();

        // Cek role admin
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak punya akses ke halaman admin!');
            redirect('auth');
        }
    }
}

// Base khusus untuk Pasien
class Pasien_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();

        // Cek role pasien
        if ($this->session->userdata('role') != 'pasien') {
            $this->session->set_flashdata('error', 'Anda tidak punya akses ke halaman pasien!');
            redirect('auth');
        }
    }
}