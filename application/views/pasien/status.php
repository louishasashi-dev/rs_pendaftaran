<?php
/*
 * application/views/pasien/status.php
 * Menampilkan status pendaftaran milik pasien yang login
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-list-alt mr-2"></i>Status Pendaftaran Saya
        </h6>
        <a href="<?= site_url('pasien/daftar') ?>" class="btn btn-success btn-sm">
            <i class="fas fa-plus mr-1"></i>Daftar Baru
        </a>
    </div>
    <div class="card-body">

        <!-- Legenda Status -->
        <div class="mb-3">
            <span class="badge badge-warning mr-2 py-2 px-3">
                <i class="fas fa-clock mr-1"></i>PENDING — Menunggu konfirmasi admin
            </span>
            <span class="badge badge-success mr-2 py-2 px-3">
                <i class="fas fa-check mr-1"></i>DISETUJUI — Kunjungan dikonfirmasi
            </span>
            <span class="badge badge-danger py-2 px-3">
                <i class="fas fa-times mr-1"></i>DITOLAK — Lihat alasan di catatan
            </span>
        </div>

        <?php if(!empty($pendaftaran)): ?>
        <div class="row">
            <?php foreach($pendaftaran as $p): ?>
            <?php
            $badgeMap = array('pending'=>'warning','disetujui'=>'success','ditolak'=>'danger');
            $iconMap  = array('pending'=>'clock','disetujui'=>'check-circle','ditolak'=>'times-circle');
            $b = $badgeMap[$p->status] ?? 'secondary';
            $ic = $iconMap[$p->status] ?? 'question-circle';
            ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-<?= $b ?> shadow-sm h-100">
                    <div
                        class="card-header bg-<?= $b ?> text-white d-flex justify-content-between align-items-center py-2">
                        <span>
                            <i class="fas fa-<?= $ic ?> mr-1"></i><?= strtoupper($p->status) ?>
                        </span>
                        <small><?= date('d M Y', strtotime($p->created_at)) ?></small>
                    </div>
                    <div class="card-body">
                        <h6 class="font-weight-bold"><?= htmlspecialchars($p->nama_dokter) ?></h6>
                        <small class="text-muted"><?= htmlspecialchars($p->spesialis) ?></small>

                        <table class="table table-borderless table-sm mt-2 mb-0 small">
                            <tr>
                                <td class="text-muted pl-0">Tanggal</td>
                                <td><strong><?= date('d M Y', strtotime($p->tanggal_kunjungan)) ?></strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted pl-0">Jam</td>
                                <td><?= date('H:i', strtotime($p->jam_kunjungan)) ?> WIB</td>
                            </tr>
                            <tr>
                                <td class="text-muted pl-0" valign="top">Keluhan</td>
                                <td><?= htmlspecialchars(substr($p->keluhan, 0, 80)) ?>...</td>
                            </tr>
                        </table>

                        <?php if($p->catatan_admin): ?>
                        <div class="alert alert-<?= $b ?> mt-2 mb-0 py-2 small">
                            <i class="fas fa-comment mr-1"></i>
                            <strong>Catatan Admin:</strong> <?= htmlspecialchars($p->catatan_admin) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-inbox fa-4x text-gray-300 mb-4"></i>
            <h5 class="text-muted">Belum ada riwayat pendaftaran</h5>
            <p class="text-muted mb-4">Anda belum pernah mendaftar berobat.</p>
            <a href="<?= site_url('pasien/daftar') ?>" class="btn btn-success">
                <i class="fas fa-plus mr-2"></i>Daftar Sekarang
            </a>
        </div>
        <?php endif; ?>

    </div>
</div>