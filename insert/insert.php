<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des inscriptions</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<body>

<?php
include "../../includes/haut.inc.php";

$oInserer = new Inserer(null, null);
$ReqInserer = $oInserer->InsererAll();
?>

<h1>Ajouter une inscription</h1>
<form action="insert_traitement.php" method="POST">
    
    

    <label for="cours">Cours :</label>
    <div class="content">
        <div class="input_container">
            <input type="text" name='nomcours' id="nom_idcours" placeholder="nom du cours" onkeyup="autocompletCours()">
            <input type="hidden" name='idcours' id="idcours" >
            <ul id="nom_list_idcours"></ul>
        </div>
    </div>
    
    <label for="idcavalier">ID du cavalier:</label>
    <input type="text" name="idcavalier" placeholder="ID du cavalier" required><br>
    <input type="submit" value="Créer">
</form>

<h1>Liste des inscriptions</h1>
<table id="InsererTable" class="display">
    <thead>
        <tr>
            <th>ID Cours</th>
            <th>ID Cavalier</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ReqInserer as $unInserer): ?>
        <tr id="row-<?= $unInserer->getIdCours() ?>-<?= $unInserer->getIdCavalier() ?>">
            <td>
                <div class="content">
                    <div class="input_container">
                        <span class="static-field"><?= htmlspecialchars($unInserer->getIdCours()) ?></span>
                        <input type="text" class="edit-field" 
                            name="nom_idcours21_<?= $unInserer->getIdCours() ?>" 
                            id="nom_idcours21_<?= $unInserer->getIdCours() ?>" 
                            value="<?= htmlspecialchars($unInserer->getIdCours()) ?>" 
                            style="display:none;" 
                            onkeyup="autocompletcours21('<?= $unInserer->getIdCours() ?>')">
                        <input type="hidden" name="idcours21" id="idcours21_<?= $unInserer->getIdCours() ?>">
                        <ul id="nom_list_idcours21_<?= $unInserer->getIdCours() ?>"></ul>
                    </div>
                </div>
            </td>
            <td>
                <div class="content">
                    <div class="input_container">
                        <span class="static-field"><?= htmlspecialchars($unInserer->getIdCavalier()) ?></span>
                        <input type="text" class="edit-field" 
                            name="nom_idcavalier22_<?= $unInserer->getIdCavalier() ?>" 
                            id="nom_idcavalier22_<?= $unInserer->getIdCavalier() ?>" 
                            value="<?= htmlspecialchars($unInserer->getIdCavalier()) ?>" 
                            style="display:none;" 
                            onkeyup="autocompletcavalier22('<?= $unInserer->getIdCavalier() ?>')">
                        <input type="hidden" name="idcavalier22" id="idcavalier22_<?= $unInserer->getIdCavalier() ?>">
                        <ul id="nom_list_idcavalier22_<?= $unInserer->getIdCavalier() ?>"></ul>
                    </div>
                </div>
            </td>
            <td>
                <button class="modifier-btn" data-idcours="<?= $unInserer->getIdCours() ?>" data-idcavalier="<?= $unInserer->getIdCavalier() ?>">Modifier</button>
                <button class="confirmer-btn" data-idcours="<?= $unInserer->getIdCours() ?>" data-idcavalier="<?= $unInserer->getIdCavalier() ?>" style="display:none;">Confirmer</button>
                <button class="annuler-btn" data-idcours="<?= $unInserer->getIdCours() ?>" data-idcavalier="<?= $unInserer->getIdCavalier() ?>" style="display:none;">Annuler</button>
            </td>
            <td>
                <form action="insert_traitement.php" method="POST" style='all:unset' onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette inscription ?');">
                    <input type="hidden" name="supprimer" value="<?= $unInserer->getIdCours() ?>-<?= $unInserer->getIdCavalier() ?>">
                    <input type="submit" value="Supprimer" class="delete-btn">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    // Activation de DataTables
    $(document).ready(function() {
        $('#InsererTable').DataTable();
    });

    // Gestionnaire de clic extérieur
    document.addEventListener('click', function(event) {
        const rows = document.querySelectorAll('tr[id^="row-"]');
        rows.forEach(row => {
            if (row.contains(event.target)) return;

            if (row.querySelector('.confirmer-btn').style.display === 'inline') {
                resetRow(row);
            }
        });
    });

    // Fonction pour réinitialiser une ligne
    function resetRow(row) {
        row.querySelector('.modifier-btn').style.display = 'inline';
        row.querySelector('.confirmer-btn').style.display = 'none';
        row.querySelector('.annuler-btn').style.display = 'none';
    }

    // Quand le bouton "Modifier" est cliqué
    document.querySelectorAll('.modifier-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
            const idcours = this.getAttribute('data-idcours');
            const idcavalier = this.getAttribute('data-idcavalier');
            const row = document.getElementById('row-' + idcours + '-' + idcavalier);

            row.querySelectorAll('.static-field').forEach(field => field.style.display = 'none');
            row.querySelectorAll('.edit-field').forEach(field => field.style.display = 'inline');

            this.style.display = 'none';
            row.querySelector('.confirmer-btn').style.display = 'inline';
            row.querySelector('.annuler-btn').style.display = 'inline';
        });
    });

    document.querySelectorAll('.confirmer-btn').forEach(button => {
        button.addEventListener('click', function() {
            const idcours = this.getAttribute('data-idcours');
            const idcavalier = this.getAttribute('data-idcavalier');
            const row = document.getElementById('row-' + idcours + '-' + idcavalier);

            // Récupérer les nouvelles valeurs depuis les champs cachés
            const newIdCours = row.querySelector('input[name="idcours21"]').value;
            const newIdCavalier = row.querySelector('input[name="idcavalier22"]').value;

            // Soumettre via un formulaire caché
            const form = document.createElement('form');
            form.action = 'insert_traitement.php';
            form.method = 'POST';
            form.innerHTML = `
                <input type="hidden" name="old_idcours" value="${idcours}">
                <input type="hidden" name="old_idcavalier" value="${idcavalier}">
                <input type="hidden" name="idcours" value="${newIdCours}">
                <input type="hidden" name="idcavalier" value="${newIdCavalier}">
                <input type="hidden" name="action" value="modifier">
            `;
            document.body.appendChild(form);
            form.submit();
        });
    });

    // Quand le bouton "Annuler" est cliqué
    document.querySelectorAll('.annuler-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
            const idcours = this.getAttribute('data-idcours');
            const idcavalier = this.getAttribute('data-idcavalier');
            const row = document.getElementById('row-' + idcours + '-' + idcavalier);
            resetRow(row);
        });
    });

    // Empêcher la propagation du clic dans les champs d'édition
    document.querySelectorAll('.edit-field').forEach(field => {
        field.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
</script>

</body>
</html>
