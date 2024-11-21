<?php


class Participation
{
    private $idCoursbase;
    private $idCoursassociee;
    private $idcavalier;
    private $present;

    function __construct($idCoursbase, $idCoursassociee, $idcavalier, $present)
    {
        $this->idCoursbase = $idCoursbase;
        $this->idCoursassociee = $idCoursassociee;
        $this->idcavalier = $idcavalier;
        $this->present = $present;
    }

    public function getIdCoursbase()
    {
        return $this->idCoursbase;
    }

    public function getIdCoursassociee()
    {
        return $this->idCoursassociee;
    }

    public function getIdCavalier()
    {
        return $this->idcavalier;
    }

    public function getpresent()
    {
        return $this->present;
    }

    public function setpresent($present)
    {
        $this->present = $present;
    }

    public function InsertParticipation() {
        global $con;
        
        $sql = "INSERT INTO participation (idcoursbase, idcoursassociee, idcavalier, present) 
                VALUES (:icb, :ica, :ic, :p)";
        
        $stmt = $con->prepare($sql);
        $data = [
            ':icb' => $this->idCoursbase,
            ':ica' => $this->idCoursassociee,
            ':ic' => $this->idcavalier,
            ':p' => $this->present
        ];

        if ($stmt->execute($data)) {
            echo "Participation ajoutée avec succès";
            return true;
        } else {
            echo "Erreur lors de l'ajout : " . implode(", ", $stmt->errorInfo());
            return false;
        }
    }

    public function UpdateParticipation() {
        global $con;
        
        $sql = "UPDATE participation 
                SET present = :p 
                WHERE idcoursbase = :icb 
                AND idcoursassociee = :ica 
                AND idcavalier = :ic";
        
        $stmt = $con->prepare($sql);
        $data = [
            ':icb' => $this->idCoursbase,
            ':ica' => $this->idCoursassociee,
            ':ic' => $this->idcavalier,
            ':p' => $this->present
        ];

        if ($stmt->execute($data)) {
            echo "Participation modifiée avec succès";
            return true;
        } else {
            echo "Erreur lors de la modification : " . implode(", ", $stmt->errorInfo());
            return false;
        }
    }

    public function DeleteParticipation() {
        global $con;
        
        $sql = "UPDATE participation 
                SET present = 0 
                WHERE idcoursbase = :icb 
                AND idcoursassociee = :ica 
                AND idcavalier = :ic";
        
        $stmt = $con->prepare($sql);
        $data = [
            ':icb' => $this->idCoursbase,
            ':ica' => $this->idCoursassociee,
            ':ic' => $this->idcavalier
        ];

        if ($stmt->execute($data)) {
            echo "Participation marquée comme absente avec succès";
            return true;
        } else {
            echo "Erreur lors de la modification : " . implode(", ", $stmt->errorInfo());
            return false;
        }
    }

    public function ParticipationAll() {
        global $con;
        
        $sql = "SELECT * FROM participation ORDER BY idcoursbase, idcoursassociee, idcavalier";
        $stmt = $con->query($sql);
        
        $participations = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $participations[] = new Participation(
                $row['idcoursbase'],
                $row['idcoursassociee'],
                $row['idcavalier'],
                $row['present']
            );
        }
        
        return $participations;
    }

}
?>


