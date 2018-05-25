<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author Jout
 */
class login extends Controller{
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
$this->view->setTitle("Liste d'utilisateurs");
$this->view->setTabtitle('Utilisateurs');
if(isset($x)){


if($x==false || !is_int($x)){
$position=0;}

}
else{
    $position=0;
}
if(is_string($x)){
    $position=(int)$x;
}

$prevpos=$position-10;
$nextpos=$position+10;

//$count= $this->manager->getCount();

//$content= $this->manager->getList($position);
//$nbrpage=ceil($count/10);
//$this->view->setContent($this->getusers($content,$prevpos,$nextpos,2));
        
    }
    
    public function get(){
        return $this->view;
    }
    
   
  

}
