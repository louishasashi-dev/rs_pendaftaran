<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_with_detail() {
        $this->db->select('pendaftaran.*, 
                           pasien.nama AS nama_pasien, 
                           pasien.no_telepon,
                           dokter.nama AS nama_dokter, 
                           dokter.spesialis');
        $this->db->from('pendaftaran');
        $this->db->join('pasien', 'pasien.id = pendaftaran.pasien_id');
        $this->db->join('dokter', 'dokter.id = pendaftaran.dokter_id');
        $this->db->order_by('pendaftaran.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_pasien($pasien_id) {
        $this->db->select('pendaftaran.*, dokter.nama AS nama_dokter, dokter.spesialis');
        $this->db->from('pendaftaran');
        $this->db->join('dokter', 'dokter.id = pendaftaran.dokter_id');
        $this->db->where('pendaftaran.pasien_id', $pasien_id);
        $this->db->order_by('pendaftaran.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_terbaru($limit = 5) {
        $this->db->select('pendaftaran.*, pasien.nama AS nama_pasien, dokter.nama AS nama_dokter');
        $this->db->from('pendaftaran');
        $this->db->join('pasien', 'pasien.id = pendaftaran.pasien_id');
        $this->db->join('dokter', 'dokter.id = pendaftaran.dokter_id');
        $this->db->order_by('pendaftaran.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_jadwal() {
        $this->db->select('pendaftaran.*, 
                           pasien.nama AS nama_pasien, 
                           pasien.no_telepon,
                           dokter.nama AS nama_dokter, 
                           dokter.spesialis');
        $this->db->from('pendaftaran');
        $this->db->join('pasien', 'pasien.id = pendaftaran.pasien_id');
        $this->db->join('dokter', 'dokter.id = pendaftaran.dokter_id');
        $this->db->where('pendaftaran.tanggal_kunjungan >=', date('Y-m-d'));
        $this->db->where_in('pendaftaran.status', array('pending', 'disetujui'));
        $this->db->order_by('pendaftaran.tanggal_kunjungan', 'ASC');
        $this->db->order_by('pendaftaran.jam_kunjungan', 'ASC');
        return $this->db->get()->result();
    }

    public function insert($data) {
        $this->db->insert('pendaftaran', $data);
        return $this->db->insert_id();
    }

    public function update_status($id, $status, $catatan = NULL) {
        $this->db->where('id', $id);
        return $this->db->update('pendaftaran', array(
            'status'        => $status,
            'catatan_admin' => $catatan,
        ));
    }

    public function count_all() {
        return $this->db->count_all('pendaftaran');
    }

    public function count_by_status($status) {
        return $this->db->where('status', $status)->from('pendaftaran')->count_all_results();
    }

    public function get_per_bulan() {
        $this->db->select("DATE_FORMAT(created_at, '%Y-%m') AS bulan, COUNT(*) AS total");
        $this->db->from('pendaftaran');
        $this->db->where("created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)");
        $this->db->group_by('bulan');
        $this->db->order_by('bulan', 'ASC');
        return $this->db->get()->result();
    }

    public function get_per_dokter() {
        $this->db->select('dokter.nama AS nama_dokter, dokter.spesialis, COUNT(pendaftaran.id) AS total');
        $this->db->from('pendaftaran');
        $this->db->join('dokter', 'dokter.id = pendaftaran.dokter_id');
        $this->db->group_by('dokter.id');
        $this->db->order_by('total', 'DESC');
        return $this->db->get()->result();
    }
}