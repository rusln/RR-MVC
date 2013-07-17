<?php

class Users_Model extends RR_Model {

    function __construct() {
        parent::__construct();
    }
    
    public function fetch($id){
        
        try{
            $sqlById = ('SELECT * FROM temp WHERE id=:id');
            $sql = ('SELECT * FROM temp');
        if($id):         
            $query = $this->db->prepare($sqlById);
            $query->execute(
                    array(
                        ':id'=>$id
                    ));
        else : 
            $query = $this->db->prepare($sql);
            $query->execute();
        endif;
        
        
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        //var_dump($result);
        return $result;
        }
 catch (PDOException $e){
            // hier blijven we wel op de pagina,
            // geen nut voor een redirect
//            $message = $e->getMessage();
//            return $message;
            throw new Exception('iets mis in de db');
 }
        
    }
    public function add($name,$email,$password){
        
        try{
        $query = $this->db->prepare('INSERT INTO temp (name,email,password) VALUES (:name,:email,:password)');
        
        $query->execute(
                array(
                    
                    ':name'=>$name,
                    ':email'=>$email,
                    ':password'=>  RR_Hash::run('md5', $password, RR_HASH_KEY)
                ));
        
        //$result = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $query->rowCount();
        //var_dump($result);
        return $result;
        }
 catch (PDOException $e){
            // hier blijven we wel op de pagina,
            // geen nut voor een redirect
//            $message = $e->getMessage();
//            return $message;
            throw new Exception('iets mis in de db');
 }
        
    }

}
?>
