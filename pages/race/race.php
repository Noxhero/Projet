<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Race</title>
    
</head>
<body>

<?php
include '../../includes/haut.inc.php';
//SELECT BDD 
//RACE.PHP
$stmt = $con->query('SELECT idrace, librace FROM race WHERE afficher = 1');
$racetableaux= $stmt->fetchAll(PDO::FETCH_ASSOC);
$oRace = new Race(null, null);
$ReqRace = $oRace->selectRace();

?>

<h1>Créer une Race</h1>

<form action="race_traitement.php" method="post">

    <label for="nom">Nom de la race:</label>

    <input type="text" name="nom" required><br>

   

    <input type="submit">

</form>
<table id="RaceTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de la race</th> 
                <th>Modifier</th>
                <th>Supprimer</th>  
            </tr>
        </thead>
        <tbody>
        <?php foreach ($racetableaux as $racetableau) : ?>
    <tr id="row-<?= $racetableau['idrace'] ?>">
        <td><?= htmlspecialchars($racetableau['idrace']) ?></td>
        <td>
            <span class="static-field"><?= htmlspecialchars($racetableau['librace']) ?></span>
            <input type="text" class="edit-field" name="librace" value="<?= htmlspecialchars($racetableau['librace']) ?>" style="display:none;">
        </td>
        
        <td>
            <button id='modifier' class="modifier-btn" data-id="<?= $racetableau['idrace'] ?>">Modifier</button>
            <button id='modifier' class="confirmer-btn" data-id="<?= $racetableau['idrace'] ?>" style="display:none;">Confirmer</button>
            <button class="annuler-btn" data-id="<?= $racetableau['idrace'] ?>" style="display:none;">Annuler</button>
        </td>
        <td>
        <form action="race_traitement.php" method="POST" style ='all:unset' onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cours?');">
                <input type="hidden" name="supprimer" value="<?= $racetableau['idrace'] ?>">
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
            $('#RaceTable').DataTable();
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
            const librace = row.querySelector('input[name="librace"]').value;
           

            // Créer un formulaire caché pour soumettre les données modifiées
            const form = document.createElement('form');
            form.action = 'race_traitement.php';
            form.method = 'POST';

            form.innerHTML = `
                <input type="hidden" name="idrace" id ="idrace" value="${id}">
                <input type="hidden" name="librace"id ="librace" value="${librace}">
               
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