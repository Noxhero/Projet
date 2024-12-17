<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des cavaliers</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <style>
        .section {
            display: none;
        }
        .section.active {
            display: block;
        }
        .nav-btn {
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
        }
        .nav-btn.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

<?php
include "../../includes/haut.inc.php";

$oCavalier = new Cavalier(null, null, null, null, null, null, null, null, null, null, null, null, null);
$ReqCavalier = $oCavalier->CavalierAll();
?>

<div class="container">
    <nav class="nav-menu">
        <button class="nav-btn" data-target="list">📋 Liste des Cavaliers</button>
        <button class="nav-btn active" data-target="create">➕ Ajouter un Cavalier</button>
    </nav>

    <div id="list-section" class="section">
        <h2>Liste des Cavaliers</h2>
        <table id="CavaliersTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Responsable</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Licence</th>
                    <th>Assurance</th>
                    <th>Commune</th>
                    <th>Galop</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($ReqCavalier as $unCavalier): ?>
                <tr id="row-<?= $unCavalier->getIdCavalier() ?>">
                    <td><?= htmlspecialchars($unCavalier->getIdCavalier()) ?></td>
                    <td>
                        <span class="static-field"><?= htmlspecialchars($unCavalier->getNomCavalier()) ?></span>
                        <input type="text" class="edit-field" name="nomcavalier" value="<?= htmlspecialchars($unCavalier->getNomCavalier()) ?>" style="display:none;">
                    </td>
                    <td>
                        <span class="static-field"><?= htmlspecialchars($unCavalier->getPrenomCavalier()) ?></span>
                        <input type="text" class="edit-field" name="prenomcavalier" value="<?= htmlspecialchars($unCavalier->getPrenomCavalier()) ?>" style="display:none;">
                    </td>
                    <td>
                        <span class="static-field"><?= htmlspecialchars($unCavalier->getDateNaissanceCavalier()) ?></span>
                        <input type="date" class="edit-field" name="datenaissancecavalier" value="<?= htmlspecialchars($unCavalier->getDateNaissanceCavalier()) ?>" style="display:none;">
                    </td>
                    <td>
                        <span class="static-field"><?= htmlspecialchars($unCavalier->getNomResponsable()) ?></span>
                        <input type="text" class="edit-field" name="nomresponsable" value="<?= htmlspecialchars($unCavalier->getNomResponsable()) ?>" style="display:none;">
                    </td>
                    <td>
                        <span class="static-field"><?= htmlspecialchars($unCavalier->getRueResponsable()) ?></span>
                        <input type="text" class="edit-field" name="rueresponsable" value="<?= htmlspecialchars($unCavalier->getRueResponsable()) ?>" style="display:none;">
                    </td>
                    <td>
                        <span class="static-field"><?= htmlspecialchars($unCavalier->getTelResponsable()) ?></span>
                        <input type="tel" class="edit-field" name="telresponsable" value="<?= htmlspecialchars($unCavalier->getTelResponsable()) ?>" style="display:none;">
                    </td>
                    <td>
                        <span class="static-field"><?= htmlspecialchars($unCavalier->getEmailResponsable()) ?></span>
                        <input type="email" class="edit-field" name="emailresponsable" value="<?= htmlspecialchars($unCavalier->getEmailResponsable()) ?>" style="display:none;">
                    </td>
                    <td>
                        <span class="static-field"><?= htmlspecialchars($unCavalier->getNumLicence()) ?></span>
                        <input type="text" class="edit-field" name="numlicence" value="<?= htmlspecialchars($unCavalier->getNumLicence()) ?>" style="display:none;">
                    </td>
                    <td>
                        <span class="static-field"><?= htmlspecialchars($unCavalier->getNumAssurance()) ?></span>
                        <input type="text" class="edit-field" name="numassurance" value="<?= htmlspecialchars($unCavalier->getNumAssurance()) ?>" style="display:none;">
                    </td>
                    <td>
                        <span class="static-field"><?= htmlspecialchars($unCavalier->getIdCommune()->getVille()) ?></span>
                        <input type="text" class="edit-field" name="idcommune" value="<?= htmlspecialchars($unCavalier->getIdCommune()->getVille()) ?>" style="display:none;">
                    </td>
                    <td>
                        <span class="static-field"><?= htmlspecialchars($unCavalier->getIdGalop()->getLibGalop()) ?></span>
                        <input type="text" class="edit-field" name="idgalop" value="<?= htmlspecialchars($unCavalier->getIdGalop()->getLibGalop()) ?>" style="display:none;">
                    </td>
                    <td>
                        <button class="modifier-btn" data-id="<?= $unCavalier->getIdCavalier() ?>">Modifier</button>
                        <button class="confirmer-btn" style="display:none;" data-id="<?= $unCavalier->getIdCavalier() ?>">Confirmer</button>
                        <button class="annuler-btn" style="display:none;">Annuler</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="create-section" class="section active">
        <h2>Ajouter un Cavalier</h2>
        <form action="cavalier_traitement.php" method="POST" class="form-generic">
            <label for="nomcavalier">Nom du cavalier:</label>
            <input type="text" id="nomcavalier" name="nomcavalier" required><br>
            
            <label for="prenomcavalier">Prénom du cavalier:</label>
            <input type="text" id="prenomcavalier" name="prenomcavalier" required><br>
            
            <label for="datenaissancecavalier">Date de naissance:</label>
            <input type="date" id="datenaissancecavalier" name="datenaissancecavalier" required><br>
            
            <label for="nomresponsable">Nom du responsable:</label>
            <input type="text" id="nomresponsable" name="nomresponsable" required><br>
            
            <label for="rueresponsable">Rue:</label>
            <input type="text" id="rueresponsable" name="rueresponsable" required><br>
            
            <label for="telresponsable">Téléphone:</label>
            <input type="tel" id="telresponsable" name="telresponsable" required><br>
            
            <label for="emailresponsable">Email:</label>
            <input type="email" id="emailresponsable" name="emailresponsable" required><br>
            
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required><br>
            
            <label for="numlicence">Numéro de licence:</label>
            <input type="text" id="numlicence" name="numlicence" required><br>
            
            <label for="numassurance">Numéro d'assurance:</label>
            <input type="text" id="numassurance" name="numassurance" required><br>
            
            <label for="idcommune">Commune:</label>
            <input type="text" id="nom_idcommune" name="nom_idcommune" onkeyup="autocompletcommune()" required>
            <div id="nom_list_idcommune"></div>
            <input type="hidden" id="idcommune" name="idcommune" required><br>
            
            <label for="idgalop">Galop:</label>
            <input type="text" id="nom_idgalop" name="nom_idgalop" onkeyup="autocompletgalop()" required>
            <div id="nom_list_idgalop"></div>
            <input type="hidden" id="idgalop" name="idgalop" required><br>

            <input type="hidden" name="action" value="ajouter">
            <input type="submit" value="Créer">
        </form>
    </div>
