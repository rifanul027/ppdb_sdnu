<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;"><?= $pageTitle ?></h2>
        <p style="color: #64748b;">Kelola tahun ajaran untuk sistem PPDB</p>
    </div>
    <div style="display: flex; gap: 1rem;">
        <button class="btn btn-primary" onclick="showCreateModal()">
            <i class="fas fa-plus"></i>
            Tambah Tahun Ajaran
        </button>
        <button class="btn btn-secondary" onclick="refreshData()">
            <i class="fas fa-sync"></i>
            Refresh
        </button>
    </div>
</div>

<!-- Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #059669; margin-bottom: 0.5rem;">
                <?= count($tahunAjaran) ?>
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Total Tahun Ajaran</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #10b981; margin-bottom: 0.5rem;">
                <?= count(array_filter($tahunAjaran, function($ta) { return $ta['is_active'] == 1; })) ?>
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Aktif</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #6b7280; margin-bottom: 0.5rem;">
                <?= count(array_filter($tahunAjaran, function($ta) { return $ta['is_active'] == 0; })) ?>
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Tidak Aktif</div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="content-card" style="margin-bottom: 2rem;">
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: end;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Filter Status</label>
                <select id="filterStatus" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    <option value="">Semua Status</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Pencarian</label>
                <input type="text" id="searchInput" placeholder="Cari nama tahun ajaran..." 
                       style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            
            <div style="display: flex; gap: 0.5rem;">
                <button onclick="applyFilters()" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                    Filter
                </button>
                <button onclick="resetFilters()" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Reset
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="content-card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h3 class="card-title">Data Tahun Ajaran</h3>
        <div style="color: #64748b; font-size: 0.875rem;">
            Total: <?= count($tahunAjaran) ?> tahun ajaran
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-container">
            <table class="table" id="tahunAjaranTable">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Nama Tahun Ajaran</th>
                        <th style="width: 120px;">Periode</th>
                        <th style="width: 100px;">Status</th>
                        <th style="width: 150px;">Tanggal Dibuat</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tahunAjaran as $index => $ta): ?>
                    <tr data-status="<?= $ta['is_active'] ?>" data-nama="<?= strtolower($ta['nama']) ?>">
                        <td><?= $index + 1 ?></td>
                        <td>
                            <div style="font-weight: 500;"><?= esc($ta['nama']) ?></div>
                            <small style="color: #64748b;"><?= esc($ta['deskripsi']) ?></small>
                        </td>
                        <td>
                            <div style="font-weight: 500;"><?= $ta['tahun_mulai'] ?>/<?= $ta['tahun_selesai'] ?></div>
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input status-switch" type="checkbox" 
                                       <?= $ta['is_active'] ? 'checked' : '' ?>
                                       onchange="toggleStatus('<?= $ta['id'] ?>', this)"
                                       style="cursor: pointer;">
                            </div>
                        </td>
                        <td>
                            <small style="color: #64748b;">
                                <?= date('d M Y H:i', strtotime($ta['created_at'])) ?>
                            </small>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <button onclick="showEditModal('<?= $ta['id'] ?>')" 
                                        class="btn btn-sm btn-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteTahunAjaran('<?= $ta['id'] ?>', '<?= esc($ta['nama']) ?>')" 
                                        class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($tahunAjaran)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem; color: #64748b;">
                            <i class="fas fa-inbox fa-3x" style="margin-bottom: 1rem; opacity: 0.3;"></i>
                            <div>Belum ada tahun ajaran</div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Create/Edit Tahun Ajaran -->
<div class="modal fade" id="tahunAjaranModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Tahun Ajaran</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="tahunAjaranForm">
                <div class="modal-body">
                    <input type="hidden" id="tahun-ajaran-id" name="id">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tahun-ajaran-nama">Nama Tahun Ajaran <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tahun-ajaran-nama" name="nama" 
                                       placeholder="Contoh: Tahun Ajaran 2024/2025" maxlength="100" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun-mulai">Tahun Mulai <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="tahun-mulai" name="tahun_mulai" 
                                       min="2020" max="2050" placeholder="2024" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun-selesai">Tahun Selesai <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="tahun-selesai" name="tahun_selesai" 
                                       min="2020" max="2050" placeholder="2025" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="tahun-ajaran-deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="tahun-ajaran-deskripsi" name="deskripsi" 
                                  rows="3" placeholder="Masukkan deskripsi tahun ajaran (opsional)"></textarea>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Apply filters
