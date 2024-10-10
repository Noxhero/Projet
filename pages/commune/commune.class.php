<?php

class Commune
{
    private $idcommune;
    private $ville;
    private $codepostal;
    
    public function __construct($idcommune, $ville, $codepostal)
    {
        $this -> idcommune = $idcommune;
        $this -> ville = $ville;
        $this -> codepostal = $codepostal;
    }

    public function getIdCommune()
    {
        return $this -> idcommune;
    }
    
    public function getVille()
    {
        return $this -> ville;
    }

    public function getCodePostal()
    {
        return $this -> codepostal;
    }

    public function setVille($ville)
    {
        $this -> ville = $ville;
    }

    public function setCodePostal($codepostal)
    {
        $this -> codepostal = $codepostal;
    }


}