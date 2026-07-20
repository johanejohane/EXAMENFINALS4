--004162--
    --V1--
    -MODELS:
        -Creation de ClientModel: 
            fonction(findBynumero,crediter,debiter)
        -creation prefixeModel: 
            fonction(estValide)
        -creation TypeOperationModel: 
            foncton(getByCode)
        -creation BaremeFraisModel:
            fonction(calculerFrais)
        -creation TransactionModel:
            fonction(historiqueClient)
    Controllers:
        -AuthController 
            fonction(login,process,logout)
        -DashboardController
            fonctoion(index)
        -OperationController
            fonction(depot,depotProcess,retrait,retraitProcess,transfert,transfertProcess)
        -HistoriqueController
            fonction(index)
    filters:
        -ClientAuthFilter

    view :
    -Client
         -header.php,footer.php
        -login.php
        -dashboard.php,depot.php,retrait.php,transfert.php,historique.php

    -creation des routes pour les controllers










---003925---
- bd
    - configuration de la base (SQLite embarqué)
    - structure de la partie opérateur (prefixes, types_operation, baremes_frais)
    - structure des tables partagées (clients, transactions)
    - génération de données de base (préfixes 033/037, types depot/retrait/transfert)

- crud
    - préfixe
        - création routes
            ```
            $routes->get('prefixes', 'PrefixeController::index');
            $routes->post('prefixes', 'PrefixeController::create');
            $routes->get('prefixes/new', 'PrefixeController::new');
            $routes->get('prefixes/(:num)/edit', 'PrefixeController::edit/$1');
            $routes->post('prefixes/(:num)', 'PrefixeController::update/$1');
            $routes->post('prefixes/(:num)/delete', 'PrefixeController::delete/$1');
            ```
        - model
            - PrefixeModel
        - controller
            - PrefixeController
                - methodes
                    - index
                    - new
                    - create
                    - edit
                    - update
                    - delete
        - views
            - index
            - create
            - edit

    - types d'opération
        - création routes
            ```
            $routes->get('types-operation', 'TypeOperationController::index');
            $routes->get('types-operation/new', 'TypeOperationController::new');
            $routes->post('types-operation', 'TypeOperationController::create');
            $routes->get('types-operation/(:num)/edit', 'TypeOperationController::edit/$1');
            $routes->post('types-operation/(:num)', 'TypeOperationController::update/$1');
            $routes->post('types-operation/(:num)/delete', 'TypeOperationController::delete/$1');
            ```
        - model
            - TypeOperationModel
        - controller
            - TypeOperationController
                - methodes
                    - index
                    - new
                    - create
                    - edit
                    - update
                    - delete
        - views
            - TypeOperationIndex
            - TypeOperationCreate
            - TypeOperationEdit

    - barèmes de frais
        - création routes
            ```
            $routes->get('baremes', 'BaremeFraisController::index');
            $routes->get('baremes/new', 'BaremeFraisController::new');
            $routes->post('baremes', 'BaremeFraisController::create');
            $routes->get('baremes/(:num)/edit', 'BaremeFraisController::edit/$1');
            $routes->post('baremes/(:num)', 'BaremeFraisController::update/$1');
            $routes->post('baremes/(:num)/delete', 'BaremeFraisController::delete/$1');
            ```
        - model
            - BaremeFraisModel
                - méthode chevauche() : validation qu'une tranche de montant ne chevauche pas une tranche existante pour le même type d'opération
        - controller
            - BaremeFraisController
                - methodes
                    - index (liste jointe avec le libellé du type d'opération)
                    - new (formulaire avec liste déroulante des types d'opération)
                    - create (avec validation de chevauchement)
                    - edit
                    - update (avec validation de chevauchement)
                    - delete
        - views
            - index
            - create
            - edit

- logique métier
    - FraisService (app/Libraries)
        - méthode calculer() : détermine le frais applicable selon le type d'opération et la tranche de montant (frais fixe ou pourcentage)
    - TransactionModel (table partagée avec le côté client)

- situation des gains
    - model
        - TransactionModel (lecture jointe avec types_operation)
    - controller
        - GainController
            - methodes
                - index (agrégation des frais par type d'opération, filtrable par période)
    - routes
        ```
        $routes->get('gains', 'GainController::index');
        ```
    - views
        - index (tableau des gains par type d'opération + total général, filtre par date)

- reste à faire
    - situation des comptes clients
    - tests de bout en bout avant le tag v1

