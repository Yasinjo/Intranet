<?php
class Opinion {
    
    protected $idOpinion;
    protected $dateExpression;
    protected $employe;
    protected $emission;
    function __construct($id_opinion, $date_expression,Employe $emp,  Emission $em) {
        $this->id_opinion = $id_opinion;
        $this->date_expression = $date_expression;
        $this->employe=$emp;
         $this->emission=$em;
    }
    function getIdOpinion() {
        return $this->idOpinion;
    }

    function getDateExpression() {
        return $this->dateExpression;
    }

    function setIdOpinion($idOpinion) {
        $this->idOpinion = $idOpinion;
    }
    function getEmploye() {
        return $this->employe;
    }

    function setEmploye(Employe $employe) {
        $this->employe = $employe;
    }

        function setDateExpression($dateExpression) {
        $this->dateExpression = $dateExpression;
    }
    function getEmission() {
        return $this->emission;
    }

    function setEmission($emission) {
        $this->emission = $emission;
    }




}