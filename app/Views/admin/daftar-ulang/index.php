<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;"><?= $pageTitle ?></h2>
        <p style="color: #64748b;">Kelola konfirmasi pembayaran siswa yang diterima</p>
    </div>
    <div style="display: flex; gap: 1rem;">
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
                <?= count(array_filter($siswa, function($s) { return $s['bukti_pembayaran_id'] == null; })) ?>
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Belum Konfirmasi Pembayaran</div>
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
                                <span class="badge badge-success">Sudah Dikonfirmasi</span>
                            <?php else: ?>
                                <span class="badge badge-warning">Belum Dikonfirmasi</span>
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
                            <tr><td width="40%"><strong>Nama Lengkap</strong></td><td id="detail-nama">-</td></tr>
                            <tr><td><strong>No. Registrasi</strong></td><td id="detail-no-reg">-</td></tr>
                            <tr><td><strong>NISN</strong></td><td id="detail-nisn">-</td></tr>
                            <tr><td><strong>Tempat Lahir</strong></td><td id="detail-tempat-lahir">-</td></tr>
                            <tr><td><strong>Tanggal Lahir</strong></td><td id="detail-tanggal-lahir">-</td></tr>
                            <tr><td><strong>Jenis Kelamin</strong></td><td id="detail-jenis-kelamin">-</td></tr>
                            <tr><td><strong>Agama</strong></td><td id="detail-agama">-</td></tr>
                            <tr><td><strong>Alamat</strong></td><td id="detail-alamat">-</td></tr>
                            <tr><td><strong>Domisili</strong></td><td id="detail-domisili">-</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Data Orang Tua</h6>
                        <table class="table table-borderless table-sm">
                            <tr><td width="40%"><strong>Nama Ayah</strong></td><td id="detail-nama-ayah">-</td></tr>
                            <tr><td><strong>Nama Ibu</strong></td><td id="detail-nama-ibu">-</td></tr>
                            <tr><td><strong>No. Telepon</strong></td><td id="detail-nomor-telepon">-</td></tr>
                        </table>
                        
                        <h6 class="mt-3">Data Pendidikan</h6>
                        <table class="table table-borderless table-sm">
                            <tr><td width="40%"><strong>Asal TK/RA</strong></td><td id="detail-asal-tk">-</td></tr>
                        </table>
                        
                        <h6 class="mt-3">Status</h6>
                        <table class="table table-borderless table-sm">
                            <tr><td width="40%"><strong>Status</strong></td><td id="detail-status">-</td></tr>
                            <tr><td><strong>Diterima Pada</strong></td><td id="detail-accepted-at">-</td></tr>
                            <tr><td><strong>Status Pembayaran</strong></td><td id="detail-status-pembayaran">-</td></tr>
                        </table>
                    </div>
                </div>
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
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="Tunai">Tunai</option>
                            <option value="QRIS">QRIS</option>
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
// Show detail modal
function showDetailModal(studentId) {
    // Show loading
    $('#detailModal .modal-body').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Memuat data...</div>');
    $('#detailModal').modal('show');
    
    // Fetch student data
    fetch(`<?= base_url('admin/daftar-ulang/detail') ?>/${studentId}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const siswa = data.data;
                
                // Restore modal content
                $('#detailModal .modal-body').html(`
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Data Pribadi</h6>
                            <table class="table table-borderless table-sm">
                                <tr><td width="40%"><strong>Nama Lengkap</strong></td><td id="detail-nama">-</td></tr>
                                <tr><td><strong>No. Registrasi</strong></td><td id="detail-no-reg">-</td></tr>
                                <tr><td><strong>NISN</strong></td><td id="detail-nisn">-</td></tr>
                                <tr><td><strong>Tempat Lahir</strong></td><td id="detail-tempat-lahir">-</td></tr>
                                <tr><td><strong>Tanggal Lahir</strong></td><td id="detail-tanggal-lahir">-</td></tr>
                                <tr><td><strong>Jenis Kelamin</strong></td><td id="detail-jenis-kelamin">-</td></tr>
                                <tr><td><strong>Agama</strong></td><td id="detail-agama">-</td></tr>
                                <tr><td><strong>Alamat</strong></td><td id="detail-alamat">-</td></tr>
                                <tr><td><strong>Domisili</strong></td><td id="detail-domisili">-</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Data Orang Tua</h6>
                            <table class="table table-borderless table-sm">
                                <tr><td width="40%"><strong>Nama Ayah</strong></td><td id="detail-nama-ayah">-</td></tr>
                                <tr><td><strong>Nama Ibu</strong></td><td id="detail-nama-ibu">-</td></tr>
                                <tr><td><strong>No. Telepon</strong></td><td id="detail-nomor-telepon">-</td></tr>
                            </table>
                            
                            <h6 class="mt-3">Data Pendidikan</h6>
                            <table class="table table-borderless table-sm">
                                <tr><td width="40%"><strong>Asal TK/RA</strong></td><td id="detail-asal-tk">-</td></tr>
                            </table>
                            
                            <h6 class="mt-3">Status</h6>
                            <table class="table table-borderless table-sm">
                                <tr><td width="40%"><strong>Status</strong></td><td id="detail-status">-</td></tr>
                                <tr><td><strong>Diterima Pada</strong></td><td id="detail-accepted-at">-</td></tr>
                                <tr><td><strong>Status Pembayaran</strong></td><td id="detail-status-pembayaran">-</td></tr>
                            </table>
                        </div>
                    </div>
                `);
                
                // Fill data
                document.getElementById('detail-nama').textContent = siswa.nama_lengkap || '-';
                document.getElementById('detail-no-reg').textContent = siswa.no_registrasi || '-';
                document.getElementById('detail-nisn').textContent = siswa.nisn || '-';
                document.getElementById('detail-tempat-lahir').textContent = siswa.tempat_lahir || '-';
                document.getElementById('detail-tanggal-lahir').textContent = siswa.tanggal_lahir ? 
                    new Date(siswa.tanggal_lahir).toLocaleDateString('id-ID') : '-';
                document.getElementById('detail-jenis-kelamin').textContent = siswa.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
                document.getElementById('detail-agama').textContent = siswa.agama || '-';
                document.getElementById('detail-alamat').textContent = siswa.alamat || '-';
                document.getElementById('detail-domisili').textContent = siswa.domisili || '-';
                document.getElementById('detail-nama-ayah').textContent = siswa.nama_ayah || '-';
                document.getElementById('detail-nama-ibu').textContent = siswa.nama_ibu || '-';
                document.getElementById('detail-nomor-telepon').textContent = siswa.nomor_telepon || '-';
                document.getElementById('detail-asal-tk').textContent = siswa.asal_tk_ra || '-';
                document.getElementById('detail-status').textContent = siswa.status || '-';
                document.getElementById('detail-accepted-at').textContent = siswa.accepted_at ? 
                    new Date(siswa.accepted_at).toLocaleDateString('id-ID') : '-';
                document.getElementById('detail-status-pembayaran').textContent = siswa.bukti_pembayaran_id ? 
                    'Sudah Dikonfirmasi' : 'Belum Dikonfirmasi';
            } else {
                $('#detailModal .modal-body').html('<div class="alert alert-danger">Gagal memuat data siswa</div>');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            $('#detailModal .modal-body').html('<div class="alert alert-danger">Terjadi kesalahan saat memuat data</div>');
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
