<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Direction
 *
 * @author Jout
 */
class Direction {
    
    private $idDirection;
    private $Direction;
    private $services;
    function __construct($idDirection, $Direction) {
        $this->idDirection = $idDirection;
        $this->Direction = $Direction;
        $this->services=array();
    }
    function getIdDirection() {
        return $this->idDirection;
    }

    function getDirection() {
        return $this->Direction;
        
    }

    function setIdDirection($idDirection) {
        $this->idDirection = $idDirection;
    }

    function setDirection($Direction) {
        $this->Direction = $Direction;
    }
function getServices(){
    return $services;
  
    
}
public function ajouterDirection($d){
    
    $d->ajouterDirection($this);
}
public function modifierDirection($d){
    
    $d->modifierDirection($this);
}
    
}
