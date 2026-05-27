<?php
/*
 * application/views/admin/pasien.php
 * Daftar & kelola data pasien
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-users mr-2"></i>Data Pasien
        </h6>
        <a href="<?= site_url('admin/tambah_pasien') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i>Tambah Pasien
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($pasien)): ?>
                    <?php $no = 1; foreach($pasien as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= htmlspecialchars($p->nama) ?></strong></td>
                        <td><?= date('d M Y', strtotime($p->tanggal_lahir)) ?></td>
                        <td><?= $p->jenis_kelamin == 'L' ? '<span class="badge badge-info">Laki-laki</span>' : '<span class="badge badge-pink" style="background:#e83e8c;color:#fff">Perempuan</span>' ?>
                        </td>
                        <td><?= htmlspecialchars($p->no_telepon) ?></td>
                        <td><?= htmlspecialchars(substr($p->alamat, 0, 40)) ?>...</td>
                        <td class="text-center">
                            <a href="<?= site_url('admin/edit_pasien/'.$p->id) ?>" class="btn btn-warning btn-sm mb-1"
                                title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= site_url('admin/hapus_pasien/'.$p->id) ?>" class="btn btn-danger btn-sm mb-1"
                                title="Hapus"
                                onclick="return confirm('Hapus data pasien <?= addslashes($p->nama) ?>? Semua pendaftarannya juga akan terhapus!')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data pasien</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>