<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('employee', function ($routes) {
    $routes->get('/', 'EmployeeController::index');
    // $routes->get('create', 'EmployeeController::create');
    $routes->post('store', 'EmployeeController::store');
    $routes->get('edit/(:segment)', 'EmployeeController::edit/$1');
    $routes->post('update/(:segment)', 'EmployeeController::update/$1');
    $routes->get('delete/(:segment)', 'EmployeeController::delete/$1');
});
