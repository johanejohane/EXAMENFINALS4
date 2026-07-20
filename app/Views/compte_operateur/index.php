<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Situation des règlements opérateurs</title></head>
<body>
    <h2>Situation des montants à envoyer aux opérateurs</h2>
    <a href="/operateur">Retour à l'espace opérateur</a>
    <table>
        <tr><th>Opérateur</th><th>Solde de règlement</th><th>Montant à envoyer</th><th>Montant à recevoir</th></tr>
        <?php foreach ($comptes as $compte) : ?>
            <tr>
                <td><?= $compte['operateur_nom'] ?></td>
                <td><?= number_format((float) $compte['solde'], 0, ',', ' ') ?> Ar</td>
                <td><?= number_format(max((float) $compte['solde'], 0), 0, ',', ' ') ?> Ar</td>
                <td><?= number_format(max(-(float) $compte['solde'], 0), 0, ',', ' ') ?> Ar</td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
