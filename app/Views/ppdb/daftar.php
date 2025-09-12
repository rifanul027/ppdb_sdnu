<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Removed PHP redirect from view - handled by controller now -->

<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-nu-cream via-white to-nu-cream">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-10">
        <!-- Title -->
        <div class="max-w-2xl text-center mx-auto mb-8">
            <h1 class="block font-bold text-nu-dark text-3xl md:text-4xl lg:text-5xl mb-4">
                Formulir 
                <span class="bg-clip-text bg-gradient-to-r from-nu-green to-nu-gold text-transparent">Pendaftaran</span>
            </h1>
            <p class="text-lg text-gray-700">Silakan lengkapi data di bawah ini untuk mendaftar sebagai siswa baru SDNU Pemanahan</p>
        </div>
        
        <!-- Progress Indicator -->
        <div class="flex justify-center mb-8">
            <div class="inline-flex items-center gap-x-2 bg-gradient-to-r from-nu-green to-nu-dark border border-nu-green/20 text-sm text-white p-2 px-4 rounded-full shadow-lg">
                <i class="fas fa-user-plus"></i>
                <span class="font-medium">Tahap Pendaftaran Siswa Baru</span>
            </div>
        </div>
    </div>
</div>

<!-- Form Section -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto bg-white">
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
        
        
    <form id="ppdb-form" action="/daftar/<?= session()->get('user_id') ?? 'unknown' ?>/store" method="post" enctype="multipart/form-data" class="space-y-8">
            <?= csrf_field() ?>
            
            <!-- Data Pribadi -->
            <?= form_section_header('Data Pribadi Siswa', 'fas fa-user') ?>
                <?= form_grid_start(2) ?>
                    <?= form_input_text('nama_lengkap', 'Nama Lengkap', ['required' => true]) ?>
                    
                    <?= form_input_select('tahun_ajaran_id', 'Tahun Ajaran', 
                        !empty($tahunAjaranList) ? array_column($tahunAjaranList, 'nama', 'id') : [],
                        ['required' => true, 'placeholder' => 'Pilih Tahun Ajaran']
                    ) ?>
                    
                    <?= form_input_select('agama', 'Agama', get_agama_options(), ['required' => true]) ?>
                    
                    <?= form_input_select('jenis_kelamin', 'Jenis Kelamin', get_jenis_kelamin_options(), ['required' => true]) ?>
                    
                    <?= form_input_text('tempat_lahir', 'Tempat Lahir', ['required' => true]) ?>
                    
                    <?= form_input_text('tanggal_lahir', 'Tanggal Lahir', ['required' => true, 'type' => 'date']) ?>
                <?= form_grid_end() ?>
            <?= form_section_footer() ?>
            
            <!-- Data Orang Tua -->
            <?= form_section_header('Data Orang Tua', 'fas fa-users') ?>
                <?= form_grid_start(2) ?>
                    <?= form_input_text('nama_ayah', 'Nama Ayah', ['required' => true]) ?>
                    
                    <?= form_input_text('nama_ibu', 'Nama Ibu', ['required' => true]) ?>
                <?= form_grid_end() ?>
            <?= form_section_footer() ?>
            
            <!-- Alamat & Kontak -->
            <?= form_section_header('Alamat & Kontak', 'fas fa-map-marker-alt') ?>
                <div class="space-y-6">
                    <?= form_input_textarea('alamat', 'Alamat Lengkap', ['required' => true, 'rows' => 3]) ?>
                    
                    <?= form_input_textarea('domisili', 'Alamat Domisili', [
                        'required' => true, 
                        'rows' => 3, 
                        'help' => 'Alamat tempat tinggal saat ini'
                    ]) ?>
                    
                    <?= form_grid_start(2) ?>
                        <?= form_input_text('nomor_telepon', 'Nomor Telepon', ['required' => true, 'type' => 'tel']) ?>
                        
                        <?= form_input_text('asal_tk_ra', 'Asal TK/RA', [
                            'help' => 'Nama TK/RA asal (opsional)'
                        ]) ?>
                    <?= form_grid_end() ?>
                </div>
            <?= form_section_footer() ?>
            
            <!-- Dokumen -->
            <?= form_section_header('Upload Dokumen', 'fas fa-file-upload') ?>
                <div class="space-y-6">
                    <?= form_input_file('akta', 'Akta Kelahiran', ['required' => true]) ?>
                    
                    <?= form_input_file('kk', 'Kartu Keluarga', ['required' => true]) ?>
                    
                    <?= form_input_file('ktp_ayah', 'KTP Ayah', ['required' => true]) ?>
                    
                    <?= form_input_file('ktp_ibu', 'KTP Ibu', ['required' => true]) ?>
                    
                    <?= form_input_file('ijazah', 'Ijazah TK/RA', [
                        'required' => false,
                        'help' => 'Upload jika ada (opsional) - Format: PDF, JPG, atau PNG (Maksimal 5MB)'
                    ]) ?>
                </div>
            <?= form_section_footer() ?>
            
            <?= form_submit_button('Kirim Pendaftaran') ?>
        </form>
    </div>
</div>
<?= $this->endSection() ?>