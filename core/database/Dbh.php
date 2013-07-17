<?php


class Dbh{
        
        private $config;
        private $pdo;
        private $stmt;
        private $result;

    public function __construct() {
        
        // hmm, dit moet anders, maar voorlopig is het 'ok'
        require  'core/database/dbConfig.php';
        $this->config = $dbconfig;
                
    }
    
    function initialize(){
        
        if (!$this->pdo) {
            try {
                
//                $this->pdo = new \PDO($this->dbh, $this->username, $this->password);
                $this->pdo = new PDO(
                        $this->config['dsn'],
                        $this->config['user'],
                        $this->config['password']
                        );
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                return $this->pdo;
            } catch (PDOException $e) {
                $message = $e->getMessage();
                return $message;
            }
        } else {
            return $this->pdo;
        }
    }

    public function run ($sql,$params,$fetch = false){
        try{
        $this->initialize();
        $this->prepareStmt($sql);
        $this->bindParameters($params);
        $this->execute();
        
        // need a better solution
        if($fetch == true){
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->stmt->rowCount();
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
        // how to fetch from select and show just the rows from all the rest ? 
        //return $this->activeConnection->fetch(PDO::FETCH_ASSOC);
    }
    function execute(){
        
        try {    
                $this->stmt->execute();  
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }
    
    function bindParameters($params=array()){
        
        foreach ($params as $key=>$value){
            
            $this->stmt->bindParam($key,$value);
        }
    }
    
    function prepareStmt($sql){
        $this->stmt = $this->pdo->prepare($sql);
    }
}