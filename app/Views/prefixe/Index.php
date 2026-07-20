<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Liste des préfixes</h2>
    <a href="/prefixes/new">ajouter</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Préfixe</th>
            <th>Libellé</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($prefixes as $p) : ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= $p['prefixe'] ?></td>
                <td><?= $p['libelle'] ?></td>
                <td>
                    <a href="/prefixes/<?= $p['id'] ?>/edit">Modifier</a>
                    <form action="/prefixes/<?= $p['id'] ?>/delete" method="post" style="display:inline;">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>