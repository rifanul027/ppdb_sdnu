<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;"><?= $pageTitle ?></h2>
        <p style="color: #64748b;">Kelola data siswa yang melakukan daftar ulang</p>
    </div>
    <div style="display: flex; gap: 1rem;">
        <button class="btn btn-secondary" onclick="exportData()">
            <i class="fas fa-download"></i>
            Export Data
        </button>
        <button class="btn btn-primary" onclick="refreshData()">
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
                <?= count($siswa) ?>
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Total Siswa Daftar Ulang</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #10b981; margin-bottom: 0.5rem;">
                <?= count(array_filter($siswa, function($s) { return $s['status_pembayaran'] == 'Lunas'; })) ?>
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Pembayaran Lunas</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #3b82f6; margin-bottom: 0.5rem;">
                <?= count(array_filter($siswa, function($s) { return $s['status_wawancara'] == 'Sudah Wawancara'; })) ?>
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Selesai Wawancara</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #f59e0b; margin-bottom: 0.5rem;">
                <?= count(array_filter($siswa, function($s) { return $s['status_pembayaran'] == 'Belum Bayar'; })) ?>
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Belum Bayar</div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="content-card" style="margin-bottom: 2rem;">
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: end;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Filter Status Pembayaran</label>
                <select id="filterPembayaran" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    <option value="">Semua Status</option>
                    <option value="Belum Bayar">Belum Bayar</option>
                    <option value="Cicilan">Cicilan</option>
                    <option value="Lunas">Lunas</option>
                </select>
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Filter Status Wawancara</label>
                <select id="filterWawancara" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    <option value="">Semua Status</option>
                    <option value="Belum Wawancara">Belum Wawancara</option>
                    <option value="Sudah Wawancara">Sudah Wawancara</option>
                </select>
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Pencarian</label>
                <input type="text" id="searchInput" placeholder="Cari nama siswa atau NISN..." 
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
        <h3 class="card-title">Data Siswa Daftar Ulang</h3>
        <div style="color: #64748b; font-size: 0.875rem;">
            Total: <?= count($siswa) ?> siswa
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-container">
            <table class="table" id="daftarUlangTable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                        </th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Orang Tua</th>
                        <th>Status Pembayaran</th>
                        <th>Status Wawancara</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($siswa as $index => $s): ?>
                    <tr data-pembayaran="<?= $s['status_pembayaran'] ?>" data-wawancara="<?= $s['status_wawancara'] ?>" data-nama="<?= strtolower($s['nama']) ?>" data-nisn="<?= $s['nisn'] ?>">
                        <td>
                            <input type="checkbox" name="selected[]" value="<?= $s['id'] ?>" class="select-item">
                        </td>
                        <td>
                            <span style="font-family: monospace; font-weight: 600; color: #059669;">
                                <?= esc($s['nisn']) ?>
                            </span>
                        </td>
                        <td>
                            <div style="font-weight: 600;"><?= esc($s['nama']) ?></div>
                            <div style="font-size: 0.875rem; color: #64748b;">
                                <?= $s['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?>
                            </div>
                        </td>
                        <td>
                            <div><?= esc($s['tempat_lahir']) ?></div>
                            <div style="font-size: 0.875rem; color: #64748b;">
                                <?= date('d/m/Y', strtotime($s['tanggal_lahir'])) ?>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 500;"><?= esc($s['nama_ayah']) ?></div>
                            <div style="font-size: 0.875rem; color: #64748b;">
                                <?= esc($s['nama_ibu']) ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($s['status_pembayaran'] == 'Lunas'): ?>
                                <span class="badge badge-success">Lunas</span>
                            <?php elseif ($s['status_pembayaran'] == 'Cicilan'): ?>
                                <span class="badge badge-warning">Cicilan</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Belum Bayar</span>
                            <?php endif; ?>
                            <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.25rem;">
                                Rp <?= number_format($s['jumlah_bayar'], 0, ',', '.') ?> / Rp <?= number_format($s['total_bayar'], 0, ',', '.') ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($s['status_wawancara'] == 'Sudah Wawancara'): ?>
                                <span class="badge badge-success">Sudah Wawancara</span>
                                <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.25rem;">
                                    <?= date('d/m/Y', strtotime($s['tanggal_wawancara'])) ?>
                                </div>
                            <?php else: ?>
                                <span class="badge badge-secondary">Belum Wawancara</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <button onclick="showDetailModal(<?= htmlspecialchars(json_encode($s)) ?>)" 
                                        class="btn btn-secondary" 
                                        style="padding: 0.5rem; font-size: 0.75rem;"
                                        title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="showPembayaranModal(<?= htmlspecialchars(json_encode($s)) ?>)" 
                                        class="btn btn-primary" 
                                        style="padding: 0.5rem; font-size: 0.75rem;"
                                        title="Kelola Pembayaran">
                                    <i class="fas fa-money-bill"></i>
                                </button>
                                <button onclick="showWawancaraModal(<?= htmlspecialchars(json_encode($s)) ?>)" 
                                        class="btn" 
                                        style="padding: 0.5rem; font-size: 0.75rem; background: #3b82f6; color: white;"
                                        title="Kelola Wawancara">
                                    <i class="fas fa-comments"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($siswa)): ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 3rem; color: #64748b;">
                            <i class="fas fa-redo-alt" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                            <div>Belum ada data siswa daftar ulang</div>
                            <div style="font-size: 0.875rem; margin-top: 0.5rem;">
                                Data siswa daftar ulang akan muncul di sini
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
<div class="content-card" style="margin-top: 1rem;">
    <div class="card-body">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <strong>Aksi untuk item terpilih:</strong>
                <span id="selectedCount" style="color: #64748b;">0 item dipilih</span>
            </div>
            <div style="display: flex; gap: 1rem;">
                <button onclick="bulkUpdatePembayaran()" class="btn btn-primary" disabled id="updatePembayaranBtn">
                    <i class="fas fa-money-bill"></i>
                    Update Pembayaran
                </button>
                <button onclick="bulkUpdateWawancara()" class="btn" style="background: #3b82f6; color: white;" disabled id="updateWawancaraBtn">
                    <i class="fas fa-comments"></i>
                    Update Wawancara
                </button>
                <button onclick="exportSelected()" class="btn btn-secondary" disabled id="exportBtn">
                    <i class="fas fa-download"></i>
                    Export Terpilih
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Siswa -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Siswa</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Data Pribadi</h6>
                        <table class="table table-borderless table-sm">
                            <tr><td width="40%"><strong>Nama</strong></td><td id="detail-nama">-</td></tr>
                            <tr><td><strong>NISN</strong></td><td id="detail-nisn">-</td></tr>
                            <tr><td><strong>Tempat Lahir</strong></td><td id="detail-tempat-lahir">-</td></tr>
                            <tr><td><strong>Tanggal Lahir</strong></td><td id="detail-tanggal-lahir">-</td></tr>
                            <tr><td><strong>Jenis Kelamin</strong></td><td id="detail-jenis-kelamin">-</td></tr>
                            <tr><td><strong>Alamat</strong></td><td id="detail-alamat">-</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Data Orang Tua</h6>
                        <table class="table table-borderless table-sm">
                            <tr><td width="40%"><strong>Nama Ayah</strong></td><td id="detail-nama-ayah">-</td></tr>
                            <tr><td><strong>Nama Ibu</strong></td><td id="detail-nama-ibu">-</td></tr>
                        </table>
                        
                        <h6 class="mt-3">Status Pembayaran & Wawancara</h6>
                        <table class="table table-borderless table-sm">
                            <tr><td width="40%"><strong>Status Pembayaran</strong></td><td id="detail-status-pembayaran">-</td></tr>
                            <tr><td><strong>Jumlah Bayar</strong></td><td id="detail-jumlah-bayar">-</td></tr>
                            <tr><td><strong>Status Wawancara</strong></td><td id="detail-status-wawancara">-</td></tr>
                            <tr><td><strong>Catatan Wawancara</strong></td><td id="detail-catatan-wawancara">-</td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pembayaran -->
