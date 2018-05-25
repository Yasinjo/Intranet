<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmployeManager
 *
 * @author Jout
 */
class EmployeManager extends Manager{
      
 public function __construct()
{
parent::__construct();
}
public function ajouterEmploye(Employe $emp)
{
$q = $this->_db->prepare('INSERT INTO '.get_class($emp).' SET idEmploye=:ide,nom =:nm,prenom=:prenm,Email =:mail, motDePasse = :password, Tel = :tel, 
idService = :idserv,idProfil = :idprof');
$q->bindValue(':ide', $emp->getIdEmploye());
$q->bindValue(':nm', $emp->getNom());
$q->bindValue(':prenm', $emp->getPrenom());
$q->bindValue(':mail', $emp->getEmail());
$q->bindValue(':password', $emp->getMotDePass());
$q->bindValue(':tel', $emp->getTel());
$q->bindValue(':idserv', $emp->getService()->getIdService(), PDO::PARAM_INT);
$q->bindValue(':idprof', $emp->getProfil()->getIdProfil(), PDO::PARAM_INT);

$q->execute();
}
public function supprimerEmploye(Employe $emp)
{
$this->_db->exec('DELETE FROM '.get_class($emp).' WHERE idEmploye = '.$emp->getIdEmploye());
}
public function getEmpById(Employe $emp)
{
$q = $this->_db->query('SELECT *  FROM '.get_class($emp).'  WHERE idEmploye = '.$emp->getIdEmploye());
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return new Employe($donnees['idEmploye'],$donnees['nom'],$donnees['prenom'],
        $donnees['motDePasse'],$donnees['Email'],$donnees['Tel'],$donnees['idService'],$donnees['idProfil']);
}
public function getAllemp()
{
    $a=  array();
$q = $this->_db->query('SELECT idEmploye,Nom,Prenom,Email,Tel,nomService as Service FROM employe,service  where employe.idService=service.idService ;');

while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
    $a[]=$donnees;
}
return $a;
//new Employe($donnees['idEmploye'],$donnees['nom'],$donnees['prenom'],
    //    $donnees['motDePasse'],$donnees['Email'],$donnees['Tel'],$donnees['idService'],$donnees['idProfil']);
}


public function getCount(){
    $q = $this->_db->query('SELECT count(*) as nbrEmployes FROM employe');
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees['nbrEmployes'];
}
public function getCountIns(){
    $q = $this->_db->query('SELECT count(*) as nbrEmployes FROM employetmp');
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees['nbrEmployes'];
}

public function ModifierEmploye(Employe $emp)
{
$q = $this->_db->prepare('UPDATE '.get_class($emp).' SET nom =:nm,prenom=:prenm,Email =:mail, motDePasse = :password, Tel = :tel, 
idService = :idserv,idProfil = :idprof where idEmploye=:ide');

$q->bindValue(':nm', $emp->getNom());
$q->bindValue(':prenm', $emp->getPrenom());
$q->bindValue(':mail', $emp->getEmail());
$q->bindValue(':password', $emp->getMotDePass());
$q->bindValue(':tel', $emp->getTel());
$q->bindValue(':idserv', $emp->getService()->getIdService(), PDO::PARAM_INT);
$q->bindValue(':idprof', $emp->getProfil()->getIdProfil(), PDO::PARAM_INT);
$q->bindValue(':ide', $emp->getIdEmploye());
$q->execute();
}
public function Modifierpass($nv,$id)
{
   
   $nv=md5($nv);
$q = $this->_db->prepare('UPDATE employe SET  motDePasse = :password where idEmploye=:ide');

$q->bindValue(':password', $nv);

$q->bindValue(':ide', $id);
$q->execute();
}
public function setDb(PDO $db)
{
$this->_db = $db;
}

public function VerfierExistantce($mail,$password,$ins){

    $q = $this->_db->query("SELECT *  FROM ".strtolower(get_class($ins))."  WHERE Email = '".$mail."' and motDePasse = '".$password."'");
$donnees = $q->fetch(PDO::FETCH_ASSOC);

  if(!empty($donnees)){
        return array('id'=>$donnees['idEmploye'],'nom'=>$donnees['Nom'],'pass'=>$donnees['motDePasse'],'prenom'=>$donnees['Prenom'],
        'tel'=>$donnees['Email'],'tel'=>$donnees['Tel'],'profil'=>$donnees['idProfil']);}
    else  {
        
    return false;}
}
public function demandeInscription(){
    
    $q = $this->_db->query("SELECT idEmploye,Nom,Prenom,Email,Tel,nomService as Service FROM employetmp,service  where employetmp.idService=service.idService");
  $a=  array();


while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
    $a[]=$donnees;
}
return $a;
    
}
public function accepter($id){
       $q = $this->_db->prepare(" INSERT INTO employe (Nom,Prenom,Email,motDePasse,Tel,idService,idProfil) SELECT Nom,Prenom,Email,motDePasse,Tel,idService,idProfil FROM employetmp where idEmploye=:id");
       $q->bindValue(':id', $id);
       $q->execute();
}
public function supprimerDemande($id){
$this->_db->exec(" DELETE FROM employetmp where idEmploye=".$id);
      
       
}
public function lastId(){
       $q = $this->_db->query(" select max(idEmploye) as lastId from employe;");
           $q->execute();
           $donnees = $q->fetch(PDO::FETCH_ASSOC);
           return $donnees['lastId'];
}
public function inscription(Employe $emp){
    print_r($emp);
    $q = $this->_db->prepare('INSERT INTO employetmp SET Nom =:nm,Prenom=:prenm,Email =:mail, motDePasse = :password, Tel = :tel, 
idService = :idserv,idProfil = :idprof');
$q->bindValue(':nm', $emp->getNom());
$q->bindValue(':prenm', $emp->getPrenom());
$q->bindValue(':mail', $emp->getEmail());
$q->bindValue(':password', $emp->getMotDePass());
$q->bindValue(':tel', $emp->getTel());
$q->bindValue(':idserv', $emp->getService()->getIdService(), PDO::PARAM_INT);
$q->bindValue(':idprof', $emp->getProfil()->getIdProfil(), PDO::PARAM_INT);

$q->execute();
}


}
