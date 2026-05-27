<?php
/*
 * application/views/admin/jadwal.php
 * Jadwal pendaftaran mendatang
 */
?>
<div class="row mb-4">
    <div class="col-md-12">
        <div class="alert alert-info">
            <i class="fas fa-info-circle mr-2"></i>
            Menampilkan jadwal kunjungan pasien mulai hari ini yang berstatus <strong>Pending</strong> atau
            <strong>Disetujui</strong>.
        </div>
    </div>
</div>

<!-- Filter per Dokter -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-calendar-alt mr-2"></i>Jadwal Kunjungan Pasien
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal & Jam</th>
                        <th>Nama Pasien</th>
                        <th>No. Telepon</th>
                        <th>Dokter / Spesialis</th>
                        <th>Keluhan Singkat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($jadwal)): ?>
                    <?php $no = 1; foreach($jadwal as $j): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <strong><?= date('d M Y', strtotime($j->tanggal_kunjungan)) ?></strong>
                            <br><span class="text-primary"><?= date('H:i', strtotime($j->jam_kunjungan)) ?> WIB</span>
                        </td>
                        <td><?= htmlspecialchars($j->nama_pasien) ?></td>
                        <td><?= htmlspecialchars($j->no_telepon) ?></td>
                        <td>
                            <?= htmlspecialchars($j->nama_dokter) ?>
                            <br><small class="text-muted"><?= htmlspecialchars($j->spesialis) ?></small>
                        </td>
                        <td><?= htmlspecialchars(substr($j->keluhan, 0, 50)) ?>...</td>
                        <td>
                            <?php $badge = array('pending'=>'warning','disetujui'=>'success','ditolak'=>'danger'); ?>
                            <span class="badge badge-<?= $badge[$j->status] ?? 'secondary' ?>">
                                <?= strtoupper($j->status) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fas fa-calendar-times fa-3x mb-3 d-block text-gray-300"></i>
                            Tidak ada jadwal kunjungan mendatang
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Jadwal Dokter -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">
            <i class="fas fa-user-md mr-2"></i>Jadwal Praktek Dokter
        </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <?php foreach($dokter as $d): ?>
            <div class="col-md-4 mb-3">
                <div class="card border-left-success">
                    <div class="card-body py-2">
                        <strong><?= htmlspecialchars($d->nama) ?></strong><br>
                        <small class="text-muted"><?= htmlspecialchars($d->spesialis) ?></small><br>
                        <small class="text-success"><i
                                class="fas fa-clock mr-1"></i><?= htmlspecialchars($d->jadwal) ?></small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>