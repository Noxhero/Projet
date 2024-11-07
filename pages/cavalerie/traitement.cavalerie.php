<?php

include '../../includes/haut.inc.php';
require_once 'cavalerie.class.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    $numsire = $_POST['numsire'];
    $nomcheval = $_POST['nomcheval'];
    $datenaissancecheval = $_POST['datenaissancecheval'];
    $garot = $_POST['garot'];
    $idrobe = $_POST['idrobe'];
    $idrace = $_POST['idrace'];

    $cheval = new Cavalerie($numsire, $nomcheval, $datenaissancecheval, $garot, $idrobe, $idrace);

    if ($action === 'ajouter') {
        $cheval->insertCheval();
    } elseif ($action === 'modifier') {
        $cheval->updateCheval();
    } elseif ($action === 'supprimer') {
        $cheval->deleteCheval($numsire);
    }

    header('Location: cavalerie.php');
    exit();
}
?>
