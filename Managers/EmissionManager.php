<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmissionManager
 *
 * @author Jout
 */
class EmissionManager extends Manager{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ajouterEmission(Emission $ins)
{
$q = $this->_db->prepare('INSERT INTO '.get_class($ins).' SET titre_fr=:tFR, titre_ar=:tAR,dateDiffusion=:dDiffusion,Diffusion=:diffusion,ChaineStation=:ChSt,idVideo=:idvideo');

$q->bindValue(':tFR', $ins->getTitre_fr());
$q->bindValue(':tAR', $ins->getTitre_ar());
$q->bindValue(':dDiffusion', $ins->getDate_diffusion());
$q->bindValue(':diffusion', $ins->getDiffusion());
$q->bindValue(':ChSt', $ins->getDiffusionSta());
$q->bindValue(':idvideo', $ins->getVideo()->getIdVideo());

$q->execute();
}
public function supprimerEmission(Emission $ins)
{
$this->_db->exec('DELETE FROM '.get_class($ins).' WHERE id = '.$ins->getId_emis());
}
public function getEmissionById(Emission $ins)
{
$id = (int) $id->getIdA();
$q = $this->_db->query('SELECT *  FROM '.get_class($ins).'  WHERE id = '.$ins->getId_emis());
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return array($donnees['idEmission'],$donnees['titre_fr'],$donnees['titre_ar'],$donnees['dateDiffusion'],$donnees['datePublication'],$donnees['Diffusion'],$donnees['idVideo']);
}
public function getCount(Emission $ins){
    $q = $this->_db->query('SELECT count(*) as nbrEmissions FROM '.get_class($ins).'');
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees['nbrEmissions'];
}
public function modifierEmission(Emission $ins)
{
$q = $this->_db->prepare('UPDATE '.get_class($ins).' SET SET titre_fr=:tFR, titre_ar=:tAR,dateDiffusion=:dDiffusion,datePublication=:dPublication,Diffusion=:diffusion,ChaineStation=:ChSt,idVideo=:idvideo'
        . ' where idEmission=:idE');

$q->bindValue(':tFR', $ins->getTitre_fr());
$q->bindValue(':tAR', $ins->getTitre_ar());
$q->bindValue(':dDiffusion', $ins->getDate_diffusion());
$q->bindValue(':dPublication', $ins->getDate_publication());
$q->bindValue(':diffusion', $ins->getDiffusion());
$q->bindValue(':diffusion', $ins->getDiffusionSta());
$q->bindValue(':idvideo', $ins->getVideo()->getIdVideo());
$q->bindValue(':idE', $ins->getId_emis());
$q->execute();
}
public function setDb(PDO $db)
{
$this->_db = $db;
}
public function getMignature() {
    
    
$a=array();
$q = $this->_db->query('SELECT DISTINCT *  FROM emission as em,video as v  WHERE v.idVideo = em.idVideo ');
while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
    $a[]=($donnees);
}
 
