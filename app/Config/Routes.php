<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Filter untuk admin
$routes->group('admin', ['filter' => 'isAdmin'], static function ($routes) {
    $routes->get('/user', 'Home::user');
});

// Filter untuk petugas
$routes->group('petugas', ['filter' => 'isPetugas'], static function ($routes) {
    //
});

// Rute yang dapat diakses oleh admin dan petugas
$routes->group('', ['filter' => 'isAdminOrPetugas'], static function ($routes) {
    $routes->get('/dashboard', 'Home::index');
    //kelola barang
    $routes->get('/barang', 'Barang::index');
    $routes->post('/barang/tambah', 'Barang::tambah');
    $routes->post('/barang/edit(:any)', 'Barang::edit/$1');
    $routes->delete('/barang/hapus/(:any)', 'Barang::hapus/$1');
    //kelola kategori
    $routes->get('/barang/generatepdf', 'Barang::generatepdf');
    $routes->get('/kategori', 'Kategori::index');
    $routes->post('/kategori/tambah', 'Kategori::tambah');
    $routes->post('/kategori/edit(:num)', 'Kategori::edit/$1');
    $routes->delete('/kategori/hapus/(:num)', 'Kategori::hapus/$1');
    
    $routes->group('penitipan', static function ($routes) {
        $routes->get('/', 'Penitipan::index');
        $routes->post('tambah', 'Penitipan::tambah');
        $routes->post('hapus/(:num)', 'Penitipan::hapus/$1');
        $routes->post('edit/(:num)', 'Penitipan::edit/$1');
    });
    $routes->group('pelanggan', static function ($routes) {
        $routes->get('/', 'Pelanggan::index');
        $routes->post('tambah', 'Pelanggan::tambah');
        $routes->post('hapus/(:num)', 'Pelanggan::hapus/$1');
        $routes->post('edit/(:num)', 'Pelanggan::edit/$1');
    });
    $routes->group('peminjaman', static function ($routes) {
        $routes->get('/', 'Peminjaman::index');
        $routes->post('tambah', 'Peminjaman::tambah');
        $routes->post('hapus/(:num)', 'Peminjaman::hapus/$1');
        $routes->post('edit/(:num)', 'Peminjaman::edit/$1');
    });
});

// Rute untuk login dan logout
$routes->get('/', 'Login::index');
$routes->post('/login', 'Login::login');
$routes->get('/logout', 'Login::logout');
