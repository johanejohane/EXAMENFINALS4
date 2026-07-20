<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau barème de frais</title>
</head>
<body>
    <?php if (session('error')) : ?>
        <p style="color:red;"><?= session('error') ?></p>
    <?php endif; ?>

    <form action="/baremes" method="post">
        <label for="type_operation_id">Type d'opération :</label>
        <select name="type_operation_id" id="type_operation_id">
            <?php foreach ($types as $t) : ?>
                <option value="<?= $t['id'] ?>"><?= $t['libelle'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="montant_min">Montant min :</label>
        <input type="number" step="0.01" name="montant_min" id="montant_min" required>

        <label for="montant_max">Montant max (laisser vide = illimité) :</label>
        <input type="number" step="0.01" name="montant_max" id="montant_max">

        <label for="frais">Frais :</label>
        <input type="number" step="0.01" name="frais" id="frais" required>

        <label for="frais_type">Type de frais :</label>
        <select name="frais_type" id="frais_type">
            <option value="fixe">Fixe</option>
            <option value="pourcentage">Pourcentage</option>
        </select>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>