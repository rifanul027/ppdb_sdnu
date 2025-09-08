<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">Data Pendaftar</h2>
        <p style="color: #64748b;">Kelola data calon siswa yang mendaftar</p>
    </div>
    <div style="display: flex; gap: 1rem;">
        <a href="/admin/pendaftar/tambah" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Tambah Pendaftar
        </a>
    </div>
</div>

<!-- Filter Section -->
<div class="content-card" style="margin-bottom: 2rem;">
    <div class="card-body">
        <form method="GET" action="/admin/pendaftar">
            <div style="display: grid; grid-template-columns: 1fr 200px; gap: 1rem; align-items: end;">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Cari Nama/No. Registrasi</label>
                    <input type="text" name="search" value="<?= esc($search ?? '') ?>" 
                           placeholder="Masukkan nama atau nomor registrasi" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                
                <div style="display: flex; gap: 0.5rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        Cari
                    </button>
                    <a href="/admin/pendaftar" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Data Table -->
<div class="content-card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h3 class="card-title">Daftar Pendaftar</h3>
        <div style="color: #64748b; font-size: 0.875rem;">
            Total: <?= $totalData ?? 0 ?> pendaftar
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>No. Reg</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Nama Orang Tua</th>
                        <th>Tanggal Daftar</th>
                        <th>Status Validasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($pendaftar) && !empty($pendaftar)): ?>
                        <?php foreach ($pendaftar as $siswa): ?>
                            <tr>
                                <td>
                                    <span style="font-family: monospace; font-weight: 600; color: #059669;">
                                        <?= esc($siswa['no_registrasi']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="font-weight: 600;"><?= esc($siswa['nama_lengkap']) ?></div>
                                    <?php if (!empty($siswa['username'])): ?>
                                    <div style="font-size: 0.875rem; color: #64748b;">
                                        User: <?= esc($siswa['username']) ?>
                                    </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $siswa['jenis_kelamin'] === 'L' ? 'primary' : 'pink' ?>">
                                        <?= $siswa['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?>
                                    </span>
                                </td>
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

<?= $this->endSection() ?>
