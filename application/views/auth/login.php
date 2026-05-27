<!DOCTYPE html>
<!--
  application/views/auth/login.php
-->
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | Sistem Pendaftaran Pasien RS</title>
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <i class="fas fa-hospital fa-3x text-primary mb-3"></i>
                                <h1 class="h4 text-gray-900">Sistem Pendaftaran Pasien</h1>
                                <p class="text-muted small">Masukkan username dan password Anda</p>
                            </div>

                            <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                <?= $this->session->flashdata('error') ?>
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                            <?php endif; ?>
                            <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success') ?>
                            </div>
                            <?php endif; ?>

                            <form method="POST" action="<?= site_url('auth/proses_login') ?>">
                                <div class="form-group">
                                    <label class="text-gray-600 small font-weight-bold">USERNAME</label>
                                    <input type="text" name="username" class="form-control form-control-user"
                                        placeholder="Masukkan username" value="<?= set_value('username') ?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="text-gray-600 small font-weight-bold">PASSWORD</label>
                                    <input type="password" name="password" class="form-control form-control-user"
                                        placeholder="Masukkan password" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    <i class="fas fa-sign-in-alt mr-1"></i> Login
                                </button>
                            </form>

                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= site_url('auth/register') ?>">
                                    <i class="fas fa-user-plus mr-1"></i>Belum punya akun? Daftar sebagai Pasien
                                </a>
                            </div>
                            <div class="text-center mt-2">
                                <small class="text-muted">
                                    Louis Hasashi Halim - 1224160052
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
</body>

</html>