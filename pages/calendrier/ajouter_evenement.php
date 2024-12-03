<?php
header('Content-Type: application/json');
include("../../includes/bdd.inc.php");

// Récupérer les données envoyées en POST
$data = json_decode(file_get_contents('php://input'), true);

// Vérifier les données
if (isset($data['title']) && isset($data['start'])) {
    $title = $data['title'];
    $start = date('Y-m-d H:i:s', strtotime($data['start']));
    $end = isset($data['end']) ? date('Y-m-d H:i:s', strtotime($data['end'])) : $start;
    $allDay = isset($data['allDay']) ? (int)$data['allDay'] : 0;
    $datecours = $data['datecours'];

    // Préparer la requête d'insertion
    $stmt = $con->prepare("INSERT INTO cours (libcours, horairedebut, horairefin, jour, afficher) VALUES (?, ?, ?, ?, true)");
    $smtmt2 = $con->prepare("INSERT INTO calendrier(idcoursbase, idcoursassociee, datecours) VALUES (0, 0, ?)");

    // Exécuter la première requête d'insertion
    if ($stmt->execute([$title, $start, $end, $allDay])) {
        // Récupérer l'ID du cours inséré
        $idcours = $con->lastInsertId();

        // Exécuter la deuxième requête d'insertion avec l'ID du cours
        if ($smtmt2->execute([$datecours])) {
            echo json_encode(['success' => true, 'afficher' => true]);
        } else {
            $errorInfo = $smtmt2->errorInfo();
            echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout de l\'événement dans le calendrier', 'error' => $errorInfo]);
        }
    } else {
        $errorInfo = $stmt->errorInfo();
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout de l\'événement', 'error' => $errorInfo]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Données manquantes']);
}
?>
