<?php
// Inclure la connexion à la base de données
include '../includes/bdd.inc.php';  // Assurez-vous que ce chemin est correct

// Vérifier si la méthode de la requête est POST (donc si le formulaire a été soumis)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire et s'assurer qu'elles existent
    $nomcheval = isset($_POST['nomcheval']) ? trim($_POST['nomcheval']) : null;
    $datenaissancecheval = isset($_POST['datenaissancecheval']) ? trim($_POST['datenaissancecheval']) : null;
    $garot = isset($_POST['garot']) ? (int) $_POST['garot'] : null;
    $idrobe = isset($_POST['idrobe']) ? (int) $_POST['idrobe'] : null;
    $idrace = isset($_POST['idrace']) ? (int) $_POST['idrace'] : null;

    // Vérification des données avant l'insertion
    if ($nomcheval && $datenaissancecheval && $garot >= 0 && $idrobe >= 0 && $idrace >= 0) {
        // Connexion à la base de données
        $con = connexionPDO();

        if ($con) {
            // Préparation de la requête SQL pour l'insertion des données
            $sql = "INSERT INTO cavalerie (nomcheval, datenaissancecheval, garot, idrobe, idrace)
                    VALUES (:nomcheval, :datenaissancecheval, :garot, :idrobe, :idrace)";
            $stmt = $con->prepare($sql);

            // Liaison des paramètres avec les valeurs récupérées du formulaire
            $data = [
                ':nomcheval' => $nomcheval,
                ':datenaissancecheval' => $datenaissancecheval,
                ':garot' => $garot,
                ':idrobe' => $idrobe,
                ':idrace' => $idrace
            ];

            // Exécution de la requête
            if ($stmt->execute($data)) {
                echo "Le cheval a bien été ajouté à la cavalerie.";
            } else {
                // En cas d'erreur d'exécution de la requête
                echo "Erreur lors de l'ajout du cheval : " . implode(", ", $stmt->errorInfo());
            }
        } else {
            // En cas de problème de connexion à la base de données
            echo "Erreur de connexion à la base de données.";
        }
    } else {
        // En cas de données manquantes ou invalides
        echo "Veuillez remplir tous les champs du formulaire correctement.";
    }
} else {
    // Si la méthode de requête n'est pas POST
    echo "Le formulaire n'a pas été soumis correctement.";
}
?>
