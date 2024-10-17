<?php
require_once 'robe_class.php'; // Inclure la classe Robe
require_once '../../includes/bdd.inc.php'; // Inclure la fonction de connexion à la base de données

// Récupérer toutes les robes
$robeObj = new Robe(null, null);
$robes = $robeObj->robeAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Robes</title>
    <link href="../../css/style.css" rel="stylesheet">
</head>
<body>
    <h1>Gestion des Robes</h1>

    <h2>Ajouter une Robe</h2>
    <form action="traitement_robe.php" method="POST">
        <input type="hidden" name="action" value="ajouter">
        <label for="librobe">Couleur de la Robe :</label>
        <input type="text" id="librobe" name="librove" required><br><br>
        <button type="submit">Ajouter une robe</button>
    </form>

    <h2>Liste des Robes</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Couleur</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($robes as $robe): ?>
            <tr>
                <td><?php echo $robe->getidrobe(); ?></td>
                <td><?php echo $robe->getlibrobe(); ?></td>
                <td>
                    <button type="button" onclick="showModifyForm(<?php echo $robe->getidrobe(); ?>, '<?php echo $robe->getlibrobe(); ?>')">Modifier</button>
                    <form action="traitement_robe.php" method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="supprimer">
                        <input type="hidden" name="idrobe" value="<?php echo $robe->getidrobe(); ?>">
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette robe ?');">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Formulaire de modification -->
    <div id="modifyForm" class="modify-form">
        <h2>Modifier une Robe</h2>
        <form action="traitement_robe.php" method="POST">
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" id="modifyId" name="idrobe" value="">
            <label for="modifyLibrobe">Nouvelle Couleur de la Robe :</label>
            <input type="text" id="modifyLibrobe" name="librove" required><br><br>
            <button type="submit">Modifier</button>
            <button type="button" onclick="hideModifyForm()">Annuler</button>
        </form>
    </div>

    <script>
        function showModifyForm(id, librobe) {
            document.getElementById('modifyId').value = id;
            document.getElementById('modifyLibrobe').value = librobe;
            document.getElementById('modifyForm').style.display = 'block';
        }

        function hideModifyForm() {
            document.getElementById('modifyForm').style.display = 'none';
        }
    </script>
</body>
</html>