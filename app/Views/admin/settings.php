<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="margin-bottom: 2rem;">
    <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">Settings</h2>
    <p style="color: #64748b;">Kelola pengaturan sistem PPDB</p>
</div>

<!-- Settings Navigation -->
<div class="content-card" style="margin-bottom: 2rem;">
    <div class="card-body" style="padding: 1rem;">
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <button type="button" class="settings-tab active" data-tab="general">
                <i class="fas fa-cogs"></i>
                Pengaturan Umum
            </button>
            <button type="button" class="settings-tab" data-tab="tahun-ajaran">
                <i class="fas fa-calendar-alt"></i>
                Tahun Ajaran
            </button>
            <button type="button" class="settings-tab" data-tab="beasiswa">
                <i class="fas fa-graduation-cap"></i>
                Beasiswa
            </button>
            <button type="button" class="settings-tab" data-tab="biaya">
                <i class="fas fa-money-bill-wave"></i>
                Biaya Sekolah
            </button>
            <button type="button" class="settings-tab" data-tab="pendaftaran">
                <i class="fas fa-clipboard-list"></i>
                Pendaftaran
            </button>
        </div>
    </div>
</div>

<!-- Tab Content Container -->
<div id="tab-content">
    <!-- Loading state -->
    <div class="content-card" id="loading-content">
        <div class="card-body text-center" style="padding: 3rem;">
            <i class="fas fa-spinner fa-spin fa-2x" style="color: #10b981; margin-bottom: 1rem;"></i>
            <p>Loading...</p>
        </div>
    </div>
</div>

<!-- Reusable Modal Structure -->
<div id="reusableModal" class="modal" style="display: none;">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h4 id="modalTitle">Modal Title</h4>
            <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body" id="modalBody">
            <!-- Modal content will be injected here -->
        </div>
        <div class="modal-footer" id="modalFooter">
            <!-- Modal footer buttons will be injected here -->
        </div>
    </div>
</div>

<style>
/* Tabs styling */
.settings-tab {
    padding: 0.75rem 1.5rem;
    background: transparent;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    color: #6b7280;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.2s;
}

.settings-tab:hover {
    background: #f9fafb;
    color: #374151;
    text-decoration: none;
}

.settings-tab.active {
    background: #10b981;
    color: white;
    border-color: #10b981;
}

.settings-tab i {
    font-size: 1rem;
}

/* Modal styling */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
}

.modal-content {
    position: relative;
    background: white;
    border-radius: 12px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    max-width: 600px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    z-index: 10000;
}

.modal-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.modal-header h4 {
    margin: 0;
    font-size: 1.125rem;
    font-weight: 600;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #6b7280;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    color: #374151;
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid #e5e7eb;
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
}

/* Table styling */
.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.data-table th,
.data-table td {
    padding: 0.75rem;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

.data-table th {
    background: #f9fafb;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.data-table tr:hover {
    background: #f9fafb;
}

/* Form styling */
.form-group {
    margin-bottom: 1rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #374151;
}

.form-input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: border-color 0.2s;
}

.form-input:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 80px;
}

.form-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
}

/* Button styling */
.btn {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    border: none;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary {
    background: #10b981;
    color: white;
}

.btn-primary:hover {
    background: #059669;
}

.btn-secondary {
    background: #6b7280;
    color: white;
}

.btn-secondary:hover {
    background: #4b5563;
}

.btn-danger {
    background: #ef4444;
    color: white;
}

.btn-danger:hover {
    background: #dc2626;
}

.btn-success {
    background: #10b981;
    color: white;
}

.btn-success:hover {
    background: #059669;
}

.btn-warning {
    background: #f59e0b;
    color: white;
}

.btn-warning:hover {
    background: #d97706;
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
}

/* Badge styling */
.badge {
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 500;
}

.badge-success {
    background: #dcfce7;
    color: #166534;
}

.badge-warning {
    background: #fef3c7;
    color: #92400e;
}

.badge-danger {
    background: #fee2e2;
    color: #991b1b;
}

/* Alert styling */
.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
}

.alert-success {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
}

