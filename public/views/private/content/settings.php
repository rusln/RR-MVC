<section class="text-center row">
    
    <!--this will go it's own template-->
    <aside class="span2">
        <ul class="nav nav-list">
            <li class="nav-header">Menu</li>
            <li class=""><a href="<?php echo BASE_URL;?>admin">Home</a></li>
            <li class=""><a href="<?php echo BASE_URL;?>settings">Settings</a></li>
            <li><a href="#">Library</a></li>
            ...
        </ul>
    </aside>
    <div class="span10">
        <H3 class="lead">Settings</H3>
        
        <form id="" action="settings/change" method="post">
            <label for="name">name</label>
            <input type="text" placeholder="<?php echo $this->name; ?>"  />
            <label for="email" placeholder="<?php echo $this->email; ?>">email</label>
            <input type="text" />
            
        </form>
        <h3 class="lead">Change password</h3>
        <form id="" action="" method="post">
            <label for="oldPassword">old password</label>
            <input type="password" />
            <label for="newPassword">new password</label>
            <input type="password" />
        </form>
    </div>
    

</section>
