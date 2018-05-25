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
class Admin extends Controller{
   
    
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
        require '../Managers/CommentaireManager.php';
        require '../Managers/EmployeManager.php';
        require '../Managers/RecommandationManager.php';
        
        $emp=new EmployeManager();
        $cmt=new CommentaireManager();
        $rec=new RecommandationManager();
       $countemp= $emp->getCount();
       $countempins= $emp->getCountIns();
       $countcmt= $cmt->getCount();
       $countrec= $rec->getCount();
     
        
        
    $ctn='<div id="video" style="width:104%;margin-left:-22px;">
                <div class="panel">
                    <div class="panel-body" >

                        <div class="row" >
                            <div class="panel-heading">
                                <center><div class="panel-title">Tableau de bord
                                </div></center>
                            </div>
                             <h6 class="mt40 mb20" id="spy4"></h6>
                           
                                 <br><br><div class="row">
                    <div class="col-sm-6 col-xl-3">
                        <div class="panel panel-tile info-block info-block-bg-success">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-5 ph10 text-center ">
                                        <i class="imoon imoon-users2"></i>
                                    </div>
                                    <a href="?url=employes/dmds"><div class="col-xs-7 pl35 prn text-center">
                                        <h2>'.$countempins.'</h2>
                                        <h6>Nouvelles inscriptions</h6>

                                    </div>
                                    <div class="col-sm-12">
                                        <div class="info-block-stat">
                                          
                                        </div>
                                    </div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="panel panel-tile info-block info-block-bg-info">
                             <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-5 ph10 text-center">
                                        <i class="imoon imoon-user2"></i>
                                    </div>
                                    <a href="?url=employes/users"><div class="col-xs-7 pl35 text-center">
                                        <h2 class="">'.$countemp.'</h2>
                                        <h6 class="text-muted">Utilisateurs</h6>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="info-block-stat">
                                         
                                        </div>
                                    </div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="panel panel-tile info-block info-block-bg-warning">
                             <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-5 ph10 text-center">
                                        <i class="fa fa-thumbs-up"></i>
                                    </div>
                                    <a href="?url=videos/rec"><div class="col-xs-7 pl35 text-center">
                                        <h2 class="">'.$countrec.'</h2>
                                        <h6 class="text-muted">Total recommandations</h6>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="info-block-stat">
                                            
                                        </div>
                                    </div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="panel panel-tile info-block info-block-bg-system">
                             <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-5 ph10 text-center">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <a href="?url=commentaires/cmts"><div class="col-xs-7 pl35 text-center">
                                        <h2 class="">'.$countcmt.'</h2>
                                        <h6 class="text-muted">Commentaires</h6>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="info-block-stat">
                                      
                                        </div>
                                    </div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               </div> </div></div></div>';
    $this->view->setContent($ctn);
    }
        public function get(){
        return $this->view;
    }
    
}
?>
