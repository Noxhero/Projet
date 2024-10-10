<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des cavaliers</title>
</head>
<body>

<?php
include "../../includes/haut.inc.php";

$oCavalier = new Cavalier(null, null, null, null, 
null, null, null, 
null, null, null, null, 
null, null, null);
$ReqCavalier = $oCavalier->CavalierAll();
?>

<table>
    <tr>
        <th>ID Cavalier</th>
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
        <th>Actions</th>
    </tr>
    <?php foreach($ReqCavalier as $unCavalier): ?>
    <tr>
        <td><?php echo $unCavalier->getIdCavalier(); ?></td>
        <td>
            <form name="modifier" action="cavalier_traitement.php" method="POST">
                <input type="text" name="nomcavalier" value="<?php echo $unCavalier->getNomCavalier(); ?>">
                <input type="text" name="prenomcavalier" value="<?php echo $unCavalier->getPrenomCavalier(); ?>">
                <button name="modifier" type="submit" value="<?php echo $unCavalier->getIdCavalier(); ?>">Modifier</button>
            </form>
        </td>
        <td><?php echo $unCavalier->getDateNaissanceCavalier(); ?></td>
        <td><?php echo $unCavalier->getNomResponsable(); ?></td>
        <td><?php echo $unCavalier->getRueResponsable(); ?></td>
        <td><?php echo $unCavalier->getTelResponsable(); ?></td>
        <td><?php echo $unCavalier->getEmailResponsable(); ?></td>
        <td><?php echo $unCavalier->getNumLicence(); ?></td>
        <td><?php echo $unCavalier->getNumAssurance(); ?></td>
        <td><?php echo $unCavalier->getIdCommune(); ?></td>
        <td><?php echo $unCavalier->getIdGalop(); ?></td>
        <td>
            <form name="supprimer" action="cavalier_traitement.php" method="POST">
                <button name="supprimer" type="submit" value="<?php echo $unCavalier->getIdCavalier(); ?>">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="12">
            <form name="ajouter" action="cavalier_traitement.php" method="POST">
                <input type="text" name="nomcavalier" placeholder="Nom du cavalier">
                <input type="text" name="prenomcavalier" placeholder="Prénom du cavalier">
                <input type="date" name="datenaissancecavalier" placeholder="Date de naissance">
                <input type="text" name="nomresponsable" placeholder="Nom du responsable">
                <input type="text" name="rueresponsable" placeholder="Rue du responsable">
                <input type="text" name="telresponsable" placeholder="Téléphone du responsable">
                <input type="email" name="emailresponsable" placeholder="Email du responsable">
                <input type="password" name="password" placeholder="Mot de passe">
                <input type="text" name="numlicence" placeholder="Numéro de licence">
                <input type="text" name="numassurance" placeholder="Numéro d'assurance">
                <input type="text" name="idcommune" placeholder="ID de la commune">
                <input type="text" name="idgalop" placeholder="ID du galop">
                <button type="submit" name="ajouter">Ajouter</button>
            </form>
        </td>
    </tr>
</table>

</body>
</html>
