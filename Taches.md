# Suivi du projet Mobile Money

## Livraison v1

### Etudiant 004162 - Espace client

- [x] Authentification automatique avec le numero de telephone, sans inscription prealable.
- [x] Creation automatique d'un compte client pour un numero valide inconnu.
- [x] Tableau de bord avec solde et dernieres operations.
- [x] Depot automatique.
- [x] Retrait automatique avec controle du solde et calcul des frais.
- [x] Transfert vers un autre client avec controle du solde et du numero destinataire.
- [x] Historique des transactions client.
- [x] Routes client et filtre d'authentification.
- [x] Vues client : connexion, tableau de bord, depot, retrait, transfert et historique.

### Etudiant 003925 - Espace operateur

- [x] Configuration des prefixes valables de l'operateur.
- [x] CRUD des prefixes.
- [x] CRUD des types d'operation : depot, retrait et transfert.
- [x] CRUD des baremes de frais par tranche de montant.
- [x] Calcul des frais fixes ou en pourcentage selon le bareme.
- [x] Controle du chevauchement des tranches de bareme.
- [x] Situation des gains issus des retraits et transferts, avec filtre par periode.
- [x] Situation des comptes clients.
- [x] Page d'accueil de l'espace operateur.

## Livraison v2

### Etudiant 004162 - Espace client

- [x] Option lors du transfert pour inclure le frais de retrait du destinataire.
- [x] Le frais de retrait inclus est credite au destinataire afin qu'il puisse retirer le montant demande.
- [x] Envoi multiple vers plusieurs numeros destinataires.
- [x] Repartition exacte du montant total entre les destinataires.
- [x] Calcul des frais, commissions et frais de retrait pour chaque part de l'envoi multiple.
- [x] Validation de tous les destinataires avant le debit du compte emetteur.
- [x] Creation d'une transaction par destinataire pour l'historique et les situations operateur.

### Etudiant 003925 - Espace operateur

- [x] Configuration des prefixes des autres operateurs.
- [x] Table `operateurs` et CRUD des operateurs.
- [x] Rattachement de chaque prefixe a un operateur.
- [x] Configuration du pourcentage de commission de transfert par operateur.
- [x] Tables `comptes_operateurs` et comptes de reglement crees automatiquement pour les nouveaux operateurs.
- [x] Enregistrement des operateurs source et destinataire dans les transactions de transfert.
- [x] Calcul de la commission pour l'operateur destinataire lors d'un transfert inter-operateur.
- [x] Mise a jour atomique des comptes de reglement lors des transferts inter-operateurs.
- [x] Montant de reglement egal au montant transfere, a la commission et au frais de retrait inclus eventuel.
- [x] Situation des montants a envoyer et a recevoir pour chaque operateur (`/reglements-operateurs`).
- [x] Situation des gains separee entre frais conserves par l'operateur source et commissions pour les autres operateurs.
- [x] Detail des commissions par operateur destinataire.

## Base de donnees commune

- [x] SQLite embarque configure.
- [x] Fichier unique `base.sql` a la racine : tables et donnees initiales.
- [x] Tables partagees : `clients` et `transactions`.
- [x] Tables operateur : `operateurs`, `prefixes`, `types_operation`, `baremes_frais` et `comptes_operateurs`.
- [x] Tracabilite des commissions et frais de retrait inclus dans les transactions.



