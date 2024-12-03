<?php
// get_evenement.php
header('Content-Type: application/json');
include("../../includes/bdd.inc.php"); // Inclure votre fichier de connexion à la BDD

// Préparer la requête pour récupérer tous les événements du calendrier avec les informations des cours
$stmt = $con->prepare("
    SELECT c.idcours, c.libcours, c.horairedebut, c.horairefin, c.jour, c.afficher, cal.datecours
    FROM calendrier cal
    JOIN cours c ON cal.idcoursassociee = c.idcours
");
$stmt->execute();

// Récupérer les résultats
$events = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Si l'événement est annulé, ajouter "Cours annulé" au titre
    $title = $row['libcours'];
    $canDelete = $row['afficher'] == true; // Si l'événement est affiché (non annulé), on permet la suppression

    if ($row['afficher'] == false) {
        $title .= " (Cours annulé)";
    }

    $events[] = [
        'id' => $row['idcours'],  // Ajoutez l'ID de l'événement ici
        'title' => $title,        // Titre avec suffixe si annulé
        'start' => date('c', strtotime($row['datecours'])),
        'end' => date('c', strtotime($row['datecours'])),
        'allDay' => $row['jour'] == 'all-day',  // Gérer les événements sur toute la journée
        'canDelete' => $canDelete  // Ajout de la propriété canDelete
    ];
}

echo json_encode($events);  // Retourner la liste des événements
?>
