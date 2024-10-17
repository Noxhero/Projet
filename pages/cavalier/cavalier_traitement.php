<?php
// Inclusion de la connexion à la base de données et des classes nécessaires
include '../../includes/haut.inc.php';

function communeExists($con, $idcommune) {
    $sql = "SELECT COUNT(*) FROM commune WHERE idcommune = :idcommune";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':idcommune', $idcommune);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

function galopExists($con, $idgalop) {
    $sql = "SELECT COUNT(*) FROM galop WHERE idgalop = :idgalop";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':idgalop', $idgalop);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ajout d'un cavalier
    if (isset($_POST['ajouter'])) {
        $idcommune = $_POST['idcommune'];
        $idgalop = $_POST['idgalop'];

        if (!communeExists($con, $idcommune)) {
            echo "Erreur : La commune avec l'ID $idcommune n'existe pas.";
            exit();
        }
        
        if (!galopExists($con, $idgalop)) {
            echo "Erreur : Le galop avec l'ID $idgalop n'existe pas.";
            exit();
        }

        $nomcavalier = $_POST['nomcavalier'];
        $prenomcavalier = $_POST['prenomcavalier'];
        $datenaissancecavalier = $_POST['datenaissancecavalier'];
        $nomresponsable = $_POST['nomresponsable'];
        $rueresponsable = $_POST['rueresponsable'];
        $telresponsable = $_POST['telresponsable'];
        $emailresponsable = $_POST['emailresponsable'];
        $password = $_POST['password'];
        $numlicence = $_POST['numlicence'];
        $numassurance = $_POST['numassurance'];

        $unCavalier = new Cavalier(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $unCavalier->Cavalier_ajout($nomcavalier, $prenomcavalier, $datenaissancecavalier, $nomresponsable, $rueresponsable, $telresponsable, $emailresponsable, $password, $numlicence, $numassurance, $idcommune, $idgalop);
        
        header("Location: cavalier.php");
        exit();
    }

    // Modification d'un cavalier
    if (isset($_POST['modifier'])) {
        $idcavalier = $_POST['idcavalier'];
        $idcommune = $_POST['idcommune']; // Récupération de l'ID de la commune
        $idgalop = $_POST['idgalop'];
    
        if (!communeExists($con, $idcommune)) {
            echo "Erreur : La commune avec l'ID $idcommune n'existe pas.";
            exit();
        }
    
        if (!galopExists($con, $idgalop)) {
            echo "Erreur : Le galop avec l'ID $idgalop n'existe pas.";
            exit();
        }
    
        $nomcavalier = $_POST['nomcavalier'];
        $prenomcavalier = $_POST['prenomcavalier'];
        $datenaissancecavalier = $_POST['datenaissancecavalier'] ?? null; // Assurez-vous que ça vient bien de votre formulaire
        $nomresponsable = $_POST['nomresponsable'] ?? null;
        $rueresponsable = $_POST['rueresponsable'] ?? null;
        $telresponsable = $_POST['telresponsable'] ?? null;
        $emailresponsable = $_POST['emailresponsable'] ?? null;
        $password = $_POST['password'] ?? null;
        $numlicence = $_POST['numlicence'] ?? null;
        $numassurance = $_POST['numassurance'] ?? null;
        
        $unCavalier = new Cavalier(null, null,
        null, null,
        null, null,
        null, null,
        null, null, 
        null, null, 
        null, null);
        
        $unCavalier->Cavalier_modifier($idcavalier,
        $nomcavalier, 
        $prenomcavalier, 
        $datenaissancecavalier, 
        $nomresponsable, 
        $rueresponsable, 
        $telresponsable, 
        $emailresponsable, 
        $password, $numlicence, 
        $numassurance, $idcommune, 
        $idgalop);
        
        header("Location: cavalier.php");
        exit();
    
}
}
?>