<div class="modal fade" id="pembayaranModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kelola Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="pembayaranForm">
                <div class="modal-body">
                    <input type="hidden" id="pembayaran-id" name="id">
                    
                    <div class="alert alert-info">
                        <strong>Siswa:</strong> <span id="pembayaran-nama-siswa"></span><br>
                        <strong>NISN:</strong> <span id="pembayaran-nisn-siswa"></span>
                    </div>
                    
                    <div class="form-group">
                        <label>Total Biaya</label>
                        <input type="number" class="form-control" id="pembayaran-total" name="total_bayar" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Jumlah yang Dibayar</label>
                        <input type="number" class="form-control" id="pembayaran-jumlah" name="jumlah_bayar" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal Pembayaran</label>
                        <input type="date" class="form-control" id="pembayaran-tanggal" name="tanggal_bayar" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Status Pembayaran</label>
                        <select class="form-control" id="pembayaran-status" name="status_pembayaran" required>
                            <option value="Belum Bayar">Belum Bayar</option>
                            <option value="Cicilan">Cicilan</option>
                            <option value="Lunas">Lunas</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Keterangan Pembayaran</label>
                        <textarea class="form-control" id="pembayaran-keterangan" name="keterangan" rows="3" placeholder="Keterangan tambahan tentang pembayaran..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Wawancara -->
