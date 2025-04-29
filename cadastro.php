<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receitopédia</title>
    <link rel="icon" type="image/x-icon" href="images/header/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <header>
        <?php
            require("views/header.view.php");
         ?>
    </header>

    <main>  
        <?php
            require("controllers/cadastro.controller.php");
        ?>
    </main>  
</body>
</html>

