<?php

include '../../includes/haut.inc.php';

// Modification d'une inscription
if (isset($_POST['action']) && $_POST['action'] === 'modifier') {
    $idCours = $_POST["idcours"];
    $idCavalier = $_POST["idcavalier"];

    // Création de l'inscription avec les bons paramètres
    $unInserer = new Inserer($idCours, $idCavalier);
    $unInserer->UpdateInserer();
    header('Location: insert.php');
    exit();
}

// Ajout d'une nouvelle inscription
if (isset($_POST["idcours"]) && !isset($_POST['action'])) {
    $idCours = $_POST["idcours"];
    $idCavalier = $_POST["idcavalier"];

    $unInserer = new Inserer($idCours, $idCavalier);
    $unInserer->InsertInserer();

    // Inscrire le cavalier aux 53 séances du cours
    $sql = "SELECT idcoursassociee FROM calendrier WHERE idcoursbase = :idcoursbase";
    $stmt = $con->prepare($sql);
    $stmt->execute([':idcoursbase' => $idCours]);
    $seances = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($seances as $seance) {
        $participation = new Participation($idCours, $seance['idcoursassociee'], $idCavalier, 1);
        $participation->InsertParticipation();
    }

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
