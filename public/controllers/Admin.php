<?php

class Admin extends RR_Controller{

    function __construct() {
        parent::__construct();
        
    }
    
    function defaultView($loggedin =false){
        RR_Session::start();
        $get = RR_Session::get('loggedin');
        if($get==true){
            // blijf op de pagina
            // en laad de admin view
            $this->validateUser(true);
        }else{
            // anders redirect trug naar de login pagina
            $this->validateUser(false);
            
        }
         
   }
    function validateUser($loggedin = false){
        if($loggedin == true){                     
            $this->view->render('admin',true,true);
        }
        elseif($loggedin == false){
            
            RR_Router::mainController();
            //header('Location: index');
            exit();
        }
    }
    
    

}
?>
