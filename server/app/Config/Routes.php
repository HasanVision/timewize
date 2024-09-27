<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Custom route to test the database connection
$routes->setAutoRoute(true);
$routes->get('test_connection', 'TestConnection::index');
$routes->post('register', 'AuthController::register');
$routes->post('login', 'AuthController::login');

// $routes->group('api', ['filter' => 'auth'], function($routes) {
//     $routes->get('user-profile', 'UserController::profile');
    // Add more protected routes here
// });