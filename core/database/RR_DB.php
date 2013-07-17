<?php


/**
 * This db object includes db 
 */
class RR_DB {

    function __construct() {
        
    }
    public function fetch() {
        $result = '';
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=pdo', 'root', 'root');
            $pdo->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);

//        $stmt = $pdo->prepare('SELECT * FROM temp');
            $stmt = $pdo->prepare('SELECT * FROM temp WHERE name = :name');
            $stmt->bindParam('name', 'google');
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $result = $e->getMessage();
        }

        return $result;
    }

}
?>
