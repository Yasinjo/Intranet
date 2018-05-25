<?php

class Emission{
    
    private $id_emis;
    private $titre_fr;
    private $titre_ar;
    private $date_diffusion;
    private $date_publication;
    private $diffusion;
    private $diffusionSta;
    private $Video;
    
    function __construct($id_emis, $titre_fr, $titre_ar, $date_diffusion, $date_publication, $diffusion,Video $vid,$diffusionSta) {
        $this->id_emis = $id_emis;
        $this->titre_fr = $titre_fr;
        $this->titre_ar = $titre_ar;
        $this->date_diffusion = $date_diffusion;
        $this->date_publication = $date_publication;
        $this->diffusion = $diffusion;
        $this->Video = $vid;
        $this->diffusionSta=$diffusionSta;
    }
    public static function init(){
        $y=new self(0,'','','','','',new Video(0, "", "", ""),'');
        return $y;
    }
    function getVideo() {
        return $this->Video;
    }
    function getDiffusionSta() {
        return $this->diffusionSta;
    }

    function setDiffusionSta($diffusionSta) {
        $this->diffusionSta = $diffusionSta;
    }

        function setVideo(Video $Video) {
        $this->Video = $Video;
    }

        function getId_emis() {
        return $this->id_emis;
    }

    function getTitre_fr() {
        return $this->titre_fr;
    }

    function getTitre_ar() {
        return $this->titre_ar;
    }

    function getDate_diffusion() {
        return $this->date_diffusion;
    }

    function getDate_publication() {
        return $this->date_publication;
    }

    function getDiffusion() {
        return $this->diffusion;
    }

    function setId_emis($id_emis) {
        $this->id_emis = $id_emis;
    }

    function setTitre_fr($titre_fr) {
        $this->titre_fr = $titre_fr;
    }

    function setTitre_ar($titre_ar) {
        $this->titre_ar = $titre_ar;
    }

    function setDate_diffusion($date_diffusion) {
        $this->date_diffusion = $date_diffusion;
    }

    function setDate_publication($date_publication) {
        $this->date_publication = $date_publication;
    }
    public function __toString() {
        $t= '<br>'.$this->titre_fr;;
       $t.=  '<br>'.$this->date_diffusion;;
        $t.=   '<br>'.$this->diffusion;;
        $t.=   '<br>'.$this->titre_ar;;
      $t.=   '<br>'.$this->date_publication;;
       $t.=   '<br>'.$this->diffusionSta;;
     //  $t.=   '<br>'.$this->Video->getIdVideo();;
       return $t;
    }
    function setDiffusion($diffusion) {
        $this->diffusion = $diffusion;
    }
    public function ajouterEmission($d)
    {
      
        
    $d->ajouterEmission($this);
    }
       public function search($d,$q)
    {
      
        
   return $d->search($q);
    }
           public function del($d)
    {
      
        
   return $d->del();
    }
             public function delID($d,$id)
    {
      
        
    $d->delId($id);
    }
             public function rec($d)
    {
      
        
    return $d->getStats();
    }

    
    
}