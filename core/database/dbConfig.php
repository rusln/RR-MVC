<?php

// dit wordt niet meer gebruikt !!!
$dbconfig = array();

//basic db config

$dbconfig['host'] = 'localhost';

$dbconfig['dbname'] = 'pdo';

// active table
$dbconfig['table'] = 'user_pw';

$dbconfig['user'] = 'root';

$dbconfig['password'] = 'root';


$dbconfig['dsn'] = 
        
        "mysql:host={$dbconfig['host']};
            
        dbname={$dbconfig['dbname']}";

        
define('DB_TYPE','mysql');
define('DB_HOST','localhost');
define('DB_NAME','pdo');
define('DB_USER','root');
define('DB_PASSWORD','root');
?>
