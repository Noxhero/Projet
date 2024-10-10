<?php

class Cavalier
{
    private $idcavalier;
    private $nomcavalier;
    private $prenomcavalier;
    private $datenaissancecavalier;
    private $nomresponsable;
    private $rueresponsable;
    private $telresponsable;
    private $emailresponsable;
    private $password;
    private $numlicence;
    private $numassurance;
    private $idcommune;
    private $idgalop;
    private $afficher;

    public function __construct($idcavalier, $nomcavalier, 
    $prenomcavalier, $datenaissancecavalier, $nomresponsable,
    $rueresponsable, $telresponsable, $emailresponsable, 
    $password, $numlicence, $numassurance, $idcommune, $idgalop, $afficher)
    {
        $this-> idcavalier = $idcavalier;
        $this-> nomcavalier = $nomcavalier;
        $this-> prenomcavalier = $prenomcavalier;
        $this-> datenaissancecavalier = $datenaissancecavalier;
        $this-> nomresponsable = $nomresponsable;
        $this-> rueresponsable = $rueresponsable;
        $this-> telresponsable = $telresponsable;
        $this-> emailresponsable = $emailresponsable;
        $this-> password = $password;
        $this-> numlicence = $numlicence;
        $this-> numassurance = $numassurance;
        $this-> idcommune = $idcommune;
        $this-> idgalop = $idgalop;
        $this-> afficher = $afficher;
    }    
    // Getters
    public function getIdCavalier() {
        return $this->idcavalier;
    }

    public function getNomCavalier() {
        return $this->nomcavalier;
    }

    public function getPrenomCavalier() {
        return $this->prenomcavalier;
    }

    public function getDateNaissanceCavalier() {
        return $this->datenaissancecavalier;
    }

    public function getNomResponsable() {
        return $this->nomresponsable;
    }

    public function getRueResponsable() {
        return $this->rueresponsable;
    }

    public function getTelResponsable() {
        return $this->telresponsable;
    }

    public function getEmailResponsable() {
        return $this->emailresponsable;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getNumLicence() {
        return $this->numlicence;
    }

    public function getNumAssurance() {
        return $this->numassurance;
    }

    public function getIdCommune()
    {
        $oCommune = new Commune('','','');
        return $macommune = $oCommune->getIdCommune();
    }

    public function getIdGalop() {
        return $this->idgalop;
    }

    public function getAfficher()
    {
        return $this->afficher;
    }

    // Setters
    public function setIdCavalier($idcavalier) {
        $this->idcavalier = $idcavalier;
    }

    public function setNomCavalier($nomcavalier) {
        $this->nomcavalier = $nomcavalier;
    }

    public function setPrenomCavalier($prenomcavalier) {
        $this->prenomcavalier = $prenomcavalier;
    }

    public function setDateNaissanceCavalier($datenaissancecavalier) {
        $this->datenaissancecavalier = $datenaissancecavalier;
    }

    public function setNomResponsable($nomresponsable) {
        $this->nomresponsable = $nomresponsable;
    }

    public function setRueResponsable($rueresponsable) {
        $this->rueresponsable = $rueresponsable;
    }

    public function setTelResponsable($telresponsable) {
        $this->telresponsable = $telresponsable;
    }

    public function setEmailResponsable($emailresponsable) {
        $this->emailresponsable = $emailresponsable;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setNumLicence($numlicence) {
        $this->numlicence = $numlicence;
    }

    public function setNumAssurance($numassurance) {
        $this->numassurance = $numassurance;
    }

    public function setIdCommune($idcommune)
    {
        $this->idcommune = $idcommune;
    }

    public function setIdGalop($idgalop) {
        $this->idgalop = $idgalop;
    }
    
    public function setAfficher($afficher)
    {
        $this->afficher = $afficher;
    }

    public function CavalierAll()
    {
        global $con;
        $sql = "SELECT * FROM cavalier WHERE afficher = True";
        $stmt = $con->query($sql);
        $cavaliers = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $cavaliers[] = new Cavalier(
                $row['idcavalier'], 
                $row['nomcavalier'], 
                $row['prenomcavalier'], 
                $row['datenaissancecavalier'], 
                $row['nomresponsable'], 
                $row['rueresponsable'], 
                $row['telresponsable'], 
                $row['emailresponsable'], 
                $row['password'], 
                $row['numlicence'], 
                $row['numassurance'], 
                $row['idcommune'], 
                $row['idgalop'],
                $row['afficher']
            );
        }
        return $cavaliers;
    }
        
    public function Cavalier_ajout($nomcavalier, $prenomcavalier, $datenaissancecavalier, $nomresponsable, $rueresponsable, $telresponsable, $emailresponsable, $password, $numlicence, $numassurance, $idcommune, $idgalop) {
        global $con;
        $data = [
            ":nomcavalier" => $nomcavalier,
            ":prenomcavalier" => $prenomcavalier,
            ":datenaissancecavalier" => $datenaissancecavalier,
            ":nomresponsable" => $nomresponsable,
            ":rueresponsable" => $rueresponsable,
            ":telresponsable" => $telresponsable,
            ":emailresponsable" => $emailresponsable,
            ":password" => $password,
            ":numlicence" => $numlicence,
            ":numassurance" => $numassurance,
            ":idcommune" => $idcommune,
            ":idgalop" => $idgalop,
        ];
        $sql = "INSERT INTO cavalier (nomcavalier, prenomcavalier, datenaissancecavalier, nomresponsable, rueresponsable, telresponsable, emailresponsable, password, numlicence, numassurance, idcommune, idgalop, afficher) 
                VALUES (:nomcavalier, :prenomcavalier, :datenaissancecavalier, :nomresponsable, :rueresponsable, :telresponsable, :emailresponsable, :password, :numlicence, :numassurance, :idcommune, :idgalop, 1)";
        $stmt = $con->prepare($sql);
        $stmt->execute($data);
    }
        
    public function Modifier($idcavalier, $nomcavalier, $prenomcavalier) {
        global $con;
        $data = [
            ":nomcavalier" => $nomcavalier,
            ":prenomcavalier" => $prenomcavalier
        ];
        $sql = "UPDATE cavalier SET nomcavalier = :nomcavalier, prenomcavalier = :prenomcavalier WHERE idcavalier = :idcavalier";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idcavalier', $idcavalier);
        $stmt->execute($data);
    }
    public function Cavalier_supp($idcavalier) {
        global $con;
        $sql = "UPDATE cavalier SET afficher = False WHERE idcavalier = :idcavalier";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idcavalier', $idcavalier);
        $stmt->execute();  
    }
        
}
