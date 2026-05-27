<!DOCTYPE html>
<!--
  application/views/laporan/pdf.php
  View khusus untuk cetak/print → Save as PDF di browser
  Tanpa load SB Admin 2, hanya CSS minimal
-->
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Laporan Pendaftaran Pasien</title>
    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Arial', sans-serif;
        font-size: 12px;
        color: #333;
        background: #fff;
    }

    .header {
        text-align: center;
        border-bottom: 3px double #333;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .header h2 {
        font-size: 18px;
        margin-bottom: 4px;
    }

    .header p {
        font-size: 11px;
        color: #555;
    }

    .stats {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .stat-box {
        flex: 1;
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
        border-radius: 4px;
    }

    .stat-box .num {
        font-size: 22px;
        font-weight: bold;
    }

    .stat-box.primary .num {
        color: #4e73df;
    }

    .stat-box.warning .num {
        color: #f6c23e;
    }

    .stat-box.success .num {
        color: #1cc88a;
    }

    .stat-box.danger .num {
        color: #e74a3b;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th {
        background: #4e73df;
        color: white;
        padding: 7px 8px;
        text-align: left;
        font-size: 11px;
    }

    td {
        padding: 6px 8px;
        border-bottom: 1px solid #eee;
        font-size: 11px;
        vertical-align: top;
    }

    tr:nth-child(even) td {
        background: #f8f9fc;
    }

    .badge {
        padding: 2px 7px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .badge-warning {
        background: #fff3cd;
        color: #856404;
    }

    .badge-success {
        background: #d1e7dd;
        color: #0f5132;
    }

    .badge-danger {
        background: #f8d7da;
        color: #842029;
    }

    .footer {
        text-align: center;
        color: #999;
        font-size: 10px;
        border-top: 1px solid #eee;
        padding-top: 10px;
    }

    @media print {
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .no-print {
            display: none !important;
        }

        th {
            background: #4e73df !important;
            color: white !important;
        }
    }
    </style>
</head>

<body>

    <!-- Tombol cetak (disembunyikan saat print) -->
    <div class="no-print" style="text-align:center;padding:15px;background:#f8f9fc;margin-bottom:20px">
        <button onclick="window.print()"
            style="background:#e74a3b;color:#fff;border:none;padding:10px 25px;border-radius:4px;font-size:14px;cursor:pointer;margin-right:10px">
            🖨 Cetak / Simpan PDF
        </button>
        <button onclick="window.close()"
            style="background:#858796;color:#fff;border:none;padding:10px 25px;border-radius:4px;font-size:14px;cursor:pointer">
            ✕ Tutup
        </button>
    </div>

    <div style="padding: 20px 40px">

        <!-- Header -->
        <div class="header">
            <h2>LAPORAN DATA PENDAFTARAN PASIEN</h2>
            <h3 style="font-size:14px;margin-bottom:6px">RS Pendaftaran — Sistem Informasi Kesehatan</h3>
            <p>Dicetak pada: <?= $tanggal ?> | Total Data: <?= $total ?> pendaftaran</p>
        </div>

        <!-- Ringkasan Statistik -->
        <div class="stats">
            <div class="stat-box primary">
                <div class="num"><?= $total ?></div>
                <div>Total Pendaftaran</div>
            </div>
            <div class="stat-box warning">
                <div class="num"><?= $pending ?></div>
                <div>Pending</div>
            </div>
            <div class="stat-box success">
                <div class="num"><?= $disetujui ?></div>
                <div>Disetujui</div>
            </div>
            <div class="stat-box danger">
                <div class="num"><?= $ditolak ?></div>
                <div>Ditolak</div>
            </div>
        </div>

        <!-- Tabel Data -->
        <table>
            <thead>
                <tr>
                    <th width="4%">No</th>
                    <th width="18%">Nama Pasien</th>
                    <th width="18%">Dokter</th>
                    <th width="14%">Spesialis</th>
                    <th width="22%">Keluhan</th>
                    <th width="11%">Tgl Kunjungan</th>
                    <th width="7%">Jam</th>
                    <th width="6%">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($pendaftaran)): ?>
                <?php $no = 1; foreach($pendaftaran as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($p->nama_pasien) ?></td>
                    <td><?= htmlspecialchars($p->nama_dokter) ?></td>
                    <td><?= htmlspecialchars($p->spesialis) ?></td>
                    <td><?= htmlspecialchars(substr($p->keluhan, 0, 60)) ?>...</td>
                    <td><?= date('d/m/Y', strtotime($p->tanggal_kunjungan)) ?></td>
                    <td><?= date('H:i', strtotime($p->jam_kunjungan)) ?></td>
                    <td>
                        <?php $badge=array('pending'=>'warning','disetujui'=>'success','ditolak'=>'danger'); ?>
                        <span class="badge badge-<?= $badge[$p->status]??'secondary' ?>">
                            <?= $p->status ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align:center;padding:20px;color:#999">Belum ada data</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="footer">
            <p>Laporan ini digenerate otomatis oleh Sistem Pendaftaran Pasien RS pada <?= $tanggal ?></p>
            <p>© <?= date('Y') ?> Sistem Informasi RS — Dibuat menggunakan CodeIgniter 3</p>
        </div>

    </div>

    <script>
    // Auto-trigger print dialog
    window.onload = function() {
        // Uncomment baris berikut jika ingin otomatis membuka dialog print:
        // window.print();
    };
    </script>
</body>

</html>