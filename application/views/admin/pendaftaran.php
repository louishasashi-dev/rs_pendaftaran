<?php
/*
 * application/views/admin/pendaftaran.php
 * Manajemen pendaftaran: approve / tolak
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-clipboard-list mr-2"></i>Daftar Pendaftaran Pasien
        </h6>
        <div>
            <span class="badge badge-warning mr-1">Pending:
                <?= array_sum(array_map(fn($p) => $p->status=='pending',   $pendaftaran)) ?></span>
            <span class="badge badge-success mr-1">Disetujui:
                <?= array_sum(array_map(fn($p) => $p->status=='disetujui', $pendaftaran)) ?></span>
            <span class="badge badge-danger">Ditolak:
                <?= array_sum(array_map(fn($p) => $p->status=='ditolak',  $pendaftaran)) ?></span>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Pasien</th>
                        <th>Dokter / Spesialis</th>
                        <th>Keluhan</th>
                        <th>Tgl Kunjungan</th>
                        <th>Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($pendaftaran)): ?>
                    <?php $no = 1; foreach($pendaftaran as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <strong><?= htmlspecialchars($p->nama_pasien) ?></strong>
                            <br><small class="text-muted"><?= htmlspecialchars($p->no_telepon) ?></small>
                        </td>
                        <td>
                            <?= htmlspecialchars($p->nama_dokter) ?>
                            <br><small class="text-muted"><?= htmlspecialchars($p->spesialis) ?></small>
                        </td>
                        <td>
                            <span title="<?= htmlspecialchars($p->keluhan) ?>">
                                <?= htmlspecialchars(substr($p->keluhan, 0, 50)) ?><?= strlen($p->keluhan) > 50 ? '...' : '' ?>
                            </span>
                        </td>
                        <td>
                            <?= date('d M Y', strtotime($p->tanggal_kunjungan)) ?>
                            <br><small><?= date('H:i', strtotime($p->jam_kunjungan)) ?> WIB</small>
                        </td>
                        <td class="text-center">
                            <?php
                                $badge = array('pending'=>'warning','disetujui'=>'success','ditolak'=>'danger');
                                $b = $badge[$p->status] ?? 'secondary';
                                ?>
                            <span class="badge badge-<?= $b ?>">
                                <?= strtoupper($p->status) ?>
                            </span>
                            <?php if($p->catatan_admin): ?>
                            <br><small class="text-muted"><?= htmlspecialchars($p->catatan_admin) ?></small>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($p->status == 'pending'): ?>
                            <!-- Tombol Setujui -->
                            <button type="button" class="btn btn-success btn-sm mb-1" data-toggle="modal"
                                data-target="#modalSetujui<?= $p->id ?>">
                                <i class="fas fa-check"></i>
                            </button>
                            <!-- Tombol Tolak -->
                            <button type="button" class="btn btn-danger btn-sm mb-1" data-toggle="modal"
                                data-target="#modalTolak<?= $p->id ?>">
                                <i class="fas fa-times"></i>
                            </button>

                            <!-- Modal Setujui -->
                            <div class="modal fade" id="modalSetujui<?= $p->id ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title"><i class="fas fa-check mr-2"></i>Setujui Pendaftaran
                                            </h5>
                                            <button type="button" class="close text-white"
                                                data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form method="POST" action="<?= site_url('admin/setujui/'.$p->id) ?>">
                                            <div class="modal-body">
                                                <p>Setujui pendaftaran
                                                    <strong><?= htmlspecialchars($p->nama_pasien) ?></strong>?</p>
                                                <div class="form-group">
                                                    <label>Catatan untuk Pasien (opsional)</label>
                                                    <textarea name="catatan" class="form-control" rows="2"
                                                        placeholder="Contoh: Harap datang 15 menit lebih awal..."></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-check mr-1"></i>Setujui
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Tolak -->
                            <div class="modal fade" id="modalTolak<?= $p->id ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title"><i class="fas fa-times mr-2"></i>Tolak Pendaftaran
                                            </h5>
                                            <button type="button" class="close text-white"
                                                data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form method="POST" action="<?= site_url('admin/tolak/'.$p->id) ?>">
                                            <div class="modal-body">
                                                <p>Tolak pendaftaran
                                                    <strong><?= htmlspecialchars($p->nama_pasien) ?></strong>?</p>
                                                <div class="form-group">
                                                    <label>Alasan Penolakan <span class="text-danger">*</span></label>
                                                    <textarea name="catatan" class="form-control" rows="2"
                                                        placeholder="Contoh: Dokter sedang tidak tersedia..."
                                                        required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-times mr-1"></i>Tolak
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <?php else: ?>
                            <small class="text-muted">—</small>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data pendaftaran</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>