<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Commentaire
 *
 * @author Jout
 */
require 'Opinion.php';

class Commentaire extends Opinion {
  private $idCommentaire;
    private $Commentaire;
  private $nbrLikes;
  private $nbrDislikes;
  
  function __construct($idCommentaire,$Commentaire, $nbrLikes, $nbrDislikes,$id_opinion, $date_expression,Employe $emp,  Emission $em) {
       parent::__construct($id_opinion, $date_expression,$emp,$em);
      $this->idCommentaire = $idCommentaire;
        $this->Commentaire=$Commentaire;
      $this->nbrLikes = $nbrLikes;
      $this->nbrDislikes = $nbrDislikes;
   
  }
  function getIdCommentaire() {
      return $this->idCommentaire;
  }
  function getCommentaire() {
      return $this->Commentaire;
  }

  function setCommentaire($Commentaire) {
      $this->Commentaire = $Commentaire;
  }

    function getNbrLikes() {
      return $this->nbrLikes;
  }

  function getNbrDislikes() {
      return $this->nbrDislikes;
  }

  function setIdCommentaire($idCommentaire) {
      $this->idCommentaire = $idCommentaire;
  }

  function setNbrLikes($nbrLikes) {
      $this->nbrLikes = $nbrLikes;
  }

  function setNbrDislikes($nbrDislikes) {
      $this->nbrDislikes = $nbrDislikes;
  }
  function commenter($d){
      $d->ajouterCommentaire($this);
  }
   static function  vote($d,$id,$v){
      $d->voter($id,$v);
  }
     static function  cmts($d){
  return $d->cmts();
  }


}
