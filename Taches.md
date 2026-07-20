--004162--










---003925---
- bd
    - configuration de la base
    - structure de la partie opérateur
    - génération de donnée
- crud
    - préfixe
        - création routes 
            -$routes->get('prefixes', 'PrefixeController::index');
            $routes->get('prefixes/new', 'PrefixeController::new');
            $routes->post('prefixes', 'PrefixeController::create');
            $routes->get('prefixes/(:num)/edit', 'PrefixeController::edit/$1');
            $routes->post('prefixes/(:num)', 'PrefixeController::update/$1');
            $routes->post('prefixes/(:num)/delete', 'PrefixeController::delete/$1');

- model
    - prefixe
    
- controller
    - prefixeController 
        - methodes
            - new
            - create
            - edit
            - update
            - delete

- views
    - Index
    - Edit
    - Create


