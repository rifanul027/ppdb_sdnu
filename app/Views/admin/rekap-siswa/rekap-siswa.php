<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<?= $this->endsection() ?>

<?= $this->section('content') ?>

<div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4 mb-6">
    <div class="flex-1">
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 mb-2"><?= $pageTitle ?></h2>
        <p class="text-sm sm:text-base text-gray-600">Rekap data siswa yang sudah diterima dan pembayaran lunas</p>
    </div>
    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 w-full lg:w-auto">
        <button class="btn btn-secondary flex items-center justify-center gap-2 w-full sm:w-auto text-sm" onclick="exportPdf()">
            <i class="fas fa-file-pdf"></i>
            <span>Export PDF</span>
        </button>
        <button class="btn btn-success flex items-center justify-center gap-2 w-full sm:w-auto text-sm" onclick="exportExcel()">
            <i class="fas fa-file-excel"></i>
            <span>Export Excel</span>
        </button>
        <button class="btn btn-primary flex items-center justify-center gap-2 w-full sm:w-auto text-sm" onclick="refreshData()">
            <i class="fas fa-sync"></i>
            <span>Refresh</span>
        </button>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 mb-6" id="statsContainer">
    <div class="content-card">
        <div class="card-body text-center p-4">
            <div class="text-2xl sm:text-3xl font-bold text-green-600 mb-2" id="totalSiswa">0</div>
            <div class="text-gray-500 text-xs sm:text-sm">Total Siswa</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body text-center p-4">
            <div class="text-2xl sm:text-3xl font-bold text-blue-600 mb-2" id="lakiLaki">0</div>
            <div class="text-gray-500 text-xs sm:text-sm">Laki-laki</div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-body text-center p-4">
            <div class="text-2xl sm:text-3xl font-bold text-pink-600 mb-2" id="perempuan">0</div>
            <div class="text-gray-500 text-xs sm:text-sm">Perempuan</div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="content-card mb-6">
    <div class="card-body p-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
                <select id="filterTahunAjaran" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
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
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>
            
            <div class="flex flex-col sm:flex-row gap-2 lg:items-end lg:justify-start">
                <button onclick="applyFilters()" class="btn btn-primary flex items-center justify-center gap-2 w-full sm:w-auto text-sm">
                    <i class="fas fa-search"></i>
                    <span>Filter</span>
                </button>
                <button onclick="resetFilters()" class="btn btn-secondary flex items-center justify-center gap-2 w-full sm:w-auto text-sm">
                    <i class="fas fa-times"></i>
                    <span>Reset</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="content-card">
    <div class="card-header flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 p-4">
        <h3 class="card-title text-lg font-semibold">Data Rekap Siswa</h3>
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

        <!-- Desktop Table -->
        <div class="hidden md:block overflow-x-auto" id="tableContainer">
            <table class="w-full bg-white" id="rekapSiswaTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TTL</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orang Tua</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                    <!-- Data will be loaded here via AJAX -->
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="md:hidden" id="mobileContainer">
            <div id="mobileCards" class="p-4 space-y-4">
                <!-- Mobile cards will be loaded here via AJAX -->
            </div>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="card-footer px-4 py-3 bg-gray-50 border-t border-gray-200" id="paginationContainer">
        <!-- Pagination will be loaded here -->
    </div>
</div>

