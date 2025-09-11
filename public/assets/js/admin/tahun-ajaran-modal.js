/**
 * Tahun Ajaran Modal Handler - Reusable Component
 * 
 * @param {Object} config - Configuration object
 * @param {string} config.modalId - ID of the modal
 * @param {string} config.formId - ID of the form
 * @param {string} config.tableId - ID of the table to refresh
 * @param {string} config.dataUrl - URL to get/post data
 * @param {string} config.deleteModalId - ID of delete modal
 * @param {Object} config.fields - Object containing field IDs
 */
class TahunAjaranModal {
    constructor(config) {
        this.config = {
            modalId: 'modalTahunAjaran',
            formId: 'formTahunAjaran',
            tableDataId: 'tahunAjaranData',
            dataUrl: '/admin/api/settings/tahun-ajaran',
            deleteModalId: 'modalDeleteTahunAjaran',
            confirmDeleteBtnId: 'btnConfirmDelete',
            fields: {
                id: 'tahunAjaranId',
                nama: 'nama',
                tahun_mulai: 'tahun_mulai',
                tahun_selesai: 'tahun_selesai',
                tanggal_mulai_pendaftaran: 'tanggal_mulai_pendaftaran',
                tanggal_selesai_pendaftaran: 'tanggal_selesai_pendaftaran',
                kuota_maksimal: 'kuota_maksimal',
                deskripsi: 'deskripsi'
            },
            ...config
        };
        
        this.deleteId = '';
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.loadData();
    }
    
    bindEvents() {
        // Form submit event
        $(`#${this.config.formId}`).on('submit', (e) => {
            e.preventDefault();
            this.submitForm();
        });
        
        // Delete confirmation event
        $(`#${this.config.confirmDeleteBtnId}`).on('click', () => {
            this.confirmDelete();
        });
    }
    
    loadData() {
        $(`#${this.config.tableDataId}`).html(`
            <tr>
                <td colspan="5" class="text-center">
                    <i class="fas fa-spinner fa-spin"></i> Loading...
                </td>
            </tr>
        `);
        
        $.get(this.config.dataUrl)
            .done((response) => {
                if (response.success) {
                    this.displayData(response.data);
                } else {
                    this.showToast('error', 'Gagal memuat data', response.message);
                }
            })
            .fail((xhr) => {
                this.showToast('error', 'Error', 'Gagal memuat data tahun ajaran');
                console.error('Error:', xhr.responseText);
            });
    }
    
