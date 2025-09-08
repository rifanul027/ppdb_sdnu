<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Include Tailwind CSS dan Preline -->
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/preline@2.0.3/dist/preline.min.js"></script>

<div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Rekap Siswa</h1>
            <p class="text-gray-600 mt-1">Kelola dan pantau data siswa yang terdaftar</p>
        </div>
        <div class="flex gap-3">
            <button onclick="exportPdf()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 2H7a2 2 0 00-2 2v15a2 2 0 002 2z"></path>
                </svg>
                Export PDF
            </button>
            <button onclick="exportExcel()" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export Excel
            </button>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Filter Data</h3>
        </div>
        <div class="p-6">
            <form id="filterForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajaran</label>
                    <select name="tahun_ajaran" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Tahun Ajaran</option>
                        <option value="2024/2025">2024/2025</option>
                        <option value="2025/2026">2025/2026</option>
                        <option value="2026/2027">2026/2027</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="calon">Calon Siswa</option>
                        <option value="siswa">Siswa</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dari</label>
                    <input type="date" name="tanggal_dari" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Sampai</label>
                    <input type="date" name="tanggal_sampai" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div class="md:col-span-2 lg:col-span-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari nama, no registrasi, atau nama orang tua..." 
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 pl-10">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="md:col-span-2 lg:col-span-4 flex gap-3">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter
                    </button>
                    <button type="button" onclick="resetFilter()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Data Siswa</h3>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-600">Showing</span>
                    <select id="perPageSelect" class="rounded border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="text-sm text-gray-600">entries</span>
                </div>
            </div>
        </div>
        
        <!-- Loading State -->
        <div id="loadingState" class="p-8 text-center hidden">
            <div class="inline-flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-gray-600">Memuat data...</span>
            </div>
        </div>

        <!-- Table Container -->
        <div id="tableContainer" class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Registrasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tempat, Tanggal Lahir</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orang Tua</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                    <!-- Data will be loaded here via AJAX -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div id="paginationContainer" class="px-6 py-4 border-t border-gray-200">
            <!-- Pagination will be loaded here -->
        </div>
    </div>
</div>

<!-- Edit Status Modal -->
<div id="editStatusModal" class="hs-overlay hidden w-full h-full fixed top-0 left-0 z-[60] overflow-x-hidden overflow-y-auto">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="p-4 overflow-y-auto">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="font-bold text-gray-800">Edit Status Siswa</h3>
                    <button type="button" class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-sm" data-hs-overlay="#editStatusModal">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="m2.5 1.5 3 3m0-3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
                <form id="editStatusForm">
                    <input type="hidden" id="editStudentId" name="student_id">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="editStatus" name="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="calon">Calon Siswa</option>
                            <option value="siswa">Siswa</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm" data-hs-overlay="#editStatusModal">
                            Batal
                        </button>
                        <button type="submit" class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let currentPage = 1;
let currentPerPage = 10;
let currentFilters = {};

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    loadStudents();
    
    // Setup event listeners
    document.getElementById('filterForm').addEventListener('submit', handleFilter);
    document.getElementById('perPageSelect').addEventListener('change', handlePerPageChange);
    document.getElementById('editStatusForm').addEventListener('submit', handleEditStatus);
});

