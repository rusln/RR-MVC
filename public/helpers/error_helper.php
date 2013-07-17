<?php
/**
 * Help functie voor de error controller
 * 
 * @param string $requestURI waar is de error ontstaan
 * @return string geef de opgekuiste string trug
 */
function cleanRequestURI($method){
    
    
    
    $cleanClassMethod = str_ireplace('::', '/', $method);
    
    return $cleanClassMethod;
}


?>
