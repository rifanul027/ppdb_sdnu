<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-content">
        <div>
            <h2 class="page-title">Tambah Pendaftar</h2>
            <p class="page-subtitle">Tambahkan data calon siswa baru</p>
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
        
        <form action="/admin/pendaftar/store" method="post" enctype="multipart/form-data" class="space-y-8">
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
                    
                    <?= form_input_file('ktp_ayah', 'KTP Ayah', ['required' => true]) ?>
                    
                    <?= form_input_file('ktp_ibu', 'KTP Ibu', ['required' => true]) ?>
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
            
            <!-- Data Akun User -->
            <?= form_section_header('Data Akun User', 'fas fa-user-cog') ?>
                <?= form_grid_start(2) ?>
                    <?= form_input_text('username', 'Username', [
                        'required' => true,
                        'help' => 'Username untuk login siswa'
                    ]) ?>
                    
                    <?= form_input_text('email', 'Email', [
                        'type' => 'email',
                        'required' => true,
                        'help' => 'Email untuk login siswa'
                    ]) ?>
                <?= form_grid_end() ?>
                
                <?= form_input_password('password', 'Password', [
                    'required' => true,
                    'help' => 'Password untuk login siswa (minimal 8 karakter)',
                    'toggle_id' => 'togglePassword'
                ]) ?>
            <?= form_section_footer() ?>
            
            <!-- Upload Dokumen -->
            <?= form_section_header('Upload Dokumen', 'fas fa-file-upload') ?>
                <div class="space-y-6">
                    <?= form_input_file('akta', 'Akta Kelahiran', ['required' => true]) ?>
                    
                    <?= form_input_file('kk', 'Kartu Keluarga', ['required' => true]) ?>
                    
                    <?= form_input_file('ijazah', 'Ijazah TK/RA', [
                        'required' => false,
                        'help' => 'Upload jika ada (opsional) - Format: PDF, JPG, atau PNG (Maksimal 5MB)'
                    ]) ?>
                </div>
            <?= form_section_footer() ?>
            
            <?= form_submit_button('Simpan Data Pendaftar', ['icon' => 'fas fa-save']) ?>
        </form>
    </div>
</div><!-- Modal Success -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">
                    <i class="fas fa-check-circle"></i>
                    Pendaftaran Berhasil!
                </h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Selamat!</h4>
                    <p>Data pendaftar berhasil disimpan. Berikut adalah informasi akun yang telah dibuat:</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-user"></i>
                                    Data Pendaftar
                                </h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>No. Registrasi:</strong></td>
                                        <td id="modal-no-registrasi"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama Lengkap:</strong></td>
                                        <td id="modal-nama-lengkap"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tahun Ajaran:</strong></td>
                                        <td id="modal-tahun-ajaran"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-key"></i>
                                    Informasi Login
                                </h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Username:</strong></td>
                                        <td id="modal-username"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                            <?= form_submit_button('Simpan Data Pendaftar', [
                                'icon' => 'fas fa-save',
                                'class' => 'w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white text-lg font-semibold rounded-xl shadow-lg py-4 px-8 flex items-center justify-center gap-x-3'
                            ]) ?>
                                    </tr>
                                    <tr>
                                        <td><strong>Password:</strong></td>
                                        <td id="modal-password"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info mt-3" role="alert">
                    <i class="fas fa-info-circle"></i>
                    <strong>Penting!</strong> Silakan catat atau screenshot informasi login di atas untuk diberikan kepada siswa/orang tua.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="redirectToPendaftar()">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Data Pendaftar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function redirectToPendaftar() {
    window.location.href = '/admin/pendaftar';
}

// Check if success data exists in session
<?php if (session()->get('success_data')): ?>
    $(document).ready(function() {
        const successData = <?= json_encode(session()->get('success_data')) ?>;
        
        // Populate modal with data
        $('#modal-no-registrasi').text(successData.no_registrasi);
        $('#modal-nama-lengkap').text(successData.nama_lengkap);
        $('#modal-tahun-ajaran').text(successData.tahun_ajaran);
        $('#modal-username').text(successData.username);
        $('#modal-email').text(successData.email);
        $('#modal-password').text(successData.password);
        
        // Show modal
        $('#successModal').modal('show');
    });
<?php endif; ?>
</script>

<?= password_toggle_script('password', 'togglePassword', 'passwordEyeOpen', 'passwordEyeClosed') ?>

<?= $this->endSection() ?>
