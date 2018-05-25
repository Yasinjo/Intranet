<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Employes extends Controller{
private $emp;
    function __construct() {
        parent::__construct();
        require '../modeles/Employe.php';
        $this->emp=new Employe();
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
    public function dochSpw() {
            Session::init();
            extract($_POST);
       if(Session::get('p')=== md5($mpa)){
         
          Session::set('p',md5($password));
           $this->emp->ChangermotPasse($password,$this->manager,Session::get('id'));
           header('location: ?url=employes/chSpw');
           
       }else{
           
       }
      
    }
    public function chSpw($d=false) {
                   if (isset($x)){
                if (strnatcmp($x, 'done')==0) {
                $this->view->setMsg("Vous vez changer votre mot de passe");
            }
                      if (strnatcmp($x, 'doneu')==0) {
                $this->view->setMsg("modification  réussi");
            }
            
                      if (strnatcmp($x, 'doned')==0) {
                $this->view->setMsg("suppression réussi");
            }
        }else {
        $part=0;
        if(Session::get('Admin')!=1){
           $part=1;
        }
          if(Session::get('Admin')==1){
              $d=100;
            }else{
                $d=81;
            }
            $str='<center> <form method="post" id="fghm" action="?url=employes/dochSpw" >'
                . '<div id="video"><div class="forms-validation sb-l-o sb-r-c onload-check" style="width:'.$d.'%;margin-top:5px;;border-radius:3px;">'
                . ' <div class="panel ">
                    <div class="panel-body">
   <div class="panel-heading">
                                <div class="panel-title">Changer votre mot de passe
                                </div>
                            </div>
                            
                    <div class="row" style="margin-left:25%" >
                   
                            <br>
                                <div class="allcp-form theme-info">
                                    <div class="col-md-8">
                                        <div class="section">
                                            <label class="field prepend-icon">
                                                <input name="mpa" id="from2" class="gui-input" placeholder="Ancien mot de passe" type="password">
                                            <span class="field-icon">
                                            <i class="fa fa-lock"></i>
                                        </span>
</label>
                                        </div>
                                    </div>  
                                </div>
                                 <div class="allcp-form theme-info">
                                    <div class="col-md-8">
                               <div class="section">
                                    <h6 class="mb20 mt40" id="spy4">Nouveau mot de passe</h6>
                                    <label for="password" id="lbl" class="field prepend-icon">
                                        <input name="password" id="password" class="gui-input" placeholder="Nouveau mot de passe" type="password">
                                        <span class="field-icon">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </label>
                                </div></div></div>
                                 <div class="allcp-form theme-info">
                                    <div class="col-md-8">
                                <div class="section">
                                    <label for="repeatPassword" id="lbl1" class="field prepend-icon">
                                        <input name="repeatPassword"  id="repeatPassword" class="gui-input" placeholder="Répéter le mot de passe" type="password" onkeyup="check();">
                                        <span class="field-icon">
                                            <i class="fa fa-unlock"></i>
                                        </span>
                                    </label><br>
                                    <span class="state-error" id="err"  style="color : red; display:none;">Pas de correspondance entre les mot de passe </span></div>
                                    <span class="state-error" id="ok"  style="color : green; display:none;">Pas de correspondance entre les mot de passe </span></div>
                                                
      </div></div> <div style="" class="section text-center">
                                            <button type="submit" class="ph40 btn btn-bordered btn-primary">Valider
                                            </button>
                                        </div>    </div>
                           

                        </div>
                        
</div></div></div></form></center><script>function check(){
var p1=$("#password").val();
var p2=$("#repeatPassword").val();
if(p1===p2){
document.getElementById("lbl").className="field prepend-icon state-success" ;
document.getElementById("lbl1").className="field prepend-icon state-success" ;
$("#err").hide();
}else{

document.getElementById("lbl").className="field prepend-icon state-error" ;
document.getElementById("lbl1").className="field prepend-icon state-error" ;

$("#err").show();
}

}
</script>';
            if(Session::get('Admin')==1){
                $this->view->setContent($str);
            }else{
                
               $this->view->setMignature($str);
            }
                
        
    }}
 public function users(){
     
     $tb= $this->manager->getAllemp();
     $this->view->setContent($this->view->getTable($tb,get_class($this),'idEmploye',1,'users'));
}
public function singIn(){
    $str=' <form action="index.php?url=Employes/insc" method="POST"><div id="video">
                <div class="panel">
                    <div class="panel-body" >

                        <div class="row" >
                            <div class="panel-heading">
                                <div class="panel-title">Inscription
                                </div>
                            </div>
                             <h6 class="mt40 mb20" id="spy4">Veuillez saisir vos informations</h6>
                            <div class="allcp-form theme-info" style="margin-left: 23%;">


                                <div class="col-md-12" style="">
                                    <div class="section">
                                        <label class="field prepend-icon file file-fw">
                                            <div class="allcp-form theme-info">
                                                <div class="col-md-8">
                                                    <div class="section">
                                                        <label class="field prepend-icon">
                                                            <input name="nom" id="from2" class="gui-input" placeholder="Nom" type="text">
                                                            <span class="field-icon">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </label>
                                    </div>
                                </div>
                                        <div class="col-md-12" style="margin-top: -2.5%;">
                                    <div class="section">
                                        <label class="field prepend-icon file file-fw">
                                            <div class="allcp-form theme-info">
                                                <div class="col-md-8">
                                                    <div class="section">
                                                        <label class="field prepend-icon">
                                                            <input name="prenom" id="from2" class="gui-input" placeholder="Prénom" type="text">
                                                            <span class="field-icon">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </label>
                                    </div>
                                </div>
                                        <div class="col-md-12" style="margin-top: -2.5%;">
                                    <div class="section">
                                        <label class="field prepend-icon file file-fw">
                                            <div class="allcp-form theme-info">
                                                <div class="col-md-8">
                                                    <div class="section">
                                                        <label class="field prepend-icon">
                                                            <input name="mail" id="from2" class="gui-input" placeholder="Email" type="email">
                                                            <span class="field-icon">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </label>
                                    </div>
                                </div>
                                      <div class="allcp-form theme-info">


                                <div class="col-md-12" style="margin-top: -2.5%;">
                                    <div class="section">
                                        <label class="field prepend-icon file file-fw">
                                            <div class="allcp-form theme-info">
                                                <div class="col-md-8">
                                                    <div class="section">
                                                        <label id="lbl1" class="field prepend-icon">
                                                              <input name="password" id="password" class="gui-input" placeholder="Nouveau mot de passe" type="password">
                                                            <span class="field-icon">
                                                    <i class="fa fa-lock"></i>
                                                </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </label>
                                    </div>
                                </div>
                                                  <div class="col-md-12" style="margin-top: -2.5%;">
                                    <div class="section">
                                        <label class="field prepend-icon file file-fw">
                                            <div class="allcp-form theme-info">
                                                <div class="col-md-8">
                                                    <div class="section">
                                                        <label id="lbl" class="field prepend-icon">
                                                         <input name="repeatPassword"  id="repeatPassword" class="gui-input" placeholder="Répéter le mot de passe" type="password" onkeyup="check();">
                                                            <span class="field-icon">
                                                    <i class="fa fa-unlock"></i>
                                                </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </label>
                                    </div>
                                </div>
                                                  <div class="col-md-12" style="margin-top: -2.5%;">
                                    <div class="section">
                                        <label class="field prepend-icon file file-fw">
                                            <div class="allcp-form theme-info">
                                                <div class="col-md-8">
                                                    <div class="section">
                                                        <label  class="field prepend-icon">
                                                            <input name="tel" id="from2" maxlength="10" class="gui-input" placeholder="Téléphone" type="text">
                                                            <span class="field-icon">
                                                    <i class="fa fa-mobile-phone "></i>
                                                </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </label>
                                    </div>
                                </div>';
                                          
                                          
                                          
                                          
                                          
                                          
                                             require '../Managers/DirectionManager.php';
    $dm=new DirectionManager();
        
    $d=$dm->getAllDirections();   $str.=' <div class="col-md-12" style="margin-top: -2.5%;">
                                    <div class="section">
                                        <label class="field prepend-icon file file-fw">
                                            <div class="allcp-form theme-info">
                                                <div class="col-md-8">
                                                    <div class="section">
                                                        <label  class="field prepend-icon">';
                                                          $str.='<select class="form-control" id="d" onchange="chang();" name="direction">';
    $str.='<option value="0" disabled selected>Directions</option>'; foreach ($d as $value) {
           
             $str.='<option value="'.$value['Id direction'].'">'.$value['Direction'].'</option>';       
     }
      $str.='</select>';
                                                       $str.=' </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </label>
                                    </div>
                                </div>';
                                

     
                        
                                     


                                          
                                     $str.='     <div id="com"></div>
    </div>
                           
                                
                                                   <div class="col-md-12" style="margin-top: -2.5%;">
                                    <div class="section">
                                        <label class="field prepend-icon file file-fw">
                                            <div class="allcp-form theme-info">
                                                <div class="col-md-8">
                                                    <div class="section">
                                                        <label  class="field prepend-icon">
                                                          
                                                       <button style=" width:150px;margin-left: 150;" type="submit" class="btn ladda-button btn-info" data-style="contract" >
                                           S\'inscrire
                                        </button>
                                                            
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </label>
                                    </div>
                                                       
                                 
                                                       
                                </div><br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>    
                        </div>     
                   
                    </div>
 
                </div>
         

            </div></div>
        </form>
     ';
    $this->view->setMignature($str);
}

 public function auth() {
        $mail=isset($_POST['mail']) ? $_POST['mail'] : null ;
        $pass=isset($_POST['password']) ? $_POST['password'] : null ;
 
          $this->emp->setEmail($mail);
        $this->emp->setMotDePass($pass);
        
      $Existe= $this->emp->Authentifier($this->manager);
     
    if($Existe==false){
       if(isset($_GET['lng']) && $_GET['lng']=='ar'){
           $str="<span style='color:black;font-weight:bold;'> ! خــطــأ في المـعـلـومـات</span>";
       }else{
            $str="<span style='color:black;'>Erreur authentification ! </span>";
       }
        $this->view->setMsgErr($str);
          
    }else{   Session::init();
    $ad=false;
                    if ($Existe['profil'] == 1) {
                Session::set('Admin', 1);
                $ad=true;
            } else {
                Session::set('Admin', 0);
            }
            Session::set('Authentifie', 1);
            Session::set('p', $Existe['pass']);
             Session::set('Authentifie', 1);
          Session::set('Nom', $Existe['nom']);
          Session::set('id', $Existe['id']);
       
          Session::set('Prenon', $Existe['prenom']);
          if ($ad) {
          
                header('location: ?url=admin');
            } else {
                    if(isset($_GET['lng'])){
                   header('location: ?url=videos/mign&lng='.$_GET['lng']);
              }else{
              header('location: ?url=videos/mign&lng=fr');}
            }
        }
  }
    function logout() {
       Session::end();
      
  }
  public function dmds($x=false){
      
           if (isset($x)){
                if (strnatcmp($x, 'acc')==0) {
                $this->view->setMsg("Demande acceptée");
            }
                      if (strnatcmp($x, 'ref')==0) {
                $this->view->setMsg("Demande refusée");
            }
            
                      if (strnatcmp($x, 'doned')==0) {
                $this->view->setMsg("suppression réussi");
            }
        }
     $data =$this->emp->dmdInscription($this->manager);
      
      $str=''
                . '<div class="video">'
                . ' <div class="panel">
                    <div class="panel-body">
<a href="?url=admin" ><div style="none;" class="imoon imoon-home"> Acceuil</div></a> 
          <div style="none;" class="fa fa-user"> Inscriptions</div>
           <div style="none;" class="imoon imoon-users2 ">Demandes d\'inscription</div> 
               <center>         <div class="row">
                            <div class="panel-heading">
                                <div class="panel-title"> Demandes d"inscriptions
                                </div>
                            </div>
                            <h6 class="mt40 mb20" id="spy4">Liste des demandes</h6><div class="panel"><table style="border: 2px gray solid;border-radius=2px;" class="table table-bordered" border=1 >';
          $str.='<tr>'; 
          if(empty($data)){
              $str.=' <th><center>Aucune demande d\'inscription</center></th></tr>';
          }else{
               $tbheader=$data[0];
        $str.='<th><center></center></th>';
        foreach ($tbheader as $key =>$value) {
            $str.='<th>'.$key.'</th>';
           
        }    $str.='</tr>'; 
        foreach($data as $Value){
       $str.='<tr>'; 
       $str.='<td><center><a href="?url='.  (get_class($this)).'/accepterDemande/'.$Value['idEmploye'].'" title="Valider cette demande"><span class="sb-menu-icon imoon imoon-checkmark-circle"></span></a> <a href="?url='.(get_class($this)).'/refuserDemande/'.$Value['idEmploye'].'" title="Supprimer cette demande"><span class="sb-menu-icon imoon imoon-cancel-circle "></span></a></center></td>';
       foreach($Value as $val){
             $str.='<td>'.$val.'</td>';
       }
        
        
        $str.='</tr>';
        }
        
        
      
          }
         $str.='</table></div></div></div></div></center>';
        $this->view->setContent($str);
  }
  public function accepterDemande($id){
   
      $this->emp->accepterDemande($this->manager,$id);
          header('location: ?url=Employes/dmds/acc');
  }
    public function refuserDemande($id){
      
      $this->emp->refuserDemande($this->manager,$id);
       header('location: ?url=Employes/dmds/ref');
  }
  public function insc($x=false){
  
           if (isset($x) && $x!=false){
                if (strnatcmp($x, 'done')==0) {
                $this->view->setMsg("Inscription réussi, veuillez attendre la validation de votre compte ");
            }
                      if (strnatcmp($x, 'doneu')==0) {
                $this->view->setMsg("modification  réussi");
            }
            
                      if (strnatcmp($x, 'doned')==0) {
                $this->view->setMsg("suppression réussi");
            }    
        }else{
     
      
      extract($_POST);
      
        require '../modeles/Profil.php';
        require '../modeles/Service.php';
       
     $this->emp->setEmail($mail);
      $this->emp->setMotDePass(md5($password));
      $this->emp->setNom($nom);
      $this->emp->setPrenom($prenom);
      $this->emp->setTel($tel);
      $this->emp->setProfil(new Profil(2, "kj"));
      $this->emp->setService(new Service($service, "cv"));
      $this->emp->inscription($this->manager);

        header('location: ?url=Employes/insc/done');
        }
      
  }

 }