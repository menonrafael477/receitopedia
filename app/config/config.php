<?php

    // Banco de dados
    define('DSN', 'mysql:host=localhost;dbname=receitopedia;');
    define('DB_USER', 'root');
    define('DB_PASSWD', '');

    // Requires
    define('AUTOLOAD', __DIR__ . '/../../vendor/autoload.php'); 

    define('HEADER_LAYOUT', __DIR__ . '/../Views/layouts/header.layout.php');
    define('HOME_VIEW', __DIR__ . '/../Views/home.view.php');
    define('CADASTRO_VIEW', __DIR__ . '/../Views/register.view.php');  
    define('RECIPE_VIEW', __DIR__ . '/../Views/recipe.view.php');
    define('ADMIN_VIEW', __DIR__ . '/../Views/admin.view.php'); 
    define('UPDATE_RECIPE_VIEW', __DIR__ . '/../Views/layouts/update.recipe.layout.php');
    define('LOGIN_VIEW', __DIR__ . '/../Views/login.view.php');   
    define('FOOTER_LAYOUT', __DIR__ . '/../Views/layouts/footer.layout.php');

?>