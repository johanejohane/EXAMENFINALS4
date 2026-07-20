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

// CRUD Types d'opération
$routes->get('types-operation', 'TypeOperationController::index');
$routes->get('types-operation/new', 'TypeOperationController::new');
$routes->post('types-operation', 'TypeOperationController::create');
$routes->get('types-operation/(:num)/edit', 'TypeOperationController::edit/$1');
$routes->post('types-operation/(:num)', 'TypeOperationController::update/$1');
$routes->post('types-operation/(:num)/delete', 'TypeOperationController::delete/$1');

// CRUD Barèmes de frais
$routes->get('baremes', 'BaremeFraisController::index');
$routes->get('baremes/new', 'BaremeFraisController::new');
$routes->post('baremes', 'BaremeFraisController::create');
$routes->get('baremes/(:num)/edit', 'BaremeFraisController::edit/$1');
$routes->post('baremes/(:num)', 'BaremeFraisController::update/$1');
$routes->post('baremes/(:num)/delete', 'BaremeFraisController::delete/$1');