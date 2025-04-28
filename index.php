<?php
    session_start();
    //include("controllers/session.controller.php");
    require("controllers/receitopedia.controller.php");

    $receitaController = new ReceitopediaController();
    $receitaController->exibirReceitas();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receitopédia</title>
    <link rel="icon" type="image/x-icon" href="images/header/logo.png">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <?php
            require("views/header.view.php");


            var_dump($_SESSION);
        ?>
    </header>

    <?php
        // A saída do método exibirReceitas() será renderizada aqui então não mecham nisso
    ?>

    <form action="index.php?action=logout" method="POST">
        <button type="submit">Session</button>
    </form>
</body>
</html>