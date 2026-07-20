<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// CRUD Préfixes - tout en POST (pas de PUT/DELETE, non spoofés nativement en CI4)
$routes->get('prefixes', 'PrefixeController::index');
$routes->get('prefixes/new', 'PrefixeController::new');
$routes->post('prefixes', 'PrefixeController::create');
$routes->get('prefixes/(:num)/edit', 'PrefixeController::edit/$1');
$routes->post('prefixes/(:num)', 'PrefixeController::update/$1');
$routes->post('prefixes/(:num)/delete', 'PrefixeController::delete/$1');