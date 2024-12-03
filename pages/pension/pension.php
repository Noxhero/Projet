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

<div class="container">
    <nav class="nav-menu">
        <button class="nav-btn active" data-target="create"> Créer une Pension</button>
        <button class="nav-btn" data-target="list">📊 Liste des Pensions</button>
    </nav>

    <div id="create-section" class="form-section section active">

        <h2>Ajouter une Pension</h2>
        <form action="pension_traitement.php" method="POST" class="form-generic">
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
    </div>

    <div id="list-section" class="table-section section">
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ReqPension as $pension) : ?>
                    <tr id="row-<?= $pension->getIdPension() ?>">
                        <td><?= htmlspecialchars($pension->getIdPension()) ?></td>
                        <td>
                            <span class="static-field"><?= htmlspecialchars($pension->getLibPension()) ?></span>
                            <input type="text" class="edit-field" name="libpension" value="<?= htmlspecialchars($pension->getLibPension()) ?>" style="display:none;">
                        </td>
                        <td>
                            <span class="static-field"><?= htmlspecialchars($pension->getTarifPension()) ?></span>
                            <input type="number" step="0.01" class="edit-field" name="tarifpension" value="<?= htmlspecialchars($pension->getTarifPension()) ?>" style="display:none;">
                        </td>
                        <td>
                            <span class="static-field"><?= htmlspecialchars($pension->getDateDebut()) ?></span>
                            <input type="date" class="edit-field" name="datedebut" value="<?= htmlspecialchars($pension->getDateDebut()) ?>" style="display:none;">
                        </td>
                        <td>
                            <span class="static-field"><?= htmlspecialchars($pension->getDateFin()) ?></span>
                            <input type="date" class="edit-field" name="datefin" value="<?= htmlspecialchars($pension->getDateFin()) ?>" style="display:none;">
                        </td>
                        <td>
                            <span class="static-field"><?= htmlspecialchars($pension->getNumSire()) ?></span>
                            <input type="text" class="edit-field" name="numsire" value="<?= htmlspecialchars($pension->getNumSire()) ?>" style="display:none;">
                        </td>
                        <td>
                            <button class="modifier-btn" data-id="<?= $pension->getIdPension() ?>">Modifier</button>
                            <button class="confirmer-btn" data-id="<?= $pension->getIdPension() ?>" style="display:none;">Confirmer</button>
                            <button class="annuler-btn" data-id="<?= $pension->getIdPension() ?>" style="display:none;">Annuler</button>
                            <form action="pension_traitement.php" method="POST" style='display:inline;' 
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette pension?');">
                                <input type="hidden" name="supprimer" value="<?= $pension->getIdPension() ?>">
                                <button type="submit" class="supprimer-btn">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#PensionsTable').DataTable();
    });

    // Gestion des onglets
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.nav-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.nav-btn').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.section').forEach(section => section.classList.remove('active'));
                button.classList.add('active');
                const target = button.getAttribute('data-target');
                document.getElementById(`${target}-section`).classList.add('active');
            });
        });
    });

    // Modification
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

    // Confirmation
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

    // Annulation
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