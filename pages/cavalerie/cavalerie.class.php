<?php

class Cavalerie {
    private $numsire;
    private $nomcheval;
    private $datenaissancecheval;
    private $garot;
    private $idrobe;
    private $idrace;
    private $pdo;

    public function __construct($numsire, $nomcheval, $datenaissancecheval, $garot, $idrobe, $idrace) {
        $this->numsire = $numsire;
        $this->nomcheval = $nomcheval;
        $this->datenaissancecheval = $datenaissancecheval;
        $this->garot = $garot;
        $this->idrobe = $idrobe;
        $this->idrace = $idrace;
    }

    public function getNumsire() {
        return $this->numsire;
    }

    public function getNomCheval() {
        return $this->nomcheval;
    }

    public function setNomCheval($nomcheval) {
        $this->nomcheval = $nomcheval;
    }

    public function getDateNaissanceCheval() {
        return $this->datenaissancecheval;
    }

    public function setDateNaissanceCheval($datenaissancecheval) {
        $this->datenaissancecheval = $datenaissancecheval;
    }

    public function getGarot() {
        return $this->garot;
    }

    public function setGarot($garot) {
        $this->garot = $garot;
    }

    public function getIdRobe() {
        return $this->idrobe;
    }

    public function setIdRobe($idrobe) {
        $this->idrobe = $idrobe;
    }

    public function getIdRace() {
        return $this->idrace;
    }

    public function setIdRace($idrace) {
        $this->idrace = $idrace;
    }

    public function insertCheval() {
        global $con;
        $data = [
            ':numsire' => $this->numsire,
            ':nomcheval' => $this->nomcheval,
            ':datenaissancecheval' => $this->datenaissancecheval,
            ':garot' => $this->garot,
            ':idrobe' => $this->idrobe,
            ':idrace' => $this->idrace,
        ];

        $sql = "INSERT INTO cavalerie (numsire, nomcheval, datenaissancecheval, garot, idrobe, idrace, afficher) 
                VALUES (:numsire, :nomcheval, :datenaissancecheval, :garot, :idrobe, :idrace, true)";
        $stmt = $con->prepare($sql);
        
        return $stmt->execute($data);
    }

    public function selectChevaux() {
        global $con;
        $sql = "SELECT * FROM cavalerie WHERE afficher = 1";
        $stmt = $con->query($sql);
        $chevaux = [];

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $cheval = new Cavalerie($row['numsire'], $row['nomcheval'], $row['datenaissancecheval'], $row['garot'], $row['idrobe'], $row['idrace']);
            $chevaux[] = $cheval;
        }
        return $chevaux;
    }

    public function DeleteCavalerie($id)
    {
        global $con;
        $data = [':id' => $id];
        $sql = "UPDATE cavalerie  set afficher = 0 WHERE numsire = :id";
        $stmt = $con->prepare($sql);

        if ($stmt->execute($data)) {
            echo "Suppression réussie";
            return true;
        } else {
            echo "Erreur lors de la suppression : " . implode(", ", $stmt->errorInfo());
            return false;
        }
    }

    public function updateCheval() {
        global $con;
        $data = [
            ':numsire' => $this->numsire,
            ':nomcheval' => $this->nomcheval,
            ':datenaissancecheval' => $this->datenaissancecheval,
            ':garot' => $this->garot,
            ':idrobe' => $this->idrobe,
            ':idrace' => $this->idrace,
        ];

        $sql = "UPDATE cavalerie 
                SET nomcheval = :nomcheval, datenaissancecheval = :datenaissancecheval, garot = :garot, idrobe = :idrobe, idrace = :idrace
                WHERE numsire = :numsire";
        $stmt = $con->prepare($sql);

        return $stmt->execute($data);
    }
}
?>
