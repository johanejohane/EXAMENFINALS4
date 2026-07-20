<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Situation des comptes clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-4">
    <a href="<?= site_url('operateur') ?>" class="btn btn-outline-secondary btn-sm mb-3">Retour à l'espace opérateur</a>
    <h1 class="h3">Situation des comptes clients</h1>
    <div class="card shadow-sm mt-3">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead><tr><th>Numéro</th><th>Nom</th><th class="text-end">Solde</th></tr></thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?= esc($client['numero']) ?></td>
                            <td><?= esc($client['nom'] ?? '-') ?></td>
                            <td class="text-end"><?= number_format((float) $client['solde'], 0, ',', ' ') ?> Ar</td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($clients)): ?>
                        <tr><td colspan="3" class="text-center text-muted py-3">Aucun compte client.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>
