<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div>
                        <h1 class="page-title">Detail Pendaftar</h1>
                        <p class="page-subtitle">Informasi lengkap data pendaftar</p>
                    </div>
                    <div class="page-actions">
                        <a href="/admin/pendaftar" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="btn-text">Kembali</span>
                        </a>
                        <a href="/admin/pendaftar/edit/<?= $student['id'] ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                            <span class="btn-text">Edit</span>
                        </a>
                        <?php if (!$student['accepted_at']): ?>
                        <button type="button" class="btn btn-success" onclick="validateStudent(<?= $student['id'] ?>)">
                            <i class="fas fa-check"></i>
                            <span class="btn-text">Validasi</span>
                        </button>
                        <?php endif; ?>
                        <button type="button" class="btn btn-danger" onclick="deleteStudent(<?= $student['id'] ?>)">
                            <i class="fas fa-trash"></i>
                            <span class="btn-text">Hapus</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Status Card -->
            <div class="status-section">
                <div class="content-card">
                    <div class="card-body">
                        <div class="status-grid">
                            <div class="status-item">
                                <strong>Status:</strong>
                                <?php if ($student['accepted_at']): ?>
                                    <span class="badge badge-success">Tervalidasi</span>
                                <?php else: ?>
                                    <span class="badge badge-warning">Menunggu Validasi</span>
                                <?php endif; ?>
                            </div>
                            <div class="status-item">
                                <strong>Tanggal Daftar:</strong>
                                <span><?= date('d/m/Y H:i', strtotime($student['created_at'])) ?></span>
                            </div>
                            <?php if ($student['accepted_at']): ?>
                            <div class="status-item">
                                <strong>Tanggal Validasi:</strong>
                                <span><?= date('d/m/Y H:i', strtotime($student['accepted_at'])) ?></span>
                            </div>
                            <?php endif; ?>
                            <div class="status-item">
                                <strong>ID Pendaftar:</strong>
                                <span>#<?= $student['id'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="details-grid">
                <!-- Data Pribadi -->
                <div class="detail-card">
                    <div class="content-card">
                        <div class="card-header">
                            <h6 class="card-title">
                                <i class="fas fa-user"></i> Data Pribadi
                            </h6>
                        </div>
                        <div class="card-body">
                            <table class="detail-table">
                                <tr>
                                    <td><strong>Nama Lengkap:</strong></td>
                                    <td><?= $student['nama_lengkap'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin:</strong></td>
                                    <td><?= $student['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Agama:</strong></td>
                                    <td><?= $student['agama'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Tempat Lahir:</strong></td>
                                    <td><?= $student['tempat_lahir'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Lahir:</strong></td>
                                    <td><?= date('d/m/Y', strtotime($student['tanggal_lahir'])) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Tahun Ajaran:</strong></td>
                                    <td><?= isset($tahunAjaran['nama']) ? $tahunAjaran['nama'] : '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua -->
                <div class="detail-card">
                    <div class="content-card">
                        <div class="card-header">
                            <h6 class="card-title">
                                <i class="fas fa-users"></i> Data Orang Tua
                            </h6>
                        </div>
                        <div class="card-body">
                            <table class="detail-table">
                                <tr>
                                    <td><strong>Nama Ayah:</strong></td>
                                    <td><?= $student['nama_ayah'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Ibu:</strong></td>
                                    <td><?= $student['nama_ibu'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Data Alamat -->
                <div class="detail-card">
                    <div class="content-card">
                        <div class="card-header">
                            <h6 class="card-title">
                                <i class="fas fa-map-marker-alt"></i> Data Alamat
                            </h6>
                        </div>
                        <div class="card-body">
                            <table class="detail-table">
                                <tr>
                                    <td><strong>Alamat:</strong></td>
                                    <td><?= nl2br($student['alamat']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Domisili:</strong></td>
                                    <td><?= nl2br($student['domisili']) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Dokumen -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-file-alt"></i> Dokumen
                            </h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Akta Kelahiran:</strong></td>
                                    <td>
                                        <?php if ($student['akta']): ?>
                                            <a href="/uploads/<?= $student['akta'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">Belum diupload</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Kartu Keluarga:</strong></td>
                                    <td>
                                        <?php if ($student['kk']): ?>
                                            <a href="/uploads/<?= $student['kk'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">Belum diupload</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Ijazah TK/RA:</strong></td>
                                    <td>
                                        <?php if ($student['ijazah']): ?>
                                            <a href="/uploads/<?= $student['ijazah'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">Belum diupload</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- User Account Info -->
                <?php if (isset($user) && $user): ?>
                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-user-cog"></i> Informasi Akun User
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Username:</strong></td>
                                            <td><?= $user['username'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td><?= $user['email'] ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Role:</strong></td>
                                            <td><?= ucfirst($user['role']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status Akun:</strong></td>
                                            <td>
                                                <?php if ($user['is_active']): ?>
                                                    <span class="badge badge-success">Aktif</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">Tidak Aktif</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
function validateStudent(id) {
    if (confirm('Apakah Anda yakin ingin memvalidasi data pendaftar ini?')) {
        fetch('/admin/pendaftar/validate/' + id, {
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
            alert('Terjadi kesalahan saat memvalidasi data');
        });
    }
}

function deleteStudent(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data pendaftar ini?')) {
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
                window.location.href = '/admin/pendaftar';
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
    margin: 0;
    color: #1f2937;
}

.page-subtitle {
    color: #64748b;
    margin: 0;
    font-size: 0.875rem;
}

.page-actions {
    display: flex;
    gap: 0.5rem;
    flex-shrink: 0;
    flex-wrap: wrap;
}

/* Status Section */
.status-section {
    margin-bottom: 2rem;
}

.status-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.status-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.status-item strong {
    font-size: 0.875rem;
    color: #374151;
}

.status-item span {
    font-size: 0.875rem;
    color: #6b7280;
}

/* Details Grid */
.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.detail-card {
    height: fit-content;
}

.card-title {
    margin: 0;
    font-weight: 600;
    color: #3b82f6;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.detail-table {
    width: 100%;
    border-collapse: collapse;
}

.detail-table td {
    padding: 0.75rem 0;
    vertical-align: top;
    border-bottom: 1px solid #f3f4f6;
}

.detail-table td:first-child {
    width: 40%;
    color: #374151;
    font-weight: 500;
}

.detail-table td:last-child {
    color: #6b7280;
}

.btn-text {
    margin-left: 0.5rem;
}

/* Badge Styles */
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

/* Mobile Styles */
@media (max-width: 768px) {
    .page-header-content {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }

    .page-actions {
        justify-content: center;
        gap: 0.25rem;
    }

    .btn-text {
        display: none;
    }

    .btn {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }

    .status-grid {
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }

    .status-item {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .details-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .detail-table td {
        padding: 0.5rem 0;
    }

    .detail-table td:first-child {
        width: 35%;
        font-size: 0.875rem;
    }

    .detail-table td:last-child {
        font-size: 0.875rem;
    }

    .card-body {
        padding: 1rem;
    }

    .card-header {
        padding: 1rem 1rem 0;
    }
}

/* Extra Small Mobile */
@media (max-width: 480px) {
    .page-title {
        font-size: 1.25rem;
    }

    .page-actions {
        flex-direction: column;
        gap: 0.5rem;
    }

    .btn {
        justify-content: center;
        padding: 0.625rem 1rem;
    }

    .detail-table td:first-child {
        width: 100%;
        padding-bottom: 0.25rem;
    }

    .detail-table td:last-child {
        width: 100%;
        padding-top: 0;
        padding-left: 1rem;
    }

    .detail-table tr {
        display: block;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .status-item {
        flex-direction: column;
        align-items: flex-start;
    }
}

/* Print Styles */
@media print {
    .page-actions,
    .btn {
        display: none !important;
    }
    
    .page-header {
        margin-bottom: 1rem;
    }
    
    .details-grid {
        grid-template-columns: 1fr 1fr;
    }
}
</style>

<?= $this->endSection() ?>
