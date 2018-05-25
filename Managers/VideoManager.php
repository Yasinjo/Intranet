<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VideoManaget
 *
 * @author Jout
 */
class VideoManager extends Manager {
        
     public function __construct()
{
parent::__construct();
}
public function ajouterVideo(Video $ins)
{
$q = $this->_db->prepare('INSERT INTO '.get_class($ins).' SET NomFichier =:nFich,nomDossier=:nDoss,taille=:tail');
$q->bindValue(':nFich', $ins->getNomFichier());
$q->bindValue(':nDoss', $ins->getNomDossier());
$q->bindValue(':tail', $ins->getTaille());
$q->execute();

return $this->_db->lastInsertId();
}
public function supprimerVideo(Video $ins)
{
$this->_db->exec('DELETE FROM '.get_class($ins).' WHERE idProfil = '.$ins->getIdVideo());
}
public function getVideoById(Video $ins)
{
$id = (int) $id->getIdA();
$q = $this->_db->query('SELECT *  FROM '.get_class($ins).'  WHERE idProfil = '.$ins->getIdVideo());
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return new Profil($donnees['idProfil'],$donnees['profil']);
}
public function getCount(Video $ins){

    $q = $this->_db->query('SELECT count(*) as nbrProfils FROM '.get_class($ins).'');
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees['nbrProfils'];

}
public function modifierVideo(Video $ins)
{
    
$q = $this->_db->prepare('UPDATE '.get_class($ins).' SET NomFichier =:nFich,nomDossier=:nDoss,taille=:tail where idVideo =:idv');
$q->bindValue(':nFich', $ins->getNomFichier());
$q->bindValue(':nDoss', $ins->getNomDossier());
$q->bindValue(':tail', $ins->getTaille());
$q->bindValue(':idv', $ins->getIdVideo());

$q->execute();

}
public function setDb(PDO $db)
{
   $this->_db = $db;
}
    
    
}
