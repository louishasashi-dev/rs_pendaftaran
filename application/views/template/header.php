<!DOCTYPE html>
<!--
  application/views/template/header.php
  Template header untuk halaman ADMIN menggunakan SB Admin 2
-->
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= isset($title) ? htmlspecialchars($title) : 'RS Pendaftaran' ?> | Admin Panel</title>

    <!-- SB Admin 2 CSS -->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- ===================== SIDEBAR ===================== -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="<?= site_url('admin/dashboard') ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="sidebar-brand-text mx-3">RS Pendaftaran</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li
                class="nav-item <?= ($this->uri->segment(2) == 'dashboard' || $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('admin/dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Pendaftaran</div>

            <li class="nav-item <?= $this->uri->segment(2) == 'pendaftaran' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('admin/pendaftaran') ?>">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Manajemen Pendaftaran</span>
                </a>
            </li>

            <li class="nav-item <?= $this->uri->segment(2) == 'jadwal' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('admin/jadwal') ?>">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Jadwal Kunjungan</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Master Data</div>

            <li class="nav-item <?= $this->uri->segment(2) == 'pasien' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('admin/pasien') ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Pasien</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Laporan</div>

            <li class="nav-item <?= $this->uri->segment(1) == 'laporan' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('laporan') ?>">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Laporan & Statistik</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- ===================== END SIDEBAR ===================== -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- ================ TOPBAR ================ -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?= htmlspecialchars($this->session->userdata('username')) ?>
                                    <small class="text-muted">(Admin)</small>
                                </span>
                                <i class="fas fa-user-circle fa-2x text-primary"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a class="dropdown-item" href="<?= site_url('auth/logout') ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- ================ END TOPBAR ================ -->

                <!-- ================ PAGE CONTENT ================ -->
                <div class="container-fluid">

                    <!-- Alert Flash Messages -->
                    <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                    <?php endif; ?>
                    <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <?= $this->session->flashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                    <?php endif; ?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            <?= isset($title) ? htmlspecialchars($title) : '' ?>
                        </h1>
                    </div>