.alert-error {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

.alert-warning {
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fde68a;
}

/* Loading spinner */
.spinner {
    border: 2px solid #f3f4f6;
    border-top: 2px solid #10b981;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Utility classes */
.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}

.mb-0 {
    margin-bottom: 0;
}

.mb-1 {
    margin-bottom: 0.5rem;
}

.mb-2 {
    margin-bottom: 1rem;
}

.hidden {
    display: none;
}

.flex {
    display: flex;
}

.items-center {
    align-items: center;
}

.justify-between {
    justify-content: space-between;
}

.gap-2 {
    gap: 0.5rem;
}
</style>

<script>
// Global variables
let currentTab = 'general';
let isLoading = false;

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    initializeTabs();
    loadTabContent('general');
});

// Tab management
function initializeTabs() {
    const tabs = document.querySelectorAll('.settings-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            switchTab(tabName);
        });
    });
}

function switchTab(tabName) {
    if (isLoading || currentTab === tabName) return;
    
    // Update active tab
    document.querySelectorAll('.settings-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
    
    currentTab = tabName;
    loadTabContent(tabName);
}

async function loadTabContent(tabName) {
    isLoading = true;
    const contentContainer = document.getElementById('tab-content');
    
    // Show loading
    contentContainer.innerHTML = `
        <div class="content-card">
            <div class="card-body text-center" style="padding: 3rem;">
                <i class="fas fa-spinner fa-spin fa-2x" style="color: #10b981; margin-bottom: 1rem;"></i>
                <p>Loading ${getTabTitle(tabName)}...</p>
            </div>
        </div>
    `;
    
    try {
        let content = '';
        
        switch(tabName) {
            case 'general':
                content = await loadGeneralSettings();
                break;
            case 'tahun-ajaran':
                content = await loadTahunAjaranSettings();
                break;
            case 'beasiswa':
                content = await loadBeasiswaSettings();
                break;
            case 'biaya':
                content = await loadBiayaSettings();
                break;
            case 'pendaftaran':
                content = await loadPendaftaranSettings();
                break;
            default:
                content = '<div class="alert alert-error">Tab tidak ditemukan</div>';
        }
        
        contentContainer.innerHTML = content;
        
        // Initialize tab-specific functionality
        initializeTabFunctionality(tabName);
        
    } catch (error) {
        console.error('Error loading tab content:', error);
        contentContainer.innerHTML = `
            <div class="content-card">
                <div class="card-body">
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-triangle"></i>
                        Gagal memuat konten. Silakan coba lagi.
                    </div>
                </div>
            </div>
        `;
    } finally {
        isLoading = false;
    }
}

function getTabTitle(tabName) {
    const titles = {
        'general': 'Pengaturan Umum',
        'tahun-ajaran': 'Tahun Ajaran',
        'beasiswa': 'Beasiswa',
        'biaya': 'Biaya Sekolah',
        'pendaftaran': 'Pendaftaran'
    };
    return titles[tabName] || 'Settings';
}

// General Settings
async function loadGeneralSettings() {
    return `
        <div class="content-card">
            <div class="card-header">
                <h3 class="card-title">Pengaturan Umum</h3>
            </div>
            <div class="card-body">
                <form id="generalSettingsForm">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div>
                            <div class="form-group">
                                <label class="form-label">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-input" value="SD Nahdlatul Ulama" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Alamat Sekolah</label>
                                <textarea name="alamat_sekolah" class="form-input form-textarea" required>Jl. Contoh No. 123, Jakarta</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="tel" name="telepon_sekolah" class="form-input" value="021-12345678" required>
                            </div>
                        </div>
                        
                        <div>
                            <div class="form-group">
                                <label class="form-label">Email Sekolah</label>
                                <input type="email" name="email_sekolah" class="form-input" value="info@sdnu.sch.id" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Website Sekolah</label>
                                <input type="url" name="website_sekolah" class="form-input" value="https://sdnu.sch.id">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Logo Sekolah</label>
                                <input type="file" name="logo_sekolah" class="form-input" accept="image/*">
                                <small style="color: #6b7280; font-size: 0.75rem;">Max 2MB, format: JPG, PNG</small>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    `;
}

// Tahun Ajaran Settings
async function loadTahunAjaranSettings() {
    try {
        const response = await fetch('/admin/api/settings/tahun-ajaran');
        const result = await response.json();
        
        if (!result.success) {
            throw new Error(result.message);
        }
        
        const tahunAjaranList = result.data || [];
        
        return `
            <div class="content-card">
                <div class="card-header flex items-center justify-between">
                    <h3 class="card-title">Manajemen Tahun Ajaran</h3>
                    <button type="button" class="btn btn-primary" onclick="openTahunAjaranModal()">
                        <i class="fas fa-plus"></i>
                        Tambah Tahun Ajaran
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Periode</th>
                                    <th>Pendaftaran</th>
                                    <th>Kuota</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${tahunAjaranList.map(item => `
                                    <tr>
                                        <td>
                                            <strong>${item.nama}</strong>
                                            ${item.deskripsi ? `<br><small style="color: #6b7280;">${item.deskripsi}</small>` : ''}
                                        </td>
                                        <td>${item.tahun_mulai}/${item.tahun_selesai}</td>
                                        <td>
                                            ${formatDate(item.tanggal_mulai_pendaftaran)}<br>
                                            <small style="color: #6b7280;">s/d ${formatDate(item.tanggal_selesai_pendaftaran)}</small>
                                        </td>
                                        <td>${item.kuota_maksimal} siswa</td>
                                        <td>
                                            ${item.is_active ? 
                                                '<span class="badge badge-success">Aktif</span>' : 
                                                '<span class="badge badge-warning">Tidak Aktif</span>'
                                            }
                                        </td>
                                        <td>
                                            <div class="flex gap-2">
                                                ${!item.is_active ? `
                                                    <button type="button" class="btn btn-sm btn-success" onclick="activateTahunAjaran('${item.id}')" title="Aktifkan">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                ` : ''}
                                                <button type="button" class="btn btn-sm btn-primary" onclick="editTahunAjaran('${item.id}')" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteTahunAjaran('${item.id}', '${item.nama}')" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                `).join('')}
                                ${tahunAjaranList.length === 0 ? `
                                    <tr>
                                        <td colspan="6" class="text-center" style="padding: 2rem; color: #6b7280;">
                                            <i class="fas fa-calendar-alt fa-2x" style="margin-bottom: 1rem; opacity: 0.5;"></i><br>
                                            Belum ada tahun ajaran yang terdaftar
                                        </td>
                                    </tr>
                                ` : ''}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        `;
    } catch (error) {
        return `
            <div class="content-card">
                <div class="card-body">
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-triangle"></i>
                        Gagal memuat data tahun ajaran: ${error.message}
                    </div>
                </div>
            </div>
        `;
    }
}

// Beasiswa Settings
async function loadBeasiswaSettings() {
    try {
        const response = await fetch('/admin/api/settings/beasiswa');
        const result = await response.json();
        
        if (!result.success) {
            throw new Error(result.message);
        }
        
        const beasiswaList = result.data || [];
        
        return `
            <div class="content-card">
                <div class="card-header flex items-center justify-between">
                    <h3 class="card-title">Manajemen Beasiswa</h3>
                    <button type="button" class="btn btn-primary" onclick="openBeasiswaModal()">
                        <i class="fas fa-plus"></i>
                        Tambah Beasiswa
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Besaran</th>
                                    <th>Kuota</th>
                                    <th>Periode</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${beasiswaList.map(item => `
                                    <tr>
                                        <td>
                                            <strong>${item.nama}</strong>
                                            ${item.deskripsi ? `<br><small style="color: #6b7280;">${item.deskripsi.substring(0, 50)}...</small>` : ''}
                                        </td>
                                        <td>
                                            <span class="badge badge-success">${getJenisBeasiswaLabel(item.jenis)}</span>
                                        </td>
                                        <td>
                                            ${item.besaran_rupiah ? `Rp ${formatNumber(item.besaran_rupiah)}` : ''}
                                            ${item.besaran_persen ? `${item.besaran_persen}%` : ''}
                                        </td>
                                        <td>
                                            ${item.kuota ? `${item.kuota} siswa` : 'Tidak terbatas'}
                                            ${item.usage_count ? `<br><small style="color: #6b7280;">${item.usage_count} terpakai</small>` : ''}
                                        </td>
                                        <td>
                                            ${item.tanggal_mulai && item.tanggal_selesai ? 
                                                `${formatDate(item.tanggal_mulai)}<br><small style="color: #6b7280;">s/d ${formatDate(item.tanggal_selesai)}</small>` : 
                                                '<small style="color: #6b7280;">Sepanjang tahun</small>'
                                            }
                                        </td>
                                        <td>
                                            ${item.is_active ? 
                                                '<span class="badge badge-success">Aktif</span>' : 
                                                '<span class="badge badge-warning">Tidak Aktif</span>'
                                            }
                                        </td>
                                        <td>
                                            <div class="flex gap-2">
                                                <button type="button" class="btn btn-sm btn-primary" onclick="editBeasiswa('${item.id}')" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" 
                                                        onclick="deleteBeasiswa('${item.id}', '${item.nama}', ${item.can_delete})" 
                                                        title="Hapus" ${!item.can_delete ? 'disabled' : ''}>
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                `).join('')}
                                ${beasiswaList.length === 0 ? `
                                    <tr>
                                        <td colspan="7" class="text-center" style="padding: 2rem; color: #6b7280;">
                                            <i class="fas fa-graduation-cap fa-2x" style="margin-bottom: 1rem; opacity: 0.5;"></i><br>
                                            Belum ada beasiswa yang terdaftar
                                        </td>
                                    </tr>
                                ` : ''}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        `;
    } catch (error) {
        return `
            <div class="content-card">
                <div class="card-body">
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-triangle"></i>
                        Gagal memuat data beasiswa: ${error.message}
                    </div>
                </div>
            </div>
        `;
    }
}

// Biaya Settings (placeholder)
async function loadBiayaSettings() {
    return `
        <div class="content-card">
            <div class="card-header">
                <h3 class="card-title">Pengaturan Biaya Sekolah</h3>
            </div>
            <div class="card-body">
                <p>Konten pengaturan biaya sekolah akan ditambahkan di sini...</p>
            </div>
        </div>
    `;
}

// Pendaftaran Settings (placeholder)
async function loadPendaftaranSettings() {
    return `
        <div class="content-card">
            <div class="card-header">
                <h3 class="card-title">Pengaturan Pendaftaran</h3>
            </div>
            <div class="card-body">
                <p>Konten pengaturan pendaftaran akan ditambahkan di sini...</p>
            </div>
        </div>
    `;
}

function initializeTabFunctionality(tabName) {
    switch(tabName) {
        case 'general':
            initializeGeneralSettings();
            break;
        case 'tahun-ajaran':
            // Already initialized in loadTahunAjaranSettings
            break;
        case 'beasiswa':
            // Already initialized in loadBeasiswaSettings
            break;
    }
}

function initializeGeneralSettings() {
    const form = document.getElementById('generalSettingsForm');
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            // Handle form submission
            showAlert('success', 'Pengaturan umum berhasil disimpan');
        });
    }
}

// Modal functions
function openModal(title, content, footer = '') {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalBody').innerHTML = content;
    document.getElementById('modalFooter').innerHTML = footer;
    document.getElementById('reusableModal').style.display = 'flex';
    
    // Close modal when clicking overlay
    document.querySelector('.modal-overlay').onclick = closeModal;
}

function closeModal() {
    document.getElementById('reusableModal').style.display = 'none';
}

// Tahun Ajaran Modal Functions
function openTahunAjaranModal(data = null) {
    const isEdit = data !== null;
    const title = isEdit ? 'Edit Tahun Ajaran' : 'Tambah Tahun Ajaran';
    
    const content = `
        <form id="tahunAjaranForm">
            <div class="form-group">
                <label class="form-label">Nama Tahun Ajaran *</label>
                <input type="text" name="nama" class="form-input" value="${data?.nama || ''}" required>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Tahun Mulai *</label>
                    <input type="number" name="tahun_mulai" class="form-input" value="${data?.tahun_mulai || new Date().getFullYear()}" min="2020" max="2050" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Tahun Selesai *</label>
                    <input type="number" name="tahun_selesai" class="form-input" value="${data?.tahun_selesai || new Date().getFullYear() + 1}" min="2020" max="2050" required>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Tanggal Mulai Pendaftaran *</label>
                    <input type="date" name="tanggal_mulai_pendaftaran" class="form-input" value="${data?.tanggal_mulai_pendaftaran || ''}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Selesai Pendaftaran *</label>
                    <input type="date" name="tanggal_selesai_pendaftaran" class="form-input" value="${data?.tanggal_selesai_pendaftaran || ''}" required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Kuota Maksimal *</label>
                <input type="number" name="kuota_maksimal" class="form-input" value="${data?.kuota_maksimal || ''}" min="1" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-input form-textarea">${data?.deskripsi || ''}</textarea>
            </div>
            
            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="is_active" ${data?.is_active ? 'checked' : ''}>
                    <span class="form-label mb-0">Aktifkan tahun ajaran ini</span>
                </label>
                <small style="color: #6b7280;">Hanya satu tahun ajaran yang bisa aktif pada satu waktu</small>
            </div>
        </form>
    `;
    
    const footer = `
        <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
        <button type="button" class="btn btn-primary" onclick="saveTahunAjaran(${isEdit ? `'${data.id}'` : null})">
            <i class="fas fa-save"></i>
            ${isEdit ? 'Perbarui' : 'Simpan'}
        </button>
    `;
    
    openModal(title, content, footer);
}

async function saveTahunAjaran(id = null) {
    const form = document.getElementById('tahunAjaranForm');
    const formData = new FormData(form);
    
    // Convert FormData to object
    const data = {};
    for (let [key, value] of formData.entries()) {
        if (key === 'is_active') {
            data[key] = form.querySelector(`[name="${key}"]`).checked;
        } else {
            data[key] = value;
        }
    }
    
    const isEdit = id !== null;
    const url = isEdit ? `/admin/api/settings/tahun-ajaran/${id}` : '/admin/api/settings/tahun-ajaran';
    const method = isEdit ? 'PUT' : 'POST';
    
    try {
        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            closeModal();
            showAlert('success', result.message);
            loadTabContent('tahun-ajaran'); // Reload data
        } else {
            if (result.errors) {
                let errorMessage = 'Validasi gagal:\n';
                for (let field in result.errors) {
                    errorMessage += `- ${result.errors[field]}\n`;
                }
                showAlert('error', errorMessage);
            } else {
                showAlert('error', result.message);
            }
        }
    } catch (error) {
        showAlert('error', 'Terjadi kesalahan saat menyimpan data');
        console.error('Error:', error);
    }
}

async function editTahunAjaran(id) {
    try {
        const response = await fetch('/admin/api/settings/tahun-ajaran');
        const result = await response.json();
        
        if (result.success) {
            const data = result.data.find(item => item.id === id);
            if (data) {
                openTahunAjaranModal(data);
            } else {
                showAlert('error', 'Data tidak ditemukan');
            }
        } else {
            showAlert('error', 'Gagal mengambil data');
        }
    } catch (error) {
        showAlert('error', 'Terjadi kesalahan saat mengambil data');
        console.error('Error:', error);
    }
}

async function deleteTahunAjaran(id, nama) {
    const content = `
        <div class="text-center">
            <i class="fas fa-exclamation-triangle fa-3x" style="color: #ef4444; margin-bottom: 1rem;"></i>
            <h4 style="margin-bottom: 1rem;">Konfirmasi Hapus</h4>
            <p>Apakah Anda yakin ingin menghapus tahun ajaran <strong>"${nama}"</strong>?</p>
            <p style="color: #ef4444; font-size: 0.875rem;">Tindakan ini tidak dapat dibatalkan!</p>
        </div>
    `;
    
    const footer = `
        <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
        <button type="button" class="btn btn-danger" onclick="confirmDeleteTahunAjaran('${id}')">
            <i class="fas fa-trash"></i>
            Ya, Hapus
        </button>
    `;
    
    openModal('Konfirmasi Hapus', content, footer);
}

async function confirmDeleteTahunAjaran(id) {
    try {
        const response = await fetch(`/admin/api/settings/tahun-ajaran/${id}`, {
            method: 'DELETE'
        });
        
        const result = await response.json();
        
        if (result.success) {
            closeModal();
            showAlert('success', result.message);
            loadTabContent('tahun-ajaran'); // Reload data
        } else {
            showAlert('error', result.message);
        }
    } catch (error) {
        showAlert('error', 'Terjadi kesalahan saat menghapus data');
        console.error('Error:', error);
    }
}

async function activateTahunAjaran(id) {
    try {
        const response = await fetch(`/admin/api/settings/tahun-ajaran/${id}/activate`, {
            method: 'POST'
        });
        
        const result = await response.json();
        
        if (result.success) {
            showAlert('success', result.message);
            loadTabContent('tahun-ajaran'); // Reload data
        } else {
            showAlert('error', result.message);
        }
    } catch (error) {
        showAlert('error', 'Terjadi kesalahan saat mengaktifkan tahun ajaran');
        console.error('Error:', error);
    }
}

// Beasiswa Modal Functions
function openBeasiswaModal(data = null) {
    const isEdit = data !== null;
    const title = isEdit ? 'Edit Beasiswa' : 'Tambah Beasiswa';
    
    const jenisOptions = [
        { value: 'prestasi', label: 'Beasiswa Prestasi' },
        { value: 'ekonomi', label: 'Beasiswa Ekonomi' },
        { value: 'yatim_piatu', label: 'Beasiswa Yatim Piatu' },
        { value: 'anak_guru', label: 'Beasiswa Anak Guru' },
        { value: 'khusus', label: 'Beasiswa Khusus' }
    ];
    
    const content = `
        <form id="beasiswaForm">
            <div class="form-group">
                <label class="form-label">Nama Beasiswa *</label>
                <input type="text" name="nama" class="form-input" value="${data?.nama || ''}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Jenis Beasiswa *</label>
                <select name="jenis" class="form-input form-select" required>
                    <option value="">Pilih Jenis Beasiswa</option>
                    ${jenisOptions.map(option => `
                        <option value="${option.value}" ${data?.jenis === option.value ? 'selected' : ''}>
                            ${option.label}
                        </option>
                    `).join('')}
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Deskripsi *</label>
                <textarea name="deskripsi" class="form-input form-textarea" required>${data?.deskripsi || ''}</textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Syarat & Ketentuan</label>
                <textarea name="syarat" class="form-input form-textarea">${data?.syarat || ''}</textarea>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Besaran (Rupiah)</label>
                    <input type="number" name="besaran_rupiah" class="form-input" value="${data?.besaran_rupiah || ''}" min="0">
                    <small style="color: #6b7280;">Isi jika beasiswa berupa nominal tetap</small>
                </div>
                <div class="form-group">
                    <label class="form-label">Besaran (Persen)</label>
                    <input type="number" name="besaran_persen" class="form-input" value="${data?.besaran_persen || ''}" min="0" max="100">
                    <small style="color: #6b7280;">Isi jika beasiswa berupa persentase</small>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-input" value="${data?.tanggal_mulai || ''}">
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-input" value="${data?.tanggal_selesai || ''}">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Kuota</label>
                <input type="number" name="kuota" class="form-input" value="${data?.kuota || ''}" min="1">
                <small style="color: #6b7280;">Kosongkan jika tidak ada batasan kuota</small>
            </div>
            
            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="is_active" ${data?.is_active ? 'checked' : ''}>
                    <span class="form-label mb-0">Aktifkan beasiswa ini</span>
                </label>
            </div>
        </form>
    `;
    
    const footer = `
        <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
        <button type="button" class="btn btn-primary" onclick="saveBeasiswa(${isEdit ? `'${data.id}'` : null})">
            <i class="fas fa-save"></i>
            ${isEdit ? 'Perbarui' : 'Simpan'}
        </button>
    `;
    
    openModal(title, content, footer);
}

async function saveBeasiswa(id = null) {
    const form = document.getElementById('beasiswaForm');
    const formData = new FormData(form);
    
    // Convert FormData to object
    const data = {};
    for (let [key, value] of formData.entries()) {
        if (key === 'is_active') {
            data[key] = form.querySelector(`[name="${key}"]`).checked;
        } else {
            data[key] = value || null;
        }
    }
    
    const isEdit = id !== null;
    const url = isEdit ? `/admin/api/settings/beasiswa/${id}` : '/admin/api/settings/beasiswa';
    const method = isEdit ? 'PUT' : 'POST';
    
    try {
        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            closeModal();
            showAlert('success', result.message);
            loadTabContent('beasiswa'); // Reload data
        } else {
            if (result.errors) {
                let errorMessage = 'Validasi gagal:\n';
                for (let field in result.errors) {
                    errorMessage += `- ${result.errors[field]}\n`;
                }
                showAlert('error', errorMessage);
            } else {
                showAlert('error', result.message);
            }
        }
    } catch (error) {
        showAlert('error', 'Terjadi kesalahan saat menyimpan data');
        console.error('Error:', error);
    }
}

async function editBeasiswa(id) {
    try {
        const response = await fetch('/admin/api/settings/beasiswa');
        const result = await response.json();
        
        if (result.success) {
            const data = result.data.find(item => item.id === id);
            if (data) {
                openBeasiswaModal(data);
            } else {
                showAlert('error', 'Data tidak ditemukan');
            }
        } else {
            showAlert('error', 'Gagal mengambil data');
        }
    } catch (error) {
        showAlert('error', 'Terjadi kesalahan saat mengambil data');
        console.error('Error:', error);
    }
}

async function deleteBeasiswa(id, nama, canDelete) {
    if (!canDelete) {
        showAlert('warning', 'Beasiswa tidak dapat dihapus karena masih digunakan oleh siswa');
        return;
    }
    
    const content = `
        <div class="text-center">
            <i class="fas fa-exclamation-triangle fa-3x" style="color: #ef4444; margin-bottom: 1rem;"></i>
            <h4 style="margin-bottom: 1rem;">Konfirmasi Hapus</h4>
            <p>Apakah Anda yakin ingin menghapus beasiswa <strong>"${nama}"</strong>?</p>
            <p style="color: #ef4444; font-size: 0.875rem;">Tindakan ini tidak dapat dibatalkan!</p>
        </div>
    `;
    
    const footer = `
        <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
        <button type="button" class="btn btn-danger" onclick="confirmDeleteBeasiswa('${id}')">
            <i class="fas fa-trash"></i>
            Ya, Hapus
        </button>
    `;
    
    openModal('Konfirmasi Hapus', content, footer);
}

async function confirmDeleteBeasiswa(id) {
    try {
        const response = await fetch(`/admin/api/settings/beasiswa/${id}`, {
            method: 'DELETE'
        });
        
        const result = await response.json();
        
        if (result.success) {
            closeModal();
            showAlert('success', result.message);
            loadTabContent('beasiswa'); // Reload data
        } else {
            showAlert('error', result.message);
        }
    } catch (error) {
        showAlert('error', 'Terjadi kesalahan saat menghapus data');
        console.error('Error:', error);
    }
}

// Utility functions
function formatDate(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
    });
}

function formatNumber(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}

function getJenisBeasiswaLabel(jenis) {
    const labels = {
        'prestasi': 'Prestasi',
        'ekonomi': 'Ekonomi',
        'yatim_piatu': 'Yatim Piatu',
        'anak_guru': 'Anak Guru',
        'khusus': 'Khusus'
    };
    return labels[jenis] || jenis;
}

function showAlert(type, message) {
    // Create alert element
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'}"></i>
        ${message}
    `;
    
    // Insert at the top of tab content
    const tabContent = document.getElementById('tab-content');
    tabContent.insertBefore(alertDiv, tabContent.firstChild);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.parentNode.removeChild(alertDiv);
        }
    }, 5000);
    
    // Scroll to top to show alert
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>

<?= $this->endSection() ?>
