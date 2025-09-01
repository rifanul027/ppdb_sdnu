<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">Rekap Siswa</h2>
        <p style="color: #64748b;">Laporan dan statistik data siswa</p>
    </div>
    <div style="display: flex; gap: 1rem;">
        <button onclick="printReport()" class="btn btn-secondary">
            <i class="fas fa-print"></i>
            Print Laporan
        </button>
        <button onclick="exportExcel()" class="btn btn-primary">
            <i class="fas fa-file-excel"></i>
            Export Excel
        </button>
    </div>
</div>

<!-- Filter Periode -->
<div class="content-card" style="margin-bottom: 2rem;">
    <div class="card-header">
        <h3 class="card-title">Filter Laporan</h3>
    </div>
    <div class="card-body">
        <form method="GET" action="/admin/rekap-siswa">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: end;">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tahun Ajaran</label>
                    <select name="tahun_ajaran" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                        <option value="">Pilih Tahun Ajaran</option>
                        <option value="2024/2025" <?= ($tahun_ajaran ?? '') === '2024/2025' ? 'selected' : '' ?>>2024/2025</option>
                        <option value="2025/2026" <?= ($tahun_ajaran ?? '') === '2025/2026' ? 'selected' : '' ?>>2025/2026</option>
                        <option value="2026/2027" <?= ($tahun_ajaran ?? '') === '2026/2027' ? 'selected' : '' ?>>2026/2027</option>
                    </select>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Periode Dari</label>
                    <input type="date" name="tanggal_dari" value="<?= esc($tanggal_dari ?? '') ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Periode Sampai</label>
                    <input type="date" name="tanggal_sampai" value="<?= esc($tanggal_sampai ?? '') ?>" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Status</label>
                    <select name="status" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                        <option value="">Semua Status</option>
                        <option value="diterima" <?= ($status ?? '') === 'diterima' ? 'selected' : '' ?>>Diterima</option>
                        <option value="pending" <?= ($status ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="ditolak" <?= ($status ?? '') === 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                    </select>
                </div>
                
                <div style="display: flex; gap: 0.5rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i>
                        Filter
                    </button>
                    <a href="/admin/rekap-siswa" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Summary Stats -->
<div class="stats-grid" style="margin-bottom: 2rem;">
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-title">Total Pendaftar</div>
                <div class="stat-value"><?= $summary['total_pendaftar'] ?? 0 ?></div>
            </div>
            <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="stat-change">
            <i class="fas fa-calendar"></i> Periode ini
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-title">Diterima</div>
                <div class="stat-value" style="color: #059669;"><?= $summary['diterima'] ?? 0 ?></div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
        <div class="stat-change">
            <?php 
            $persentase_diterima = ($summary['total_pendaftar'] ?? 0) > 0 ? 
                round((($summary['diterima'] ?? 0) / ($summary['total_pendaftar'] ?? 1)) * 100, 1) : 0;
            ?>
            <i class="fas fa-percentage"></i> <?= $persentase_diterima ?>% dari total
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-title">Pending</div>
                <div class="stat-value" style="color: #d97706;"><?= $summary['pending'] ?? 0 ?></div>
            </div>
            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                <i class="fas fa-clock"></i>
            </div>
        </div>
        <div class="stat-change">
            <?php 
            $persentase_pending = ($summary['total_pendaftar'] ?? 0) > 0 ? 
                round((($summary['pending'] ?? 0) / ($summary['total_pendaftar'] ?? 1)) * 100, 1) : 0;
            ?>
            <i class="fas fa-percentage"></i> <?= $persentase_pending ?>% dari total
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-title">Ditolak</div>
                <div class="stat-value" style="color: #dc2626;"><?= $summary['ditolak'] ?? 0 ?></div>
            </div>
            <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
        <div class="stat-change">
            <?php 
            $persentase_ditolak = ($summary['total_pendaftar'] ?? 0) > 0 ? 
                round((($summary['ditolak'] ?? 0) / ($summary['total_pendaftar'] ?? 1)) * 100, 1) : 0;
            ?>
            <i class="fas fa-percentage"></i> <?= $persentase_ditolak ?>% dari total
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2rem;">
    <!-- Chart Pendaftaran per Bulan -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Grafik Pendaftaran per Bulan</h3>
        </div>
        <div class="card-body">
            <canvas id="chartPendaftaran" width="400" height="200"></canvas>
        </div>
    </div>
    
    <!-- Distribusi Jenis Kelamin -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Distribusi Jenis Kelamin</h3>
        </div>
        <div class="card-body">
            <div style="text-align: center; margin-bottom: 2rem;">
                <canvas id="chartJenisKelamin" width="200" height="200"></canvas>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 1rem; background: #f8fafc; border-radius: 8px;">
                <div style="text-align: center;">
                    <div style="font-size: 1.5rem; font-weight: 700; color: #3b82f6;">
                        <?= $summary['laki_laki'] ?? 0 ?>
                    </div>
                    <div style="font-size: 0.875rem; color: #64748b;">Laki-laki</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 1.5rem; font-weight: 700; color: #ec4899;">
                        <?= $summary['perempuan'] ?? 0 ?>
                    </div>
                    <div style="font-size: 0.875rem; color: #64748b;">Perempuan</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Detail -->
<div class="content-card">
    <div class="card-header">
        <h3 class="card-title">Detail Data Siswa</h3>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No. Registrasi</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Nama Orang Tua</th>
                        <th>Status</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($siswa_detail) && !empty($siswa_detail)): ?>
                        <?php $no = 1; foreach ($siswa_detail as $siswa): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <span style="font-family: monospace; font-weight: 600; color: #059669;">
                                        <?= esc($siswa['no_registrasi']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="font-weight: 600;"><?= esc($siswa['nama_lengkap']) ?></div>
                                </td>
                                <td><?= esc($siswa['jenis_kelamin']) ?></td>
                                <td>
                                    <div><?= esc($siswa['tempat_lahir']) ?></div>
                                    <div style="font-size: 0.875rem; color: #64748b;">
                                        <?= date('d/m/Y', strtotime($siswa['tanggal_lahir'])) ?>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight: 500;"><?= esc($siswa['nama_ayah']) ?></div>
                                    <div style="font-size: 0.875rem; color: #64748b;">
                                        <?= esc($siswa['nama_ibu']) ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $siswa['status'] === 'diterima' ? 'success' : ($siswa['status'] === 'pending' ? 'warning' : 'danger') ?>">
                                        <?= ucfirst($siswa['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?= date('d/m/Y', strtotime($siswa['created_at'])) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 3rem; color: #64748b;">
                                <i class="fas fa-chart-bar" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                                <div>Tidak ada data untuk periode yang dipilih</div>
                                <div style="font-size: 0.875rem; margin-top: 0.5rem;">
                                    Silakan pilih periode yang berbeda
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart Pendaftaran per Bulan
const ctx1 = document.getElementById('chartPendaftaran').getContext('2d');
const chartPendaftaran = new Chart(ctx1, {
    type: 'line',
    data: {
        labels: <?= json_encode($chart_bulan['labels'] ?? ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun']) ?>,
        datasets: [{
            label: 'Jumlah Pendaftar',
            data: <?= json_encode($chart_bulan['data'] ?? [10, 25, 30, 45, 60, 40]) ?>,
            borderColor: '#059669',
            backgroundColor: 'rgba(5, 150, 105, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#e2e8f0'
                }
            },
            x: {
                grid: {
                    color: '#e2e8f0'
                }
            }
        }
    }
});

// Chart Jenis Kelamin
const ctx2 = document.getElementById('chartJenisKelamin').getContext('2d');
const chartJenisKelamin = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['Laki-laki', 'Perempuan'],
        datasets: [{
            data: [<?= $summary['laki_laki'] ?? 30 ?>, <?= $summary['perempuan'] ?? 25 ?>],
            backgroundColor: ['#3b82f6', '#ec4899'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true
                }
            }
        }
    }
});

function printReport() {
    window.print();
}

function exportExcel() {
    // Get current filter parameters
    const params = new URLSearchParams(window.location.search);
    params.set('export', 'excel');
    
    // Create download link
    const link = document.createElement('a');
    link.href = '/admin/rekap-siswa/export?' + params.toString();
    link.download = `rekap-siswa-${new Date().toISOString().split('T')[0]}.xlsx`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Print styles
const printStyles = `
@media print {
    .sidebar, .topbar, .btn, .mobile-menu-btn {
        display: none !important;
    }
    
    .main-content {
        margin-left: 0 !important;
    }
    
    .content-area {
        padding: 1rem !important;
    }
    
    .content-card {
        box-shadow: none !important;
        border: 1px solid #ccc !important;
        page-break-inside: avoid;
        margin-bottom: 1rem !important;
    }
    
    body {
        font-size: 12px !important;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}
`;

// Add print styles to head
const styleSheet = document.createElement('style');
styleSheet.textContent = printStyles;
document.head.appendChild(styleSheet);
</script>

<?= $this->endSection() ?>
