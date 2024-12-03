<?php
include '../../includes/haut.inc.php';
include 'evenement.class.php';

$evenements = Evenement::GetAllEvenements();
?>

<h1>Liste des Événements</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Commentaire</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($evenements as $evenement): ?>
            <tr>
                <td><?= htmlspecialchars($evenement->getIdEvenement()) ?></td>
                <td><?= htmlspecialchars($evenement->getTitreEvenement()) ?></td>
                <td><?= htmlspecialchars($evenement->getCommentaire()) ?></td>
                <td><button class="modifier-btn" data-id="<?= $evenement->getIdEvenement() ?>">Modifier</button></td>
                <td>
                    <form action="evenement_traitement.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                        <input type="hidden" name="supprimer" value="<?= $evenement->getIdEvenement() ?>">
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h1>Ajouter un Événement</h1>
<form action="evenement_traitement.php" method="POST">
    <label for="titreevenement">Titre de l'événement:</label>
    <input type="text" name="titreevenement" required><br>
    <label for="commentaire">Commentaire:</label>
    <textarea name="commentaire" required></textarea><br>
    <input type="hidden" name="action" value="ajouter">
    <input type="submit" value="Créer">
</form> 