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
    - configuration de la base
    - structure de la partie opérateur
    - génération de donnée
    - 
