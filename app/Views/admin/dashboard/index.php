<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-title">Total Siswa</div>
                <div class="stat-value"><?= $totalSiswa ?? 0 ?></div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
        </div>
        <div class="stat-change">
            <i class="fas fa-info-circle"></i> Siswa yang sudah diterima
        </div>
    </div>
    
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
            <i class="fas fa-info-circle"></i> Calon siswa yang mendaftar
        </div>
    </div>
</div>

<div class="dashboard-grid">
    <!-- Quick Actions -->
    <div class="content-card quick-actions-card">
        <div class="card-header">
            <h3 class="card-title">Quick Actions</h3>
        </div>
        <div class="card-body">
            <div class="quick-actions-grid">
                <a href="/admin/pengaturan" class="btn btn-primary">
                    <i class="fas fa-cog"></i>
                    Settings
                </a>
                
                <a href="/admin/pendaftar" class="btn btn-secondary">
                    <i class="fas fa-users"></i>
                    Lihat Pendaftar
                </a>
                
                <a href="/admin/daftar-ulang" class="btn btn-secondary">
                    <i class="fas fa-clipboard-list"></i>
                    Lihat Daftar Ulang
                </a>
                
                <a href="/admin/siswa" class="btn btn-secondary">
                    <i class="fas fa-graduation-cap"></i>
                    Lihat Siswa
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Applications -->
    <div class="content-card recent-applications-card">
        <div class="card-header">
            <h3 class="card-title">Pendaftar Terbaru</h3>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No. Registrasi</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($pendaftarTerbaru) && !empty($pendaftarTerbaru)): ?>
                            <?php foreach ($pendaftarTerbaru as $siswa): ?>
                                <tr>
                                    <td><?= esc($siswa['no_registrasi']) ?></td>
                                    <td>
                                        <div style="font-weight: 600;"><?= esc($siswa['nama_lengkap']) ?></div>
                                    </td>
                                    <td><?= $siswa['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($siswa['created_at'])) ?></td>
                                    <td>
                                        <span class="badge badge-<?= $siswa['status'] === 'siswa' ? 'success' : 'warning' ?>">
                                            <?= $siswa['status'] === 'siswa' ? 'Siswa' : 'Calon' ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 2rem; color: #64748b;">
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
</div>

<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .quick-actions-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .stat-title {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        background: #0d8f18ff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .stat-change {
        font-size: 0.875rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .content-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        padding: 1.5rem 1.5rem 0;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 1.5rem;
    }

    .card-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }

    .card-body {
        padding: 0 1.5rem 1.5rem;
    }

    .table-container {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }

    .table th {
        font-weight: 600;
        color: #374151;
        background: #f8fafc;
    }

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

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        justify-content: center;
    }

    .btn-primary {
        background: #3bf664ff;
        color: white;
    }

    .btn-primary:hover {
        background: #08571cff;
    }

    .btn-secondary {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .quick-actions-card {
            order: 1;
        }
        
        .recent-applications-card {
            order: 2;
        }
        
        .quick-actions-grid {
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }
        
        .content-card {
            margin-bottom: 1rem;
        }
        
        .stat-card {
            padding: 1rem;
        }
        
        .card-body {
            padding: 0 1rem 1rem;
        }
        
        .card-header {
            padding: 1rem 1rem 0;
        }
        
        .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .table th,
        .table td {
            padding: 0.5rem;
            font-size: 0.875rem;
            white-space: nowrap;
        }
    }
</style>

<?= $this->endSection() ?>
