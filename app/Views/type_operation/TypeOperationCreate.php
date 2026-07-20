<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau type d'opération</title>
</head>
<body>
    <form action="/types-operation" method="post">
        <label for="code">Code (depot / retrait / transfert) :</label>
        <input type="text" name="code" id="code">
        <label for="libelle">Libellé :</label>
        <input type="text" name="libelle" id="libelle">
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>