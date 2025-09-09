<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;"><?= $pageTitle ?></h2>
        <p style="color: #64748b;">Kelola pengumuman untuk website PPDB</p>
    </div>
    <div style="display: flex; gap: 1rem;">
        <button class="btn btn-primary" onclick="showCreateModal()">
            <i class="fas fa-plus"></i>
            Tambah Pengumuman
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
                <?= count($pengumuman) ?>
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Total Pengumuman</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #10b981; margin-bottom: 0.5rem;">
                <?= count(array_filter($pengumuman, function($p) { return $p['is_active'] == 1; })) ?>
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Aktif</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #6b7280; margin-bottom: 0.5rem;">
                <?= count(array_filter($pengumuman, function($p) { return $p['is_active'] == 0; })) ?>
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
                <input type="text" id="searchInput" placeholder="Cari nama pengumuman..." 
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
        <h3 class="card-title">Data Pengumuman</h3>
        <div style="color: #64748b; font-size: 0.875rem;">
            Total: <?= count($pengumuman) ?> pengumuman
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-container">
            <table class="table" id="pengumumanTable">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Nama Pengumuman</th>
                        <th>Deskripsi</th>
                        <th style="width: 100px;">Gambar</th>
                        <th style="width: 100px;">Status</th>
                        <th style="width: 150px;">Tanggal Dibuat</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pengumuman as $index => $p): ?>
                    <tr data-status="<?= $p['is_active'] ?>" data-nama="<?= strtolower($p['nama']) ?>">
                        <td><?= $index + 1 ?></td>
                        <td>
                            <div style="font-weight: 500;"><?= esc($p['nama']) ?></div>
                        </td>
                        <td>
                            <div style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <?= esc(substr($p['deskripsi'], 0, 100)) ?>
                                <?= strlen($p['deskripsi']) > 100 ? '...' : '' ?>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <?php if ($p['image_url']): ?>
                                <img src="<?= esc($p['image_url']) ?>" alt="<?= esc($p['nama']) ?>" 
                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                            <?php else: ?>
                                <span style="color: #9ca3af; font-size: 0.875rem;">
                                    <i class="fas fa-image"></i><br>
                                    Tidak ada
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input status-switch" type="checkbox" 
                                       <?= $p['is_active'] ? 'checked' : '' ?>
                                       onchange="toggleStatus('<?= $p['id'] ?>', this)"
                                       style="cursor: pointer;">
                            </div>
                        </td>
                        <td>
                            <small style="color: #64748b;">
                                <?= date('d M Y H:i', strtotime($p['created_at'])) ?>
                            </small>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <button onclick="showEditModal('<?= $p['id'] ?>')" 
                                        class="btn btn-sm btn-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deletePengumuman('<?= $p['id'] ?>', '<?= esc($p['nama']) ?>')" 
                                        class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($pengumuman)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2rem; color: #64748b;">
                            <i class="fas fa-inbox fa-3x" style="margin-bottom: 1rem; opacity: 0.3;"></i>
                            <div>Belum ada pengumuman</div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Create/Edit Pengumuman -->
<div class="modal fade" id="pengumumanModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="pengumumanForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="pengumuman-id" name="id">
                    
                    <div class="form-group">
                        <label for="pengumuman-nama">Nama Pengumuman <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="pengumuman-nama" name="nama" 
                               placeholder="Masukkan nama pengumuman" maxlength="100" required>
                        <small class="form-text text-muted">Maksimal 100 karakter</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="pengumuman-deskripsi">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="pengumuman-deskripsi" name="deskripsi" 
                                  rows="5" placeholder="Masukkan deskripsi pengumuman" required></textarea>
                        <small class="form-text text-muted">Minimal 10 karakter</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="pengumuman-gambar">Gambar Pengumuman (Opsional)</label>
                        <input type="file" class="form-control" id="pengumuman-gambar" name="gambar" accept="image/*">
                        <small class="form-text text-muted">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.</small>
                        <div id="image-preview" style="margin-top: 10px; display: none;">
                            <img id="preview-img" src="" alt="Preview" style="max-width: 200px; max-height: 150px; border: 1px solid #ddd; border-radius: 4px;">
                        </div>
                        <div id="current-image" style="margin-top: 10px; display: none;">
                            <label class="form-label">Gambar Saat Ini:</label>
                            <div>
                                <img id="current-img" src="" alt="Current Image" style="max-width: 200px; max-height: 150px; border: 1px solid #ddd; border-radius: 4px;">
                            </div>
                        </div>
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
    
    const rows = document.querySelectorAll('#pengumumanTable tbody tr:not(:last-child)');
    
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
    document.getElementById('modalTitle').textContent = 'Tambah Pengumuman';
    document.getElementById('pengumumanForm').reset();
    document.getElementById('pengumuman-id').value = '';
    document.getElementById('submitBtn').textContent = 'Simpan';
    
    // Reset preview
    document.getElementById('image-preview').style.display = 'none';
    document.getElementById('current-image').style.display = 'none';
    
    $('#pengumumanModal').modal('show');
}

// Show edit modal
function showEditModal(id) {
    document.getElementById('modalTitle').textContent = 'Edit Pengumuman';
    document.getElementById('pengumuman-id').value = id;
    document.getElementById('submitBtn').textContent = 'Update';
    
    // Reset preview
    document.getElementById('image-preview').style.display = 'none';
    document.getElementById('current-image').style.display = 'none';
    
    // Fetch data
    fetch(`/admin/pengumuman/detail/${id}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === 'success') {
            const data = result.data;
            document.getElementById('pengumuman-nama').value = data.nama;
            document.getElementById('pengumuman-deskripsi').value = data.deskripsi;
            
            // Show current image if exists
            if (data.image_url) {
                document.getElementById('current-img').src = data.image_url;
                document.getElementById('current-image').style.display = 'block';
            }
            
            $('#pengumumanModal').modal('show');
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
document.getElementById('pengumumanForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const id = document.getElementById('pengumuman-id').value;
    const url = id ? `/admin/pengumuman/update/${id}` : '/admin/pengumuman/create';
    const method = 'POST';
    
    const formData = new FormData();
    formData.append('nama', document.getElementById('pengumuman-nama').value);
    formData.append('deskripsi', document.getElementById('pengumuman-deskripsi').value);
    
    // Handle file upload
    const fileInput = document.getElementById('pengumuman-gambar');
    if (fileInput.files[0]) {
        formData.append('gambar', fileInput.files[0]);
    }
    
    fetch(url, {
        method: method,
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === 'success') {
            alert(result.message);
            $('#pengumumanModal').modal('hide');
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

// Image preview functionality
document.getElementById('pengumuman-gambar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('image-preview').style.display = 'none';
    }
});

// Toggle status
function toggleStatus(id, checkbox) {
    if (!confirm('Yakin ingin mengubah status pengumuman ini?')) {
        checkbox.checked = !checkbox.checked; // Revert checkbox
        return;
    }
    
    fetch(`/admin/pengumuman/toggle-active/${id}`, {
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

// Delete pengumuman
function deletePengumuman(id, nama) {
    if (!confirm(`Yakin ingin menghapus pengumuman "${nama}"?\n\nData yang dihapus tidak dapat dikembalikan.`)) {
        return;
    }
    
    fetch(`/admin/pengumuman/delete/${id}`, {
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
