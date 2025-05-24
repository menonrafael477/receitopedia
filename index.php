<?php 
    require 'vendor/autoload.php'; 
    
    use Pecee\SimpleRouter\SimpleRouter as Router;
    Router::get('/home', function() {
        require 'views/home.view.php';
    });

    Router::start();
    
