<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des galops</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<body>
<?php
include "../../includes/haut.inc.php";

$oGalop = new Galop(null, null);
$ReqGalop = $oGalop->GalopAll();
?>

<h1>Ajouter un Galop</h1>
<form action="galop_traitement.php" method="POST">
    <label for="libgalop">Libellé du galop:</label>
    <input type="text" name="libgalop" placeholder="Libellé du galop" required><br>
    <input type="submit" value="Créer">
</form>

<h2>Liste des galops</h2>
<table id="GalopsTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Libellé</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ReqGalop as $unGalop): ?>
        <tr id="row-<?= $unGalop->getIdGalop() ?>">
            <td><?= htmlspecialchars($unGalop->getIdGalop()) ?></td>
            <td>
                <span class="static-field"><?= htmlspecialchars($unGalop->getLibGalop()) ?></span>
                <input type="text" class="edit-field" name="libgalop" 
                    value="<?= htmlspecialchars($unGalop->getLibGalop()) ?>" 
                    style="display:none;">
            </td>
            <td>
                <button class="modifier-btn" data-id="<?= $unGalop->getIdGalop() ?>">Modifier</button>
                <button class="confirmer-btn" data-id="<?= $unGalop->getIdGalop() ?>" style="display:none;">Confirmer</button>
                <button class="annuler-btn" data-id="<?= $unGalop->getIdGalop() ?>" style="display:none;">Annuler</button>
            </td>
            <td>
                <form action="galop_traitement.php" method="POST" style='all:unset' 
                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce galop ?');">
                    <input type="hidden" name="supprimer" value="<?= $unGalop->getIdGalop() ?>">
                    <input type="submit" value="Supprimer" class="delete-btn">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#GalopsTable').DataTable();
    });

    // Gestionnaire pour le bouton Modifier
    document.querySelectorAll('.modifier-btn').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            row.querySelectorAll('.static-field').forEach(field => field.style.display = 'none');
            row.querySelectorAll('.edit-field').forEach(field => field.style.display = 'inline');
            this.style.display = 'none';
            row.querySelector('.confirmer-btn').style.display = 'inline';
            row.querySelector('.annuler-btn').style.display = 'inline';
        });
    });

    // Gestionnaire pour le bouton Confirmer
    document.querySelectorAll('.confirmer-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);
            const libgalop = row.querySelector('input[name="libgalop"]').value;

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'galop_traitement.php';
            form.innerHTML = `
                <input type="hidden" name="idgalop" value="${id}">
                <input type="hidden" name="libgalop" value="${libgalop}">
                <input type="hidden" name="action" value="modifier">
            `;
            document.body.appendChild(form);
            form.submit();
        });
    });

    // Gestionnaire pour le bouton Annuler
    document.querySelectorAll('.annuler-btn').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            row.querySelectorAll('.static-field').forEach(field => field.style.display = 'inline');
            row.querySelectorAll('.edit-field').forEach(field => field.style.display = 'none');
            row.querySelector('.modifier-btn').style.display = 'inline';
            this.style.display = 'none';
            row.querySelector('.confirmer-btn').style.display = 'none';
        });
    });
</script>
</body>
</html> 