<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Detail Pendaftar</h1>
                    <p class="mb-0">Informasi lengkap data pendaftar</p>
                </div>
                <div>
                    <a href="/admin/pendaftar" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="/admin/pendaftar/edit/<?= $student['id'] ?>" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <?php if (!$student['accepted_at']): ?>
                    <button type="button" class="btn btn-success" onclick="validateStudent(<?= $student['id'] ?>)">
                        <i class="fas fa-check"></i> Validasi
                    </button>
                    <?php endif; ?>
                    <button type="button" class="btn btn-danger" onclick="deleteStudent(<?= $student['id'] ?>)">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>

            <!-- Status Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Status:</strong>
                                    <?php if ($student['accepted_at']): ?>
                                        <span class="badge badge-success">Tervalidasi</span>
                                    <?php else: ?>
                                        <span class="badge badge-warning">Menunggu Validasi</span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3">
                                    <strong>Tanggal Daftar:</strong>
                                    <?= date('d/m/Y H:i', strtotime($student['created_at'])) ?>
                                </div>
                                <?php if ($student['accepted_at']): ?>
                                <div class="col-md-3">
                                    <strong>Tanggal Validasi:</strong>
                                    <?= date('d/m/Y H:i', strtotime($student['accepted_at'])) ?>
                                </div>
                                <?php endif; ?>
                                <div class="col-md-3">
                                    <strong>ID Pendaftar:</strong>
                                    #<?= $student['id'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Data Pribadi -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-user"></i> Data Pribadi
                            </h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
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
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-users"></i> Data Orang Tua
                            </h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
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
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-map-marker-alt"></i> Data Alamat
                            </h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
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

<?= $this->endSection() ?>
