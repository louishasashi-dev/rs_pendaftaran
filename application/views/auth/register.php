<!DOCTYPE html>
<!--
  application/views/auth/register.php
-->
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Daftar Akun | Sistem Pendaftaran Pasien RS</title>
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>

<body class="bg-gradient-success">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-9 col-md-10">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <i class="fas fa-user-plus fa-3x text-success mb-3"></i>
                                <h1 class="h4 text-gray-900">Daftar Akun Pasien</h1>
                                <p class="text-muted small">Isi data diri Anda untuk membuat akun pasien</p>
                            </div>

                            <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error') ?>
                            </div>
                            <?php endif; ?>

                            <form method="POST" action="<?= site_url('auth/proses_register') ?>">

                                <h6 class="font-weight-bold text-success mb-3">
                                    <i class="fas fa-lock mr-1"></i> Data Login
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Username <span class="text-danger">*</span></label>
                                            <input type="text" name="username" class="form-control"
                                                placeholder="Min. 4 karakter" value="<?= set_value('username') ?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password <span class="text-danger">*</span></label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Min. 6 karakter" required>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h6 class="font-weight-bold text-success mb-3">
                                    <i class="fas fa-user mr-1"></i> Data Diri
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" name="nama" class="form-control"
                                                value="<?= set_value('nama') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control"
                                                value="<?= set_value('email') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                            <input type="date" name="tanggal_lahir" class="form-control"
                                                value="<?= set_value('tanggal_lahir') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                            <select name="jenis_kelamin" class="form-control" required>
                                                <option value="">-- Pilih --</option>
                                                <option value="L" <?= set_select('jenis_kelamin','L') ?>>Laki-laki
                                                </option>
                                                <option value="P" <?= set_select('jenis_kelamin','P') ?>>Perempuan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No. Telepon <span class="text-danger">*</span></label>
                                            <input type="text" name="no_telepon" class="form-control"
                                                placeholder="08xxxxxxxxxx" value="<?= set_value('no_telepon') ?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat <span class="text-danger">*</span></label>
                                            <textarea name="alamat" class="form-control" rows="2"
                                                placeholder="Alamat lengkap"
                                                required><?= set_value('alamat') ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success btn-user btn-block">
                                    <i class="fas fa-user-plus mr-1"></i> Buat Akun
                                </button>
                            </form>

                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= site_url('auth') ?>">
                                    <i class="fas fa-sign-in-alt mr-1"></i> Sudah punya akun? Login
                                </a>
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