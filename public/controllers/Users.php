<?php

class Users extends RR_Controller {

    function __construct() {
        parent::__construct();
    }

    function defaultView() {

        RR_Session::start();
        $get = RR_Session::get('loggedin');
        if ($get == true) {
            // blijf op de pagina
            // en laad de admin view
            $this->validateUser(true, 'users');
        } else {
            // anders redirect trug naar de login pagina
            $this->validateUser(false);
        }
        $this->view->render('users', true, true);
    }

    function validateUser($loggedin = false, $view) {
        if ($loggedin == true) {
            $this->view->render($view, true, true);
        } elseif ($loggedin == false) {
            RR_Router::mainController();
            //header('Location: index');
            exit();
        }
    }

    /**
     * laad de voeg niewe user view
     */
    function add() {
        RR_Session::start();
        $get = RR_Session::get('loggedin');
        if ($get == true) {
            // blijf op de pagina
            // en laad de admin view
            $this->validateUser(true, 'newuser');
        } else {
            // anders redirect trug naar de login pagina
            $this->validateUser(false);
        }
    }

    function addUser() {


        /**
         * @todo filter alle inputs voor die worden toegekend aan de vars !
         */
        try {
            // 1 filter alle speciale chars
            $name = RR_Filter::htmlSpecialChars($_POST['name']);

            // 2 kijkt na of het een geldige email is
            $email = RR_Filter::validateEmail($_POST['email']);

            // wachtwoord wordt niet gefilterd, normaal gezien
            $password = $_POST['password'];

            // als we hier geraken dan zitten we goed !
            require 'public/models/users_model.php';
            $model = new Users_Model();
            
            
                $result = $model->add($name, $email, $password);
                if($result>0){
                    header('location: ../users/fetch');
                    //Router::init();
                }
        } 
        catch (Exception $exc) 
        {
            // sla de error message op
            RR_Session::start();
            RR_Session::set('error', $exc->getMessage());
            //RR_Session::set('error_origin', $_SERVER['REQUEST_URI']);
            $self = cleanRequestURI(__METHOD__);
            RR_Session::set('error_origin', __CLASS__);

            RR_Router::displayErrorPage();

            // abort de rest
            return;
        }
    }

    function fetch($id) {

        // dit mag autoloaded zijn..pff
        require 'public/models/users_model.php';
        $model = new Users_Model();

        try {

            if ($id) :
                $usersArr = $model->fetch($id);
            else :
                $usersArr = $model->fetch();
            endif;
            $this->view->users = $usersArr;

            // had hier problemen omdat ik verget was om de view te renderen
            $this->view->render('users', true, true);
        } catch (Exception $e) {
            
            RR_Session::start();
            RR_Session::set('error', $e->getMessage());

            RR_Router::displayErrorPage();
            exit();
        }
    }

}

?>
