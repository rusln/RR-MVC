<?php

class Error extends RR_Controller {

    function __construct() {
        parent::__construct();
        
        
    }
    public function defaultView(){
        //1 open onze sessie
        RR_Session::start();
        
        //2 haal de pagina waar de error is gebeurt uit de sessie
        $this->view->location = '<br>this will be the fancy backbutton';
        
        //3 haal de error message op 
        $this->view->errorMessage = RR_Session::get('error');
        
        //4 gebruik de hulp methode voor de locatie
        
        $uri = RR_Session::get('error_origin');
        
        //5 voeg de locatie toe aan de view
        $this->view->errorOrigin = $uri;
        
        //6 render onze view 
        $this->view->render('error');
        
    }

}
?>
