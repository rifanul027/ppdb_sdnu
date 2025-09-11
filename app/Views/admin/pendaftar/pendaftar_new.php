<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-content">
        <div>
            <h2 class="page-title">Data Pendaftar</h2>
            <p class="page-subtitle">Kelola data calon siswa yang mendaftar</p>
        </div>
        <div class="page-actions">
            <a href="/admin/pendaftar/tambah" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                <span class="btn-text">Tambah Pendaftar</span>
            </a>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="content-card filter-card">
    <div class="card-body">
        <form method="GET" action="/admin/pendaftar">
            <div class="filter-grid">
                <div class="filter-input">
                    <label class="filter-label">Cari Nama/No. Registrasi</label>
                    <input type="text" name="search" value="<?= esc($search ?? '') ?>" 
                           placeholder="Masukkan nama atau nomor registrasi" 
                           class="form-input">
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        <span class="btn-text">Cari</span>
                    </button>
                    <a href="/admin/pendaftar" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        <span class="btn-text">Reset</span>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Data Table -->
<div class="content-card">
    <div class="card-header table-header">
        <h3 class="card-title">Daftar Pendaftar</h3>
        <div class="table-info">
            Total: <?= $totalData ?? 0 ?> pendaftar
        </div>
    </div>
    <div class="card-body table-wrapper">
        <div class="table-container">
            <table class="table responsive-table">
                <thead>
                    <tr>
                        <th>No. Reg</th>
                        <th>Nama Lengkap</th>
                        <th class="hide-mobile">Jenis Kelamin</th>
                        <th class="hide-mobile">Tempat, Tanggal Lahir</th>
                        <th class="hide-mobile">Nama Orang Tua</th>
                        <th class="hide-mobile">Tanggal Daftar</th>
                        <th>Status Validasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($pendaftar) && !empty($pendaftar)): ?>
                        <?php foreach ($pendaftar as $siswa): ?>
                            <tr class="table-row">
                                <td data-label="No. Reg">
                                    <span class="reg-number">
                                        <?= esc($siswa['no_registrasi']) ?>
                                    </span>
                                </td>
                                <td data-label="Nama Lengkap">
                                    <div class="student-info">
                                        <div class="student-name"><?= esc($siswa['nama_lengkap']) ?></div>
                                        <?php if (!empty($siswa['username'])): ?>
                                        <div class="student-username">
                                            User: <?= esc($siswa['username']) ?>
                                        </div>
                                        <?php endif; ?>
                                        <!-- Mobile info -->
                                        <div class="mobile-info">
                                            <div class="mobile-detail">
                                                <span class="badge badge-<?= $siswa['jenis_kelamin'] === 'L' ? 'primary' : 'pink' ?>">
                                                    <?= $siswa['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?>
                                                </span>
                                            </div>
                                            <div class="mobile-detail">
                                                <?= esc($siswa['tempat_lahir']) ?>, <?= date('d/m/Y', strtotime($siswa['tanggal_lahir'])) ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Jenis Kelamin" class="hide-mobile">
                                    <span class="badge badge-<?= $siswa['jenis_kelamin'] === 'L' ? 'primary' : 'pink' ?>">
                                        <?= $siswa['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?>
                                    </span>
                                </td>
                                <td data-label="Tempat, Tanggal Lahir" class="hide-mobile">
                                    <div><?= esc($siswa['tempat_lahir']) ?></div>
                                    <div class="text-muted">
                                        <?= date('d/m/Y', strtotime($siswa['tanggal_lahir'])) ?>
                                    </div>
                                </td>
                                <td data-label="Nama Orang Tua" class="hide-mobile">
                                    <div class="parent-name"><?= esc($siswa['nama_ayah']) ?></div>
                                    <div class="text-muted">
                                        <?= esc($siswa['nama_ibu']) ?>
                                    </div>
                                </td>
                                <td>
                                    <?= date('d/m/Y H:i', strtotime($siswa['created_at'])) ?>
                                </td>
                                <td>
                                    <?php if ($siswa['accepted_at']): ?>
                                        <span class="badge badge-success">
                                            <i class="fas fa-check"></i> Divalidasi
                                        </span>
                                        <div style="font-size: 0.75rem; color: #64748b; margin-top: 2px;">
                                            <?= date('d/m/Y H:i', strtotime($siswa['accepted_at'])) ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="badge badge-warning">
                                            <i class="fas fa-clock"></i> Belum Validasi
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 0.25rem; flex-wrap: wrap;">
                                        <a href="/admin/pendaftar/detail/<?= $siswa['id'] ?>" 
                                           class="btn btn-secondary" 
                                           style="padding: 0.5rem; font-size: 0.75rem;"
                                           title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="/admin/pendaftar/edit/<?= $siswa['id'] ?>" 
                                           class="btn btn-primary" 
                                           style="padding: 0.5rem; font-size: 0.75rem;"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="confirmDelete(<?= $siswa['id'] ?>)" 
                                                class="btn" 
                                                style="padding: 0.5rem; font-size: 0.75rem; background: #ef4444; color: white;"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" style="text-align: center; padding: 2rem; color: #64748b;">
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">
                                    <i class="fas fa-user-graduate" style="font-size: 3rem; opacity: 0.3;"></i>
                                    <div>
                                        <div style="font-weight: 600; margin-bottom: 0.5rem;">Belum ada data pendaftar</div>
                                        <div style="font-size: 0.875rem;">Data pendaftar akan muncul di sini setelah ada yang mendaftar</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<?php if (isset($totalPages) && $totalPages > 1): ?>
<div style="display: flex; justify-content: center; margin-top: 2rem;">
    <div style="display: flex; gap: 0.5rem;">
        <?php 
        $currentPage = $currentPage ?? 1;
        $searchParam = $search ? '&search=' . urlencode($search) : '';
        ?>
        
        <?php if ($currentPage > 1): ?>
            <a href="/admin/pendaftar?page=<?= $currentPage - 1 ?><?= $searchParam ?>" 
               class="btn btn-secondary">
                <i class="fas fa-chevron-left"></i>
            </a>
        <?php endif; ?>

        <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
            <a href="/admin/pendaftar?page=<?= $i ?><?= $searchParam ?>" 
               class="btn <?= $i == $currentPage ? 'btn-primary' : 'btn-secondary' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="/admin/pendaftar?page=<?= $currentPage + 1 ?><?= $searchParam ?>" 
               class="btn btn-secondary">
                <i class="fas fa-chevron-right"></i>
            </a>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<script>
function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data pendaftar ini?')) {
        // Send AJAX request to delete
        fetch('/admin/pendaftar/delete/' + id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data');
        });
    }
}
</script>