<div class="modal fade" id="wawancaraModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sesi Wawancara</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="wawancaraForm">
                <div class="modal-body">
                    <input type="hidden" id="wawancara-id" name="id">
                    
                    <div class="alert alert-info">
                        <strong>Siswa:</strong> <span id="wawancara-nama-siswa"></span><br>
                        <strong>NISN:</strong> <span id="wawancara-nisn-siswa"></span>
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal Wawancara</label>
                        <input type="date" class="form-control" id="wawancara-tanggal" name="tanggal_wawancara" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Status Wawancara</label>
                        <select class="form-control" id="wawancara-status" name="status_wawancara" required>
                            <option value="Belum Wawancara">Belum Wawancara</option>
                            <option value="Sudah Wawancara">Sudah Wawancara</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Catatan Wawancara <small class="text-muted">(Penilaian sebagai siswa SD)</small></label>
                        <textarea class="form-control" id="wawancara-catatan" name="catatan_wawancara" rows="8" placeholder="Berikan catatan tentang siswa berdasarkan hasil wawancara...

Contoh:
- Kemampuan komunikasi
- Kesiapan belajar
- Sikap dan perilaku
- Kemampuan dasar (baca, tulis, hitung)
- Minat dan bakat
- Rekomendasi khusus"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Penilaian Komunikasi</label>
                                <select class="form-control" name="penilaian_komunikasi">
                                    <option value="">-Pilih-</option>
                                    <option value="Sangat Baik">Sangat Baik</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Cukup">Cukup</option>
                                    <option value="Kurang">Kurang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kesiapan Belajar</label>
                                <select class="form-control" name="kesiapan_belajar">
                                    <option value="">-Pilih-</option>
                                    <option value="Sangat Siap">Sangat Siap</option>
                                    <option value="Siap">Siap</option>
                                    <option value="Cukup Siap">Cukup Siap</option>
                                    <option value="Belum Siap">Belum Siap</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Rekomendasi</label>
                        <select class="form-control" name="rekomendasi">
                            <option value="">-Pilih-</option>
                            <option value="Sangat Direkomendasikan">Sangat Direkomendasikan</option>
                            <option value="Direkomendasikan">Direkomendasikan</option>
                            <option value="Direkomendasikan dengan Catatan">Direkomendasikan dengan Catatan</option>
                            <option value="Perlu Evaluasi Lanjutan">Perlu Evaluasi Lanjutan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Catatan Wawancara</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
// Toggle select all checkboxes
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.select-item');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateSelectedCount();
}

