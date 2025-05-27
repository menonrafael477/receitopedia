<?php 

    session_start();

    require __DIR__ . '/../app/config/config.php';
    require AUTOLOAD;
    
    Routes::defineRoutes();

    

?>
        