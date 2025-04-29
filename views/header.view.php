<?php 

require('controllers/logout.controller.php');
require('controllers/session.controller.php');

$session_controller = new SessionController();

?>

<?php if($_SESSION['logado'] == false) : ?>
    <a href="index.php" id="logo">
        <img src="images/header/logo.png" alt="Logo">
        <h1 id="receitopedia">Receitopédia</h1>         
    </a>  

    <div id="search-container">
        <input id="search-bar" type="text" placeholder="Digite a receita que você procura" aria-placeholder="Buscar">
        <img id="search-icon" src="images/header/magnifying-glass-solid.svg" alt="Search Icon">
    </div>

    <ul id="header-options">
        <li><a href="login.php"><p class="main-text"><img id="icon-un" src="images/header/user-solid.svg" alt="LOGIN">CONTA</p></a><a href="login.php"><p class="secondary-text">login ou cadastro</p></a></li>
    </ul>

    <?php else : ?>

    <a href="index.php" id="logo">
        <img src="images/header/logo.png" alt="Logo">
        <h1 id="receitopedia">Receitopédia</h1>         
    </a>  

    <div id="search-container">
        <input id="search-bar" type="text" placeholder="Digite a receita que você procura" aria-placeholder="Buscar">
        <img id="search-icon" src="images/header/magnifying-glass-solid.svg" alt="Search Icon">
    </div>


    <ul id="header-options">
        <li>
            <a>
                <p class="main-text-logged">
                    <img id="icon-un" src="images/header/user-solid.svg" alt="LOGIN">
                    <?php echo strtoupper($_SESSION['nome_usuario']); ?>
    
                </p>
            </a>
            <form action="index.php?action_logoff=logoff" method="POST">
            <button type="submit" id="logout-button">sair</button></form>
        </li>
    </ul> 
<?php endif; ?>

