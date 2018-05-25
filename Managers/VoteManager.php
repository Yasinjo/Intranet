<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VoteManger
 *
 * @author Jout
 */
class VoteManager extends Manager{
    //put your code here
          
     public function __construct()
{
parent::__construct();
}
public function ajouterVote(Vote $ins)
{
       require '../Managers/OpinionManager.php';

    $o=new OpinionManager();
    $op=new Opinion(0, 0, $ins->getEmploye(), $ins->getEmission());
  $id=  $o->ajouterOpinion($op);

$q = $this->_db->prepare('INSERT INTO vote SET valeurVote =:vote,idOpinion =:id');
$q->bindValue(':vote', $ins->getValeurVote());
$q->bindValue(':id', $id);

$q->execute();
}
public function supprimerVote(Vote $ins)
{
$this->_db->exec('DELETE FROM '.get_class($ins).' WHERE idProfil = '.$ins->getIdVote());
}
public function getVoteById(Vote $ins)
{
$id = (int) $id->getIdA();
$q = $this->_db->query('SELECT *  FROM '.get_class($ins).'  WHERE idProfil = '.$ins->getIdVotet());
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return  array($donnees['idVote'],$donnees['valeurVote'],$donnees['idOpinion']);
}
public function getCount(Vote $ins){

    $q = $this->_db->query('SELECT count(*) as nbrProfils FROM '.get_class($ins).'');
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees['nbrProfils'];

}
public function modifierVote(Vote $ins)
{
    
$q = $this->_db->prepare('UPDATE '.get_class($ins).' SET valaurVote =:vVote,idOpinion=:idOp where idVote =:idv');
$q->bindValue(':vVote', $ins->getNomFichier());
$q->bindValue(':idOP', $ins->getNomDossier());
$q->bindValue(':idv', $ins->getIdVote());

$q->execute();

}
public function setDb(PDO $db)
{
   
$this->_db = $db;

}

}
