<?php 

    require __DIR__ . '/../app/config/config.php';
    require AUTOLOAD;
    
    Routes::defineRoutes();

    if (session_status() != 1) {
        session_start();
    }
?>
        