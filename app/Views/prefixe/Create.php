<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Nouveau préfixe</title></head>
<body>
    <form action="/prefixes" method="post">
        <label for="prefixe">Préfixe:</label><input type="text" name="prefixe" id="prefixe">
        <label for="libelle">Libellé:</label><input type="text" name="libelle" id="libelle">
        <label for="operateur_id">Opérateur:</label>
        <select name="operateur_id" id="operateur_id">
            <?php foreach ($operateurs as $operateur) : ?>
                <option value="<?= $operateur['id'] ?>"><?= $operateur['nom'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
