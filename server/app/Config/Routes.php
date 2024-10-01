<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Custom route to test the database connection
$routes->setAutoRoute(false);
$routes->get('test_connection', 'TestConnection::index');
$routes->post('register', 'Register::index');
$routes->post('login', 'Login::index');
