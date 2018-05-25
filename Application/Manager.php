<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Managers
 *
 * @author jout
 */


    //put your code here
class Manager
{

    function __construct() {
/*try {
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
 $this->_db = new PDO('pgsql:dbname=gestioncourrier;host=localhost','postgres','admin',$pdo_options);
}
catch(PDOException $e) {
echo 'ERREUR DB: ' . $e->getMessage();
}*/
 {

try {
 $this->_db = new PDO('mysql:dbname=intranet;host=localhost','root','');
 $this->_db->exec('SET NAMES utf8');
}
catch(PDOException $e) {
echo 'ERREUR DB: ' . $e->getMessage();
}

    }
         


       // $this->_db = new PDO('mysql:host=localhost;dbname=gestioncourrier','root', '');
        // setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);

 }

}


