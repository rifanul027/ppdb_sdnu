<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-content">
        <div>
            <h2 class="page-title">Edit Pendaftar</h2>
            <p class="page-subtitle">Edit data calon siswa</p>
        </div>
        <div class="page-actions">
            <a href="/admin/pendaftar" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                <span class="btn-text">Kembali</span>
            </a>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto">
        <!-- Alert Messages -->
        <?php if (isset($validation)): ?>
            <div class="mb-8 p-4 border border-red-200 bg-red-50 rounded-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan validasi:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-8 p-4 border border-red-200 bg-red-50 rounded-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800"><?= session()->getFlashdata('error') ?></h3>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <form action="/admin/pendaftar/update/<?= $student['id'] ?>" method="post" class="space-y-8">
            <?= csrf_field() ?>
            
            <!-- Data Pribadi -->
            <?= form_section_header('Data Pribadi Siswa', 'fas fa-user') ?>
                <?= form_grid_start(2) ?>
                    <?= form_input_text('nama_lengkap', 'Nama Lengkap', [
                        'value' => $student['nama_lengkap'] ?? '',
                        'required' => true
                    ]) ?>
                    
                    <?= form_input_select('tahun_ajaran_id', 'Tahun Ajaran', 
                        !empty($tahunAjaranList) ? array_column($tahunAjaranList, 'nama', 'id') : [],
                        [
                            'required' => true, 
                            'placeholder' => 'Pilih Tahun Ajaran',
                            'value' => $student['tahun_ajaran_id'] ?? ''
                        ]
                    ) ?>
                    
                    <?= form_input_select('agama', 'Agama', get_agama_options(), [
                        'required' => true,
                        'value' => $student['agama'] ?? ''
                    ]) ?>
                    
                    <?= form_input_select('jenis_kelamin', 'Jenis Kelamin', get_jenis_kelamin_options(), [
                        'required' => true,
                        'value' => $student['jenis_kelamin'] ?? ''
                    ]) ?>
                    
                    <?= form_input_text('tempat_lahir', 'Tempat Lahir', [
                        'value' => $student['tempat_lahir'] ?? '',
                        'required' => true
                    ]) ?>
                    
                    <?= form_input_text('tanggal_lahir', 'Tanggal Lahir', [
                        'value' => $student['tanggal_lahir'] ?? '',
                        'required' => true, 
                        'type' => 'date'
                    ]) ?>
                <?= form_grid_end() ?>
            <?= form_section_footer() ?>
            
            <!-- Data Orang Tua -->
            <?= form_section_header('Data Orang Tua', 'fas fa-users') ?>
                <?= form_grid_start(2) ?>
                    <?= form_input_text('nama_ayah', 'Nama Ayah', [
                        'value' => $student['nama_ayah'] ?? '',
                        'required' => true
                    ]) ?>
                    
                    <?= form_input_text('nama_ibu', 'Nama Ibu', [
                        'value' => $student['nama_ibu'] ?? '',
                        'required' => true
                    ]) ?>
                <?= form_grid_end() ?>
            <?= form_section_footer() ?>
            
            <!-- Alamat & Kontak -->
            <?= form_section_header('Alamat & Kontak', 'fas fa-map-marker-alt') ?>
                <div class="space-y-6">
                    <?= form_input_textarea('alamat', 'Alamat Lengkap', [
                        'value' => $student['alamat'] ?? '',
                        'required' => true, 
                        'rows' => 3
                    ]) ?>
                    
                    <?= form_input_textarea('domisili', 'Alamat Domisili', [
                        'value' => $student['domisili'] ?? '',
                        'required' => true, 
                        'rows' => 3, 
                        'help' => 'Alamat tempat tinggal saat ini'
                    ]) ?>
                    
                    <?= form_grid_start(2) ?>
                        <?= form_input_text('nomor_telepon', 'Nomor Telepon', [
                            'value' => $student['nomor_telepon'] ?? '',
                            'required' => true, 
                            'type' => 'tel'
                        ]) ?>
                        
                        <?= form_input_text('asal_tk_ra', 'Asal TK/RA', [
                            'value' => $student['asal_tk_ra'] ?? '',
                            'help' => 'Nama TK/RA asal (opsional)'
                        ]) ?>
                    <?= form_grid_end() ?>
                </div>
            <?= form_section_footer() ?>

            <!-- Dokumen -->
            <?= form_section_header('Upload Dokumen', 'fas fa-file-upload') ?>
                <div class="space-y-6">
                    <?= form_input_file('akta', 'Akta Kelahiran', [
                        'required' => true,
                        'value' => $student['akta'] ?? ''
                    ]) ?>
                    
                    <?= form_input_file('kk', 'Kartu Keluarga', [
                        'required' => true,
                        'value' => $student['kk'] ?? ''
                    ]) ?>
                    
                    <?= form_input_file('ktp_ayah', 'KTP Ayah', [
                        'required' => true,
                        'value' => $student['ktp_ayah'] ?? ''
                    ]) ?>
                    
                    <?= form_input_file('ktp_ibu', 'KTP Ibu', [
                        'required' => true,
                        'value' => $student['ktp_ibu'] ?? ''
                    ]) ?>
                    
                    <?= form_input_file('ijazah', 'Ijazah TK/RA', [
                        'required' => false,
                        'value' => $student['ijazah'] ?? '',
                        'help' => 'Upload jika ada (opsional) - Format: PDF, JPG, atau PNG (Maksimal 5MB)'
                    ]) ?>
                </div>
            <?= form_section_footer() ?>
                <?= form_submit_button('Simpan Perubahan', [
                    'icon' => 'fas fa-save',
                    'class' => 'w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white text-lg font-semibold rounded-xl shadow-lg py-4 px-8 flex items-center justify-center gap-x-3'
                ]) ?>
        </form>
    </div>
</div><?= $this->endSection() ?>
