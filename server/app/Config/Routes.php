<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Custom route to test the database connection
$routes->get('test_connection', 'TestConnection::index');