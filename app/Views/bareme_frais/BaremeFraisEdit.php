<?php if (session('error')) : ?>
    <p style="color:red;"><?= session('error') ?></p>
<?php endif; ?>

<form action="/baremes/<?= $bareme['id'] ?>" method="post">
    <label for="type_operation_id">Type d'opération :</label>
    <select name="type_operation_id" id="type_operation_id">
        <?php foreach ($types as $t) : ?>
            <option value="<?= $t['id'] ?>" <?= $t['id'] == $bareme['type_operation_id'] ? 'selected' : '' ?>>
                <?= $t['libelle'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="montant_min">Montant min :</label>
    <input type="number" step="0.01" name="montant_min" id="montant_min" value="<?= $bareme['montant_min'] ?>" required>

    <label for="montant_max">Montant max (vide = illimité) :</label>
    <input type="number" step="0.01" name="montant_max" id="montant_max" value="<?= $bareme['montant_max'] ?>">

    <label for="frais">Frais :</label>
    <input type="number" step="0.01" name="frais" id="frais" value="<?= $bareme['frais'] ?>" required>

    <label for="frais_type">Type de frais :</label>
    <select name="frais_type" id="frais_type">
        <option value="fixe" <?= $bareme['frais_type'] == 'fixe' ? 'selected' : '' ?>>Fixe</option>
        <option value="pourcentage" <?= $bareme['frais_type'] == 'pourcentage' ? 'selected' : '' ?>>Pourcentage</option>
    </select>

    <button type="submit">Modifier</button>
</form>