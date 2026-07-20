<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Espace opérateur - Mobile Money</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('/') ?>">Mobile Money - Opérateur</a>
        <a href="<?= site_url('client/login') ?>" class="btn btn-sm btn-outline-light">Espace client</a>
    </div>
</nav>
<main class="container mb-5">
    <h1 class="h3 mb-4">Espace opérateur</h1>
    <div class="row g-3">
        <div class="col-md-6 col-lg-4"><a class="card text-decoration-none h-100 shadow-sm" href="<?= site_url('operateurs') ?>"><div class="card-body"><h2 class="h5 text-dark">Opérateurs</h2><p class="text-muted mb-0">Configurer les opérateurs et leurs préfixes.</p></div></a></div>
        <div class="col-md-6 col-lg-4"><a class="card text-decoration-none h-100 shadow-sm" href="<?= site_url('prefixes') ?>"><div class="card-body"><h2 class="h5 text-dark">Préfixes</h2><p class="text-muted mb-0">Configurer les préfixes valables.</p></div></a></div>
        <div class="col-md-6 col-lg-4"><a class="card text-decoration-none h-100 shadow-sm" href="<?= site_url('types-operation') ?>"><div class="card-body"><h2 class="h5 text-dark">Types d'opération</h2><p class="text-muted mb-0">Gérer dépôt, retrait et transfert.</p></div></a></div>
        <div class="col-md-6 col-lg-4"><a class="card text-decoration-none h-100 shadow-sm" href="<?= site_url('baremes') ?>"><div class="card-body"><h2 class="h5 text-dark">Barèmes de frais</h2><p class="text-muted mb-0">Modifier les tranches et les frais.</p></div></a></div>
        <div class="col-md-6 col-lg-4"><a class="card text-decoration-none h-100 shadow-sm" href="<?= site_url('gains') ?>"><div class="card-body"><h2 class="h5 text-dark">Situation des gains</h2><p class="text-muted mb-0">Consulter les frais de retrait et transfert.</p></div></a></div>
        <div class="col-md-6 col-lg-4"><a class="card text-decoration-none h-100 shadow-sm" href="<?= site_url('comptes') ?>"><div class="card-body"><h2 class="h5 text-dark">Comptes clients</h2><p class="text-muted mb-0">Consulter les comptes et leurs soldes.</p></div></a></div>
    </div>
</main>
</body>
</html>
