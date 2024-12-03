<?php

include '../../includes/haut.inc.php';


// Modification d'un cavalier
if (isset($_POST['action']) && $_POST['action'] === 'modifier') {
    $idCavalier = $_POST["idcavalier"];
    $nomCavalier = $_POST["nomcavalier"];
    $prenomCavalier = $_POST["prenomcavalier"];
    $dateNaissanceCavalier = $_POST["datenaissancecavalier"];
    $nomResponsable = $_POST["nomresponsable"];
    $rueResponsable = $_POST["rueresponsable"];
    $telResponsable = $_POST["telresponsable"];
    $emailResponsable = $_POST["emailresponsable"];
    $numLicence = $_POST["numlicence"];
    $numAssurance = $_POST["numassurance"];
    $idcommune = $_POST["idcommune"]; 
    $idGalop = $_POST["idgalop"];


    // Création du cavalier avec les bons paramètres
    $unCavalier = new Cavalier(
        $idCavalier,
        $nomCavalier,
        $prenomCavalier,
        $dateNaissanceCavalier,
        $nomResponsable,
        $rueResponsable,
        $telResponsable,
        $emailResponsable,
        null, // password n'est pas modifié lors d'une mise à jour
        $numLicence,
        $numAssurance,
        $idcommune,
        $idGalop
    );
    
    $unCavalier->UpdateCavalier();
    header('Location: cavalier.php');
    exit();
}

// Ajout d'un nouveau cavalier
if (isset($_POST["nomcavalier"]) && !isset($_POST['action'])) {
    $nomCavalier = $_POST["nomcavalier"];
    $prenomCavalier = $_POST["prenomcavalier"];
    $dateNaissanceCavalier = $_POST["datenaissancecavalier"];
    $nomResponsable = $_POST["nomresponsable"];
    $rueResponsable = $_POST["rueresponsable"];
    $telResponsable = $_POST["telresponsable"];
    $emailResponsable = $_POST["emailresponsable"];
    $password = $_POST["password"];
    $numLicence = $_POST["numlicence"];
    $numAssurance = $_POST["numassurance"];
    
    // Création des objets Commune et Galop
    $idcommune = $_POST["idcommune"]; 
    $commune = new Commune($idcommune, null, null);
    $idGalop = $_POST["idgalop"];
    $galop = new Galop($idGalop, null);

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $unCavalier = new Cavalier(
        null,
        $nomCavalier,
        $prenomCavalier,
        $dateNaissanceCavalier,
        $nomResponsable,
        $rueResponsable,
        $telResponsable,
        $emailResponsable,
        $hashed_password,
        $numLicence,
        $numAssurance,
        $commune,
        $galop
    );
    
    $unCavalier->InsertCavalier();
    header("Location: cavalier.php");
    exit(); 
}

// Suppression d'un cavalier
if (isset($_POST["supprimer"])) {
    $idCavalier = $_POST["supprimer"]; 
    $unCavalier = new Cavalier($idCavalier, null, null, null, null, null, null, null, null, null,null,null,null); 
    $unCavalier->DeleteCavalier($idCavalier);
    
    header("Location: cavalier.php");
    exit(); 
}

?>
