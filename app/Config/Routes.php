<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Page d'accueil : redirige directement vers le login client
$routes->get('/index', 'Client\AuthController::login');

// Groupe de routes pour l'espace client, préfixées par /client
$routes->group('client', function ($routes) {

    // Routes accessibles sans être connecté (login)
    $routes->get('login', 'Client\AuthController::login');    // affiche le formulaire
    $routes->post('login', 'Client\AuthController::process'); // traite la connexion
    $routes->get('logout', 'Client\AuthController::logout');  // déconnexion

    // Routes protégées par le filtre clientAuth : accessibles uniquement si connecté
    $routes->group('', ['filter' => 'clientAuth'], function ($routes) {

        // Tableau de bord (solde + dernières opérations)
        $routes->get('dashboard', 'Client\DashboardController::index');

        // Dépôt
        $routes->get('depot', 'Client\OperationController::depot');           // formulaire
        $routes->post('depot', 'Client\OperationController::depotProcess');   // traitement

        // Retrait
        $routes->get('retrait', 'Client\OperationController::retrait');
        $routes->post('retrait', 'Client\OperationController::retraitProcess');

        // Transfert
        $routes->get('transfert', 'Client\OperationController::transfert');
        $routes->post('transfert', 'Client\OperationController::transfertProcess');

        // Historique complet
        $routes->get('historique', 'Client\HistoriqueController::index');
    });
});
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

// Situation des gains
$routes->get('gains', 'GainController::index');

// Situation des comptes clients
$routes->get('comptes', 'CompteClientController::index');
