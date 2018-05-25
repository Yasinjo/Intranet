<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author Jout
 */
class SessionIntranet {
    private $idSession;
    private $dateOn;
    private $dateOff;
    private $employe;
    
    function __construct($idSession, $dateOn, $dateOff,  Employe $emp) {
        $this->idSession = $idSession;
        $this->dateOn = $dateOn;
        $this->dateOff = $dateOff;
        $this->employe = $emp;
    }
    function getIdSession() {
        return $this->idSession;
    }

    function getDateOn() {
        return $this->dateOn;
    }

    function getDateOff() {
        return $this->dateOff;
    }

    function setIdSession($idSession) {
        $this->idSession = $idSession;
    }

    function setDateOn($dateOn) {
        $this->dateOn = $dateOn;
    }

    function setDateOff($dateOff) {
        $this->dateOff = $dateOff;
    }

    
       function getEmploye() {
           return $this->employe ;
    }

       function setEmploye(Employe $emp) {
        $this->employe = $emp;
    }



    
}
