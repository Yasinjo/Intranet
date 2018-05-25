<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of Videos
 *
 * @author Jout
 */
class Videos extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index($x = false) {

        if (isset($x)) {
            if (strnatcmp($x, 'done') == 0) {
                $this->view->setMsg("ajout réussi");
            }
            if (strnatcmp($x, 'doneu') == 0) {
                $this->view->setMsg("modification  réussi");
            }

            if (strnatcmp($x, 'doned') == 0) {
                $this->view->setMsg("suppression réussi");
            }
        }
    }

    public function get() {
        return $this->view;
    }
    
    public function search(){
        
        require '../Managers/EmissionManager.php';
        require '../modeles/Emission.php';
        require '../modeles/Video.php';
        $emm=new EmissionManager();
        $em=new Emission(0, 0, 0, 0, 0, 0,new Video(0,0,0,0), 0);
        
    if(isset($_POST['search']) && !empty($_POST) && $_POST['search']!="") {
       
        $keywords = explode(' ', $_POST['search']);
        // J'initialise ma variable pour la requête SQL
     
        $like = "";
        foreach($keywords as $keyword) {
            // Si le mot clé est supérieur à 3 caractères (tu n'es pas obligé)
          
                // Je concatène
                // Le % en SQL est un joker, ça remplace n'importe quel caractère. Si tu veux que se soit une recherche explicite retire les %
                  	 	 	 	 	 	
                $like.= " e.titre_fr LIKE '%".$keyword."%' OR";
                $like.= " e.titre_ar LIKE '%".$keyword."%' OR";
                $like.= " e.dateDiffusion LIKE '%".$keyword."%' OR";
                $like.= " e.datePublication LIKE '%".$keyword."%' OR";
                $like.= " e.Diffusion LIKE '%".$keyword."%' OR";
                $like.= " e.ChaineStation LIKE '%".$keyword."%' OR";
            
        }
        // Je retire le dernier OR qui n'a pas lieu d'être
        $like = substr($like, 0, strlen($like) - 3);
      
       // Connexion à ta base de données
        $req = "SELECT DISTINCT * FROM emission as e,video  as v WHERE e.idVideo=v.idVideo and ( ".$like." )";
       
    $res=$em->search($emm, $req); Session::set("s", $res);

    header('Location:?url=videos/mign/s');
    } else {
        // Je n'ai rien, j'informe l'utilisateur 
        die('Veuillez saisir quelque chose dans le champs de recherche.');
    }
    }
    public function mign( $a=false){
        
        require '../modeles/Emission.php';
        require '../modeles/Video.php';
        require '../Managers/EmissionManager.php';
        if(($a)==="s"){
           $array= Session::get("s");
        
        }else{
      $em=new EmissionManager();
        $array=  $em->getMignature(); 
       
        }       
        $str='';
        
        if(empty($array)){
              $str.=' <center> <div style="width:81%;margin-top:5px;border-raduis:2px;" class=""><div class="panel">
                    <div class="panel-body" >

                        <div class="row" >
         
                          
                           
      
           <div style="height: 621px;" class="chute chute-center">

                <div class="mw1000 center-block">

                    <!-- Spec Form -->
                    <div class="allcp-form theme-info">
                        <div class="panel">
                           <center> <div class="panel-heading">
                                <div class="panel-title" >';
          
              $str.='
                                </div>
                            </div></center>
                           <div class="panel-body">
                                <center><form class=" " id="frmt" method="POST" action="?url=videos/search" >
                                   
                                        <div class="col-md-10">
                             
                                                <div class="smart-widget sm-right smr-75">
                                                    <label class="field">
                                                        <input name="search" id="sub2"';
                                           if(isset($_GET['lng']) && $_GET['lng']=='fr'){
                     $str.='style="text-align:left;" ';
              }else{
                         $str.='style="text-align:right" ';
              }                           
      $str.=' class="gui-input" placeholder="" type="text">
                                                    </label>
                                                    <button onClick="submitt();" class="button btn-info">Chercher</button>
                                                </div>
                                                <!-- /Block Widget -->
                                           </div>
                                         
           </form><script>function submitt(){
           document.getElementById("frmt").submit()}
           </script></center>
        <div style="margin:2%;padding:2%;float:left;position:relative;"><div class="row">        ';
               $str.="<center>Aucune résultat</center>";
        }else{
            
       
     
          // print_r($array);
    
        
        $str.=' <center>
      
           <div style="margin-top:5px;" class="chute chute-center">

                <div class="mw1100 center-block">

                    <!-- Spec Form -->
                    <div class="allcp-form theme-info">
                        <div class="panel">
                           <center> <div class="panel-heading">
                                <div class="panel-title" ';
            if(isset($_GET['lng']) && $_GET['lng']=='fr'){
                     $str.='style="text-align:left;">Vidéos';
              }else{
                     $str.='style="text-align:right;">فيديوهات البرامج';
              }
              
                               $str.= '</div>
                            </div></center>
                           <div class="panel-body ">
                                <center><form class=" " id="frmt" method="POST" action="?url=videos/search" >
                                   
                                        <div class="col-md-10 center-block">
                             
                                                <div class="smart-widget sm-';
                                     if(isset($_GET['lng']) && $_GET['lng']=='fr'){
                     $str.='right';
              }else{
                     $str.='left';
              }
                               $str.=' smr-75">
                                                    <label class="field">
                                                        <input name="search" id="sub2" class="gui-input" ';
                                                        
                               if(isset($_GET['lng']) && $_GET['lng']=='fr'){
                     $str.='style="text-align:left;" ';
              }else{
                         $str.='style="text-align:right" ';
              }         
$str.=' placeholder="" type="text">
                                                    </label>
                                                    <button onClick="submitt();" class="button btn-info">';
                                                          if(isset($_GET['lng']) && $_GET['lng']=='fr'){
                     $str.='Chercher';
              }else{
                     $str.='<span style="font-weight:bold;">بــحــث</span>';
              }
                              $str.='</button>
                                                </div>
                                                <!-- /Block Widget -->
                                           </div>
                                         
           </form><script>function submitt(){
           document.getElementById("frmt").submit()}
           </script></center>
        <div style="margin:2%;padding:2%;float:left;position:relative; "><div class="row">           ';
        foreach ($array as $value) {
             $videofile="../videos/$value[nomFichier]";
ob_start();
passthru("C:\\ffmpeg\\bin\\ffmpeg -i \"{$videofile}\" 2>&1");
$duration = ob_get_contents();
ob_end_clean();

$search='/Duration: (.*?),/';
$duration=preg_match($search, $duration, $matches, PREG_OFFSET_CAPTURE, 3);
//TEST ECHO
$duree=$matches[1][0];
$duree=  substr($duree, 0,  strlen($duree)-3);
          $d=  substr($value['nomFichier'], 0,  strlen($value['nomFichier'])-4);
                  $str.="<div class='col-sm-4 col-xl-3'>
                        <div class='panel  info-block'>
                            <div class='panel-body'>
                                <div class='row ' ><div><a style='color:blue;' href='?url=videos/lect/$value[idEmission]' >";
                       
                                        if(isset($_GET['lng']) && $_GET['lng']=='fr'){
                     $str.=$value['titre_fr'];
              }else{
                     $str.=$value['titre_ar'];
              }
                          
                                $str.="</a></div><br>" ;
                
            
            $str.='<span color=white></span>
   <div style="">';
            $str.="";
      $str.="<a href='?url=videos/lect/$value[idEmission]'><img style='vertical-align:top;' src='../mignatures/$d.jpg' /></a>";
   $str.="</div>";
    $str.='<div style="margin-left:10px;margin-top:-17px;text-align:left;">';
     $str.=" <span style='background-color:black;color:white;font-size:12px;font-weight:normal;'><b>$duree</b></span>";
     $str.="</div> 
</div>  ";
                 $str.="<div style='text-align:";
                                        if(isset($_GET['lng']) && $_GET['lng']=='fr'){
                     $str.="left;'";
                      $str.= "><br><span style='color:gray;font-size:12px;'>Chaine : $value[ChaineStation]</span>" ;
                  $str.="<br><span  style='color:gray;font-size:12px; '>Diffusé sur : $value[Diffusion]</span>" ;
                  $str.="<br><span  style='color:gray;font-size:12px; '>Publié le : $value[datePublication]</span>" ; 
              }else{
                     $str.="right;'";
                       $str.= "><br><span style='color:gray;font-size:12px;'>$value[ChaineStation] : القناة  </span>" ;
                  $str.="<br><span  style='color:gray;font-size:12px; '>  $value[datePublication] : تاريخ</span>" ;  
              }
                        
                  
                                   
                         $str.="   </div></div>
                        </div>
                    </div>  ";
        
            
        
            
        }}
       $str.= '
        </div></div>
        </center> 
        
';
        $this->view->setMignature($str);
        
        
    }
    
    
    
    public function lect($idEmission){
        
              require '../modeles/Emission.php';
        require '../modeles/Video.php';
        require '../Managers/EmissionManager.php';
   
        
        $em=new EmissionManager();
       $stat= $em->getStat($idEmission);
      
         $array=  $em->getVideoTolect($idEmission);
        extract($stat);
      
         $vid=$array[0]['nomDossier'].$array[0]['nomFichier'];
         $titre=$array[0]['titre_fr'];
        $str=' ';
        $str.="  <center> <div style='width:81%;margin-top:5px;border-radius:3px;border:1px #67E7EB solid;' class=''><div class='panel'>
                    <div class=panel-body' >

                        <div class='row' >  <a href='?url=videos/mign' >  <div class='imoon imoon-home' style='float:right; font-weight:bolder;padding:10px;'>";
                                 if(isset($_GET['lng']) && $_GET['lng']=='fr'){
                     $str.='Acceuil';
              }else{
                     $str.='الـرئيـسـيـة';
              }
                          
        $str.=" </div></a>
          
           <div style='color:black;font-size:20px;margin-top:35px;'> ";
                                 if(isset($_GET['lng']) && $_GET['lng']=='fr'){
               $str.=$array[0]['titre_fr'];
              }else{
                 $str.=$array[0]['titre_ar'];
              } 


        $str.="</div><center> <div id='vidlect'>
        <div id='in1'>
         <div id='in2'>
             <div id='in3'>
                 <div id='in3-1'></div>
                 <div id='in3-2'></div>
                 <div id='videos'>
                     <video src='$vid' controls ></video> 

 <div style='float:right;right:3%;margin-top: -3px;position:relative;border:1px solid;'>
                                    <div class='col-xs-5 ph10 text-center ' title=\"J'aime\">
            <a href='javascript:vote($idEmission,1,\"j\")'> <i style='margin-top: 3px;;font-size: 20px;

border-radius: 50%;
color:green;' class='imoon imoon-heart'></i></a>
                                    </div><span id='jaime' style='margin-left:5px;margin-top:2px;'>$jaime</span></div>
                                    
 <div style='float:right;right:3%;margin-top: -3px;position:relative;border:1px solid;'>
                                    <div class='col-xs-5 ph10 text-center '  title=\"J'aime pas\">
             <a href='javascript:vote($idEmission,-1,\"j\")'><i style='margin-top: 3px;;font-size: 20px;

border-radius: 50%;
color:red;' class='imoon imoon-heart-broken'></i></a>
                                    </div><span id='jaimep' style='margin-left:5px;margin-top:2px;'>$jaimep</span></div>

                   <div style='float:right;right:3%;margin-top: -3px;margin-right: 8px;position:relative; border:1px solid;'>
                   <div class='col-xs-5 ph10 text-center ' title=\"Je recommande\">
           <a href='javascript:vote($idEmission,1,\"r\")'>  <i style='margin-top: 3px;font-size: 20px;

border-radius: 50%;
color:green;' class='imoon imoon-thumbs-up'></i></a>
                                    </div><span id='rec' style='margin-left:5px;margin-top:2px;'>$rec</span></div> 
                                    <div style='float:right;right:3%;margin-top: -3px;position:relative;border:1px solid;'>
                                    <div class='col-xs-5 ph10 text-center ' title=\"je recommande pas\">
            <a href='javascript:vote($idEmission,-1,\"r\")'> <i style='margin-top: 3px;;font-size: 20px;

border-radius: 50%;
color:red;' class='imoon imoon-thumbs-up2'></i></a>
                                    </div><span id='recp' style='margin-left:5px;margin-top:2px;'>$recp</span></div></div>
               
        </div>
        </div>
        </div>
        </div></center><div id='centent'><div id='com'>
           ";
        
       $d= $em->getAllComment($idEmission);
       //print_r($d);
       $j=0;
       
      foreach ($d as $value) {
          $nomPrenom=$value['Nom'].'  '.$value["Prenom"];
         $comment=$value['commentaire'];
         $dt=$value['dateExpression'];
       $str.="<div id='centent1'><div id='video'>
                <div class='panel' style='background-color:#e6e6e6;'>
                    <div class='panel-body' >

                        <div class='row' >
                          <div class='panel-heading' >
                                <div class='panel-title'><span style='font-weight:bold;float:";
                           if(isset($_GET['lng']) && $_GET['lng']=='fr'){
           $str.="left;'>$nomPrenom</span> <span style='float:right";   
              }else{
                  $str.="right;'>$nomPrenom</span> <span style='float:left";
              } 
       
       
       $str.=";' >$dt</span>
                                </div>
                            </div>
                             <h6></h6>
     
        <div style='padding:15px;'>
               <span style='float: ";
                         if(isset($_GET['lng']) && $_GET['lng']=='fr'){
           $str.="left";   
              }else{
                  $str.="right";
              } 
       $str.=";'>$comment</span>
          <span style='float:";
                       if(isset($_GET['lng']) && $_GET['lng']=='fr'){
           $str.="right";   
              }else{
                  $str.="left";
              } 
       
      $str.= ";'> <div id='d".$j."'> <div style='font-size:12px;position:absolute;margin-top: 10px;margin-left:";
                  if(isset($_GET['lng']) && $_GET['lng']=='fr'){
           $str.="-36";   
              }else{
                  $str.="74";
              } 
        $str.= "px;background-color:white;padding-left:14px;width:35px;height:25px;'><span id='$j' >".($value['nbrLike']-$value['nbrDislike'])."</span></div><div style='background-color:green;float:right;margin-right: 10px;margin-top: 10px;position:relative;'><div class='col-xs-5 ph10 text-center '>
            <a href='javascript:voteComment($value[idCommentaire],1,$j)'><i style='margin-top: 5px;font-size: 16px;

border-radius: 50%;
color:white;' class='imoon imoon-heart'></i></a>
                                 </div></div> 
<div style='background-color:red;float:right;margin-top: 10px;'><div class='col-xs-5 ph10 text-center '>
<a href='javascript:voteComment($value[idCommentaire],-1,$j)'> 
    <i style='margin-top: 4px;;font-size: 16.5px;border-radius: 50%;color:white;' class='imoon imoon-heart-broken'></i></a>
                    </div></span>
                                    </div>
                                    </div></div></div></div>
                                    </div></div></div>
                                   ";
       
               $j++;}
       
     $ff= $em->lastC()+1;
  $str.="</div>
";
        $nomPrenom=Session::get('Nom').'  '.Session::get("Prenon");
  $dt=(new DateTime)->format('y-m-d h:m:s');
  $str.="
";   
  $str.="  <script> 
   
    function de(){ 
        $('#frm').submit(function (){
            est = $(this).find('textarea[name=cmt]').val();

            $.post('?url=Commentaires/commenter',{test:est,id:$idEmission},function(data){

 $('#com').append('<div id=\"centent1\"><div id=\"video\"><div class=\"panel\" style=\"background-color:#e6e6e6;\"><div class=\"panel-body\" ><div class=\"row\"><div class=\"panel-heading\" ><div class=\"panel-title\"><span style=\"font-weight:bold;\">$nomPrenom</span> <span style=\"float:right;\" >$dt</span></div></div><h6></h6><div style=\"padding:15px;\">'+est+'<div id=\"($j+1)\"><div style=\"background-color:green;float:right;margin-right: 10px;margin-top: 10px;position:relative;\"><div class=\"col-xs-5 ph10 text-center \"><a href=\"javascript:voteComment($ff,1,$j)\"><i style=\"margin-top: 5px;font-size: 16px;border-radius: 50%;color:white;\" class=\"imoon imoon-thumbs-up\"></i></a></div></div> <div style=\"background-color:red;float:right;margin-top: 10px;\"><div class=\"col-xs-5 ph10 text-center \"><a href=\"javascript:voteComment($ff,-1,$j)\"> <i style=\"margin-top: 4px;;font-size: 16.5px;border-radius: 50%;color:white;\" class=\"imoon imoon-thumbs-up2\"></i></a></div></div></div></div></div></div</div></div></div>').slideDown();
        $('#cmt').val(' ');
});
         
            return false;
        });
        
    }
    
    </script>  ";
  $str.='<div id="centent1">
      <div class="allcp-form theme-primary tab-pane mw900 " id="comment" role="tabpanel" style="border:1px gray solid;">
                            <div class="panel">
                                <div class="panel-heading text-';
  if(isset($_GET['lng']) && $_GET['lng']=='fr'){
           $str.='left ';   
              }else{
            $str.='right';
              } 
  $str.='">
  
  
                                    <span class="panel-title"  > ';

                if(isset($_GET['lng']) && $_GET['lng']=='fr'){
           $str.='Laisser un commentaire';   
              }else{
                  $str.='إضـافـة تـعـلـيـق';
              } 
  $str.='</span>
                                </div>
                                <!-- /Panel Heading -->

                                <form method="POST" action="#" id="frm">
                                    <div class="panel-body ">
                                        
                                        
                                        <!-- /section -->

                                        <div class="section">
                                            <label for="comment2" class="field prepend-icon">
                                              <textarea name ="cmt" class="gui-textarea br-b-l-r0 br-b-r-r0" id="cmt" placeholder="';
  
       if(isset($_GET['lng']) && $_GET['lng']=='fr'){
           $str.='Commentaire " style="text-align:left;" ';   
              }else{
                  $str.='تـعـلـيـق " style="text-align:right;"';
              } 
  $str.='></textarea>
                                                <span class="field-icon">
                                                    <i class="fa fa-comments"></i>
                                                </span>
                                               
                                            </label>
                                        </div>
                                        <!-- /section -->

                                        <div class="section text-';
  
   if(isset($_GET['lng']) && $_GET['lng']=='fr'){
           $str.='right ';   
              }else{
            $str.='left';
              } 
  $str.='">
                                            <input type="button" onclick="de();" class="ph40 btn btn-bordered btn-primary" value="';
  
   if(isset($_GET['lng']) && $_GET['lng']=='fr'){
           $str.='Poster votre commentaire ';   
              }else{
                  $str.='أضــف تـعـلـيـق';
              } 
  $str.='
                                            ">
                                        </div>
                                    </div>
                                </form>
                                <!-- /Form -->
                            </div>
                            <!-- /Panel -->
                        </div></div>';
  $str.='
';
  
  
  $this->view->setMignature($str);
        
        
    }

    public function add($x=false) {
  if (isset($x)) {
            if (strnatcmp($x, 'done') == 0) {
                $this->view->setMsg("ajout réussi");
            }
            if (strnatcmp($x, 'exis') == 0) {
                $this->view->setMsg("<center>Fichier déja existe</center>");
            }

            if (strnatcmp($x, 'err') == 0) {
                $this->view->setMsg("Une erreur s'est produite lors du téléchargement");
            }
        }
        $str = '';

        $str.='


        <div class="video">
            <form method="post" id="fghm" action="?url=videos/doadd" enctype="multipart/form-data">


                <!-- File Uploader -->
               <div class="panel">
                    <div class="panel-body">
        <a href="?url=admin" ><div style="none;" class="imoon imoon-home"> Acceuil</div></a> 
          <div style="none;" class="imoon fa fa-youtube-play"> Video</div>
           <div style="none;" class="fa fa-plus-square"> Ajouter</div> 
                        <div class="row">
                          <center>    <div class="panel-heading">
                                <div class="panel-title">Vidéo
                                </div>
                            </div>
                           <h6 class="mt40 mb20" id="spy4">Télécharger une vidéo</h6>
                            <div class="allcp-form theme-info">


                                <div class="col-md-12">
                                    <div class="section">
                                        <label class="field prepend-icon file file-fw">
                                            <span class="button btn-info">Choisir une vidéo</span>
                                            <input class="gui-file" name="f1" id="f1" onchange="change();" type="file">
                                            <input class="gui-input" id="up1" placeholder="Séléctionner une vidéo" type="text" >
                                        </label>
                                    </div>
                                </div>



                            </div>
                        </div>     
                        <br> 
                    </div>

                </div>
</center>

                <!-- /form -->
                 <div class="panel">

                    <div class="panel-body" style="">
                        <div class="panel-heading">
                            <center><div class="panel-title">Emission
                            </div></center>
                        </div>
                       <center>  <h6 class="mt40 mb20" id="spy4">Informations de l émission</h6>
                      
                            <div class="row"style="margin-left:25%" >
                            
                                <div class="allcp-form theme-info">
                                    <div class="col-md-8">
                                        <div class="section">
                                            <label class="field">
                                            
                                                <input name="titreFR" id="from2" class="gui-input" placeholder="Titre en français" type="text">
                                            </label>
                                        </div>
                                    </div>   </div>
                            
                            <div class="allcp-form theme-info">
                                <div class="col-md-8">
                                    <div class="section">
                                        <label class="field">
                                            <input name="titreAR" id="from2" class="gui-input" placeholder="Titre en Arabe" type="text">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="allcp-form theme-info">
                                <div class="col-md-8">
                                      <div class="section">
                                            <label for="datepicker1" class="field prepend-icon">
                                                <input type="text" id="datepicker" name="dated"
                                                       class="gui-input"
                                                       placeholder="Datepicker Popup">
                                                <span class="field-icon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </label>
                                        </div>
                                </div>
                           

                    </div>
                   
                    <div class="allcp-form theme-info">
                        <div class="col-md-8">
                            <div class="section">
                                <label class="field">
                                    <select class="form-control" id="dif" onchange="dif();" name="dif" >
                                        <option value="" disabled selected>Diffusion</option>
                                        <option value="Radio">Radio</option>
                                        <option value="Television">Télévision</option>
                                    </select></label>
                            </div>
                        </div>

                    </div>
                    <div id="rw"></div>
                   
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> <div  style=" width:120px;margin-left:20%;" class="pb20 col-xs-6 col-sm-4">
                                    <div class="bs-component" >
                                        <button style=" width:150px;" type="submit" class="btn ladda-button btn-info" data-style="contract" >
                                            <span class="ladda-label" id="jj" >Ajouter</span>
                                        </button>
                                    </div>
                                </div>
                </div>
</center>



        </div></div>
        </form>
        </div>




<script>
             $( "#dif" ).change(function() {
   f=$("#dif").val();
if(f==="Radio"){';
        $str.="
document.getElementById('rw').innerHTML='';
$('#rw').hide().append('<div class=\"allcp-form theme-info\"><div class=\"col-md-8\"><div class=\"section\" id=\"sec\"><label class=\"field\"><select class=\"form-control\" name=\"stat\"><option value=\"\" disabled selected>Station de diffusion</option><option>AlAoula</option><option>Laayoune TV</option><option>Arryadia</option><option>Athaqafia</option><option>Al Maghribia</option><option>Assadissa</option><option>Aflam TV</option></select></label></div></div></div>').slideDown();
}else{
document.getElementById('rw').innerHTML='';
$('#rw').hide().append('<div class=\"allcp-form theme-info\"><div class=\"col-md-8\"><div class=\"section\" id=\"sec\"><label class=\"field\"><select class=\"form-control\" name=\"stat\"><option value=\"\" disabled selected>Station de diffusion</option><option>AlIdaa Al Watania</option><option>Chaine Inter</option><option>Al Idaa Al Amazighia</option><option>Radio Mohammed VI du Saint Coran</option></select></label></div></div></div>').slideDown();

}
});"; 
        $str.='
function change(){
        document.getElementById("up1").value = document.getElementById("f1").value;

        }
       </script>';

        $str.='';
        $this->view->setContent($str);
        
    }

    public function doadd() {

        require '../modeles/Emission.php';
        require '../modeles/Video.php';
        require '../Managers/EmissionManager.php';
        $allowedExts = array("mkv", "flv", "wav", "mp3", "mp4", "wma");
        $extension = pathinfo($_FILES['f1']['name'], PATHINFO_EXTENSION);
        echo $extension;
        if ((($_FILES["f1"]["type"] == "video/mp4") || ($_FILES["f1"]["type"] == "audio/mp3") || ($_FILES["f1"]["type"] == "audio/wma") || ($_FILES["f1"]["type"] == "audio/wav") || ($_FILES["f1"]["type"] == "video/flv") || ($_FILES["f1"]["type"] == "video/kmv")) && in_array($extension, $allowedExts)) {

            $directory = '';
            $ffmpeg = 'C:\\ffmpeg\\bin\\ffmpeg';
            $isAudio = false;
            if (($_FILES["f1"]["type"] == "video/flv") || ($_FILES["f1"]["type"] == "video/mp4") || ($_FILES["f1"]["type"] == "video/kmv") || ($_FILES["f1"]["type"] == "video/wma")) {
                $directory = '../videos/';
            }
            if (($_FILES["f1"]["type"] == "audio/mp3") || ($_FILES["f1"]["type"] == "audio/wav")) {
                $directory = '../audios/';
                $isAudio = true;
            }

            if ($_FILES["f1"]["error"] > 0) {
               header('location:?url=videos/add/Err');
             
               $p= "Erreur : Code  " . $_FILES["f1"]["error"] . "<br />";
                
            } else {
                $dossier = $directory;
                $nom = $_FILES["f1"]["name"];
                $taille = ($_FILES["f1"]["size"] / 1024);


                if (file_exists($directory . $_FILES["f1"]["name"])) {
                     
                      header('location:?url=videos/add/exis');
             
                } else {
                   // echo '$_FILES["f1"]["tmp_name"]kjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjkkk '. $directory . $_FILES["f1"]["name"];
                    move_uploaded_file($_FILES["f1"]["tmp_name"], $directory . $_FILES["f1"]["name"]);
               
                  
                if ($isAudio) {

                    $nm = $directory . $_FILES["f1"]["name"];
                    $cmd = $ffmpeg.' -loop 1 -i p.png -i '.$nm.' -c:v libx264 -c:a aac -strict experimental -b:a 192k -shortest "' . substr($_FILES["f1"]["name"], 0, strlen($_FILES["f1"]["name"]) - 3).'"';
                    shell_exec($cmd);
                } else {
                    $nm = $directory . $_FILES["f1"]["name"];
                    $getfromsecond = 5;
                    $size = "215*120";
                    $img = '../mignatures/' . substr($_FILES["f1"]["name"], 0, strlen($_FILES["f1"]["name"]) - 3) . 'jpg';
                    $cmd = $ffmpeg.' -i "'.$nm.'" -an  -ss '.$getfromsecond.' -s '.$size.' "'. $img.'"';
                    shell_exec($cmd);
                }


               $titrFR = isset($_POST['titreFR']) ? $_POST['titreFR'] : null;
                $titreAR = isset($_POST['titreAR']) ? $_POST['titreAR'] : null;
                $datedif = isset($_POST['datedif']) ? $_POST['datedif'] : null;
                $dif = isset($_POST['dif']) ? $_POST['dif'] : null;
                $stat = isset($_POST['stat']) ? $_POST['stat'] : null;
                echo 'Startion : '.$dif;
                $v = new Video(1,$nom , $dossier, $taille);
                $LinsertedId = $v->ajouterVideo($this->manager);
                $v->setIdVideo($LinsertedId);
                $s = new Emission(0, $titrFR, $titreAR, $datedif, (new DateTime("NOW"))->format('y-m-d'), $dif,$v, $stat);
                $s->ajouterEmission(new EmissionManager());
              header('location:?url=videos/add/done');
            // $this->view->setMsg($s->__toString());
            }
           }
       } else {
           echo "Invalid file";
        }
    }

 

    public function upd($a) {
        $dd = $this->manager->getDirectionById($a);


        $str = '<center><form action="?url=' . get_class($this) . '/doupd/' . $a . '" method="POST"><table>';

        $str.='<tr>';
        $str.='<td>';
        $str.='<label>Direction';
        $str.='</label>';
        $str.='</td>';
        $str.='<td><input name="direct" id="sub2" class="gui-input" placeholder="Padding right 95" type="text" value="' . $dd['direction'] . '"/>';
        $str.='</td>';
        $str.='</tr>';


        $str.='<tr>';
        $str.='<td><button type="submit" class="button btn-info">Modifier</button>';
        $str.='</td>';
        $str.='</tr>';



        $str.='</table></center>';
        $this->view->setContent($str);
    }

    public function doupd($param) {
        require '../modeles/Direction.php';
        $dirct = isset($_POST['direct']) ? $_POST['direct'] : null;
        $s = new Direction($param, $dirct);
        $s->modifierDirection($this->manager);
        header('location:?url=Directions/index/doneu');
    }
    public function del(){
        require '../Managers/EmissionManager.php';
        require '../modeles/Emission.php';  
        require '../modeles/Video.php';  
        $emm=new EmissionManager();
        $em=new Emission(0, 0, 0, 0, 0, 0,new Video(0,0,0,0), 0);
        $tb= $em->del($emm);
        $this->view->setContent($this->view->getTable($tb,get_class($this),'Id',-1,'del'));
    }
       public function spr($id){              
        require '../Managers/EmissionManager.php';
        require '../modeles/Emission.php';  
        require '../modeles/Video.php';  
        $emm=new EmissionManager();
        $em=new Emission(0, 0, 0, 0, 0, 0,new Video(0,0,0,0), 0);
     $em->delID($emm,$id);
    header('location : ?url=vidoes/del');
    }
       public function rec(){
                      
        require '../Managers/EmissionManager.php';
        require '../modeles/Emission.php';  
        require '../modeles/Video.php';  
        $emm=new EmissionManager();
        $em=new Emission(0, 0, 0, 0, 0, 0,new Video(0,0,0,0), 0);
        $tb= $em->rec($emm);
        $this->view->setContent($this->view->getTable($tb,get_class($this),'idEmission',1,'del'));
    }

}
