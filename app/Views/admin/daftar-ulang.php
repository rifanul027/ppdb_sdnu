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
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Data Siswa Daftar Ulang</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="daftarUlangTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>NISN</th>
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
                            <td><?= $index + 1 ?></td>
                            <td>
                                <div class="student-info">
                                    <strong><?= esc($s['nama']) ?></strong>
                                    <small class="text-muted d-block"><?= $s['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></small>
                                </div>
                            </td>
                            <td><?= esc($s['nisn']) ?></td>
                            <td>
                                <?= esc($s['tempat_lahir']) ?>,<br>
                                <small><?= date('d/m/Y', strtotime($s['tanggal_lahir'])) ?></small>
                            </td>
                            <td>
                                <strong>Ayah:</strong> <?= esc($s['nama_ayah']) ?><br>
                                <strong>Ibu:</strong> <?= esc($s['nama_ibu']) ?>
                            </td>
                            <td>
                                <?php if ($s['status_pembayaran'] == 'Lunas'): ?>
                                    <span class="badge badge-success">Lunas</span>
                                <?php elseif ($s['status_pembayaran'] == 'Cicilan'): ?>
                                    <span class="badge badge-warning">Cicilan</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Belum Bayar</span>
                                <?php endif; ?>
                                <br>
                                <small>Rp <?= number_format($s['jumlah_bayar'], 0, ',', '.') ?> / Rp <?= number_format($s['total_bayar'], 0, ',', '.') ?></small>
                            </td>
                            <td>
                                <?php if ($s['status_wawancara'] == 'Sudah Wawancara'): ?>
                                    <span class="badge badge-success">Sudah Wawancara</span>
                                    <br>
                                    <small><?= date('d/m/Y', strtotime($s['tanggal_wawancara'])) ?></small>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Belum Wawancara</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-primary btn-sm" onclick="showDetailModal(<?= htmlspecialchars(json_encode($s)) ?>)" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-success btn-sm" onclick="showPembayaranModal(<?= htmlspecialchars(json_encode($s)) ?>)" title="Kelola Pembayaran">
                                        <i class="fas fa-money-bill"></i>
                                    </button>
                                    <button class="btn btn-info btn-sm" onclick="showWawancaraModal(<?= htmlspecialchars(json_encode($s)) ?>)" title="Kelola Wawancara">
                                        <i class="fas fa-comments"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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

<style>
.stat-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    transition: transform 0.2s;
}

.stat-card:hover {
    transform: translateY(-2px);
}

.stat-card .card-body {
    padding: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.stat-info h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #1f2937;
}

.stat-info p {
    margin: 0;
    font-size: 0.875rem;
    color: #6b7280;
}

.stat-icon {
    font-size: 2.5rem;
    opacity: 0.3;
}

.badge {
    font-size: 0.75rem;
    padding: 0.4rem 0.8rem;
}

.badge-success {
    background-color: #10b981;
}

.badge-warning {
    background-color: #f59e0b;
}

.badge-danger {
    background-color: #ef4444;
}

.badge-secondary {
    background-color: #6b7280;
}

.student-info {
    line-height: 1.4;
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.table th {
    border-top: none;
    font-weight: 600;
    background-color: #f8fafc;
}

.modal-header {
    background-color: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
}

.alert {
    border: none;
    border-radius: 10px;
}

.form-control:focus {
    border-color: #059669;
    box-shadow: 0 0 0 0.2rem rgba(5, 150, 105, 0.25);
}

.btn-primary {
    background-color: #059669;
    border-color: #059669;
}

.btn-primary:hover {
    background-color: #047857;
    border-color: #047857;
}
</style>

<script>
// Apply filters
function applyFilters() {
    const filterPembayaran = document.getElementById('filterPembayaran').value;
    const filterWawancara = document.getElementById('filterWawancara').value;
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    
    const rows = document.querySelectorAll('#daftarUlangTable tbody tr');
    
    rows.forEach(row => {
        let show = true;
        
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

<?= $this->endsection() ?>
