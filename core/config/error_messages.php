<?php

// hier zitten alle error messages 
// Een error object zou ook wel kunnen, maar is mischien 
// een beetje een overkill hiervoor ? 

// de basis pdo error die aan alle default gebruikers toont dat er "iets"
// misgelopen is
define('RR_PDO_ERROR', 'Oops, iets misgelopen in de db');

// de basis error voor wanneer de login mislukt
define('RR_USER_LOGIN_ERROR', 'Oops, user of t wachtwoord zijn niet correct');

// basis error voor wanneer bij een login of een register
// niet alle form velden zijn ingevuld
define('RR_SESSION_EMPTY_CRED_ERROR', 'Oops, niet alle gegevens zijn ingevuld');


// zal er meer toevoegen als er meer nodig zijn 

?>
