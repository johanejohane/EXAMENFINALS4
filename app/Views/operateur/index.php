<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Opérateurs</title></head>
<body>
    <h2>Liste des opérateurs</h2>
    <a href="/operateur">Retour à l'espace opérateur</a>
    <a href="/operateurs/new">ajouter</a>
    <table>
        <tr><th>ID</th><th>Nom</th><th>Actions</th></tr>
        <?php foreach ($operateurs as $operateur) : ?>
            <tr>
                <td><?= $operateur['id'] ?></td>
                <td><?= $operateur['nom'] ?></td>
                <td>
                    <a href="/operateurs/<?= $operateur['id'] ?>/edit">Modifier</a>
                    <form action="/operateurs/<?= $operateur['id'] ?>/delete" method="post" style="display:inline;"><button type="submit">Supprimer</button></form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