</div>

<script src="../../js/script.js"></script>
<script>
$(document).ready(function() {
    // Initialisation de DataTables
    $('#CavaliersTable').DataTable();
    
    // Gestion des onglets
    $('.nav-btn').on('click', function() {
        $('.nav-btn').removeClass('active');
        $(this).addClass('active');
        
        const target = $(this).data('target');
        $('.section').removeClass('active');
        $(`#${target}-section`).addClass('active');
    });

    // Gestion des boutons modifier
    $('.modifier-btn').on('click', function(e) {
        e.preventDefault();
        const row = $(this).closest('tr');
        row.find('.static-field').hide();
        row.find('.edit-field').show();
        $(this).hide();
        row.find('.confirmer-btn, .annuler-btn').show();
    });

    // Gestion des boutons annuler
    $('.annuler-btn').on('click', function(e) {
        e.preventDefault();
        const row = $(this).closest('tr');
        row.find('.static-field').show();
        row.find('.edit-field').hide();
        row.find('.modifier-btn').show();
        row.find('.confirmer-btn, .annuler-btn').hide();
    });

    // Gestion des boutons confirmer
    $('.confirmer-btn').on('click', function(e) {
        e.preventDefault();
        const row = $(this).closest('tr');
        const id = $(this).data('id');
        
        // Création du formulaire de modification
        const form = $('<form>', {
            action: 'cavalier_traitement.php',
            method: 'POST'
        });

        // Ajout des champs cachés
        form.append($('<input>', {
            type: 'hidden',
            name: 'action',
            value: 'modifier'
        }));
        
        form.append($('<input>', {
            type: 'hidden',
            name: 'idcavalier',
            value: id
        }));

        // Ajout de tous les champs modifiés
        row.find('.edit-field').each(function() {
            form.append($('<input>', {
                type: 'hidden',
                name: $(this).attr('name'),
                value: $(this).val()
            }));
        });

        // Soumission du formulaire
        $('body').append(form);
        form.submit();
    });
});
</script>
</body>
</html>
