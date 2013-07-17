<?php

/**
 * Simple user model, nothing fancy
 * heel t db gebeuren moet echt ergens anders hoor 
 * want nu ist een soep ! :/
 *
 * @author rusln
 */
class Settings_Model extends RR_Model {

//    public $name;
//    public $email;
//    public $password;

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type $name naam van de active gebruiker
     * @param type $email email van de active gebruiker
     * @param type $id id van de active gbruier
     * @throws Exception een pdo exception
     * 
     */
    public function update($name, $email, $id) {

        try {
            // onze sql
            $sql = 'UPDATE temp SET name = :name, email = :email WHERE id = :id';
            
            // bereid te query voor
            $query = $this->db->prepare($sql);
            
            // voer uit
            $query->execute(array(
                ':name' => $name,
                ':email' => $email,
                ':id' => $id
            ));

            // haal de rowcount op
            $count = $query->rowCount();
            
            
        } catch (PDOException $exc) {
            throw new Exception($exc->getMessage());
            exit();
        }
        
        // maak een tweede query om de nieuwe user te tonen
        $updatedUser = $this->fetchUpdatedUser($count);
        //var_dump($updatedUser);
        
        // sla de geupdate gebruiker op in de session
        
        $this->setupSession($updatedUser);
        
        
        
        
    }
    public function updatePassword($id, $oldPassword,$newPassword ) {

        try {
            // onze sql
            $sql = 'UPDATE temp SET password = :password WHERE id = :id';
            
            // bereid te query voor
            $query = $this->db->prepare($sql);
            
            // voer uit
            $query->execute(array(
                ':password' => RR_Hash::run('md5', $newPassword, RR_HASH_KEY),
                ':id' => $id
            ));

            // haal de rowcount op
            $count = $query->rowCount();
            
            // om te exceptioin handling te tonen
            //$count = 0;
            
            if($count>0){
                return $count;
            }
            else{
                throw new Exception('Oops, password update niet gelukt');
            }
            
        } catch (PDOException $exc) {
            throw new Exception($exc->getMessage());
            exit();
        }
        
        
    }
    // de naam suckt
    private function fetchUpdatedUser($count){
        if($count>0){
            try {
                // onze sql stmt
                $sql = "SELECT name,email from temp WHERE id = :id";
                
                // bereid de sql voor
                $stmt = $this->db->prepare($sql);
                
                // haal de id uit de session
                RR_Session::start();
                $id = RR_Session::get('id');
                // voer de sql uit
                $stmt->execute(
                        array(
                            ':id' => $id
                        ));
                
                // fetch de resultaten
                $updatedUser = $stmt->fetch(PDO::FETCH_ASSOC);
                return $updatedUser;
            } catch (PDOException $exc) {
                throw new Exception('Oops, '.$exc->getMessage());
            }
                }else{
            throw new Exception('Oops, er is een probleem met ophalen van je geupdate gegevens');
            exit();
        }
    }
    
    /**
     * 
     * @param type $count
     * @throws Exception als de update mislukt is
     */
     private function setupSession($result){
        
            //login
            // dit is nog niet goed, zou moeten opschuiven naar de controller
            RR_Session::start(); 
            // hier moet iets beter voor te vinden zijn
            //$id = RR_Session::get('id');
            //RR_Session::set('id', $id);
            RR_Session::set('name', $result['name']);
            RR_Session::set('email', $result['email']);
                        
        
    }

    
    
}

?>
