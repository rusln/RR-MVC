<?php
/**
 * Model werkt met een db class 
 * alle "buisenes" logic zit dan ook hier
 * TODO: der is nog veel werk 
 */
class RR_Model {
    
    // bij construct een niewe db class ! 
    // niet optimaal…
    public $db;
    function __construct() {
        //$this->query = new Query();
        
        $this->db = new RR_DB_PDO();
    }

}
?>
