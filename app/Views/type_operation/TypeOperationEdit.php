<form action="/types-operation/<?= $type['id'] ?>" method="post">
    <label for="code">Code :</label>
    <input type="text" name="code" id="code" value="<?= $type['code'] ?>">
    <label for="libelle">Libellé :</label>
    <input type="text" name="libelle" id="libelle" value="<?= $type['libelle'] ?>">
    <button type="submit">Modifier</button>
</form>