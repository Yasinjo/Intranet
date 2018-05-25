<?php

class Controller {
protected static $view;
protected $manager;
    function __construct() {
        //echo 'Main controller<br />';
        $this->view = new View();
         Session::init();
         $this->view->setHeader();
    }
       public function getView(){
       return $this->view;
       
   }
      public function setView($x){
          $this->view=$x;
   }
    /**
     * 
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name, $modelPath = '../Managers/') {

$name=substr($name, 0, strlen($name)-1);
         
        $path = $modelPath . $name.'Manager.php';
        
        if (file_exists($path)) {
            require $modelPath .$name.'Manager.php';
            
            $modelName = $name . 'Manager';
          
            $this->manager = new $modelName();
        }      
      
    }

}