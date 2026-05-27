<?php
/*
 * application/views/admin/form_pasien.php
 * Dipakai untuk tambah DAN edit pasien
 * Jika $pasien tidak NULL → mode edit
 */
$edit = isset($pasien) && $pasien;
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-<?= $edit ? 'edit' : 'plus' ?> mr-2"></i>
            <?= $edit ? 'Edit Data Pasien' : 'Tambah Pasien Baru' ?>
        </h6>
    </div>
    <div class="card-body">
        <form method="POST"
            action="<?= site_url($edit ? 'admin/update_pasien/'.$pasien->id : 'admin/simpan_pasien') ?>">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control"
                            value="<?= $edit ? htmlspecialchars($pasien->nama) : set_value('nama') ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                            value="<?= $edit ? $pasien->tanggal_lahir : set_value('tanggal_lahir') ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="L"
                                <?= ($edit && $pasien->jenis_kelamin=='L') ? 'selected' : set_select('jenis_kelamin','L') ?>>
                                Laki-laki</option>
                            <option value="P"
                                <?= ($edit && $pasien->jenis_kelamin=='P') ? 'selected' : set_select('jenis_kelamin','P') ?>>
                                Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No. Telepon <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" name="no_telepon" class="form-control" placeholder="08xxxxxxxxxx"
                                value="<?= $edit ? htmlspecialchars($pasien->no_telepon) : set_value('no_telepon') ?>"
                                required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control"
                                value="<?= $edit ? htmlspecialchars($pasien->email) : set_value('email') ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control" rows="3"
                            required><?= $edit ? htmlspecialchars($pasien->alamat) : set_value('alamat') ?></textarea>
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?= site_url('admin/pasien') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i><?= $edit ? 'Perbarui Data' : 'Simpan Data' ?>
                </button>
            </div>
        </form>
    </div>
</div>