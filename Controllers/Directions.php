<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Directions
 *
 * @author Jout
 */
class Directions extends Controller{
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
             $tb= $this->manager->getAllDirections();
 $this->view->setContent($this->view->getTable($tb, substr(get_class($this),0,  strlen(get_class($this))),'Id direction',false,'dir'));
    }
        public function get(){
        return $this->view;
    }
    public function add(){
     
        $str='<div  class="video"><form id="dirad" action="?url='.get_class($this).'/doadd" method="POST">';
        
        $str.='<div class="panel"><div class="panel-body" style="">
            <a href="?url=admin" ><div style="none;" class="imoon imoon-home"> Acceuil</div></a> 
           <a href="?url=directions" ><div style="none;" class="fa fa-briefcase "> Directions</div></a>
            <div style="none;" class="fa fa-plus-square"> Ajouter</div>
<br><div class="panel-heading">
                           <center>    <div class="panel-title">Ajouter une direction
                            </div> </center> 
                        </div>  
                         
                     <center> 
                      <br><br>  
                            <div class="row">
                                <div class="allcp-form theme-info">
                                    <div class="col-md-8" style="margin-left:18%;">
                                        <div class="section">
                                            <label class="field">
                                                <input name="dirct" id="from2" class="gui-input" placeholder="Direction" type="text">
                                            </label>
                                        </div>
                                    </div>   </div>
                       <br><br><br><br>
                        <div class="allcp-form theme-info">
                            <a href="javascript:subm(\'dirad\');">   <div style=" position: relative;"  > <div style=" width:150px;font-weight: bold;"  class="btn ladda-button btn-info" data-style="contract" >
                                           Ajouter
                                       </div>
                                </div></a> 
                        </div>  </div> </div> </div>   ';
    

    
    $str.='</from></div></center>';
     $this->view->setContent($str);
}
public function doadd(){
    require '../modeles/Direction.php';
     $dirct=isset($_POST['dirct']) ? $_POST['dirct'] : null ;
 $s=new Direction(0, $dirct);
 $s->ajouterDirection($this->manager);
  header('location:?url=Directions/index/done');
}

 public function spr($a) {
         $this->manager->supprimerDirection($a);
           header('location:?url=directions/index/doned');
  }
   public function upd($a) {
         $dd=$this->manager->getDirectionById($a);
         
          
             $str='';
 


    
        $str='<div  class="video"><form id="dirup" action="?url='.get_class($this).'/doupd/'.$a.'" method="POST">';
        
        $str.='<div class="panel"><div class="panel-body" style="">
                 <a href="?url=admin" ><div style="none;" class="imoon imoon-home"> Acceuil</div></a> 
           <a href="?url=directions" ><div style="none;" class="fa fa-briefcase "> Directions</div></a>
            <div style="none;" class="fa fa-edit"> Modifier</div>
                        <center><div class="panel-heading">
                            <div class="panel-title">modifier une direction
                            </div>
                        </div>
                          </center>
                    
                      <br><br>
                    <center>        <div class="row" >
                                <div class="allcp-form theme-info" >
                                    <div class="col-md-8 "  style="margin-left:18%;">
                                        <div class="section">
                                            <label class="field">
                                                <input name="direct" id="from2" class="gui-input" placeholder="Direction" type="text" value="'. $dd['direction'].'">
                                            </label>
                                        </div>
                                    </div>   </div>
                 <br><br><br><br>
                        
                            <a href="javascript:subm(\'dirup\');" >   <div style=" position: relative;"  > <div style=" width:150px;font-weight: bold;"  class="btn ladda-button btn-info" data-style="contract" >
                                           Modifer
                                       </div>
                                </div></a> 
                   </div> </div> </div>   ';
    

    
    $str.='</from></div></center>';
   
    
    $str.='';
     $this->view->setContent($str);
          
          
  }
  public function doupd($param) {
 require '../modeles/Direction.php';
     $dirct=isset($_POST['direct']) ? $_POST['direct'] : null ;
 $s=new Direction($param, $dirct);
 $s->modifierDirection($this->manager);
 header('location:?url=Directions/index/doneu');
  }
}
