<?php
class Photo {
    private $idphoto;

    private $nom_photo;
    private $lien;
    private $numsire;
    private $idevenement;
    

    public function __construct() {
  
    }

    // Getters et Setters
    public function getIdPhoto() { return $this->idphoto; }
    public function getnom_photo() { return $this->nom_photo; }
    public function getLien() { return $this->lien; }
    public function getNumSire() { return $this->numsire; }
    public function getIdEvenement() { return $this->idevenement; }

    public function setIdPhoto($idphoto) { $this->idphoto = $idphoto; }
    public function setnom_photo($nom_photo) { $this->nom_photo = $nom_photo; }
    public function setLien($lien) { $this->lien = $lien; }
    public function setNumSire($numsire) { $this->numsire = $numsire; }
    public function setIdEvenement($idevenement) { $this->idevenement = $idevenement; }

    // Nouvelle méthode pour sauvegarder uniquement le lien
    public function saveLink() {
        try {
            global $con;
            $sql = "INSERT INTO photo (nom_photo, lien, numsire, idevenement) VALUES (:nom_photo, :lien, 0, :idevenement)";
            $stmt = $con->prepare($sql);
            $data = [
                ':nom_photo' => $this->nom_photo,
                ':lien' => $this->lien,
                ':idevenement' => $this->idevenement
            ];
            return $stmt->execute($data);
        } catch (PDOException $e) {
            error_log("Erreur lors de l'enregistrement du lien de la photo: " . $e->getMessage());
            return false;
        }
    }

    public function getPhotoByNumSire($numsire) {
        global $con;
        $sql = "SELECT * FROM photo";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $photos = [];
        
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $photo = new Photo();
            $photo->setIdPhoto($row['idphoto']);
            $photo->setnom_photo($row['nom_photo']);
            $photo->setLien($row['lien']);
            $photo->setNumSire($row['numsire']);
            $photo->setIdEvenement($row['idevenement']);
            $photos[] = $photo;
        }
        return $photos;
    }

    public function update() {
        global $con;
        $sql = "UPDATE photo SET nom_photo = :nom_photo,  lien = :lien, numsire = :numsire, idevenement = :idevenement WHERE idphoto = :idphoto";
        $stmt = $this->$con->prepare($sql);
        $data = [
            ':nom_photo' => $this->nom_photo,
            ':lien' => $this->lien,
            ':numsire' => $this->numsire,
            ':idevenement' => $this->idevenement,
            ':idphoto' => $this->idphoto
        ];
        return $stmt->execute($data);
    }

    public function delete() {
        if (file_exists($this->lien)) {
            unlink($this->lien);
        }
        global $con;
        $sql = "DELETE FROM photo WHERE idphoto = :idphoto";
        $stmt = $this->$con->prepare($sql);
        return $stmt->execute([':idphoto' => $this->idphoto]);
    }

    public function updateNumSire($idphoto, $numsire) {
        try {
            global $con;
            $sql = "UPDATE photo SET numsire = :numsire WHERE idphoto = :idphoto";
            $stmt = $con->prepare($sql);
            $data = [
                ':numsire' => $numsire,
                ':idphoto' => $idphoto
            ];
            return $stmt->execute($data);
        } catch (PDOException $e) {
            error_log("Erreur lors de la mise à jour du numsire: " . $e->getMessage());
            return false;
        }
    }

    public function getPhotoById($idphoto) {
        try {
            global $con;
            $sql = "SELECT * FROM photo WHERE idphoto = :idphoto";
            $stmt = $con->prepare($sql);
            $stmt->execute([':idphoto' => $idphoto]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération de la photo: " . $e->getMessage());
            return false;
        }
    }
}
?>
