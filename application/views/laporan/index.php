<?php
/*
 * application/views/laporan/index.php
 * Halaman laporan & statistik admin
 */
?>
<!-- Statistik Card -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white shadow">
            <div class="card-body text-center">
                <div class="h2 font-weight-bold"><?= $total ?></div>
                <div>Total Pendaftaran</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white shadow">
            <div class="card-body text-center">
                <div class="h2 font-weight-bold"><?= $pending ?></div>
                <div>Pending</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white shadow">
            <div class="card-body text-center">
                <div class="h2 font-weight-bold"><?= $disetujui ?></div>
                <div>Disetujui</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white shadow">
            <div class="card-body text-center">
                <div class="h2 font-weight-bold"><?= $ditolak ?></div>
                <div>Ditolak</div>
            </div>
        </div>
    </div>
</div>

<!-- Tombol Export -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-download mr-2"></i>Export Laporan
        </h6>
    </div>
    <div class="card-body">
        <p class="text-muted mb-3">Unduh laporan pendaftaran pasien dalam format yang Anda inginkan.</p>
        <a href="<?= site_url('laporan/export_csv') ?>" class="btn btn-success mr-2">
            <i class="fas fa-file-csv mr-1"></i>Download CSV (Excel)
        </a>
        <a href="<?= site_url('laporan/export_pdf') ?>" class="btn btn-danger" target="_blank">
            <i class="fas fa-file-pdf mr-1"></i>Cetak / Simpan PDF
        </a>
    </div>
</div>

<!-- Statistik Per Dokter -->
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user-md mr-2"></i>Pendaftaran per Dokter
                </h6>
            </div>
            <div class="card-body">
                <?php if(!empty($per_dokter)): ?>
                <?php foreach($per_dokter as $d): ?>
                <div class="mb-2">
                    <div class="d-flex justify-content-between mb-1">
                        <small><strong><?= htmlspecialchars($d->nama_dokter) ?></strong></small>
                        <small><?= $d->total ?> pasien</small>
                    </div>
                    <div class="progress" style="height:8px">
                        <div class="progress-bar bg-primary" role="progressbar"
                            style="width: <?= $total > 0 ? round($d->total/$total*100) : 0 ?>%">
                        </div>
                    </div>
                    <small class="text-muted"><?= htmlspecialchars($d->spesialis) ?></small>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p class="text-muted text-center">Belum ada data</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-pie mr-2"></i>Proporsi Status
                </h6>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <?php if($total > 0): ?>
                <div class="w-100">
                    <?php
                    $items = array(
                        array('label'=>'Pending',   'val'=>$pending,   'color'=>'warning'),
                        array('label'=>'Disetujui', 'val'=>$disetujui, 'color'=>'success'),
                        array('label'=>'Ditolak',   'val'=>$ditolak,   'color'=>'danger'),
                    );
                    foreach($items as $item): ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-<?= $item['color'] ?> mr-2" style="width:14px;height:14px">
                            </div>
                            <span><?= $item['label'] ?></span>
                        </div>
                        <div>
                            <strong><?= $item['val'] ?></strong>
                            <small
                                class="text-muted ml-1">(<?= $total > 0 ? round($item['val']/$total*100) : 0 ?>%)</small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p class="text-muted">Belum ada data pendaftaran</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Lengkap -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-table mr-2"></i>Tabel Lengkap Pendaftaran
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Tgl Kunjungan</th>
                        <th>Status</th>
                        <th>Tgl Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($semua as $s): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($s->nama_pasien) ?></td>
                        <td><?= htmlspecialchars($s->nama_dokter) ?><br><small
                                class="text-muted"><?= htmlspecialchars($s->spesialis) ?></small></td>
                        <td><?= date('d M Y', strtotime($s->tanggal_kunjungan)) ?></td>
                        <td>
                            <?php $badge=array('pending'=>'warning','disetujui'=>'success','ditolak'=>'danger'); ?>
                            <span
                                class="badge badge-<?= $badge[$s->status]??'secondary' ?>"><?= strtoupper($s->status) ?></span>
                        </td>
                        <td><?= date('d M Y', strtotime($s->created_at)) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>