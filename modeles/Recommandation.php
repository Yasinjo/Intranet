

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of recommandation
 *
 * @author Jout
 */
require 'opinion.php';
class Recommandation extends Opinion{
   private $idRecommandation;
   private $Recommandation;
   
   function __construct($idRecommandation, $Recommandation,$id_opinion, $date_expression,Employe $emp,Emission $em) {
       parent::__construct($id_opinion, $date_expression,$emp,$em);
       $this->idRecommandation = $idRecommandation;
       $this->Recommandation = $Recommandation;
   }
   function getIdRecommandation() {
       return $this->idRecommandation;
   }

   function getRecommandation() {
       return $this->Recommandation;
   }

   function setIdRecommandation($idRecommandation) {
       $this->idRecommandation = $idRecommandation;
   }

   function setRecommandation($Recommandation) {
       $this->Recommandation = $Recommandation;
   }
   function recommander($param) {
       $param->ajouterRecommandation($this);
   }

}
