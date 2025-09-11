<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;"><?= $pageTitle ?></h2>
        <p style="color: #64748b;">Rekap data siswa yang sudah diterima dan pembayaran lunas</p>
    </div>
    <div style="display: flex; gap: 1rem;">
        <button class="btn btn-secondary" onclick="exportPdf()">
            <i class="fas fa-file-pdf"></i>
            Export PDF
        </button>
        <button class="btn btn-success" onclick="exportExcel()">
            <i class="fas fa-file-excel"></i>
            Export Excel
        </button>
        <button class="btn btn-primary" onclick="refreshData()">
            <i class="fas fa-sync"></i>
            Refresh
        </button>
    </div>
</div>

<!-- Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;" id="statsContainer">
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #059669; margin-bottom: 0.5rem;" id="totalSiswa">
                0
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Total Siswa</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #3b82f6; margin-bottom: 0.5rem;" id="lakiLaki">
                0
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Laki-laki</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #ec4899; margin-bottom: 0.5rem;" id="perempuan">
                0
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Perempuan</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body" style="text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: #f59e0b; margin-bottom: 0.5rem;" id="denganBeasiswa">
                0
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">Dengan Beasiswa</div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="content-card" style="margin-bottom: 2rem;">
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: end;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tahun Ajaran</label>
                <select id="filterTahunAjaran" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    <option value="">Semua Tahun Ajaran</option>
                    <?php foreach ($tahunAjaran as $tahun): ?>
                        <option value="<?= $tahun['id'] ?>" 
                                <?= ($defaultTahunAjaran && $defaultTahunAjaran['id'] === $tahun['id']) ? 'selected' : '' ?>>
                            <?= $tahun['nama'] ?> (<?= $tahun['tahun_mulai'] ?>/<?= $tahun['tahun_selesai'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Pencarian</label>
                <input type="text" id="searchInput" placeholder="Cari nama siswa, NISN, atau nama orang tua..." 
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
        <h3 class="card-title">Data Rekap Siswa</h3>
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="color: #64748b; font-size: 0.875rem;" id="totalInfo">
                Total: 0 siswa
            </div>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span style="font-size: 0.875rem; color: #64748b;">Per halaman:</span>
                <select id="perPageSelect" style="padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem;">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        <!-- Loading State -->
        <div id="loadingState" class="hidden" style="padding: 3rem; text-align: center; color: #64748b;">
            <i class="fas fa-spinner fa-spin" style="font-size: 2rem; margin-bottom: 1rem;"></i>
            <div>Memuat data...</div>
        </div>

        <div class="table-container" id="tableContainer">
            <table class="table" id="rekapSiswaTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Registrasi</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Orang Tua</th>
                        <th>Tahun Ajaran</th>
                        <th>Beasiswa</th>
                        <th>Tgl Diterima</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Data will be loaded here via AJAX -->
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="card-footer" style="padding: 1rem;" id="paginationContainer">
        <!-- Pagination will be loaded here -->
    </div>
</div>

<script>
let currentPage = 1;
let currentPerPage = 10;
let currentFilters = {};

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Set default filter if available
    <?php if ($defaultTahunAjaran): ?>
    currentFilters.tahun_ajaran_id = '<?= $defaultTahunAjaran['id'] ?>';
    <?php endif; ?>
    
    loadStudents();
    loadSummaryStats();
    
    // Setup event listeners
    document.getElementById('perPageSelect').addEventListener('change', handlePerPageChange);
    document.getElementById('searchInput').addEventListener('input', debounce(applyFilters, 500));
    document.getElementById('filterTahunAjaran').addEventListener('change', applyFilters);
});

// Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Load students data
async function loadStudents() {
    showLoading(true);
    
    try {
        const params = new URLSearchParams({
            page: currentPage,
            per_page: currentPerPage,
            ...currentFilters
        });
        
        const response = await fetch(`<?= base_url('admin/rekap-siswa/data') ?>?${params}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            renderTable(result.data);
            renderPagination(result.pagination);
            updateTotalInfo(result.pagination.total);
        } else {
            // Show error and render empty state
            showError(result.message || 'Gagal memuat data');
            renderTable([]); // Render empty table
            renderPagination({ page: 1, total_pages: 1, total: 0, per_page: currentPerPage }); // Empty pagination
            updateTotalInfo(0); // Update total info to 0
        }
    } catch (error) {
        showError('Terjadi kesalahan saat memuat data');
        console.error('Error loading students:', error);
        // Reset UI to empty state on error
        renderTable([]);
        renderPagination({ page: 1, total_pages: 1, total: 0, per_page: currentPerPage });
        updateTotalInfo(0);
    } finally {
        showLoading(false);
    }
}

// Load summary statistics
async function loadSummaryStats() {
    try {
        const params = new URLSearchParams(currentFilters);
        
        const response = await fetch(`<?= base_url('admin/rekap-siswa/summary') ?>?${params}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            updateStatsDisplay(result.data);
        }
    } catch (error) {
        console.error('Error loading summary stats:', error);
    }
}

// Update statistics display
function updateStatsDisplay(stats) {
    document.getElementById('totalSiswa').textContent = stats.total_siswa;
    document.getElementById('lakiLaki').textContent = stats.laki_laki;
    document.getElementById('perempuan').textContent = stats.perempuan;
    document.getElementById('denganBeasiswa').textContent = stats.dengan_beasiswa;
}

