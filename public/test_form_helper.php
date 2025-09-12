<?php
/**
 * Standalone test for form helpers
 * Access via web browser directly
 */

// Simple test without CodeIgniter framework
function old($key) {
    return $_POST[$key] ?? '';
}

function esc($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Include the form helper directly
include '../app/Helpers/form_helper.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Helper Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'nu-green': '#2D5A3D',
                        'nu-dark': '#1A3B2B', 
                        'nu-gold': '#FFD700',
                        'nu-cream': '#FFF8E7'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold text-center mb-8">Form Helper Test</h1>
        
        <form method="post" class="space-y-8">
            <!-- Test Text Input -->
            <?= form_section_header('Text Input Test', 'fas fa-keyboard') ?>
                <?= form_grid_start(2) ?>
                    <?= form_input_text('test_name', 'Nama Lengkap', ['required' => true, 'placeholder' => 'Masukkan nama lengkap']) ?>
                    <?= form_input_text('test_email', 'Email', ['type' => 'email', 'help' => 'Contoh: user@email.com']) ?>
                <?= form_grid_end() ?>
            <?= form_section_footer() ?>
            
            <!-- Test Select Input -->
            <?= form_section_header('Select Input Test', 'fas fa-list') ?>
                <?= form_grid_start(2) ?>
                    <?= form_input_select('test_agama', 'Agama', get_agama_options(), ['required' => true]) ?>
                    <?= form_input_select('test_gender', 'Jenis Kelamin', get_jenis_kelamin_options(), ['required' => true]) ?>
                <?= form_grid_end() ?>
            <?= form_section_footer() ?>
            
            <!-- Test Textarea -->
            <?= form_section_header('Textarea Test', 'fas fa-align-left') ?>
                <?= form_input_textarea('test_address', 'Alamat', ['required' => true, 'rows' => 4, 'help' => 'Masukkan alamat lengkap']) ?>
            <?= form_section_footer() ?>
            
            <!-- Test File Input -->
            <?= form_section_header('File Input Test', 'fas fa-upload') ?>
                <div class="space-y-6">
                    <?= form_input_file('test_file', 'Upload Dokumen', ['required' => true]) ?>
                    <?= form_input_file('test_optional', 'Upload Opsional', ['required' => false, 'help' => 'File opsional']) ?>
                </div>
            <?= form_section_footer() ?>
            
            <!-- Test Submit Button -->
            <?= form_submit_button('Test Submit', ['icon' => 'fas fa-check']) ?>
        </form>
        
        <?php if (!empty($_POST)): ?>
            <div class="mt-8 p-4 bg-green-50 border border-green-200 rounded-lg">
                <h3 class="text-lg font-semibold text-green-800 mb-2">Form Data Submitted:</h3>
                <pre class="text-sm text-green-700"><?= htmlspecialchars(print_r($_POST, true)) ?></pre>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>