<?php
class Login extends RR_Controller {

    function __construct() {
        parent::__construct();       
        //$this->view->msg = "<br>this is a dynamic message from the login controller<br>";
        
    }
    
    function defaultView(){
        $this->view->render('login');
    }

    function user() {
        
        // haal de naam en wachtwoord op
        $name = $_POST['name'];
        $pass = $_POST['password'];
        
        // maak user model aan en run de run method
        require 'public/models/login_model.php';
        $model = new Login_Model();
        
        
        //$run = $model->run($name,$pass);
        try{
            $model->run($name,$pass);
        }catch(Exception $e){
            //var_dump($e);
            RR_Session::start();
            RR_Session::set('error', $e->getMessage());
            
            RR_Router::displayErrorPage();
            //header('location: ../error');
            exit();
            
        }
     
    } 
    function logout(){
        RR_Session::destroy();
        
        RR_Router::mainController();
        //header('Location: ../index');
        exit();
    }
}

?>
