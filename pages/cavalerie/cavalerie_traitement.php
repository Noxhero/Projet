<?php
include '../../includes/haut.inc.php';

// Fonction helper pour envoyer une réponse JSON
function sendJsonResponse($success, $message, $data = []) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

// Modification d'un cheval
if (isset($_POST['action']) && $_POST['action'] === 'modifier') {
    try {
        $numsire = $_POST["numsire"];
        $nomcheval = $_POST["nomcheval"];
        $datenaissancecheval = $_POST["datenaissancecheval"];
        $garot = $_POST["garot"];
        $idrobe = $_POST["idrobe"];
        $idrace = $_POST["idrace"];

        $unCheval = new Cavalerie($numsire, $nomcheval, $datenaissancecheval, $garot, $idrobe, $idrace);
        $success = $unCheval->updateCheval();

        if ($success) {
            sendJsonResponse(true, "Cheval modifié avec succès");
        } else {
            sendJsonResponse(false, "Erreur lors de la modification du cheval");
        }
    } catch (Exception $e) {
        sendJsonResponse(false, "Erreur : " . $e->getMessage());
    }
}

// Ajout d'un nouveau cheval avec photo
if (isset($_POST["nomcheval"]) && !isset($_POST['action'])) {
    try {
        $nomcheval = $_POST["nomcheval"];
        $datenaissancecheval = $_POST["datenaissancecheval"];
        $garot = $_POST["garot"];
        $idrobe = $_POST["idrobe"];
        $idrace = $_POST["idrace"];

        // Vérifications des IDs
        $robeExists = $con->prepare("SELECT COUNT(*) FROM robe WHERE idrobe = :idrobe");
        $robeExists->execute([':idrobe' => $idrobe]);
        $idrobeValid = $robeExists->fetchColumn() > 0;

        $raceExists = $con->prepare("SELECT COUNT(*) FROM race WHERE idrace = :idrace");
        $raceExists->execute([':idrace' => $idrace]);
        $idraceValid = $raceExists->fetchColumn() > 0;

        if (!$idrobeValid || !$idraceValid) {
            sendJsonResponse(false, "L'ID de la robe ou de la race est invalide.");
        }

        // Insertion du cheval
        $unCheval = new Cavalerie(null, $nomcheval, $datenaissancecheval, $garot, $idrobe, $idrace);
        $numsire = $unCheval->insertCheval();

        // Gestion de la photo
        if ($numsire && isset($_FILES['userfile'])) {
            $uploadDir = '../../uploads/photos/';
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $uploadedFiles = [];
            foreach ($_FILES['userfile']['name'] as $key => $originalFileName) {
                $extension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
                
                if (!in_array($extension, $allowed)) {
                    sendJsonResponse(false, "Format de fichier non autorisé. Utilisez JPG, PNG, GIF ou WebP");
                }

                $nomPhoto = !empty($_POST['nom_photo']) 
                    ? preg_replace('/[^A-Za-z0-9_-]/', '', $_POST['nom_photo']) . '_' . $key . '.' . $extension
                    : uniqid() . '.' . $extension;

                $uploadFile = $uploadDir . $nomPhoto;

                if (move_uploaded_file($_FILES['userfile']['tmp_name'][$key], $uploadFile)) {
                    $photo = new Photo();
                    $photo->setNumSire($numsire);
                    $photo->setIdEvenement(0);
                    $photo->setnom_photo($nomPhoto);
                    $photo->setLien('../../uploads/photos/' . $nomPhoto);
                    $photo->saveLink();
                    $uploadedFiles[] = $nomPhoto;
                }
            }
            sendJsonResponse(true, "Cheval et photos ajoutés avec succès", ['numsire' => $numsire, 'photos' => $uploadedFiles]);
        } else {
            sendJsonResponse(true, "Cheval ajouté avec succès", ['numsire' => $numsire]);
        }
    } catch (Exception $e) {
        sendJsonResponse(false, "Erreur : " . $e->getMessage());
    }
}

// Suppression d'un cheval
if (isset($_POST["supprimer"])) {
    try {
        $idcavalerie = $_POST["supprimer"]; 
        $unCavalier = new Cavalerie($idcavalerie, null, null, null, null, null); 
        $success = $unCavalier->DeleteCavalerie($idcavalerie);
        
        if ($success) {
            sendJsonResponse(true, "Cheval supprimé avec succès");
        } else {
            sendJsonResponse(false, "Erreur lors de la suppression du cheval");
        }
    } catch (Exception $e) {
        sendJsonResponse(false, "Erreur : " . $e->getMessage());
    }
}

// Gestion des photos
if (isset($_FILES['new_photo']) && $_FILES['new_photo']['error'] == UPLOAD_ERR_OK) {
    try {
        $nom_photo = $_FILES['new_photo']['name'];
        $tmp_name = $_FILES['new_photo']['tmp_name'];
        $upload_dir = '../../uploads/photos/';
        $lien = $upload_dir . basename($nom_photo);

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($tmp_name, $lien)) {
            $oPhoto = new Photo();
            $oPhoto->setnom_photo($nom_photo);
            $oPhoto->setLien($lien);
            $oPhoto->setNumSire($_POST['numsire']);
            $oPhoto->setIdEvenement(0);

            if ($oPhoto->saveLink()) {
                sendJsonResponse(true, "Photo publiée et enregistrée avec succès", ['photo' => $nom_photo]);
            } else {
                sendJsonResponse(false, "Erreur lors de l'enregistrement de la photo dans la base de données");
            }
        } else {
            sendJsonResponse(false, "Erreur lors de l'upload de la photo");
        }
    } catch (Exception $e) {
        sendJsonResponse(false, "Erreur : " . $e->getMessage());
    }
}
?>


