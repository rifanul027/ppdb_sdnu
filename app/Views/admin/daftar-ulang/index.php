<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;"><?= $pageTitle ?></h2>
        <p style="color: #64748b;">Kelola konfirmasi pembayaran siswa yang diterima</p>
    </div>
    <div style="display: flex; gap: 1rem; align-items: center;">
        <!-- Filters -->
        <div style="display: flex; gap: 0.5rem; align-items: center;">
            <select id="filterTahunAjaran" class="form-control" style="width: auto;" onchange="applyFilters()">
                <?php foreach ($tahunAjaranList as $ta): ?>
                    <option value="<?= $ta['tahun_mulai'] ?>" <?= $ta['tahun_mulai'] == $selectedYear ? 'selected' : '' ?>>
                        <?= esc($ta['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <select id="filterAccepted" class="form-control" style="width: auto;" onchange="applyFilters()">
                <option value="all" <?= $acceptedFilter == 'all' ? 'selected' : '' ?>>Semua Pembayaran</option>
                <option value="validated" <?= $acceptedFilter == 'validated' ? 'selected' : '' ?>>Sudah Divalidasi</option>
                <option value="not_validated" <?= $acceptedFilter == 'not_validated' ? 'selected' : '' ?>>Belum Divalidasi</option>
            </select>
        </div>
        
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
            <div style="color: #64748b; font-size: 0.875rem;">Total Siswa Diterima</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #f59e0b; margin-bottom: 0.5rem;">
                <?= count(array_filter($siswa, function($s) { return $s['bukti_pembayaran_id'] != null && $s['pembayaran_accepted_at'] == null; })) ?>
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Belum Divalidasi</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #059669; margin-bottom: 0.5rem;">
                <?= count(array_filter($siswa, function($s) { return $s['pembayaran_accepted_at'] != null; })) ?>
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Sudah Divalidasi</div>
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
                        <th>No. Registrasi</th>
                        <th>Nama Siswa</th>
                        <th>Status Pembayaran</th>
                        <th>Orang Tua</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($siswa as $index => $s): ?>
                    <tr>
                        <td>
                            <span style="font-family: monospace; font-weight: 600; color: #059669;">
                                <?= esc($s['no_registrasi']) ?>
                            </span>
                        </td>
                        <td>
                            <div style="font-weight: 600;"><?= esc($s['nama_lengkap']) ?></div>
                            <div style="font-size: 0.875rem; color: #64748b;">
                                <?= $s['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($s['bukti_pembayaran_id'] != null): ?>
                                <?php if ($s['pembayaran_accepted_at'] != null): ?>
                                    <span class="badge badge-success">Sudah Divalidasi</span>
                                    <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.25rem;">
                                        <?= date('d/m/Y H:i', strtotime($s['pembayaran_accepted_at'])) ?>
                                    </div>
                                <?php else: ?>
                                    <span class="badge badge-warning">Menunggu Validasi</span>
                                <?php endif; ?>
                                <div style="font-size: 0.75rem; color: #059669; margin-top: 0.25rem; font-family: monospace; font-weight: 600;">
                                    ID: <?= esc($s['bukti_pembayaran_id']) ?>
                                </div>
                            <?php else: ?>
                                <span class="badge badge-danger">Belum Upload Bukti</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="font-weight: 500;"><?= esc($s['nama_ayah']) ?></div>
                            <div style="font-size: 0.875rem; color: #64748b;">
                                <?= esc($s['nama_ibu']) ?>
                            </div>
                        </td>
                        <td>
                            <span style="font-family: monospace;">
                                <?= esc($s['nomor_telepon']) ?>
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <button onclick="showDetailModal('<?= $s['id'] ?>')" 
                                        class="btn btn-secondary" 
                                        style="padding: 0.5rem; font-size: 0.75rem;"
                                        title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <?php if ($s['nomor_telepon']): ?>
                                <a href="https://wa.me/62<?= ltrim($s['nomor_telepon'], '0') ?>" 
                                   target="_blank" 
                                   class="btn btn-success" 
                                   style="padding: 0.5rem; font-size: 0.75rem;"
                                   title="WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <?php endif; ?>
                                <?php if ($s['bukti_pembayaran_id'] == null): ?>
                                <button onclick="showPembayaranModal('<?= $s['id'] ?>', '<?= esc($s['nama_lengkap']) ?>')" 
                                        class="btn btn-primary" 
                                        style="padding: 0.5rem; font-size: 0.75rem;"
                                        title="Konfirmasi Pembayaran">
                                    <i class="fas fa-money-bill"></i>
                                </button>
                                <?php else: ?>
                                <button class="btn btn-success" 
                                        style="padding: 0.5rem; font-size: 0.75rem;"
                                        title="Pembayaran Dikonfirmasi"
                                        disabled>
                                    <i class="fas fa-check"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($siswa)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 3rem; color: #64748b;">
                            <i class="fas fa-graduation-cap" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                            <div>Belum ada siswa yang perlu dikonfirmasi pembayaran</div>
                            <div style="font-size: 0.875rem; margin-top: 0.5rem;">
                                Siswa yang diterima akan muncul di sini
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail Siswa -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Siswa</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Pembayaran -->
<div class="modal fade" id="pembayaranModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="pembayaranForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="student_id" name="student_id">
                    
                    <div class="alert alert-info">
                        <strong>Siswa:</strong> <span id="pembayaran-nama-siswa"></span>
                    </div>
                    
                    <div class="form-group">
                        <label>Nama Pembayar <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_pembayar" name="nama_pembayar" required 
                               placeholder="Nama orang yang melakukan pembayaran">
                        <small class="form-text text-muted">Isikan nama orang tua atau wali yang melakukan pembayaran</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Metode Pembayaran <span class="text-danger">*</span></label>
                        <select class="form-control" id="metode" name="metode" required>
                            <option value="">-- Pilih Metode Pembayaran --</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="cash">Tunai</option>
                           
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Bukti Pembayaran <span class="text-danger">*</span></label>
                        <input type="file" class="form-control-file" id="bukti_pembayaran" name="bukti_pembayaran" 
                               accept="image/jpeg,image/jpg,image/png" required>
                        <small class="form-text text-muted">
                            Upload foto/scan bukti pembayaran (format: JPG, JPEG, PNG, maksimal 2MB)
                        </small>
                    </div>
                    
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Perhatian:</strong> Pastikan data pembayaran sudah benar sebelum konfirmasi. 
                        Data tidak dapat diubah setelah dikonfirmasi.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitPembayaran">
                        <i class="fas fa-check"></i> Konfirmasi Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Apply filters function
function applyFilters() {
    const tahunAjaran = document.getElementById('filterTahunAjaran').value;
    const acceptedFilter = document.getElementById('filterAccepted').value;
    
    const url = new URL(window.location);
    url.searchParams.set('tahun_mulai', tahunAjaran);
    url.searchParams.set('accepted_filter', acceptedFilter);
    
    window.location.href = url.toString();
}

// Show detail modal with payment validation
function showDetailModal(studentId) {
    // Show loading
    $('#detailModal .modal-body').html('<div class="text-center py-5"><i class="fas fa-spinner fa-spin fa-2x"></i><p class="mt-3">Memuat data siswa...</p></div>');
    $('#detailModal').modal('show');
    
    // Fetch student data
    fetch(`<?= base_url('admin/daftar-ulang/detail') ?>/${studentId}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const siswa = data.data;
                
                let paymentSection = '';
                if (siswa.bukti_pembayaran_id) {
                    const statusBadge = siswa.pembayaran_accepted_at ? 
                        '<span class="badge badge-success">Sudah Divalidasi</span>' : 
                        '<span class="badge badge-warning">Menunggu Validasi</span>';
                    
                    const validationDate = siswa.pembayaran_accepted_at ? 
                        `<tr><td><strong>Divalidasi Pada</strong></td><td>${new Date(siswa.pembayaran_accepted_at).toLocaleString('id-ID')}</td></tr>` : '';
                    
                    const imageSection = siswa.bukti_url ? 
                        `<div class="mt-3">
                            <h6>Bukti Pembayaran</h6>
                            <img src="<?= base_url() ?>${siswa.bukti_url}" 
                                 alt="Bukti Pembayaran" 
                                 class="img-thumbnail" 
                                 style="max-width: 300px; cursor: pointer;" 
                                 onclick="window.open('<?= base_url() ?>${siswa.bukti_url}', '_blank')">
                        </div>` : '';
                        
                    const validationButton = !siswa.pembayaran_accepted_at ? 
                        `<button type="button" class="btn btn-success mt-3" onclick="validasiPembayaran('${siswa.id}')">
                            <i class="fas fa-check"></i> Validasi Pembayaran
                        </button>` : '';
                    
                    paymentSection = `
                        <div class="col-md-12">
                            <h6>Data Pembayaran</h6>
                            <table class="table table-borderless table-sm">
                                <tr><td width="20%"><strong>Status Pembayaran</strong></td><td>${statusBadge}</td></tr>
                                <tr><td><strong>Nama Pembayar</strong></td><td>${siswa.nama_pembayar || '-'}</td></tr>
                                <tr><td><strong>Metode</strong></td><td>${siswa.pembayaran_metode || '-'}</td></tr>
                                <tr><td><strong>Tanggal Upload</strong></td><td>${siswa.pembayaran_created_at ? new Date(siswa.pembayaran_created_at).toLocaleString('id-ID') : '-'}</td></tr>
                                ${validationDate}
                            </table>
                            ${imageSection}
                            ${validationButton}
                        </div>`;
                } else {
                    paymentSection = `
                        <div class="col-md-12">
                            <h6>Data Pembayaran</h6>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Siswa belum mengupload bukti pembayaran
                            </div>
                        </div>`;
                }
                
                const waButton = siswa.nomor_telepon ? 
                    `<a href="https://wa.me/62${siswa.nomor_telepon.replace(/^0/, '')}" 
                       target="_blank" 
                       class="btn btn-success">
                        <i class="fab fa-whatsapp mr-2"></i> ${siswa.nomor_telepon}
                    </a>` : '';
                
                // Restore modal content
                $('#detailModal .modal-body').html(`
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Data Pribadi</h6>
                            <table class="table table-borderless table-sm">
                                <tr><td width="40%"><strong>Nama Lengkap</strong></td><td>${siswa.nama_lengkap || '-'}</td></tr>
                                <tr><td><strong>No. Registrasi</strong></td><td>${siswa.no_registrasi || '-'}</td></tr>
                                <tr><td><strong>NISN</strong></td><td>${siswa.nisn || '-'}</td></tr>
                                <tr><td><strong>Tempat Lahir</strong></td><td>${siswa.tempat_lahir || '-'}</td></tr>
                                <tr><td><strong>Tanggal Lahir</strong></td><td>${siswa.tanggal_lahir ? new Date(siswa.tanggal_lahir).toLocaleDateString('id-ID') : '-'}</td></tr>
                                <tr><td><strong>Jenis Kelamin</strong></td><td>${siswa.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}</td></tr>
                                <tr><td><strong>Agama</strong></td><td>${siswa.agama || '-'}</td></tr>
                                <tr><td><strong>Alamat</strong></td><td>${siswa.alamat || '-'}</td></tr>
                                <tr><td><strong>Domisili</strong></td><td>${siswa.domisili || '-'}</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Data Orang Tua</h6>
                            <table class="table table-borderless table-sm">
                                <tr><td width="40%"><strong>Nama Ayah</strong></td><td>${siswa.nama_ayah || '-'}</td></tr>
                                <tr><td><strong>Nama Ibu</strong></td><td>${siswa.nama_ibu || '-'}</td></tr>
                                <tr><td><strong>No. Telepon</strong></td><td>${waButton}</td></tr>
                            </table>
                            
                            <h6 class="mt-3">Data Pendidikan</h6>
                            <table class="table table-borderless table-sm">
                                <tr><td width="40%"><strong>Asal TK/RA</strong></td><td>${siswa.asal_tk_ra || '-'}</td></tr>
                            </table>
                            
                            <h6 class="mt-3">Status</h6>
                            <table class="table table-borderless table-sm">
                                <tr><td width="40%"><strong>Status</strong></td><td>${siswa.status || '-'}</td></tr>
                                <tr><td><strong>Tahun Ajaran</strong></td><td>${siswa.tahun_ajaran_nama || '-'}</td></tr>
                                <tr><td><strong>Diterima Pada</strong></td><td>${siswa.accepted_at ? new Date(siswa.accepted_at).toLocaleString('id-ID') : '-'}</td></tr>
                            </table>
                        </div>
                        ${paymentSection}
                    </div>
                `);
            } else {
                $('#detailModal .modal-body').html('<div class="alert alert-danger">Gagal memuat data siswa</div>');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            $('#detailModal .modal-body').html('<div class="alert alert-danger">Terjadi kesalahan saat memuat data</div>');
        });
}

// Validate payment function
function validasiPembayaran(studentId) {
    if (!confirm('Apakah Anda yakin ingin memvalidasi pembayaran ini?')) {
        return;
    }
    
    const formData = new FormData();
    formData.append('student_id', studentId);
    
    fetch('<?= base_url('admin/daftar-ulang/validasi-pembayaran') ?>', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Pembayaran berhasil divalidasi!');
            $('#detailModal').modal('hide');
            location.reload();
        } else {
            alert('Gagal memvalidasi pembayaran: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memvalidasi pembayaran');
    });
}

// Show pembayaran modal
function showPembayaranModal(studentId, namaLengkap) {
    document.getElementById('student_id').value = studentId;
    document.getElementById('pembayaran-nama-siswa').textContent = namaLengkap;
    
    // Reset form
    document.getElementById('pembayaranForm').reset();
    document.getElementById('student_id').value = studentId;
    
    $('#pembayaranModal').modal('show');
}

// Handle pembayaran form submission
document.getElementById('pembayaranForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitPembayaran');
    const originalText = submitBtn.innerHTML;
    
    // Show loading
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
    
    const formData = new FormData(this);
    
    fetch('<?= base_url('admin/daftar-ulang/konfirmasi-pembayaran') ?>', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Pembayaran berhasil dikonfirmasi!');
            $('#pembayaranModal').modal('hide');
            location.reload();
        } else {
            let errorMessage = data.message;
            if (data.errors) {
                errorMessage += '\n\nDetail:\n';
                Object.values(data.errors).forEach(error => {
                    errorMessage += '- ' + error + '\n';
                });
            }
            alert('Gagal konfirmasi pembayaran:\n' + errorMessage);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses pembayaran');
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
});

// Refresh data function
function refreshData() {
    location.reload();
}
</script>

<?= $this->endsection() ?>
