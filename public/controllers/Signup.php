<?php

class Signup extends RR_Controller {

    function __construct() {
        parent::__construct();
        
    }
    public function defaultView(){
        $this->view->render('signup');
    }
    /**
     * Deze is verantwoordelijk voor het aanmaken van een nieuwe gebruiker
     */
    public function user(){
        
        try{
        $user =  $this->getUser();
        }
        catch(Exception $e){
            RR_Session::start();
            RR_Session::set('error', $e->getMessage());
            header('Location: ../error');
            // niet zekre of het zo moet ?
            exit();
        }
        require 'public/models/signup_model.php';
        
        // maak onze signup model aan
        $newUser = new Signup_Model();
        try{
        // hebben we een result ?
        $result = $newUser->add($user);
        
        // als de result true is
        if ($result==true) {
            // render de succes page
            $this->view->render('registered');
        }else{
            // wow dit is overbodig 
            header('Location: ../signup ');
        }
        
        
        
        }
        catch(Exception $e){
            //var_dump($e);
            // duplicate code alweer…
            RR_Session::start();
            RR_Session::set('error', $e->getMessage());
            header('location: ../error');
            exit();
        }
        
        //var_dump($newUser);
        
        
    }
    // dit is mongools, alles wa te maken heeft met form data, verificatie
    // moet uiteindelijk in aparte classen
    public function getUser(){
        // dit is een beetje overdrijven, maar helpt wel met debuggen !!!
        
        // haal onze nieuwe gebruiker op 
        // trim alles eraf 
        
        // gaan alles een beetje  sanctioneren
        $name =trim($_POST['regName']);
        
        // hier gaan we onze input filteren
        
        $email = filter_var(trim($_POST['regEmail']),FILTER_VALIDATE_EMAIL);
        
        
        
        //
        $pass = trim($_POST['regPass']);
        
        
        // maak een nieuwe user array
        $user = array(
            'name'=>$name,
            'password'=>$pass,
            'email'=>$email);
        
        // kijk na er of geen empty strings tussen zitten
        foreach ($user as $key => $value) {
            if(strlen($value)==0){
                // waar moet ik die dan opvangen ??? :/
//                throw new Exception('de gebruiker is niet volledig');
//                return;
                
                // kan waarsch een algemene error exception class die
                // alle errors bjhoud maar voolopig moet het zo
                throw new Exception('user nie volledig ingevuld, damn');
            }
        }
        return $user;
    }
}

?>
