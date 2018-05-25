<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfilManager
 *
 * @author Jout
 */
class ProfilManager extends Manager{
    //put your code here
    
     public function __construct()
{
parent::__construct();
}
public function ajouterProfil(Profil $ins)
{
$q = $this->_db->prepare('INSERT INTO '.get_class($ins).' SET profil =:prof');
$q->bindValue(':prof', $ins->getLibProfil());

$q->execute();
}
public function supprimerProfil(Profil $ins)
{
$this->_db->exec('DELETE FROM '.get_class($ins).' WHERE idProfil = '.$ins->getIdProfil());
}
public function getProfilById(Profil $ins)
{
$id = (int) $id->getIdA();
$q = $this->_db->query('SELECT *  FROM '.get_class($ins).'  WHERE idProfil = '.$ins->getIdProfil());
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return new Profil($donnees['idProfil'],$donnees['profil']);
}
public function getCount(Profil $ins){

    $q = $this->_db->query('SELECT count(*) as nbrProfils FROM '.get_class($ins).'');
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return $donnees['nbrProfils'];

}
public function modifierProfil(Profil $ins)
{
    
$q = $this->_db->prepare('UPDATE '.get_class($ins).' SET profil=:prof where idProfil=:idprof');
$q->bindValue(':prof', $ins->getLibProfil());
$q->bindValue(':idprof', $ins->getIdProfil());
$q->execute();

}
public function setDb(PDO $db)
{
    
$this->_db = $db;

}
    
}
