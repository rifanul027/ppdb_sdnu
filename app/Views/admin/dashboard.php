<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-title">Total Pendaftar</div>
                <div class="stat-value"><?= $totalPendaftar ?? 0 ?></div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="stat-change">
            <i class="fas fa-arrow-up"></i> +12% dari bulan lalu
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-title">Pendaftar Diterima</div>
                <div class="stat-value"><?= $pendaftarDiterima ?? 0 ?></div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
        <div class="stat-change">
            <i class="fas fa-arrow-up"></i> +8% dari bulan lalu
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-title">Menunggu Verifikasi</div>
                <div class="stat-value"><?= $menungguVerifikasi ?? 0 ?></div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
        <div class="stat-change">
            <i class="fas fa-arrow-down"></i> -5% dari bulan lalu
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-title">Kuota Tersisa</div>
                <div class="stat-value"><?= $kuotaTersisa ?? 0 ?></div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
        </div>
        <div class="stat-change">
            <i class="fas fa-info-circle"></i> dari <?= $totalKuota ?? 0 ?> kuota
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2rem;">
    <!-- Recent Applications -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Pendaftar Terbaru</h3>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($pendaftarTerbaru) && !empty($pendaftarTerbaru)): ?>
                            <?php foreach ($pendaftarTerbaru as $siswa): ?>
                                <tr>
                                    <td>
                                        <div style="font-weight: 600;"><?= esc($siswa['nama_lengkap']) ?></div>
                                        <div style="font-size: 0.875rem; color: #64748b;">No. Reg: <?= esc($siswa['no_registrasi']) ?></div>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($siswa['created_at'])) ?></td>
                                    <td>
                                        <span class="badge badge-<?= $siswa['status'] === 'diterima' ? 'success' : ($siswa['status'] === 'pending' ? 'warning' : 'danger') ?>">
                                            <?= ucfirst($siswa['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/admin/pendaftar/detail/<?= $siswa['id'] ?>" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.75rem;">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 2rem; color: #64748b;">
                                    Belum ada pendaftar terbaru
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div style="text-align: center; margin-top: 1rem;">
                <a href="/admin/pendaftar" class="btn btn-primary">
                    Lihat Semua Pendaftar
                </a>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Quick Actions</h3>
        </div>
        <div class="card-body">
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <a href="/admin/pendaftar/verifikasi" class="btn btn-primary">
                    <i class="fas fa-check"></i>
                    Verifikasi Pendaftar
                </a>
                
                <a href="/admin/settings/biaya" class="btn btn-secondary">
                    <i class="fas fa-money-bill-wave"></i>
                    Atur Biaya Sekolah
                </a>
                
                <a href="/admin/rekap-siswa" class="btn btn-secondary">
                    <i class="fas fa-download"></i>
                    Export Data Siswa
                </a>
                
                <a href="/admin/settings/pendaftaran" class="btn btn-secondary">
                    <i class="fas fa-calendar-alt"></i>
                    Setting Pendaftaran
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Grafik Pendaftaran</h3>
        </div>
        <div class="card-body">
            <div style="height: 300px; display: flex; align-items: center; justify-content: center; background: #f8fafc; border-radius: 8px;">
                <div style="text-align: center; color: #64748b;">
                    <i class="fas fa-chart-line" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <div>Grafik akan ditampilkan di sini</div>
                    <div style="font-size: 0.875rem;">Chart.js atau library lainnya</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Status Pendaftaran</h3>
        </div>
        <div class="card-body">
            <div style="height: 300px; display: flex; align-items: center; justify-content: center; background: #f8fafc; border-radius: 8px;">
                <div style="text-align: center; color: #64748b;">
                    <i class="fas fa-chart-pie" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <div>Pie Chart akan ditampilkan di sini</div>
                    <div style="font-size: 0.875rem;">Chart.js atau library lainnya</div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.badge {
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 500;
}

.badge-success {
    background: #dcfce7;
    color: #166534;
}

.badge-warning {
    background: #fef3c7;
    color: #92400e;
}

.badge-danger {
    background: #fee2e2;
    color: #991b1b;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    div[style*="grid-template-columns: 2fr 1fr"] {
        display: block;
    }
    
    div[style*="grid-template-columns: 1fr 1fr"] {
        display: block;
    }
    
    .content-card {
        margin-bottom: 1rem;
    }
}
</style>

<?= $this->endSection() ?>