// Render table
function renderTable(students) {
    const tbody = document.getElementById('tableBody');
    
    if (students.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="10" style="text-align: center; padding: 3rem; color: #64748b;">
                    <i class="fas fa-users" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <div>Tidak ada data siswa yang ditemukan</div>
                    <div style="font-size: 0.875rem; margin-top: 0.5rem;">
                        Coba ubah filter atau kriteria pencarian
                    </div>
                </td>
            </tr>
        `;
        return;
    }
    
    const startNumber = (currentPage - 1) * currentPerPage;
    
    tbody.innerHTML = students.map((student, index) => `
        <tr>
            <td style="font-weight: 600; color: #64748b;">${startNumber + index + 1}</td>
            <td>
                <span style="font-family: monospace; font-weight: 600; color: #059669;">
                    ${escapeHtml(student.no_registrasi)}
                </span>
            </td>
            <td>
                <span style="font-family: monospace; font-weight: 600; color: #3b82f6;">
                    ${escapeHtml(student.nisn || '-')}
                </span>
            </td>
            <td>
                <div style="font-weight: 600;">${escapeHtml(student.nama_lengkap)}</div>
            </td>
            <td>
                <span class="badge ${student.jenis_kelamin === 'L' ? 'badge-primary' : 'badge-secondary'}">
                    ${student.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}
                </span>
            </td>
            <td>
                <div>${escapeHtml(student.tempat_lahir)}</div>
                <div style="font-size: 0.875rem; color: #64748b;">
                    ${student.tanggal_lahir_formatted}
                </div>
            </td>
            <td>
                <div style="font-weight: 500;">${escapeHtml(student.nama_ayah)}</div>
                <div style="font-size: 0.875rem; color: #64748b;">
                    ${escapeHtml(student.nama_ibu)}
                </div>
            </td>
            <td>
                <div style="font-weight: 500;">${escapeHtml(student.tahun_ajaran_nama || '-')}</div>
                <div style="font-size: 0.875rem; color: #64748b;">
                    ${student.tahun_mulai}/${student.tahun_selesai}
                </div>
            </td>
            <td>
                ${student.beasiswa_nama ? 
                    `<span class="badge badge-warning">${escapeHtml(student.beasiswa_nama)}</span>` : 
                    '<span style="color: #64748b; font-size: 0.875rem;">-</span>'
                }
            </td>
            <td>
                <div style="font-size: 0.875rem; font-weight: 500;">${student.accepted_at_formatted}</div>
                <div style="font-size: 0.75rem; color: #64748b;">
                    Bayar: ${student.pembayaran_accepted_formatted}
                </div>
            </td>
        </tr>
    `).join('');
}

// Render pagination
function renderPagination(pagination) {
    const container = document.getElementById('paginationContainer');
    
    if (pagination.total_pages <= 1) {
        container.innerHTML = `
            <div style="text-align: center; color: #64748b; font-size: 0.875rem;">
                Menampilkan ${pagination.total} data
            </div>
        `;
        return;
    }
    
    const startItem = ((pagination.page - 1) * pagination.per_page) + 1;
    const endItem = Math.min(pagination.page * pagination.per_page, pagination.total);
    
    let paginationHTML = `
        <div style="display: flex; justify-content: between; align-items: center;">
            <div style="color: #64748b; font-size: 0.875rem;">
                Menampilkan ${startItem} sampai ${endItem} dari ${pagination.total} data
            </div>
            <div style="display: flex; gap: 0.25rem;">
    `;
    
    // Previous button
    if (pagination.page > 1) {
        paginationHTML += `
            <button onclick="changePage(${pagination.page - 1})" 
                    class="btn btn-sm btn-secondary">
                <i class="fas fa-chevron-left"></i>
            </button>
        `;
    }
    
    // Page numbers
    for (let i = Math.max(1, pagination.page - 2); i <= Math.min(pagination.total_pages, pagination.page + 2); i++) {
        const isActive = i === pagination.page;
        paginationHTML += `
            <button onclick="changePage(${i})" 
                    class="btn btn-sm ${isActive ? 'btn-primary' : 'btn-secondary'}">
                ${i}
            </button>
        `;
    }
    
    // Next button
    if (pagination.page < pagination.total_pages) {
        paginationHTML += `
            <button onclick="changePage(${pagination.page + 1})" 
                    class="btn btn-sm btn-secondary">
                <i class="fas fa-chevron-right"></i>
            </button>
        `;
    }
    
    paginationHTML += `
            </div>
        </div>
    `;
    
    container.innerHTML = paginationHTML;
}

// Apply filters
function applyFilters() {
    currentFilters = {};
    
    const tahunAjaran = document.getElementById('filterTahunAjaran').value;
    const search = document.getElementById('searchInput').value.trim();
    
    if (tahunAjaran) currentFilters.tahun_ajaran_id = tahunAjaran;
    if (search) currentFilters.search = search;
    
    currentPage = 1; // Reset to first page
    loadStudents();
    loadSummaryStats();
}

// Reset filters
function resetFilters() {
    document.getElementById('filterTahunAjaran').value = '<?= $defaultTahunAjaran ? $defaultTahunAjaran['id'] : '' ?>';
    document.getElementById('searchInput').value = '';
    applyFilters();
}

// Handle per page change
function handlePerPageChange(e) {
    currentPerPage = parseInt(e.target.value);
    currentPage = 1;
    loadStudents();
}

// Change page
function changePage(page) {
    currentPage = page;
    loadStudents();
}

// Show loading state
function showLoading(show) {
    const loadingState = document.getElementById('loadingState');
    const tableContainer = document.getElementById('tableContainer');
    
    if (show) {
        loadingState.classList.remove('hidden');
        tableContainer.classList.add('hidden');
    } else {
        loadingState.classList.add('hidden');
        tableContainer.classList.remove('hidden');
    }
}

// Update total info
function updateTotalInfo(total) {
    document.getElementById('totalInfo').textContent = `Total: ${total} siswa`;
}

// Show error message
function showError(message) {
    alert('Error: ' + message);
}

// Escape HTML
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return String(text).replace(/[&<>"']/g, function(m) { return map[m]; });
}

// Export Excel
function exportExcel() {
    const params = new URLSearchParams(currentFilters);
    window.open(`<?= base_url('admin/rekap-siswa/export-excel') ?>?${params}`, '_blank');
}

// Export PDF
function exportPdf() {
    const params = new URLSearchParams(currentFilters);
    window.open(`<?= base_url('admin/rekap-siswa/export-pdf') ?>?${params}`, '_blank');
}

// Refresh data
function refreshData() {
    loadStudents();
    loadSummaryStats();
}
</script>

<?= $this->endsection() ?>
