<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Situation des gains</title>
</head>
<body>
    <h2>Situation des gains (retraits et transferts)</h2>

    <form action="/gains" method="get">
        <label for="date_debut">Du :</label>
        <input type="date" name="date_debut" id="date_debut" value="<?= $date_debut ?>">
        <label for="date_fin">Au :</label>
        <input type="date" name="date_fin" id="date_fin" value="<?= $date_fin ?>">
        <button type="submit">Filtrer</button>
    </form>

    <table border="1" cellpadding="5">
        <tr>
            <th>Type d'opération</th>
            <th>Nombre d'opérations</th>
            <th>Total des frais perçus</th>
        </tr>
        <?php $totalGeneral = 0; ?>
        <?php foreach ($gains as $g) : ?>
            <tr>
                <td><?= $g['type_libelle'] ?></td>
                <td><?= $g['nb_operations'] ?></td>
                <td><?= number_format($g['total_frais'], 2) ?></td>
            </tr>
            <?php $totalGeneral += $g['total_frais']; ?>
        <?php endforeach; ?>
        <tr>
            <th colspan="2">Total général</th>
            <th><?= number_format($totalGeneral, 2) ?></th>
        </tr>
    </table>
</body>
</html>