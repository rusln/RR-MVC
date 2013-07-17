<?php

// hmm settings en admin hebben duplicate code,
// zou een base controller moeten hebben voor de public
// en private controllers !! 
class Settings extends RR_Controller {

    function __construct() {
        parent::__construct();
    }

    function defaultView($loggedin = false) {
        RR_Session::start();
        $get = RR_Session::get('loggedin');
        if ($get == true) {
            // blijf op de pagina
            // en laad de admin view
            $this->validateUser(true);
        } else {
            // anders redirect trug naar de login pagina
            $this->validateUser(false);
        }
    }

    function validateUser($loggedin = false) {
        if ($loggedin == true) {
            // hier halen we de gebruiker zijn gegevens op
            // dit kan ofwel door de gebruiker op te slaan in de session
//            RR_Session::start();
//            RR_Session::get('user');
//            
            // of een nieuwe query te maken met zijn id
            //$user->run();
            RR_Session::start();
            // dit wordt een array
            // pass de naam enzo naar de view, dit kan ook rechtstreeks
            // in de html zelf, maar wel coole functie
            $this->view->name = RR_Session::get('name');
            $this->view->email = RR_Session::get('email');
            $this->view->render('settings',true,true);
        }
        /// awkward ! !!
        elseif ($loggedin == false) {
            header('Location: index');
            exit();
        }
    }
    // de update begint uit de hand te lopen !!!!!!
    function update() {

        // 1 wat willen we updaten
        $name = $_POST['name'];
        $email = $_POST['email'];

        //1.1 check wat er is ingestuurd 

        if (isset($name) && isset($email)) {
            
            // haal de user uit de session
            RR_Session::start();
            $user = array(
                'name' => RR_Session::get('name'),
                'email'=> RR_Session::get('email')
            );
            if ($user['name']== $name && $user['email'] == 'email') {
                // als die gelijk zijn doe een return 
                echo 'niks veranderd';
                exit();
            } else {
                // 2 roep een model op om te updaten

                require 'public/models/settings_model.php';

                $settingsModel = new Settings_Model();

                //2.1 haal de id uit de session

                RR_Session::start();
                $id = RR_Session::get('id');

                // 3 doe de update

                try {
                    $settingsModel->update($name, $email, $id);


                    //4 toon dat de update is gelukt in een message
                    // dit werkt nie want de controller wordt opnieuw geladen
                    // dus de view gaat geen success property meer hebben
                    //$this->view->success = true; 

                    RR_Session::start();
                    RR_Session::set('settings_success', true);

                    // 5 als de update gelukt is refresh de view

                    header('Location: ../settings');
                } catch (Exception $e) {
                    // voeg de error aan de sessie 
                    RR_Session::start();
                    RR_Session::set('error', $e->getMessage());

                    // redirect naar de error pagina
                    header('Location: ../error');
                    exit();
                }
            }
        }
    }

    function updatePassword() {

        // 1 wat willen we updaten
        $oldPassword = $_POST['old-password'];
        $newPassword = $_POST['new-password'];

//        1.1 check wat er is ingestuurd en vergelijk met wat we hebben in de session
        // 2 roep een model op om te updaten

        require 'public/models/settings_model.php';

        $settingsModel = new Settings_Model();

        //2.1 haal de id uit de session

        RR_Session::start();
        $id = RR_Session::get('id');

        // 3 doe de update

        try {
            $result = $settingsModel->updatePassword($id, $oldPassword, $newPassword);
            
            header('Location: ../settings');
        } catch (Exception $e) {
            // voeg de error aan de sessie 
            RR_Session::start();
            RR_Session::set('error', $e->getMessage());

            // redirect naar de error pagina
            header('Location: ../error');
            exit();
        }
    }

}

?>
