/**
 * Admin Settings JavaScript
 * Handles CRUD operations for Tahun Ajaran, Kategori, and Gelombang Pendaftaran
 */

let currentTab = 'tahun-ajaran';
let isLoading = false;

// Wait for jQuery to be available
function waitForJQuery(callback) {
    if (typeof $ !== 'undefined') {
        callback();
    } else {
        setTimeout(function() {
            waitForJQuery(callback);
        }, 50);
    }
}

// Initialize when both DOM and jQuery are ready
function initializeAdminSettings() {
    // Load initial data
    loadData('tahun-ajaran');
    
    // Tab change handler
    $('#settingsTabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        const targetTab = $(e.target).attr('href').substring(1);
        currentTab = targetTab;
        loadData(targetTab);
    });
    
    // Form submissions
    $('#form-tahun-ajaran').on('submit', handleFormSubmit);
    $('#form-kategori').on('submit', handleFormSubmit);
    $('#form-gelombang').on('submit', handleFormSubmit);
    
    // Auto-generate name for tahun ajaran
    $('#tahun-mulai, #tahun-selesai').on('blur', function() {
        const tahunMulai = $('#tahun-mulai').val();
        const tahunSelesai = $('#tahun-selesai').val();
        
        if (tahunMulai && tahunSelesai && !$('#tahun-ajaran-nama').val()) {
            $('#tahun-ajaran-nama').val(`Tahun Ajaran ${tahunMulai}/${tahunSelesai}`);
        }
    });
    
    // Format currency input
    $('#kategori-spp').on('input', function() {
        let value = $(this).val().replace(/[^\d]/g, '');
        $(this).val(value);
    });
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    waitForJQuery(function() {
        $(document).ready(initializeAdminSettings);
    });
});

/**
 * Load data for specific tab
 */
function loadData(type) {
    if (isLoading) return;
    
    isLoading = true;
    showLoading(type);
    
    const endpoints = {
        'tahun-ajaran': 'getTahunAjaran',
        'kategori': 'getKategori', 
        'gelombang': 'getGelombang'
    };
    
    $.ajax({
        url: `/admin/settings/${endpoints[type]}`,
        method: 'GET',
        dataType: 'json'
    })
    .done(function(response) {
        if (response.success) {
            displayData(type, response.data);
            updateCounter(type, response.data.length);
        } else {
            showError(type, response.message || 'Gagal memuat data');
        }
    })
    .fail(function(xhr) {
        console.error('Ajax error:', xhr);
        showError(type, 'Terjadi kesalahan saat memuat data');
    })
    .always(function() {
        hideLoading(type);
        isLoading = false;
    });
}

/**
 * Display data in cards
 */
function displayData(type, data) {
    const container = $(`#${type}-container`);
    container.empty();
    
    if (data.length === 0) {
        container.html(`
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada data</h5>
                    <p class="text-muted">Klik tombol tambah untuk menambah data baru</p>
                </div>
            </div>
        `);
        container.show();
        return;
    }
    
    data.forEach(item => {
        let cardHtml = '';
        
        switch(type) {
            case 'tahun-ajaran':
                cardHtml = renderTahunAjaranCard(item);
                break;
            case 'kategori':
                cardHtml = renderKategoriCard(item);
                break;
            case 'gelombang':
                cardHtml = renderGelombangCard(item);
                break;
        }
        
        container.append(cardHtml);
    });
    
    container.show();
}

/**
 * Render Tahun Ajaran card
 */
