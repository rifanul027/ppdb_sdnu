# Form Helper Guide - PPDB SDNU

## Overview
Form helper telah diimplementasikan untuk menstandardisasi dan mempermudah pembuatan form input di aplikasi PPDB SDNU. Helper ini menyediakan berbagai fungsi untuk membuat input field dengan styling yang konsisten.

## Helper Functions yang Tersedia

### 1. Form Input Text
```php
form_input_text($name, $label, $options = [])
```
**Options:**
- `value` - Nilai default
- `required` - true/false
- `placeholder` - Placeholder text
- `help` - Help text di bawah input
- `type` - Tipe input (text, email, tel, date, dll)
- `class` - CSS class tambahan

**Contoh:**
```php
<?= form_input_text('nama_lengkap', 'Nama Lengkap', [
    'value' => $student['nama_lengkap'],
    'required' => true,
    'placeholder' => 'Masukkan nama lengkap'
]) ?>
```

### 2. Form Input Password
```php
form_input_password($name, $label, $options = [])
```
**Options:**
- `required` - true/false
- `placeholder` - Placeholder text
- `help` - Help text
- `toggle_id` - ID untuk toggle button
- `eye_open_id` - ID untuk icon mata terbuka
- `eye_closed_id` - ID untuk icon mata tertutup

**Contoh:**
```php
<?= form_input_password('password', 'Password', [
    'placeholder' => '••••••••',
    'required' => true
]) ?>
```

### 3. Form Input Simple (untuk login/register)
```php
form_input_simple($name, $label, $options = [])
```
**Options:**
- `type` - Tipe input
- `value` - Nilai default
- `required` - true/false
- `placeholder` - Placeholder text
- `class` - CSS class tambahan

### 4. Form Select
```php
form_input_select($name, $label, $options = [], $config = [])
```
**Parameters:**
- `$options` - Array pilihan [value => label]
- `$config` - Konfigurasi tambahan (value, required, placeholder, dll)

**Contoh:**
```php
<?= form_input_select('agama', 'Agama', get_agama_options(), [
    'value' => $student['agama'],
    'required' => true
]) ?>
```

### 5. Form Textarea
```php
form_input_textarea($name, $label, $options = [])
```
**Options:**
- `value` - Nilai default
- `required` - true/false
- `rows` - Jumlah baris
- `help` - Help text

### 6. Form Checkbox
```php
form_checkbox($name, $label, $options = [])
```

### 7. Layout Helpers

#### Section Header & Footer
```php
<?= form_section_header('Data Pribadi Siswa', 'fas fa-user') ?>
// Form fields here
<?= form_section_footer() ?>
```

#### Grid Layout
```php
<?= form_grid_start(2) ?> // 2 kolom
    // Form fields here
<?= form_grid_end() ?>
```

### 8. Password Toggle Script
```php
<?= password_toggle_script('password', 'togglePassword', 'passwordEyeOpen', 'passwordEyeClosed') ?>
```

## Predefined Options

### Agama Options
```php
get_agama_options() // Returns array of agama choices
```

### Jenis Kelamin Options
```php
get_jenis_kelamin_options() // Returns array of jenis kelamin choices
```

## Files Updated

1. **login.php** - Menggunakan `form_input_simple()` dan `form_input_password()`
2. **register.php** - Menggunakan `form_input_simple()` dan `form_input_password()`
3. **edit_profile.php** - Menggunakan semua helper form dengan layout sections dan grid
4. **student_profile.php** - Tidak diubah (hanya menampilkan data, bukan form input)

## Benefits

1. **Konsistensi** - Styling yang seragam di seluruh aplikasi
2. **Maintainability** - Mudah mengubah styling dari satu tempat
3. **Reusability** - Helper dapat digunakan berulang kali
4. **Clean Code** - View file lebih bersih dan mudah dibaca
5. **Productivity** - Mengurangi duplikasi kode

## Notes

- Helper form sudah di-load otomatis melalui `app/Config/Autoload.php`
- Styling menggunakan Tailwind CSS dengan color scheme NU (nu-green, nu-dark, nu-cream)
- Password toggle functionality sudah built-in dengan JavaScript
- Validasi tetap menggunakan CodeIgniter validation rules di controller