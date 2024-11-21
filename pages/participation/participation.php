<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des participations</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<body>
<?php
include "../../includes/haut.inc.php";

$oParticipation = new Participation(null, null, null, null);
$ReqParticipation = $oParticipation->ParticipationAll();
?>

<h1>Ajouter une Participation</h1>
<form action="participation_traitement.php" method="POST">
    <input type="text" name="idcoursbase" placeholder="ID Cours Base" required>
    <input type="text" name="idcoursassociee" placeholder="ID Cours Associée" required>
    <input type="text" name="idcavalier" placeholder="ID Cavalier" required>
    <select name="present" required>
        <option value="1">Présent</option>
        <option value="0">Absent</option>
    </select>
    <input type="submit" value="Ajouter">
</form>

<h2>Liste des participations</h2>
<table id="ParticipationsTable" class="display">
    <thead>
        <tr>
            <th>ID Cours Base</th>
            <th>ID Cours Associée</th>
            <th>ID Cavalier</th>
            <th>Présent</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ReqParticipation as $uneParticipation): ?>
        <tr id="row-<?= $uneParticipation->getIdCoursbase() ?>-<?= $uneParticipation->getIdCoursassociee() ?>-<?= $uneParticipation->getIdCavalier() ?>">
            <td><?= htmlspecialchars($uneParticipation->getIdCoursbase()) ?></td>
            <td><?= htmlspecialchars($uneParticipation->getIdCoursassociee()) ?></td>
            <td><?= htmlspecialchars($uneParticipation->getIdCavalier()) ?></td>
            <td>
                <span class="static-field"><?= $uneParticipation->getPresent() ? 'Oui' : 'Non' ?></span>
                <select class="edit-field" name="present" style="display:none;">
                    <option value="1" <?= $uneParticipation->getPresent() ? 'selected' : '' ?>>Présent</option>
                    <option value="0" <?= !$uneParticipation->getPresent() ? 'selected' : '' ?>>Absent</option>
                </select>
            </td>
            <td>
                <button class="modifier-btn" data-id="<?= $uneParticipation->getIdCoursbase() ?>-<?= $uneParticipation->getIdCoursassociee() ?>-<?= $uneParticipation->getIdCavalier() ?>">Modifier</button>
                <button class="confirmer-btn" style="display:none;">Confirmer</button>
                <button class="annuler-btn" style="display:none;">Annuler</button>
            </td>
            <td>
                <form action="participation_traitement.php" method="POST" style='all:unset' onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette participation ?');">
                    <input type="hidden" name="supprimer_coursbase" value="<?= $uneParticipation->getIdCoursbase() ?>">
                    <input type="hidden" name="supprimer_coursassociee" value="<?= $uneParticipation->getIdCoursassociee() ?>">
                    <input type="hidden" name="supprimer_cavalier" value="<?= $uneParticipation->getIdCavalier() ?>">
                    <input type="submit" value="Supprimer" class="delete-btn">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#ParticipationsTable').DataTable();
    });

    // Gestionnaire de clic pour le bouton Modifier
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

    // Gestionnaire de clic pour le bouton Confirmer
    document.querySelectorAll('.confirmer-btn').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const ids = row.id.split('-');
            
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'participation_traitement.php';
            form.innerHTML = `
                <input type="hidden" name="idcoursbase" value="${ids[1]}">
                <input type="hidden" name="idcoursassociee" value="${ids[2]}">
                <input type="hidden" name="idcavalier" value="${ids[3]}">
                <input type="hidden" name="present" value="${row.querySelector('select[name="present"]').value}">
                <input type="hidden" name="action" value="modifier">
            `;
            document.body.appendChild(form);
            form.submit();
        });
    });

    // Gestionnaire de clic pour le bouton Annuler
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