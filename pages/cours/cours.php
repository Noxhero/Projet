<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Cours</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<body>

<?php
include '../../includes/haut.inc.php';

// Requête pour récupérer les cours
$oCours = new Cours(null, null, null, null, null);
$ReqCours = $oCours->selectCours();
?>

<h1>Créer un Cours</h1>

<form action="cour_traitement.php" method="POST">
    <label for="nom">Nom du cours:</label>
    <input type="text" name="nom" required><br>

    <label for="debut">Début du cours:</label>
    <input type="time" name="debut" required><br>

    <label for="fin">Fin du cours:</label>
    <input type="time" name="fin" required><br>

    <label for="Jour">Jour du cours:</label>
    <input type="text" name="Jour" required><br>

    <input type="submit" value="Créer">
</form>

<h2>Liste des Cours</h2>
<table id="CoursTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom Cours</th>
            <th>Horaire Début</th>
            <th>Horaire Fin</th>
            <th>Jour</th>  
            <th>Modifier</th>
            <th>Supprimer</th>  
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ReqCours as $courstableau) : ?>
            <tr id="row-<?= $courstableau->getIdCours() ?>">
                <td><?= htmlspecialchars($courstableau->getIdCours()) ?></td>
                <td>
                    <span class="static-field"><?= htmlspecialchars($courstableau->getLibCours()) ?></span>
                    <input type="text" class="edit-field" name="libcours" value="<?= htmlspecialchars($courstableau->getLibCours()) ?>" style="display:none;">
                </td>
                <td>
                    <span class="static-field"><?= htmlspecialchars($courstableau->getHoraireDebut()) ?></span>
                    <input type="datetime-local" class="edit-field" name="horairedebut" value="<?= $courstableau->getHoraireDebut() ?>" style="display:none;">
                </td>
                <td>
                    <span class="static-field"><?= htmlspecialchars($courstableau->getHoraireFin()) ?></span>
                    <input type="datetime-local" class="edit-field" name="horairefin" value="<?= $courstableau->getHoraireFin() ?>" style="display:none;">
                </td>
                <td>
                    <span class="static-field"><?= htmlspecialchars($courstableau->getJour()) ?></span>
                    <input type="text" class="edit-field" name="jour" value="<?= htmlspecialchars($courstableau->getJour()) ?>" style="display:none;">
                </td>
                <td>
                    <button id="modifier" class="modifier-btn" data-id="<?= $courstableau->getIdCours() ?>">Modifier</button>
                    <button class="confirmer-btn" data-id="<?= $courstableau->getIdCours() ?>" style="display:none;">Confirmer</button>
                    <button class="annuler-btn" data-id="<?= $courstableau->getIdCours() ?>" style="display:none;">Annuler</button>
                </td>
                <td>
                    <form action="cour_traitement.php" method="POST" style='all:unset' onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cours?');">
                        <input type="hidden" name="supprimer" value="<?= $courstableau->getIdCours() ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#CoursTable').DataTable();
    });

    document.querySelectorAll('.modifier-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);
            row.querySelectorAll('.static-field').forEach(field => field.style.display = 'none');
            row.querySelectorAll('.edit-field').forEach(field => field.style.display = 'inline');
            row.querySelector('.modifier-btn').style.display = 'none';
            row.querySelector('.confirmer-btn').style.display = 'inline';
            row.querySelector('.annuler-btn').style.display = 'inline';
        });
    });
    document.querySelectorAll('.confirmer-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);

            // Récupérer les valeurs modifiées
            const libcours = row.querySelector('input[name="libcours"]').value;
            const horairedebut = row.querySelector('input[name="horairedebut"]').value;
            const horairefin = row.querySelector('input[name="horairefin"]').value;
            const jour = row.querySelector('input[name="jour"]').value;

            // Soumettre via un formulaire caché
            const form = document.createElement('form');
            form.action = 'cour_traitement.php';
            form.method = 'POST';
            form.innerHTML = `
                <input type="hidden" name="idcours" value="${id}">
                <input type="hidden" name="libcours" value="${libcours}">
                <input type="hidden" name="horairedebut" value="${horairedebut}">
                <input type="hidden" name="horairefin" value="${horairefin}">
                <input type="hidden" name="jour" value="${jour}">
                <input type="hidden" name="action" value="modifier">
            `;
            document.body.appendChild(form);
            form.submit();
        });
    });


    document.querySelectorAll('.annuler-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);
            row.querySelectorAll('.static-field').forEach(field => field.style.display = 'inline');
            row.querySelectorAll('.edit-field').forEach(field => field.style.display = 'none');
            row.querySelector('.modifier-btn').style.display = 'inline';
            row.querySelector('.confirmer-btn').style.display = 'none';
            row.querySelector('.annuler-btn').style.display = 'none';
        });
    });
</script>

</body>
</html>
