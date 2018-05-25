<?php
include '../Application/Session.php';
if(Session::get('Admin'==1)){
        header('location:  ../web/index.php?url=admin');
}else{
    header('location:  ../web/index.php?url=videos/mign');
}
  