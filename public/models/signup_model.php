<?php
class Signup_Model extends RR_Model {

    function __construct() {
        parent::__construct();
            
    }
    
    public function add($user = array()){
        
        // der moet een user zijn, doh, anders exception... BAM
        if (empty($user)) {
            
            // paranoia.. dit wordt al opgevangen in controller
            throw new Exception("no user info provided…oops");
        } else {
            
            try {
                // zoals altijd 
                $query = $this->db->prepare(
                        'INSERT INTO temp (name,password,email)
                    VALUES(:name,:password,:email)');
                $query->execute(
                        array(
                            ':name' => $user['name'],
                            ':password' => RR_Hash::run('md5', $user['password'], RR_HASH_KEY),
                            ':email' => $user['email']
                ));
                // hebben we een user ?
                $result = $query->rowCount();
                return $result;
            } catch (PDOException $e) {
                throw new Exception('something went terribly wrong in my db,pls try again.');
            }
        }
    }

}
?>
