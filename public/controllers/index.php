<?php
class Index extends RR_Controller {

    function __construct() {
        parent::__construct();       
     
    }
    public function defaultView(){
           //echo RR_Hash::run('md5', 'ruslan2', RR_HASH_KEY);
           $this->view->render('index');
    }

}
?>