<!-- Modal Kategori -->
<div id="kategoriModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full max-h-96 overflow-y-auto">
        <div class="p-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Pilih Kategori</h3>
                <button onclick="closeKategoriModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="p-4">
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Siswa: <span id="modalStudentName" class="font-semibold"></span></p>
                <p class="text-sm text-gray-500">Kategori saat ini: <span id="modalCurrentKategori" class="font-medium"></span></p>
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Pilih Kategori Baru</label>
                <select id="kategoriSelect" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategori as $kat): ?>
                        <option value="<?= $kat['id'] ?>"><?= $kat['nama_kategori'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="p-4 border-t border-gray-200 flex gap-2 justify-end">
            <button onclick="closeKategoriModal()" class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                Batal
            </button>
            <button onclick="updateKategori()" class="px-4 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700">
                Update
            </button>
        </div>
    </div>
</div>

<script>
let currentPage = 1;
let currentPerPage = 10;
let currentFilters = {};
let currentStudentId = null;

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
            renderMobileCards(result.data);
            renderPagination(result.pagination);
            updateTotalInfo(result.pagination.total);
        } else {
            showError(result.message || 'Gagal memuat data');
            renderTable([]);
            renderMobileCards([]);
            renderPagination({ page: 1, total_pages: 1, total: 0, per_page: currentPerPage });
            updateTotalInfo(0);
        }
    } catch (error) {
        showError('Terjadi kesalahan saat memuat data');
        console.error('Error loading students:', error);
        renderTable([]);
        renderMobileCards([]);
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

// Render desktop table
function renderTable(students) {
    const tbody = document.getElementById('tableBody');
    
    if (students.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" class="px-4 py-12 text-center text-gray-500">
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
            <td class="px-4 py-3 text-sm font-semibold text-gray-600">${startNumber + index + 1}</td>
            <td class="px-4 py-3">
                <div class="font-semibold text-gray-900">${escapeHtml(student.nama_lengkap)}</div>
                <div class="text-xs text-gray-500">NISN: ${escapeHtml(student.nisn || '-')}</div>
            </td>
            <td class="px-4 py-3">
                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                    ${escapeHtml(student.kategori_nama || 'Belum Ditentukan')}
                </span>
            </td>
            <td class="px-4 py-3">
                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${student.jenis_kelamin === 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800'}">
                    ${student.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}
                </span>
            </td>
            <td class="px-4 py-3">
                <div class="text-sm font-medium text-gray-900">${escapeHtml(student.tempat_lahir)}</div>
                <div class="text-xs text-gray-500">${student.tanggal_lahir_formatted}</div>
            </td>
            <td class="px-4 py-3">
                <div class="text-sm font-medium text-gray-900">${escapeHtml(student.nama_ayah)}</div>
                <div class="text-xs text-gray-500">${escapeHtml(student.nama_ibu)}</div>
            </td>
            <td class="px-4 py-3">
                <button onclick="openKategoriModal(${student.id}, '${escapeHtml(student.nama_lengkap)}', '${escapeHtml(student.kategori_nama || 'Belum Ditentukan')}', ${student.kategori_id || 'null'})" 
                        class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 transition-colors">
                    <i class="fas fa-edit mr-1"></i>
                    Kategori
                </button>
            </td>
        </tr>
    `).join('');
}

// Render mobile cards
function renderMobileCards(students) {
    const container = document.getElementById('mobileCards');
    
    if (students.length === 0) {
        container.innerHTML = `
            <div class="text-center text-gray-500 py-12">
                <i class="fas fa-users text-5xl mb-4 opacity-50"></i>
                <div class="text-lg font-medium">Tidak ada data siswa yang ditemukan</div>
                <div class="text-sm mt-2 text-gray-400">
                    Coba ubah filter atau kriteria pencarian
                </div>
            </div>
        `;
        return;
    }
    
    const startNumber = (currentPage - 1) * currentPerPage;
    
    container.innerHTML = students.map((student, index) => `
        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
            <div class="flex items-start justify-between mb-3">
                <div class="flex-1">
                    <div class="font-semibold text-gray-900 text-lg">${startNumber + index + 1}. ${escapeHtml(student.nama_lengkap)}</div>
                    <div class="text-xs text-gray-500 mt-1">NISN: ${escapeHtml(student.nisn || '-')}</div>
                </div>
                <button onclick="openKategoriModal(${student.id}, '${escapeHtml(student.nama_lengkap)}', '${escapeHtml(student.kategori_nama || 'Belum Ditentukan')}', ${student.kategori_id || 'null'})" 
                        class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 transition-colors">
                    <i class="fas fa-edit mr-1"></i>
                    Kategori
                </button>
            </div>
            
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div>
                    <span class="text-gray-500">Kategori:</span>
                    <div class="mt-1">
                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                            ${escapeHtml(student.kategori_nama || 'Belum Ditentukan')}
                        </span>
                    </div>
                </div>
                <div>
                    <span class="text-gray-500">Gender:</span>
                    <div class="mt-1">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${student.jenis_kelamin === 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800'}">
                            ${student.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}
                        </span>
                    </div>
                </div>
                <div>
                    <span class="text-gray-500">TTL:</span>
                    <div class="font-medium text-gray-900">${escapeHtml(student.tempat_lahir)}, ${student.tanggal_lahir_formatted}</div>
                </div>
                <div>
                    <span class="text-gray-500">Orang Tua:</span>
                    <div class="font-medium text-gray-900">${escapeHtml(student.nama_ayah)}</div>
                    <div class="text-xs text-gray-500">${escapeHtml(student.nama_ibu)}</div>
                </div>
            </div>
        </div>
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

// Modal functions
function openKategoriModal(studentId, studentName, currentKategori, currentKategoriId) {
    currentStudentId = studentId;
    document.getElementById('modalStudentName').textContent = studentName;
    document.getElementById('modalCurrentKategori').textContent = currentKategori;
    document.getElementById('kategoriSelect').value = currentKategoriId || '';
    document.getElementById('kategoriModal').classList.remove('hidden');
}

function closeKategoriModal() {
    document.getElementById('kategoriModal').classList.add('hidden');
    currentStudentId = null;
}

async function updateKategori() {
    if (!currentStudentId) return;
    
    const kategoriId = document.getElementById('kategoriSelect').value;
    
    if (!kategoriId) {
        alert('Silakan pilih kategori terlebih dahulu');
        return;
    }
    
    try {
        const response = await fetch(`<?= base_url('admin/rekap-siswa/update-kategori') ?>`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                student_id: currentStudentId,
                kategori_id: kategoriId
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Kategori berhasil diupdate');
            closeKategoriModal();
            loadStudents();
            loadSummaryStats();
        } else {
            alert('Gagal update kategori: ' + result.message);
        }
    } catch (error) {
        alert('Terjadi kesalahan saat update kategori');
        console.error('Error updating kategori:', error);
    }
}

// Apply filters
function applyFilters() {
    currentFilters = {};
    
    const tahunAjaran = document.getElementById('filterTahunAjaran').value;
    const search = document.getElementById('searchInput').value.trim();
    
    if (tahunAjaran) currentFilters.tahun_ajaran_id = tahunAjaran;
    if (search) currentFilters.search = search;
    
    currentPage = 1;
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
    const mobileContainer = document.getElementById('mobileContainer');
    
    if (show) {
        loadingState.classList.remove('hidden');
        tableContainer.classList.add('hidden');
        mobileContainer.classList.add('hidden');
    } else {
        loadingState.classList.add('hidden');
        tableContainer.classList.remove('hidden');
        mobileContainer.classList.remove('hidden');
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
    if (text === null || text === undefined) return '';
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

// Close modal when clicking outside
document.getElementById('kategoriModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeKategoriModal();
    }
});
</script>

<?= $this->endsection() ?>