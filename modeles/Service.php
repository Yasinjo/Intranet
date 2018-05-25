<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Service
 *
 * @author Jout
 */
class Service {
    private $idService;
    private $nomService;
    
    function __construct($idService, $nomService) {
        $this->idService = $idService;
        $this->nomService = $nomService;
    }
    function getIdService() {
        return $this->idService;
    }

    function getNomService() {
        return $this->nomService;
    }

    function setIdService($idService) {
        $this->idService = $idService;
    }

    function setNomService($nomService) {
        $this->nomService = $nomService;
    }
    public function ajouterService($directionId){
        $sm=new ServiceManager();
        $sm->ajouterService($this, $directionId);
        
    }


}
