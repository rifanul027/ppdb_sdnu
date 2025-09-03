# Custom Error Pages - PPDB SDNU Pemanahan

Sistem error pages kustom telah dibuat dengan tema yang konsisten dengan desain website utama.

## Halaman Error Yang Tersedia

### 1. Error 404 - Page Not Found
- **File**: `app/Views/errors/html/error_404.php`
- **Kasus**: Halaman tidak ditemukan, URL tidak valid
- **Fitur**: Tombol kembali ke beranda, tombol halaman sebelumnya

### 2. Error 403 - Forbidden/Access Denied
- **File**: `app/Views/errors/html/error_403.php`
- **Kasus**: User tidak memiliki hak akses ke halaman tertentu
- **Fitur**: Tombol login, informasi permission, link ke beranda

### 3. Error 401 - Unauthorized/Login Required
- **File**: `app/Views/errors/html/error_401.php`
- **Kasus**: User belum login tapi mencoba akses halaman yang butuh login
- **Fitur**: Tombol login, link registrasi PPDB, link reset password

### 4. Error 400 - Bad Request
- **File**: `app/Views/errors/html/error_400.php`
- **Kasus**: Request tidak valid, validasi form gagal
- **Fitur**: Tips perbaikan form, tombol kembali

### 5. Error 500 - Internal Server Error
- **File**: `app/Views/errors/html/error_500.php`
- **Kasus**: Kesalahan server, database error
- **Fitur**: Auto-refresh, estimasi waktu perbaikan, contact support

### 6. Production Error Page
- **File**: `app/Views/errors/html/production.php`
- **Kasus**: Error umum di production mode
- **Fitur**: Error page yang user-friendly untuk production

## Controller dan Helper

### ErrorController
`app/Controllers/ErrorController.php` menyediakan method untuk menampilkan berbagai error:

```php
// Contoh penggunaan di controller
public function someMethod()
{
    // Cek permission
    if (!$this->hasPermission()) {
        $errorController = new \App\Controllers\ErrorController();
        return $errorController->adminAccessDenied();
    }
}
```

### Error Helper
`app/Helpers/error_helper.php` menyediakan function helper untuk mempermudah penggunaan:

```php
// Contoh penggunaan dengan helper
public function someMethod()
{
    // Cek login
    if (!session()->get('logged_in')) {
        return require_login();
    }
    
    // Cek data
    if (!$data) {
        return show_404('Data tidak ditemukan');
    }
    
    // Cek permission
    $permission_check = check_permission('admin');
    if ($permission_check !== true) {
        return $permission_check;
    }
}
```

## Filter Updates

### AuthFilter
- Menggunakan error page custom untuk unauthorized access
- Mendukung AJAX requests
- Session timeout handling

### AdminFilter  
- Error page khusus untuk admin access denial
- AJAX support
- Session management

### GuestFilter
- Redirect yang lebih baik untuk user yang sudah login
- AJAX support

## Route Configuration

Routes telah dikonfigurasi untuk:
1. Custom 404 handler: `$routes->set404Override('ErrorController::show404')`
2. Manual error testing: `/error/404`, `/error/403`, dll.

## Fitur Tema

### Konsistensi Desain
- Menggunakan color palette yang sama: nu-green, nu-gold, nu-cream
- Font Inter yang konsisten
- Logo SDNU
- Animasi CSS yang smooth

### Responsive Design
- Mobile-friendly dengan Tailwind CSS
- Breakpoint responsive untuk semua device

### Interactive Elements
- Tombol dengan hover effects
- Loading states
- Floating animations
- Contact information dengan social links

### User Experience
- Pesan error dalam Bahasa Indonesia
- Informasi yang jelas dan actionable
- Multiple options untuk user (login, home, back)
- Auto-refresh pada error 500
- Tips dan panduan perbaikan

## Penggunaan di Production

### Environment Configuration
Error pages akan menampilkan detail error hanya di development mode. Di production, pesan error lebih user-friendly.

### Maintenance Mode
Tersedia halaman khusus untuk maintenance mode yang dapat diaktifkan melalui environment variable atau database setting.

### Contact Information
Semua error pages menyertakan informasi kontak yang relevan:
- WhatsApp dengan pesan pre-filled
- Nomor telepon untuk support
- Email support/admin

## Testing Error Pages

Untuk testing manual, akses:
- `/error/404` - Test halaman 404
- `/error/403` - Test halaman forbidden
- `/error/401` - Test halaman unauthorized
- `/error/400` - Test halaman bad request
- `/error/500` - Test halaman server error
- `/error/maintenance` - Test maintenance mode

## Tips Implementasi

1. **Gunakan helper functions** untuk konsistensi
2. **Check AJAX requests** untuk memberikan response JSON yang sesuai
3. **Logging errors** penting untuk debugging
4. **Customize messages** sesuai konteks aplikasi
5. **Test semua scenarios** baik normal maupun edge cases

## Customization

Untuk menambah error page baru:
1. Buat view file di `app/Views/errors/html/`
2. Tambah method di `ErrorController`
3. Tambah helper function di `error_helper.php`
4. Update route jika diperlukan

Semua error pages menggunakan tema yang konsisten dan dapat dengan mudah di-customize sesuai kebutuhan brand atau perubahan desain.
