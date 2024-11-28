<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de la Cavalerie</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="../../css/modal.css">
    
</head>
<body>

<div id="imageModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

<?php
include '../../includes/haut.inc.php';

// Récupérer la liste des chevaux
$oCavalerie = new Cavalerie(null, null, null, null, null, null);
$listeChevaux = $oCavalerie->selectChevaux();
?>

<h1>Ajouter un Cheval</h1>

<form action="traitement.cavalerie.php" method="POST" enctype="multipart/form-data" class="form-generic">
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

    <div class="form-group">
        <label for="nom_photo">Nom de la photo:</label>
        <input type="text" name="nom_photo" id="nom_photo" class="form-control" placeholder="Donnez un nom à la photo">
    </div>

    <div class="form-group">
        <label for="userfile">Fichier photo:</label>
        <input type="file" name="userfile" id="userfile" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
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
            <th>Nom de la photo</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listeChevaux as $cheval) : 
            $photoUrl = $cheval->getPhoto();
        ?>
            <tr id="row-<?= $cheval->getNumsire() ?>">
                <td>
                    <?php 
                        $photoUrl = $cheval->getPhoto();
                        // Debug: afficher le chemin brut
                        echo "<!-- Chemin de la photo: " . $photoUrl . " -->";
                        if ($photoUrl): 
                    ?>
                        <img src="<?= htmlspecialchars($photoUrl) ?>" 
                             alt="Photo du cheval" 
                             style="max-width: 100px; max-height: 100px; cursor: pointer;"
                             onerror="console.log('Erreur de chargement de l\'image:', '<?= htmlspecialchars($photoUrl) ?>');"
                             onclick="openModal(this.src)">
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
                <td data-idrobe="<?= $cheval->getIdrobe() ?>"><?= htmlspecialchars($cheval->getRobeLibelle($cheval->getIdrobe())) ?></td>
                <td data-idrace="<?= $cheval->getIdrace() ?>"><?= htmlspecialchars($cheval->getRaceLibelle($cheval->getIdrace())) ?></td>
                <td>
                    <span class="static-field">
                        <?php
                        $photo = new Photo();
                        $photos = $photo->getPhotoByNumSire($cheval->getNumsire());
                        if (!empty($photos)) {
                            foreach ($photos as $photo) {
                                // Enlever l'extension du fichier pour l'affichage
                                $nomSansExtension = pathinfo($photo->getnom_photo(), PATHINFO_FILENAME);
                                echo htmlspecialchars($nomSansExtension);
                                break;
                            }
                        } else {
                            echo 'Aucune photo disponible';
                        }
                        ?>
                    </span>
                    <span class="edit-field" style="display:none;">
                        <?php
                        // Récupérer toutes les photos disponibles
                        $photo = new Photo();
                        $allPhotos = $photo->getPhotoByNumSire(0); // 0 pour récupérer toutes les photos
                        if (!empty($allPhotos)) {
                            echo '<select class="photo-select" data-numsire="' . $cheval->getNumsire() . '">';
                            echo '<option value="">Sélectionner une photo</option>';
                            foreach ($allPhotos as $photo) {
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
                    </span>
                </td>
                <td>
                    <button class="modifier-btn" data-id="<?= $cheval->getNumsire() ?>">Modifier</button>
                    <button class="confirmer-btn" data-id="<?= $cheval->getNumsire() ?>" style="display:none;">Confirmer</button>
                    <button class="annuler-btn" data-id="<?= $cheval->getNumsire() ?>" style="display:none;">Annuler</button>
                </td>
                <td>
                    <form action="traitement.cavalerie.php" method="POST" style='all:unset' onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cheval?');">
                        <input type="hidden" name="supprimer" value="<?= $cheval->getNumsire() ?>">
                        <button class="supprimer-btn" type="submit">Supprimer</button>
                    </form>
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
            
            // Cacher tous les champs statiques et afficher les champs d'édition
            row.querySelectorAll('.static-field').forEach(field => field.style.display = 'none');
            row.querySelectorAll('.edit-field').forEach(field => field.style.display = 'inline');
   
            const currentIdrace = row.querySelector('td:nth-child(7)').getAttribute('data-idrace');

            const formData = {
                'numsire': id,
                'nomcheval': row.querySelector('input[name="nomcheval"]').value,
                'datenaissancecheval': row.querySelector('input[name="datenaissancecheval"]').value,
                'garot': row.querySelector('input[name="garot"]').value,
                'idrobe': currentIdrobe, // Utiliser la valeur actuelle
                'idrace': currentIdrace, // Utiliser la valeur actuelle
                'action': 'modifier'
            };

            // Créer le formulaire avec les données
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'traitement.cavalerie.php';

            // Ajouter les champs cachés
            Object.entries(formData).forEach(([key, value]) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = value;
                form.appendChild(input);
            });

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
                    try {
                        const data = JSON.parse(response);
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Erreur lors de la mise à jour de la photo');
                        }
                    } catch (e) {
                        console.error('Erreur de parsing JSON:', e);
                        alert('Erreur lors du traitement de la réponse');
                    }
                }
            });
        });
    });

    $(document).ready(function() {
        // Gestionnaire pour les boutons refresh (valider)
        $('.refresh-btn').on('click', function() {
            const numsire = $(this).data('numsire');
            const selectElement = $(this).siblings('.photo-select');
            const idphoto = selectElement.val();
            
            if (!idphoto) {
                alert('Veuillez sélectionner une photo');
                return;
            }

            $.ajax({
                url: 'traitement.cavalerie.php',
                method: 'POST',
                data: {
                    action: 'update_photo_numsire',
                    idphoto: idphoto,
                    numsire: numsire
                },
                success: function(response) {
                    try {
                        const data = JSON.parse(response);
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Erreur lors de la mise à jour de la photo');
                        }
                    } catch (e) {
                        console.error('Erreur de parsing JSON:', e);
                        alert('Erreur lors du traitement de la réponse');
                    }
                }
            });
        });
    });

    function openModal(imgSrc) {
        const modal = document.getElementById("imageModal");
        const modalImg = document.getElementById("modalImage");
        modal.style.display = "block";
        modalImg.src = imgSrc;
    }

    // Fermer avec le X
    document.querySelector(".close").onclick = function() {
        document.getElementById("imageModal").style.display = "none";
    }

    // Fermer en cliquant en dehors de l'image
    document.getElementById("imageModal").onclick = function(e) {
        if (e.target === this) {
            this.style.display = "none";
        }
    }
</script>
</body>
</html> 
