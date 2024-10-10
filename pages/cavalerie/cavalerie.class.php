<?php
include 'bdd.inc.php';
class Cavalerie {
    private $nomcheval;
    private $datenaissancecheval;
    private $garot;
    private $idrobe;
    private $idrace;

    function __construct($nc, $dnc, $gt, $idro, $idra) {
        $this->nomcheval = $nc;
        $this->datenaissancecheval = $dnc;
        $this->garot = $gt;
        $this->idrobe = $idro;
        $this->idrace = $idra;
    }

    public function getnomcheval() {
        return $this->nomcheval;
    }

    public function getdatenaissancecheval() {
        return $this->datenaissancecheval;
    }

    public function getgarot() {
        return $this->garot;
    }

    public function getidrobe() {
        return $this->idrobe;
    }

    public function getidrace() {
        return $this->idrace;
    }

    public function setnomcheval($nc) {
        $this->nomcheval = $nc;
    }

    public function setdatenaissancecheval($dnc) {
        $this->datenaissancecheval = $dnc;
    }

    public function setgarot($gt) {
        $this->garot = $gt;
    }

    public function setidrobe($idro) {
        $this->idrobe = $idro;
    }

    public function setidrace($idra) {
        $this->idrace = $idra;
    }

    public function cavalerieALL() {
        $con = connexionPDO();
        $sql = "SELECT * FROM cavalerie";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $opcavaleries = [];

        foreach ($executesql->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $opcavalerie = new Cavalerie($row['nomcheval'], $row['datenaissancecheval'], $row['garot'], $row['idrobe'], $row['idrace']);
            $opcavaleries[] = $opcavalerie;
        }

        return $opcavaleries;
    }

    public function cavalerie_ajout($nomcheval, $datenaissancecheval, $garot, $idrobe, $idrace) {
        $con = connexionPDO();
        $data = [
            ':nomcheval' => $nomcheval,
            ':datenaissancecheval' => $datenaissancecheval,
            ':garot' => $garot,
            ':idrobe' => $idrobe,
            ':idrace' => $idrace,
        ];

        $sql = "INSERT INTO cavalerie (nomcheval, datenaissancecheval, garot, idrobe, idrace) VALUES (:nomcheval, :datenaissancecheval, :garot, :idrobe, :idrace)";
        $stmt = $con->prepare($sql);

        if ($stmt->execute($data)) {
            echo "Cavalerie insérée";
            return $con->lastInsertId();
        } else {
            echo $stmt->errorInfo();
            return false;
        }
    }
}
