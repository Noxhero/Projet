<?php
// Inclure la connexion à la base de données depuis bdd.inc.php
require_once '../../includes/bdd.inc.php'; // Assurez-vous que le chemin est correct

class Robe {
    private $idrobe;
    private $librobe;

    function __construct($idro = null, $libro = null) {
        $this->idrobe = $idro;
        $this->librobe = $libro;
    }

    public function getidrobe() {
        return $this->idrobe;
    }

    public function getlibrobe() {
        return $this->librobe;
    }

    public function setidrobe($idro) {
        $this->idrobe = $idro;
    }

    public function setlibrobe($libro) {
        $this->librobe = $libro;
    }

    // Méthode pour récupérer toutes les robes
    public function robeAll() {
        $con = connexionPDO(); // Utilisation de la fonction pour obtenir la connexion PDO
        $sql = "SELECT * FROM robe";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $oprobes = [];

        foreach ($executesql->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $oprobe = new Robe($row['idrobe'], $row['librobe']);
            $oprobes[] = $oprobe;
        }
        return $oprobes;
    }

    // Méthode pour ajouter une robe
    public function robe_ajout($idrobe, $librobe) {
        $con = connexionPDO();
        $data = [
            ':idrobe' => $idrobe,
            ':liberobe' => $librobe,
        ];
        $sql = "INSERT INTO robe (idrobe, librobe) VALUES (:idrobe, :liberobe)";
        $stmt = $con->prepare($sql);

        if ($stmt->execute($data)) {
            return $con->lastInsertId();
        } else {
            echo $stmt->errorInfo();
            return false;
        }
    }

    // Méthode pour modifier une robe
    public function robe_modifier($idrobe, $librobe) {
        $con = connexionPDO();
        $data = [
            ':idrobe' => $idrobe,
            ':liberobe' => $librobe,
        ];
        $sql = "UPDATE robe SET librobe = :liberobe WHERE idrobe = :idrobe";
        $stmt = $con->prepare($sql);

        if ($stmt->execute($data)) {
            return true;
        } else {
            echo $stmt->errorInfo();
            return false;
        }
    }

    // Méthode pour supprimer une robe
    public function robe_supprimer($idrobe) {
        $con = connexionPDO();
        $sql = "DELETE FROM robe WHERE idrobe = :idrobe";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idrobe', $idrobe);

        if ($stmt->execute()) {
            return true;
        } else {
            echo $stmt->errorInfo();
            return false;
        }
    }
}

// TESTS DES FONCTIONNALITÉS

// Instanciation de la classe Robe
$robe = new Robe();

// Ajouter une nouvelle robe
$robe->robe_ajout(1, 'Robe Rouge');

// Modifier une robe existante
$robe->robe_modifier(1, 'Robe Bleu');

// Supprimer une robe
$robe->robe_supprimer(1);

// Récupérer toutes les robes et les afficher
$robes = $robe->robeAll();
print_r($robes);

?>
