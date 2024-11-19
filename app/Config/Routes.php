<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('employee', function ($routes) {
    $routes->get('/', 'EmployeeController::index');
    $routes->post('store', 'EmployeeController::store');
    $routes->get('edit/(:segment)', 'EmployeeController::edit/$1');
    $routes->post('update/(:segment)', 'EmployeeController::update/$1');
    $routes->get('delete/(:segment)', 'EmployeeController::delete/$1');
});

$routes->group('item', function ($routes) {
    $routes->get('/', 'ItemController::index');
    $routes->post('store', 'ItemController::store');
    $routes->get('edit/(:segment)', 'ItemController::edit/$1');
    $routes->post('update/(:segment)', 'ItemController::update/$1');
    $routes->get('delete/(:segment)', 'ItemController::delete/$1');
});

$routes->group('sales', function ($routes) {
    $routes->get('/', 'SalesController::index');
    $routes->post('store', 'SalesController::store');
    $routes->get('edit/(:segment)', 'SalesController::edit/$1');
    $routes->post('update/(:segment)', 'SalesController::update/$1');
    $routes->get('delete/(:segment)', 'SalesController::delete/$1');
});
