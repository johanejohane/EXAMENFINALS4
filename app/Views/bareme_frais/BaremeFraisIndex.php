<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Barèmes de frais</title>
</head>
<body>
    <h2>Barèmes de frais</h2>
    <a href="/baremes/new">ajouter</a>
    <table border="1" cellpadding="5">
        <tr>
            <th>Type d'opération</th>
            <th>Montant min</th>
            <th>Montant max</th>
            <th>Frais</th>
            <th>Type de frais</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($baremes as $b) : ?>
            <tr>
                <td><?= $b['type_libelle'] ?></td>
                <td><?= $b['montant_min'] ?></td>
                <td><?= $b['montant_max'] ?? 'illimité' ?></td>
                <td><?= $b['frais'] ?></td>
                <td><?= $b['frais_type'] ?></td>
                <td>
                    <a href="/baremes/<?= $b['id'] ?>/edit">Modifier</a>
                    <form action="/baremes/<?= $b['id'] ?>/delete" method="post" style="display:inline;">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>