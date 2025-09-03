<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'About::index');
$routes->get('/contact', 'Contact::index');

// PPDB Routes
$routes->get('/ppdb', 'Ppdb::index');
$routes->get('/daftar', 'Ppdb::daftar');
$routes->get('/syarat', 'Ppdb::syarat');
$routes->get('/jadwal', 'Ppdb::jadwal');
$routes->get('/biaya', 'Ppdb::biaya');
$routes->get('/pengumuman', 'Ppdb::pengumuman');

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

// Other Routes
$routes->get('/fasilitas', 'Fasilitas::index');

// Admin Routes (Admin only)
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('pendaftar', 'Admin::pendaftar');
    $routes->get('rekap-siswa', 'Admin::rekapSiswa');
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

// Set custom 404 handler
$routes->set404Override('ErrorController::show404');
