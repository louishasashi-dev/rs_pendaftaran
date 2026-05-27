<?php
/*
 * application/views/admin/dashboard.php
 */
?>
<!-- Statistik Cards -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pendaftaran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pendaftaran ?></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Disetujui</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_disetujui ?></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-check-circle fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ditolak</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_ditolak ?></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-times-circle fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Pasien</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pasien ?></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pendaftaran Terbaru -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-clock mr-2"></i>Pendaftaran Terbaru
        </h6>
        <a href="<?= site_url('admin/pendaftaran') ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($pendaftaran_terbaru)): ?>
                    <?php foreach($pendaftaran_terbaru as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p->nama_pasien) ?></td>
                        <td><?= htmlspecialchars($p->nama_dokter) ?></td>
                        <td><?= date('d M Y', strtotime($p->tanggal_kunjungan)) ?></td>
                        <td>
                            <?php
                                $badge = array(
                                    'pending'   => 'warning',
                                    'disetujui' => 'success',
                                    'ditolak'   => 'danger',
                                );
                                $b = $badge[$p->status] ?? 'secondary';
                                ?>
                            <span class="badge badge-<?= $b ?>">
                                <?= strtoupper($p->status) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada pendaftaran</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Quick Links -->
<div class="row">
    <div class="col-md-4 mb-4">
        <a href="<?= site_url('admin/pendaftaran') ?>" class="btn btn-primary btn-block py-3">
            <i class="fas fa-clipboard-check fa-2x d-block mb-2"></i>
            Kelola Pendaftaran
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="<?= site_url('admin/pasien') ?>" class="btn btn-success btn-block py-3">
            <i class="fas fa-users fa-2x d-block mb-2"></i>
            Data Pasien
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="<?= site_url('laporan') ?>" class="btn btn-info btn-block py-3">
            <i class="fas fa-chart-bar fa-2x d-block mb-2"></i>
            Laporan & Statistik
        </a>
    </div>
</div>