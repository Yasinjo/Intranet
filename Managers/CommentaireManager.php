<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentaireManager
 *
 * @author Jout
 */
class CommentaireManager extends Manager{
    //put your code here
             public function __construct()
{
parent::__construct();
}
public function ajouterCommentaire(Commentaire $ins)
{
    
    require '../Managers/OpinionManager.php';
    $o=new OpinionManager();
    $op=new Opinion(0, 0, $ins->getEmploye(), $ins->getEmission());
  $id=  $o->ajouterOpinion($op);
$q = $this->_db->prepare('INSERT INTO '.get_class($ins).' SET commentaire = :cmt,nbrLike = :nbrl,nbrDislike = :nbrD,idOpinion = :idO');
$q->bindValue(':cmt', $ins->getCommentaire());
$q->bindValue(':nbrl', 0);
$q->bindValue(':nbrD', 0);
$q->bindValue(':idO', $id);



$q->execute();
}
public function supprimerCommentaire(Commentaire $ins)
{
$this->_db->exec('DELETE FROM '.get_class($ins).' WHERE idCommentaire = '.$ins->getIdCommentaire());
}
public function getCommentaireById(Commentaire $ins)
{
$id = (int) $id->getIdA();
$q = $this->_db->query('SELECT *  FROM '.get_class($ins).'  WHERE idCommentaire = '.$ins->getIdCommentaire());
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return array($donnees['idCommentaire'],$donnees['commentaire'],$donnees['nbrLike'],$donnees['nbrDislike'],$donnees['idOpinion']);
}
public function cmts(){
$a=array();
$q = $this->_db->query('SELECT DISTINCT * FROM commentaire as c, employe as e, emission as em, opinion as o where c.idOpinion=o.idOpinion and e.idEmploye=o.idEmploye and o.idEmission = em.idEmission order by o.dateExpression desc');
while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
    $a[]=$donnees;
}
return $a;
}
public function getCount(){
    $q = $this->_db->query('SELECT count(*) as nbrcmts FROM commentaire');
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees['nbrcmts'];
}
public function modifierCommentaire(Commentaire $ins)
{
    
$q = $this->_db->prepare('UPDATE '.get_class($ins).' SET commentaire =:cmt,nbrLike=:nbrl,nbrDislike=:nbrD,idOpinion=:idO where idCommentaire =:idC');
$q->bindValue(':cmt', $ins->getCommentaire());
$q->bindValue(':nbrl', $ins->getNbrLikes());
$q->bindValue(':nbrD', $ins->getNbrDislikes());
$q->bindValue(':idO', $ins->getIdOpinion());
$q->bindValue(':idC', $ins->getIdCommentaire());

$q->execute();

}
public function voter($id,$val) {
    
    if($val==1){
          
$q = $this->_db->prepare('UPDATE commentaire SET nbrLike=nbrLike+1 where idCommentaire =:idC');
    }else{
            
$q = $this->_db->prepare('UPDATE commentaire SET nbrDislike=nbrDislike+1 where idCommentaire =:idC');
    }
    $q->bindValue(':idC', $id);
    $q->execute();
}
public function setDb(PDO $db)
{
   
$this->_db = $db;

}
    
}
