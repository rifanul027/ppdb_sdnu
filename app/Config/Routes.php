<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Home::index');

$routes->get('/ppdb', 'Ppdb::index');
$routes->get('/ppdb/pengumuman', 'Ppdb::pengumuman');
$routes->get('/daftar', 'PendaftaranSiswa::index');
$routes->post('/daftar', 'PendaftaranSiswa::store');
$routes->get('/student-profile', 'Ppdb::studentProfile');
$routes->get('/profile-siswa', 'Ppdb::studentProfile');
$routes->match(['GET', 'POST'], '/edit-profile', 'Ppdb::editProfile');
$routes->post('/upload-payment', 'Ppdb::uploadPayment');

$routes->group('', ['filter' => 'guest'], function($routes) {
    $routes->get('/login', 'Auth::login');
    $routes->post('/login', 'Auth::attemptLogin');
    $routes->get('/register', 'Auth::register');
    $routes->post('/register', 'Auth::attemptRegister');
});

$routes->get('/logout', 'Auth::logout', ['filter' => 'auth']);

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/profile', 'Auth::profile');
    $routes->post('/profile/update', 'Auth::updateProfile');
    $routes->post('/profile/change-password', 'Auth::changePassword');
    $routes->post('/profile/upload-photo', 'Auth::uploadPhoto');
});

$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('dashboard', 'AdminDashboard::index');
    $routes->get('pendaftar', 'AdminPendaftar::index');
    $routes->get('pendaftar/detail/(:segment)', 'AdminPendaftar::detail/$1');
    $routes->get('pendaftar/edit/(:segment)', 'AdminPendaftar::edit/$1');
    $routes->post('pendaftar/update/(:segment)', 'AdminPendaftar::update/$1');
    $routes->post('pendaftar/delete/(:segment)', 'AdminPendaftar::delete/$1');
    $routes->post('pendaftar/validate/(:segment)', 'AdminPendaftar::validateStudent/$1');
    $routes->get('pendaftar/tambah', 'AdminPendaftar::tambah');
    $routes->post('pendaftar/store', 'AdminPendaftar::store');

    $routes->get('daftar-ulang', 'AdminDaftarUlang::index');
    $routes->get('daftar-ulang/detail/(:segment)', 'AdminDaftarUlang::detail/$1');
    $routes->post('daftar-ulang/konfirmasi-pembayaran', 'AdminDaftarUlang::konfirmasiPembayaran');
    $routes->post('daftar-ulang/validasi-pembayaran', 'AdminDaftarUlang::validasiPembayaran');

    $routes->get('pengumuman', 'AdminPengumuman::index');
    $routes->post('pengumuman/create', 'AdminPengumuman::create');
    $routes->get('pengumuman/detail/(:segment)', 'AdminPengumuman::detail/$1');
    $routes->post('pengumuman/update/(:segment)', 'AdminPengumuman::update/$1');
    $routes->post('pengumuman/toggle-active/(:segment)', 'AdminPengumuman::toggleActive/$1');
    $routes->post('pengumuman/delete/(:segment)', 'AdminPengumuman::delete/$1');

    $routes->get('rekap-siswa', 'AdminRekapSiswa::index');
    $routes->get('rekap-siswa/data', 'AdminRekapSiswa::getStudentsData');
    $routes->get('rekap-siswa/summary', 'AdminRekapSiswa::getSummaryStats');
    $routes->get('rekap-siswa/export-excel', 'AdminRekapSiswa::exportExcel');
    $routes->get('rekap-siswa/export-pdf', 'AdminRekapSiswa::exportPdf');

    $routes->get('pengaturan', 'AdminSettings::index');

    $routes->get('settings/getTahunAjaran', 'AdminSettings::getTahunAjaran');
    $routes->post('settings/storeTahunAjaran', 'AdminSettings::storeTahunAjaran');
    $routes->post('settings/updateTahunAjaran/(:segment)', 'AdminSettings::updateTahunAjaran/$1');
    $routes->delete('settings/deleteTahunAjaran/(:segment)', 'AdminSettings::deleteTahunAjaran/$1');
    $routes->post('settings/activateTahunAjaran/(:segment)', 'AdminSettings::activateTahunAjaran/$1');

    $routes->get('settings/getKategori', 'AdminSettings::getKategori');
    $routes->post('settings/storeKategori', 'AdminSettings::storeKategori');
    $routes->post('settings/updateKategori/(:segment)', 'AdminSettings::updateKategori/$1');
    $routes->delete('settings/deleteKategori/(:segment)', 'AdminSettings::deleteKategori/$1');
    
    $routes->get('settings/getGelombang', 'AdminSettings::getGelombang');
    $routes->post('settings/storeGelombang', 'AdminSettings::storeGelombang');
    $routes->post('settings/updateGelombang/(:segment)', 'AdminSettings::updateGelombang/$1');
    $routes->delete('settings/deleteGelombang/(:segment)', 'AdminSettings::deleteGelombang/$1');
    
    $routes->get('profile', 'Auth::profile');
    
    $routes->get('students-data', 'Admin::getStudentsData');
    $routes->post('student/(:segment)/status', 'Admin::updateStudentStatus/$1');
    $routes->delete('student/(:segment)/delete', 'Admin::deleteStudent/$1');
    $routes->get('export-excel', 'Admin::exportExcel');
    $routes->get('export-pdf', 'Admin::exportPdf');
    
    $routes->delete('ppdb/student/(:segment)/delete', 'Ppdb::deleteStudent/$1');
    $routes->post('ppdb/student/(:segment)/status/(:segment)', 'Ppdb::updateStudentStatus/$1/$2');
    
    $routes->post('profile/update', 'Auth::updateProfile');
    $routes->post('profile/change-password', 'Auth::changePassword');
    $routes->post('profile/upload-photo', 'Auth::uploadPhoto');
});

$routes->get('admin', function() {
    return redirect()->to('/admin/dashboard');
});

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

$routes->set404Override('ErrorController::show404');
