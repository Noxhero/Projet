<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de la Cavalerie</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<body>

<?php
include '../../includes/haut.inc.php';

// Récupérer la liste des chevaux
$oCavalerie = new Cavalerie(null, null, null, null, null, null);
$listeChevaux = $oCavalerie->selectChevaux();
?>

<h1>Ajouter un Cheval</h1>

<form action="traitement.cavalerie.php" method="POST">
    <label for="nomcheval">Nom du Cheval:</label>
    <input type="text" name="nomcheval" required><br>

    <label for="datenaissancecheval">Date de Naissance:</label>
    <input type="date" name="datenaissancecheval" required><br>

    <label for="garot">Garot:</label>
    <input type="text" name="garot" required><br>

    <label for="nomrobe">Robe :</label>
    <div class="content">
        <div class="input_container">
            <input type="text" name='nomrobe' id="nom_idrobe" placeholder="Robe du cheval" onkeyup="autocompletrobe()">
            <input type="hidden" name='idrobe' id="idrobe" >
            <ul id="nom_list_idrobe"></ul>
        </div>
    </div>

    <label for="nomrace">Race :</label>
    <div class="content">
        <div class="input_container">
            <input type="text" name='nomrace' id="nom_idrace" placeholder="Race du cheval" onkeyup="autocompletrace()">
            <input type="hidden" name='idrace' id="idrace" >
            <ul id="nom_list_idrace"></ul>
        </div>
    </div>

    <input type="submit" value="Ajouter">
</form>

<h2>Liste des Chevaux</h2>
<table id="CavalerieTable" class="display">
    <thead>
        <tr>
            <th>Numéro SIRE</th>
            <th>Nom</th>
            <th>Date de Naissance</th>
            <th>Garot</th>
            <th>ID Robe</th>
            <th>ID Race</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listeChevaux as $cheval) : ?>
            <tr id="row-<?= $cheval->getNumsire() ?>">
                <td><?= htmlspecialchars($cheval->getNumsire()) ?></td>
                <td>
                    <span class="static-field"><?= htmlspecialchars($cheval->getnomcheval()) ?></span>
                    <input type="text" class="edit-field" name="nomcheval" value="<?= htmlspecialchars($cheval->getnomcheval()) ?>" style="display:none;">
                </td>
                <td>
                    <span class="static-field"><?= htmlspecialchars($cheval->getdatenaissancecheval()) ?></span>
                    <input type="date" class="edit-field" name="datenaissancecheval" value="<?= htmlspecialchars($cheval->getdatenaissancecheval()) ?>" style="display:none;">
                </td>
                <td>
                    <span class="static-field"><?= htmlspecialchars($cheval->getgarot()) ?></span>
                    <input type="number" class="edit-field" name="garot" value="<?= htmlspecialchars($cheval->getgarot()) ?>" style="display:none;">
                </td>
                <td><?= htmlspecialchars($cheval->getidrobe()) ?></td>
                <td><?= htmlspecialchars($cheval->getidrace()) ?></td>
                <td>
                    <button class="modifier-btn" data-id="<?= $cheval->getNumsire() ?>">Modifier</button>
                    <button class="confirmer-btn" data-id="<?= $cheval->getNumsire() ?>" style="display:none;">Confirmer</button>
                    <button class="annuler-btn" data-id="<?= $cheval->getNumsire() ?>" style="display:none;">Annuler</button>
                </td>
                <td>
                    <form action="traitement.cavalerie.php" method="POST" style='all:unset' onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cheval?');">
                        <input type="hidden" name="supprimer" value="<?= $cheval->getNumsire() ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#CavalerieTable').DataTable();
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

    document.querySelectorAll('.confirmer-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);
            
            const nomcheval = row.querySelector('input[name="nomcheval"]').value;
            const datenaissancecheval = row.querySelector('input[name="datenaissancecheval"]').value;
            const garot = row.querySelector('input[name="garot"]').value;

            const form = document.createElement('form');
            form.action = 'traitement.cavalerie.php';
            form.method = 'POST';

            form.innerHTML = `
                <input type="hidden" name="numsire" value="${id}">
                <input type="hidden" name="nomcheval" value="${nomcheval}">
                <input type="hidden" name="datenaissancecheval" value="${datenaissancecheval}">
                <input type="hidden" name="garot" value="${garot}">
                <input type="hidden" name="action" value="modifier">
            `;

            document.body.appendChild(form);
            form.submit();
        });
    });
</script>

</body>
</html>
