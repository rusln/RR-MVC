    
    <div class="row  span12 text-center">
        
        <H3 class="lead">Settings</H3>
        
        
        <form id="update-user" action="settings/update" method="post" class="span6">
            
            <label for="name">name</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                class="<?php if(isset($this->success)):
                    echo '';
                    else : echo '';
                    endif; ?>"
                placeholder="<?php echo $this->name; ?>"  />
            <label for="email" >email</label>
            <input type="text" name="email" id="email" placeholder="<?php echo $this->email; ?>"/>
            <label></label>
            <input type ="submit" id="update" value="update"></input>
            <label></label>


        </form>
        
        <form id="update-password" action="settings/updatePassword" method="post" class="span5">
            <label for="old-password">Current password</label>
            <input type="password" name="old-password" id="old-password"/>
            <label for="new-password">new password</label>
            <input type="password"name="new-password" id="new-password" />
            <label></label>
            <input type="submit" value="update"/>
        </form>
    </div>
