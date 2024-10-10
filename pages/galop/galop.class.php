<?php

class Galop
{
    private $idgalop;
    private $libgalop;

    public function __construct($idgalop, $libgalop)
    {
        $this -> idgalop = $idgalop;
        $this -> libgalop = $libgalop;
    }

    public function getIdGalop()
    {
        return $this -> idgalop;
    }

    public function getLibGalop()
    {
        return $this -> libgalop;
    }

    public function setLibGalop($libgalop)
    {
        $this -> libgalop = $libgalop;
    }
}

?>