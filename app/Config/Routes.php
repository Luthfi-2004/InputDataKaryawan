<?php
// app/Config/Routes.php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'DashboardController::index');

// Dashboard Routes
$routes->group('dashboard', function($routes) {
    $routes->get('/', 'DashboardController::index');
});

// Karyawan Routes
$routes->group('karyawan', function($routes) {
    $routes->get('/', 'KaryawanController::index');
    $routes->get('create', 'KaryawanController::create');
    $routes->post('store', 'KaryawanController::store');
    $routes->get('show/(:num)', 'KaryawanController::show/$1');
    $routes->get('edit/(:num)', 'KaryawanController::edit/$1');
    $routes->post('update/(:num)', 'KaryawanController::update/$1');
    $routes->get('delete/(:num)', 'KaryawanController::delete/$1');  // FIX: Ubah ke GET untuk JavaScript confirm
});

// Department Routes
$routes->group('department', function($routes) {
    $routes->get('/', 'DepartmentController::index');
    $routes->get('create', 'DepartmentController::create');
    $routes->post('store', 'DepartmentController::store');
    $routes->get('edit/(:num)', 'DepartmentController::edit/$1');
    $routes->post('update/(:num)', 'DepartmentController::update/$1');
    $routes->post('delete/(:num)', 'DepartmentController::delete/$1');  // FIX: Ganti GET ke POST
});

// Jabatan Routes
$routes->group('jabatan', function($routes) {
    $routes->get('/', 'JabatanController::index');
    $routes->get('create', 'JabatanController::create');
    $routes->post('store', 'JabatanController::store');
    $routes->get('edit/(:num)', 'JabatanController::edit/$1');
    $routes->post('update/(:num)', 'JabatanController::update/$1');
    $routes->post('delete/(:num)', 'JabatanController::delete/$1');  // FIX: Ganti GET ke POST
});

// Cuti Routes
$routes->group('cuti', function($routes) {
    $routes->get('/', 'CutiController::index');
    $routes->get('create', 'CutiController::create');
    $routes->post('store', 'CutiController::store');
    $routes->get('show/(:num)', 'CutiController::show/$1');
    $routes->get('edit/(:num)', 'CutiController::edit/$1');
    $routes->post('update/(:num)', 'CutiController::update/$1');
    $routes->post('approve/(:num)', 'CutiController::approve/$1');
    $routes->post('reject/(:num)', 'CutiController::reject/$1');
    $routes->post('delete/(:num)', 'CutiController::delete/$1');  // FIX: Ganti GET ke POST
});

// User Management Routes (optional)
$routes->group('users', function($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->post('delete/(:num)', 'UserController::delete/$1');  // FIX: Ganti GET ke POST
});