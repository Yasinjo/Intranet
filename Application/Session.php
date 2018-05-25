<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author khalil
 */
class Session {
   
    public static function init(){
    @session_start();
    }
        public static function set($clef,$valeur){
            
            $_SESSION[$clef]=$valeur;
        
    }
       public static function get($clef){
        if(isset($_SESSION[$clef])){
            
           return $_SESSION[$clef];
        }
           
    }
        public static function end(){
            session_destroy();
    }
}
