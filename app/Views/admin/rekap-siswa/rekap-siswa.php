<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
    /* Table scroll styling */
    #tableContainer {
        scrollbar-width: auto;
        scrollbar-color: #9ca3af #f3f4f6;
    }
    
    #tableContainer::-webkit-scrollbar {
        height: 12px;
        background-color: #f3f4f6;
    }
    
    #tableContainer::-webkit-scrollbar-thumb {
        background-color: #9ca3af;
        border-radius: 6px;
        border: 2px solid #f3f4f6;
    }
    
    #tableContainer::-webkit-scrollbar-thumb:hover {
        background-color: #6b7280;
    }
    
    #tableContainer::-webkit-scrollbar-track {
        background-color: #f3f4f6;
        border-radius: 6px;
    }
    
    /* Force table to maintain minimum width */
    #rekapSiswaTable {
        border-collapse: collapse;
        white-space: nowrap;
    }
    
    #rekapSiswaTable th,
    #rekapSiswaTable td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        #tableContainer {
            border-radius: 0;
        }
        
        #rekapSiswaTable th,
        #rekapSiswaTable td {
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
        }
    }
    
    @media (max-width: 480px) {
        #rekapSiswaTable th,
        #rekapSiswaTable td {
            padding: 0.375rem 0.5rem;
            font-size: 0.7rem;
        }
    }
</style>
<?= $this->endsection() ?>

<?= $this->section('content') ?>

<div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4 mb-6">
    <div class="flex-1">
        <h2 class="text-2xl font-semibold text-gray-900 mb-2"><?= $pageTitle ?></h2>
        <p class="text-gray-600">Rekap data siswa yang sudah diterima dan pembayaran lunas</p>
    </div>
    <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
        <button class="btn btn-secondary flex items-center justify-center gap-2 w-full sm:w-auto" onclick="exportPdf()">
            <i class="fas fa-file-pdf"></i>
            <span>Export PDF</span>
        </button>
        <button class="btn btn-success flex items-center justify-center gap-2 w-full sm:w-auto" onclick="exportExcel()">
            <i class="fas fa-file-excel"></i>
            <span>Export Excel</span>
        </button>
        <button class="btn btn-primary flex items-center justify-center gap-2 w-full sm:w-auto" onclick="refreshData()">
            <i class="fas fa-sync"></i>
            <span>Refresh</span>
        </button>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6" id="statsContainer">
    <div class="content-card">
        <div class="card-body text-center">
            <div class="text-3xl font-bold text-green-600 mb-2" id="totalSiswa">0</div>
            <div class="text-gray-500 text-sm">Total Siswa</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body text-center">
            <div class="text-3xl font-bold text-green-600 mb-2" id="lakiLaki">0</div>
            <div class="text-gray-500 text-sm">Laki-laki</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body text-center">
            <div class="text-3xl font-bold text-pink-600 mb-2" id="perempuan">0</div>
            <div class="text-gray-500 text-sm">Perempuan</div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="content-card mb-6">
    <div class="card-body">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
                <select id="filterTahunAjaran" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Tahun Ajaran</option>
                    <?php foreach ($tahunAjaran as $tahun): ?>
                        <option value="<?= $tahun['id'] ?>" 
                                <?= ($defaultTahunAjaran && $defaultTahunAjaran['id'] === $tahun['id']) ? 'selected' : '' ?>>
                            <?= $tahun['nama'] ?> 
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Pencarian</label>
                <input type="text" 
                       id="searchInput" 
                       placeholder="Cari nama siswa, NISN, atau nama orang tua..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>
            
            <div class="flex flex-col sm:flex-row gap-2 lg:items-end lg:justify-start">
                <button onclick="applyFilters()" class="btn btn-primary flex items-center justify-center gap-2 w-full sm:w-auto">
                    <i class="fas fa-search"></i>
                    <span>Filter</span>
                </button>
                <button onclick="resetFilters()" class="btn btn-secondary flex items-center justify-center gap-2 w-full sm:w-auto">
                    <i class="fas fa-times"></i>
                    <span>Reset</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="content-card">
    <div class="card-header flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <h3 class="card-title">Data Rekap Siswa</h3>
        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            <div class="text-gray-500 text-sm" id="totalInfo">Total: 0 siswa</div>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500">Per halaman:</span>
                <select id="perPageSelect" class="px-2 py-1 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="card-body p-0">
        <!-- Loading State -->
        <div id="loadingState" class="hidden py-12 text-center text-gray-500">
            <i class="fas fa-spinner fa-spin text-3xl mb-4"></i>
            <div>Memuat data...</div>
        </div>

        <!-- Table Wrapper with Scroll -->
        <div class="w-full overflow-x-scroll overflow-y-visible border-b border-gray-200" 
             id="tableContainer" 
             style="max-width: 100%; -webkit-overflow-scrolling: touch;">
            <div style="min-width: 1200px; width: 100%;">
                <table class="w-full bg-white" id="rekapSiswaTable">
                    <thead class="bg-gray-50 sticky top-0">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="min-width: 60px;">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="min-width: 140px;">No. Registrasi</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="min-width: 120px;">NISN</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="min-width: 180px;">Nama Lengkap</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="min-width: 120px;">Jenis Kelamin</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="min-width: 180px;">Tempat, Tanggal Lahir</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="min-width: 160px;">Orang Tua</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="min-width: 140px;">Tahun Ajaran</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="min-width: 140px;">Tgl Diterima</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                        <!-- Data will be loaded here via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="card-footer px-4 py-3 bg-gray-50 border-t border-gray-200" id="paginationContainer">
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
}

