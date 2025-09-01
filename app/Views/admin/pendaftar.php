<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">Data Pendaftar</h2>
        <p style="color: #64748b;">Kelola data calon siswa yang mendaftar</p>
    </div>
    <div style="display: flex; gap: 1rem;">
        <a href="/admin/pendaftar/export" class="btn btn-secondary">
            <i class="fas fa-download"></i>
            Export Excel
        </a>
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
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: end;">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Cari Nama/No. Registrasi</label>
                    <input type="text" name="search" value="<?= esc($search ?? '') ?>" 
                           placeholder="Masukkan nama atau nomor registrasi" 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Status</label>
                    <select name="status" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                        <option value="">Semua Status</option>
                        <option value="pending" <?= ($status ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="diterima" <?= ($status ?? '') === 'diterima' ? 'selected' : '' ?>>Diterima</option>
                        <option value="ditolak" <?= ($status ?? '') === 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                    </select>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tanggal Daftar</label>
                    <input type="date" name="tanggal" value="<?= esc($tanggal ?? '') ?>" 
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
                        <th>
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                        </th>
                        <th>No. Reg</th>
                        <th>Nama Lengkap</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Nama Orang Tua</th>
                        <th>Status</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($pendaftar) && !empty($pendaftar)): ?>
                        <?php foreach ($pendaftar as $siswa): ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="selected[]" value="<?= $siswa['id'] ?>" class="select-item">
                                </td>
                                <td>
                                    <span style="font-family: monospace; font-weight: 600; color: #059669;">
                                        <?= esc($siswa['no_registrasi']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="font-weight: 600;"><?= esc($siswa['nama_lengkap']) ?></div>
                                    <div style="font-size: 0.875rem; color: #64748b;">
                                        <?= esc($siswa['jenis_kelamin']) ?>
                                    </div>
                                </td>
                                <td>
                                    <div><?= esc($siswa['tempat_lahir']) ?></div>
                                    <div style="font-size: 0.875rem; color: #64748b;">
                                        <?= date('d/m/Y', strtotime($siswa['tanggal_lahir'])) ?>
                                    </div>
                                </td>
                                <td>
                                    <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">
                                        <?= esc($siswa['alamat']) ?>
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
                                    <?= date('d/m/Y H:i', strtotime($siswa['created_at'])) ?>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem;">
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
                            <td colspan="9" style="text-align: center; padding: 3rem; color: #64748b;">
                                <i class="fas fa-users" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                                <div>Belum ada data pendaftar</div>
                                <div style="font-size: 0.875rem; margin-top: 0.5rem;">
                                    <a href="/admin/pendaftar/tambah" class="btn btn-primary" style="margin-top: 1rem;">
                                        Tambah Pendaftar Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bulk Actions -->
<?php if (isset($pendaftar) && !empty($pendaftar)): ?>
<div class="content-card" style="margin-top: 1rem;">
    <div class="card-body">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <strong>Aksi untuk item terpilih:</strong>
                <span id="selectedCount" style="color: #64748b;">0 item dipilih</span>
            </div>
            <div style="display: flex; gap: 1rem;">
                <button onclick="bulkAction('approve')" class="btn btn-primary" disabled id="approveBtn">
                    <i class="fas fa-check"></i>
                    Terima
                </button>
                <button onclick="bulkAction('reject')" class="btn" style="background: #ef4444; color: white;" disabled id="rejectBtn">
                    <i class="fas fa-times"></i>
                    Tolak
                </button>
                <button onclick="bulkAction('delete')" class="btn" style="background: #dc2626; color: white;" disabled id="deleteBtn">
                    <i class="fas fa-trash"></i>
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Pagination -->
<div style="margin-top: 2rem; text-align: center;">
    <div style="display: inline-flex; gap: 0.5rem; align-items: center;">
        <a href="?page=1" class="btn btn-secondary">First</a>
        <a href="?page=<?= max(1, ($currentPage ?? 1) - 1) ?>" class="btn btn-secondary">Previous</a>
        
        <span style="padding: 0.5rem 1rem; background: #059669; color: white; border-radius: 8px;">
            Halaman <?= $currentPage ?? 1 ?> dari <?= $totalPages ?? 1 ?>
        </span>
        
        <a href="?page=<?= ($currentPage ?? 1) + 1 ?>" class="btn btn-secondary">Next</a>
        <a href="?page=<?= $totalPages ?? 1 ?>" class="btn btn-secondary">Last</a>
    </div>
</div>
<?php endif; ?>

<script>
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.select-item');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateSelectedCount();
}

function updateSelectedCount() {
    const selected = document.querySelectorAll('.select-item:checked');
    const count = selected.length;
    
    document.getElementById('selectedCount').textContent = `${count} item dipilih`;
    
    // Enable/disable bulk action buttons
    const buttons = ['approveBtn', 'rejectBtn', 'deleteBtn'];
    buttons.forEach(btnId => {
        document.getElementById(btnId).disabled = count === 0;
    });
}

// Add event listeners to checkboxes
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.select-item');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });
});

function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data pendaftar ini?')) {
        // Implement delete functionality
        window.location.href = `/admin/pendaftar/delete/${id}`;
    }
}

function bulkAction(action) {
    const selected = document.querySelectorAll('.select-item:checked');
    if (selected.length === 0) {
        alert('Pilih minimal satu item untuk diproses');
        return;
    }
    
    let message = '';
    switch(action) {
        case 'approve':
            message = `Terima ${selected.length} pendaftar?`;
            break;
        case 'reject':
            message = `Tolak ${selected.length} pendaftar?`;
            break;
        case 'delete':
            message = `Hapus ${selected.length} pendaftar? Data yang dihapus tidak dapat dikembalikan.`;
            break;
    }
    
    if (confirm(message)) {
        // Implement bulk action functionality
        const ids = Array.from(selected).map(cb => cb.value);
        console.log(`${action} for IDs:`, ids);
        // Add your bulk action implementation here
    }
}
</script>

<?= $this->endSection() ?>
