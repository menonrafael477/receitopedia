<?php if(!isset($_SESSION['id'])) : ?>
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
        <li><a href=""><p class="main-text"><img id="icon-un" src="images/header/user-solid.svg" alt="LOGIN">CONTA</p></a><a href=""><a href="logout.php"><p class="secondary-text">sair</p></a></li>
    </ul>
<?php endif; ?>