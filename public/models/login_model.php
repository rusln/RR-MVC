<?php

/**
 * Simple user model, nothing fancy
 * heel t db gebeuren moet echt ergens anders hoor 
 * want nu ist een soep ! :/
 *
 * @author rusln
 */
class Login_Model extends RR_Model {

//    public $name;
//    public $email;
//    public $password;

    public function __construct() {
        parent::__construct();
    }

    public function run($name, $password) {

        try {
            $query = $this->db->prepare(
                    "SELECT id,name,email 
                        FROM temp 
                        WHERE name = :name 
                        AND password = :password");
            $query->execute(array(
                ':name' => $name,
                ':password' => RR_Hash::run('md5', $password, RR_HASH_KEY)
            ));

            // get the result
            $result = $query->fetch(pdo::FETCH_ASSOC);
            //var_dump($result);
            $count = $query->rowCount();
        } catch (PDOException $exc) {
            throw new Exception('iets misgelopen in de db');
            exit();
        }
        if ($count > 0) {
            //login
            // dit is nog niet goed, zou moeten opschuiven naar de controller
            RR_Session::start();
            RR_Session::set('loggedin', true);
            RR_Session::set('name', $result['name']);
            RR_Session::set('email', $result['email']);

            // dit doen we om aan de configuraties te kunnen
            // t kan ook anders maar is ok…
            RR_Session::set('id', $result['id']);
            //RR_Session::set('id', array_pop($result));
            header('Location: ../admin');
        } else {

            // voorlopig een redirect
            //header('Location: ../login');
            //gooi nen exception , wohooo
            
            throw new Exception('de user of t wachtwoord klopt niet…oops');
            exit();
        }
    }

    // tijdelijke methodes die later toch trug in de query class zullen gaan
    public function add($user = array()) {
        
        // der moet een user zijn, doh, anderes exception... BAM
        if (empty($user)) {
            throw new Exception("no user info provided…oops");
        } else {
            
            try {
                $query = $this->db->prepare(
                        'INSERT INTO temp (name,password,email)
                    VALUES(:name,MD5(:password),:email)');
                $query->execute(
                        array(
                            ':name' => $user['name'],
                            ':password' => $user['password'],
                            ':email' => $user['email']
                ));
                // hebben we een user ?
                $query->rowCount();
            } catch (PDOException $e) {
                throw new Exception('something went terribly wrong in my db,pls try again.');
            }
        }
    }

}

?>
