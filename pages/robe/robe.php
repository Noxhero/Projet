<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robe</title>
</head>
<body>

<?php
include '../../includes/haut.inc.php';
include_once '../../pages/robe/robe.class.php';
//SELECT BDD 
//ROBE.PHP
$stmt = $con->query('SELECT idrobe, librobe FROM robe');
$robetableaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
$oRobe = new Robe(null, null);
$ReqRobe = $oRobe->selectRobe();

?>

<h1>Créer une Robe</h1>

<form action="traitement_robe.php" method="post">
    <label for="nom">Nom de la robe:</label>
    <input type="text" name="nom" required><br>
    <input type="submit">
</form>

<table id="RobeTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom de la robe</th> 
            <th>Modifier</th>
            <th>Supprimer</th>  
        </tr>
    </thead>
    <tbody>
    <?php foreach ($robetableaux as $robetableau) : ?>
    <tr id="row-<?= $robetableau['idrobe'] ?>">
        <td><?= htmlspecialchars($robetableau['idrobe']) ?></td>
        <td>
            <span class="static-field"><?= htmlspecialchars($robetableau['librobe']) ?></span>
            <input type="text" class="edit-field" name="librobe" value="<?= htmlspecialchars($robetableau['librobe']) ?>" style="display:none;">
        </td>
        
        <td>
            <button id='modifier' class="modifier-btn" data-id="<?= $robetableau['idrobe'] ?>">Modifier</button>
            <button id='modifier' class="confirmer-btn" data-id="<?= $robetableau['idrobe'] ?>" style="display:none;">Confirmer</button>
            <button class="annuler-btn" data-id="<?= $robetableau['idrobe'] ?>" style="display:none;">Annuler</button>
        </td>
        <td>
            <form action="robe_traitement.php" method="POST" style='all:unset' onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette robe?');">
                <input type="hidden" name="supprimer" value="<?= $robetableau['idrobe'] ?>">
                <button type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    // Activation de DataTables sur la table
    $(document).ready(function() {
        $('#RobeTable').DataTable();
    });

    // Quand le bouton "Modifier" est cliqué
    document.querySelectorAll('.modifier-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);
            
            // Masquer les champs statiques et afficher les champs modifiables
            row.querySelectorAll('.static-field').forEach(field => field.style.display = 'none');
            row.querySelectorAll('.edit-field').forEach(field => field.style.display = 'inline');

            // Afficher les boutons "Confirmer" et "Annuler"
            row.querySelector('.modifier-btn').style.display = 'none';
            row.querySelector('.confirmer-btn').style.display = 'inline';
            row.querySelector('.annuler-btn').style.display = 'inline';
        });
    });

    // Quand le bouton "Confirmer" est cliqué
    document.querySelectorAll('.confirmer-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);
            
            // Récupérer les valeurs modifiées
            const librobe = row.querySelector('input[name="librobe"]').value;

            // Créer un formulaire caché pour soumettre les données modifiées
            const form = document.createElement('form');
            form.action = 'robe_traitement.php';
            form.method = 'POST';

            form.innerHTML = `
                <input type="hidden" name="idrobe" value="${id}">
                <input type="hidden" name="librobe" value="${librobe}">
                <input type="hidden" name="action" value="modifier">
            `;

            document.body.appendChild(form);
            form.submit();
        });
    });

    // Quand le bouton "Annuler" est cliqué
    document.querySelectorAll('.annuler-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);
            
            // Réinitialiser les champs modifiables et retourner aux champs statiques
            row.querySelectorAll('.static-field').forEach(field => field.style.display = 'inline');
            row.querySelectorAll('.edit-field').forEach(field => field.style.display = 'none');

            // Cacher les boutons "Confirmer" et "Annuler", afficher "Modifier"
            row.querySelector('.modifier-btn').style.display = 'inline';
            row.querySelector('.confirmer-btn').style.display = 'none';
            row.querySelector('.annuler-btn').style.display = 'none';
        });
    });
</script>

</body>
</html>
