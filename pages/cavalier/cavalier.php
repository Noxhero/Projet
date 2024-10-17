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
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>
    <?php foreach($ReqCavalier as $unCavalier): ?>
    <tr>
        <tr>
            <form name="modifier" action="cavalier_traitement.php" method="POST">
                <!-- Affichage des données dans des inputs modifiables -->
                <td><input type="text" name="idcavalier" value="<?php echo $unCavalier->getIdCavalier(); ?>"></td>
                <td><input type="text" name="nomcavalier" value="<?php echo $unCavalier->getNomCavalier(); ?>"></td>
                <td><input type="text" name="prenomcavalier" value="<?php echo $unCavalier->getPrenomCavalier(); ?>"></td>
                <td><input type="date" name="datenaissancecavalier" value="<?php echo $unCavalier->getDateNaissanceCavalier(); ?>"></td>
                <td><input type="text" name="nomresponsable" value="<?php echo $unCavalier->getNomResponsable(); ?>"></td>
                <td><input type="text" name="rueresponsable" value="<?php echo $unCavalier->getRueResponsable(); ?>"></td>
                <td><input type="text" name="telresponsable" value="<?php echo $unCavalier->getTelResponsable(); ?>"></td>
                <td><input type="email" name="emailresponsable" value="<?php echo $unCavalier->getEmailResponsable(); ?>"></td>
                <td><input type="text" name="numlicence" value="<?php echo $unCavalier->getNumLicence(); ?>"></td>
                <td><input type="text" name="numassurance" value="<?php echo $unCavalier->getNumAssurance(); ?>"></td>
                <td><input type="text" name="idcommune" value="<?php echo $unCavalier->getIdCommune(); ?>"></td>
                <td><input type="text" name="idgalop" value="<?php echo $unCavalier->getIdGalop(); ?>"></td>
                
                <!-- Bouton Modifier -->
                <td><button name="modifier" id="modifier" type="submit" value="<?php echo $unCavalier->getIdCavalier(); ?>">Modifier</button></td>
                <td><button name="supprimer" id="supprimer" type="submit" value="<?php echo $unCavalier->getIdCavalier(); ?>">Supprimer</button></td>
            </form>
        </tr>
    </tr>
    <?php endforeach; ?>
</table>

<!-- Formulaire d'ajout (en dehors du tableau pour éviter tout problème) -->
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
    
    <!-- Bouton Ajouter -->
    <button type="submit" name="ajouter">Ajouter</button>
</form>


        </td>
    </tr>
</table>

</body>
</html>
