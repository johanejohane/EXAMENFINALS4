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