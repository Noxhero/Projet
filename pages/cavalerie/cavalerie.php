<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un cheval</title>
</head>
<body>
    <h2>Ajouter un cheval à la Cavalerie</h2>

    <form action="traitement_cavalerie.php" method="POST"> <!-- Assurez-vous que l'action pointe vers le bon fichier -->
        <label for="nomcheval">Nom du cheval :</label>
        <input type="text" id="nomcheval" name="nomcheval" required><br><br>

        <label for="datenaissancecheval">Date de naissance :</label>
        <input type="date" id="datenaissancecheval" name="datenaissancecheval" required><br><br>

        <label for="garot">Garrot (en cm) :</label>
        <input type="number" id="garot" name="garot" min="0" required><br><br>

        <label for="idrobe">Robe :</label>
        <input type="number" id="idrobe" name="idrobe" min="0" required><br><br>

        <label for="idrace">Race :</label>
        <input type="number" id="idrace" name="idrace" min="0" required><br><br>

        <button type="submit">Ajouter le cheval</button>
    </form>
</body>
</html>
