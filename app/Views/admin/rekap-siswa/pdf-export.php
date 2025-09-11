<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rekap Siswa - SD Nurul Ulum</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
            font-size: 18px;
        }
        .header h2 {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
            font-weight: normal;
        }
        .info-section {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .info-section h3 {
            margin: 0 0 10px 0;
            color: #333;
            font-size: 14px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }
        .info-item {
            padding: 8px;
            background: white;
            border-radius: 4px;
            border-left: 4px solid #007bff;
        }
        .info-item .label {
            font-weight: bold;
            color: #333;
        }
        .info-item .value {
            color: #666;
            font-size: 16px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-primary {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            text-align: center;
            width: 200px;
        }
        .signature-line {
            border-top: 1px solid #333;
            margin-top: 60px;
            padding-top: 5px;
        }
        @media print {
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SD NURUL ULUM</h1>
        <h2>REKAP DATA SISWA</h2>
        <?php if ($tahunAjaran): ?>
            <h2>Tahun Ajaran: <?= $tahunAjaran['nama'] ?> (<?= $tahunAjaran['tahun_mulai'] ?>/<?= $tahunAjaran['tahun_selesai'] ?>)</h2>
        <?php endif; ?>
        <p style="margin: 5px 0; color: #666;">Dicetak pada: <?= $exportDate ?></p>
    </div>

    <div class="info-section">
        <h3>Ringkasan Data</h3>
        <div class="info-grid">
            <div class="info-item">
                <div class="label">Total Siswa</div>
                <div class="value"><?= count($students) ?></div>
            </div>
            <div class="info-item">
                <div class="label">Laki-laki</div>
                <div class="value"><?= count(array_filter($students, function($s) { return $s['jenis_kelamin'] === 'L'; })) ?></div>
            </div>
            <div class="info-item">
                <div class="label">Perempuan</div>
                <div class="value"><?= count(array_filter($students, function($s) { return $s['jenis_kelamin'] === 'P'; })) ?></div>
            </div>
            <div class="info-item">
                <div class="label">Dengan Beasiswa</div>
                <div class="value"><?= count(array_filter($students, function($s) { return !empty($s['beasiswa_nama']); })) ?></div>
            </div>
        </div>
    </div>

    <?php if (!empty($filters) && (isset($filters['search']))): ?>
    <div class="info-section">
        <h3>Filter yang Diterapkan</h3>
        <ul style="margin: 0; padding-left: 20px;">
            <?php if (!empty($filters['search'])): ?>
                <li>Pencarian: "<?= htmlspecialchars($filters['search']) ?>"</li>
            <?php endif; ?>
        </ul>
    </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="12%">No. Registrasi</th>
                <th width="10%">NISN</th>
                <th width="15%">Nama Lengkap</th>
                <th width="7%">JK</th>
                <th width="12%">Tempat, Tgl Lahir</th>
                <th width="15%">Orang Tua</th>
                <th width="10%">Tahun Ajaran</th>
                <th width="8%">Beasiswa</th>
                <th width="8%">Tgl Diterima</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($students)): ?>
                <tr>
                    <td colspan="10" class="text-center" style="padding: 20px; color: #666;">
                        Tidak ada data siswa yang ditemukan
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($students as $index => $student): ?>
                    <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td style="font-family: monospace;"><?= htmlspecialchars($student['no_registrasi']) ?></td>
                        <td style="font-family: monospace;"><?= htmlspecialchars($student['nisn'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($student['nama_lengkap']) ?></td>
                        <td class="text-center">
                            <span class="badge <?= $student['jenis_kelamin'] === 'L' ? 'badge-primary' : 'badge-success' ?>">
                                <?= $student['jenis_kelamin'] === 'L' ? 'L' : 'P' ?>
                            </span>
                        </td>
                        <td>
                            <?= htmlspecialchars($student['tempat_lahir']) ?><br>
                            <small><?= date('d/m/Y', strtotime($student['tanggal_lahir'])) ?></small>
                        </td>
                        <td>
                            <strong><?= htmlspecialchars($student['nama_ayah']) ?></strong><br>
                            <small><?= htmlspecialchars($student['nama_ibu']) ?></small>
                        </td>
                        <td>
                            <?= htmlspecialchars($student['tahun_ajaran_nama'] ?? '-') ?><br>
                            <small><?= $student['tahun_mulai'] ?? '' ?>/<?= $student['tahun_selesai'] ?? '' ?></small>
                        </td>
                        <td class="text-center">
                            <?php if (!empty($student['beasiswa_nama'])): ?>
                                <span class="badge badge-warning"><?= htmlspecialchars($student['beasiswa_nama']) ?></span>
                            <?php else: ?>
                                <span style="color: #999;">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if (!empty($student['accepted_at'])): ?>
                                <?= date('d/m/Y', strtotime($student['accepted_at'])) ?><br>
                                <small style="color: #666;">
                                    <?= !empty($student['pembayaran_accepted_at']) ? date('d/m/Y', strtotime($student['pembayaran_accepted_at'])) : '-' ?>
                                </small>
                            <?php else: ?>
                                <span style="color: #999;">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    
                    <?php if (($index + 1) % 25 === 0 && $index + 1 < count($students)): ?>
                        </tbody>
                    </table>
                    
                    <div class="page-break"></div>
                    
                    <div class="header">
                        <h1>SD NURUL ULUM</h1>
                        <h2>REKAP DATA SISWA (Lanjutan)</h2>
                        <?php if ($tahunAjaran): ?>
                            <h2>Tahun Ajaran: <?= $tahunAjaran['nama'] ?> (<?= $tahunAjaran['tahun_mulai'] ?>/<?= $tahunAjaran['tahun_selesai'] ?>)</h2>
                        <?php endif; ?>
                    </div>
                    
                    <table>
                        <thead>
                            <tr>
                                <th width="3%">No</th>
                                <th width="12%">No. Registrasi</th>
                                <th width="10%">NISN</th>
                                <th width="15%">Nama Lengkap</th>
                                <th width="7%">JK</th>
                                <th width="12%">Tempat, Tgl Lahir</th>
                                <th width="15%">Orang Tua</th>
                                <th width="10%">Tahun Ajaran</th>
                                <th width="8%">Beasiswa</th>
                                <th width="8%">Tgl Diterima</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php endif; ?>
                    
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <p>Mengetahui,</p>
            <p><strong>Kepala Sekolah</strong></p>
            <div class="signature-line">
                <strong>(.............................)</strong>
            </div>
        </div>
        
        <div class="signature-box">
            <p>Operator,</p>
            <p><strong>Admin PPDB</strong></p>
            <div class="signature-line">
                <strong>(.............................)</strong>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh Sistem PPDB SD Nurul Ulum</p>
        <p>Dicetak pada: <?= $exportDate ?></p>
    </div>
</body>
</html>
