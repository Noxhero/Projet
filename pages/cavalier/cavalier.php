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

$oCavalier = new Cavalier(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
$ReqCavalier = $oCavalier->CavalierAll();
?>

<div class="container">
    <nav class="nav-menu">
        <button class="nav-btn active" data-target="create">🏇 Ajouter un Cavalier</button>
        <button class="nav-btn" data-target="list">📋 Liste des Cavaliers</button>
    </nav>

    <div id="create-section" class="section active">
        <h1>Ajouter un Cavalier</h1>
        <form action="cavalier_traitement.php" method="POST">
            <label for="nomcavalier">Nom du cavalier:</label>
            <input type="text" name="nomcavalier" placeholder="Nom du cavalier" required><br>
            <label for="prenomcavalier">Prénom du cavalier:</label>
            <input type="text" name="prenomcavalier" placeholder="Prénom du cavalier" required><br>
            <label for="datenaissancecavalier">Date de naissance du cavalier:</label>
            <input type="date" name="datenaissancecavalier" placeholder="Date de naissance" required><br>
            <label for="nomresponsable">Nom du responsable:</label>
            <input type="text" name="nomresponsable" placeholder="Nom du responsable"><br>
            <label for="rueresponsable">Rue du responsable:</label>
            <input type="text" name="rueresponsable" placeholder="Rue du responsable"><br>
            <label for="telresponsable">Téléphone du responsable:</label>
            <input type="text" name="telresponsable" placeholder="Téléphone du responsable"><br>
            <label for="emailresponsable">Email du responsable:</label>
            <input type="email" name="emailresponsable" placeholder="Email du responsable"><br>
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" placeholder="Mot de passe"><br>
            <label for="numlicence">Numéro de licence:</label>
            <input type="text" name="numlicence" placeholder="Numéro de licence"><br>
            <label for="numassurance">Numéro de l'assurance:</label>
            <input type="text" name="numassurance" placeholder="Numéro d'assurance"><br>
            <label for="nomcommune">Nom de la Commune et Code postal:</label>
<div class="content">
    <div class="input_container">
        <input type="text" name="nom_idcommune" id="nom_idcommune" placeholder="Commune" onkeyup="autocompletcommune()">
        <input type="text" name="cp" id="cp" placeholder="Code Postal">
        <input type="hidden" name="idcommune" id="idcommune">
        <ul id="nom_list_idcommune"></ul>
    </div>
</div>

            <label for="idgalop">Niveau de Galop:</label>
<div class="content">
    <div class="input_container">
        <input type="text" name='nomgalop' id="nom_idgalop" placeholder="Galop maitrisé" onkeyup="autocompletgalop()">
        <input type="hidden" name='idgalop' id="idgalop" value>
        <ul id="nom_list_idgalop"></ul>
    </div>
</div>

            <input type="submit" value="Créer">
        </form>
    </div>

    <div id="list-section" class="section">
        <h1>Liste des cavaliers</h1>
        <table id="CavaliersTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                    <th>Nom Responsable</th>
                    <th>Rue Responsable</th>
                    <th>Téléphone Responsable</th>
                    <th>Email Responsable</th>
                    <th>Numéro Licence</th>
                    <th>Numéro Assurance</th>
                    <th>ID Commune</th>
                    <th>ID Galop</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
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
                        <input type="text" class="edit-field" name="telresponsable" value="<?= htmlspecialchars($unCavalier->getTelResponsable()) ?>" style="display:none;">
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
                    <div class="content">
                        <div class="input_container">
                            <span class="static-field"><?= htmlspecialchars($unCavalier->nomCommune) ?></span>
                            <input type="text" class="edit-field" 
                                name="nom_idcommune21_<?= $unCavalier->getIdCavalier() ?>" 
                                id="nom_idcommune21_<?= $unCavalier->getIdCavalier() ?>" 
                                value="<?= htmlspecialchars($unCavalier->nomCommune) ?>" 
                                style="display:none;" 
                                onkeyup="autocompletcommune21('<?= $unCavalier->getIdCavalier() ?>')">
                            <input type="hidden" 
                                name="idcommune21" 
                                id="idcommune21_<?= $unCavalier->getIdCavalier() ?>" 
                                value="<?= $unCavalier->getIdCommune()->getIdCommune() ?>">
                            <ul id="nom_list_idcommune21_<?= $unCavalier->getIdCavalier() ?>" style="display:none;"></ul>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="content">
                        <div class="input_container">
                            <span class="static-field"><?= htmlspecialchars($unCavalier->nomGalop) ?></span>
                            <input type="text" class="edit-field" 
                                name="nom_idgalop22_<?= $unCavalier->getIdCavalier() ?>" 
                                id="nom_idgalop22_<?= $unCavalier->getIdCavalier() ?>" 
                                value="<?= htmlspecialchars($unCavalier->nomGalop) ?>" 
                                style="display:none;" 
                                onkeyup="autocompletgalop22('<?= $unCavalier->getIdCavalier() ?>')">
                            <input type="hidden" 
                                name="idgalop22" 
                                id="idgalop22_<?= $unCavalier->getIdCavalier() ?>" 
                                value="<?= $unCavalier->getIdGalop()->getIdGalop() ?>">
                            <ul id="nom_list_idgalop22_<?= $unCavalier->getIdCavalier() ?>" style="display:none;"></ul>
                        </div>
                    </div>
                </td>

                        <td>
                            <button class="modifier-btn" data-id="<?= $unCavalier->getIdCavalier() ?>">Modifier</button>
                            <button class="confirmer-btn" data-id="<?= $unCavalier->getIdCavalier() ?>" style="display:none;">Confirmer</button>
                            <button class="annuler-btn" data-id="<?= $unCavalier->getIdCavalier() ?>" style="display:none;">Annuler</button>
                        </td>
                        <td>
                            <form action="cavalier_traitement.php" method="POST" style='all:unset' onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cavalier ?');">
                                <input type="hidden" name="supprimer" value="<?= $unCavalier->getIdCavalier() ?>">
                                <input type="submit" value="Supprimer" class="delete-btn">
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
        $('#CavaliersTable').DataTable();
        
        // Gestion des onglets améliorée
        $('.nav-btn').click(function() {
            $('.nav-btn').removeClass('active');
            $(this).addClass('active');
            $('.section').removeClass('active');
            $('#' + $(this).data('target') + '-section').addClass('active');
        });
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
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);

            row.querySelectorAll('.static-field').forEach(field => field.style.display = 'none');
            row.querySelectorAll('.edit-field').forEach(field => field.style.display = 'inline');

            this.style.display = 'none';
            row.querySelector('.confirmer-btn').style.display = 'inline';
            row.querySelector('.annuler-btn').style.display = 'inline';
        });
    });
    
    document.querySelectorAll('.confirmer-btn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const row = document.getElementById('row-' + id);

        // Récupérer les valeurs modifiées
        const nomcavalier = row.querySelector('input[name="nomcavalier"]').value;
        const prenomcavalier = row.querySelector('input[name="prenomcavalier"]').value;
        const datenaissancecavalier = row.querySelector('input[name="datenaissancecavalier"]').value;
        const nomresponsable = row.querySelector('input[name="nomresponsable"]').value;
        const rueresponsable = row.querySelector('input[name="rueresponsable"]').value;
        const telresponsable = row.querySelector('input[name="telresponsable"]').value;
        const emailresponsable = row.querySelector('input[name="emailresponsable"]').value;
        const numlicence = row.querySelector('input[name="numlicence"]').value;
        const numassurance = row.querySelector('input[name="numassurance"]').value;
        const idcommune21 = row.querySelector('input[name="idcommune21"]').value;
        const idgalop22 = row.querySelector('input[name="idgalop22"]').value;

        // Soumettre via un formulaire caché
        const form = document.createElement('form');
        form.action = 'cavalier_traitement.php';
        form.method = 'POST';
        form.innerHTML = `
            <input type="hidden" name="idcavalier" value="${id}">
            <input type="hidden" name="nomcavalier" value="${nomcavalier}">
            <input type="hidden" name="prenomcavalier" value="${prenomcavalier}">
            <input type="hidden" name="datenaissancecavalier" value="${datenaissancecavalier}">
            <input type="hidden" name="nomresponsable" value="${nomresponsable}">
            <input type="hidden" name="rueresponsable" value="${rueresponsable}">
            <input type="hidden" name="telresponsable" value="${telresponsable}">
            <input type="hidden" name="emailresponsable" value="${emailresponsable}">
            <input type="hidden" name="numlicence" value="${numlicence}">
            <input type="hidden" name="numassurance" value="${numassurance}">
            <input type="hidden" name="idcommune" value="${idcommune21}">
            <input type="hidden" name="idgalop" value="${idgalop22}">
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
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);
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
