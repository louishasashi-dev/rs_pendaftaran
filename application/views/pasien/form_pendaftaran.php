<?php
/*
 * application/views/pasien/form_pendaftaran.php
 * Formulir pendaftaran online pasien dengan validasi
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-gradient-success text-white">
        <h6 class="m-0 font-weight-bold">
            <i class="fas fa-plus-circle mr-2"></i>Formulir Pendaftaran Berobat
        </h6>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i class="fas fa-info-circle mr-2"></i>
            Lengkapi semua data di bawah ini. Pastikan data diri Anda sudah benar.
            Pendaftaran akan diproses oleh admin dalam 1x24 jam.
        </div>

        <form method="POST" action="<?= site_url('pasien/simpan_pendaftaran') ?>" id="formPendaftaran">

            <!-- Data Diri -->
            <h5 class="text-success mb-3"><i class="fas fa-user mr-2"></i>Data Diri</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control"
                            value="<?= ($pasien ?? null) ? htmlspecialchars($pasien->nama) : set_value('nama') ?>"
                            placeholder="Nama sesuai KTP" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                            value="<?= ($pasien ?? null) ? $pasien->tanggal_lahir : set_value('tanggal_lahir') ?>"
                            max="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="L"
                                <?= ($pasien ?? null) && $pasien->jenis_kelamin=='L' ? 'selected' : set_select('jenis_kelamin','L') ?>>
                                Laki-laki</option>
                            <option value="P"
                                <?= ($pasien ?? null) && $pasien->jenis_kelamin=='P' ? 'selected' : set_select('jenis_kelamin','P') ?>>
                                Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>No. Telepon <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="fas fa-phone"></i></span></div>
                            <input type="text" name="no_telepon" class="form-control" placeholder="08xxxxxxxxxx"
                                value="<?= ($pasien ?? null) ? htmlspecialchars($pasien->no_telepon) : set_value('no_telepon') ?>"
                                minlength="10" maxlength="15" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Alamat Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="alamat" class="form-control"
                            placeholder="Jl., RT/RW, Kelurahan, Kecamatan, Kota"
                            value="<?= ($pasien ?? null) ? htmlspecialchars($pasien->alamat) : set_value('alamat') ?>"
                            required>
                    </div>
                </div>
            </div>

            <hr>
            <!-- Data Kunjungan -->
            <h5 class="text-success mb-3"><i class="fas fa-stethoscope mr-2"></i>Data Kunjungan</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Pilih Dokter / Spesialis <span class="text-danger">*</span></label>
                        <select name="dokter_id" id="dokter_id" class="form-control" required>
                            <option value="">-- Pilih Dokter --</option>
                            <?php foreach($dokter as $d): ?>
                            <option value="<?= $d->id ?>" data-jadwal="<?= htmlspecialchars($d->jadwal) ?>"
                                <?= set_select('dokter_id', $d->id) ?>>
                                <?= htmlspecialchars($d->nama) ?> — <?= htmlspecialchars($d->spesialis) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <small id="infoJadwal" class="text-success font-weight-bold mt-1 d-none">
                            <i class="fas fa-clock mr-1"></i><span id="jadwalText"></span>
                        </small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Kunjungan <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" class="form-control"
                            min="<?= date('Y-m-d') ?>" value="<?= set_value('tanggal_kunjungan') ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Jam Kunjungan <span class="text-danger">*</span></label>
                        <input type="time" name="jam_kunjungan" class="form-control" min="07:00" max="20:00"
                            value="<?= set_value('jam_kunjungan') ?>" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Keluhan / Kondisi yang Dialami <span class="text-danger">*</span></label>
                        <textarea name="keluhan" id="keluhan" class="form-control" rows="4"
                            placeholder="Ceritakan keluhan atau kondisi yang Anda alami secara singkat (minimal 10 karakter)..."
                            minlength="10" required><?= set_value('keluhan') ?></textarea>
                        <small class="text-muted">
                            <span id="charCount">0</span> karakter (min. 10)
                        </small>
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?= site_url('pasien/dashboard') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali
                </a>
                <button type="submit" class="btn btn-success" id="btnSubmit">
                    <i class="fas fa-paper-plane mr-1"></i>Kirim Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Tampilkan jadwal dokter saat dipilih
document.getElementById('dokter_id').addEventListener('change', function() {
    var selected = this.options[this.selectedIndex];
    var jadwal = selected.getAttribute('data-jadwal');
    if (jadwal && this.value) {
        document.getElementById('jadwalText').textContent = 'Jadwal praktek: ' + jadwal;
        document.getElementById('infoJadwal').classList.remove('d-none');
    } else {
        document.getElementById('infoJadwal').classList.add('d-none');
    }
});

// Counter karakter keluhan
document.getElementById('keluhan').addEventListener('input', function() {
    document.getElementById('charCount').textContent = this.value.length;
});

// Validasi form sebelum submit
document.getElementById('formPendaftaran').addEventListener('submit', function(e) {
    var keluhan = document.getElementById('keluhan').value.trim();
    if (keluhan.length < 10) {
        e.preventDefault();
        alert('Keluhan harus minimal 10 karakter!');
        document.getElementById('keluhan').focus();
        return false;
    }
    document.getElementById('btnSubmit').disabled = true;
    document.getElementById('btnSubmit').innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Mengirim...';
});
</script>