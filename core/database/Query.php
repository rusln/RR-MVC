<?php
require 'dbh.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Query
 *
 * @author dev
 */
class Query {
    private $db;
    private $sqlQuery;
    
    public function __construct() {
        $this->db = new Dbh;
    }
    
    public function add($user = array()){
        $result = $this->db->run(
                'INSERT INTO temp (name,password,email) VALUES(:name,MD5(:password),:email)', 
                array(
                    ':name'=>$user['name'],
                    ':password'=>$user['password'],
                    ':email'=>$user['email']
                ));
        
        return $result;
    }
    
    // wip for the build method
    // doens't work right now 
    public function add2($user = array()){
        
        $sql = $this->build("add", $user);
        $result = $this->db->run($sql, $user,false);
        return $result;
    }
    public function update($user= array()){
        $result = $this->db->run(
                'UPDATE temp SET name = :name WHERE id = :id',
                array(':id'=>$user['id'],':name'=>$user['name']),
                false
                );

        return $result;
    }
    
    public function delete(int $id){
        $result = $this->db->run(
                'DELETE from temp WHERE id = :id', 
                array(':id'=>$id),false);
        return $result;
    }
    public function fetch($user,$password){
        
        $result = $this->db->run(
                'SELECT (name,password) FROM temp WHERE password = :password', 
                array(':name'=>$name,':password'=>$password),true);
        
        return $result;
    }
    public function fetchAll(){
        $result = $this->db->run(
                'SELECT (name) FROM temp',null,true);
        
//        foreach ($result as $row){
//            echo ($row['name']);
//        }
        return $result;
    }
    
    // will build the query that are now hardcoded into all the methods
    public function build($command,$params){
        
        $sql = "";

        if ($command == "add") {
            if (!$params['id']) {
                $sql = 'INSERT INTO temp VALUES(';

                // haal de keys eruit voor de insert stmt
                $keys = array_keys($params);
                foreach ($keys as $key){
                    $key = ':'.$key;
                }
                // maak een string van de keys
                $keysStrg = implode(",", $keys);

                // 
                $sql .= $keysStrg . ')';
            }else{

                $sql = 'UPDATE temp SET ';
                
                // make a subset of the query
                $temp = array_slice($params, 1);
                
                // set part of the query
                foreach($temp as $key=>$value){
                    $sql.= $key.'='.':'.$key.'  ';
                }
                $sql.= ' WHERE ';
                $sql.= 'id = :id';
                
                //echo $sql;
            }
            
        }
        return $sql;
    }
    public function execute(){
        
        $result = $this->db->run($sql, $params);
        
    }
 
  
}

?>
