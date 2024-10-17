
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours</title>
    
</head>
<body>

<?php
include '../../includes/haut.inc.php';

$oCours = new Cours(null, null,null,null,null);
$ReqCours = $oCours->selectCours();

?>

<h1>Créer un Cours</h1>

<form action="cour_traitement.php" method="post">

    <label for="nom">Nom du cours:</label>

    <input type="text" name="nom" required><br>

    <label for="debut">Début du cours:</label>

    <input type="time" name="debut" required><br>

    <label for="fin">Fin cours</label>

    <input type="time" name="fin" required><br>

    <label for="Jour">Jour du cours:</label>

    <input type="text" name="Jour" required><br>

   

    <input type="submit">

</form>
<table id="CoursTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom Cours</th>
                <th>Horaire Debut</th>
                <th>Horaire Fin</th>
                <th>Jour</th>  
                <th>Modifier</th>
                <th>Supprimer</th>  
            </tr>
        </thead>
        <tbody>
        <?php foreach ($courstableaux as $courstableau) : ?>
    <tr id="row-<?= $courstableau['idcours'] ?>">
        <td><?= htmlspecialchars($courstableau['idcours']) ?></td>
        <td>
            <span class="static-field"><?= htmlspecialchars($courstableau['libcours']) ?></span>
            <input type="text" class="edit-field" name="libcours" value="<?= htmlspecialchars($courstableau['libcours']) ?>" style="display:none;">
        </td>
        <td>
            <span class="static-field"><?= htmlspecialchars($courstableau['horairedebut']) ?></span>
            <input type="time" class="edit-field" name="horairedebut" value="<?= htmlspecialchars($courstableau['horairedebut']) ?>" style="display:none;">
        </td>
        <td>
            <span class="static-field"><?= htmlspecialchars($courstableau['horairefin']) ?></span>
            <input type="time" class="edit-field" name="horairefin" value="<?= htmlspecialchars($courstableau['horairefin']) ?>" style="display:none;">
        </td>
        <td>
            <span class="static-field"><?= htmlspecialchars($courstableau['jour']) ?></span>
            <input type="text" class="edit-field" name="jour" value="<?= htmlspecialchars($courstableau['jour']) ?>" style="display:none;">
        </td>
        <td>
            <button id='modifier' class="modifier-btn" data-id="<?= $courstableau['idcours'] ?>">Modifier</button>
            <button id='modifier' class="confirmer-btn" data-id="<?= $courstableau['idcours'] ?>" style="display:none;">Confirmer</button>
            <button class="annuler-btn" data-id="<?= $courstableau['idcours'] ?>" style="display:none;">Annuler</button>
        </td>
        <td>
        <form action="cour_traitement.php" method="POST" style ='all:unset' onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cours?');">
                <input type="hidden" name="supprimer" value="<?= $courstableau['idcours'] ?>">
                <button type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>

        </tbody>
    </table>
   
<script>
        // Activation de DataTables sur la table
        $(document).ready(function() {
            $('#CoursTable').DataTable();
        });

    // Quand le bouton "Modifier" est cliqué
    document.querySelectorAll('.modifier-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);
            
            // Masquer les champs statiques et afficher les champs modifiables
            row.querySelectorAll('.static-field').forEach(field => field.style.display = 'none');
            row.querySelectorAll('.edit-field').forEach(field => field.style.display = 'inline');

            // Afficher les boutons "Confirmer" et "Annuler"
            row.querySelector('.modifier-btn').style.display = 'none';
            row.querySelector('.confirmer-btn').style.display = 'inline';
            row.querySelector('.annuler-btn').style.display = 'inline';
        });
    });

    // Quand le bouton "Confirmer" est cliqué
    document.querySelectorAll('.confirmer-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);
            
            // Récupérer les valeurs modifiées
            const libcours = row.querySelector('input[name="libcours"]').value;
            const horairedebut = row.querySelector('input[name="horairedebut"]').value;
            const horairefin = row.querySelector('input[name="horairefin"]').value;
            const jour = row.querySelector('input[name="jour"]').value;

            // Créer un formulaire caché pour soumettre les données modifiées
            const form = document.createElement('form');
            form.action = 'cour_traitement.php';
            form.method = 'POST';

            form.innerHTML = `
                <input type="hidden" name="idcours" id ="idcours" value="${id}">
                <input type="hidden" name="libcours"id ="libcours" value="${libcours}">
                <input type="hidden" name="horairedebut" id ="horairedebut" value="${horairedebut}">
                <input type="hidden" name="horairefin" id ="horairefin" value="${horairefin}">
                <input type="hidden" name="jour" id ="jour" value="${jour}">
                <input type="hidden" name="action" value="modifier">
            `;

            document.body.appendChild(form);
            form.submit();
        });
    });

    // Quand le bouton "Annuler" est cliqué
    document.querySelectorAll('.annuler-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const row = document.getElementById('row-' + id);
            
            // Réinitialiser les champs modifiables et retourner aux champs statiques
            row.querySelectorAll('.static-field').forEach(field => field.style.display = 'inline');
            row.querySelectorAll('.edit-field').forEach(field => field.style.display = 'none');

            // Cacher les boutons "Confirmer" et "Annuler", afficher "Modifier"
            row.querySelector('.modifier-btn').style.display = 'inline';
            row.querySelector('.confirmer-btn').style.display = 'none';
            row.querySelector('.annuler-btn').style.display = 'none';
        });
    });
</script>
    


</body>
</html>
