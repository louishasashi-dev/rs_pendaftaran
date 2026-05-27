<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override']       = '';
$route['translate_uri_dashes'] = FALSE;

// AUTH
$route['auth']                 = 'auth/index';
$route['auth/proses_login']    = 'auth/proses_login';
$route['auth/logout']          = 'auth/logout';
$route['auth/register']        = 'auth/register';
$route['auth/proses_register'] = 'auth/proses_register';

// ADMIN
$route['admin']                          = 'admin/dashboard';
$route['admin/dashboard']                = 'admin/dashboard';
$route['admin/pendaftaran']              = 'admin/pendaftaran';
$route['admin/setujui/(:num)']           = 'admin/setujui/$1';
$route['admin/tolak/(:num)']             = 'admin/tolak/$1';
$route['admin/pasien']                   = 'admin/pasien';
$route['admin/tambah_pasien']            = 'admin/tambah_pasien';
$route['admin/simpan_pasien']            = 'admin/simpan_pasien';
$route['admin/edit_pasien/(:num)']       = 'admin/edit_pasien/$1';
$route['admin/update_pasien/(:num)']     = 'admin/update_pasien/$1';
$route['admin/hapus_pasien/(:num)']      = 'admin/hapus_pasien/$1';
$route['admin/jadwal']                   = 'admin/jadwal';

// PASIEN
$route['pasien/dashboard']               = 'pasien/dashboard';
$route['pasien/daftar']                  = 'pasien/daftar';
$route['pasien/simpan_pendaftaran']      = 'pasien/simpan_pendaftaran';
$route['pasien/status']                  = 'pasien/status';

// LAPORAN
$route['laporan']                        = 'laporan/index';
$route['laporan/export_csv']             = 'laporan/export_csv';
$route['laporan/export_pdf']             = 'laporan/export_pdf';