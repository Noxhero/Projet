<?php
include '../../includes/haut.inc.php';
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
    if ($numsire && isset($_FILES['userfile'])) {
        $uploadDir = '../../uploads/photos/';
        
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $originalFileName = basename($_FILES['userfile']['name']);
        $extension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
        
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($extension, $allowed)) {
            $_SESSION['error'] = "Format de fichier non autorisé. Utilisez JPG, PNG, GIF ou WebP";
            header("Location: cavalerie.php");
            exit();
        }
        
        $nomPhoto = !empty($_POST['nom_photo']) 
            ? preg_replace('/[^A-Za-z0-9_-]/', '', $_POST['nom_photo']) . '.' . $extension
            : uniqid() . '.' . $extension;
        
        $uploadFile = $uploadDir . $nomPhoto;
        
        if (isset($_FILES['userfile'])) {
            error_log("Upload tentative : " . print_r($_FILES['userfile'], true));
            if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadFile)) {
                error_log("Erreur upload : " . error_get_last()['message']);
            }
        }

        if ($_FILES['userfile']['size'] > 8000000) { // 8MB
            $_SESSION['error'] = "Le fichier est trop volumineux (max 8MB)";
            header("Location: cavalerie.php");
            exit();
        }

        // Debug: afficher le chemin qui sera enregistré
        error_log("Chemin de la photo à enregistrer: " . '../../uploads/photos/' . $nomPhoto);
        
        $photo = new Photo();
        $photo->setNumSire($numsire);
        $photo->setIdEvenement(0);
        $photo->setnom_photo($nomPhoto);
        $photo->setLien('../../uploads/photos/' . $nomPhoto);
        $photo->saveLink();
    }

    header("Location: cavalerie.php");
    exit();
}

// Suppression d'un cheval
if (isset($_POST["supprimer"])) {
    $idcavalerie = $_POST["supprimer"]; 
    $unCavalier = new Cavalerie($idcavalerie, null, null, null, null, null); 
    $unCavalier->DeleteCavalerie($idcavalerie);
    
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



