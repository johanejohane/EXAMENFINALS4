<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mobile Money</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5">
    <div class="text-center mb-5">
        <h1>Mobile Money</h1>
        <p class="text-muted">Simulation d'un opérateur de mobile money</p>
    </div>
    <div class="row justify-content-center g-4">
        <div class="col-md-5">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center p-4">
                    <h2 class="h4">Espace client</h2>
                    <p class="text-muted">Consulter votre solde et effectuer vos opérations.</p>
                    <a href="<?= site_url('client/login') ?>" class="btn btn-primary">Accéder à l'espace client</a>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center p-4">
                    <h2 class="h4">Espace opérateur</h2>
                    <p class="text-muted">Configurer les services et consulter les situations.</p>
                    <a href="<?= site_url('operateur') ?>" class="btn btn-dark">Accéder à l'espace opérateur</a>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
