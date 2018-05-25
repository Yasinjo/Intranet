<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author jout
 */
class View {
    //put your code here
    private $title;
    private $msg;
    private $msge;
    private $tabtitle;
    private $mignature;
    private $content;
    private $header;
    private $footer;
    private $menu;
    public function setHeader(){
         Session::init();
         if(isset($_GET['lng'])) $lng=$_GET['lng']; else $lng='fr'; 
      
$str='<center>';
    
   $str.=' <div id="header" style="width:  ';
   if(Session::get('Authentifie')==1) 
       $str.='  100%;'; 
   else $str.=' 35%;';
   $str.='">';
           // <?php //if($lng=='fr') echo '<a href="?lng=ar" style="position : absolute;float : right;">الـــعــربــيــة</a>' ;// 
       // <?php //if($lng=='ar') echo '<a href="?lng=fr" style="float : left;">Français</a>'; 
   if(Session::get('Authentifie')==0){
       $str.='<center><img id="logo" src="images/snrt_ar_logo.png" /> </center>';}
   else{ $str.='<img id="logo"  src="images/snrt_ar_logo.png" style="float:'; 
 if ($lng === 'ar') {
                $str.=' right';
            } else {
                $str.=' left;';
                $str.='"/> ';
            }
        }
     
        if (Session::get('Authentifie') == 1) {
            $str.='<a href="?url=Employes/logout" style="float: ';
            if ($lng === 'ar') {
                $str.='left;" >';
                $str.='تسجيل الخروج    |  ';
            } else {
                $str.= 'right;">';
                $str.='  | Déconnection  </a>';
            }
           
            $str.=' <span style="float: ';
            if ($lng === 'ar') {
                $str.=' left;';
            } else {
                $str.=' right;">';
            }
            $str.= Session::get('Nom').' '.Session::get('Prenon').'  ' ;
        $str.='</span>';
  
    $str.='<a href="?url=Employe/chSpw" style="float:';
    if ($lng === 'ar') {
                $str.= 'left;">';
                 $str.= ' | تعديل كلمة السر';
            } else {
                $str.= 'right;" >';
                  $str.= '  changer le mot de passe |</a>';
            }
         
        }
  
  
$str.'</div></center>';
$this->header=$str;
    }
    public function getHeader(){
        return $this->header;
    }
    public function getTable(array $data,$class,$id,$i=false,$u=false){
        
        $str=''
                . '<div class="video">'
                . ' <div class="panel">
                    <div class="panel-body">';
        if($u==='users'){
$str.='  <a href="?url=admin" ><div style="none;" class="imoon imoon-home"> Acceuil </div></a> 
          <div style="none;" class="imoon imoon-user3 "> Employe </div>
        <div style="none;" class="fa fa-list"> Liste des utilisateurs </div> ';}
        if($u==='serv'){
$str.='  <a href="?url=admin" ><div style="none;" class="imoon imoon-home"> Acceuil </div></a> 
          <div style="none;" class="fa fa-briefcase  "> Services </div>
        <div style="none;" class="fa fa-list"> Liste des services </div> ';}
        if($u==='dir'){
$str.='  <a href="?url=admin" ><div style="none;" class="imoon imoon-home"> Acceuil </div></a> 
          <div style="none;" class="fa fa-briefcase  "> Directions </div>
        <div style="none;" class="fa fa-list"> Liste des directions </div> ';}
                if($u==='del'){
$str.='  <a href="?url=admin" ><div style="none;" class="imoon imoon-home"> Acceuil </div></a> 
          <div style="none;" class="fa fa-youtube-play  "> Videos </div>
        <div style="none;" class="fa fa-trash"> Supprimer videos </div> ';}
                        if($u==='rec'){
$str.='  <a href="?url=admin" ><div style="none;" class="imoon imoon-home"> Acceuil </div></a> 
          <div style="none;" class="fa fa-youtube-play  "> Videos </div>
        <div style="none;" class="imoon imoon-stats ">Statistique</div> ';}
                       $str.='<center> <div class="row">
                            <div class="panel-heading">
                                <div class="panel-title">'.$class.'
                                </div>
                            </div>
                            <h6 class="mt40 mb20" id="spy4">Liste des '.$class.'</h6><div class="panel"><table  class="table table-bordered" style="border: 2px gray solid;border-radius=2px;" >
                          ';
        
        
        $tbheader=$data[0];
        if(empty($tbheader)){
             $str.='<th><a href="?url=' . ($class) . '/add" title="Ajouter un ' . (substr(($class), 0, strlen($class) - 1)) . '"><span class="sb-menu-icon fa fa-plus-square"></span></a></th><th>Aucune donnée</th>';
        }else{
        $str.='<th><center>';
        
        if ($i == false) {
            $str.='<a href="?url=' . ($class) . '/add" title="Ajouter un ' . (substr(($class), 0, strlen($class) - 1)) . '"><span class="sb-menu-icon fa fa-plus-square"></span></a>';
        }
        ;
                $str.= '</center></th>';
        foreach ($tbheader as $key =>$value) {
            $str.='<th>'.$key.'</th>';
           
        }
        foreach($data as $Value){
       $str.='<tr>'; 
       $str.='<td>';
         if ($i == -1) {
             $str.= '<center><a href="javascript:cnf(\'Voulez vous supprimer ce '.substr(($class), 0, strlen($class) - 1).'\',\'?url=' . ($class) . '/spr/' . $Value[$id] . '\')" title="Supprimer un ' . substr(($class), 0, strlen($class) - 1) . '"><span class="sb-menu-icon fa fa-trash-o"></span></a></center>';
        }
       if ($i == false) {
                $str.= '<center><a href="?url=' . ($class) . '/upd/' . $Value[$id] . '" title="Modifier un ' . (substr(($class), 0, strlen($class) - 1)) . '"><span class="sb-menu-icon fa fa-edit"></span></a> <a href="?url=' . ($class) . '/spr/' . $Value[$id] . '" title="Supprimer un ' . substr(($class), 0, strlen($class) - 1) . '"><span class="sb-menu-icon fa fa-trash-o"></span></a></center>';
            }
            $str.= '</td>';
       foreach($Value as $val){
             $str.='<td>'.$val.'</td>';
       }
        
        
        $str.='</tr>';
        }
        
        }
        $str.='</table></div>';
        
                       $str.= '   </div>     
                        <br> 
                    </div>

                </div>'
                . ''
                . '';
       $str.'</div></center>';
        return $str;
        
    }
    public function getForme(){
        
        
    }
    
   public  function getTitle() {
         return $this->title;
     }
     function getMignature() {
         return $this->mignature;
     }

     function setMignature($mignature) {
         $this->mignature = $mignature;
     }

        public  function getTabtitle() {
         return $this->tabtitle;
     }

  public   function setTitle($title) {
         $this->title = $title;
     }
        public  function getMsg() {
         return $this->msg;
     }
     
             public  function getMsgErr() {
         return $this->msge;
     }

  public   function setMsg($title) {
         $this->msg ='<div class="messageBar" ><center>'.$title.'</center></div>';
     }
  public   function setMsgErr($title) {
         $this->msge ='<center> <div id="err" >'.$title.'
        

    
    </div></center>';
     }
   public  function setTabtitle($tabtitle) {
         $this->tabtitle = $tabtitle;
     }

          
    public    function __construct() {
        //echo 'this is the view';
            
    }

    public function render($name, $noInclude = false)
    {
        require '../web/' . $name . '.php';    
    }
    public function setContent($x){
        $this->content=$x;
    }
        public function getContent(){
       return  $this->content;
    }
    
    
    public function getInfCmt(array $data,$class,$id,$i=false){
        
        $str=''
                . '<div class="video">'
                . ' <div class="panel">
                    <div class="panel-body">
  <a href="?url=admin" ><div style="none;" class="imoon imoon-home"> Acceuil</div></a> 
          <div style="none;" class="fa fa-comments "> Commentaires</div>
           <div style="none;" class="fa fa-list"> Commentaires liste</div> 
                        <div class="row">
                          <center>  <div class="panel-heading">
                                <div class="panel-title">'.$class.'
                                </div>
                            </div>
                         <h6 class="mt40 mb20" id="spy4">Liste des '.$class.'</h6><div class="panel"></center>
                          ';
        
        
        $tbheader=$data[0];
        if(empty($tbheader)){
             $str.='<h3><th>Aucune donnée</h3>';
        }else{
     
                
        foreach($data as $Value){
            $str.='  <div class="col-sm-6 col-xl-3">
                        <div class="panel panel-tile info-block info-block-bg-info">
                             <div class="panel-body">
                                <div class="row">';
            $str.='<b>'.$Value['Nom']."  ".$Value['Prenom']."</b> a commenté sur l'émission <b>".$Value['titre_fr']."</b> le ".$Value['dateExpression'];
    
        $str.='<br>';
        $str.='<span style="margin-left:40px;"><b>Commentaire : </b></span>';
        $str.='<br><span style="margin-left:80px;">';
        $str.=''.$Value['commentaire'].''; $str.='</span><br>'
                
                . '<span style="margin-left:40px;"> <b>nombre de "j\'aime" </b>:  '.$Value['nbrLike'].'</span><br>'
                . '<span style="margin-left:40px;"> <b>nombre de "j\'aime pas " </b>:  '.$Value['nbrDislike'].'</span><br>        </div>
                            </div>
                        </div>
                    </div>';
              
        }
       
                                    
                        
        }
        $str.='</div>';
        
                       $str.= '   </div>     
                     <center>      <br> 
                    </div>

                </div>'
                . ''
                . '';
       $str.'</div></center>';
        return $str;
        
    }
    
    
}
