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

    // Vérifiez si idrobe et idrace existent
    $robeExists = $con->prepare("SELECT COUNT(*) FROM robe WHERE idrobe = :idrobe");
    $robeExists->execute([':idrobe' => $idrobe]);
    $idrobeValid = $robeExists->fetchColumn() > 0;

    $raceExists = $con->prepare("SELECT COUNT(*) FROM race WHERE idrace = :idrace");
    $raceExists->execute([':idrace' => $idrace]);
    $idraceValid = $raceExists->fetchColumn() > 0;

    if (!$idrobeValid || !$idraceValid) {
        $_SESSION['error'] = "L'ID de la robe ou de la race est invalide.";
        header("Location: cavalerie.php");
        exit();
    }

    // Insérer d'abord le cheval pour obtenir le numsire
    $unCheval = new Cavalerie(null, $nomcheval, $datenaissancecheval, $garot, $idrobe, $idrace);
    $numsire = $unCheval->insertCheval();

    // Gestion de la photo
    if ($numsire && isset($_FILES['userfile'])) {
        $uploadDir = '../../uploads/photos/';
        
        // Définir les extensions de fichiers autorisées
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        foreach ($_FILES['userfile']['name'] as $key => $originalFileName) {
            $extension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
            
            // Vérification de l'extension
            if (!in_array($extension, $allowed)) {
                $_SESSION['error'] = "Format de fichier non autorisé. Utilisez JPG, PNG, GIF ou WebP";
                header("Location: cavalerie.php");
                exit();
            }

            $nomPhoto = !empty($_POST['nom_photo']) 
                ? preg_replace('/[^A-Za-z0-9_-]/', '', $_POST['nom_photo']) . '_' . $key . '.' . $extension
                : uniqid() . '.' . $extension;

            $uploadFile = $uploadDir . $nomPhoto;

            // Déplacement du fichier
            if (move_uploaded_file($_FILES['userfile']['tmp_name'][$key], $uploadFile)) {
                // Enregistrement dans la base de données
                $photo = new Photo();
                $photo->setNumSire($numsire);
                $photo->setIdEvenement(0);
                $photo->setnom_photo($nomPhoto);
                $photo->setLien('../../uploads/photos/' . $nomPhoto);
                $photo->saveLink();
            } else {
                error_log("Erreur upload : " . error_get_last()['message']);
            }
        }
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

if (isset($_FILES['new_photo']) && $_FILES['new_photo']['error'] == UPLOAD_ERR_OK) {
    $nom_photo = $_FILES['new_photo']['name']; // Récupérer le nom de la photo
    $tmp_name = $_FILES['new_photo']['tmp_name'];
    $upload_dir = '../../uploads/photos/'; // Dossier de destination
    $lien = $upload_dir . basename($nom_photo); // Chemin complet pour le fichier

    // Vérifiez si le répertoire de téléchargement existe, sinon créez-le
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Déplacer le fichier téléchargé vers le dossier de destination
    if (move_uploaded_file($tmp_name, $lien)) {
        // Créer une nouvelle instance de Photo et enregistrer les informations
        $oPhoto = new Photo();
        $oPhoto->setnom_photo($nom_photo); // Nom de la photo
        $oPhoto->setLien($lien); // Lien vers la photo
        $oPhoto->setNumSire($_POST['numsire']); // NumSire du cheval
        $oPhoto->setIdEvenement(0); // ID d'événement, ajustez si nécessaire

        // Enregistrer la photo dans la base de données
        if ($oPhoto->saveLink()) {
            echo "Photo publiée et enregistrée avec succès.";
        } else {
            echo "Erreur lors de l'enregistrement de la photo dans la base de données.";
        }
    } else {
        echo "Erreur lors de l'upload de la photo.";
    }
} else {
    echo "Aucune photo téléchargée ou une erreur s'est produite.";
}
?>



