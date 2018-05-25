<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecommandationManager
 *
 * @author Jout
 */

class RecommandationManager extends Manager {

    public function __construct() {
        parent::__construct();
    }
    
    public function ajouterRecommandation(Recommandation $ins)
{
               require '../Managers/OpinionManager.php';

    $o=new OpinionManager();
    $op=new Opinion(0, 0, $ins->getEmploye(), $ins->getEmission());
  $id=  $o->ajouterOpinion($op);

$q = $this->_db->prepare('INSERT INTO recommandation SET Recommandation =:rec ,idOpinion=:ido ');
$q->bindValue(':rec', $ins->getRecommandation());
$q->bindValue(':ido', $id);

$q->execute();
}
public function supprimerRecommandation(Recommandation $ins)
{
$this->_db->exec('DELETE FROM '.get_class($ins).' WHERE idProfil = '.$ins->getIdService());
}
public function getRecommandationById(Service $ins)
{
$id = (int) $id->getIdA();
$q = $this->_db->query('SELECT *  FROM '.get_class($ins).'  WHERE idProfil = '.$ins->getIdService());
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return array($donnees['idService'],$donnees['nomService'],$donnees['idDirection']);
}
public function getCount(){

    $q = $this->_db->query('SELECT count(*) as nbrrecs FROM recommandation');
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees['nbrrecs'];

}
public function modifierRecommandation(Recommandation $ins,$idDire)
{
    
$q = $this->_db->prepare('UPDATE '.get_class($ins).' SET Recommandation =:rec ,idOpinion=:idowhere idRecommndation =:idRec');
$q->bindValue(':rec', $ins->getRecommandation());
$q->bindValue(':ido', $ins->getIdOpinion());
$q->bindValue(':idRec', $ins->getIdRecommandation());

$q->execute();

}
public function setDb(PDO $db)
{
   
$this->_db = $db;

}
    
    
}
