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

    // Mettre à jour la photo si une nouvelle URL est fournie
    if (!empty($_POST['photo_url'])) {
        $photo = new Photo($con);
        $photo->setNumSire($numsire);
        $photo->setIdEvenement(null);
        $photo->setLien($_POST['photo_url']);
        
        // Vérifier si une photo existe déjà
        $existingPhoto = $photo->getPhotoByNumSire($numsire);
        if ($existingPhoto) {
            $photo->setIdPhoto($existingPhoto['idphoto']);
            $photo->update();
        } else {
            $photo->saveLink();
        }
    }

    header("Location: cavalerie.php");
    exit();
}

// Ajout d'un nouveau cheval
if (isset($_POST["nomcheval"]) && !isset($_POST['action'])) {
    $nomcheval = $_POST["nomcheval"];
    $datenaissancecheval = $_POST["datenaissancecheval"];
    $garot = $_POST["garot"];
    $idrobe = $_POST["idrobe"];
    $idrace = $_POST["idrace"];

    $unCheval = new Cavalerie(null, $nomcheval, $datenaissancecheval, $garot, $idrobe, $idrace);
    $numsire = $unCheval->insertCheval();

    // Gérer l'ajout du lien de la photo si fourni
    if (!empty($_POST['photo_url'])) {
        $photo = new Photo($con);
        $photo->setNumSire($numsire);
        $photo->setIdEvenement(null);
        $photo->setLien($_POST['photo_url']);
        
        if (!$photo->saveLink()) {
            error_log("Erreur lors de l'enregistrement du lien de la photo pour le cheval " . $numsire);
        }
    }

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

// Ajout d'une photo pour un cheval existant
if (isset($_POST['action']) && $_POST['action'] === 'ajouter_photo') {
    $numsire = $_POST['numsire'];
    $photoUrl = $_POST['photo_url'];

    $photo = new Photo();
    $photo->setNumSire($numsire);
    $photo->setIdEvenement(null);
    $photo->setLien($photoUrl);

    // Vérifier si une photo existe déjà
    $existingPhoto = $photo->getPhotoByNumSire($numsire);
    if ($existingPhoto) {
        $photo->setIdPhoto($existingPhoto['idphoto']);
        $photo->update();
    } else {
        $photo->saveLink();
    }

    echo "Photo ajoutée avec succès";
    exit();
}

if (isset($_POST['action']) && $_POST['action'] === 'update_photo_numsire') {
    $idphoto = $_POST['idphoto'];
    $numsire = $_POST['numsire'];
    
    $photo = new Photo();
    if ($photo->updateNumSire($idphoto, $numsire)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit();
}
?>



