<?php
/**
 * Onze basis controller
 * Doet maar een ding: een nieuwe view class aanmaken
 */
class RR_Controller {
    public $view;
    function __construct() {
        //echo '<br>main controller is active<br>';
        
        $this->view = new RR_View();
        
        
        // require een model automatisch voor de controller
        
        
    }
    
    /**
     * Nog niet in gebruik. Dit activeert 'automatisch' een model
     * wanneer een controller is instantieted
     * zal handig zijn voor in de toekomst
     * @param string $name = naam van de model
     */
    public function loadModel($name){
        
        $path = 'public/models/'.$name.'_model.php';
        
        if(file_exists($path)){
            require 'public/models/'.$name.'_model.php';
            $modelName = $name.'_model';
            $this->model = new $modelName();
        }
    }

}
?>
