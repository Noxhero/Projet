<?php

include '../../includes/haut.inc.php';

// Debug - Afficher les données reçues
echo "<h3>Données reçues :</h3>";
echo "<pre>";
// Vérifier l'existence des clés avant de les afficher
echo "ID Cavalier : " . (isset($_POST['idcavalier']) ? $_POST['idcavalier'] : 'Non défini') . "\n";
echo "Nom : " . (isset($_POST['nomcavalier']) ? $_POST['nomcavalier'] : 'Non défini') . "\n";
echo "Prénom : " . (isset($_POST['prenomcavalier']) ? $_POST['prenomcavalier'] : 'Non défini') . "\n";
echo "Date de naissance : " . (isset($_POST['datenaissancecavalier']) ? $_POST['datenaissancecavalier'] : 'Non défini') . "\n";
echo "Nom responsable : " . (isset($_POST['nomresponsable']) ? $_POST['nomresponsable'] : 'Non défini') . "\n";
echo "Rue responsable : " . (isset($_POST['rueresponsable']) ? $_POST['rueresponsable'] : 'Non défini') . "\n";
echo "Tel responsable : " . (isset($_POST['telresponsable']) ? $_POST['telresponsable'] : 'Non défini') . "\n";
echo "Email responsable : " . (isset($_POST['emailresponsable']) ? $_POST['emailresponsable'] : 'Non défini') . "\n";
echo "Num licence : " . (isset($_POST['numlicence']) ? $_POST['numlicence'] : 'Non défini') . "\n";
echo "Num assurance : " . (isset($_POST['numassurance']) ? $_POST['numassurance'] : 'Non défini') . "\n";
echo "ID commune : " . (isset($_POST['idcommune']) ? $_POST['idcommune'] : 'Non défini') . "\n";
echo "ID galop : " . (isset($_POST['idgalop']) ? $_POST['idgalop'] : 'Non défini') . "\n";
echo "Action : " . (isset($_POST['action']) ? $_POST['action'] : 'Non défini') . "\n";
echo "</pre>";

// Modification d'un cavalier
if (isset($_POST['action']) && $_POST['action'] === 'modifier' && isset($_POST['idcavalier'])) {
    $idCavalier = $_POST["idcavalier"];
    $nomCavalier = $_POST["nomcavalier"];
    $prenomCavalier = $_POST["prenomcavalier"];
    $dateNaissanceCavalier = $_POST["datenaissancecavalier"];
    $nomResponsable = $_POST["nomresponsable"];
    $rueResponsable = $_POST["rueresponsable"];
    $telResponsable = $_POST["telresponsable"];
    $emailResponsable = $_POST["emailresponsable"];
    $numLicence = $_POST["numlicence"];
    $numAssurance = $_POST["numassurance"];
    $idcommune = $_POST["idcommune"]; 
    $idGalop = $_POST["idgalop"];

    // Création du cavalier avec les bons paramètres
    $unCavalier = new Cavalier(
        $idCavalier,
        $nomCavalier,
        $prenomCavalier,
        $dateNaissanceCavalier,
        $nomResponsable,
        $rueResponsable,
        $telResponsable,
        $emailResponsable,
        null, // password n'est pas modifié lors d'une mise à jour
        $numLicence,
        $numAssurance,
        $idcommune,
        $idGalop
    );
    
    $unCavalier->UpdateCavalier();
    header('Location: cavalier.php');
    exit();
}

// Ajout d'un nouveau cavalier
if (isset($_POST["nomcavalier"]) && !isset($_POST['action'])) {
    try {
        global $con; // Ajout de l'accès à la connexion

        $nomCavalier = $_POST["nomcavalier"];
        $prenomCavalier = $_POST["prenomcavalier"];
        $dateNaissanceCavalier = $_POST["datenaissancecavalier"];
        $nomResponsable = $_POST["nomresponsable"];
        $rueResponsable = $_POST["rueresponsable"];
        $telResponsable = $_POST["telresponsable"];
        $emailResponsable = $_POST["emailresponsable"];
        $password = $_POST["password"];
        $numLicence = $_POST["numlicence"];
        $numAssurance = $_POST["numassurance"];
        
        // Vérifier que les IDs sont bien définis
        if (!isset($_POST["idcommune"]) || !isset($_POST["idgalop"])) {
            throw new Exception("La commune et le niveau de galop sont requis");
        }

        $idcommune = intval($_POST["idcommune"]); 
        $idGalop = intval($_POST["idgalop"]);

        // Vérifier si la commune existe
        $stmt = $con->prepare("SELECT COUNT(*) FROM commune WHERE idcommune = ?");
        $stmt->execute([$idcommune]);
        if ($stmt->fetchColumn() == 0) {
            throw new Exception("La commune sélectionnée n'existe pas dans la base de données (ID: $idcommune)");
        }

        // Vérifier si le galop existe
        $stmt = $con->prepare("SELECT COUNT(*) FROM galop WHERE idgalop = ?");
        $stmt->execute([$idGalop]);
        if ($stmt->fetchColumn() == 0) {
            throw new Exception("Le niveau de galop sélectionné n'existe pas dans la base de données (ID: $idGalop)");
        }

        // Création des objets après vérification
        $commune = new Commune($idcommune, null, null);
        $galop = new Galop($idGalop, null);

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Debug - Afficher les valeurs
        echo "Debug - Valeurs avant insertion:<br>";
        echo "ID Commune: " . $idcommune . "<br>";
        echo "ID Galop: " . $idGalop . "<br>";
        
        $unCavalier = new Cavalier(
            null,
            $nomCavalier,
            $prenomCavalier,
            $dateNaissanceCavalier,
            $nomResponsable,
            $rueResponsable,
            $telResponsable,
            $emailResponsable,
            $hashed_password,
            $numLicence,
            $numAssurance,
            $commune,
            $galop
        );
        
        $unCavalier->InsertCavalier();
        header("Location: cavalier.php");
        exit(); 
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
        echo "<br><br>";
        echo "<a href='javascript:history.back()'>Retour au formulaire</a>";
    }
}

// Suppression d'un cavalier
if (isset($_POST["supprimer"])) {
    $idCavalier = $_POST["supprimer"]; 
    $unCavalier = new Cavalier($idCavalier, null, null, null, null, null, null, null, null, null,null,null,null); 
    $unCavalier->DeleteCavalier($idCavalier);
    
    header("Location: cavalier.php");
    exit(); 
}

?>