function renderTahunAjaranCard(item) {
    const isActive = item.is_active == 1;
    const statusBadge = isActive 
        ? '<span class="badge badge-success">Aktif</span>'
        : '<span class="badge badge-secondary">Tidak Aktif</span>';
    
    const statusIcon = isActive ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-secondary';
    
    return `
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 ${isActive ? 'border-success' : ''}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6 class="card-title mb-0">${escapeHtml(item.nama)}</h6>
                        ${statusBadge}
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Periode</small>
                        <strong>${item.tahun_mulai}/${item.tahun_selesai}</strong>
                    </div>
                    
                    ${item.deskripsi ? `
                        <div class="mb-3">
                            <small class="text-muted d-block">Deskripsi</small>
                            <span class="small">${escapeHtml(item.deskripsi)}</span>
                        </div>
                    ` : ''}
                    
                    <div class="card-footer bg-transparent border-0 px-0 pb-0">
                        <div class="btn-group w-100" role="group">
                            <button type="button" class="btn btn-outline-primary btn-sm" 
                                    onclick="editItem('tahun-ajaran', '${item.id}')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-outline-${isActive ? 'warning' : 'success'} btn-sm" 
                                    onclick="toggleStatus('${item.id}', ${item.is_active})" 
                                    title="${isActive ? 'Nonaktifkan' : 'Aktifkan'}">
                                <i class="${statusIcon}"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm" 
                                    onclick="deleteItem('tahun-ajaran', '${item.id}', '${escapeHtml(item.nama)}')" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

/**
 * Render Kategori card
 */
function renderKategoriCard(item) {
    const formattedSpp = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(item.spp);
    
    return `
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-title">${escapeHtml(item.nama_kategori)}</h6>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">SPP per Bulan</small>
                        <strong class="text-success">${formattedSpp}</strong>
                    </div>
                    
                    ${item.catatan ? `
                        <div class="mb-3">
                            <small class="text-muted d-block">Catatan</small>
                            <span class="small">${escapeHtml(item.catatan)}</span>
                        </div>
                    ` : ''}
                    
                    <div class="card-footer bg-transparent border-0 px-0 pb-0">
                        <div class="btn-group w-100" role="group">
                            <button type="button" class="btn btn-outline-primary btn-sm" 
                                    onclick="editItem('kategori', '${item.id}')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm" 
                                    onclick="deleteItem('kategori', '${item.id}', '${escapeHtml(item.nama_kategori)}')" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

/**
 * Render Gelombang card
 */
function renderGelombangCard(item) {
    const startDate = new Date(item.tanggal_mulai);
    const endDate = new Date(item.tanggal_selesai);
    const today = new Date();
    
    let statusBadge = '';
    if (today < startDate) {
        statusBadge = '<span class="badge badge-warning">Belum Dimulai</span>';
    } else if (today >= startDate && today <= endDate) {
        statusBadge = '<span class="badge badge-success">Sedang Berjalan</span>';
    } else {
        statusBadge = '<span class="badge badge-secondary">Selesai</span>';
    }
    
    return `
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6 class="card-title mb-0">${escapeHtml(item.nama)}</h6>
                        ${statusBadge}
                    </div>
                    
                    <div class="mb-2">
                        <small class="text-muted d-block">Periode Pendaftaran</small>
                        <strong>${formatDate(item.tanggal_mulai)} - ${formatDate(item.tanggal_selesai)}</strong>
                    </div>
                    
                    <div class="card-footer bg-transparent border-0 px-0 pb-0">
                        <div class="btn-group w-100" role="group">
                            <button type="button" class="btn btn-outline-primary btn-sm" 
                                    onclick="editItem('gelombang', '${item.id}')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm" 
                                    onclick="deleteItem('gelombang', '${item.id}', '${escapeHtml(item.nama)}')" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

/**
 * Show create modal
 */
function showCreateModal(type) {
    const modal = $(`#modal-${type}`);
    const form = $(`#form-${type}`);
    const title = modal.find('.modal-title');
    
    // Reset form
    form[0].reset();
    $(`#${type}-id`).val('');
    
    // Update title
    const titles = {
        'tahun-ajaran': 'Tambah Tahun Ajaran',
        'kategori': 'Tambah Kategori', 
        'gelombang': 'Tambah Gelombang Pendaftaran'
    };
    
    title.text(titles[type]);
    modal.modal('show');
}

/**
 * Edit item
 */
function editItem(type, id) {
    const endpoints = {
        'tahun-ajaran': 'getTahunAjaran',
        'kategori': 'getKategori',
        'gelombang': 'getGelombang'
    };
    
    $.ajax({
        url: `/admin/settings/${endpoints[type]}`,
        method: 'GET',
        dataType: 'json'
    })
    .done(function(response) {
        if (response.success) {
            const item = response.data.find(i => i.id === id);
            if (item) {
                populateForm(type, item);
                
                const modal = $(`#modal-${type}`);
                const title = modal.find('.modal-title');
                
                const titles = {
                    'tahun-ajaran': 'Edit Tahun Ajaran',
                    'kategori': 'Edit Kategori',
                    'gelombang': 'Edit Gelombang Pendaftaran'
                };
                
                title.text(titles[type]);
                modal.modal('show');
            }
        }
    })
    .fail(function(xhr) {
        showAlert('error', 'Gagal mengambil data untuk diedit');
    });
}

/**
 * Populate form with item data
 */
function populateForm(type, item) {
    $(`#${type}-id`).val(item.id);
    
    switch(type) {
        case 'tahun-ajaran':
            $('#tahun-ajaran-nama').val(item.nama);
            $('#tahun-mulai').val(item.tahun_mulai);
            $('#tahun-selesai').val(item.tahun_selesai);
            $('#tahun-ajaran-deskripsi').val(item.deskripsi || '');
            break;
            
        case 'kategori':
            $('#kategori-nama').val(item.nama_kategori);
            $('#kategori-spp').val(item.spp);
            $('#kategori-catatan').val(item.catatan || '');
            break;
            
        case 'gelombang':
            $('#gelombang-nama').val(item.nama);
            $('#gelombang-tanggal-mulai').val(item.tanggal_mulai);
            $('#gelombang-tanggal-selesai').val(item.tanggal_selesai);
            break;
    }
}

/**
 * Handle form submission
 */
function handleFormSubmit(e) {
    e.preventDefault();
    
    const form = $(this);
    const formId = form.attr('id');
    const type = formId.replace('form-', '');
    const id = $(`#${type}-id`).val();
    const isEdit = id !== '';
    
    const endpoints = {
        'tahun-ajaran': isEdit ? `updateTahunAjaran/${id}` : 'storeTahunAjaran',
        'kategori': isEdit ? `updateKategori/${id}` : 'storeKategori',
        'gelombang': isEdit ? `updateGelombang/${id}` : 'storeGelombang'
    };
    
    let data = {};
    
    switch(type) {
        case 'tahun-ajaran':
            data = {
                nama: $('#tahun-ajaran-nama').val(),
                tahun_mulai: parseInt($('#tahun-mulai').val()),
                tahun_selesai: parseInt($('#tahun-selesai').val()),
                deskripsi: $('#tahun-ajaran-deskripsi').val()
            };
            break;
            
        case 'kategori':
            data = {
                nama_kategori: $('#kategori-nama').val(),
                spp: parseInt($('#kategori-spp').val()),
                catatan: $('#kategori-catatan').val()
            };
            break;
            
        case 'gelombang':
            data = {
                nama: $('#gelombang-nama').val(),
                tanggal_mulai: $('#gelombang-tanggal-mulai').val(),
                tanggal_selesai: $('#gelombang-tanggal-selesai').val()
            };
            break;
    }
    
    // Disable submit button
    const submitBtn = $(`#btn-save-${type}`);
    const originalText = submitBtn.html();
    submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...');
    
    $.ajax({
        url: `/admin/settings/${endpoints[type]}`,
        method: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(data)
    })
    .done(function(response) {
        if (response.success) {
            showAlert('success', response.message);
            $(`#modal-${type}`).modal('hide');
            loadData(type);
        } else {
            showAlert('error', response.message);
        }
    })
    .fail(function(xhr) {
        console.error('Submit error:', xhr);
        showAlert('error', 'Terjadi kesalahan saat menyimpan data');
    })
    .always(function() {
        submitBtn.prop('disabled', false).html(originalText);
    });
}

/**
 * Toggle tahun ajaran status
 */
function toggleStatus(id, currentStatus) {
    const newStatus = currentStatus == 1 ? 0 : 1;
    const action = newStatus == 1 ? 'mengaktifkan' : 'menonaktifkan';
    
    if (!confirm(`Yakin ingin ${action} tahun ajaran ini?`)) {
        return;
    }
    
    $.ajax({
        url: `/admin/settings/activateTahunAjaran/${id}`,
        method: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify({ is_active: newStatus })
    })
    .done(function(response) {
        if (response.success) {
            showAlert('success', response.message);
            loadData('tahun-ajaran');
        } else {
            showAlert('error', response.message);
        }
    })
    .fail(function(xhr) {
        showAlert('error', 'Terjadi kesalahan saat mengubah status');
    });
}

/**
 * Delete item
 */
function deleteItem(type, id, name) {
    if (!confirm(`Yakin ingin menghapus "${name}"?\n\nData yang dihapus tidak dapat dikembalikan.`)) {
        return;
    }
    
    const endpoints = {
        'tahun-ajaran': `deleteTahunAjaran/${id}`,
        'kategori': `deleteKategori/${id}`,
        'gelombang': `deleteGelombang/${id}`
    };
    
    $.ajax({
        url: `/admin/settings/${endpoints[type]}`,
        method: 'DELETE',
        dataType: 'json'
    })
    .done(function(response) {
        if (response.success) {
            showAlert('success', response.message);
            loadData(type);
        } else {
            showAlert('error', response.message);
        }
    })
    .fail(function(xhr) {
        showAlert('error', 'Terjadi kesalahan saat menghapus data');
    });
}

/**
 * Utility functions
 */
function showLoading(type) {
    $(`#${type}-loading`).show();
    $(`#${type}-container`).hide();
}

function hideLoading(type) {
    $(`#${type}-loading`).hide();
}

function updateCounter(type, count) {
    const labels = {
        'tahun-ajaran': 'tahun ajaran',
        'kategori': 'kategori',
        'gelombang': 'gelombang pendaftaran'
    };
    
    $(`#${type}-count`).text(`Total: ${count} ${labels[type]}`);
}

function showError(type, message) {
    $(`#${type}-container`).html(`
        <div class="col-12">
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                ${message}
                <button type="button" class="btn btn-sm btn-outline-danger ml-3" onclick="loadData('${type}')">
                    <i class="fas fa-redo mr-1"></i>Coba Lagi
                </button>
            </div>
        </div>
    `).show();
}

function showAlert(type, message) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
    
    const alert = $(`
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <i class="fas ${icon} mr-2"></i>
            ${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
    
    $('#alertContainer').html(alert);
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        alert.fadeOut();
    }, 5000);
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long', 
        year: 'numeric'
    });
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
