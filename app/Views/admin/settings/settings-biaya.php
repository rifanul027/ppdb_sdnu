<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">Pengaturan Biaya Sekolah</h2>
        <p style="color: #64748b;">Kelola biaya pendaftaran dan SPP sekolah</p>
    </div>
    <a href="/admin/settings" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Settings
    </a>
</div>

<!-- Settings Navigation -->
<div class="content-card" style="margin-bottom: 2rem;">
    <div class="card-body" style="padding: 1rem;">
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="/admin/settings" class="settings-tab">
                <i class="fas fa-cogs"></i>
                Pengaturan Umum
            </a>
            <a href="/admin/settings/biaya" class="settings-tab active">
                <i class="fas fa-money-bill-wave"></i>
                Biaya Sekolah
            </a>
            <a href="/admin/settings/pendaftaran" class="settings-tab">
                <i class="fas fa-calendar-alt"></i>
                Pendaftaran
            </a>
            <a href="/admin/settings/email" class="settings-tab">
                <i class="fas fa-envelope"></i>
                Email Template
            </a>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <!-- Biaya Pendaftaran -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Biaya Pendaftaran</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="/admin/settings/biaya/pendaftaran">
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Biaya Formulir</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #64748b;">Rp</span>
                        <input type="number" name="biaya_formulir" value="<?= $biaya['biaya_formulir'] ?? 50000 ?>" 
                               style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.5rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Uang Pangkal</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #64748b;">Rp</span>
                        <input type="number" name="uang_pangkal" value="<?= $biaya['uang_pangkal'] ?? 2000000 ?>" 
                               style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.5rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Biaya Seragam</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #64748b;">Rp</span>
                        <input type="number" name="biaya_seragam" value="<?= $biaya['biaya_seragam'] ?? 500000 ?>" 
                               style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.5rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Biaya Buku</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #64748b;">Rp</span>
                        <input type="number" name="biaya_buku" value="<?= $biaya['biaya_buku'] ?? 300000 ?>" 
                               style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.5rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                </div>
                
                <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 600;">Total Biaya Masuk:</span>
                        <span style="font-size: 1.25rem; font-weight: 700; color: #059669;" id="totalBiayaMasuk">
                            Rp <?= number_format(($biaya['biaya_formulir'] ?? 50000) + ($biaya['uang_pangkal'] ?? 2000000) + ($biaya['biaya_seragam'] ?? 500000) + ($biaya['biaya_buku'] ?? 300000), 0, ',', '.') ?>
                        </span>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-save"></i>
                    Simpan Biaya Pendaftaran
                </button>
            </form>
        </div>
    </div>
    
    <!-- Biaya SPP -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">Biaya SPP Bulanan</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="/admin/settings/biaya/spp">
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">SPP Kelas 1</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #64748b;">Rp</span>
                        <input type="number" name="spp_kelas_1" value="<?= $biaya['spp_kelas_1'] ?? 200000 ?>" 
                               style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.5rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">SPP Kelas 2</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #64748b;">Rp</span>
                        <input type="number" name="spp_kelas_2" value="<?= $biaya['spp_kelas_2'] ?? 220000 ?>" 
                               style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.5rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">SPP Kelas 3</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #64748b;">Rp</span>
                        <input type="number" name="spp_kelas_3" value="<?= $biaya['spp_kelas_3'] ?? 240000 ?>" 
                               style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.5rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">SPP Kelas 4</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #64748b;">Rp</span>
                        <input type="number" name="spp_kelas_4" value="<?= $biaya['spp_kelas_4'] ?? 260000 ?>" 
                               style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.5rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">SPP Kelas 5</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #64748b;">Rp</span>
                        <input type="number" name="spp_kelas_5" value="<?= $biaya['spp_kelas_5'] ?? 280000 ?>" 
                               style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.5rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">SPP Kelas 6</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #64748b;">Rp</span>
                        <input type="number" name="spp_kelas_6" value="<?= $biaya['spp_kelas_6'] ?? 300000 ?>" 
                               style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.5rem; border: 1px solid #d1d5db; border-radius: 8px;">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-save"></i>
                    Simpan Biaya SPP
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Biaya Tambahan -->
<div class="content-card" style="margin-top: 2rem;">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h3 class="card-title">Biaya Tambahan</h3>
        <button onclick="tambahBiayaTambahan()" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Tambah Biaya
        </button>
    </div>
    <div class="card-body">
        <div id="biayaTambahan">
            <?php if (isset($biaya_tambahan) && !empty($biaya_tambahan)): ?>
                <?php foreach ($biaya_tambahan as $index => $biaya): ?>
                    <div class="biaya-item" style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 1rem; align-items: center; margin-bottom: 1rem; padding: 1rem; background: #f8fafc; border-radius: 8px;">
                        <input type="text" placeholder="Nama biaya" value="<?= esc($biaya['nama']) ?>" 
                               style="padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
                        <div style="position: relative;">
                            <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #64748b;">Rp</span>
                            <input type="number" placeholder="Jumlah biaya" value="<?= $biaya['jumlah'] ?>" 
                                   style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.5rem; border: 1px solid #d1d5db; border-radius: 8px;">
                        </div>
                        <button type="button" onclick="hapusBiayaTambahan(this)" class="btn" style="background: #ef4444; color: white; padding: 0.75rem;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; padding: 2rem; color: #64748b;">
                    <i class="fas fa-plus-circle" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <div>Belum ada biaya tambahan</div>
                    <div style="font-size: 0.875rem; margin-top: 0.5rem;">
                        Klik "Tambah Biaya" untuk menambahkan biaya tambahan
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e2e8f0;">
            <button onclick="simpanBiayaTambahan()" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Simpan Biaya Tambahan
            </button>
        </div>
    </div>
