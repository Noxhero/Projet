<?php

include '../../includes/haut.inc.php';

// Modification d'une inscription
if (isset($_POST['action']) && $_POST['action'] === 'modifier') {
    $oldIdCours = $_POST["old_idcours"];
    $oldIdCavalier = $_POST["old_idcavalier"];
    $newIdCours = $_POST["idcours"];
    $newIdCavalier = $_POST["idcavalier"];
    
    // Supprimer l'ancienne inscription
    $unInserer = new Inserer($oldIdCours, $oldIdCavalier);
    $unInserer->DeleteInserer($oldIdCours, $oldIdCavalier);

    // Ajouter la nouvelle inscription
    $unInserer = new Inserer($newIdCours, $newIdCavalier);
    $unInserer->InsertInserer();
    header('Location: insert.php');
    exit();
}

// Ajout d'une nouvelle inscription
if (isset($_POST["idcours"]) && !isset($_POST['action'])) {
    $idCours = $_POST["idcours"];
    $idCavalier = $_POST["idcavalier"];

    $unInserer = new Inserer($idCours, $idCavalier);
    $unInserer->InsertInserer();
    header("Location: insert.php");
    exit();
}

// Suppression d'une inscription
if (isset($_POST["supprimer"])) {
    list($idCours, $idCavalier) = explode('-', $_POST["supprimer"]);
    $unInserer = new Inserer($idCours, $idCavalier);
    $unInserer->DeleteInserer($idCours, $idCavalier);
    header("Location: insert.php");
    exit();
}

?>
