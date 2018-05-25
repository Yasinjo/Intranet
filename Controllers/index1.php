<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of help
 *
 * @author jout
 */
class index extends Controller{
    //put your code here
    
    public function __construct() {
      
        parent::__construct();
 
      
       
   
    }

        public function index(){
         $this->view->setContent('<script type="text/javascript">'
            . 'var = "<div class="form">
                    <form action="?url=CourrierArchive/ar" method="POST">
                <fieldset>
                    <legend>الإرساليات</legend>
                    <table class="tblform">
                   
                        <tr><td colspan="14"><label></label></td></tr>
                        <tr><td><label></label></td><td><label></label></td><td><label><input type="date" required id="dat2" name="dateArrivee" > </label></td><td><label>تاريخ الوصول</label></td><td><label></label></td></tr>
                    </table>
                </fieldset><input type="submit" value="تفعيل" class="sub" />
                        </form> </div>")</script>'
                   );
   
    }
    public function get(){
        return $this->view;
    }

}