function applyFilters() {
    const filterStatus = document.getElementById('filterStatus').value;
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    
    const rows = document.querySelectorAll('#tahunAjaranTable tbody tr:not(:last-child)');
    
    rows.forEach(row => {
        let show = true;
        
        // Skip if no data attributes (empty state row)
        if (!row.dataset.status && !row.dataset.nama) return;
        
        // Filter status
        if (filterStatus !== '' && row.dataset.status !== filterStatus) {
            show = false;
        }
        
        // Search filter
        if (searchInput) {
            const nama = row.dataset.nama;
            if (!nama.includes(searchInput)) {
                show = false;
            }
        }
        
        row.style.display = show ? '' : 'none';
    });
}

// Reset filters
function resetFilters() {
    document.getElementById('filterStatus').value = '';
    document.getElementById('searchInput').value = '';
    applyFilters();
}

// Show create modal
function showCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Tahun Ajaran';
    document.getElementById('tahunAjaranForm').reset();
    document.getElementById('tahun-ajaran-id').value = '';
    document.getElementById('submitBtn').textContent = 'Simpan';
    
    $('#tahunAjaranModal').modal('show');
}

// Show edit modal
function showEditModal(id) {
    document.getElementById('modalTitle').textContent = 'Edit Tahun Ajaran';
    document.getElementById('tahun-ajaran-id').value = id;
    document.getElementById('submitBtn').textContent = 'Update';
    
    // Fetch data
    fetch(`/admin/pengaturan/detail/${id}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === 'success') {
            const data = result.data;
            document.getElementById('tahun-ajaran-nama').value = data.nama;
            document.getElementById('tahun-mulai').value = data.tahun_mulai;
            document.getElementById('tahun-selesai').value = data.tahun_selesai;
            document.getElementById('tahun-ajaran-deskripsi').value = data.deskripsi;
            
            $('#tahunAjaranModal').modal('show');
        } else {
            alert('Gagal mengambil data: ' + result.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengambil data');
    });
}

// Handle form submission
document.getElementById('tahunAjaranForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const id = document.getElementById('tahun-ajaran-id').value;
    const url = id ? `/update/${id}` : '/create';
    const method = 'POST';
    
    const formData = {
        nama: document.getElementById('tahun-ajaran-nama').value,
        tahun_mulai: document.getElementById('tahun-mulai').value,
        tahun_selesai: document.getElementById('tahun-selesai').value,
        deskripsi: document.getElementById('tahun-ajaran-deskripsi').value
    };
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === 'success') {
            alert(result.message);
            $('#tahunAjaranModal').modal('hide');
            location.reload();
        } else {
            let errorMsg = result.message;
            if (result.errors) {
                errorMsg += '\n\nDetail error:\n';
                Object.values(result.errors).forEach(error => {
                    errorMsg += '- ' + error + '\n';
                });
            }
            alert(errorMsg);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data');
    });
});

// Toggle status
function toggleStatus(id, checkbox) {
    if (!confirm('Yakin ingin mengubah status tahun ajaran ini?')) {
        checkbox.checked = !checkbox.checked; // Revert checkbox
        return;
    }
    
    fetch(`/admin/pengaturan/toggle-active/${id}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === 'success') {
            // Update data attribute
            checkbox.closest('tr').dataset.status = result.is_active;
            alert(result.message);
        } else {
            checkbox.checked = !checkbox.checked; // Revert checkbox
            alert('Gagal mengubah status: ' + result.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        checkbox.checked = !checkbox.checked; // Revert checkbox
        alert('Terjadi kesalahan saat mengubah status');
    });
}

// Delete tahun ajaran
function deleteTahunAjaran(id, nama) {
    if (!confirm(`Yakin ingin menghapus tahun ajaran "${nama}"?\n\nData yang dihapus tidak dapat dikembalikan.`)) {
        return;
    }
    
    fetch(`/admin/pengaturan/delete/${id}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === 'success') {
            alert(result.message);
            location.reload();
        } else {
            alert('Gagal menghapus: ' + result.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus data');
    });
}

// Refresh data function
function refreshData() {
    location.reload();
}

// Auto-apply filters when typing
document.getElementById('searchInput').addEventListener('input', applyFilters);
document.getElementById('filterStatus').addEventListener('change', applyFilters);
</script>

<?= $this->endsection() ?>
