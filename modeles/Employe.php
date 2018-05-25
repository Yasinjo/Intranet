<?php

class Employe{
    
    private $idEmploye;
    private $Nom;
    private $Prenom;
    private $motDePass;
    private $Email;
    private $Tel;
    private $profil;
    private $service;
  
   /* function __construct($idEmploye, $Nom, $Prenom, $Login, $motDePass, $Email, $Tel,Profil $prof,Service $serv) {
        $this->idEmploye = $idEmploye;
        $this->Nom = $Nom;
        $this->Prenom = $Prenom;
        $this->Login = $Login;
        $this->motDePass = $motDePass;
        $this->Email = $Email;
        $this->Tel = $Tel;
        $this->profil = $prof;
        $this->service = $serv;
        
    }*/

    function getService() {
        return $this->service;
    }
    
    function getProfil() {
        return $this->profil;
    }
    
        function setService(Service $serv) {
         $this->service=$serv;
    }
    
    function setProfil(Profil $prof) {
         $this->profil=$prof;
    }
    
    function getIdEmploye() {
        return $this->idEmploye;
    }
    function getNom() {
        return $this->Nom;
    }

    function getPrenom() {
        return $this->Prenom;
    }
    function getMotDePass() {
        return $this->motDePass;
    }

    function getEmail() {
        return $this->Email;
    }

    function getTel() {
        return $this->Tel;
    }

    function setIdEmploye($idEmploye) {
        $this->idEmploye = $idEmploye;
    }

    function setNom($Nom) {
        $this->Nom = $Nom;
    }

    function setPrenom($Prenom) {
        $this->Prenom = $Prenom;
    }



    function setMotDePass($motDePass) {
        $this->motDePass = $motDePass;
    }

    function setEmail($Email) {
        $this->Email = $Email;
    }

    function setTel($Tel) {
        $this->Tel = $Tel;
    }

    function Authentifier($emManager) {
        
       
      $Existe=  $emManager->VerfierExistantce($this->Email,md5($this->motDePass), $this);
return $Existe;
    }
    function ChangermotPasse($nvpass,$emManager,$id) {
        
       
      $Existe=  $emManager->Modifierpass($nvpass, $id);
return $Existe;
    }
        function dmdInscription($emManager) {
      $Existe=  $emManager->demandeInscription($this->Email,md5($this->motDePass), $this);
return $Existe;
    }
    function accepterDemande($emManager,$id){
        
        $emManager->accepter($id);
 $emManager->supprimerDemande($id);
    }
       function refuserDemande($emManager,$id){
        
        $emManager->supprimerDemande($id);
    }
    
      function inscription($emManager){
        
        $emManager->inscription($this);
    }
    public function __toString() {
            }

}