<form action="/prefixes/<?= $prefixe['id'] ?>" method="post">
    <label for="prefixe">Préfixe:</label>
    <input type="text" name="prefixe" id="prefixe" value="<?= $prefixe['prefixe'] ?>">
    <label for="libelle">Libellé:</label>
    <input type="text" name="libelle" id="libelle" value="<?= $prefixe['libelle'] ?>">
    <button type="submit">Modifier</button>
</form>