<?php
/**
 * The view class is verantwoordelijk voor het laden 
 * van html paginas
 */
class RR_View {
    /**
     * Construct is empty so far
     * Der gaat nog iet moeten bijkomen 
     */
    function __construct() {
        
    }
    /**
     * 
     * @param string $view the html view to load
     * @param bool $template flag to include the template, default = true
     * @param bool $loggedin if true different template is loaded
     */
    public function render($view,$template = true,$loggedin = false){
        
        // moest include op false staan dan kan de ivew zonder header en footer
        if($template){
            
            require 'public/views/template/header.php';
            
            if($loggedin){
                require 'public/views/template/menu_user.php';
            }
            
            require 'public/views/content/'.$view.'.php';
            require 'public/views/template/footer.php';
        }
        
    }
}
?>