// Load students data
async function loadStudents() {
    showLoading(true);
    
    try {
        const params = new URLSearchParams({
            page: currentPage,
            per_page: currentPerPage,
            ...currentFilters
        });
        
        const response = await fetch(`/admin/students-data?${params}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            renderTable(result.data);
            renderPagination(result.pagination);
        } else {
            showError(result.message || 'Gagal memuat data');
        }
    } catch (error) {
        showError('Terjadi kesalahan saat memuat data');
        console.error('Error loading students:', error);
    } finally {
        showLoading(false);
    }
}

// Render table
function renderTable(students) {
    const tbody = document.getElementById('tableBody');
    
    if (students.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                    <div class="flex flex-col items-center">
                        <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-lg font-medium">Tidak ada data siswa</p>
                        <p class="text-sm">Coba ubah filter atau tambah data siswa baru</p>
                    </div>
                </td>
            </tr>
        `;
        return;
    }
    
    const startNumber = (currentPage - 1) * currentPerPage;
    
    tbody.innerHTML = students.map((student, index) => `
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${startNumber + index + 1}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="text-sm font-medium text-green-600 font-mono">${student.no_registrasi}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">${student.nama_lengkap}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${student.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">${student.tempat_lahir}</div>
                <div class="text-sm text-gray-500">${student.tanggal_lahir_formatted}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">${student.nama_ayah}</div>
                <div class="text-sm text-gray-500">${student.nama_ibu}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                ${getStatusBadge(student.status)}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <div class="flex gap-2">
                    <button onclick="editStatus('${student.id}', '${student.status}')" 
                            class="text-blue-600 hover:text-blue-900" title="Edit Status">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button onclick="deleteStudent('${student.id}', '${student.nama_lengkap}')" 
                            class="text-red-600 hover:text-red-900" title="Hapus">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
}

// Get status badge HTML
function getStatusBadge(status) {
    const badges = {
        'calon': 'bg-yellow-100 text-yellow-800',
        'siswa': 'bg-green-100 text-green-800'
    };
    
    const className = badges[status] || 'bg-gray-100 text-gray-800';
    const statusText = status === 'calon' ? 'Calon Siswa' : 'Siswa';
    
    return `<span class="inline-flex px-2 py-1 text-xs font-medium rounded-full ${className}">
        ${statusText}
    </span>`;
}

// Render pagination
function renderPagination(pagination) {
    const container = document.getElementById('paginationContainer');
    
    if (pagination.total_pages <= 1) {
        container.innerHTML = `
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Menampilkan ${pagination.total} data
                </div>
            </div>
        `;
        return;
    }
    
    const startItem = ((pagination.page - 1) * pagination.per_page) + 1;
    const endItem = Math.min(pagination.page * pagination.per_page, pagination.total);
    
    let paginationHTML = `
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Menampilkan ${startItem} sampai ${endItem} dari ${pagination.total} data
            </div>
            <div class="flex gap-1">
    `;
    
    // Previous button
    if (pagination.page > 1) {
        paginationHTML += `
            <button onclick="changePage(${pagination.page - 1})" 
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">
                Previous
            </button>
        `;
    }
    
    // Page numbers
    for (let i = Math.max(1, pagination.page - 2); i <= Math.min(pagination.total_pages, pagination.page + 2); i++) {
        const isActive = i === pagination.page;
        paginationHTML += `
            <button onclick="changePage(${i})" 
                    class="px-3 py-2 text-sm font-medium ${isActive ? 'text-blue-600 bg-blue-50 border-blue-500' : 'text-gray-500 bg-white border-gray-300'} border hover:bg-gray-50">
                ${i}
            </button>
        `;
    }
    
    // Next button
    if (pagination.page < pagination.total_pages) {
        paginationHTML += `
            <button onclick="changePage(${pagination.page + 1})" 
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">
                Next
            </button>
        `;
    }
    
    paginationHTML += `
            </div>
        </div>
    `;
    
    container.innerHTML = paginationHTML;
}

// Handle filter form
function handleFilter(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    currentFilters = {};
    
    for (let [key, value] of formData.entries()) {
        if (value.trim()) {
            currentFilters[key] = value.trim();
        }
    }
    
    currentPage = 1; // Reset to first page
    loadStudents();
}

// Reset filter
function resetFilter() {
    document.getElementById('filterForm').reset();
    currentFilters = {};
    currentPage = 1;
    loadStudents();
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
        tableContainer.classList.add('opacity-50');
    } else {
        loadingState.classList.add('hidden');
        tableContainer.classList.remove('opacity-50');
    }
}

// Show error message
function showError(message) {
    // Simple alert for now - you can implement a better notification system
    alert('Error: ' + message);
}

// Edit status
function editStatus(studentId, currentStatus) {
    document.getElementById('editStudentId').value = studentId;
    document.getElementById('editStatus').value = currentStatus;
    
    // Open modal using Preline
    HSOverlay.open(document.getElementById('editStatusModal'));
}

// Handle edit status form
async function handleEditStatus(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const studentId = formData.get('student_id');
    
    try {
        const response = await fetch(`/admin/student/${studentId}/status`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                status: formData.get('status')
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            // Close modal
            HSOverlay.close(document.getElementById('editStatusModal'));
            
            // Reload data
            loadStudents();
            
            // Show success message
            alert('Status berhasil diupdate');
        } else {
            showError(result.message || 'Gagal mengupdate status');
        }
    } catch (error) {
        showError('Terjadi kesalahan saat mengupdate status');
        console.error('Error updating status:', error);
    }
}

// Delete student
async function deleteStudent(studentId, studentName) {
    if (!confirm(`Apakah Anda yakin ingin menghapus data siswa "${studentName}"?`)) {
        return;
    }
    
    try {
        const response = await fetch(`/admin/student/${studentId}/delete`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            // Reload data
            loadStudents();
            
            // Show success message
            alert('Data siswa berhasil dihapus');
        } else {
            showError(result.message || 'Gagal menghapus data siswa');
        }
    } catch (error) {
        showError('Terjadi kesalahan saat menghapus data');
        console.error('Error deleting student:', error);
    }
}

// Export Excel
function exportExcel() {
    const params = new URLSearchParams(currentFilters);
    window.open(`/admin/export-excel?${params}`, '_blank');
}

// Export PDF
function exportPdf() {
    const params = new URLSearchParams(currentFilters);
    window.open(`/admin/export-pdf?${params}`, '_blank');
}
</script>

<?= $this->endSection() ?>
