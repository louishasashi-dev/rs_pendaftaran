<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends Pasien_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Pasien_model', 'Pendaftaran_model', 'Dokter_model'));
    }

    public function dashboard() {
        $user_id = $this->session->userdata('user_id');
        $pasien  = $this->Pasien_model->get_by_user_id($user_id);
        $data = array(
            'title'   => 'Dashboard Pasien',
            'pasien'  => $pasien,
            'riwayat' => $pasien ? $this->Pendaftaran_model->get_by_pasien($pasien->id) : array(),
        );
        $this->load->view('template/header_pasien', $data);
        $this->load->view('pasien/dashboard', $data);
        $this->load->view('template/footer');
    }

    public function daftar() {
        $data = array(
            'title'  => 'Daftar Berobat',
            'dokter' => $this->Dokter_model->get_all(),
        );
        $this->load->view('template/header_pasien', $data);
        $this->load->view('pasien/form_pendaftaran', $data);
        $this->load->view('template/footer');
    }

    public function simpan_pendaftaran() {
        $this->form_validation->set_rules('dokter_id',         'Dokter',            'required|integer');
        $this->form_validation->set_rules('keluhan',           'Keluhan',           'required|trim|min_length[10]');
        $this->form_validation->set_rules('tanggal_kunjungan', 'Tanggal Kunjungan', 'required');
        $this->form_validation->set_rules('jam_kunjungan',     'Jam Kunjungan',     'required');
        $this->form_validation->set_rules('nama',              'Nama',              'required|trim');
        $this->form_validation->set_rules('tanggal_lahir',     'Tanggal Lahir',     'required');
        $this->form_validation->set_rules('jenis_kelamin',     'Jenis Kelamin',     'required');
        $this->form_validation->set_rules('alamat',            'Alamat',            'required|trim');
        $this->form_validation->set_rules('no_telepon',        'No. Telepon',       'required|numeric|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('pasien/daftar');
        }

        $user_id = $this->session->userdata('user_id');
        $pasien  = $this->Pasien_model->get_by_user_id($user_id);

        $pasien_data = array(
            'user_id'       => $user_id,
            'nama'          => $this->input->post('nama', TRUE),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'alamat'        => $this->input->post('alamat', TRUE),
            'no_telepon'    => $this->input->post('no_telepon', TRUE),
            'email'         => $this->session->userdata('username'),
        );

        if ($pasien) {
            $this->Pasien_model->update($pasien->id, $pasien_data);
            $pasien_id = $pasien->id;
        } else {
            $pasien_id = $this->Pasien_model->insert($pasien_data);
        }

        $tanggal = $this->input->post('tanggal_kunjungan');
        if ($tanggal < date('Y-m-d')) {
            $this->session->set_flashdata('error', 'Tanggal kunjungan tidak boleh di masa lampau!');
            redirect('pasien/daftar');
        }

        $this->Pendaftaran_model->insert(array(
            'pasien_id'         => $pasien_id,
            'dokter_id'         => $this->input->post('dokter_id'),
            'keluhan'           => $this->input->post('keluhan', TRUE),
            'tanggal_kunjungan' => $tanggal,
            'jam_kunjungan'     => $this->input->post('jam_kunjungan'),
            'status'            => 'pending',
        ));

        $this->session->set_flashdata('success', 'Pendaftaran berhasil! Menunggu persetujuan admin.');
        redirect('pasien/status');
    }

    public function status() {
        $user_id = $this->session->userdata('user_id');
        $pasien  = $this->Pasien_model->get_by_user_id($user_id);
        $data = array(
            'title'       => 'Status Pendaftaran',
            'pendaftaran' => $pasien ? $this->Pendaftaran_model->get_by_pasien($pasien->id) : array(),
        );
        $this->load->view('template/header_pasien', $data);
        $this->load->view('pasien/status', $data);
        $this->load->view('template/footer');
    }
}