<form action="/operateurs/<?= $operateur['id'] ?>" method="post">
    <label for="nom">Nom:</label><input type="text" name="nom" id="nom" value="<?= $operateur['nom'] ?>">
    <label for="commission_transfert">Commission transfert (%):</label><input type="number" step="0.01" min="0" name="commission_transfert" id="commission_transfert" value="<?= $operateur['commission_transfert'] ?>">
    <button type="submit">Modifier</button>
</form>
