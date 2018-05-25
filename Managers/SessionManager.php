<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SessionManager
 *
 * @author Jout
 */
class SessionManager extends Manager{
    //put your code here
         public function __construct()
{
parent::__construct();
}
public function ajouterSession(Session $ins)
{
$q = $this->_db->prepare('INSERT INTO '.get_class($ins).' SET dateOn =:don,dateOff=:doff,idEmploye=:idE');
$q->bindValue(':don', $ins->getDateOn());
$q->bindValue(':doff', $ins->getDateOff());
$q->bindValue(':idE', $ins->getEmploye()->getIdEMploye());



$q->execute();
}
public function supprimerSession(Session $ins)
{
$this->_db->exec('DELETE FROM '.get_class($ins).' WHERE idProfil = '.$ins->getIdSession());
}
public function getSessionById(Session $ins)
{
$id = (int) $id->getIdA();
$q = $this->_db->query('SELECT *  FROM '.get_class($ins).'  WHERE idProfil = '.$ins->getIdSession());
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return  array($donnees['idSession'],$donnees['dateOn'],$donnees['dateOff'],$donnees['idEmploye']);
}
public function getCount(Session $ins){

    $q = $this->_db->query('SELECT count(*) as nbrProfils FROM '.get_class($ins).'');
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees['nbrProfils'];

}
public function modifierSession(Session $ins)
{
    
$q = $this->_db->prepare('UPDATE '.get_class($ins).' SET dateOn =:don,dateOff=:doff,idEmploye=:idE where idSession =:idS');
$q->bindValue(':don', $ins->getDateOn());
$q->bindValue(':doff', $ins->getDateOff());
$q->bindValue(':idE', $ins->getEmploye()->getIdEMploye());
$q->bindValue(':idS', $ins->getIdSession());

$q->execute();

}
public function setDb(PDO $db)
{
   
$this->_db = $db;

}
}
