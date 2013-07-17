<?php
/**
 * this db object extends PDO
 */
require 'dbConfig.php';
class RR_DB_PDO extends PDO {
    
    function __construct() {
        parent::__construct(
                //'mysql:host=localhost;dbname=pdo', 'root', 'root');
                DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD
                );
    }
}
// nog niet werkend
class RR_Query extends RR_DB_PDO{
   
    function __construct() {
        parent::__construct();
    }
    public function fetch (){
        
    }
    public function add (){}
    public function update (){}
    public function delete (){}
}
