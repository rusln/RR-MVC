<?php //echo $this->msg; 
    // here we can pass anything we need down from the controller
?>
<form class="text-center form-actions" id="reg-form" method="post" action="signup/user">
    <label for="regName">name</label>
    <input type="text" id="regName" name="regName"/>

    <label for="regEmail">e-mail</label>
    <input type="text" id="regEmail" name="regEmail"/>              

    <label for="regPass">password</label>
    <input type="password" id="regPass" name="regPass"/>              

    <label></label>
    <input type="submit" name="submit" value="submit"/>
</form>
