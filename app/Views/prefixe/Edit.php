<form action="/prefixes/<?= $prefixe['id'] ?>" method="post">
    <label for="prefixe">Préfixe:</label><input type="text" name="prefixe" id="prefixe" value="<?= $prefixe['prefixe'] ?>">
    <label for="libelle">Libellé:</label><input type="text" name="libelle" id="libelle" value="<?= $prefixe['libelle'] ?>">
    <label for="operateur_id">Opérateur:</label>
    <select name="operateur_id" id="operateur_id">
        <?php foreach ($operateurs as $operateur) : ?>
            <option value="<?= $operateur['id'] ?>" <?= $operateur['id'] == $prefixe['operateur_id'] ? 'selected' : '' ?>><?= $operateur['nom'] ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Modifier</button>
</form>
