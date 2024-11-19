<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des pensions</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<body>
<?php
include "../../includes/haut.inc.php";

$oPension = new Pension(null, null, null, null, null, null);
$ReqPension = $oPension->PensionAll();
?>

<h1>Ajouter une Pension</h1>
<form action="pension_traitement.php" method="POST">
    <label for="libpension">Libellé:</label>
    <input type="text" name="libpension" required><br>

    <label for="tarifpension">Tarif:</label>
    <input type="number" step="0.01" name="tarifpension" required><br>

    <label for="datedebut">Date de début:</label>
    <input type="date" name="datedebut" required><br>

    <label for="datefin">Date de fin:</label>
    <input type="date" name="datefin" required><br>

    <label for="numsire">Cheval:</label>
    <div class="content">
        <div class="input_container">
            <input type="text" name="nom_cheval" id="nom_cheval" 
                placeholder="Nom du cheval" 
                onkeyup="autocompletCheval()">
            <input type="hidden" name="numsire" id="numsire">
            <ul id="nom_list_cheval" style="display:none;"></ul>
        </div>
    </div>

    <input type="submit" value="Créer">
</form>

<h2>Liste des pensions</h2>
<table id="PensionsTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Libellé</th>
            <th>Tarif</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>N° SIRE</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ReqPension as $unePension): ?>
        <tr id="row-<?= $unePension->getIdPension() ?>">
            <td><?= htmlspecialchars($unePension->getIdPension()) ?></td>
            <td>
                <span class="static-field"><?= htmlspecialchars($unePension->getLibPension()) ?></span>
                <input type="text" class="edit-field" name="libpension" 
                    value="<?= htmlspecialchars($unePension->getLibPension()) ?>" 
                    style="display:none;">
            </td>
            <td>
                <span class="static-field"><?= htmlspecialchars($unePension->getTarifPension()) ?></span>
                <input type="number" step="0.01" class="edit-field" name="tarifpension" 
                    value="<?= htmlspecialchars($unePension->getTarifPension()) ?>" 
                    style="display:none;">
            </td>
            <td>
                <span class="static-field"><?= htmlspecialchars($unePension->getDateDebut()) ?></span>
                <input type="date" class="edit-field" name="datedebut" 
                    value="<?= htmlspecialchars($unePension->getDateDebut()) ?>" 
                    style="display:none;">
            </td>
            <td>
                <span class="static-field"><?= htmlspecialchars($unePension->getDateFin()) ?></span>
                <input type="date" class="edit-field" name="datefin" 
                    value="<?= htmlspecialchars($unePension->getDateFin()) ?>" 
                    style="display:none;">
            </td>
            <td>
                <span class="static-field"><?= htmlspecialchars($unePension->getNomCheval()) ?></span>
                <div class="input_container">
                    <input type="text" class="edit-field" 
                        name="nom_cheval_<?= $unePension->getIdPension() ?>" 
                        id="nom_cheval_<?= $unePension->getIdPension() ?>" 
                        value="<?= htmlspecialchars($unePension->getNomCheval()) ?>" 
                        style="display:none;" 
                        onkeyup="autocompletCheval('<?= $unePension->getIdPension() ?>')">
                    <input type="hidden" 
                        name="numsire" 
                        id="numsire_<?= $unePension->getIdPension() ?>" 
                        value="<?= $unePension->getNumSire() ?>">
                    <ul id="nom_list_cheval_<?= $unePension->getIdPension() ?>" style="display:none;"></ul>
                </div>
            </td>
            <td>
                <button class="modifier-btn" data-id="<?= $unePension->getIdPension() ?>">Modifier</button>
                <button class="confirmer-btn" data-id="<?= $unePension->getIdPension() ?>" style="display:none;">Confirmer</button>
                <button class="annuler-btn" data-id="<?= $unePension->getIdPension() ?>" style="display:none;">Annuler</button>
            </td>
            <td>
                <form action="pension_traitement.php" method="POST" style='all:unset' 
                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette pension ?');">
                    <input type="hidden" name="supprimer" value="<?= $unePension->getIdPension() ?>">
                    <input type="submit" value="Supprimer" class="delete-btn">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#PensionsTable').DataTable();
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

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'pension_traitement.php';
            form.innerHTML = `
                <input type="hidden" name="idpension" value="${id}">
                <input type="hidden" name="libpension" value="${row.querySelector('input[name="libpension"]').value}">
                <input type="hidden" name="tarifpension" value="${row.querySelector('input[name="tarifpension"]').value}">
                <input type="hidden" name="datedebut" value="${row.querySelector('input[name="datedebut"]').value}">
                <input type="hidden" name="datefin" value="${row.querySelector('input[name="datefin"]').value}">
                <input type="hidden" name="numsire" value="${row.querySelector('input[name="numsire"]').value}">
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