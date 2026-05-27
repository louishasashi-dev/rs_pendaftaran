<?php
/*
|--------------------------------------------------------------------------
| application/controllers/Admin.php
|--------------------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_cek_login();
        $this->load->model(array('User_model', 'Pasien_model', 'Pendaftaran_model', 'Dokter_model'));
    }

    // Middleware: hanya admin yang boleh akses
    private function _cek_login() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda harus login sebagai admin!');
            redirect('auth');
        }
    }

    // ==========================================================
    // DASHBOARD
    // ==========================================================
    public function dashboard() {
        $data = array(
            'title'            => 'Dashboard Admin',
            'total_pasien'     => $this->Pasien_model->count_all(),
            'total_pendaftaran'=> $this->Pendaftaran_model->count_all(),
            'total_disetujui'  => $this->Pendaftaran_model->count_by_status('disetujui'),
            'total_ditolak'    => $this->Pendaftaran_model->count_by_status('ditolak'),
            'total_pending'    => $this->Pendaftaran_model->count_by_status('pending'),
            'pendaftaran_terbaru' => $this->Pendaftaran_model->get_terbaru(5),
        );
        $this->load->view('template/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('template/footer');
    }

    // ==========================================================
    // MANAJEMEN PENDAFTARAN
    // ==========================================================
    public function pendaftaran() {
        $data = array(
            'title'       => 'Manajemen Pendaftaran',
            'pendaftaran' => $this->Pendaftaran_model->get_all_with_detail(),
        );
        $this->load->view('template/header', $data);
        $this->load->view('admin/pendaftaran', $data);
        $this->load->view('template/footer');
    }

    public function setujui($id) {
        $catatan = $this->input->post('catatan', TRUE);
        $this->Pendaftaran_model->update_status($id, 'disetujui', $catatan);
        $this->session->set_flashdata('success', 'Pendaftaran berhasil disetujui.');
        redirect('admin/pendaftaran');
    }

    public function tolak($id) {
        $catatan = $this->input->post('catatan', TRUE);
        $this->Pendaftaran_model->update_status($id, 'ditolak', $catatan);
        $this->session->set_flashdata('success', 'Pendaftaran berhasil ditolak.');
        redirect('admin/pendaftaran');
    }

    // ==========================================================
    // MANAJEMEN PASIEN (CRUD)
    // ==========================================================
    public function pasien() {
        $data = array(
            'title'  => 'Manajemen Data Pasien',
            'pasien' => $this->Pasien_model->get_all(),
        );
        $this->load->view('template/header', $data);
        $this->load->view('admin/pasien', $data);
        $this->load->view('template/footer');
    }

    public function tambah_pasien() {
        $data = array('title' => 'Tambah Pasien');
        $this->load->view('template/header', $data);
        $this->load->view('admin/form_pasien', $data);
        $this->load->view('template/footer');
    }

    public function simpan_pasien() {
        $this->form_validation->set_rules('nama',          'Nama',          'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat',        'Alamat',        'required|trim');
        $this->form_validation->set_rules('no_telepon',    'No. Telepon',   'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/tambah_pasien');
        }

        $this->Pasien_model->insert(array(
            'nama'          => $this->input->post('nama', TRUE),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'alamat'        => $this->input->post('alamat', TRUE),
            'no_telepon'    => $this->input->post('no_telepon', TRUE),
            'email'         => $this->input->post('email', TRUE),
        ));

        $this->session->set_flashdata('success', 'Data pasien berhasil ditambahkan.');
        redirect('admin/pasien');
    }

    public function edit_pasien($id) {
        $data = array(
            'title' => 'Edit Pasien',
            'pasien' => $this->Pasien_model->get_by_id($id),
        );
        if (!$data['pasien']) show_404();

        $this->load->view('template/header', $data);
        $this->load->view('admin/form_pasien', $data);
        $this->load->view('template/footer');
    }

    public function update_pasien($id) {
        $this->form_validation->set_rules('nama',          'Nama',          'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat',        'Alamat',        'required|trim');
        $this->form_validation->set_rules('no_telepon',    'No. Telepon',   'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/edit_pasien/' . $id);
        }

        $this->Pasien_model->update($id, array(
            'nama'          => $this->input->post('nama', TRUE),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'alamat'        => $this->input->post('alamat', TRUE),
            'no_telepon'    => $this->input->post('no_telepon', TRUE),
            'email'         => $this->input->post('email', TRUE),
        ));

        $this->session->set_flashdata('success', 'Data pasien berhasil diperbarui.');
        redirect('admin/pasien');
    }

    public function hapus_pasien($id) {
        $this->Pasien_model->delete($id);
        $this->session->set_flashdata('success', 'Data pasien berhasil dihapus.');
        redirect('admin/pasien');
    }

    // ==========================================================
    // JADWAL PENDAFTARAN
    // ==========================================================
    public function jadwal() {
        $data = array(
            'title'   => 'Jadwal Pendaftaran Pasien',
            'jadwal'  => $this->Pendaftaran_model->get_jadwal(),
            'dokter'  => $this->Dokter_model->get_all(),
        );
        $this->load->view('template/header', $data);
        $this->load->view('admin/jadwal', $data);
        $this->load->view('template/footer');
    }
}