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

// Ajout d'un nouveau cheval avec photo
if (isset($_POST["nomcheval"]) && !isset($_POST['action'])) {
    $nomcheval = $_POST["nomcheval"];
    $datenaissancecheval = $_POST["datenaissancecheval"];
    $garot = $_POST["garot"];
    $idrobe = $_POST["idrobe"];
    $idrace = $_POST["idrace"];

    // Insérer d'abord le cheval pour obtenir le numsire
    $unCheval = new Cavalerie(null, $nomcheval, $datenaissancecheval, $garot, $idrobe, $idrace);
    $numsire = $unCheval->insertCheval();

    // Gestion de la photo
    if ($numsire && isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../uploads/photos/';
        
        // Création du dossier si nécessaire
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $originalFileName = basename($_FILES['photo']['name']);
        $uploadFile = $uploadDir . $originalFileName;

        // Déplacer le fichier
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
            // Enregistrer en base de données
            $photo = new Photo();
            $photo->setNumSire($numsire);
            $photo->setIdEvenement(0);
            
            // Utiliser le nom personnalisé s'il existe, sinon utiliser le nom du fichier
            $nomPhoto = !empty($_POST['nom_photo']) ? $_POST['nom_photo'] : $originalFileName;
            $photo->setnom_photo($nomPhoto);
            $photo->setLien($uploadFile);
            
            if (!$photo->saveLink()) {
                error_log("Erreur lors de l'enregistrement de la photo en BDD");
            }
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

// Ajout d'une nouvelle condition pour gérer l'update du numsire d'une photo
if (isset($_POST['action']) && $_POST['action'] === 'update_photo_numsire') {
    if (isset($_POST['idphoto']) && isset($_POST['numsire'])) {
        $photo = new Photo();
        $success = $photo->updateNumSire($_POST['idphoto'], $_POST['numsire']);
        
        echo json_encode(['success' => $success]);
        exit();
    }
    echo json_encode(['success' => false]);
    exit();
}
?>



