<?php
/**
 * hier klopt nog van alles niet aan
 */
class RR_Filter {

    function __construct() {
        
    }
    
    public static function validateEmail($email){
       
        $validEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($validEmail) {
            return $validEmail;
        }else{
            throw new Exception('Oops, email is niet just');
        }
        
    }
    public static function htmlSpecialChars($string){
        
        $cleanString = filter_var($string,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if ($cleanString) {
            return $cleanString;
        }else{
            throw new Exception('Oops, niet toegelaten tekens');
        }
    }

}
?>
