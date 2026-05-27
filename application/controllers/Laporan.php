<?php
/*
|--------------------------------------------------------------------------
| application/controllers/Laporan.php
|--------------------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
        $this->load->model('Pendaftaran_model');
    }

    // Halaman laporan statistik
    public function index() {
        $data = array(
            'title'          => 'Laporan & Statistik',
            'total'          => $this->Pendaftaran_model->count_all(),
            'disetujui'      => $this->Pendaftaran_model->count_by_status('disetujui'),
            'ditolak'        => $this->Pendaftaran_model->count_by_status('ditolak'),
            'pending'        => $this->Pendaftaran_model->count_by_status('pending'),
            'per_bulan'      => $this->Pendaftaran_model->get_per_bulan(),
            'per_dokter'     => $this->Pendaftaran_model->get_per_dokter(),
            'semua'          => $this->Pendaftaran_model->get_all_with_detail(),
        );
        $this->load->view('template/header', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('template/footer');
    }

    // Export CSV
    public function export_csv() {
        $pendaftaran = $this->Pendaftaran_model->get_all_with_detail();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="laporan_pendaftaran_' . date('Ymd_His') . '.csv"');

        $output = fopen('php://output', 'w');

        // BOM untuk Excel agar UTF-8 terbaca benar
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Header kolom
        fputcsv($output, array(
            'No', 'Nama Pasien', 'Dokter', 'Spesialis',
            'Keluhan', 'Tanggal Kunjungan', 'Jam', 'Status', 'Tanggal Daftar'
        ));

        $no = 1;
        foreach ($pendaftaran as $row) {
            fputcsv($output, array(
                $no++,
                $row->nama_pasien,
                $row->nama_dokter,
                $row->spesialis,
                $row->keluhan,
                date('d/m/Y', strtotime($row->tanggal_kunjungan)),
                date('H:i', strtotime($row->jam_kunjungan)),
                strtoupper($row->status),
                date('d/m/Y H:i', strtotime($row->created_at)),
            ));
        }

        fclose($output);
        exit;
    }

    // Export PDF (menggunakan HTML-to-print, tanpa library tambahan)
    public function export_pdf() {
        $data = array(
            'title'       => 'Laporan Pendaftaran Pasien',
            'pendaftaran' => $this->Pendaftaran_model->get_all_with_detail(),
            'disetujui'   => $this->Pendaftaran_model->count_by_status('disetujui'),
            'ditolak'     => $this->Pendaftaran_model->count_by_status('ditolak'),
            'pending'     => $this->Pendaftaran_model->count_by_status('pending'),
            'total'       => $this->Pendaftaran_model->count_all(),
            'tanggal'     => date('d F Y'),
        );
        // Load view khusus print (tanpa header/footer SB Admin)
        $this->load->view('laporan/pdf', $data);
    }
}