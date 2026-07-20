<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Types d'opération</title>
</head>
<body>
    <h2>Liste des types d'opération</h2>
    <a href="/types-operation/new">ajouter</a>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Libellé</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($types as $t) : ?>
            <tr>
                <td><?= $t['id'] ?></td>
                <td><?= $t['code'] ?></td>
                <td><?= $t['libelle'] ?></td>
                <td>
                    <a href="/types-operation/<?= $t['id'] ?>/edit">Modifier</a>
                    <form action="/types-operation/<?= $t['id'] ?>/delete" method="post" style="display:inline;">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>