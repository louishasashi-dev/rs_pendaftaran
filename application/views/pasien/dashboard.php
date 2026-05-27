<?php
/*
 * application/views/pasien/dashboard.php
 */
?>
<div class="row">
    <!-- Info Pasien -->
    <div class="col-md-5 mb-4">
        <div class="card border-left-success shadow h-100">
            <div class="card-header bg-gradient-success text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-user mr-2"></i>Data Diri Anda
                </h6>
            </div>
            <div class="card-body">
                <?php if($pasien): ?>
                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <td width="40%"><small class="text-muted">Nama</small></td>
                        <td><strong><?= htmlspecialchars($pasien->nama) ?></strong></td>
                    </tr>
                    <tr>
                        <td><small class="text-muted">Tgl Lahir</small></td>
                        <td><?= date('d M Y', strtotime($pasien->tanggal_lahir)) ?></td>
                    </tr>
                    <tr>
                        <td><small class="text-muted">No. Telepon</small></td>
                        <td><?= htmlspecialchars($pasien->no_telepon) ?></td>
                    </tr>
                    <tr>
                        <td><small class="text-muted">Alamat</small></td>
                        <td><?= htmlspecialchars($pasien->alamat) ?></td>
                    </tr>
                </table>
                <?php else: ?>
                <div class="text-center py-3">
                    <i class="fas fa-user-plus fa-3x text-gray-300 mb-3"></i>
                    <p class="text-muted">Lengkapi profil Anda saat melakukan pendaftaran pertama.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Statistik pendaftaran pasien -->
    <div class="col-md-7 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-pie mr-2"></i>Ringkasan Pendaftaran
                </h6>
            </div>
            <div class="card-body">
                <?php
                $total     = count($riwayat);
                $setuju    = count(array_filter($riwayat, fn($r) => $r->status == 'disetujui'));
                $tolak     = count(array_filter($riwayat, fn($r) => $r->status == 'ditolak'));
                $pending   = count(array_filter($riwayat, fn($r) => $r->status == 'pending'));
                ?>
                <div class="row text-center">
                    <div class="col-3">
                        <div class="h4 font-weight-bold text-primary"><?= $total ?></div>
                        <small class="text-muted">Total</small>
                    </div>
                    <div class="col-3">
                        <div class="h4 font-weight-bold text-warning"><?= $pending ?></div>
                        <small class="text-muted">Pending</small>
                    </div>
                    <div class="col-3">
                        <div class="h4 font-weight-bold text-success"><?= $setuju ?></div>
                        <small class="text-muted">Disetujui</small>
                    </div>
                    <div class="col-3">
                        <div class="h4 font-weight-bold text-danger"><?= $tolak ?></div>
                        <small class="text-muted">Ditolak</small>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <a href="<?= site_url('pasien/daftar') ?>" class="btn btn-success btn-sm mr-2">
                        <i class="fas fa-plus mr-1"></i>Daftar Berobat
                    </a>
                    <a href="<?= site_url('pasien/status') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-list mr-1"></i>Lihat Status
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Riwayat Pendaftaran Terbaru -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-history mr-2"></i>Riwayat Pendaftaran Terbaru
        </h6>
        <a href="<?= site_url('pasien/status') ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
    </div>
    <div class="card-body">
        <?php if(!empty($riwayat)): ?>
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Dokter</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(array_slice($riwayat, 0, 3) as $r): ?>
                    <tr>
                        <td><?= htmlspecialchars($r->nama_dokter) ?><br><small
                                class="text-muted"><?= htmlspecialchars($r->spesialis) ?></small></td>
                        <td><?= date('d M Y', strtotime($r->tanggal_kunjungan)) ?>
                            <small><?= date('H:i', strtotime($r->jam_kunjungan)) ?></small></td>
                        <td>
                            <?php $badge = array('pending'=>'warning','disetujui'=>'success','ditolak'=>'danger'); ?>
                            <span class="badge badge-<?= $badge[$r->status] ?>">
                                <?= strtoupper($r->status) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="text-center py-4">
            <i class="fas fa-clipboard fa-3x text-gray-300 mb-3"></i>
            <p class="text-muted">Anda belum pernah mendaftar. <a href="<?= site_url('pasien/daftar') ?>">Daftar
                    sekarang</a></p>
        </div>
        <?php endif; ?>
    </div>
</div>