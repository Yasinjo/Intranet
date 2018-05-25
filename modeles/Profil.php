<?php


class Profil {

    private $idProfil;
    private $libProfil;
    
    function __construct($idProfil, $libProfil) {
        $this->idProfil = $idProfil;
        $this->libProfil = $libProfil;
    }
    function getIdProfil() {
        return $this->idProfil;
    }

    function getLibProfil() {
        return $this->libProfil;
    }

    function setIdProfil($idProfil) {
        $this->idProfil = $idProfil;
    }

    function setLibProfil($libProfil) {
        $this->libProfil = $libProfil;
    }


    
}
