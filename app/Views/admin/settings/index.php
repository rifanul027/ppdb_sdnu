<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin-settings.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><?= $pageTitle ?></h1>
            <p class="text-muted">Kelola pengaturan untuk sistem PPDB SD Negeri Unggulan</p>
        </div>
    </div>

    <!-- Alert for messages -->
    <div id="alertContainer"></div>

    <!-- Tabs Navigation -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="nav nav-tabs card-header-tabs" id="settingsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tahun-ajaran-tab" data-toggle="tab" href="#tahun-ajaran" 
                       role="tab" aria-controls="tahun-ajaran" aria-selected="true">
                        <i class="fas fa-calendar-alt mr-2"></i>Tahun Ajaran
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="kategori-tab" data-toggle="tab" href="#kategori" 
                       role="tab" aria-controls="kategori" aria-selected="false">
                        <i class="fas fa-tags mr-2"></i>Kategori
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="gelombang-tab" data-toggle="tab" href="#gelombang" 
                       role="tab" aria-controls="gelombang" aria-selected="false">
                        <i class="fas fa-wave-square mr-2"></i>Gelombang Pendaftaran
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="settingsTabContent">
                
                <!-- Tab Content: Tahun Ajaran -->
                <div class="tab-pane fade show active" id="tahun-ajaran" role="tabpanel" aria-labelledby="tahun-ajaran-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="card-title mb-1">Data Tahun Ajaran</h5>
                            <small class="text-muted" id="tahun-ajaran-count">Loading...</small>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="showCreateModal('tahun-ajaran')">
                            <i class="fas fa-plus mr-2"></i>Tambah Tahun Ajaran
                        </button>
                    </div>
                    
                    <!-- Loading indicator -->
                    <div id="tahun-ajaran-loading" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Memuat data tahun ajaran...</p>
                    </div>
                    
                    <!-- Data container -->
                    <div id="tahun-ajaran-container" class="row" style="display: none;"></div>
                </div>

                <!-- Tab Content: Kategori -->
                <div class="tab-pane fade" id="kategori" role="tabpanel" aria-labelledby="kategori-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="card-title mb-1">Data Kategori Siswa</h5>
                            <small class="text-muted" id="kategori-count">Loading...</small>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="showCreateModal('kategori')">
                            <i class="fas fa-plus mr-2"></i>Tambah Kategori
                        </button>
                    </div>
                    
                    <!-- Loading indicator -->
                    <div id="kategori-loading" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Memuat data kategori...</p>
                    </div>
                    
                    <!-- Data container -->
                    <div id="kategori-container" class="row" style="display: none;"></div>
                </div>

                <!-- Tab Content: Gelombang -->
                <div class="tab-pane fade" id="gelombang" role="tabpanel" aria-labelledby="gelombang-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="card-title mb-1">Data Gelombang Pendaftaran</h5>
                            <small class="text-muted" id="gelombang-count">Loading...</small>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="showCreateModal('gelombang')">
                            <i class="fas fa-plus mr-2"></i>Tambah Gelombang
                        </button>
                    </div>
                    
                    <!-- Loading indicator -->
                    <div id="gelombang-loading" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Memuat data gelombang...</p>
                    </div>
                    
                    <!-- Data container -->
                    <div id="gelombang-container" class="row" style="display: none;"></div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal for Tahun Ajaran -->
<div class="modal fade" id="modal-tahun-ajaran" tabindex="-1" role="dialog" aria-labelledby="modalTahunAjaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTahunAjaranLabel">Tambah Tahun Ajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-tahun-ajaran">
                <div class="modal-body">
                    <input type="hidden" id="tahun-ajaran-id">
                    
                    <div class="form-group">
                        <label for="tahun-ajaran-nama" class="form-label">
                            Nama Tahun Ajaran <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="tahun-ajaran-nama" 
                               placeholder="Contoh: Tahun Ajaran 2024/2025" maxlength="100" required>
                        <small class="form-text text-muted">Nama yang akan ditampilkan untuk tahun ajaran ini</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun-mulai" class="form-label">
                                    Tahun Mulai <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control" id="tahun-mulai" 
                                       min="2020" max="2050" placeholder="2024" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun-selesai" class="form-label">
                                    Tahun Selesai <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control" id="tahun-selesai" 
                                       min="2020" max="2050" placeholder="2025" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="tahun-ajaran-deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="tahun-ajaran-deskripsi" rows="3" 
                                  placeholder="Deskripsi tambahan untuk tahun ajaran ini (opsional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn-save-tahun-ajaran">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Kategori -->
<div class="modal fade" id="modal-kategori" tabindex="-1" role="dialog" aria-labelledby="modalKategoriLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKategoriLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-kategori">
                <div class="modal-body">
                    <input type="hidden" id="kategori-id">
                    
                    <div class="form-group">
                        <label for="kategori-nama" class="form-label">
                            Nama Kategori <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="kategori-nama" 
                               placeholder="Contoh: Siswa Reguler" maxlength="100" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="kategori-spp" class="form-label">
                            SPP (Rp) <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" id="kategori-spp" 
                               placeholder="500000" min="0" required>
                        <small class="form-text text-muted">Biaya SPP per bulan untuk kategori ini</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="kategori-catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" id="kategori-catatan" rows="3" 
                                  placeholder="Catatan tambahan untuk kategori ini (opsional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn-save-kategori">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Gelombang -->
<div class="modal fade" id="modal-gelombang" tabindex="-1" role="dialog" aria-labelledby="modalGelombangLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalGelombangLabel">Tambah Gelombang Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-gelombang">
                <div class="modal-body">
                    <input type="hidden" id="gelombang-id">
                    
                    <div class="form-group">
                        <label for="gelombang-nama" class="form-label">
                            Nama Gelombang <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="gelombang-nama" 
                               placeholder="Contoh: Gelombang 1" maxlength="100" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gelombang-tanggal-mulai" class="form-label">
                                    Tanggal Mulai <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control" id="gelombang-tanggal-mulai" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gelombang-tanggal-selesai" class="form-label">
                                    Tanggal Selesai <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control" id="gelombang-tanggal-selesai" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn-save-gelombang">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Simple compatibility check and script loader
if (typeof $ !== 'undefined') {
    console.log('jQuery is available');
} else {
    console.log('jQuery not available yet, waiting...');
}
</script>
<script src="<?= base_url('assets/js/admin-settings.js') ?>"></script>
<?= $this->endSection() ?>
