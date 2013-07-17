<!doctype html>
<html>
    <head>
        <title>RR-MVC</title>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/assets/bootstrap/css/bootstrap.css"/>
    </head>

    <body>
        <?php RR_Session::start(); ?>
        <header class="hero-unit text-center">
            
            <nav class="navbar text-right ">
                
                <?php if (RR_Session::get('loggedin') == true): ?>
                    
                        <a class="btn btn-mini btn-danger"  href="<?php echo BASE_URL; ?>login/logout">
                            logout
                        </a>
                    
                <?php else: ?>
                    <a class ="btn btn-mini btn-success" href="<?php echo BASE_URL; ?>login">
                        login
                    </a>
                    <a class ="btn btn-mini btn-info" href="<?php echo BASE_URL; ?>signup">
                        signup
                    </a>
                <?php endif; ?>
                
            </nav>
            <h1><a class="brand" href="<?php echo BASE_URL; ?>">RR-MVC</a></h1>
            <p>mini MVC geschrijven in PHP</p>
            </header>
        <section class="text-center row">