</div>

<style>
.settings-tab {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    text-decoration: none;
    color: #64748b;
    border-radius: 8px;
    transition: all 0.2s ease;
    border: 1px solid #e2e8f0;
    background: white;
}

.settings-tab:hover {
    color: #059669;
    border-color: #059669;
    background: #f0fdf4;
}

.settings-tab.active {
    color: white;
    background: #059669;
    border-color: #059669;
}

.biaya-item {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
    div[style*="grid-template-columns: 1fr 1fr"] {
        display: block;
    }
    
    .content-card {
        margin-bottom: 2rem;
    }
    
    .biaya-item {
        display: block !important;
    }
    
    .biaya-item input,
    .biaya-item button {
        width: 100%;
        margin-bottom: 1rem;
    }
}
</style>

<script>
// Update total biaya masuk
function updateTotalBiayaMasuk() {
    const biayaFormulir = parseInt(document.querySelector('input[name="biaya_formulir"]').value) || 0;
    const uangPangkal = parseInt(document.querySelector('input[name="uang_pangkal"]').value) || 0;
    const biayaSeragam = parseInt(document.querySelector('input[name="biaya_seragam"]').value) || 0;
    const biayaBuku = parseInt(document.querySelector('input[name="biaya_buku"]').value) || 0;
    
    const total = biayaFormulir + uangPangkal + biayaSeragam + biayaBuku;
    document.getElementById('totalBiayaMasuk').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

// Add event listeners for biaya pendaftaran inputs
document.addEventListener('DOMContentLoaded', function() {
    const biayaInputs = ['biaya_formulir', 'uang_pangkal', 'biaya_seragam', 'biaya_buku'];
    biayaInputs.forEach(input => {
        const element = document.querySelector(`input[name="${input}"]`);
        if (element) {
            element.addEventListener('input', updateTotalBiayaMasuk);
        }
    });
});

function tambahBiayaTambahan() {
    const container = document.getElementById('biayaTambahan');
    
    // Remove empty state if exists
    const emptyState = container.querySelector('div[style*="text-align: center"]');
    if (emptyState) {
        emptyState.remove();
    }
    
    const newItem = document.createElement('div');
    newItem.className = 'biaya-item';
    newItem.style.cssText = 'display: grid; grid-template-columns: 1fr 1fr auto; gap: 1rem; align-items: center; margin-bottom: 1rem; padding: 1rem; background: #f8fafc; border-radius: 8px;';
    
    newItem.innerHTML = `
        <input type="text" placeholder="Nama biaya (contoh: Ekstrakurikuler, Study Tour)" 
               style="padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;">
        <div style="position: relative;">
            <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #64748b;">Rp</span>
            <input type="number" placeholder="Jumlah biaya" 
                   style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.5rem; border: 1px solid #d1d5db; border-radius: 8px;">
        </div>
        <button type="button" onclick="hapusBiayaTambahan(this)" class="btn" style="background: #ef4444; color: white; padding: 0.75rem;">
            <i class="fas fa-trash"></i>
        </button>
    `;
    
    container.appendChild(newItem);
}

function hapusBiayaTambahan(button) {
    if (confirm('Hapus biaya ini?')) {
        const item = button.closest('.biaya-item');
        item.style.animation = 'fadeOut 0.3s ease';
        setTimeout(() => {
            item.remove();
            
            // Check if no items left, show empty state
            const container = document.getElementById('biayaTambahan');
            if (container.children.length === 0) {
                container.innerHTML = `
                    <div style="text-align: center; padding: 2rem; color: #64748b;">
                        <i class="fas fa-plus-circle" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <div>Belum ada biaya tambahan</div>
                        <div style="font-size: 0.875rem; margin-top: 0.5rem;">
                            Klik "Tambah Biaya" untuk menambahkan biaya tambahan
                        </div>
                    </div>
                `;
            }
        }, 300);
    }
}

function simpanBiayaTambahan() {
    const items = document.querySelectorAll('.biaya-item');
    const data = [];
    
    items.forEach(item => {
        const nama = item.querySelector('input[type="text"]').value;
        const jumlah = item.querySelector('input[type="number"]').value;
        
        if (nama.trim() && jumlah) {
            data.push({ nama: nama.trim(), jumlah: parseInt(jumlah) });
        }
    });
    
    // Send data to server
    fetch('/admin/settings/biaya/tambahan', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ biaya_tambahan: data })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Biaya tambahan berhasil disimpan');
        } else {
            alert('Gagal menyimpan biaya tambahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    });
}

// Add fadeOut animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(-10px); }
    }
`;
document.head.appendChild(style);
</script>

<?= $this->endSection() ?>