// Update selected count and enable/disable bulk action buttons
function updateSelectedCount() {
    const selected = document.querySelectorAll('.select-item:checked');
    const count = selected.length;
    
    document.getElementById('selectedCount').textContent = `${count} item dipilih`;
    
    // Enable/disable bulk action buttons
    const buttons = ['updatePembayaranBtn', 'updateWawancaraBtn', 'exportBtn'];
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

// Apply filters
function applyFilters() {
    const filterPembayaran = document.getElementById('filterPembayaran').value;
    const filterWawancara = document.getElementById('filterWawancara').value;
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    
    const rows = document.querySelectorAll('#daftarUlangTable tbody tr:not(:last-child)');
    
    rows.forEach(row => {
        let show = true;
        
        // Skip if no data attributes (empty state row)
        if (!row.dataset.pembayaran) return;
        
        // Filter pembayaran
        if (filterPembayaran && row.dataset.pembayaran !== filterPembayaran) {
            show = false;
        }
        
        // Filter wawancara
        if (filterWawancara && row.dataset.wawancara !== filterWawancara) {
            show = false;
        }
        
        // Search filter
        if (searchInput) {
            const nama = row.dataset.nama;
            const nisn = row.dataset.nisn;
            if (!nama.includes(searchInput) && !nisn.includes(searchInput)) {
                show = false;
            }
        }
        
        row.style.display = show ? '' : 'none';
    });
}

// Reset filters
function resetFilters() {
    document.getElementById('filterPembayaran').value = '';
    document.getElementById('filterWawancara').value = '';
    document.getElementById('searchInput').value = '';
    applyFilters();
}

// Show detail modal
function showDetailModal(siswa) {
    document.getElementById('detail-nama').textContent = siswa.nama;
    document.getElementById('detail-nisn').textContent = siswa.nisn;
    document.getElementById('detail-tempat-lahir').textContent = siswa.tempat_lahir;
    document.getElementById('detail-tanggal-lahir').textContent = new Date(siswa.tanggal_lahir).toLocaleDateString('id-ID');
    document.getElementById('detail-jenis-kelamin').textContent = siswa.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    document.getElementById('detail-alamat').textContent = siswa.alamat;
    document.getElementById('detail-nama-ayah').textContent = siswa.nama_ayah;
    document.getElementById('detail-nama-ibu').textContent = siswa.nama_ibu;
    document.getElementById('detail-status-pembayaran').textContent = siswa.status_pembayaran;
    document.getElementById('detail-jumlah-bayar').textContent = 'Rp ' + siswa.jumlah_bayar.toLocaleString('id-ID') + ' / Rp ' + siswa.total_bayar.toLocaleString('id-ID');
    document.getElementById('detail-status-wawancara').textContent = siswa.status_wawancara;
    document.getElementById('detail-catatan-wawancara').textContent = siswa.catatan_wawancara || '-';
    
    $('#detailModal').modal('show');
}

// Show pembayaran modal
function showPembayaranModal(siswa) {
    document.getElementById('pembayaran-id').value = siswa.id;
    document.getElementById('pembayaran-nama-siswa').textContent = siswa.nama;
    document.getElementById('pembayaran-nisn-siswa').textContent = siswa.nisn;
    document.getElementById('pembayaran-total').value = siswa.total_bayar;
    document.getElementById('pembayaran-jumlah').value = siswa.jumlah_bayar;
    document.getElementById('pembayaran-tanggal').value = siswa.tanggal_bayar || '';
    document.getElementById('pembayaran-status').value = siswa.status_pembayaran;
    
    $('#pembayaranModal').modal('show');
}

// Show wawancara modal
function showWawancaraModal(siswa) {
    document.getElementById('wawancara-id').value = siswa.id;
    document.getElementById('wawancara-nama-siswa').textContent = siswa.nama;
    document.getElementById('wawancara-nisn-siswa').textContent = siswa.nisn;
    document.getElementById('wawancara-tanggal').value = siswa.tanggal_wawancara || '';
    document.getElementById('wawancara-status').value = siswa.status_wawancara;
    document.getElementById('wawancara-catatan').value = siswa.catatan_wawancara || '';
    
    $('#wawancaraModal').modal('show');
}

// Handle pembayaran form submission
document.getElementById('pembayaranForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Simulate saving data
    alert('Pembayaran berhasil disimpan! (Demo - data tidak disimpan ke database)');
    $('#pembayaranModal').modal('hide');
    
    // In real implementation, send AJAX request to save data
});

// Handle wawancara form submission
document.getElementById('wawancaraForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Simulate saving data
    alert('Catatan wawancara berhasil disimpan! (Demo - data tidak disimpan ke database)');
    $('#wawancaraModal').modal('hide');
    
    // In real implementation, send AJAX request to save data
});

// Bulk action functions
function bulkUpdatePembayaran() {
    const selected = document.querySelectorAll('.select-item:checked');
    if (selected.length === 0) {
        alert('Pilih minimal satu item untuk diproses');
        return;
    }
    
    if (confirm(`Update status pembayaran untuk ${selected.length} siswa?`)) {
        const ids = Array.from(selected).map(cb => cb.value);
        console.log('Update pembayaran for IDs:', ids);
        alert('Fitur bulk update pembayaran akan diimplementasikan');
    }
}

function bulkUpdateWawancara() {
    const selected = document.querySelectorAll('.select-item:checked');
    if (selected.length === 0) {
        alert('Pilih minimal satu item untuk diproses');
        return;
    }
    
    if (confirm(`Update status wawancara untuk ${selected.length} siswa?`)) {
        const ids = Array.from(selected).map(cb => cb.value);
        console.log('Update wawancara for IDs:', ids);
        alert('Fitur bulk update wawancara akan diimplementasikan');
    }
}

function exportSelected() {
    const selected = document.querySelectorAll('.select-item:checked');
    if (selected.length === 0) {
        alert('Pilih minimal satu item untuk diexport');
        return;
    }
    
    const ids = Array.from(selected).map(cb => cb.value);
    console.log('Export selected IDs:', ids);
    alert('Fitur export data terpilih akan diimplementasikan');
}

// Export data function
function exportData() {
    alert('Fungsi export akan diimplementasikan dengan format Excel/PDF');
}

// Refresh data function
function refreshData() {
    location.reload();
}

// Auto-apply filters when typing
document.getElementById('searchInput').addEventListener('input', applyFilters);
document.getElementById('filterPembayaran').addEventListener('change', applyFilters);
document.getElementById('filterWawancara').addEventListener('change', applyFilters);
</script>
</script>

<?= $this->endsection() ?>
