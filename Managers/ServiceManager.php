<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiceManager
 *
 * @author Jout
 */
class ServiceManager extends Manager {
     public function __construct()
{
parent::__construct();
}
public function ajouterService(Service $ins,$idDire)
{
$q = $this->_db->prepare('INSERT INTO '.get_class($ins).' SET nomService =:nServ,idDirection=:idd ');
$q->bindValue(':nServ', $ins->getNomService());
$q->bindValue(':idd', $idDire);

$q->execute();
}
public function supprimerService( $ins)
{
       
$this->_db->exec('DELETE FROM '.substr(get_class($this),0,7).' WHERE idService = '.$ins);
}
public function getServiceById($ins)
{
 $a=array();
$q = $this->_db->query('SELECT *  FROM service  WHERE idDirection = '.$ins);
while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
    $a[]=$donnees;
}
 
return $a;

}

public function getAllServices()
{
    $a=array();
$q = $this->_db->query('SELECT idService as "Id service",nomService as "Nom du service",direction FROM `service` as s,`direction` as d where d.idDirection=s.idDirection ');
while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
    
   $a[]=$donnees;
}
return $a;
}
public function getCount(Service $ins){

    $q = $this->_db->query('SELECT count(*) as nbrProfils FROM '.get_class($ins).'');
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees['nbrProfils'];

}
public function modifierService(Service $ins,$idDire)
{
    
$q = $this->_db->prepare('UPDATE '.get_class($ins).' SET nomService =:nServ,idDirection=:idd where IdService =:idServ');
$q->bindValue(':nServ', $ins->getNomService());
$q->bindValue(':idd', $idDire);
$q->bindValue(':idServ', $ins->getIdService());

$q->execute();

}
public function setDb(PDO $db)
{
   
$this->_db = $db;

}
    
    
    
}
