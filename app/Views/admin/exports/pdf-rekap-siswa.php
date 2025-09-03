<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header h2 {
            margin: 5px 0;
            font-size: 16px;
            font-weight: normal;
        }
        .info {
            margin-bottom: 20px;
        }
        .info table {
            width: 100%;
        }
        .info td {
            padding: 3px 0;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .data-table th,
        .data-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            font-size: 10px;
        }
        .data-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        .status-badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }
        .status-calon { background-color: #fef3c7; color: #92400e; }
        .status-siswa { background-color: #d1fae5; color: #065f46; }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SD NAHDLATUL ULAMA</h1>
        <h2><?= $title ?></h2>
    </div>

    <div class="info">
        <table>
            <tr>
                <td width="150"><strong>Tanggal Cetak:</strong></td>
                <td><?= $generated_at ?></td>
                <td width="150"><strong>Total Data:</strong></td>
                <td><?= count($students) ?> siswa</td>
            </tr>
            <?php if (!empty($filters['tahun_ajaran'])): ?>
            <tr>
                <td><strong>Tahun Ajaran:</strong></td>
                <td><?= esc($filters['tahun_ajaran']) ?></td>
                <td></td>
                <td></td>
            </tr>
            <?php endif; ?>
            <?php if (!empty($filters['status'])): ?>
            <tr>
                <td><strong>Status:</strong></td>
                <td><?= ucfirst($filters['status']) ?></td>
                <td></td>
                <td></td>
            </tr>
            <?php endif; ?>
            <?php if (!empty($filters['tanggal_dari']) || !empty($filters['tanggal_sampai'])): ?>
            <tr>
                <td><strong>Periode:</strong></td>
                <td>
                    <?= !empty($filters['tanggal_dari']) ? date('d/m/Y', strtotime($filters['tanggal_dari'])) : '...' ?>
                    s/d
                    <?= !empty($filters['tanggal_sampai']) ? date('d/m/Y', strtotime($filters['tanggal_sampai'])) : '...' ?>
                </td>
                <td></td>
                <td></td>
            </tr>
            <?php endif; ?>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="30">No.</th>
                <th width="100">No. Registrasi</th>
                <th width="150">Nama Lengkap</th>
                <th width="70">Jenis Kelamin</th>
                <th width="120">Tempat, Tanggal Lahir</th>
                <th width="120">Nama Orang Tua</th>
                <th width="80">Status</th>
                <th width="80">Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students)): ?>
                <?php $no = 1; foreach ($students as $student): ?>
                    <tr>
                        <td style="text-align: center;"><?= $no++ ?></td>
                        <td><?= esc($student['no_registrasi']) ?></td>
                        <td><?= esc($student['nama_lengkap']) ?></td>
                        <td><?= $student['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                        <td>
                            <?= esc($student['tempat_lahir']) ?>, 
                            <?= date('d/m/Y', strtotime($student['tanggal_lahir'])) ?>
                        </td>
                        <td>
                            Ayah: <?= esc($student['nama_ayah']) ?><br>
                            Ibu: <?= esc($student['nama_ibu']) ?>
                        </td>
                        <td style="text-align: center;">
                            <span class="status-badge status-<?= $student['status'] ?>">
                                <?= $student['status'] === 'calon' ? 'Calon Siswa' : 'Siswa' ?>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <?= date('d/m/Y', strtotime($student['created_at'])) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align: center; padding: 20px;">
                        Tidak ada data untuk ditampilkan
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini digenerate otomatis oleh sistem pada <?= $generated_at ?></p>
    </div>
</body>
</html>