<style>
/* Page Header Responsive */
.page-header {
    margin-bottom: 2rem;
}

.page-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.page-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    margin: 0;
}

.page-subtitle {
    color: #64748b;
    margin: 0;
    font-size: 0.875rem;
}

.page-actions {
    display: flex;
    gap: 1rem;
    flex-shrink: 0;
}

/* Filter Section */
.filter-card {
    margin-bottom: 2rem;
}

.filter-grid {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 1rem;
    align-items: end;
}

.filter-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    font-size: 0.875rem;
}

.form-input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 1rem;
}

.filter-actions {
    display: flex;
    gap: 0.5rem;
    flex-shrink: 0;
}

/* Table Responsive */
.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-info {
    color: #64748b;
    font-size: 0.875rem;
}

.table-wrapper {
    padding: 0;
}

.table-container {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.responsive-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
}

.reg-number {
    font-family: monospace;
    font-weight: 600;
    color: #059669;
    font-size: 0.875rem;
}

.student-info {
    min-width: 150px;
}

.student-name {
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.student-username {
    font-size: 0.875rem;
    color: #64748b;
}

.mobile-info {
    display: none;
}

.mobile-detail {
    font-size: 0.75rem;
    color: #64748b;
    margin-top: 0.25rem;
}

.parent-name {
    font-weight: 500;
}

.text-muted {
    font-size: 0.875rem;
    color: #64748b;
}

.btn-text {
    margin-left: 0.5rem;
}

/* Mobile Styles */
@media (max-width: 768px) {
    .page-header-content {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }

    .page-actions {
        justify-content: center;
    }

    .btn-text {
        display: none;
    }

    .filter-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .filter-actions {
        justify-content: center;
    }

    .hide-mobile {
        display: none !important;
    }

    .mobile-info {
        display: block;
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px solid #e5e7eb;
    }

    .responsive-table {
        min-width: 100%;
    }

    .responsive-table th,
    .responsive-table td {
        padding: 0.75rem 0.5rem;
        vertical-align: top;
    }

    .responsive-table td:first-child {
        width: 30%;
    }

    .responsive-table td:nth-child(2) {
        width: 45%;
    }

    .responsive-table td:nth-last-child(2) {
        width: 15%;
    }

    .responsive-table td:last-child {
        width: 10%;
    }

    .table-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .action-buttons .btn {
        padding: 0.375rem 0.5rem;
        font-size: 0.75rem;
        min-width: auto;
    }
}

/* Extra Small Mobile */
@media (max-width: 480px) {
    .page-title {
        font-size: 1.25rem;
    }

    .filter-actions {
        flex-direction: column;
    }

    .btn {
        padding: 0.625rem 1rem;
        justify-content: center;
    }

    .responsive-table th,
    .responsive-table td {
        padding: 0.5rem 0.375rem;
        font-size: 0.875rem;
    }

    .reg-number {
        font-size: 0.75rem;
    }

    .student-name {
        font-size: 0.875rem;
    }
}
</style>

<?= $this->endSection() ?>
