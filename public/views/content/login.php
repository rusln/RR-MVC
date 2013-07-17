
<?php //echo $this->msg; 
    // here we can pass anything we need down from the controller
?>
<form class="text-center form-actions" id="login-form" method="post" action="login/user">
            <label for="name">name</label>
            <input type="text" id="name" name="name"/>
            
            <label for="password">password</label>
                <input type="password" id="password" name="password"/>
                <label></label>
                <input type="submit" name="submit" value="submit"/>
            
            
        </form>