// Render table
function renderTable(students) {
    const tbody = document.getElementById('tableBody');
    
    if (students.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="9" class="px-4 py-12 text-center text-gray-500">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-users text-5xl mb-4 opacity-50"></i>
                        <div class="text-lg font-medium">Tidak ada data siswa yang ditemukan</div>
                        <div class="text-sm mt-2 text-gray-400">
                            Coba ubah filter atau kriteria pencarian
                        </div>
                    </div>
                </td>
            </tr>
        `;
        return;
    }
    
    const startNumber = (currentPage - 1) * currentPerPage;
    
    tbody.innerHTML = students.map((student, index) => `
        <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-4 py-3 text-sm font-semibold text-gray-600" style="min-width: 60px;">${startNumber + index + 1}</td>
            <td class="px-4 py-3" style="min-width: 140px;">
                <span class="font-mono font-semibold text-green-600 text-sm">
                    ${escapeHtml(student.no_registrasi)}
                </span>
            </td>
            <td class="px-4 py-3" style="min-width: 120px;">
                <span class="font-mono font-semibold text-green-600 text-sm">
                    ${escapeHtml(student.nisn || '-')}
                </span>
            </td>
            <td class="px-4 py-3" style="min-width: 180px;">
                <div class="font-semibold text-gray-900" title="${escapeHtml(student.nama_lengkap)}">${escapeHtml(student.nama_lengkap)}</div>
            </td>
            <td class="px-4 py-3" style="min-width: 120px;">
                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${student.jenis_kelamin === 'L' ? 'bg-green-100 text-green-800' : 'bg-pink-100 text-pink-800'}">
                    ${student.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}
                </span>
            </td>
            <td class="px-4 py-3" style="min-width: 180px;">
                <div class="text-sm font-medium text-gray-900" title="${escapeHtml(student.tempat_lahir)}">${escapeHtml(student.tempat_lahir)}</div>
                <div class="text-xs text-gray-500">${student.tanggal_lahir_formatted}</div>
            </td>
            <td class="px-4 py-3" style="min-width: 160px;">
                <div class="text-sm font-medium text-gray-900" title="${escapeHtml(student.nama_ayah)}">${escapeHtml(student.nama_ayah)}</div>
                <div class="text-xs text-gray-500" title="${escapeHtml(student.nama_ibu)}">${escapeHtml(student.nama_ibu)}</div>
            </td>
            <td class="px-4 py-3" style="min-width: 140px;">
                <div class="text-sm font-medium text-gray-900" title="${escapeHtml(student.tahun_ajaran_nama || '-')}">${escapeHtml(student.tahun_ajaran_nama || '-')}</div>
                <div class="text-xs text-gray-500">${student.tahun_mulai}/${student.tahun_selesai}</div>
            </td>
            <td class="px-4 py-3" style="min-width: 140px;">
                <div class="text-sm font-medium text-gray-900">${student.accepted_at_formatted}</div>
                <div class="text-xs text-gray-500">Bayar: ${student.pembayaran_accepted_formatted}</div>
            </td>
        </tr>
    `).join('');
}

// Render pagination
function renderPagination(pagination) {
    const container = document.getElementById('paginationContainer');
    
    if (pagination.total_pages <= 1) {
        container.innerHTML = `
            <div class="text-center text-gray-500 text-sm">
                Menampilkan ${pagination.total} data
            </div>
        `;
        return;
    }
    
    const startItem = ((pagination.page - 1) * pagination.per_page) + 1;
    const endItem = Math.min(pagination.page * pagination.per_page, pagination.total);
    
    let paginationHTML = `
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div class="text-gray-500 text-sm text-center sm:text-left">
                Menampilkan ${startItem} sampai ${endItem} dari ${pagination.total} data
            </div>
            <div class="flex justify-center flex-wrap gap-1">
    `;
    
    // Previous button
    if (pagination.page > 1) {
        paginationHTML += `
            <button onclick="changePage(${pagination.page - 1})" 
                    class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition-colors">
                <i class="fas fa-chevron-left"></i>
            </button>
        `;
    }
    
    // Page numbers
    for (let i = Math.max(1, pagination.page - 2); i <= Math.min(pagination.total_pages, pagination.page + 2); i++) {
        const isActive = i === pagination.page;
        paginationHTML += `
            <button onclick="changePage(${i})" 
                    class="px-3 py-1 text-sm rounded transition-colors ${isActive ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'}">
                ${i}
            </button>
        `;
    }
    
    // Next button
    if (pagination.page < pagination.total_pages) {
        paginationHTML += `
            <button onclick="changePage(${pagination.page + 1})" 
                    class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition-colors">
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
