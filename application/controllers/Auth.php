<?php
/*
|--------------------------------------------------------------------------
| application/controllers/Auth.php
|
| PENTING: Nama file HARUS "Auth.php" (huruf A kapital), bukan "auth.php"
| CodeIgniter 3 case-sensitive pada nama file controller di Linux/XAMPP
|--------------------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        // session, form_validation, url helper sudah di-autoload
    }

    // GET /auth  → tampilkan form login
    public function index() {
        // Kalau sudah login, redirect langsung
        if ($this->session->userdata('logged_in')) {
            $role = $this->session->userdata('role');
            redirect($role == 'admin' ? 'admin/dashboard' : 'pasien/dashboard');
        }
        $this->load->view('auth/login');
    }

    // POST /auth/proses_login
    public function proses_login() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth');
        }

        $username = $this->input->post('username', TRUE);
        $password = md5($this->input->post('password'));

        $user = $this->User_model->login($username, $password);

        if ($user) {
            $this->session->set_userdata(array(
                'user_id'   => $user->id,
                'username'  => $user->username,
                'role'      => $user->role,
                'logged_in' => TRUE
            ));

            if ($user->role == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('pasien/dashboard');
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('auth');
        }
    }

    // GET /auth/register → form registrasi pasien baru
    public function register() {
        if ($this->session->userdata('logged_in')) {
            redirect('pasien/dashboard');
        }
        $this->load->view('auth/register');
    }

    // POST /auth/proses_register
    public function proses_register() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('email',    'Email',    'required|valid_email');
        $this->form_validation->set_rules('nama',     'Nama',     'required|trim');
        $this->form_validation->set_rules('no_telepon', 'No. Telepon', 'required|numeric|min_length[10]|max_length[15]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth/register');
        }

        $user_id = $this->User_model->register(array(
            'username' => $this->input->post('username', TRUE),
            'password' => md5($this->input->post('password')),
            'email'    => $this->input->post('email', TRUE),
            'role'     => 'pasien'
        ), array(
            'nama'          => $this->input->post('nama', TRUE),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'alamat'        => $this->input->post('alamat', TRUE),
            'no_telepon'    => $this->input->post('no_telepon', TRUE),
            'email'         => $this->input->post('email', TRUE)
        ));

        if ($user_id) {
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
            redirect('auth');
        } else {
            $this->session->set_flashdata('error', 'Registrasi gagal. Coba lagi.');
            redirect('auth/register');
        }
    }

    // GET /auth/logout
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}