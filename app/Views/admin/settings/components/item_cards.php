<?php
/**
 * Item Card Component
 * Component for displaying individual data items
 */
?>

<script>
// Render Tahun Ajaran Card
function renderTahunAjaranCard(item) {
    const status = item.is_active == 1 ? 
        '<div class="flex items-center space-x-2"><div class="w-2 h-2 bg-green-400 rounded-full"></div><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Aktif</span></div>' :
        '<div class="flex items-center space-x-2"><div class="w-2 h-2 bg-gray-400 rounded-full"></div><span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-medium">Tidak Aktif</span></div>';
        
    return `
        <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="bg-green-100 p-2 rounded-lg">
                            <i class="fas fa-calendar-alt text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">${item.nama}</h4>
                            <p class="text-sm text-gray-500">Periode: ${item.tahun_mulai}/${item.tahun_selesai}</p>
                        </div>
                    </div>
                    ${item.deskripsi ? `<p class="text-sm text-gray-600 mb-3 bg-gray-50 p-3 rounded-lg">${item.deskripsi}</p>` : ''}
                    <div class="flex items-center justify-between">
                        <div>${status}</div>
                        <div class="text-xs text-gray-500">
                            <i class="fas fa-clock mr-1"></i>
                            ${new Date(item.created_at).toLocaleDateString('id-ID')}
                        </div>
                    </div>
                </div>
                <div class="flex flex-col space-y-2 ml-6">
                    <button onclick="editItem('tahun-ajaran', '${item.id}')" 
                            class="bg-green-50 hover:bg-green-100 text-green-600 p-2 rounded-lg transition-colors" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="toggleStatus('tahun-ajaran', '${item.id}', ${item.is_active})" 
                            class="bg-yellow-50 hover:bg-yellow-100 text-yellow-600 p-2 rounded-lg transition-colors" title="Toggle Status">
                        <i class="fas fa-toggle-${item.is_active == 1 ? 'on' : 'off'}"></i>
                    </button>
                    <button onclick="deleteItem('tahun-ajaran', '${item.id}', '${item.nama}')" 
                            class="bg-red-50 hover:bg-red-100 text-red-600 p-2 rounded-lg transition-colors" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
}

// Render Kategori Card
function renderKategoriCard(item) {
    return `
        <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="bg-green-100 p-2 rounded-lg">
                            <i class="fas fa-tags text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">${item.nama_kategori}</h4>
                            <p class="text-sm font-medium text-green-600">SPP: Rp ${new Intl.NumberFormat('id-ID').format(item.spp)}</p>
                        </div>
                    </div>
                    ${item.catatan ? `<p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">${item.catatan}</p>` : ''}
                    <div class="mt-3 text-xs text-gray-500">
                        <i class="fas fa-clock mr-1"></i>
                        ${new Date(item.created_at).toLocaleDateString('id-ID')}
                    </div>
                </div>
                <div class="flex flex-col space-y-2 ml-6">
                    <button onclick="editItem('kategori', '${item.id}')" 
                            class="bg-green-50 hover:bg-green-100 text-green-600 p-2 rounded-lg transition-colors" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="deleteItem('kategori', '${item.id}', '${item.nama_kategori}')" 
                            class="bg-red-50 hover:bg-red-100 text-red-600 p-2 rounded-lg transition-colors" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
}

// Render Gelombang Card
function renderGelombangCard(item) {
    const now = new Date();
    const startDate = new Date(item.tanggal_mulai);
    const endDate = new Date(item.tanggal_selesai);
    
    let status, statusColor;
    if (now < startDate) {
        status = 'Belum Dimulai';
        statusColor = 'bg-yellow-100 text-yellow-800';
    } else if (now > endDate) {
        status = 'Selesai';
        statusColor = 'bg-red-100 text-red-800';
    } else {
        status = 'Sedang Berlangsung';
        statusColor = 'bg-green-100 text-green-800';
    }
    
    return `
        <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="bg-purple-100 p-2 rounded-lg">
                            <i class="fas fa-wave-square text-purple-600"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">${item.nama}</h4>
                            <span class="${statusColor} px-3 py-1 rounded-full text-xs font-medium">${status}</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-3">
                        <div class="bg-green-50 p-3 rounded-lg">
                            <p class="text-xs text-green-600 font-medium">Tanggal Mulai</p>
                            <p class="text-sm font-semibold text-green-800">${new Date(item.tanggal_mulai).toLocaleDateString('id-ID')}</p>
                        </div>
                        <div class="bg-red-50 p-3 rounded-lg">
                            <p class="text-xs text-red-600 font-medium">Tanggal Selesai</p>
                            <p class="text-sm font-semibold text-red-800">${new Date(item.tanggal_selesai).toLocaleDateString('id-ID')}</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col space-y-2 ml-6">
                    <button onclick="editItem('gelombang', '${item.id}')" 
                            class="bg-green-50 hover:bg-green-100 text-green-600 p-2 rounded-lg transition-colors" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="deleteItem('gelombang', '${item.id}', '${item.nama}')" 
                            class="bg-red-50 hover:bg-red-100 text-red-600 p-2 rounded-lg transition-colors" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
}
</script>
