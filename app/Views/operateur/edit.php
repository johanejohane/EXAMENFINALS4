<form action="/operateurs/<?= $operateur['id'] ?>" method="post">
    <label for="nom">Nom:</label><input type="text" name="nom" id="nom" value="<?= $operateur['nom'] ?>">
    <button type="submit">Modifier</button>
</form>
