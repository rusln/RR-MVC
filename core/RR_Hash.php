<?php

class RR_Hash {

    /**
     * 
     * @param string $algorithm The algorithm(md5,sha1,etc)
     * @param string $data      The data to encode
     * @param string $salt      The salt(should be the same for the program)
     * @return string           The hashed/salted data
     */
    public static function run($algorithm,$data,$salt){
        $context = hash_init($algorithm, HASH_HMAC, $salt);
        hash_update($context, $data);
        
        return hash_final($context);
    }

}
?>
