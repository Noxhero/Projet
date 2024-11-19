<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de la Cavalerie</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <style>
        #CavalerieTable img {
            object-fit: cover;
            border-radius: 5px;
            display: block;
            margin: 0 auto;
        }
        
        #CavalerieTable td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
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
            <th>Photo</th>
            <th>Numéro SIRE</th>
            <th>Nom</th>
            <th>Date de Naissance</th>
            <th>Garot</th>
            <th>Robe</th>
            <th>Race</th>
            <th>Modifier</th>
            <th>Supprimer</th>
            <th>Lien de la photo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listeChevaux as $cheval) : 
            $photoUrl = $cheval->getPhoto();
        ?>
            <tr id="row-<?= $cheval->getNumsire() ?>">
                <td>
                    <?php if ($photoUrl): ?>
                        <img src="<?= htmlspecialchars($photoUrl) ?>" alt="Photo du cheval" style="max-width: 100px; max-height: 100px;">
                    <?php else: ?>
                        <span>Pas de photo</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($cheval->getNumsire()) ?></td>
                <td>
                    <span class="static-field"><?= htmlspecialchars($cheval->getNomcheval()) ?></span>
                    <input type="text" class="edit-field" name="nomcheval" value="<?= htmlspecialchars($cheval->getNomcheval()) ?>" style="display:none;">
                </td>
                <td>
                    <span class="static-field"><?= htmlspecialchars($cheval->getDatenaissancecheval()) ?></span>
                    <input type="date" class="edit-field" name="datenaissancecheval" value="<?= htmlspecialchars($cheval->getDatenaissancecheval()) ?>" style="display:none;">
                </td>
                <td>
                    <span class="static-field"><?= htmlspecialchars($cheval->getGarot()) ?></span>
                    <input type="number" class="edit-field" name="garot" value="<?= htmlspecialchars($cheval->getGarot()) ?>" style="display:none;">
                </td>
                <td><?= htmlspecialchars($cheval->getRobeLibelle($cheval->getIdrobe())) ?></td>
                <td><?= htmlspecialchars($cheval->getRaceLibelle($cheval->getIdrace())) ?></td>
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
                <td>
                    <?php
                    $photo = new Photo();
                    $photos = $photo->getPhotoByNumSire(0);
                    if (!empty($photos)) {
                        echo '<select class="photo-select" data-numsire="' . $cheval->getNumsire() . '">';
                        echo '<option value="">Sélectionner une photo</option>';
                        foreach ($photos as $photo) {
                            echo '<option value="' . $photo->getIdPhoto() . '">' . 
                                htmlspecialchars($photo->getnom_photo()) . 
                                '</option>';
                        }
                        echo '</select>';
                        echo '<button class="refresh-btn" data-numsire="' . $cheval->getNumsire() . '">Valider</button>';
                    } else {
                        echo '<p>Aucune photo disponible</p>';
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#CavalerieTable').DataTable({
            columnDefs: [
                {
                    targets: 0, // La colonne des photos (index 0)
                    width: '120px'
                }
            ]
        });
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
            const photo_url = row.querySelector('input[name="photo_url"]').value;

            const form = document.createElement('form');
            form.action = 'traitement.cavalerie.php';
            form.method = 'POST';

            form.innerHTML = `
                <input type="hidden" name="numsire" value="${id}">
                <input type="hidden" name="nomcheval" value="${nomcheval}">
                <input type="hidden" name="datenaissancecheval" value="${datenaissancecheval}">
                <input type="hidden" name="garot" value="${garot}">
                <input type="hidden" name="photo_url" value="${photo_url}">
                <input type="hidden" name="action" value="modifier">
            `;

            document.body.appendChild(form);
            form.submit();
        });
    });

    // Gestion des boutons d'ajout de photo
    document.querySelectorAll('.ajouter-photo-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);
            const photoUrl = row.querySelector('.photo-url').value;

            if (!photoUrl) {
                alert('Veuillez entrer une URL de photo valide');
                return;
            }

            const formData = new FormData();
            formData.append('numsire', id);
            formData.append('photo_url', photoUrl);
            formData.append('action', 'ajouter_photo');

            fetch('traitement.cavalerie.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert('Photo ajoutée avec succès');
                location.reload();
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors de l\'ajout de la photo');
            });
        });
    });

    $(document).ready(function() {
        $('.photo-select').on('change', function() {
            const numsire = $(this).data('numsire');
            const idphoto = $(this).val();
            if (!idphoto) return;

            $.ajax({
                url: 'traitement.cavalerie.php',
                method: 'POST',
                data: {
                    action: 'update_photo_numsire',
                    idphoto: idphoto,
                    numsire: numsire
                },
                success: function(response) {
                    
                        const data = JSON.parse(response);
                        if (data.success) {
                            // Recharge la page après la mise à jour
                        } else {
                            alert('Erreur lors de la mise à jour de la photo');
                            
                        }
                    
                }


            });
        });
    });

    $(document).ready(function() {
        // Gestionnaire pour les boutons refresh
        $('.refresh-btn').on('click', function() {
            const numsire = $(this).data('numsire');
            const selectElement = $(this).siblings('.photo-select');
            const idphoto = selectElement.val();
            
            if (!idphoto) {
                alert('Veuillez sélectionner une photo');
                return;
            }

            // Envoi de la requête AJAX simplifiée
            $.post('traitement.cavalerie.php', {
                action: 'update_photo_numsire',
                idphoto: idphoto,
                numsire: numsire
            }).always(function() {
                // Recharge la page dans tous les cas
                location.reload();
            });
        });
    });
</script>
</body>
</html> 
