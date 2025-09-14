<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-gray-50 via-white to-gray-50">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-10">
        <!-- Title -->
        <div class="max-w-2xl text-center mx-auto mb-8">
            <h1 class="block font-bold text-gray-800 text-3xl md:text-4xl lg:text-5xl mb-4">
                Edit 
                <span class="bg-clip-text bg-gradient-to-r from-green-600 to-green-800 text-transparent">Profil</span>
            </h1>
            <p class="text-lg text-gray-700">Perbarui data profil siswa SDNU Pemanahan</p>
        </div>
        
        <!-- Progress Indicator -->
        <div class="flex justify-center mb-8">
            <div class="inline-flex items-center gap-x-2 bg-gradient-to-r from-green-600 to-green-700 border border-green-500/20 text-sm text-white p-2 px-4 rounded-full shadow-lg">
                <i class="fas fa-user-edit"></i>
                <span class="font-medium">Edit Data Siswa</span>
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
        
        <form action="/edit-profile" method="post" class="space-y-8">

            <pre><?php print_r([
                'akta_url'   => $student['akta_url'],
                'kk_url'     => $student['kk_url'],
                'ijazah_url' => $student['ijazah_url'],
                'ktp_ayah'   => $student['ktp_ayah'],
                'ktp_ibu'    => $student['ktp_ibu'],
            ]); ?></pre>
            <!-- Data Pribadi -->
            <?= form_section_header('Data Pribadi Siswa', 'fas fa-user') ?>
                
                <?= form_grid_start(2) ?>
                    <?= form_input_text('nama_lengkap', 'Nama Lengkap', [
                        'value' => $student['nama_lengkap'],
                        'required' => true
                    ]) ?>
                    
                    <?= form_input_text('nisn', 'NISN', [
                        'value' => $student['nisn'],
                        'help' => '10 digit nomor NISN (opsional)',
                        'class' => 'pattern="\d{10}" maxlength="10"'
                    ]) ?>
                    
                    <?= form_input_select('agama', 'Agama', get_agama_options(), [
                        'value' => $student['agama'],
                        'required' => true
                    ]) ?>
                    
                    <?= form_input_select('jenis_kelamin', 'Jenis Kelamin', get_jenis_kelamin_options(), [
                        'value' => $student['jenis_kelamin'],
                        'required' => true
                    ]) ?>
                    
                    <?= form_input_text('tempat_lahir', 'Tempat Lahir', [
                        'value' => $student['tempat_lahir'],
                        'required' => true
                    ]) ?>
                    
                    <?= form_input_text('tanggal_lahir', 'Tanggal Lahir', [
                        'type' => 'date',
                        'value' => $student['tanggal_lahir'],
                        'required' => true
                    ]) ?>
                <?= form_grid_end() ?>
            <?= form_section_footer() ?>
            
            <!-- Data Orang Tua -->
            <?= form_section_header('Data Orang Tua', 'fas fa-users') ?>
                
                <?= form_grid_start(2) ?>
                    <?= form_input_text('nama_ayah', 'Nama Ayah', [
                        'value' => $student['nama_ayah'],
                        'required' => true
                    ]) ?>
                    
                    <?= form_input_text('nama_ibu', 'Nama Ibu', [
                        'value' => $student['nama_ibu'],
                        'required' => true
                    ]) ?>
                <?= form_grid_end() ?>
            <?= form_section_footer() ?>
            
            <!-- Alamat & Kontak -->
            <?= form_section_header('Alamat & Kontak', 'fas fa-map-marker-alt') ?>
                
                <div class="space-y-6">
                    <?= form_input_textarea('alamat', 'Alamat Lengkap', [
                        'value' => $student['alamat'],
                        'required' => true,
                        'rows' => 3
                    ]) ?>
                    
                    <?= form_input_textarea('domisili', 'Alamat Domisili', [
                        'value' => $student['domisili'],
                        'required' => true,
                        'rows' => 3,
                        'help' => 'Alamat tempat tinggal saat ini'
                    ]) ?>
                    
                    <?= form_grid_start(2) ?>
                        <?= form_input_text('nomor_telepon', 'Nomor Telepon', [
                            'type' => 'tel',
                            'value' => $student['nomor_telepon'],
                            'required' => true
                        ]) ?>
                        
                        <?= form_input_text('asal_tk_ra', 'Asal TK/RA', [
                            'value' => $student['asal_tk_ra'],
                            'help' => 'Nama TK/RA asal (opsional)'
                        ]) ?>
                    <?= form_grid_end() ?>
                </div>
            <?= form_section_footer() ?>

            <!-- Dokumen -->
            <?= form_section_header('Dokumen', 'fas fa-file-upload') ?>

            <div class="space-y-6">
                <?= form_input_file('akta_url', 'Akta Lahir', [
                    'value' => $student['akta_url'],
                    'required' => true
                ]) ?>

                <?= form_input_file('kk_url', 'Kartu Keluarga', [
                    'value' => $student['kk_url'],
                    'required' => true
                ]) ?>

                <?= form_input_file('ijazah_url', 'Ijazah', [
                    'value' => $student['ijazah_url'],
                    'required' => true
                ]) ?>

                <?= form_input_file('ktp_ayah', 'KTP Ayah', [
                    'value' => $student['ktp_ayah'],
                    'required' => true
                ]) ?>

                <?= form_input_file('ktp_ibu', 'KTP Ibu', [
                    'value' => $student['ktp_ibu'],
                    'required' => true
                ]) ?>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button type="submit" class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 border border-transparent text-white text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 py-4 px-8">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
                <a href="/student-profile" class="inline-flex justify-center items-center gap-x-3 text-center bg-gray-500 hover:bg-gray-600 border border-transparent text-white text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 py-4 px-8">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