    return $a;
}
public function getVideoTolect($idEmission) {
    
    
$a=array();
$q = $this->_db->query('SELECT * FROM emission as em,video as vid where vid.idVideo = em.idVideo and em.idEmission='.$idEmission);
while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
    $a[]=($donnees);
}
 
    return $a;
}
public function getAllRecommendation($idEmission) {
    
    
$a=array();
$q = $this->_db->query('SELECT * FROM emission as em,video as vid where vid.idVideo = em.idVideo and em.idEmission='.$idEmission);
while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
    $a[]=($donnees);
}
 
    return $a;
}
public function getAllComment($idEmission) {
    
    
$a=array();
$q = $this->_db->query('SELECT DISTINCT * FROM employe as emp,emission as em,video as vid,opinion as op, commentaire as c WHERE vid.idVideo = em.idVideo and '
        . 'em.idEmission=op.idEmission and op.idOpinion=c.idOpinion and emp.idEmploye=op.idEmploye and em.idEmission='.$idEmission);
while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
    $a[]=($donnees);
}
 
    return $a;
}
    public function lastC (){
          $q = $this->_db->query('SELECT max(idCommentaire) as id FROM commentaire;');
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees['id'];
    }
    public function getStat($idEmiss) {

$q = $this->_db->query('SELECT count(commentaire) as nbrcmt FROM Opinion as op, Emission as em,Commentaire as cmt where op.idEmission= em.idEmission and op.idOpinion= cmt.idOpinion and em.idEmission='.$idEmiss);
$donnees= $q->fetch(PDO::FETCH_ASSOC);
$q = $this->_db->query('SELECT count(valeurVote) as jaime FROM Opinion as op, Emission as em,vote as v where op.idEmission= em.idEmission and op.idOpinion= v.idOpinion and em.idEmission='.$idEmiss.' and v.valeurVote=1');
$donnees1= $q->fetch(PDO::FETCH_ASSOC);
$q = $this->_db->query('SELECT count(valeurVote) as jaimep FROM Opinion as op, Emission as em,vote as v where op.idEmission= em.idEmission and op.idOpinion= v.idOpinion and em.idEmission='.$idEmiss.' and v.valeurVote=-1');
$donnees2= $q->fetch(PDO::FETCH_ASSOC);
$q = $this->_db->query('SELECT count(recommandation) as rec FROM Opinion as op, Emission as em,Recommandation as re where op.idEmission= em.idEmission and op.idOpinion= re.idOpinion and em.idEmission='.$idEmiss.' and re.recommandation=1');
$donnees3= $q->fetch(PDO::FETCH_ASSOC);
$q = $this->_db->query('SELECT count(recommandation) as recp FROM Opinion as op, Emission as em,Recommandation as re where op.idEmission= em.idEmission and op.idOpinion= re.idOpinion and em.idEmission='.$idEmiss.' and re.recommandation=-1');
$donnees4= $q->fetch(PDO::FETCH_ASSOC);
    return array('nbrcmt'=>$donnees['nbrcmt'],'jaime'=>$donnees1['jaime'],'jaimep'=>$donnees2['jaimep'],'rec'=>$donnees3['rec'],'recp'=>$donnees4['recp']);

 
     
        
    }
    public function getStats() {

$q = $this->_db->query('SELECT em.idEmission,em.titre_fr as  "titre",em.dateDiffusion as "date de diffusion",em.datePublication as "date de Publication",em.ChaineStation as Chaine,count(valeurVote) as "nombre de j\'aimes" FROM Opinion as op, Emission as em,vote as v where op.idEmission= em.idEmission and op.idOpinion= v.idOpinion  and v.valeurVote=1 group by em.idEmission');
$d1=array();
while($donnees1= $q->fetch(PDO::FETCH_ASSOC)){
    $d1[]=$donnees1;
}
$q = $this->_db->query('SELECT count(valeurVote) as "nombre de j\'aime pas" FROM Opinion as op, Emission as em,vote as v where op.idEmission= em.idEmission and op.idOpinion= v.idOpinion and v.valeurVote=-1 group by em.idEmission');
$d2=array();
while($donnees2= $q->fetch(PDO::FETCH_ASSOC)){
    $d2[]=$donnees2;
}
$q = $this->_db->query('SELECT  count(recommandation) as Recommendations FROM Opinion as op, Emission as em,Recommandation as re where op.idEmission= em.idEmission and op.idOpinion= re.idOpinion  and re.recommandation=1 group by em.idEmission');
$d3=array();
while($donnees3= $q->fetch(PDO::FETCH_ASSOC)){
    $d3[]=$donnees3;
}
$q = $this->_db->query('SELECT  count(recommandation) as recp FROM Opinion as op, Emission as em,Recommandation as re where op.idEmission= em.idEmission and op.idOpinion= re.idOpinion and re.recommandation=-1 group by em.idEmission');
$d4=array();
while($donnees4= $q->fetch(PDO::FETCH_ASSOC)){
    $d4[]=$donnees4;
}

$r=array();
for($i=0;$i<count($d1);$i++){
    
    foreach ($d1 as $v){
       
        $g=array_merge($d1[$i],$d2[$i],$d3[$i],$d4[$i]);
 

        }
       $r[]=$g;
}
return $r;


     
        
    }
    
    
    public function search($qu) {
    
    
$a=array();
$q = $this->_db->query($qu);
while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
    $a[]=($donnees);
}
 
    return $a;
}
  public function del() {
    
    
$a=array();
$q = $this->_db->query("SELECT DISTINCT idEmission as Id,titre_fr,titre_ar,datePublication,Diffusion,ChaineStation,nomFichier FROM emission as e,video  as v WHERE e.idVideo=v.idVideo;");
while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
    $a[]=($donnees);
}
 
    return $a;
}
  public function delId($id) {
    
 
$q = $this->_db->query("SELECT  idVideo as id FROM emission WHERE idEmission=".$id);
$donnees = $q->fetch(PDO::FETCH_ASSOC);
    $a=($donnees['id']);

 $this->_db->exec('DELETE FROM emission WHERE idEmission = '.$id);
 $this->_db->exec('DELETE FROM video WHERE idVideo = '.$a);
 
}



}
