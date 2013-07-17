<?php
/**
 * Sessie voor de logins en authorizatie bij te houden
 */
class RR_Session {
    
    public static function start(){
        @session_start();
    }
    public  static function set($key,$value){
        $_SESSION[$key] = $value;
    }
    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
    }
    public static function destroy(){
        
        // dit gewoon zal niet werken want session_destroy is simply een waarsch
//        session_unset(); 
//        session_destroy();
        session_start();
        session_unset(); 
        session_destroy();
    }
    
}

?>
