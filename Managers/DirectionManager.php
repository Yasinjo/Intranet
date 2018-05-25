<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of DirectionManager
 *
 * @author Jout
 */
class DirectionManager extends Manager{

 public function __construct()
{
parent::__construct();
}
public function ajouterDirection(Direction $ins)
{
$q = $this->_db->prepare('INSERT INTO '.get_class($ins).' SET direction =:direct');

$q->bindValue(':direct', $ins->getDirection());

$q->execute();
}
public function supprimerDirection($ins)
{
$this->_db->exec('DELETE FROM '.substr(get_class($this),0,9).'  WHERE idDirection = '.$ins);
}
public function getDirectionById($ins)
{

$q = $this->_db->query('SELECT *  FROM '.substr(get_class($this),0,9).'   WHERE idDirection = '.$ins);
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees;
}
public function getAllDirections()
{
$a=array();
$q = $this->_db->query('SELECT idDirection as "Id direction",direction as "Direction"  FROM direction ;');
while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
 $a[]=$donnees;
}
return $a;
}
public function getCount(Direction $ins){
    $q = $this->_db->query('SELECT count(*) as nbrDirections FROM '.get_class($ins).'');
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees['nbrDirections'];
}
public function modifierDirection(Direction $ins)
{
$q = $this->_db->prepare('UPDATE '.get_class($ins).' SET direction =:direct where idDirection=:idd');

$q->bindValue(':direct', $ins->getDirection());
$q->bindValue(':idd', $ins->getIdDirection());
$q->execute();
}
public function setDb(PDO $db)
{
$this->_db = $db;
}

}
