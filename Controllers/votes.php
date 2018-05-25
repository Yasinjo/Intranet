<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author Jout
 */
class votes extends Controller{
   
    
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
    public function vote() {
      
        extract($_POST);
        
        require '../modeles/Employe.php';
        require '../modeles/Emission.php';
        require '../modeles/Vote.php';
        require '../modeles/Video.php';
             
        $emp=new Employe();
        $em=Emission::init();
        Session::init();
        $idEmploye= Session::get('id');
        $emp->setIdEmploye($idEmploye);
        $em->setId_emis($id);
        $vt=new Vote(0, $vote.'',0, 0, $emp, $em);
        echo '<br><pre>';
         print_r($_POST);
         echo '<br></pre>';
         $vt->Voter($this->manager);
    }
        public function get(){
        return $this->view;
    }
    
}
