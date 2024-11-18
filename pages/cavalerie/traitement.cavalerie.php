<?php
include '../../includes/haut.inc.php';
include_once '../../pages/cavalerie/cavalerie.class.php';

// Modification d'un cheval
if (isset($_POST['action']) && $_POST['action'] === 'modifier') {
    $numsire = $_POST["numsire"];
    $nomcheval = $_POST["nomcheval"];
    $datenaissancecheval = $_POST["datenaissancecheval"];
    $garot = $_POST["garot"];
    $idrobe = $_POST["idrobe"];
    $idrace = $_POST["idrace"];

    $unCheval = new Cavalerie($numsire, $nomcheval, $datenaissancecheval, $garot, $idrobe, $idrace);
    $unCheval->updateCheval();
    header("Location: cavalerie.php");
    exit();
}

// Ajout d'un nouveau cheval
if (isset($_POST["nomcheval"]) && isset($_POST["datenaissancecheval"]) && isset($_POST["garot"])) {
    $nomcheval = $_POST["nomcheval"];
    $datenaissancecheval = $_POST["datenaissancecheval"];
    $garot = $_POST["garot"];
    $librobe = $_POST["librobe"];
    $librace = $_POST["librace"];

    $unCheval = new Cavalerie(null, $nomcheval, $datenaissancecheval, $garot, $idrobe, $idrace);
    $unCheval->insertCheval();
    header("Location: cavalerie.php");
    exit();
}

// Suppression d'un cheval
// Suppression d'un cavalier
if (isset($_POST["supprimer"])) {
    $idcavalerie = $_POST["supprimer"]; 
    $unCavalier = new Cavalerie($idcavalerie, null, null, null, null, null); 
    $unCavalier->DeleteCavalerie($idcavalerie);  // Utiliser DeleteCavalerie ici
    
    header("Location: cavalerie.php");
    exit(); 
}
?>



