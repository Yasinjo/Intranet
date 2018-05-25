<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Commentaires
 *
 * @author Jout
 */
class Commentaires extends Controller{
  private $cmt;
    
     function __construct() {
        parent::__construct();
    }
    public function index($x=false){
        
      
           if (isset($x)){
                if (strnatcmp($x, 'done')==0) {
                $this->view->setMsg("ajout réussi");
            }
                      if (strnatcmp($x, 'doneu')==0) {
                $this->view->setMsg("modification  réussi");
            }
            
                      if (strnatcmp($x, 'doned')==0) {
                $this->view->setMsg("suppression réussi");
            }
        }
    }
        public function get(){
        return $this->view;
    }
    
    public function cmts(){
           require '../modeles/Commentaire.php';
     $tb=  Commentaire::cmts($this->manager);
    $this->view->setContent($this->view->getInfCmt($tb, substr(get_class($this),0,  strlen(get_class($this))),'Id service'));
    }
    public function commenter(){

       extract($_POST);
      
       
        require '../modeles/Employe.php';
        require '../modeles/Emission.php';
        require '../modeles/Commentaire.php';
        require '../modeles/Video.php';
        $emp=new Employe();
        $em=Emission::init();
        Session::init();
        $idEmploye= Session::get('id');
        $emp->setIdEmploye($idEmploye);
        $em->setId_emis($id);
         $this->cmt=new Commentaire(0, $test,0, 0, 0, 0, $emp, $em);
        echo '<br><pre>';
         print_r($_POST);
         echo '<br></pre>';
         $this->cmt->commenter($this->manager);
        
        
        
    }
        public function vote(){

       extract($_POST);
      
       
        
 
        require '../modeles/Commentaire.php';
       
       
        
       Commentaire::vote($this->manager,$id,$vote);
        
        
        
    }
    
    
}
