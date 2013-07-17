<?php

/**
 * Verantwoordelijk voor afhandelen van url verzoeken
 * en delegeren naar de juiste controller's. Is momenteel static
 * mischien moet het in de toekomst anders
 * 
 *
 * @author dev
 */
class RR_Router {
    
    public static function run($controller){
        
    }
    
    /**
     * 
     * @return void
     */
    public static function init() {       
        //1 haal de url /index/nogiets/blablabla = ?url=index/bla/bla/bla
        $url = self::getUrl();
        
        // 2 als we niks hebben ga nr de main controller
        if(empty($url[0])){
            self::mainController();
            return;
        }
        
        // 3 als we wel iets hebben vind de locatie van opgevraagde controller
        $file = self::getFile($url);
        
       
        // 4 als we een bestaand hebben
        if(file_exists($file))
        {
            // tada
            require $file;            
            
            // 5 hebben we args voor de methode ? controller->method(args)
            if (isset($url[2])) {
                $controller= new $url[0];
                $method = $url[1];
                
                // 5.1 als de methode bestaat 
                if(method_exists($controller, $method)):
                    
                // 5.2 roep de methode op en geef een arg mee door
                $controller->{$url[1]}($url[2]);
                
                // 5.3 anders de error page
                else : self::displayErrorPage();
                endif;
                
            // 6 hebben we een methode ? controller->method
            } elseif (isset($url[1])) {
                $method = $url[1];
                $controller= new $url[0];
                
                // 6.1 check eerst of de method bestaat 
                if(method_exists($controller, $method)):
                // go go go 
                $controller->{$url[1]}();
                
                // 6.2 anders de error page of doom
                else : self::displayErrorPage();
                endif;
            
            // 7 hebben we alleen een controller ? new Controller()
            }elseif (isset ($url[0])){
                $controller= new $url[0];
                $controller->defaultView();
            }
            
        }
        // 8 als de controller/file niet bestaat -> error page
        else
        {
            
            // display the error page
            self::displayErrorPage();
        }

       
    }
    /**
     * Laad de error controller
     */
    static function displayErrorPage(){
            
            require 'public/controllers/error.php';
            $controller = new Error();
            $controller->defaultView();
    }
    /**
     * maak van de query string een array
     * @return string|array afhankelijk van hoe diep we zitten
     * 
     */
    private static function getUrl() {
        
        //haal de url op bvb user/get/ruslan
        $urlStr = $_GET['url'];
        
        // haal de laatste / af , zodat er geen empty string wordt aangemaakt
        // als aatste value
        $url = rtrim($urlStr,'/');
        
        // maak een array van de url 
        $urlArr = explode('/', $url);
        return $urlArr;
    }
    /**
     * maakt een string met de locatie van de juiste controller
     * op de hardschijf
     * @param type $url
     * @return string
     */
    private static function getFile($url){

         $file = 'public/controllers/' . $url[0] . '.php';
         return $file;
    }
    /**
     * Laad de index controller
     */
    public static function mainController(){
        require 'public/controllers/index.php';
        $controller = new Index();
        $controller->defaultView();
    }

}

?>
