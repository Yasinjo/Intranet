<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vote
 *
 * @author Jout
 */
require 'Opinion.php';
class Vote extends Opinion{
    private $idVote;
    private $valeurVote;
    
    function __construct($idVote, $valeurVote,$id_opinion, $date_expression,Employe $emp, Emission $em) {
       parent::__construct($id_opinion, $date_expression,$emp,$em);
        $this->idVote = $idVote;
        $this->valeurVote = $valeurVote;
    }
    function getIdVote() {
        return $this->idVote;
    }

    function getValeurVote() {
        return $this->valeurVote;
    }

    function setIdVote($idVote) {
        $this->idVote = $idVote;
    }

    function setValeurVote($valeurVote) {
        $this->valeurVote = $valeurVote;
    }
      function voter($valeurVote) {
        $valeurVote->ajouterVote($this);
    }


}
