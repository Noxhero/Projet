<?php

include '../../includes/haut.inc.php';


// Ajout d'un nouveau cavalier
if (isset($_POST["nomcheval"]) && isset($_POST["datenaissancecheval"]) && isset($_POST["garot"])) {
    $nomcheval = $_POST["nomcheval"];
    $datenaissancecheval = $_POST["datenaissancecheval"];
    $garot = $_POST["garot"];
    $idrobe = $_POST["idrobe"];
    $idrace = $_POST["idrace"];

        

    $unCavalier = new Cavalerie(null, $nomcheval, $datenaissancecheval, $garot, $idrobe, $idrace);
    $unCavalier->insertCheval();
    
    header("Location: cavalerie.php");
    exit(); 
}
//Suppression d'un cavalier
if (isset($_POST["supprimer"])) {
    $idcavalerie = $_POST["supprimer"]; 
    $unCavalier = new Cavalerie($idcavalerie, null, null, null, null, null); 
    $unCavalier->DeleteCavalerie($idCavalier);
    
    header("Location: cavalerie.php");
    exit(); 
}
?>
