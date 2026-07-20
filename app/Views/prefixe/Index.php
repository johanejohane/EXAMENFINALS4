<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Préfixes</title></head>
<body>
    <h2>Liste des préfixes</h2>
    <a href="/operateur">Retour à l'espace opérateur</a>
    <a href="/operateurs">Gérer les opérateurs</a>
    <a href="/prefixes/new">ajouter</a>
    <table>
        <tr><th>ID</th><th>Préfixe</th><th>Libellé</th><th>Opérateur</th><th>Actions</th></tr>
        <?php foreach ($prefixes as $p) : ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= $p['prefixe'] ?></td>
                <td><?= $p['libelle'] ?></td>
                <td><?= $p['operateur_nom'] ?></td>
                <td>
                    <a href="/prefixes/<?= $p['id'] ?>/edit">Modifier</a>
                    <form action="/prefixes/<?= $p['id'] ?>/delete" method="post" style="display:inline;"><button type="submit">Supprimer</button></form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
