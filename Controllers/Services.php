<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Services
 *
 * @author Jout
 */
class Services extends Controller{

 
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
     
     $tb= $this->manager->getAllServices();
     $this->view->setContent($this->view->getTable($tb, substr(get_class($this),0,  strlen(get_class($this))),'Id service',false,'serv'));
    }
    
    public function get(){
        return $this->view;
    }
 public function add(){
     
    $str='';
    
            $str.= ' <div class="video" ><form class="form-horizontal" id="addserv" action="?url=services/doadd" method="POST"><div class="panel">

      
                  <div class="panel-body" style=""> <a href="?url=admin" ><div style="none;" class="imoon imoon-home"> Acceuil</div></a> 
           <a href="?url=services" ><div style="none;" class="fa fa-briefcase "> Services</div></a>
            <div style="none;" class="fa fa-plus"> Ajouter</div>
                      <center>    <div class="panel-heading">
                            <div class="panel-title">Ajouter un service
                            </div>
                        </div>
                       <center> 
                      <br><br>
                            <div class="row" style="margin-left:18%;">
                                <div class="allcp-form theme-info">
                                    <div class="col-md-8">
                                        <div class="section">
                                            <label class="field">
                                                <input name="nserv" id="from2" class="gui-input" placeholder="Sevice" type="text">
                                            </label>
                                        </div>
                                    </div>   </div>
                            
                            
                           <div class="allcp-form theme-info">
                        <div class="col-md-8">
                            <div class="section">
                                <label class="field">';
                                
require '../Managers/DirectionManager.php';
    $dm=new DirectionManager();
         $str.='<td>';
    $d=$dm->getAllDirections();
     $str.='<select class="form-control" name="direction">';
     foreach ($d as $value) {
             $str.='<option value="'.$value['Id direction'].'">'.$value['Direction'].'</option>';       
     }
      $str.='</select>';
                                   $str.= '</label>
                            </div>
                        </div>

             <br><br><br><br><br><br><br><br><br><br>
                        <div class="allcp-form theme-info">
                           <a href="javascript:subm(\'addserv\');">   <div style=" position: relative;"  > <div style=" width:150px;font-weight: bold;"  class="btn ladda-button btn-info" data-style="contract" >
                                           Ajouter
                                       </div>
                                </div></a> 
                        </div></div></div>';

    
    $str.='</div></div></form></center>';
     $this->view->setContent($str);
}
public function doadd(){
    require '../modeles/Service.php';
     $Nservice=isset($_POST['nserv']) ? $_POST['nserv'] : null ;
     $direction=isset($_POST['direction']) ? $_POST['direction'] : null ;
 $s=new Service(0, $Nservice);
 $s->ajouterService($direction);
   header('location:?url=Services/index/done');
}

 public function spr($a) {
         $this->manager->supprimerService($a);
           header('location:?url=Services/index/doned');
  }
   public function upd($a) {
         $dd=$this->manager->getServiceById($a);
         
          
  
  
    $str='';
      
            $str.= ' <div class="video"><form id="servup" action="?url=services/doupd/'.$a.'" method="POST"><div class="panel">

                  
                    <div class="panel-body" style=""> <a href="?url=admin" ><div style="none;" class="imoon imoon-home"> Acceuil</div></a> 
           <a href="?url=services" ><div style="none;" class="fa fa-briefcase "> Services</div></a>
            <div style="none;" class="fa fa-plus"> Modifer</div>
                    <center>    <div class="panel-heading">
                            <div class="panel-title">Modifier un service
                            </div>
                        </div>
                       <center> 
                      <br><br>
                            <div class="row" style="margin-left:18%;">
                                <div class="allcp-form theme-info">
                                    <div class="col-md-8">
                                        <div class="section">
                                            <label class="field">
                                                <input name="nserv" id="from2" class="gui-input" placeholder="Sevice" type="text" value="'.$dd['nomService'].'">
                                            </label>
                                        </div>
                                    </div>   </div>
                            
                            
                           <div class="allcp-form theme-info">
                        <div class="col-md-8">
                            <div class="section">
                                <label class="field">';
                                
  require '../Managers/DirectionManager.php';
    $dm=new DirectionManager();
  
    $d=$dm->getAllDirections();
     $str.='<select class="form-control" name="direction">';
     foreach ($d as $value) {
     $str.='<option value="'.$value['Id direction'].'"';
     if ($value['Id direction'] == $dd['idDirection']) {
                $str.= ' selected>';
            } else {
                $str.= ' >';
            }
            $str.='' . $value['Direction'] . '</option>';
        }
      $str.='</select>';
  
                                   $str.= '</label>
                            </div>
                        </div>

             <br><br><br><br><br><br><br><br><br><br>
                        <div class="allcp-form theme-info">
                          <a href="javascript:subm(\'servup\');">   <div style=" position: relative;"  > <div style=" width:150px;font-weight: bold;"  class="btn ladda-button btn-info" data-style="contract" >
                                           Modifer
                                       </div>
                                </div></a> 
                        </div></div></div>';

    
    $str.='</div></div></form></center>';
  
     $this->view->setContent($str);
          
          
  }
  public function doupd($param) {
       require '../modeles/Service.php';
     $Nservice=isset($_POST['nserv']) ? $_POST['nserv'] : null ;
     $direction=isset($_POST['direction']) ? $_POST['direction'] : null ;
     $this->manager->modifierService(new Service($param, $Nservice),$direction);
  
      header('location:?url=Services/index/doneu');
  }

}
