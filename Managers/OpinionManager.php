<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OpinionManager
 *
 * @author Jout
 */
class OpinionManager extends Manager{
 
 public function __construct()
{
parent::__construct();
}
public function ajouterOpinion(Opinion $ins)
{

$q = $this->_db->prepare('INSERT INTO '.get_class($ins).' SET idEmission=:ido,idEMploye=:idemp ');
$q->bindValue(':ido', $ins->getEmission()->getId_emis());
$q->bindValue(':idemp', $ins->getEmploye()->getIdEmploye());

$q->execute();
return $this->_db->lastInsertId();
}
public function supprimerOpinion(Opinion $ins)
{
$this->_db->exec('DELETE FROM '.get_class($ins).' WHERE id = '.$ins->getIdOpinion());
}
public function getOpinionById(Opinion $ins)
{
$id = (int) $id->getIdA();
$q = $this->_db->query('SELECT *  FROM '.get_class($ins).'  WHERE id = '.$ins->getIdOpinion());
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return array($donnees['idOpinion'],$donnees['dateExpression'],$donnees['idEmploye']);
}
public function getCount(Opinion $ins){
    $q = $this->_db->query('SELECT count(*) as nbrOpinions FROM '.get_class($ins).' where idEmploye='.$ins->getEmploye()->getIdEmploye().';');
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees['nbrOpinions'];
}
public function modifierOpinion(Opinion $ins)
{
$q = $this->_db->prepare('UPDATE '.get_class($ins).' SET  dateExpression =:dateE,idEMploye=:idemp where idOpinion=:ido');


$q->bindValue(':dateE', $ins->getDateExpression());
$q->bindValue(':idemp', $ins->getEmploye()->getIdEmploye());
$q->bindValue(':ido', $ins->getIdOpinion());
$q->execute();
}
public function setDb(PDO $db)
{
$this->_db = $db;
}
    
}
