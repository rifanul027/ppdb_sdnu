<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// PPDB Routes
$routes->get('/ppdb', 'Ppdb::index');
$routes->get('/ppdb/pengumuman', 'Ppdb::pengumuman');
$routes->get('/daftar', 'Ppdb::daftar');
$routes->post('/daftar', 'Ppdb::prosesDaftar');
$routes->get('/student-profile', 'Ppdb::studentProfile');
$routes->match(['GET', 'POST'], '/edit-profile', 'Ppdb::editProfile');
$routes->post('/upload-payment', 'Ppdb::uploadPayment');

// Auth Routes (Guest only)
$routes->group('', ['filter' => 'guest'], function($routes) {
    $routes->get('/login', 'Auth::login');
    $routes->post('/login', 'Auth::attemptLogin');
    $routes->get('/register', 'Auth::register');
    $routes->post('/register', 'Auth::attemptRegister');
});

// Logout (Authenticated users only)
$routes->get('/logout', 'Auth::logout', ['filter' => 'auth']);

// User Profile Routes (Authenticated users only)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/profile', 'Auth::profile');
    $routes->post('/profile/update', 'Auth::updateProfile');
    $routes->post('/profile/change-password', 'Auth::changePassword');
    $routes->post('/profile/upload-photo', 'Auth::uploadPhoto');
});

// Admin Routes (Admin only)
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('dashboard', 'AdminDashboard::index');
    // pendaftar management
    $routes->get('pendaftar', 'AdminPendaftar::index');
    $routes->get('pendaftar/detail/(:segment)', 'AdminPendaftar::detail/$1');
    $routes->get('pendaftar/edit/(:segment)', 'AdminPendaftar::edit/$1');
    $routes->post('pendaftar/update/(:segment)', 'AdminPendaftar::update/$1');
    $routes->post('pendaftar/delete/(:segment)', 'AdminPendaftar::delete/$1');
    $routes->post('pendaftar/validate/(:segment)', 'AdminPendaftar::validateStudent/$1');
    $routes->get('pendaftar/tambah', 'AdminPendaftar::tambah');
    $routes->post('pendaftar/store', 'AdminPendaftar::store');
    // daftar ulang management
    $routes->get('daftar-ulang', 'AdminDaftarUlang::index');
    $routes->get('daftar-ulang/detail/(:segment)', 'AdminDaftarUlang::detail/$1');
    $routes->post('daftar-ulang/konfirmasi-pembayaran', 'AdminDaftarUlang::konfirmasiPembayaran');
    $routes->get('pengumuman', 'AdminPengumuman::index');
    $routes->post('pengumuman/create', 'AdminPengumuman::create');
    $routes->get('pengumuman/detail/(:segment)', 'AdminPengumuman::detail/$1');
    $routes->post('pengumuman/update/(:segment)', 'AdminPengumuman::update/$1');
    $routes->post('pengumuman/toggle-active/(:segment)', 'AdminPengumuman::toggleActive/$1');
    $routes->post('pengumuman/delete/(:segment)', 'AdminPengumuman::delete/$1');
    // rekap siswa management
    $routes->get('rekap-siswa', 'Admin::rekapSiswa');
    // settings and profile
    $routes->get('settings', 'Admin::settings');
    $routes->get('settings/biaya', 'Admin::settingsBiaya');
    $routes->get('settings/pendaftaran', 'Admin::settingsPendaftaran');
    $routes->get('profile', 'Auth::profile');
    
    // API endpoints for admin
    $routes->post('settings/save', 'Admin::saveSettings');
    $routes->post('settings/biaya/(:any)', 'Admin::saveBiaya/$1');
    
    // Rekap Siswa API routes
    $routes->get('students-data', 'Admin::getStudentsData');
    $routes->post('student/(:segment)/status', 'Admin::updateStudentStatus/$1');
    $routes->delete('student/(:segment)/delete', 'Admin::deleteStudent/$1');
    $routes->get('export-excel', 'Admin::exportExcel');
    $routes->get('export-pdf', 'Admin::exportPdf');
    
    // PPDB Admin Routes (alternative routes for PPDB controller admin functions)
    $routes->delete('ppdb/student/(:segment)/delete', 'Ppdb::deleteStudent/$1');
    $routes->post('ppdb/student/(:segment)/status/(:segment)', 'Ppdb::updateStudentStatus/$1/$2');
    
    // Settings API routes
    $routes->get('api/settings/tahun-ajaran', 'Admin::getTahunAjaran');
    $routes->post('api/settings/tahun-ajaran', 'Admin::storeTahunAjaran');
    $routes->put('api/settings/tahun-ajaran/(:segment)', 'Admin::updateTahunAjaran/$1');
    $routes->delete('api/settings/tahun-ajaran/(:segment)', 'Admin::deleteTahunAjaran/$1');
    $routes->post('api/settings/tahun-ajaran/(:segment)/activate', 'Admin::activateTahunAjaran/$1');
    
    $routes->get('api/settings/beasiswa', 'Admin::getBeasiswa');
    $routes->post('api/settings/beasiswa', 'Admin::storeBeasiswa');
    $routes->put('api/settings/beasiswa/(:segment)', 'Admin::updateBeasiswa/$1');
    $routes->delete('api/settings/beasiswa/(:segment)', 'Admin::deleteBeasiswa/$1');
    
    $routes->post('profile/update', 'Auth::updateProfile');
    $routes->post('profile/change-password', 'Auth::changePassword');
    $routes->post('profile/upload-photo', 'Auth::uploadPhoto');
});

// Default admin route redirect to dashboard
$routes->get('admin', function() {
    return redirect()->to('/admin/dashboard');
});

// Error Routes (for manual testing or direct access)
$routes->group('error', function($routes) {
    $routes->get('400', 'ErrorController::show400');
    $routes->get('401', 'ErrorController::show401');
    $routes->get('403', 'ErrorController::show403');
    $routes->get('404', 'ErrorController::show404');
    $routes->get('500', 'ErrorController::show500');
    $routes->get('maintenance', 'ErrorController::maintenanceMode');
    $routes->get('session-expired', 'ErrorController::sessionExpired');
    $routes->get('admin-access-denied', 'ErrorController::adminAccessDenied');
    $routes->get('login-required', 'ErrorController::loginRequired');
    $routes->get('account-not-activated', 'ErrorController::accountNotActivated');
});

// File Upload Access Routes
$routes->get('writable/uploads/(:any)/(:any)', function($studentId, $filename) {
    $filePath = WRITEPATH . 'uploads/' . $studentId . '/' . $filename;
    
    if (file_exists($filePath)) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $filePath);
        finfo_close($finfo);
        
        header('Content-Type: ' . $mimeType);
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
});

// Set custom 404 handler
$routes->set404Override('ErrorController::show404');