    displayData(data) {
        let html = '';
        
        if (data.length === 0) {
            html = `
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        <i class="fas fa-calendar-times fa-2x mb-2"></i><br>
                        Belum ada data tahun ajaran
                    </td>
                </tr>
            `;
        } else {
            data.forEach((item) => {
                const statusBadge = item.is_active == 1 
                    ? '<span class="badge badge-success">Aktif</span>'
                    : '<span class="badge badge-secondary">Tidak Aktif</span>';
                    
                const statusAction = item.is_active == 1
                    ? `<button class="btn btn-sm btn-warning" onclick="tahunAjaranModal.toggleStatus('${item.id}', 0)" title="Nonaktifkan">
                         <i class="fas fa-toggle-off"></i>
                       </button>`
                    : `<button class="btn btn-sm btn-success" onclick="tahunAjaranModal.toggleStatus('${item.id}', 1)" title="Aktifkan">
                         <i class="fas fa-toggle-on"></i>
                       </button>`;
                
                html += `
                    <tr>
                        <td><strong>${item.nama}</strong></td>
                        <td>${item.tahun_mulai}</td>
                        <td>${item.tahun_selesai}</td>
                        <td>${statusBadge}</td>
                        <td>
                            <div class="btn-group" role="group">
                                ${statusAction}
                                <button class="btn btn-sm btn-primary" onclick="tahunAjaranModal.edit('${item.id}')" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="tahunAjaranModal.delete('${item.id}')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }
        
        $(`#${this.config.tableDataId}`).html(html);
    }
    
    create() {
        $('#modalTitle').text('Tambah Tahun Ajaran');
        $(`#${this.config.formId}`)[0].reset();
        $(`#${this.config.fields.id}`).val('');
        $(`#${this.config.modalId}`).modal('show');
    }
    
    edit(id) {
        $.get(this.config.dataUrl)
            .done((response) => {
                if (response.success) {
                    const item = response.data.find(ta => ta.id === id);
                    if (item) {
                        $('#modalTitle').text('Edit Tahun Ajaran');
                        $(`#${this.config.fields.id}`).val(item.id);
                        $(`#${this.config.fields.nama}`).val(item.nama);
                        $(`#${this.config.fields.tahun_mulai}`).val(item.tahun_mulai);
                        $(`#${this.config.fields.tahun_selesai}`).val(item.tahun_selesai);
                        $(`#${this.config.fields.tanggal_mulai_pendaftaran}`).val(item.tanggal_mulai_pendaftaran);
                        $(`#${this.config.fields.tanggal_selesai_pendaftaran}`).val(item.tanggal_selesai_pendaftaran);
                        $(`#${this.config.fields.kuota_maksimal}`).val(item.kuota_maksimal);
                        $(`#${this.config.fields.deskripsi}`).val(item.deskripsi || '');
                        $(`#${this.config.modalId}`).modal('show');
                    }
                }
            })
            .fail((xhr) => {
                this.showToast('error', 'Error', 'Gagal memuat data untuk edit');
            });
    }
    
    submitForm() {
        const id = $(`#${this.config.fields.id}`).val();
        const url = id ? `${this.config.dataUrl}/${id}` : this.config.dataUrl;
        const method = id ? 'PUT' : 'POST';
        
        const data = {
            nama: $(`#${this.config.fields.nama}`).val(),
            tahun_mulai: parseInt($(`#${this.config.fields.tahun_mulai}`).val()),
            tahun_selesai: parseInt($(`#${this.config.fields.tahun_selesai}`).val()),
            tanggal_mulai_pendaftaran: $(`#${this.config.fields.tanggal_mulai_pendaftaran}`).val(),
            tanggal_selesai_pendaftaran: $(`#${this.config.fields.tanggal_selesai_pendaftaran}`).val(),
            kuota_maksimal: parseInt($(`#${this.config.fields.kuota_maksimal}`).val()),
            deskripsi: $(`#${this.config.fields.deskripsi}`).val()
        };
        
        // Validasi
        if (!this.validateForm(data)) {
            return;
        }
        
        $.ajax({
            url: url,
            method: method,
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: (response) => {
                if (response.success) {
                    $(`#${this.config.modalId}`).modal('hide');
                    this.loadData();
                    this.showToast('success', 'Berhasil', response.message || 'Data berhasil disimpan');
                } else {
                    this.showToast('error', 'Gagal', response.message || 'Terjadi kesalahan');
                }
            },
            error: (xhr) => {
                let message = 'Terjadi kesalahan saat menyimpan data';
                try {
                    const response = JSON.parse(xhr.responseText);
                    message = response.message || message;
                } catch(e) {}
                this.showToast('error', 'Error', message);
            }
        });
    }
    
    validateForm(data) {
        // Validasi tahun
        if (data.tahun_selesai <= data.tahun_mulai) {
            this.showToast('error', 'Validasi Error', 'Tahun selesai harus lebih besar dari tahun mulai');
            return false;
        }
        
        // Validasi tanggal
        if (data.tanggal_selesai_pendaftaran <= data.tanggal_mulai_pendaftaran) {
            this.showToast('error', 'Validasi Error', 'Tanggal selesai pendaftaran harus setelah tanggal mulai pendaftaran');
            return false;
        }
        
        return true;
    }
    
    toggleStatus(id, status) {
        $.ajax({
            url: `${this.config.dataUrl}/${id}/activate`,
            method: 'POST',
            data: JSON.stringify({ is_active: status }),
            contentType: 'application/json',
            success: (response) => {
                if (response.success) {
                    this.loadData();
                    const statusText = status == 1 ? 'diaktifkan' : 'dinonaktifkan';
                    this.showToast('success', 'Berhasil', `Tahun ajaran berhasil ${statusText}`);
                } else {
                    this.showToast('error', 'Gagal', response.message);
                }
            },
            error: (xhr) => {
                this.showToast('error', 'Error', 'Gagal mengubah status');
            }
        });
    }
    
    delete(id) {
        this.deleteId = id;
        $(`#${this.config.deleteModalId}`).modal('show');
    }
    
    confirmDelete() {
        if (this.deleteId) {
            $.ajax({
                url: `${this.config.dataUrl}/${this.deleteId}`,
                method: 'DELETE',
                success: (response) => {
                    if (response.success) {
                        $(`#${this.config.deleteModalId}`).modal('hide');
                        this.loadData();
                        this.showToast('success', 'Berhasil', 'Data berhasil dihapus');
                    } else {
                        this.showToast('error', 'Gagal', response.message);
                    }
                },
                error: (xhr) => {
                    this.showToast('error', 'Error', 'Gagal menghapus data');
                }
            });
        }
    }
    
    showToast(type, title, message) {
        // Implementasi toast sesuai dengan sistem yang sudah ada
        if (typeof toastr !== 'undefined') {
            toastr[type](message, title);
        } else if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: title,
                text: message,
                icon: type === 'error' ? 'error' : 'success',
                timer: 3000,
                showConfirmButton: false
            });
        } else {
            alert(`${title}: ${message}`);
        }
    }
}

// Global functions untuk backward compatibility
function tambahTahunAjaran() {
    if (typeof tahunAjaranModal !== 'undefined') {
        tahunAjaranModal.create();
    }
}

function loadTahunAjaran() {
    if (typeof tahunAjaranModal !== 'undefined') {
        tahunAjaranModal.loadData();
    }
}
