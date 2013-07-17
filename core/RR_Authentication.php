<?php
/**
 * Description of Auth
 *
 * @author dev
 */
class RR_Authentication {
    private $db;
    private $salt = "J2EBJ2B";
    public static function init(){
        
        $this->db = new RR_DB_PDO();
        
    }
    public static function user(){
        
    }
}

?>
