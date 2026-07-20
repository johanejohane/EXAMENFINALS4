<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Situation des gains</title>
</head>
<body>
    <h2>Situation des gains via les frais</h2>
    <p><a href="/operateur">Retour a l'espace operateur</a></p>

    <form action="/gains" method="get">
        <label for="date_debut">Du :</label>
        <input type="date" name="date_debut" id="date_debut" value="<?= $date_debut ?>">
        <label for="date_fin">Au :</label>
        <input type="date" name="date_fin" id="date_fin" value="<?= $date_fin ?>">
        <button type="submit">Filtrer</button>
    </form>

    <h3>Repartition des frais</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>Type d'operation</th>
            <th>Nombre d'operations</th>
            <th>Frais conserves par l'operateur source</th>
            <th>Commissions pour les autres operateurs</th>
        </tr>
        <?php $totalFraisOperateur = 0; ?>
        <?php $totalCommissions = 0; ?>
        <?php foreach ($gains as $gain) : ?>
            <tr>
                <td><?= esc($gain['type_libelle']) ?></td>
                <td><?= $gain['nb_operations'] ?></td>
                <td><?= number_format((float) $gain['total_frais_operateur'], 2) ?> Ar</td>
                <td><?= number_format((float) $gain['total_commissions'], 2) ?> Ar</td>
            </tr>
            <?php $totalFraisOperateur += (float) $gain['total_frais_operateur']; ?>
            <?php $totalCommissions += (float) $gain['total_commissions']; ?>
        <?php endforeach; ?>
        <tr>
            <th colspan="2">Total general</th>
            <th><?= number_format($totalFraisOperateur, 2) ?> Ar</th>
            <th><?= number_format($totalCommissions, 2) ?> Ar</th>
        </tr>
    </table>

    <h3>Commissions a verser aux autres operateurs</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>Operateur destinataire</th>
            <th>Nombre de transferts</th>
            <th>Commission a verser</th>
        </tr>
        <?php if (empty($commissions)) : ?>
            <tr><td colspan="3">Aucune commission sur cette periode.</td></tr>
        <?php else : ?>
            <?php foreach ($commissions as $commission) : ?>
                <tr>
                    <td><?= esc($commission['operateur_nom']) ?></td>
                    <td><?= $commission['nb_transferts'] ?></td>
                    <td><?= number_format((float) $commission['total_commission'], 2) ?> Ar</td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>
