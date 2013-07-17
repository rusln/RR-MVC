<?php
spl_autoload_register(
        function ($class) {
    $directory;
     $lookup = array(
            'core/'=>array(
                'RR_Authentication',
                'RR_Filter',
                'RR_Hash',
                'RR_Session',
                'RR_Router'
                ),
            'core/mvc/'=>array(
                'RR_Controller',
                'RR_Model',
                'RR_View'
                ),
            'core/database/'=>array(
                'RR_DB_PDO'
            )
            
        );
        foreach ($lookup as $key=>$value) {
             if(is_int(array_search($class, $value))):
                 $directory = $key;
             require $directory . $class . '.php';
             return;
             endif;
        }
      
    
},true);

// config bestanden
require 'core/config/paths.php';
require 'core/config/error_messages.php';
require 'core/config/hash_config.php';

// helper bestanden
require 'public/helpers/error_helper.php';

?>
