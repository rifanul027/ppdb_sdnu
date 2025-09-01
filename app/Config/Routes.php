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

// Other Routes
$routes->get('/fasilitas', 'Fasilitas::index');

// Admin Routes
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('pendaftar', 'Admin::pendaftar');
    $routes->get('rekap-siswa', 'Admin::rekapSiswa');
    $routes->get('settings', 'Admin::settings');
    $routes->get('settings/biaya', 'Admin::settingsBiaya');
    $routes->get('settings/pendaftaran', 'Admin::settingsPendaftaran');
    $routes->get('profile', 'Admin::profile');
    
    // API endpoints for admin
    $routes->post('settings/save', 'Admin::saveSettings');
    $routes->post('settings/biaya/(:any)', 'Admin::saveBiaya/$1');
    $routes->post('profile/update', 'Admin::updateProfile');
    $routes->post('profile/change-password', 'Admin::changePassword');
    $routes->post('profile/upload-photo', 'Admin::uploadPhoto');
});

// Default admin route redirect to dashboard
$routes->get('admin', function() {
    return redirect()->to('/admin/dashboard');
});
