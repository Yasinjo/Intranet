<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Video
 *
 * @author Jout
 */
class Video {
    private $idVideo;
    private $nomFichier;
    private $nomDossier;
    private $taille;
    
    function __construct($idVideo, $nomFichier, $nomDossier, $Duree) {
        $this->idVideo = $idVideo;
        $this->nomFichier = $nomFichier;
        $this->nomDossier = $nomDossier;
        $this->taille = $Duree;
    }
  
    function getIdVideo() {
        return $this->idVideo;
    }

    function getNomFichier() {
        return $this->nomFichier;
    }

    function getNomDossier() {
        return $this->nomDossier;
    }



        function getTaille() {
        return $this->taille;
    }

    function setIdVideo($idVideo) {
        $this->idVideo = $idVideo;
    }

    function setNomFichier($nomFichier) {
        $this->nomFichier = $nomFichier;
    }

    function setNomDossier($nomDossier) {
        $this->nomDossier = $nomDossier;
    }

    function setTaille($Duree) {
        $this->taille = $Duree;
    }
    public function ajouterVideo($d){
       return $d->ajouterVideo($this);
        
    }


    
}
