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
